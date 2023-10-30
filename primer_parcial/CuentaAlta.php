<?php
include './cuenta.php';
include './Validador.php';
function cuentaAlta($ruta)
{
    if (!isset($_POST["nombre"]) || !isset($_POST["tipoDoc"]) || !isset($_POST["numeroDoc"]) || !isset($_POST["mail"]) || !isset($_POST["tipoCuenta"]) || !isset($_POST["saldo"]) || !isset($_FILES["imagen"])) {
        return 'Error. Faltan parametros para el alta de venta.';
    } else {
        $nombre = $_POST['nombre'];
        $tipoDoc = $_POST['tipoDoc'];
        $numeroDoc = $_POST['numeroDoc'];
        $mail = $_POST['mail'];
        $tipoCuenta = $_POST['tipoCuenta'];
        $saldo = $_POST['saldo'];
        $imagen = $_FILES['imagen'];

        if (ValidarTipoCuenta($tipoCuenta) !== false) {
            $cuenta = new Cuenta($nombre, $tipoDoc, $numeroDoc, $mail, $tipoCuenta, $saldo);
            if ($cuenta->ActualizarSaldo($saldo) == false) {
                echo "hola";
                $cuentas = Cuenta::LeerJSONCuenta();
                echo "hola";
                $cuentaAlta = new Cuenta($nombre, $tipoDoc, $numeroDoc, $mail, $tipoCuenta, $saldo);
                $cuentas[] = $cuentaAlta;
                Cuenta::EscribirJSONCuenta($cuentas);
                $respuesta = 'Se dió de alta la cuenta. ';
                if (move_uploaded_file($imagen['tmp_name'], $cuenta->DefinirDestinoImagen($ruta))) {
                    $respuesta = $respuesta . ' ' . 'Se guardó la imagen';
                } else {
                    $respuesta = $respuesta . ' ' . 'La imagen no pudo ser guardada';
                }
            } else {
                $respuesta = 'La cuenta ya existe, y su saldo fue actualizado';
            }
        } else {
            $respuesta = 'Error. Tipo de cuenta o moneda invalidos';
        }


    }

    return $respuesta;
}

?>