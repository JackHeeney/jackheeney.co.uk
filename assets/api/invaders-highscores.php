<?php
/**
 * Space Invaders shared high scores API.
 * GET  — fetch top highscores
 * POST — submit a highscore (JSON body: name, score, level)
 */

header('Content-Type: application/json; charset=utf-8');
header('X-Content-Type-Options: nosniff');

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$dataDir = dirname(__DIR__, 2) . '/data';
$dataFile = $dataDir . '/invaders-highscores.json';
$maxEntries = 10;
$minSubmitIntervalSeconds = 10;
$maxSubmissionsPerHour = 20;

function sendJson(int $status, array $payload): void
{
    http_response_code($status);
    echo json_encode($payload, JSON_UNESCAPED_UNICODE);
    exit;
}

function readHighScores(string $path): array
{
    if (!is_readable($path)) {
        return [];
    }
    $raw = file_get_contents($path);
    if ($raw === false || trim($raw) === '') {
        return [];
    }
    $decoded = json_decode($raw, true);
    return is_array($decoded) ? $decoded : [];
}

function writeHighScores(string $path, array $scores): bool
{
    $dir = dirname($path);
    if (!is_dir($dir) && !mkdir($dir, 0755, true)) {
        return false;
    }
    $json = json_encode(array_values($scores), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    if ($json === false) {
        return false;
    }
    $tmp = $path . '.tmp';
    if (file_put_contents($tmp, $json, LOCK_EX) === false) {
        return false;
    }
    return rename($tmp, $path);
}

function normaliseName(string $name): string
{
    $name = strtoupper($name);
    $name = preg_replace('/[^A-Z]/', '', $name) ?? '';
    if (strlen($name) < 3) {
        $name = str_pad($name, 3, 'A');
    }
    return substr($name, 0, 3);
}

function sanitiseHighScores(array $entries, int $maxEntries): array
{
    $safe = [];
    foreach ($entries as $entry) {
        if (!is_array($entry)) {
            continue;
        }
        $score = isset($entry['score']) ? (int) $entry['score'] : 0;
        $level = isset($entry['level']) ? (int) $entry['level'] : 1;
        $safe[] = [
            'name' => normaliseName((string) ($entry['name'] ?? 'AAA')),
            'score' => max(0, $score),
            'level' => max(1, $level),
            'date' => (string) ($entry['date'] ?? gmdate('c')),
        ];
    }

    usort($safe, static function ($a, $b) {
        return ($b['score'] ?? 0) <=> ($a['score'] ?? 0);
    });

    return array_slice($safe, 0, $maxEntries);
}

if ($method === 'GET') {
    $scores = sanitiseHighScores(readHighScores($dataFile), $maxEntries);
    sendJson(200, ['ok' => true, 'highScores' => $scores]);
}

if ($method === 'POST') {
    $body = json_decode(file_get_contents('php://input') ?: '', true);
    if (!is_array($body)) {
        sendJson(400, ['ok' => false, 'error' => 'Invalid request body.']);
    }

    $name = normaliseName((string) ($body['name'] ?? 'AAA'));
    $score = (int) ($body['score'] ?? 0);
    $level = (int) ($body['level'] ?? 1);

    if ($score <= 0) {
        sendJson(400, ['ok' => false, 'error' => 'Score must be greater than zero.']);
    }

    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $now = time();
    $windowStart = $now - 3600;
    $submissionTimes = $_SESSION['invaders_score_submit_times'] ?? [];
    if (!is_array($submissionTimes)) {
        $submissionTimes = [];
    }
    $submissionTimes = array_values(array_filter($submissionTimes, static function ($timestamp) use ($windowStart) {
        return is_int($timestamp) && $timestamp >= $windowStart;
    }));

    $lastSubmit = (int) ($_SESSION['invaders_score_last_submit'] ?? 0);
    if ($lastSubmit > 0 && ($now - $lastSubmit) < $minSubmitIntervalSeconds) {
        $wait = $minSubmitIntervalSeconds - ($now - $lastSubmit);
        sendJson(429, ['ok' => false, 'error' => "Please wait {$wait}s before submitting another score."]);
    }

    if (count($submissionTimes) >= $maxSubmissionsPerHour) {
        sendJson(429, ['ok' => false, 'error' => 'Submission limit reached. Please try again later.']);
    }

    $scores = readHighScores($dataFile);
    $scores[] = [
        'name' => $name,
        'score' => max(0, $score),
        'level' => max(1, $level),
        'date' => gmdate('c'),
    ];
    $scores = sanitiseHighScores($scores, $maxEntries);

    if (!writeHighScores($dataFile, $scores)) {
        sendJson(500, ['ok' => false, 'error' => 'Could not save high score.']);
    }

    $submissionTimes[] = $now;
    $_SESSION['invaders_score_submit_times'] = $submissionTimes;
    $_SESSION['invaders_score_last_submit'] = $now;

    sendJson(201, ['ok' => true, 'highScores' => $scores]);
}

sendJson(405, ['ok' => false, 'error' => 'Method not allowed.']);
