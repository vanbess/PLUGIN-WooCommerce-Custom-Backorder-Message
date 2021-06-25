<?php
/**
 * Adds custom backorder message settings page to wordpress backend
 * 
 * @author WC Bessinger <dev@silverbackdev.co.za>
 */
include 'register-strings.php';

function sbwc_cbom_settings() {
    add_submenu_page('woocommerce', __('Custom Backorder Message'), 'Backorder Message', 'manage_options', 'sbwc-cbom-settings', 'sbwc_cbom_settings_render', 1);
}

add_action('admin_menu', 'sbwc_cbom_settings');

// render settings page
function sbwc_cbom_settings_render() {
    ?>
    <div class="sbwc-cbom-settings">

        <!-- heading -->
        <h2><?php _e('Custom Backorder Message Settings', 'woocommerce'); ?></h2>

        <form action="#" method="post">

            <!-- message input -->
            <label><?php _e('Enter <b><i>GLOBAL</i></b> custom product backorder message in <b><i>English</i></b> below. Leave empty and save to disable.', 'woocommerce'); ?></label><br><br>
            <textarea id="cbom-message" name="cbom-message" rows="5" cols="100"></textarea><br>
            <span><?php _e('<b><i><u>NOTE: </u></i></b> Per product backorder text can be defined on individual product edit screen and will override this text if defined.', 'woocommerce'); ?></span><br><br>

            <!-- submit -->
            <button id="cbom-message-save" name="cbom-message-save" type="submit" class="button button-primary">
                <?php _e('Save Settings', 'woocommerce'); ?>
            </button>

        </form>

    </div>
    <?php
}
