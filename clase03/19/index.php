<!-- Aplicación No 19 (Auto)
Realizar una clase llamada “Auto” que posea los siguientes atributos

privados: _color (String)
_precio (Double)
_marca (String).
_fecha (DateTime)

Realizar un constructor capaz de poder instanciar objetos pasándole como

parámetros: 
i. La marca y el color.
ii. La marca, color y el precio.
iii. La marca, color, precio y fecha.

Realizar un método de instancia llamado “AgregarImpuestos”, que recibirá un doble por
parámetro y que se sumará al precio del objeto.
Realizar un método de clase llamado “MostrarAuto”, que recibirá un objeto de tipo “Auto” por
parámetro y que mostrará todos los atributos de dicho objeto.
Crear el método de instancia “Equals” que permita comparar dos objetos de tipo “Auto”. Sólo devolverá
TRUE si ambos “Autos” son de la misma marca.
Crear un método de clase, llamado “Add” que permita sumar dos objetos “Auto” (sólo si son de la
misma marca, y del mismo color, de lo contrario informarlo) y que retorne un Double con la suma de los
precios o cero si no se pudo realizar la operación.
Ejemplo: $importeDouble = Auto::Add($autoUno, $autoDos);
Crear un método de clase para poder hacer el alta de un Auto, guardando los datos en un archivo
autos.csv.
Hacer los métodos necesarios en la clase Auto para poder leer el listado desde el archivo
autos.csv
Se deben cargar los datos en un array de autos.
En testAuto.php:
● Crear dos objetos “Auto” de la misma marca y distinto color.
● Crear dos objetos “Auto” de la misma marca, mismo color y distinto precio. ● Crear
un objeto “Auto” utilizando la sobrecarga restante.
● Utilizar el método “AgregarImpuesto” en los últimos tres objetos, agregando $ 1500 al
atributo precio.
● Obtener el importe sumado del primer objeto “Auto” más el segundo y mostrar el
resultado obtenido.
● Comparar el primer “Auto” con el segundo y quinto objeto e informar si son iguales o no.
● Utilizar el método de clase “MostrarAuto” para mostrar cada los objetos impares (1, 3, 5) -->

<?php
class Auto
{
    private $_color;
    private $_precio;
    private $_marca;
    private $_fecha;

    public function __construct($_color, $_precio, $_marca = "", $_fecha = "")
    {
        $this->_color = $_color;
        $this->_precio = $_precio;
        $this->_marca = $_marca;
        $this->_fecha = $_fecha;
    }

    public function AgregarInpuestos($precio)
    {
        return $this->_precio += $precio;
    }

    public static function MostrarAuto($auto)
    {
        if (is_a($auto, "Auto")) {
            echo "Color: " . $auto->_color . "<br>";
            echo "Precio: $" . $auto->_precio . "<br>";
            echo "Marca: " . $auto->_marca . "<br>";
            echo "Fecha: " . $auto->_fecha . "<br>";
        } else {
            echo "No es un auto";
        } {
        }
    }


    public function Equals($autoUno, $autoDos)
    {
        if (is_a($autoUno, "Auto") && is_a($autoDos, "Auto")) {
            if ($autoUno->_marca == $autoDos->_marca) {
                return true;
            } else {
                return false;
            }
        } else {
            echo "No es un auto";
        }
    }



    public static function Add($autoUno, $autoDos)
    {
        if (is_a($autoUno, "Auto") && is_a($autoDos, "Auto")) {
            if ($autoUno->_marca == $autoDos->_marca && $autoUno->_color == $autoDos->_color) {
                return $autoUno->_precio + $autoDos->_precio;
            } else {
                echo "No se puede sumar";
            }
        } else {
            echo "No es un auto";
        }
    }


    public static function GuardarAuto($auto)
    {
        $archivo = fopen("autos.csv", "a");
        fwrite($archivo, $auto->_color . "," . $auto->_precio . "," . $auto->_marca . "," . $auto->_fecha . "\n");
        fclose($archivo);
    }

    public static function LeerAuto()
    {
        $archivo = fopen("autos.csv", "r");
        $arrayAutos = array();
        while (!feof($archivo)) {
            $renglon = fgets($archivo);
            $auto = explode(",", $renglon);
            $auto[0] = trim($auto[0]);
            if ($auto[0] != "") {
                $arrayAutos[] = new Auto($auto[0], $auto[1], $auto[2], $auto[3]);
            }
        }
        fclose($archivo);

        foreach ($arrayAutos as $auto) {
            Auto::MostrarAuto($auto);
        }

        return $arrayAutos;
    }

    public static function MostrarArray($arrayAutos)
    {
        foreach ($arrayAutos as $auto) {
            Auto::MostrarAuto($auto);
        }
    }
}

$auto = new Auto('rojo', 2000, 'ferrari');
$autoDos = new Auto('verde', 5000, 'ford');
$autoTres = new Auto('rojo', 2000, 'ferrari');

Auto::GuardarAuto($auto);
Auto::GuardarAuto($autoDos);
Auto::LeerAuto();


?>