<?php

function save_client_metadata($post_id) {

    // Evitar autoguardado
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    // Verificar y guardar correo
    if (isset($_POST['client_email'])) {
        update_post_meta($post_id, '_client_email', sanitize_email($_POST['client_email']));
    }

    // Guardar origen temporalmente en postmeta
    if (isset($_POST['client_source'])) {

        $origen = sanitize_text_field($_POST['client_source']);

        global $wpdb;
        $table_name = $wpdb->prefix . 'clientes_extra';

        // Se verifica si ya existe un registro para ese post
        $exist = $wpdb->get_var( $wpdb->prepare(
            "SELECT COUNT(*) FROM $table_name WHERE post_id = %d",
            $post_id
        ));

        if($exist){

            // Si ya existe, actualiza
            $wpdb->update(
                $table_name,
                ['origen_cliente' => $origen],
                ['post_id' => $post_id]
            );

        } else {

            // Si no existe, inserta
            $wpdb->insert(
                $table_name,
                [
                    'post_id' => $post_id,
                    'origen_cliente' => $origen
                ]
            );
        }
    }
}

add_action('save_post_cliente', 'save_client_metadata');