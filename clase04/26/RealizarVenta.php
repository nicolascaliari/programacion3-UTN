<?php
    
    include "./Venta.php";
    include "../../clase03/20BIS/usuario.php";
    include "../25/producto.php";

    //http://localhost/programacion3-UTN/clase04/26/RealizarVenta.php

    if ($_SERVER["REQUEST_METHOD"] === 'POST') {
        if (isset($_POST['codigoDeBarra']) && isset($_POST['idUsuario']) && isset($_POST['cantidad'])) {
            $cantidad = $_POST['cantidad'];
            $idUsuario = $_POST['idUsuario'];
            $codigoDeBarra = $_POST['codigoDeBarra'];
            
            
            $producto = new Producto("nicolas", "electronica", 3, 333, 101029);
            $usuario = new Usuario("nicolas", "nico123","nicolas123");
            $venta = new Venta($codigoDeBarra, $idUsuario, $cantidad);
    
            if($venta->ValidarVenta($producto, $usuario))
            {
                $venta->AltaVenta($venta);
                echo "Ingresado";
            }
        }
    }
