<?php
if (!defined('GLPI_ROOT')) {
    die("Sorry. You can't access directly");
}
include_once GLPI_ROOT . '/inc/includes.php';

/**
 * Utility: get plugin config
 */
function plugin_tiao_getConfig($key, $default = '') {
    global $DB;
    $table = 'glpi_plugin_tiao_configs';
    $res = $DB->query("SELECT `value` FROM `{$table}` WHERE `name`='".
        addslashes($key)."' LIMIT 1");
    if ($row = $res->fetch_assoc()) {
        return $row['value'];
    }
    return $default;
}

/**
 * Utility: set plugin config
 */
function plugin_tiao_setConfig($key, $value) {
    global $DB;
    $table = 'glpi_plugin_tiao_configs';
    $DB->queryOrDie(
        "REPLACE INTO `{$table}` (`name`,`value`) VALUES ('".
        addslashes($key)."','".addslashes($value)."')",
        "Error saving config {$key}"
    );
}

/**
 * Register hooks and install routines
 */
function plugin_init_tiao() {
    global $PLUGIN_HOOKS;
    // Install/uninstall routines
    $PLUGIN_HOOKS['install']['tiao']     = 'plugin_tiao_install';
    $PLUGIN_HOOKS['uninstall']['tiao']   = 'plugin_tiao_uninstall';

    // Add entry in Plugins menu
    $PLUGIN_HOOKS['menu_toadd']['tiao']  = [
        'title'   => 'Tião Dashboard',
        'page'    => 'front/dashboard.php',
        'icon'    => 'fas fa-robot',
        'parents' => ['plugin']  // agora plural, conforme padrão
    ];  

    // Config page callback
    $PLUGIN_HOOKS['config_page']['tiao'] = 'plugin_tiao_config_page';

    // Inject chat UI into ticket form
    $PLUGIN_HOOKS['post_item_form']['tiao'] = 'plugin_tiao_post_item_form';

    // CSRF compliance
    $PLUGIN_HOOKS['csrf_compliant']['tiao'] = true;
}

/**
 * Configuration page renderer
 */
function plugin_tiao_config_page() {
    include __DIR__ . '/../front/config.form.php';
}

/**
 * Inject chat container and assets into item forms
 */
function plugin_tiao_post_item_form(CommonGLPI $item, array $options = []) {
    echo "<div id='tiao-chat-root'></div>";
    echo Html::script('plugins/tiao/front/js/chat.js');
    echo Html::css('plugins/tiao/front/css/chat.css');
}
?>
