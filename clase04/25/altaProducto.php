<?php

include './producto.php';

//consulta = http://localhost/programacion3-UTN/clase04/25/altaProducto.php



if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    if (isset($_POST['nombre']) && isset($_POST['tipo']) && isset($_POST['stock']) && isset($_POST['precio']) && isset($_POST['codigoDeBarra'])) {
        $nombre = $_POST['nombre'];
        $tipo = $_POST['tipo'];
        $stock = $_POST['stock'];
        $precio = $_POST['precio'];
        $codigoDeBarra = $_POST['codigoDeBarra'];

        $producto = new Producto($nombre, $tipo, $stock, $precio, $codigoDeBarra);


        if($producto->VerificarProductoExistente($producto))
        {
            echo "El producto ya existe";
        }else{
            $producto->AltaProducto($producto);
            echo "Ingresado";
        }
    }
}

?>