<?php 

//enrutamiento de la pagina

switch($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        echo "Esto es un GET";
        break;
    case 'POST':
        echo "Esto es un POST";
        break;
    case 'PUT':
        echo "Esto es un PUT";
        break;
    case 'DELETE':
        echo "Esto es un DELETE";
        break;
    default:
        echo "Método no soportado";
        break;
}

?>