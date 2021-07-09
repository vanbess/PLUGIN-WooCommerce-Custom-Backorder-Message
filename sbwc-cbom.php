<?php

/**
 * Plugin Name: SBWC Custom Backorder Message
 * Description: Allows the creation and display of custom messages on the frontend for products which are on backorder
 * Version: 1.0.0
 * Author: WC Bessinger
 */
// security
defined( 'ABSPATH' ) ?: exit();

// init
add_action( 'plugins_loaded', 'sbwc_cbom_init' );

function sbwc_cbom_init() {

    // constants
    define( 'CBOM_PATH', plugin_dir_path( __FILE__ ) );
    define( 'CBOM_URL', plugin_dir_url( __FILE__ ) );

    // admin functions
    include CBOM_PATH . 'functions/admin/settings.php';

    // product settings
    include CBOM_PATH . 'functions/admin/product-edit.php';
    
    // filter WC backorder text
    include CBOM_PATH.'functions/admin/filter-bo-strings.php';
    
    // filter global general message
    include CBOM_PATH.'functions/admin/display-alt-strings.php';
    
}