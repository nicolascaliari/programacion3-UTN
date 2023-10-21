<?php
include './cuenta.php';
include './deposito.php';
function depositar($pathImagen)
{
    if (!isset($_POST["tipoCuenta"]) || !isset($_POST["numeroCuenta"]) || !isset($_POST["moneda"]) || !isset($_POST["importe"]) || !isset($_FILES["imagen"])) {
        echo "error en los parametros recibidos";
    } else {
        $tipoCuenta = $_POST["tipoCuenta"];
        $numeroCuenta = $_POST["numeroCuenta"];
        $moneda = $_POST["moneda"];
        $importe = $_POST["importe"];
        $imagen = $_FILES["imagen"];

        $cuenta = Cuenta::CuentaExiste($numeroCuenta);

        if ($cuenta !== false) {
            $cuenta->ActualizarSaldo($importe);

            $depositos = Deposito::LeerJSONDeposito();
            $deposito = new Deposito(1, date("d-m-Y"), $importe, $tipoCuenta, $numeroCuenta, $moneda);
            $depositos[] = $deposito;
            Deposito::EscribirJSONDeposito($depositos);
            echo "Se dio de alta correctamente";

            if (move_uploaded_file($imagen['tmp_name'], $deposito->DestinoImagenDeposito($pathImagen))) {
                echo "Se guardo la imagen";
            } else {
                echo "No se pudo guardar la imagen";
            }
        } else {
            echo "no existe la cuenta";
        }

    }

}
?>