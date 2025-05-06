<?php
include_once __DIR__ . '/../../inc/includes.php';
// Use 'plugin' menu for the dashboard page
Html::header(
    'Tião',
    $_SERVER['PHP_SELF'],
    'plugin',
    'tiao'
);

Session::checkRight('plugin', 'tiao', 'r');

echo '<div id="tiao-chat-root"></div>';

// Periodically fetch messages
echo "<script>
setInterval(()=>fetch('".
    GLPI_ROOT."/plugins/tiao/front/fetch.php')
  .then(r=>r.json()).then(data=>console.log(data)),3000);
</script>";

Html::footer();
?>