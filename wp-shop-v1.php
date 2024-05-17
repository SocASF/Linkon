<?php
/*
@author LxingA
@project OXXO
@name Herramientas
@date 21/11/23 09:30
@description Obtención de la Información de una Tienda desde la Base de Datos mediante su CR
*/
error_reporting(0);
function defined_object($state, $message, $container){
    return json_encode([
        "st" => $state,
        "ms" => $message,
        "py" => $container
    ],true);
}
if(isset($_GET["cr"])){
    $sql = (new mysqli(SLOCALDBHOST,SLOCALDBUSER,SLOCALDBPASS,SLOCALDBNAME));
    if($sql->connect_errno) print_r(defined_object(false,"Hubo un error desconocido a conectarse con la Base de Datos",[]));else{
        $savedCurrentCRRequest = strtoupper($_GET["cr"]);
        $getUserIDByCRSender = $sql->query("SELECT ID FROM wp_users WHERE user_login = '$savedCurrentCRRequest' LIMIT 1");
        if(!$getUserIDByCRSender) print_r(defined_object(false,$sql->error,[]));else{
            $savedIDUserFromCurrentCRSender = $getUserIDByCRSender->fetch_row();
            if(gettype($savedIDUserFromCurrentCRSender) === "NULL" || (gettype($savedIDUserFromCurrentCRSender) === "integer" && count($savedIDUserFromCurrentCRSender) === 0)) print_r(defined_object(false,"No se encontró una tienda con el CR \"$savedCurrentCRRequest\" proporcionada",[]));else{
                $savedIDUserFromCurrentCRSender = $savedIDUserFromCurrentCRSender[0];
                $getShippingInformationByIDUser = $sql->query("SELECT meta_key, meta_value FROM wp_usermeta WHERE user_id = '$savedIDUserFromCurrentCRSender'");
                if(!$getShippingInformationByIDUser) print_r(defined_object(false,$sql->error,[]));else{
                    $definedContainerWithNextFieldsRequested = [
                        "billing_first_name" => "billing_first_name",
                        "billing_last_name" => "billing_last_name",
                        "billing_company" => "billing_company",
                        "billing_address_1" => "billing_address_1",
                        "billing_address_2" => "billing_address_2",
                        "billing_city" => "billing_city",
                        "billing_state" => "billing_state",
                        "billing_phone" => "billing_phone",
                        "billing_postcode" => "billing_postcode",
                        "billing_email" => "billing_email"
                    ];$definedContainerSavedReference = [];
                    while($definedInstanceForShippingInformationIterator = $getShippingInformationByIDUser->fetch_assoc()){
                        if(array_key_exists($definedInstanceForShippingInformationIterator["meta_key"],$definedContainerWithNextFieldsRequested)){
                            for($x = 0; $x <= (count($definedContainerWithNextFieldsRequested) - 1);$x++){
                                if($definedInstanceForShippingInformationIterator["meta_key"] == array_keys($definedContainerWithNextFieldsRequested)[$x]) $definedContainerSavedReference["shopping_cr_$x"] = ["value"=>$definedInstanceForShippingInformationIterator["meta_value"],"input"=>array_values($definedContainerWithNextFieldsRequested)[$x]];
                            }
                        }
                    }$sql->close();
                    print_r(defined_object(true,"Se ha encontrado con éxito la información de la tienda asociada al CR \"$savedCurrentCRRequest\"",$definedContainerSavedReference));
                    exit();
                }
            }
    }}}else print_r(defined_object(false,"Lo sentimos, no haz especificado un CR de Tienda para consultar",[]));
?>