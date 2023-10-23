<?php

include './deposito.php';

function ConsultarDepositoPorTipoYMoneda()
{
    if (!isset($_GET["tipoCuenta"]) || !isset($_GET["moneda"])) {
        return 'Error. Faltan parametros para la consulta.';
    } else {
        $tipoCuenta = $_GET["tipoCuenta"];
        $moneda = $_GET["moneda"];
        if (!isset($_GET["fecha"])) {

            $fechaAnterior = date("d-m-Y", strtotime(date("d-m-Y") . "-1 day"));
            Deposito::MovimientosPorTipoYMoneda($tipoCuenta, $moneda, $fechaAnterior);
        } else {
            $fecha = $_GET["fecha"];
            Deposito::MovimientosPorTipoYMoneda($tipoCuenta, $moneda, $fecha);
        }
    }
}


function ConsultarDepositosUsuario()
{
    if (!isset($_GET["numeroCuenta"])) {
        return 'Error. Faltan parametros para la consulta.';
    } else {
        $usuario = $_GET["numeroCuenta"];
        $depostios = Deposito::MovimientosPorUsuario($usuario);

        if ($depostios == false) {
            return 'No se encontraron movimientos para el usuario.';
        } else {
            Deposito::MostrarDepositos($depostios);
        }
    }
}



function ConsultarDepositosEntreFechas()
{
    if (!isset($_GET["fechaDesde"]) || !isset($_GET["fechaHasta"])) {
        return 'Error. Faltan parámetros para la consulta.';
    } else {
        $fechaDesde = $_GET["fechaDesde"];
        $fechaHasta = $_GET["fechaHasta"];


        $depositosEntreFechas = Deposito::FiltrarDepositosPorFecha($fechaDesde, $fechaHasta);
        $depositosOrdenados = Deposito::OrdenarDepositosPorNumeroCuenta($depositosEntreFechas);
        Deposito::MostrarDepositos($depositosOrdenados);
    }
}




function ConsultarDepositosPorTipoCuenta()
{
    if (!isset($_GET["tipoCuenta"])) {
        return 'Error. Faltan parametros para la consulta.';
    } else {
        $tipoCuenta = $_GET["tipoCuenta"];
        Deposito::MovimientosPorTipoCuenta($tipoCuenta);
    }
}


function ConsultarDepositosPorMoneda()
{
    if (!isset($_GET["moneda"])) {
        return 'Error. Faltan parametros para la consulta.';
    } else {
        $moneda = $_GET["moneda"];
        Deposito::MovimientosPorMoneda($moneda);
    }
}

?>