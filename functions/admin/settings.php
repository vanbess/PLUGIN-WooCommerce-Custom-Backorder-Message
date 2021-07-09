<?php

/**
 * Adds custom backorder message settings page to wordpress backend
 * 
 * @author WC Bessinger <dev@silverbackdev.co.za>
 */
function sbwc_cbom_settings() {
    add_submenu_page( 'woocommerce', __( 'Custom Backorder Text', 'woocommerce' ), __( 'Custom Backorder Text', 'woocommerce' ), 'manage_options', 'sbwc-cbom-settings', 'sbwc_cbom_settings_render', 1 );
}

add_action( 'admin_menu', 'sbwc_cbom_settings' );

// render settings page
function sbwc_cbom_settings_render() {

    // if global override text present save, else...
    if ( !empty( $_POST[ 'cbom-text' ] ) ):
        update_option( 'sbwc_cbom_global_txt', $_POST[ 'cbom-text' ] );

    // ...delete global text
    elseif ( isset( $_POST[ 'cbom-text-save' ] ) && empty( $_POST[ 'cbom-text' ] ) ):
        delete_option( 'sbwc_cbom_global_txt' );
    endif;

    // save review text
    if ( !empty( $_POST[ 'cbom-rating-text' ] ) ):
        update_option( 'sbwc_cbom_review_txt', $_POST[ 'cbom-rating-text' ] );

    // delete review text
    elseif ( isset( $_POST[ 'cbom-text-save' ] ) && empty( $_POST[ 'cbom-rating-text' ] ) ):
        delete_option( 'sbwc_cbom_review_txt' );
    endif;

    // save atc text
    if ( !empty( $_POST[ 'cbom-atc-text' ] ) ):
        update_option( 'sbwc_cbom_atc_txt', $_POST[ 'cbom-atc-text' ] );

    // delete atc text
    elseif ( isset( $_POST[ 'cbom-text-save' ] ) && empty( $_POST[ 'cbom-atc-text' ] ) ):
        delete_option( 'sbwc_cbom_atc_txt' );
    endif;
    ?>
    <div class="sbwc-cbom-settings">

        <!-- heading -->
        <h2><?php _e( 'Custom Backorder Text Settings', 'woocommerce' ); ?></h2>

        <form action="#" method="post">

            <!-- message input -->
            <p>
                <label>
                    <b><?php _e( 'Enter <b><i>GLOBAL</i></b> custom product backorder message in <b><i>English</i></b> below. Leave empty and save to disable.', 'woocommerce' ); ?></b>
                </label>
            </p>
            <textarea id="cbom-text" name="cbom-text" rows="5" cols="100"><?php echo get_option( 'sbwc_cbom_global_txt' ); ?></textarea>
            <br>
            <span>
                <?php _e( '<b><i><u>NOTE: </u></i></b> Per product backorder text can be defined on individual product edit screen and will override this text if defined.', 'woocommerce' ); ?>
            </span>
            <br>
            <br>

            <!-- below star rating -->
            <p>
                <label>
                    <b><?php _e( 'Enter message to be displayed below product star rating. Leave empty and save to disable.', 'woocommerce' ); ?></b>
                </label>
            </p>
            <textarea id="cbom-rating-text" name="cbom-rating-text" rows="5" cols="100"><?php echo get_option( 'sbwc_cbom_review_txt' ); ?></textarea>
            <br>
            <br>

            <!-- above add to cart button -->
            <p>
                <label>
                    <b><?php _e( 'Enter message to be displayed below add to cart button. Leave empty and save to disable.', 'woocommerce' ); ?></b>
                </label>
            </p>
            <textarea id="cbom-atc-text" name="cbom-atc-text" rows="5" cols="100"><?php echo get_option( 'sbwc_cbom_atc_txt' ); ?></textarea>
            <br>
            <br>

            <!-- submit -->
            <button id="cbom-text-save" name="cbom-text-save" value="save-global-cbom" type="submit" class="button button-primary">
                <?php _e( 'Save Settings', 'woocommerce' ); ?>
            </button>

        </form>

    </div>
    <?php
}
