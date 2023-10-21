<?php
$directorioActual = __DIR__;
var_dump($directorioActual);
$rutaImagenCuenta = $directorioActual . '/ImagenesCuentas/2023';
$rutaImagenDeposito = $directorioActual . '/ImagenesDepositos/2023';
var_dump($rutaImagenCuenta);
var_dump($rutaImagenDeposito);


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
            }
        } else {
            echo "Error. Faltan parametros.";
        }
        break;
    case "GET":
        //         Datos a consultar:
// a- El total depositado (monto) por tipo de cuenta y moneda en un día en
// particular (se envía por parámetro), si no se pasa fecha, se muestran las del día
// anterior.
// b- El listado de depósitos para un usuario en particular.
// c- El listado de depósitos entre dos fechas ordenado por nombre.
// d- El listado de depósitos por tipo de cuenta.
// e- El listado de depósitos por moneda.
        if (isset($_GET['accion'])) {
            switch ($_GET['accion']) {
                case 'consultarTotal':
                    echo "entre";
                    include 'ConsultarMovimientos.php';
                    echo ConsultarDepositoPorTipoYMoneda();
                    echo "sali";
                    break;

                case "consultarDepositos":
                    echo ConsultarDepositosUsuario();
                    break;

                case "consultarDepositosEntreFechas":
                    echo ConsultarDepositosEntreFechas();
                    break;

                case "consultarDepositosPorTipoCuenta":
                    echo ConsultarDepositosPorTipoCuenta();
                    break;
                case 'consultarDepositoPorMoneda':
                    echo ConsultarDepositosPorMoneda();
                    break;
            }
        } else {
            echo "Error. Faltan parametros.";
        }
        break;
}
?>