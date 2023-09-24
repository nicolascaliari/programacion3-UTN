<?php
include "../../clase03/20BIS/usuario.php";


//consulta = http://localhost/programacion3-UTN/clase04/23/registro.php



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
        if(isset($_POST['nombre']) && isset($_POST['clave']) && isset($_POST['mail']))
        {
            $nombre = $_POST['nombre'];
            $clave = $_POST['clave'];
            $mail = $_POST['mail'];
            $imagenTmpPath = $_FILES['imagen']['tmp_name'];


            $usuario = new Usuario($nombre, $clave, $mail);

            if ($usuario->guardarJSON() && $usuario->subirImagen($imagenTmpPath)) {
                echo "Usuario registrado con éxito.";
            } else {
                echo "Error al registrar el usuario.";
            }

            // $resultado = Usuario::verificarUsuario($usuario);
        }else{
            echo "Faltan datos";
        }
    }


?>