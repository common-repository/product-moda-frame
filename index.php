<?php
/**
 * Plugin Name: Product Moda Frame
 * Description: Replace product moda shortcode with iframe
 * Version: 1.0
 * Author: agemedia3
 */

require(__DIR__ ."/admin.php");

add_action( 'woocommerce_product_options_general_product_data', 'pmf_woocommerce_product_custom_fields' ); 
// Following code Saves  WooCommerce Product Custom Fields
add_action( 'woocommerce_process_product_meta', 'pmf_woocommerce_product_custom_fields_save' );
add_action('woocommerce_before_add_to_cart_button', 'pmf_woocommerce_custom_fields_display');

function pmf_woocommerce_product_custom_fields () {
    global $woocommerce, $post;
    echo '<div class=" product_custom_field ">';
    woocommerce_wp_text_input(
        array(
          'id'          => '_product_moda_id',
          'label'       => __( 'Product Moda ID', 'productmoda' ),
          'placeholder' => 'ID from Product Moda',
          'desc_tip'    => 'true'
        )
    );
    echo '</div>';
}

function pmf_woocommerce_product_custom_fields_save($post_id)
{
    $woocommerce_custom_product_text_field = sanitize_text_field($_POST['_product_moda_id']);
    if (!empty($woocommerce_custom_product_text_field))
        update_post_meta($post_id, '_product_moda_id', esc_attr($woocommerce_custom_product_text_field));
}



function pmf_woocommerce_custom_fields_display()
{
    global $post;
    $product = wc_get_product($post->ID);
        $_product_moda_id = $product->get_meta('_product_moda_id');
    if ($_product_moda_id) {
        $_product_moda_key = get_option( 'product_moda_frame_settings' );

      printf(
            '<div><iframe src="http://productmoda.com/embed/q=%s&d=%s"></iframe></div>',
            esc_html($_product_moda_id),
            esc_html($_product_moda_key['product_moda_frame_product_moda_id'])
      );
  }
}