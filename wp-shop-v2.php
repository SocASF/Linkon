<?php
/*
@author LxingA
@project OXXO
@name Herramientas
@date 16/05/24 02:00AM
@since 2.0.0
@description Obtención de la Información de una Tienda desde la Base de Datos mediante su CR
*/
error_reporting(0);

function f5b580072($p4772bd92 = false, $pdbe385aa = [], $paea34913 = "79dcdd47"){
    return json_encode([
        "ac449079b" => $p4772bd92,
        "a7b1311b0" => $pdbe385aa,
        "aeb3f4afe" => trim($paea34913)
    ], true);
}

if(isset($_SERVER["CONTENT_TYPE"])){
    switch(trim($_SERVER["CONTENT_TYPE"])){
        case "application/json":
            if($p1d775834 = json_decode(trim(@file_get_contents("php://input")),true)){
                $p2cb45923 = new mysqli(s6c5c192c,s2ee8dc98,s6d0bdef5,sfd5874d7);
                if($p2cb45923->connect_errno) echo(f5b580072(false,[],"c099ec86"));
                else{
                    $pc3c6bfe6 = $p1d775834["r8a90aba9"];
                    if($p8283ef00 = $p2cb45923->query("SELECT ID FROM wp_users WHERE user_login LIKE '%$pc3c6bfe6%' LIMIT 50")){
                        $p7c2741a0 = [];
                        while($pc7a2ec1b = $p8283ef00->fetch_row()) array_push($p7c2741a0,$pc7a2ec1b[0]);
                        if(gettype($p7c2741a0) === "NULL" || (gettype($p7c2741a0) === "integer" && count($p7c2741a0) == 0)) echo(f5b580072(false,[],"b311a667"));
                        else{
                            $p6565c8d9 = [
                                "billing_first_name" => "billing_first_name",
                                "billing_last_name" => "billing_last_name",
                                "billing_company" => "billing_company",
                                "billing_address_1" => "billing_address_1",
                                "billing_address_2" => "billing_address_2",
                                "billing_city" => "billing_city",
                                "billing_state" => "billing_state",
                                "billing_phone" => "billing_phone",
                                "billing_postcode" => "billing_postcode",
                                "billing_email" => "billing_email",
                                "shipping_first_name" => "shipping_first_name",
                                "shipping_last_name" => "shipping_last_name",
                                "shipping_company" => "shipping_company",
                                "shipping_address_1" => "shipping_address_1",
                                "shipping_address_2" => "shipping_address_2",
                                "shipping_city" => "shipping_city",
                                "shipping_state" => "shipping_state",
                                "shipping_phone" => "shipping_phone",
                                "shipping_postcode" => "shipping_postcode",
                                "shipping_email" => "shipping_email"
                            ];
                            $p340e3232 = [];
                            for($k = 0; $k <= (count($p7c2741a0) - 1); $k++){
                                $pad990844 = $p7c2741a0[$k];
                                if($p8f43dec4 = $p2cb45923->query("SELECT meta_key, meta_value FROM wp_usermeta WHERE user_id = '$pad990844'")) while($p34a64fc8 = $p8f43dec4->fetch_assoc()){
                                    if(array_key_exists($p34a64fc8["meta_key"],$p6565c8d9)) for($y = 0; $y <= (count($p6565c8d9) - 1); $y++){
                                        if($p34a64fc8["meta_key"] == array_keys($p6565c8d9)[$y]) $p340e3232[hash("crc32b",$pad990844)][array_values($p6565c8d9)[$y]] = $p34a64fc8["meta_value"];
                                    }
                                }else continue;
                            }
                            echo(f5b580072(true,$p340e3232,"79dcdd47"));
                            exit();
                        }
                    }else echo(f5b580072(false,[],"7aa0d354"));
                }
            }else echo(f5b580072(false,[],"f484662b"));
        break;
        default:
            echo(f5b580072(false,[],"d73019ca"));
        break;
    }
}else echo(f5b580072(false,[],"dc091893"));

?>