<?php

# Añadir de preferencia en la parte final del archivo el siguiente fragmento del código (elessi-theme-child) -> (functions.php)

add_filter("woocommerce_checkout_fields","f12d839c5");

function f12d839c5($p0927b04f){
    $p0927b04f['shipping']['shipping_phone'] = [
        "label" => "Número de Télefono",
        "type" => "tel",
        "required" => true,
        "class" => [
            "form-row-wide"
        ],
        "validate" => [
            "phone"
        ],
        "autocomplete" => "tel",
        "priority" => 25
    ];return $p0927b04f;
}

# Opcional sí se quiere mostrar una entrada explicita con el número de contacto del cliente
/*add_action("woocommerce_admin_order_data_after_shipping_address","f2ad0ea4a");

function f2ad0ea4a($p312f63c0){
    echo '<p><b>Número de Teléfono:</b> ' . get_post_meta($p312f63c0->get_id(),'_shipping_phone',true) . '</p>';
}*/

?>