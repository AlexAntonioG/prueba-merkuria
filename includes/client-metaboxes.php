<?php

// Crea los metaboxes para los datos del cliente
function add_client_metaboxes() {

    add_meta_box(
        'cliente_info',
        'Información del Cliente',
        'render_client_metaboxes',
        'cliente',
        'normal',
        'default'
    );

}

add_action('add_meta_boxes', 'add_client_metaboxes');

// Renderiza los campos del metabox del cliente
function render_client_metaboxes($post) {

    $email = get_post_meta($post->ID, '_client_email', true);
   
    // Recuperación del dato origen_cliente de la tabla wp_clientes_extra
    global $wpdb;
    $table = $wpdb->prefix . 'clientes_extra';

    $source = $wpdb->get_var( $wpdb->prepare(
        "SELECT origen_cliente FROM $table WHERE post_id = %d",
        $post->ID
    ));

?>
    <p>
        <label for="client_email">Correo electrónico:</label><br>
        <input type="email" name="client_email" id="client_email" value="<?php echo esc_attr($email); ?>" style="width:100%;">
    </p>
    <p>
        <label for="client_source">Origen del cliente:</label><br>
        <select name="client_source" id="client_source" style="width:100%;">
            <?php

                // Se construye el select con las opciones requeridas
                $options = [
                    'Web' => 'Web',
                    'Feria' => 'Feria',
                    'Referido' => 'Referido'
                ];
            
                foreach($options as $value => $label){

                     printf(
                        '<option value="%s"%s>%s</option>',
                        esc_attr($value),
                        selected($source, $value, false),
                        esc_html($label)
                    );
                }

            ?>
        </select>
        <small>(Este campo luego se guardará en la tabla `wp_clientes_extra`)</small>
    </p>
    <?php
}