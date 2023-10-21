<?php

function GET_cargarPizza($path, $arrayPizzas, $id){
    if(!isset($_GET['sabor'], $_GET['precio'], $_GET['tipo'], $_GET['cantidad'], $id))
    {
        echo "ERROR!! Carga de datos invalida";
    }
    else
    {
        $sabor = $_GET['sabor'];
        $precio = $_GET['precio'];
        $tipo = $_GET['tipo'];
        $cantidad = $_GET['cantidad'];
        $pizza = new Pizza($sabor, $precio, $tipo, $cantidad, $id);
        $indice = $pizza->PizzaYaExiste($arrayPizzas);
        if($indice == -1){
            array_push($arrayPizzas, $pizza);
            Pizza::AltaPizza($arrayPizzas, $path);
        }
        else{
            Pizza::AgregarCantidad($pizza, $arrayPizzas, $indice, $path);
            Pizza::ActualizarPrecio($pizza, $arrayPizzas, $indice, $path);
        }
    }
}
function POST_cargarPizza($path, $arrayPizzas, $id, $rutaImagen){
    if(!isset($_POST['sabor'], $_POST['precio'], $_POST['tipo'], $_POST['cantidad'], $_FILES['imagen'], $id))
    {
        echo "ERROR!! Carga de datos invalida";
    }
    else
    {
        $sabor = $_POST['sabor'];
        $precio = $_POST['precio'];
        $tipo = $_POST['tipo'];
        $cantidad = $_POST['cantidad'];
        $imagen = $_FILES['imagen'];
        
        $pizza = new Pizza($sabor, $precio, $tipo, $cantidad, $id);
        $indice = $pizza->PizzaYaExiste($arrayPizzas);
        if($indice == -1){
            array_push($arrayPizzas, $pizza);
            Pizza::AltaPizza($arrayPizzas, $path);
            $destino = $rutaImagen."/".$tipo."-".$sabor.".png";
            if(move_uploaded_file($imagen['tmp_name'], $destino))
            {
                echo "Se guardo la imagen en: ", $destino;
            }
            else{
                echo "La imagen sigue en: ", $imagen['tmp_name'];
            }
        }
        else{
            Pizza::AgregarCantidad($pizza, $arrayPizzas, $indice, $path);
            Pizza::ActualizarPrecio($pizza, $arrayPizzas, $indice, $path);
        }
    }
}



?>