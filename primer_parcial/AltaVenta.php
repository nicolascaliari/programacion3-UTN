<?php
function POST_altaVenta($arrayPizzas, $arrayVentas, $id, $pathPizza, $pathVentas, $rutaImagen){
    if(!isset($_POST['mail'],  $_POST['sabor'],  $_POST['tipo'],  $_POST['cantidad'], $_FILES['imagen'], $id))
    {
        echo "ERROR!! Carga de datos invalida";
    }
    else{
        $mail = $_POST['mail'];
        $sabor = $_POST['sabor'];
        $tipo =  $_POST['tipo'];
        $cantidad = $_POST['cantidad'];
        $imagen = $_FILES['imagen'];
        

        $venta = new Venta($mail, $sabor, $tipo, $cantidad, $id);
        $pizza = new Pizza($sabor, 0, $tipo, $cantidad, 0);
        $indice = $pizza->PizzaYaExiste($arrayPizzas);
        if($indice == -1){
            echo "No hay pizza de esa variedad\n";
        }
        else{
            $stock = Pizza::ConsultarStock($arrayPizzas, $indice);
            if($stock >= $cantidad){
                array_push($arrayVentas, $venta);
                Venta::RealizarVenta($arrayVentas, $pathVentas);
                Pizza::DescontarCantidad($pizza, $arrayPizzas, $indice, $pathPizza);
                $destino = $venta->DefinirDestinoImagen($rutaImagen);
                if(move_uploaded_file($imagen['tmp_name'], $destino))
                {
                    echo "Se guardo la imagen en: ", $destino;
                }
                else{
                    echo "La imagen sigue en: ", $imagen['tmp_name'];
                }
            }
            else{
                echo "No hay stock disponible\n";
            }
        }
    }
}
?>