<?php

require "../20BIS/index.php";

// consulta = http://localhost/programacion3-UTN/clase03/21/listado.php?tipo_lista=usuarios

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $tipoLista = $_GET['tipo_lista'];

    if ($tipoLista === 'usuarios') {
        require_once '../20BIS/index.php';
        $usuarios = Usuario::cargarUsuariosDesdeCSV('../20BIS/usuarios.csv');

        echo "<ul>";
        foreach ($usuarios as $value) {
            echo "<ul>";
            echo "<li>" . $value->getNombre() . "</li>";
            echo "<li>" . $value->getClave() . "</li>";
            echo "<li>" . $value->getMail() . "</li>";
            echo "</ul>";
        }
        echo "</ul>";
    } else {
        echo "Tipo de lista no válido.";
    }
}
