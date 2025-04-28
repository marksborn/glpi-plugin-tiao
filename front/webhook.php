<?php
// Public endpoint for SendPulse webhook

define('GLPI_ROOT', __DIR__ . '/../../..');
include_once GLPI_ROOT . '/inc/includes.php';
header('Content-Type: application/json');

$request = json_decode(file_get_contents('php://input'), true);
if (!$request) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid JSON']);
    exit;
}

// Map fields to plugin table
global $DB;
$table = 'glpi_plugin_tiao_messages';
$data = [
    'phone'      => $request['phone'] ?? null,
    'message'    => $request['message'] ?? null,
    'origin'     => $request['origin'] ?? null,
    'direction'  => $request['direction'] ?? null,
    'username'   => $request['username'] ?? null,
    'item_id'    => $request['item_id'] ?? null,
    'date'       => date('Y-m-d H:i:s')
];
$DB->insert($table, $data);

echo json_encode(['status' => 'ok']);
exit;
?>
