<?php

include "cuenta.php";
include "retiro.php";
function RetiroCuenta()
{
    if (!isset($_POST["tipoCuenta"]) || !isset($_POST["moneda"]) || !isset($_POST["monto"]) || !isset($_POST["numeroCuenta"])) {
        return "Error. Faltan parametros.";

    } else {
        $numeroCuenta = $_POST["numeroCuenta"];
        $monto = $_POST["monto"];
        
        $cuenta = Cuenta::CuentaYaExiste($numeroCuenta);
        $validacionSaldo = Cuenta::VerificarSaldo($monto, $numeroCuenta);



        if ($cuenta === false) {
            return "La cuenta no existe.";
        } else if ($validacionSaldo === false) {
            return "No tiene saldo suficiente.";
        } else {
            Cuenta::RetirarDinero($monto, $cuenta);
            Retiro::AgregarDineroARetiro();
        }
    }
}

?>