<?php
if (!defined('GLPI_ROOT')) {
    die("Sorry. You can't access directly");
}

/**
 * Plugin metadata and version
 */
function plugin_version_tiao() {
    return [
        'name'         => 'Tião',
        'version'      => '0.1.0',
        'author'       => 'Marcos Nascimento',
        'homepage'     => 'https://itscontrol.com.br',
        'license'      => 'GPLv2+',
        'text'         => 'Tião – Técnico com Inteligência Artificial Omnimodal',
        'requirements' => ['glpi' => ['min' => '10.0.0']]
    ];
}

/**
 * Pre-installation checks
 */
function plugin_tiao_check_prerequisites() {
    if (version_compare(GLPI_VERSION, '10.0.0', '<')) {
        echo "O plugin Tião requer GLPI ≥ 10.0.0";
        return false;
    }
    return true;
}

/**
 * Installation: create plugin-specific tables
 */
function plugin_tiao_install() {
    global $DB;
    // Use nomes explícitos no padrão glpi_plugin_<chave>_<sufixo>
    $msgTable = 'glpi_plugin_tiao_messages';
    if (! $DB->tableExists($msgTable)) {
        $DB->queryOrDie(
            "CREATE TABLE `{$msgTable}` (
                `id`        INT UNSIGNED NOT NULL AUTO_INCREMENT,
                `phone`     VARCHAR(255) DEFAULT NULL,
                `message`   TEXT DEFAULT NULL,
                `origin`    VARCHAR(255) DEFAULT NULL,
                `direction` VARCHAR(16)  DEFAULT NULL,
                `username`  VARCHAR(255) DEFAULT NULL,
                `item_id`   INT UNSIGNED DEFAULT NULL,
                `date`      TIMESTAMP     NULL DEFAULT NULL,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB COLLATE='utf8mb4_unicode_ci'",
            "Error creating {$msgTable} table"
        );
    }

    $cfgTable = 'glpi_plugin_tiao_configs';
    if (! $DB->tableExists($cfgTable)) {
        $DB->queryOrDie(
            "CREATE TABLE `{$cfgTable}` (
                `name`  VARCHAR(64) NOT NULL,
                `value` TEXT,
                PRIMARY KEY (`name`)
            ) ENGINE=InnoDB COLLATE='utf8mb4_unicode_ci'",
            "Error creating {$cfgTable} table"
        );
    }

    return true;
}

/**
 * Uninstallation: drop plugin-specific tables
 */
function plugin_tiao_uninstall() {
    global $DB;
    $DB->queryOrDie(
        "DROP TABLE IF EXISTS `glpi_plugin_tiao_messages`",
        "Error dropping glpi_plugin_tiao_messages table"
    );
    $DB->queryOrDie(
        "DROP TABLE IF EXISTS `glpi_plugin_tiao_configs`",
        "Error dropping glpi_plugin_tiao_configs table"
    );
    return true;
}
