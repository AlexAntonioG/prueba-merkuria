<?php 
/*
Plugin Name: Client Plugin
Description: Plugin para gestionar clientes como CPT.
Version: 1.0
Author: Alexandro Antonio
*/

if (!defined('ABSPATH')) {
    exit;
}

// Obtiene las rutas de los archivos necesarios para el plugin
require_once plugin_dir_path(__FILE__) . 'includes/client-cpt.php';
require_once plugin_dir_path(__FILE__) . 'includes/client-metaboxes.php';
require_once plugin_dir_path(__FILE__) . 'includes/save-client.php';

// API REST para obtener clientes
require_once plugin_dir_path(__FILE__) . 'includes/client-api.php';

// Registra el bloque personalizado de Gutenberg
add_action('init', function () {
    
    require_once __DIR__ . '/blocks/client-block/render.php';
    register_block_type(__DIR__ . '/blocks/client-block', [
        'render_callback' => 'render_featured_client',
    ]);

});
