<?php
include_once __DIR__ . '/../../inc/includes.php';
Session::checkRight('config', 'tiao', 'w');
Html::header('Configuração Tião', $_SERVER['PHP_SELF'], 'plugins', 'tiao');

if (isset($_POST['api_user']) && isset($_POST['api_secret'])) {
    plugin_tiao_setConfig('api_user', $_POST['api_user']);
    plugin_tiao_setConfig('api_secret', $_POST['api_secret']);
    echo '<div class="alert alert-success">Configurações salvas com sucesso.</div>';
}

$apiUser   = plugin_tiao_getConfig('api_user');
$apiSecret = plugin_tiao_getConfig('api_secret');
?>
<form method='post'>
  <table class='tab_cadre_fixe'>
    <tr><th colspan='2'>Credenciais SendPulse</th></tr>
    <tr>
      <td>API User ID</td>
      <td><input type='text' name='api_user' value='<?php echo Html::encode($apiUser); ?>' size='50'></td>
    </tr>
    <tr>
      <td>API Secret</td>
      <td><input type='text' name='api_secret' value='<?php echo Html::encode($apiSecret); ?>' size='50'></td>
    </tr>
    <tr>
      <td colspan='2'><input type='submit' class='submit' value='Salvar'></td>
    </tr>
  </table>
</form>
<?php
Html::footer();
