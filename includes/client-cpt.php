<?php

// Registrar CPT cliente
function registrar_cpt_cliente() {

    $args = [
        'labels' => [
            'name' => 'Clientes',
            'singular_name' => 'Cliente',
            'add_new' => 'Añadir nuevo',
            'add_new_item' => 'Añadir nuevo cliente',
            'edit_item' => 'Editar cliente',
            'new_item' => 'Nuevo cliente',
            'view_item' => 'Ver cliente',
            'search_items' => 'Buscar cliente',
            'not_found' => 'No se encontraron clientes',
            'menu_name' => 'Clientes',
        ],
        'public' => true,
        'has_archive' => true,
        'rewrite' => ['slug' => 'clientes'],
        'supports' => ['title'],
        'show_in_rest' => true // Para Gutenberg y REST
    ];

    register_post_type('cliente', $args);

}

add_action('init', 'registrar_cpt_cliente');