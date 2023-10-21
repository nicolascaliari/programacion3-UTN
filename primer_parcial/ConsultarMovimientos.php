<?php

include './deposito.php';

function ConsultarDepositoPorTipoYMoneda()
{
    if (!isset($_GET["tipoCuenta"]) || !isset($_GET["moneda"]) || !isset($_GET["fecha"])) {
        return 'Error. Faltan parametros para la consulta.';
    }else {
        $tipoCuenta = $_GET["tipoCuenta"];
        $moneda = $_GET["moneda"];
        $fecha = $_GET["fecha"];

        $depositos = Deposito::LeerJSONDeposito();
        $total = 0;
        foreach ($depositos as $deposito) {
            if ($deposito->tipoCuenta == $tipoCuenta && $deposito->moneda == $moneda && $deposito->fecha == $fecha) {
                $total += $deposito->monto;
            }
        }
        return $total;
    }
}


function ConsultarDepositosUsuario()
{

}



function ConsultarDepositosEntreFechas()
{

}



function ConsultarDepositosPorTipoCuenta()
{

}


function ConsultarDepositosPorMoneda()
{

}

?>