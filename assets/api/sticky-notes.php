<?php
/**
 * Simple guestbook API for desktop sticky notes.
 * GET    — list notes (newest first)
 * POST   — add a note (JSON body: author?, text)
 * DELETE — remove your own note (JSON body: id, deleteToken)
 */

header('Content-Type: application/json; charset=utf-8');
header('X-Content-Type-Options: nosniff');

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$dataDir = dirname(__DIR__, 2) . '/data';
$dataFile = $dataDir . '/sticky-notes.json';
$maxNotes = 3;
$maxTextLen = 280;
$maxAuthorLen = 32;
$minIntervalSeconds = 8;

function sendJson(int $status, array $payload): void
{
    http_response_code($status);
    echo json_encode($payload, JSON_UNESCAPED_UNICODE);
    exit;
}

function readNotes(string $path): array
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

function writeNotes(string $path, array $notes): bool
{
    $dir = dirname($path);
    if (!is_dir($dir) && !mkdir($dir, 0755, true)) {
        return false;
    }
    $json = json_encode(array_values($notes), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    if ($json === false) {
        return false;
    }
    $tmp = $path . '.tmp';
    if (file_put_contents($tmp, $json, LOCK_EX) === false) {
        return false;
    }
    return rename($tmp, $path);
}

function sanitiseText(string $value, int $maxLen): string
{
    $value = strip_tags($value);
    $value = preg_replace('/\s+/u', ' ', trim($value)) ?? '';
    if (mb_strlen($value) > $maxLen) {
        $value = mb_substr($value, 0, $maxLen);
    }
    return $value;
}

function getDeleteSecret(string $dir): string
{
    $secretFile = $dir . '/.sticky-notes-secret';
    if (is_readable($secretFile)) {
        $secret = trim((string) file_get_contents($secretFile));
        if ($secret !== '') {
            return $secret;
        }
    }
    if (!is_dir($dir) && !mkdir($dir, 0755, true)) {
        return '';
    }
    $secret = bin2hex(random_bytes(32));
    file_put_contents($secretFile, $secret, LOCK_EX);
    return $secret;
}

function makeDeleteToken(string $id, string $secret): string
{
    return hash_hmac('sha256', $id, $secret);
}

function verifyDeleteToken(string $id, string $token, string $secret): bool
{
    if ($id === '' || $token === '' || $secret === '') {
        return false;
    }
    return hash_equals(makeDeleteToken($id, $secret), $token);
}

if ($method === 'GET') {
    $notes = readNotes($dataFile);
    usort($notes, static function ($a, $b) {
        return ($b['created'] ?? 0) <=> ($a['created'] ?? 0);
    });
    sendJson(200, ['ok' => true, 'notes' => $notes]);
}

if ($method === 'POST') {
    $body = json_decode(file_get_contents('php://input') ?: '', true);
    if (!is_array($body)) {
        sendJson(400, ['ok' => false, 'error' => 'Invalid request body.']);
    }

    $text = sanitiseText((string) ($body['text'] ?? ''), $maxTextLen);
    if ($text === '') {
        sendJson(400, ['ok' => false, 'error' => 'Please write something on your note.']);
    }

    $author = sanitiseText((string) ($body['author'] ?? ''), $maxAuthorLen);
    if ($author === '') {
        $author = 'Guest';
    }

    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $now = time();
    $lastPost = (int) ($_SESSION['sticky_note_last'] ?? 0);
    if ($lastPost > 0 && ($now - $lastPost) < $minIntervalSeconds) {
        sendJson(429, ['ok' => false, 'error' => 'Slow down — try again in a few seconds.']);
    }

    $notes = readNotes($dataFile);
    $note = [
        'id' => bin2hex(random_bytes(8)),
        'author' => $author,
        'text' => $text,
        'created' => $now,
    ];

    array_unshift($notes, $note);
    if (count($notes) > $maxNotes) {
        $notes = array_slice($notes, 0, $maxNotes);
    }

    if (!writeNotes($dataFile, $notes)) {
        sendJson(500, ['ok' => false, 'error' => 'Could not save your note. Try again later.']);
    }

    $_SESSION['sticky_note_last'] = $now;

    $secret = getDeleteSecret($dataDir);
    $deleteToken = $secret !== '' ? makeDeleteToken($note['id'], $secret) : '';

    sendJson(201, ['ok' => true, 'note' => $note, 'deleteToken' => $deleteToken]);
}

if ($method === 'DELETE') {
    $body = json_decode(file_get_contents('php://input') ?: '', true);
    if (!is_array($body)) {
        sendJson(400, ['ok' => false, 'error' => 'Invalid request body.']);
    }

    $id = preg_replace('/[^a-f0-9]/', '', strtolower((string) ($body['id'] ?? '')));
    $token = (string) ($body['deleteToken'] ?? '');

    if ($id === '' || $token === '') {
        sendJson(400, ['ok' => false, 'error' => 'Missing note id or permission.']);
    }

    $secret = getDeleteSecret($dataDir);
    if ($secret === '' || !verifyDeleteToken($id, $token, $secret)) {
        sendJson(403, ['ok' => false, 'error' => 'You can only remove notes you posted from this browser.']);
    }

    $notes = readNotes($dataFile);
    $before = count($notes);
    $notes = array_values(array_filter($notes, static function ($note) use ($id) {
        return ($note['id'] ?? '') !== $id;
    }));

    if ($before === count($notes)) {
        sendJson(404, ['ok' => false, 'error' => 'Note not found.']);
    }

    if (!writeNotes($dataFile, $notes)) {
        sendJson(500, ['ok' => false, 'error' => 'Could not remove that note. Try again later.']);
    }

    sendJson(200, ['ok' => true]);
}

sendJson(405, ['ok' => false, 'error' => 'Method not allowed.']);
