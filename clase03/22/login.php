<?php
include "../20BIS/index.php";


// CONSULTA = http://localhost/programacion3-UTN/clase03/22/login.php?nombre=nicolas&clave=123&mail=nico@gmail.com

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nombre']) && isset($_POST['clave']) && isset($_POST['mail'])) {
        $nombre = $_POST['nombre'];
        $clave = $_POST['clave'];
        $mail = $_POST['mail'];

        // Crear un objeto Usuario con los datos recibidos.
        $usuario = new Usuario($nombre, $clave, $mail);

        // Intentar agregar el usuario al archivo CSV.
        $resultado = Usuario::verificarUsuario($usuario);

    }
}
?>