<?php
include_once __DIR__ . '/../../inc/includes.php';
Session::checkRight('plugin', 'tiao', 'r');
Html::header('Tião', $_SERVER['PHP_SELF'], 'plugins', 'tiao');

echo '<div id="tiao-chat-root"></div>';

// Polling demo: fetch messages a cada 3s
echo "<script>
setInterval(() => {
  fetch('".GLPI_ROOT."/plugins/tiao/front/fetch.php')
    .then(r => r.json())
    .then(data => console.log(data));
}, 3000);
</script>";

Html::footer();
