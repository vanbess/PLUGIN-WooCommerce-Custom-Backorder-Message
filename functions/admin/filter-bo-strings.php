<?php

/**
 * Filters/replaces product backorder text and replaces with either global or product specific override IF these are present
 * 
 * @author WC Bessinger <dev@silverbackdev.co.za>
 */

/**
 * Filter backorder text and conditionally replace with our own
 * 
 * @param array $availability - availability status array for product
 * @param object $product - WC product object
 */
function sbwc_cbom_bo_text($availability, $product) {

//    $test = wc_get_product($prod_id);
//    $test->get_par
    // if product is on backorder, conditionally add custom bo text, else...
    if ( $product->is_on_backorder() ):

        // retrieve global backorder override text
        $global_boor_text = get_option( 'sbwc_cbom_global_txt' );

        // *****************************************
        // if product has parent [variable product]
        // *****************************************
        if ( $product->get_parent_id() ):

            // retrieve parent id
            $parent_id = $product->get_parent_id();

            // retrieve backorder override text
            $product_boor_text = get_post_meta( $parent_id, '_sbwc_cbom_override_text', true );

            // if neither global or product specific override text is present, return default text, else...
            if ( !$global_boor_text && !$product_boor_text ):
                return $availability;
            endif;

            // if global override text is available, but NOT product specific override text, 
            // replace availability text with global
            if ( $global_boor_text && !$product_boor_text ):
                $availability[ 'availability' ] = pll__( $global_boor_text );
                return $availability;
            endif;

            // if product specific override is available, override
            if ( $product_boor_text ):
                $availability[ 'availability' ] = pll__( $product_boor_text );
                return $availability;
            endif;

        // *************************************************
        // if product does not have parent [simple product]
        // *************************************************
        else:

            // retrieve product id
            $prod_id = $product->get_parent_id();

            // retrieve backorder override text
            $product_boor_text = get_post_meta( $prod_id, '_sbwc_cbom_override_text', true );

            // if neither global or product specific override text is present, return default text, else...
            if ( !$global_boor_text && !$product_boor_text ):
                return $availability;
            endif;

            // if global override text is available, but NOT product specific override text, 
            // replace availability text with global
            if ( $global_boor_text && !$product_boor_text ):
                $availability[ 'availability' ] = pll__( $global_boor_text );
                return $availability;
            endif;

            // if product specific override is available, override
            if ( $product_boor_text ):
                $availability[ 'availability' ] = pll__( $product_boor_text );
                return $availability;
            endif;

        endif;

    // ...simply return default bo text
    else:
        return $availability;
    endif;
}

add_filter( 'woocommerce_get_availability', 'sbwc_cbom_bo_text', 9999, 2 );