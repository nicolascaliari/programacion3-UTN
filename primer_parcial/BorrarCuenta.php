<?php

include "cuenta.php";
function BorrarCuenta($_DELETE, $rutaImagenBackup, $rutaImagenCuenta)
{ {
        if (!isset($_DELETE["numeroCuenta"]) || !isset($_DELETE["tipoCuenta"])) {
            echo "Error en los parámetros recibidos.";
            return;
        }
        $numeroCuenta = $_DELETE["numeroCuenta"];
        $tipoCuenta = $_DELETE["tipoCuenta"];

        echo "Numero de cuenta: ", $numeroCuenta, "<br>";
        echo "Tipo de cuenta: ", $tipoCuenta, "<br>";

        $cuenta = Cuenta::CuentaExiste($numeroCuenta, $tipoCuenta);


        echo "antes";
        // var_dump($rutaImagenCuenta);
        $imagenOrigen = $cuenta->DefinirDestinoImagen($rutaImagenCuenta);
        var_dump($imagenOrigen);
        echo "despues";
        $imagenBorrada = $cuenta->DefinirDestinoImagen($rutaImagenBackup);
        var_dump($imagenBorrada);

        echo "lala";
        if (rename($imagenOrigen, $imagenBorrada)) {
            echo "Se guardo la imagen en: ", $imagenBorrada;
        } else {
            $errorInfo = error_get_last();
            echo "No se pudo mover la imagen. Detalles del error:";
            echo "<pre>";
            print_r($errorInfo);
            echo "</pre>";
        }
    }
}

?>