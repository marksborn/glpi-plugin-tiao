<?php
if (!defined('GLPI_ROOT')) {
    die("Sorry. You can't access directly");
}
include_once GLPI_ROOT . '/inc/includes.php';

/**
 * Register hooks and install routines
 */
function plugin_init_tiao() {
    global $PLUGIN_HOOKS;

    // Install/uninstall routines
    $PLUGIN_HOOKS['install']['tiao']   = 'plugin_tiao_install';
    $PLUGIN_HOOKS['uninstall']['tiao'] = 'plugin_tiao_uninstall';

    // Add entry in Plugins menu
    $PLUGIN_HOOKS['menu_toadd']['tiao'] = [
        'title'   => 'Tião Dashboard',
        'page'    => 'front/dashboard.php',
        'icon'    => 'fas fa-robot',
        'parents' => ['plugins']
    ];

    // Inject chat UI into ticket form
    $PLUGIN_HOOKS['post_item_form']['tiao'] = 'plugin_tiao_post_item_form';

    // CSRF compliance
    $PLUGIN_HOOKS['csrf_compliant']['tiao'] = true;
}

/**
 * Create plugin-specific database table
 */
function plugin_tiao_install() {
    global $DB;
    // Use explicit table name to match GLPI convention
    $table = 'glpi_plugin_tiao_messages';

    if (! $DB->tableExists($table)) {
        $query = "CREATE TABLE `{$table}` (
            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `phone` VARCHAR(255) DEFAULT NULL,
            `message` TEXT DEFAULT NULL,
            `origin` VARCHAR(255) DEFAULT NULL,
            `direction` VARCHAR(16) DEFAULT NULL,
            `username` VARCHAR(255) DEFAULT NULL,
            `item_id` INT UNSIGNED DEFAULT NULL,
            `date` TIMESTAMP NULL DEFAULT NULL,
            `status` TEXT DEFAULT NULL,
            `contact_id` VARCHAR(32) DEFAULT NULL,
            `contact_glpi_id` INT UNSIGNED DEFAULT NULL,
            `side` INT(11) DEFAULT 0,
            `todoist_id` VARCHAR(10) DEFAULT NULL,
            `tech_id` VARCHAR(100) DEFAULT NULL,
            `role` VARCHAR(100) DEFAULT NULL,
            `document_id` INT UNSIGNED DEFAULT NULL,
            `file_id` VARCHAR(100) DEFAULT NULL,
            `message_id` VARCHAR(100) DEFAULT NULL,
            `document_type` VARCHAR(100) DEFAULT NULL,
            `glpi_id` VARCHAR(100) DEFAULT NULL,
            `comment_id` VARCHAR(100) DEFAULT NULL,
            `bot_id` VARCHAR(100) DEFAULT NULL,
            `bot_service` VARCHAR(100) DEFAULT NULL,
            `thread_id` VARCHAR(100) DEFAULT NULL,
            `task_id` VARCHAR(100) DEFAULT NULL,
            `waiting` INT(11) DEFAULT 0,
            PRIMARY KEY (`id`),
            INDEX (`item_id`),
            INDEX (`message_id`)
        ) ENGINE=InnoDB COLLATE='utf8mb4_unicode_ci'";
        $DB->queryOrDie($query, "Error creating {$table} table");
    }
    return true;
}

/**
 * Drop plugin-specific database table
 */
function plugin_tiao_uninstall() {
    global $DB;
    // Use explicit table name
    $table = 'glpi_plugin_tiao_messages';

    if ($DB->tableExists($table)) {
        $DB->queryOrDie("DROP TABLE `{$table}`", "Error dropping {$table} table");
    }
    return true;
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
