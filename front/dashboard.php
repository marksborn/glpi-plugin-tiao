<?php
if (!defined('GLPI_ROOT')) {
    define('GLPI_ROOT', dirname(__DIR__, 2));
}
include_once GLPI_ROOT . '/inc/includes.php';

Session::checkRight('plugin', 'tiao', 'r');

// Cabeçalho correto: Plugins → Tião
Html::header(
    'Tião Dashboard',
    $_SERVER['PHP_SELF'],
    'plugin',  // menu principal, plural
    'tiao'      // chave do plugin
);

echo '<div id="tiao-chat-root"></div>';

// Polling demo
echo "<script>
setInterval(() => {
  fetch('" . GLPI_ROOT . "/plugins/tiao/front/fetch.php')
    .then(r => r.json())
    .then(data => console.log(data));
}, 3000);
</script>";

Html::footer();
?>
