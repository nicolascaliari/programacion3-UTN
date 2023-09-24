<?php 

    include "../../clase03/20BIS/usuario.php";


    //consulta = http://localhost/programacion3-UTN/clase04/24/listado.php?lista-usuarios=usuariosJSON

    if($_SERVER['REQUEST_METHOD'] === 'GET')
    {
        $tipoLista = $_GET['lista-usuarios'];

        if ($tipoLista === 'usuariosJSON') {
            $usuarios = Usuario::leetJSON();
        } else {
            echo "Tipo de lista no válido.";
        }
    }
