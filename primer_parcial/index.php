<?php
include_once "pizza.php";
include "ventas.php";
include "generarId.php";
$pathPizza = "Pizza.json";
$pathVenta = "venta.json";
$rutaImagenDeVenta = 'C:\xampp\htdocs\simulacroParcial4\ImagenesDeLaVenta';
$rutaImagenPizzas = 'C:\xampp\htdocs\programacion3-utn\primer_parcial\ImagenesDePizzas';
$rutaBackupVentas = 'C:\xampp\htdocs\simulacroParcial4\BACKUPVENTAS';
$pizzas = Pizza::LeerPizzaJson($pathPizza);
$ventas = Venta::LeerVentasJson($pathVenta);
$ultimoIdVenta = IDGenerador::GenerarIdVenta($pathVenta);
$ultimoIdPizza = IDGenerador::GenerarIdPizza($pathPizza);


switch($_SERVER["REQUEST_METHOD"])
{
    case "POST":
        if(!isset($_POST['accion'])){
            echo "ERROR!! Carga de datos invalida";
        }
        else{
            switch($_POST['accion'])
            {
                case "consultar":
                    include "PizzaConsultar.php";
                    POST_consultarPizza($pizzas);
                break;
                case "venta":
                    include "AltaVenta.php";
                    POST_altaVenta($pizzas, $ventas, $ultimoIdVenta, $pathPizza, $pathVenta, $rutaImagenDeVenta);
                break;
                case "consultarVentas":
                    include "ConsultarVentas.php";
                    POST_consultarVentas($ventas);
                break;
                case "carga":
                    include "PizzaCarga.php";
                    POST_cargarPizza($pathPizza, $pizzas, $ultimoIdPizza, $rutaImagenPizzas);
                break;
                case "modificar":
                    include "ModificarVenta.php";
                    POST_modificarVenta($ventas, $pathVenta);
                break;
                case "borrar":
                    include "borrarVenta.php";
                    POST_borrarVenta($ventas, $pathVenta, $rutaBackupVentas, $rutaImagenDeVenta);
                break;
            }
        }
    break;

    case "GET":
        if(!isset($_GET['accion'])){
            echo "ERROR!! Carga de datos invalida";
        }
        else{
            switch($_GET['accion'])
            {
                case "carga":
                    include "PizzaCarga.php";
                    GET_cargarPizza($pathPizza, $pizzas, $ultimoIdPizza);
    
                break;
            }
        }
    break;
}
