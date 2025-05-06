<?php
// AJAX endpoint to get messages
define('GLPI_ROOT', __DIR__ . '/../../..');
include_once GLPI_ROOT . '/inc/includes.php';
header('Content-Type: application/json');

global $DB;
$table = $DB->getTable('plugin_tiao_messages');
$res = $DB->query("SELECT * FROM `{$table}` ORDER BY `date` DESC LIMIT 50");
$data = [];
while ($row = $res->fetch_assoc()) { $data[] = $row; }
echo json_encode(array_reverse($data));
exit;
