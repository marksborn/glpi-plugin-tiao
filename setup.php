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
 * Post-installation configuration checks
 */
function plugin_tiao_check_config() {
    // Verifique aqui chaves de API ou dependências de configuração
    return true;
}
?>
