//cosas que me faltan : 
-Validacion de tipo de cuenta;
-validacion de moneda;
-Crear id autoincremental para los dos json;
-terminar punto 4;
-chequear bug en punto 5;
-terminar punto 6 === falta generar json de retiro;
-hacer punto 7;



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
                case 'modificar':
                    include "ModificarCuenta.php";
                    echo modificar();
                    break;

                case 'RetiroCuenta':
                    include 'RetiroCuenta.php';
                    echo RetiroCuenta();
                    break;

                case 'AjusteCuenta':
                    break;
            }
        } else {
            echo "Error. Faltan parametros.";
        }
        break;
    case "GET":
        if (isset($_GET['accion'])) {
            switch ($_GET['accion']) {
                case 'consultarTotal':
                    include 'ConsultarMovimientos.php';
                    echo ConsultarDepositoPorTipoYMoneda();
                    break;

                case "consultarDepositos":
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
            }
        } else {
            echo "Error. Faltan parametros.";
        }
        break;
}
?>