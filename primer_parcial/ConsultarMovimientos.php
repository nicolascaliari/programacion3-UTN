<?php

include './deposito.php';

function ConsultarDepositoPorTipoYMoneda()
{
    if (!isset($_GET["tipoCuenta"]) || !isset($_GET["moneda"]) || !isset($_GET["fecha"])) {
        return 'Error. Faltan parametros para la consulta.';
    } else {
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
    if (!isset($_GET["numeroCuenta"])) {
        return 'Error. Faltan parametros para la consulta.';
    } else {
        $usuario = $_GET["numeroCuenta"];
        $depositos = Deposito::LeerJSONDeposito();
        $depositosUsuario = array();
        foreach ($depositos as $deposito) {
            if ($deposito->numeroCuenta == $usuario) {
                array_push($depositosUsuario, $deposito);
            }
        }
        return json_encode($depositosUsuario);
    }
}



function ConsultarDepositosEntreFechas()
{
    if (!isset($_GET["fechaDesde"]) || !isset($_GET["fechaHasta"])) {
        return 'Error. Faltan parámetros para la consulta.';
    } else {
        $fechaDesde = $_GET["fechaDesde"];
        $fechaHasta = $_GET["fechaHasta"];

        // Convierte las fechas al formato "yyyy-mm-dd"
        $fechaDesde = date("d-m-Y", strtotime($fechaDesde));
        $fechaHasta = date("d-m-Y", strtotime($fechaHasta));

        $depositos = Deposito::LeerJSONDeposito();
        $depositosEntreFechas = array();

        foreach ($depositos as $deposito) {
            // Compara las fechas en formato "yyyy-mm-dd"
            if ($deposito->fecha >= $fechaDesde && $deposito->fecha <= $fechaHasta) {
                array_push($depositosEntreFechas, $deposito);
            }
        }

        return json_encode($depositosEntreFechas);
    }
}




function ConsultarDepositosPorTipoCuenta()
{

    if (!isset($_GET["tipoCuenta"])) {

    } else {
        $tipoCuenta = $_GET["tipoCuenta"];
        $depositos = Deposito::LeerJSONDeposito();
        $depositosPorTipoCuenta = array();
        foreach ($depositos as $deposito) {
            if ($deposito->tipoCuenta == $tipoCuenta) {
                array_push($depositosPorTipoCuenta, $deposito);
            }
        }
        return json_encode($depositosPorTipoCuenta);

    }
}


function ConsultarDepositosPorMoneda()
{
    if (!isset($_GET["moneda"])) {
        return 'Error. Faltan parametros para la consulta.';
    } else {
        $moneda = $_GET["moneda"];
        $depositos = Deposito::LeerJSONDeposito();
        $depositosPorMoneda = array();
        foreach ($depositos as $deposito) {
            if ($deposito->moneda == $moneda) {
                array_push($depositosPorMoneda, $deposito);
            }
        }
        return json_encode($depositosPorMoneda);
    }
}

?>