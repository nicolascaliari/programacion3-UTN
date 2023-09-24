<!-- Aplicación No 20 BIS (Registro CSV)
Archivo: registro.php
método:POST
Recibe los datos del usuario(nombre, clave,mail )por POST ,
crear un objeto y utilizar sus métodos para poder hacer el alta,
guardando los datos en usuarios.csv.
retorna si se pudo agregar o no.
Cada usuario se agrega en un renglón diferente al anterior.
Hacer los métodos necesarios en la clase usuario -->

<!-- Nicolas Caliari -->

<?php

class Usuario
{
    private $_nombre;
    private $_clave;
    private $_mail;
    private $_id;

    public function __construct($_nombre, $_clave, $_mail)
    {
        $this->_nombre = $_nombre;
        $this->_clave = $_clave;
        $this->_mail = $_mail;
        $this->_id = rand(1, 10000);
    }

    public function agregarAlCSV()
    {
        $usuarioData = [$this->_nombre, $this->_clave, $this->_mail];
        $csvFile = fopen('usuarios.csv', 'a');

        if ($csvFile !== false) {
            fputcsv($csvFile, $usuarioData);
            fclose($csvFile);
            return true;
        } else {
            return false;
        }
    }



    public function getNombre()
    {
        return $this->_nombre;
    }



    public function getClave()
    {
        return $this->_clave;
    }



    public function getMail()
    {
        return $this->_mail;
    }


    public static function cargarUsuariosDesdeCSV($archivo)
    {
        $usuarios = [];

        if (($handle = fopen($archivo, "r")) !== false) {
            while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                $usuarios[] = new Usuario($data[0], $data[1], $data[2]);
            }
            fclose($handle);
        } else {
            echo "No se pudo abrir el archivo";
        }

        return $usuarios;
    }


    public static function verificarUsuario($user)
    {
        $archivo_csv = __DIR__ . "/usuarios.csv";

        $usuarios = Usuario::cargarUsuariosDesdeCSV($archivo_csv);

        foreach ($usuarios as $usuario) {
            if ($usuario->getMail() == $user->getMail() && $usuario->getClave() == $user->getClave()) {
                echo "Verificado";
            } else if ($usuario->getMail() == $user->getMail() && $usuario->getClave() != $user->getClave()) {
                echo "Error en los datos";
            } else {
                echo "Usuario no registrado";
            }
        }
    }




    public function GuardarJSON()
    {
        $usuarioArray = [
            'id' => $this->_id,
            'nombre' => $this->_nombre,
            'clave' => $this->_clave,
            'mail' => $this->_mail,
        ];

        $usuarios = [];
        if (file_exists('usuarios.json')) {
            $usuarios = json_decode(file_get_contents('usuarios.json'), true);
        }

        $usuarios[] = $usuarioArray;

        //el json pretty es para que quede bien ordenado.
        file_put_contents('usuarios.json', json_encode($usuarios, JSON_PRETTY_PRINT));

        return true;
    }


    public function subirImagen($imagenTmpPath)
    {
        $carpetaDestino = __DIR__ . '/Usuario/Fotos/';
        $nombreImagen = $this->_id . '_' . $this->_nombre . '.jpg';

        if (move_uploaded_file($imagenTmpPath, $carpetaDestino . $nombreImagen)) {
            return true;
        } else {
            return false;
        }
    }



    public static function leetJSON()
    {
        $rutaArchivo = '../../clase04/23/usuarios.json';

        if (file_exists($rutaArchivo)) {
            $usuarios = json_decode(file_get_contents($rutaArchivo), true);

            foreach ($usuarios as $usuario) {
                echo $usuario['id'] . '<br>';
                echo $usuario['nombre'] . '<br>';
                echo $usuario['clave'] . '<br>';
                echo $usuario['mail'] . '<br>';
                echo '<br>';
            }
        } else {
            echo 'El archivo "usuarios.json" no existe.';
        }
    }



    public static function VerificarUsuarioExistente($usuario)
    {
        $rutaArchivo = '../../clase04/23/usuarios.json';
        
        if (file_exists($rutaArchivo)) {
            $usuarioJSON = json_decode(file_get_contents($rutaArchivo), true);

            foreach ($usuarioJSON as $usuarioJSON) {
                if ($usuarioJSON['nombre'] == $usuario->_nombre) {
                    echo "Actualizado";
                    return true;
                }
            }
        } else {
            echo 'El archivo "usuarios.json" no existe.';
            return false;
        }
    }
}

?>