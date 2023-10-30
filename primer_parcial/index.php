<?php
$directorioActual = __DIR__;
$rutaImagenCuenta = $directorioActual . '/ImagenesCuentas/2023/';
$rutaImagenDeposito = $directorioActual . '/ImagenesDepositos/2023/';
$rutaImagenBackup = $directorioActual . '/ImagenesBackupCuentas/2023/';


switch ($_SERVER['REQUEST_METHOD']) {
    case "POST":
        if (isset($_POST['accion'])) {
            switch ($_POST['accion']) {
                case 'alta':
                    include 'CuentaAlta.php';
                    echo cuentaAlta($rutaImagenCuenta);
                    break;
                case 'consultar':
                    include 'ConsultarCuenta.php';
                    echo consultarCuenta();
                    break;
                case 'depositar':
                    include 'DepositoCuenta.php';
                    echo depositar($rutaImagenDeposito);
                    break;
                case 'RetiroCuenta':
                    include 'RetiroCuenta.php';
                    echo RetiroCuenta();
                    break;

                case 'AjusteCuenta':
                    include 'AjusteCuenta.php';
                    echo AjusteCuenta();
                    break;
            }
        } else {
            echo "Error. Faltan parametros.";
        }
        break;

    case "PUT":
        parse_str(file_get_contents("php://input"), $_PUT);
        if (!isset($_PUT['accion'])) {
            echo "Error. Faltan parametros.";
        } else {
            switch ($_PUT['accion']) {
                case 'modificar':
                    include "ModificarCuenta.php";
                    echo modificar();
                    break;
            }
        }
        break;


    case "DELETE":
        parse_str(file_get_contents("php://input"), $_DELETE);
        if (!isset($_DELETE['accion'])) {
            echo "Error. Faltan parametros.";
        } else {
            switch ($_DELETE['accion']) {
                case 'borrar':
                    include "borrarCuenta.php";
                    echo BorrarCuenta($_DELETE, $rutaImagenBackup, $rutaImagenCuenta);
                    break;
            }
        }
        break;

    case "GET":
        if (isset($_GET['accion'])) {
            switch ($_GET['accion']) {
                case 'consultarTotal':
                    include 'ConsultarMovimientos.php';
                    echo ConsultarDepositoPorTipoYMoneda();
                    break;

                case "consultarDepositosPorUsuario":
                    include 'ConsultarMovimientos.php';
                    echo ConsultarDepositosUsuario();
                    break;

                case "consultarDepositosEntreFechas":
                    include 'ConsultarMovimientos.php';
                    echo ConsultarDepositosEntreFechas();
                    break;

                case "consultarDepositosPorTipoCuenta":
                    include 'ConsultarMovimientos.php';
                    echo ConsultarDepositosPorTipoCuenta();
                    break;
                case 'consultarDepositoPorMoneda':
                    include 'ConsultarMovimientos.php';
                    echo ConsultarDepositosPorMoneda();
                    break;



                case 'consultarTotalRetirado':
                    include 'ConsultarMovimientos.php';
                    echo consultarTotalRetirado();
                    break;
                case 'consultarRetirosPorUsuario':
                    include 'ConsultarMovimientos.php';
                    echo consultarRetirosPorUsuario();
                    break;
                case 'consultarRetiroPorFechas':
                    include 'ConsultarMovimientos.php';
                    echo consultarRetiroPorFechas();
                    break;
                case 'consultarRetiroPorTipoCuenta':
                    include 'ConsultarMovimientos.php';
                    echo consultarRetiroPorTipoCuenta();
                    break;
                case 'consultarRetiroPorMoneda':
                    include 'ConsultarMovimientos.php';
                    echo consultarRetiroPorMoneda();
                    break;

            }
        } else {
            echo "Error. Faltan parametros.";
        }
        break;
}
?>