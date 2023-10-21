<?php
function POST_modificarVenta($arrayVentas, $pathVentas){
    if(!isset($_POST['numeroDePedido'], $_POST['mail'], $_POST['sabor'], $_POST['tipo'], $_POST['cantidad']))
    {
        echo "ERROR!! Carga de datos invalida";
    }
    else
    {
        $numeroDePedido = $_POST['numeroDePedido'];
        $mail = $_POST['mail'];
        $sabor = $_POST['sabor'];
        $tipo = $_POST['tipo'];
        $cantidad = $_POST['cantidad'];

        $buffer = new Venta($mail, $sabor,$tipo, $cantidad, 0);
        $indice = Venta::VentaYaExiste($arrayVentas, $numeroDePedido);
        if($indice == -1){
            echo "La venta no existe\n";
        }
        else{
            Venta::ModificarVenta($buffer, $arrayVentas, $indice, $pathVentas);
        }
        
    }
}

?>