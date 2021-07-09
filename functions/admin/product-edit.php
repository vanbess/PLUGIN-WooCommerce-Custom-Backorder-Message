<?php
/**
 * Adds option to add custom backorder text to individual products. 
 * Text added to products themselves will override any text defined on the plugin settings page.
 * 
 * @author WC Bessinger <dev@silverbackdev.co.za>
 */
// Add tab to product edit screen metabox
add_filter( 'woocommerce_product_data_tabs', 'sbwc_cbom_text_tab', 99, 1 );

function sbwc_cbom_text_tab($product_data_tabs) {
    $product_data_tabs[ 'sbwc-cbom-text' ] = array(
            'label'  => __( 'Custom Backorder Text', 'woocommerce' ),
            'target' => 'sbwc_cbom_custom_text'
    );
    return $product_data_tabs;
}

// Add custom backorder message textarea input
add_action( 'woocommerce_product_data_panels', 'sbwc_cbom_data_fields' );

function sbwc_cbom_data_fields() {

    global $post;
    $post_id = $post->ID;
    ?>

    <div id="sbwc_cbom_custom_text" class="panel woocommerce_options_panel">
        <div class="sbwc_cbom_text_input_product" style="padding: 15px;">
            <label id="sbwc-cbom-input-label"><?php _e( 'Enter your custom backorder text for this product below. Leave empty to disable.', 'woocommerce' ); ?></label>
            <textarea id="_sbwc_cbom_override_text" name="_sbwc_cbom_override_text" rows="5" cols="100"><?php echo get_post_meta( $post_id, '_sbwc_cbom_override_text', true ); ?></textarea>
        </div>

        <style>
            #_sbwc_cbom_override_text{
                float: none;
                height: revert;
                line-height: revert;
            }

            #sbwc-cbom-input-label{
                float: none;
                margin: revert;
                width: revert;
                font-weight: 500;
                display: block;
                margin-bottom: 10px;
            }
        </style>

    </div
    <?php
}

// Save custom backorder message
add_action( 'woocommerce_process_product_meta', 'sbwc_cbom_save_custom_backorder_message' );

function sbwc_cbom_save_custom_backorder_message($post_id) {
    // save the text field data
    if ( isset( $_POST[ '_sbwc_cbom_override_text' ] ) ):
        
        // update post meta
        update_post_meta( $post_id, '_sbwc_cbom_override_text', esc_attr( trim( $_POST[ '_sbwc_cbom_override_text' ] ) ) );

        // translate submitted string
        $translate = $_POST[ '_sbwc_cbom_override_text' ];
        do_action('sbwc_cbom_translate',$translate);

    endif;
}
