<?php
include './cuenta.php';
function consultarCuenta(){
    if(!isset($_POST["tipoCuenta"]) || !isset($_POST["numeroCuenta"])){
        return 'Error. Faltan parametros para la consulta de la venta.';
    }else{
        $tipoCuenta = $_POST["tipoCuenta"];
        $numeroCuenta = $_POST["numeroCuenta"];
        $cuentaConsultada = Cuenta::CuentaExiste($numeroCuenta,$tipoCuenta);
        if($cuentaConsultada){
            if($cuentaConsultada->TipoCuentaCorresponde($tipoCuenta)){
                return 'La moneda de la cuenta consultada es '.$cuentaConsultada->moneda.' y su saldo es de '.$cuentaConsultada->saldo;
            }
            return 'Tipo de cuenta incorrecto';
        }else{
            return 'No existe la cuenta';
        }
    }
}
?>