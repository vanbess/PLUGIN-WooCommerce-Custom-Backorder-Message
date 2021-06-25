<?php

/**
 * Filters product backorder strings if custom backorder string is present
 * 
 * @author WC Bessinger <dev@silverbackdev.co.za>
 */

//pll_register_string("sold_out_text", 'Temporarily Out of Stock. Back in 5 to 7 Days. Available for Preorder!', "Woocommerce");
function backorder_text($availability, $product) {
	//$replace_text = array('Temporarily Out of Stock. Back in 5 to 7 Days. Available for Preorder!', '売り切れ中です。5-7営業日で再入荷します。予約はこちらから。', 'Vorübergehend nicht auf Lager. Verfügbar für Vorbestellungen mit Versand am 21. Februar 2018!');
  	//$replace_text = array('Temporarily Out of Stock. Available for Preorder and Will Ship on February 21, 2018!', '売り切れ中です。予約はこちらから。2018年2月21日に発送します。', 'Vorübergehend nicht auf Lager. Verfügbar für Vorbestellungen mit Versand am 21. Februar 2018!');
  
  
	$country_code = $_SERVER["HTTP_CF_IPCOUNTRY"];
  
	$search_text = array('Available on backorder', '取り寄せの注文(予約注文など)が利用できます', 'Verfügbar bei Nachlieferung', 'Disponible sur commande', 'Disponible para reserva', 'Disponibile su ordinazione', "允許無庫存下單");
  
  	$max_black_ids = array(44841, 44541, 49299, 49340, 49360, 49315, 329013, 306130);
  	$max_blue_ids = array(44539, 44843, 49301, 49317, 49342, 49362, 306134, 329014);
  	//$siena_ids = array(8494, 9031, 8495,10054,10055,10056,10072,10073,10074,10901,10902,10903,10741,10742,10743,11625,11626,11627);
  	$siena_parent_ids = array(8493, 10053, 10071, 10900, 11624, 18640, 20111, 16753, 20115, 20119);
  
	//if (in_array($product->get_id(), $max_blue_ids)){
  
	if (in_array($product->get_parent_id(), $siena_parent_ids)){
	  $replace_text = array('Temporarily Out of Stock. Available for Preorder and Will Ship on Sep 14', '売り切れ中です。予約はこちらから。9月14日に発送します。', 'Vorübergehend nicht auf Lager. Verfügbar für Vorbestellungen mit Versand am 14. September!', 'Temporairement en Rupture de Stock. Disponible en précommande, il sera envoyé le 14 septembre 2019 !', 'está actualmente fuera de stock. Disponible a pedir de antemano, entregaremos el 14 de septiembre 2019', 'Scorta temporaneamente esaurita. Disponibile per preordini e verrà spedito il 14 settembre', "暫時無庫存。可預訂，9月14日發貨。");
	}
  
  /*
  	if ($country_code == "JP"){
  
	  if (in_array($product->get_parent_id(), $siena_parent_ids)){
		  $replace_text = array('Temporarily Out of Stock. Available for Preorder and Will Ship on Sep 6', '売り切れ中です。予約はこちらから。9月6日に発送します。', 'Vorübergehend nicht auf Lager. Verfügbar für Vorbestellungen mit Versand am 6. September!', 'Temporairement en Rupture de Stock. Disponible en précommande, il sera envoyé le 6 septembre 2019 !', 'está actualmente fuera de stock. Disponible a pedir de antemano, entregaremos el 6 de septiembre 2019', 'Scorta temporaneamente esaurita. Disponibile per preordini e verrà spedito il 6 settembre', "暫時無庫存。可預訂，9月6日發貨。");
	  }
	  
	  
	} else {
  
	  if (in_array($product->get_parent_id(), $siena_parent_ids)){
		  $replace_text = array('Temporarily Out of Stock. Available for Preorder and Will Ship on Feb 1', '', '', '', 'está actualmente fuera de stock. Disponible a pedir de antemano, entregaremos el 7 de octubre 2019', 'Scorta temporaneamente esaurita. Disponibile per preordini e verrà spedito il 7 ottobre  2019', "暫時無庫存。可預訂，十月7日發貨。");
		
		//$replace_text = array('Temporarily Out of Stock. Available for Preorder and Will Ship on Oct 7', '売り切れ中です。予約はこちらから。10月4日に発送します。', 'Vorübergehend nicht auf Lager. Verfügbar für Vorbestellungen mit Versand am 7. Oktober!', 'Temporairement en Rupture de Stock. Disponible en précommande, il sera envoyé le 7 octobre 2019 !', 'está actualmente fuera de stock. Disponible a pedir de antemano, entregaremos el 7 de octubre 2019', 'Scorta temporaneamente esaurita. Disponibile per preordini e verrà spedito il 7 ottobre  2019', "暫時無庫存。可預訂，十月7日發貨。");
	  }
	  
	}
  */
  /*
  else {
  		$replace_text = array('Temporarily Out of Stock. Available for Preorder and Will Ship on Oct 11', '売り切れ中です。予約はこちらから。10月11日に発送します。', 'Vorübergehend nicht auf Lager. Verfügbar für Vorbestellungen mit Versand am 11. Oktober!', 'Temporairement en Rupture de Stock. Disponible en précommande, il sera envoyé le 11 octobre 2018 !', 'está actualmente fuera de stock. Disponible a pedir de antemano, entregaremos el 11 de octubre 2018', 'Scorta temporaneamente esaurita. Disponibile per preordini e verrà spedito il 11 ottobre 2018');
	  
	}
*/
  
	//$search_text = array('Available on backorder', '取り寄せの注文(予約注文など)が利用できます', 'Verfügbar bei Nachlieferung', 'Disponible sur commande', 'Disponible para reserva', 'Disponibile su ordinazione');
  	//$replace_text = array('Temporarily Out of Stock. Available for Preorder!', '売り切れ中です。予約はこちらから。', 'Vorübergehend nicht auf Lager. Verfügbar für Vorbestellungen!', 'Temporairement en Rupture de Stock. Disponible en précommande !', 'está actualmente fuera de stock. Disponible a pedir de antemano!', 'Scorta temporaneamente esaurita. Disponibile per preordini!');
  	if (isset($replace_text)){
	  foreach($availability as $i) {
		  $availability = str_replace($search_text, $replace_text, $availability);
	  }
	}
    return $availability;
}
add_filter('woocommerce_get_availability', 'backorder_text', 9999, 2);

add_filter( 'woocommerce_get_availability_text', 'filter_product_availability_text', 10, 2 );
function filter_product_availability_text( $availability, $product ) {

    if( $product->backorders_require_notification() ) {
	  	$search_text = array("(can be backordered)", "(允許無庫存下單)", "(kann nachgeliefert werden)", "(peut être commandé)", "(ordinabile)", "(puede reservarse)", "(入荷待ちすることができます)", "(품절 후 주문 가능)", "(pode ser encomendado)", "(может быть предзаказано)", "(يمكن الحجز)");
        $availability = str_replace($search_text, '', $availability);
    }
    return $availability;
}


