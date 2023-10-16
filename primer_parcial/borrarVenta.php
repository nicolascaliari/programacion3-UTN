<?php
function POST_borrarVenta($arrayVentas, $pathVentas, $rutaEliminarImagen, $rutaImagenesVenta){
    if(!isset($_POST['numeroDePedido']))
    {
        echo "ERROR!! Carga de datos invalida";
    }
    else
    {
        $numeroDePedido = $_POST['numeroDePedido'];

        $indice = Venta::VentaYaExiste($arrayVentas, $numeroDePedido);
        if($indice == -1){
            echo "La venta no existe\n";
        }
        else{
            Venta::BorrarVenta($arrayVentas, $pathVentas, $indice, $rutaImagenesVenta, $rutaEliminarImagen);
        }
        
    }
}
?>