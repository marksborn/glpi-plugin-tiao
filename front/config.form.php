<?php
if (!defined('GLPI_ROOT')) {
    define('GLPI_ROOT', dirname(__DIR__, 2));
}
include_once GLPI_ROOT . '/inc/includes.php';
include_once GLPI_ROOT . '/plugins/tiao/inc/hook.php';

// Permissão de configuração
Session::checkRight('config', 'tiao', 'w');

// Processa submissão do formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $apiUser   = $_POST['api_user']   ?? '';
    $apiSecret = $_POST['api_secret'] ?? '';
    plugin_tiao_setConfig('api_user', $apiUser);
    plugin_tiao_setConfig('api_secret', $apiSecret);
    echo "<div class='alert alert-success'>Configurações salvas com sucesso.</div>";
}

// Carrega valores atuais
$apiUser   = plugin_tiao_getConfig('api_user', '');
$apiSecret = plugin_tiao_getConfig('api_secret', '');
?>
<form method="post" action="">
  <table class="tab_cadre_fixe">
    <tr><th colspan="2">Credenciais SendPulse</th></tr>
    <tr>
      <td>API User ID</td>
      <td><input type="text" name="api_user" value="<?php echo Html::encode($apiUser); ?>" size="50" /></td>
    </tr>
    <tr>
      <td>API Secret</td>
      <td><input type="text" name="api_secret" value="<?php echo Html::encode($apiSecret); ?>" size="50" /></td>
    </tr>
    <tr>
      <td colspan="2"><input type="submit" class="submit" value="Salvar" /></td>
    </tr>
  </table>
</form>
