<?php
/**
 * Plugin Name: Woo PDF
 * Plugin URI: https://github.com/yog2515/woo-pdf
 * Description: This plugin is used to download PDF file on Order Column. Which display Customer Details. 
 * Author: Yogesh Barot
 * Author URI: https://github.com/yog2515/woo-pdf
 * License: GPL2
 * Version: 1.0 
**/
 
if ( ! defined( 'ABSPATH' ) ) exit;
define( 'WOOPDF_URI', trailingslashit( plugin_dir_url( __FILE__ ) ) );
define( 'WOOPDF_MPDF', WOOPDF_URI.'mpdf/' );

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
/**
 * Check if WooCommerce is activated
 */
if ( ! in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ){
    add_action( 'admin_notices', 'woopdf_install_woocommerce_admin_notice' );
    return;
}
function woopdf_install_woocommerce_admin_notice(){ ?>
    <div class="error">
        <p><?php _e( 'The Woo PDF plugin is enabled, but it requires WooCommerce in order to work.', 'woo-pdf' ); ?></p>
    </div>
   <?php 
}

// Adding PDF column in Order List 
add_filter( 'manage_edit-shop_order_columns', 'woopdf_add_new_order_admin_list_column' );
 
function woopdf_add_new_order_admin_list_column( $columns ) {
	print_r($coluns);
    $columns['order_pdf'] = 'Download PDF';
    return $columns;
}
 
add_action( 'manage_shop_order_posts_custom_column', 'woopdf_add_new_order_admin_list_column_content' );
 
function woopdf_add_new_order_admin_list_column_content( $column ) {   
    global $post; 
    if ( 'order_pdf' === $column ) {		
        echo '<a href="javascript:void(0);" class="pdfbtn_cls" id="'.$post->ID.'" >PDF FILE</a>';
    }
}
function woopdf_pdf_data() {
	// first check if data is being sent and that it is the data we want
  	if ( isset( $_POST["post_id"] ) ) {
		ob_start();
		// now set our response var equal to that of the POST var (this will need to be sanitized based on what you're doing with with it)
		$response = $_POST["post_id"];
		$order = wc_get_order( $response );
		//print_r($order);		
		$html='<html><head></head><body>';     				
		$html.='<table id="customers">
				<tr><th colspan="2"><strong>Customer Detail</strong></th></tr>
				<tr>
					<td>First Name</td>
					<td>'.$order->get_billing_first_name().'</td>
				</tr>
				<tr>
					<td>Last Name</td>
					<td>'.$order->get_billing_last_name().'</td>
				</tr>
				<tr>
					<td>Order Total</td>
					<td>'.$order->get_total().'</td>
				</tr>
				';
		$html.='</table></body></html>';
		ob_flush();
		
	}
}
add_action('wp_ajax_woopdf_pdf_data', 'woopdf_pdf_data');
//Enqueues Custom javascript file
add_action( 'admin_print_scripts', 'cot_customthemeoption_scripts' );
function cot_customthemeoption_scripts() {
	wp_enqueue_script( 'woopdf_custom_js', WOOPDF_URI . 'js/woopdf_custom.js', false );
}