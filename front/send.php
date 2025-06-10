<?php
// Endpoint to send a message
if (!defined('GLPI_ROOT')) {
    define('GLPI_ROOT', dirname(__DIR__, 2));
}

include_once GLPI_ROOT . '/inc/includes.php';
include_once GLPI_ROOT . '/plugins/tiao/inc/hook.php';

header('Content-Type: application/json');

Session::checkRight('plugin', 'tiao', 'w');

$input = json_decode(file_get_contents('php://input'), true);
if (!$input || !isset($input['message'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid request']);
    exit;
}

$message = trim($input['message']);

$sender = new \GlpiPlugin\Tiao\Sendpulse(
    plugin_tiao_getConfig('api_user'),
    plugin_tiao_getConfig('api_secret')
);
$response = $sender->sendMessage('', $message);

// log message into plugin table
global $DB;
$table = $DB->getTable('plugin_tiao_messages');
$DB->insert($table, [
    'phone'     => null,
    'message'   => $message,
    'origin'    => 'web',
    'direction' => 'out',
    'date'      => date('Y-m-d H:i:s')
]);

echo json_encode($response);
exit;
