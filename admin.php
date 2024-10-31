<?php

add_action( 'admin_menu', 'product_moda_frame_add_admin_menu' );
add_action( 'admin_init', 'product_moda_frame_settings_init' );

function product_moda_frame_add_admin_menu(  ) {
    add_options_page( 'Product Moda Frame', 'Product Moda Frame', 'manage_options', 'product-moda-frame', 'product_moda_frame_options_page' );
}

function product_moda_frame_settings_init(  ) {
    register_setting( 'productModaPlugin', 'product_moda_frame_settings' );
    add_settings_section(
        'product_moda_frame_productModaPlugin_section',
        __( 'Product Moda Frame Settings', 'wordpress' ),
        'product_moda_frame_settings_section_callback',
        'productModaPlugin'
    );

    add_settings_field(
        'product_moda_id',
        __( 'Product Moda Key', 'wordpress' ),
        'product_moda_frame_product_moda_id_render',
        'productModaPlugin',
        'product_moda_frame_productModaPlugin_section'
    );
}

function product_moda_frame_product_moda_id_render(  ) {
    $options = get_option( 'product_moda_frame_settings' );
    ?>
<input type='text' name='product_moda_frame_settings[product_moda_frame_product_moda_id]'
    value='<?php echo $options['product_moda_frame_product_moda_id']; ?>'>
<?php
}

function product_moda_frame_settings_section_callback(  ) {
    echo __( 'Product Moda Frame Settings', 'wordpress' );
}

function product_moda_frame_options_page(  ) {
    ?>
<form action='options.php' method='post'>

    <h2>Sitepoint Settings API Admin Page</h2>

    <?php
        settings_fields( 'productModaPlugin' );
        do_settings_sections( 'productModaPlugin' );
        submit_button();
        ?>

</form>
<?php
}