<?php
include_once __DIR__ . '/../../inc/includes.php';
Session::checkRight('plugin', 'tiao', 'r');
Html::header('Tião', $_SERVER['PHP_SELF'], 'plugins', 'tiao');

echo '<div id="tiao-chat-root"></div>';

Html::footer();
?>

