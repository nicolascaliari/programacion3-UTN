<?php
include "./cuenta.php";
function modificar()
{
    if (!isset($_POST["nombre"]) || !isset($_POST["numeroCuenta"]) || !isset($_POST["tipoDoc"]) || !isset($_POST["numeroDoc"]) || !isset($_POST["mail"]) || !isset($_POST["tipoCuenta"]) || !isset($_POST["moneda"])) {
        return "Error en los parametros";
    } else {
        $nombre = $_POST["nombre"];
        $numeroCuenta = $_POST["numeroCuenta"];
        $tipoDoc = $_POST["tipoDoc"];
        $numeroDoc = $_POST["numeroDoc"];
        $mail = $_POST["mail"];
        $tipoCuenta = $_POST["tipoCuenta"];
        $moneda = $_POST["moneda"];
        echo $nombre;
        echo $numeroCuenta;


        $buffer = new Cuenta($numeroCuenta, $nombre, $tipoDoc, $numeroDoc, $mail, $tipoCuenta, $moneda);
        $cuentaExiste = Cuenta::CuentaYaExiste($numeroCuenta);


        if ($cuentaExiste === -1) {
            return "La cuenta no existe";
        } else {
            Cuenta::ModificarCuenta($buffer, $cuentaExiste);
        }
    }
}

?>