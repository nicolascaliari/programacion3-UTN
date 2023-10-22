<?php

include "cuenta.php";
function RetiroCuenta()
{
    if (!isset($_POST["tipoCuenta"]) || !isset($_POST["moneda"]) || !isset($_POST["monto"]) || !isset($_POST["numeroCuenta"])) {
        return "Error. Faltan parametros.";

    } else {

        echo "hola";
        $numeroCuenta = $_POST["numeroCuenta"];
        $monto = $_POST["monto"];
       
    
        $cuenta = Cuenta::CuentaYaExiste($numeroCuenta);

        if ($cuenta !== false) {
            Cuenta::RetirarDinero($monto, $cuenta);
        } else {
            return "La cuenta no existe.";
        }
    }
}

?>