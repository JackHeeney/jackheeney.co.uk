<?php
/**
 * Proxy for Old School RuneScape lite hiscores (JSON).
 * GET ?player=NAME
 */

header('Content-Type: application/json; charset=utf-8');
header('X-Content-Type-Options: nosniff');

function sendJson(int $status, array $payload): void
{
    http_response_code($status);
    echo json_encode($payload, JSON_UNESCAPED_UNICODE);
    exit;
}

$player = trim((string) ($_GET['player'] ?? 'IM_KOFI'));
if ($player === '' || strlen($player) > 12) {
    sendJson(400, ['ok' => false, 'error' => 'Invalid player name.']);
}

if (!preg_match('/^[A-Za-z0-9 _-]+$/', $player)) {
    sendJson(400, ['ok' => false, 'error' => 'Invalid player name.']);
}

$url = 'https://secure.runescape.com/m=hiscore_oldschool/index_lite.json?player=' . rawurlencode($player);

$context = stream_context_create([
    'http' => [
        'method' => 'GET',
        'timeout' => 8,
        'header' => "User-Agent: JackHeeney-Desktop/1.0\r\nAccept: application/json\r\n",
    ],
    'ssl' => [
        'verify_peer' => true,
        'verify_peer_name' => true,
    ],
]);

$raw = @file_get_contents($url, false, $context);
$statusLine = $http_response_header[0] ?? '';
$httpCode = 0;
if (preg_match('/\s(\d{3})\s/', $statusLine, $matches)) {
    $httpCode = (int) $matches[1];
}

if ($raw === false || $httpCode === 404) {
    sendJson(404, ['ok' => false, 'error' => 'Player not found on the hiscores.']);
}

if ($httpCode !== 200) {
    sendJson(502, ['ok' => false, 'error' => 'Could not reach the OSRS hiscores service.']);
}

$data = json_decode($raw, true);
if (!is_array($data) || !isset($data['skills']) || !is_array($data['skills'])) {
    sendJson(502, ['ok' => false, 'error' => 'Unexpected response from the hiscores service.']);
}

sendJson(200, [
    'ok' => true,
    'player' => (string) ($data['name'] ?? $player),
    'skills' => $data['skills'],
    'activities' => $data['activities'] ?? [],
]);
