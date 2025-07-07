<?php

//Renderiza el bloque de cliente destacado y muestra la información de los clientes.
function render_featured_client($attributes) {
    
    if (empty($attributes['clientId'])) {
        return '<div style="padding:1em; border:1px dashed #ccc;">Cliente no seleccionado.</div>';
    }

    $post_id = intval($attributes['clientId']);
    $post = get_post($post_id);

    if (!$post || $post->post_type !== 'cliente') {
        return '<div style="padding:1em; color:red;">Cliente invalido seleccionado.</div>';
    }

    $name = esc_html($post->post_title);
    $email = esc_html(get_post_meta($post_id, '_client_email', true));

    // Obtiene el origen del cliente desde la tabla extra 'wp_clientes_extra'
    global $wpdb;
    $source = esc_html($wpdb->get_var(
        $wpdb->prepare(
            "SELECT origen_cliente FROM {$wpdb->prefix}clientes_extra WHERE post_id = %d",
            $post_id
        )
    ));

    $background = isset($attributes['background']) ? esc_attr($attributes['background']) : '#f9f9f9';

    ob_start(); // Esta función sirve para capturar la salida HTML y devolverla como string
    ?>

    <!-- HTML para mostrar en el renderizado -->
    <div style="background-color: <?php echo $background; ?>; padding: 1em; border-radius: 6px;">
        <strong><?php echo $name; ?></strong><br>
        <span><?php echo $email; ?></span><br>
        <small>Origen: <?php echo $source ?: 'No especificado'; ?></small>
    </div>

    <?php
    return ob_get_clean(); // Devuelve el contenido capturado como string
}