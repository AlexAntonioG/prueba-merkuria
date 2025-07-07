<?php

 // Registra la API REST para obtener los clientes
add_action('rest_api_init', function () {
    register_rest_route('empresa/v1', '/clientes', [
        'methods'  => 'GET',
        'callback' => 'get_clients_company',
        'permission_callback' => '__return_true'
    ]);
});

// Obtiene los clientes de la BD y regresa la información
function get_clients_company() {
    
    $args = [
        'post_type'      => 'cliente',
        'posts_per_page' => -1,
        'post_status'    => 'publish'
    ];

    $query = new WP_Query($args);
    $clientes = [];

    global $wpdb;
    $tabla_extra = $wpdb->prefix . 'clientes_extra';

    foreach ($query->posts as $post) {
        $clientes[] = [
            'id'     => $post->ID,
            'name' => $post->post_title,
            'email' => get_post_meta($post->ID, '_client_email', true),
            'source' => $wpdb->get_var($wpdb->prepare(
                "SELECT origen_cliente FROM $tabla_extra WHERE post_id = %d",
                $post->ID
            ))
        ];
    }

    return $clientes;
}