<?php
    function POST_consultarPizza($arrayPizzas){
        if(!isset($_POST['sabor'],  $_POST['tipo']))
        {
            echo "ERROR!! Carga de datos invalida";
        }
        else{
            $sabor = $_POST['sabor'];
            $tipo =  $_POST['tipo'];
            $pizza = new Pizza($sabor, 0, $tipo, 0, 0);
            $indice = $pizza->PizzaYaExiste($arrayPizzas);
            if($indice == -1){
                $indiceSabor = $pizza->ExisteSabor($arrayPizzas);
                $indiceTipo = $pizza->ExisteTipo($arrayPizzas);
                if($indiceSabor == -1){
                    echo "No existe sabor\n";
                }
                else{
                    echo "No existe tipo \n"; 
                }
            }
            else{
                echo "Si Hay \n";
            }
        }
    }
?>