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

    public function __construct($_nombre, $_clave, $_mail)
    {
        $this->_nombre = $_nombre;
        $this->_clave = $_clave;
        $this->_mail = $_mail;
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
        }else{
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
            }else{
                echo "Usuario no registrado";
            }
        }
    }

}

?>