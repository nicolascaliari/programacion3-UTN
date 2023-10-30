<?php

include './deposito.php';
include './retiro.php';

function ConsultarDepositoPorTipoYMoneda()
{
    if (!isset($_GET["tipoCuenta"]) || !isset($_GET["moneda"])) {
        return 'Error. Faltan parametros para la consulta.';
    } else {
        $tipoCuenta = $_GET["tipoCuenta"];
        $moneda = $_GET["moneda"];
        if (!isset($_GET["fecha"])) {

            $fechaAnterior = date("d-m-Y", strtotime(date("d-m-Y") . "-1 day"));
            $total = Retiro::MovimientosPorTipoYMoneda($tipoCuenta, $moneda, $fechaAnterior);

            echo "El total es: ", $total;
        } else {
            $fecha = $_GET["fecha"];
            $total = Retiro::MovimientosPorTipoYMoneda($tipoCuenta, $moneda, $fecha);
            echo "El total es: ", $total;
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
        $depositos = Deposito::MovimientosPorTipoCuenta($tipoCuenta);
        Deposito::MostrarDepositos($depositos);
    }
}


function ConsultarDepositosPorMoneda()
{
    if (!isset($_GET["moneda"])) {
        return 'Error. Faltan parametros para la consulta.';
    } else {
        $moneda = $_GET["moneda"];
        $depositos = Deposito::MovimientosPorMoneda($moneda);
        Deposito::MostrarDepositos($depositos);
    }
}



function consultarTotalRetirado()
{
    if (!isset($_GET["tipoCuenta"]) || !isset($_GET["moneda"])) {
        return 'Error. Faltan parametros para la consulta.';
    } else {
        $tipoCuenta = $_GET["tipoCuenta"];
        $moneda = $_GET["moneda"];
        if (!isset($_GET["fecha"])) {

            $fechaAnterior = date("d-m-Y", strtotime(date("d-m-Y") . "-1 day"));
            $total = Deposito::MovimientosPorTipoYMoneda($tipoCuenta, $moneda, $fechaAnterior);

            echo "El total es: ", $total;
        } else {
            $fecha = $_GET["fecha"];
            $total = Deposito::MovimientosPorTipoYMoneda($tipoCuenta, $moneda, $fecha);
            echo "El total es: ", $total;
        }
    }
}



// El listado de retiros para un usuario en particular.
function consultarRetirosPorUsuario()
{
    if (!isset($_GET["numeroCuenta"])) {
        return 'Error. Faltan parametros para la consulta.';
    } else {
        $usuario = $_GET["numeroCuenta"];
        $retiros = Retiro::RetirosPorUsuario($usuario);

        if ($retiros == false) {
            return 'No se encontraron movimientos para el usuario.';
        } else {

            Retiro::MostrarRetiros($retiros);
        }
    }
}

function consultarRetiroPorFechas()
{
    if (!isset($_GET["fechaDesde"]) || !isset($_GET["fechaHasta"])) {
        return 'Error. Faltan parámetros para la consulta.';
    } else {
        $fechaDesde = $_GET["fechaDesde"];
        $fechaHasta = $_GET["fechaHasta"];


        $retirosEntreFechas = Retiro::FiltrarDepositosPorFecha($fechaDesde, $fechaHasta);
        $retirosOrdenados = Retiro::OrdenarDepositosPorNumeroCuenta($retirosEntreFechas);
        Retiro::MostrarRetiros($retirosOrdenados);


    }
}




function consultarRetiroPorTipoCuenta()
{
    if (!isset($_GET["tipoCuenta"])) {
        return 'Error. Faltan parametros para la consulta.';
    } else {
        $tipoCuenta = $_GET["tipoCuenta"];

        $retiros = Retiro::RetiroPorTipoCuenta($tipoCuenta);
        Retiro::MostrarRetiros($retiros);
    }
}


function consultarRetiroPorMoneda()
{
    if (!isset($_GET["moneda"])) {
        return 'Error. Faltan parametros para la consulta.';
    } else {
        $moneda = $_GET["moneda"];
        $depositos = Retiro::MovimientosPorMoneda($moneda);
        Retiro::MostrarRetiros($depositos);
    }
}




?>