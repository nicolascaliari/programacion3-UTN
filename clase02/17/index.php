<!-- Aplicación No 17 (Auto)
Realizar una clase llamada “Auto” que posea los siguientes atributos

privados: _color (String)
_precio (Double)
_marca (String).
_fecha (DateTime)

Realizar un constructor capaz de poder instanciar objetos pasándole como

parámetros: i. La marca y el color.
ii. La marca, color y el precio.
iii. La marca, color, precio y fecha.

Realizar un método de instancia llamado “AgregarImpuestos”, que recibirá un doble
por parámetro y que se sumará al precio del objeto.
Realizar un método de clase llamado “MostrarAuto”, que recibirá un objeto de tipo “Auto”
por parámetro y que mostrará todos los atributos de dicho objeto.
Crear el método de instancia “Equals” que permita comparar dos objetos de tipo “Auto”. Sólo
devolverá TRUE si ambos “Autos” son de la misma marca.
Crear un método de clase, llamado “Add” que permita sumar dos objetos “Auto” (sólo si son
de la misma marca, y del mismo color, de lo contrario informarlo) y que retorne un Double con
la suma de los precios o cero si no se pudo realizar la operación.
Ejemplo: $importeDouble = Auto::Add($autoUno, $autoDos);

En testAuto.php:
● Crear dos objetos “Auto” de la misma marca y distinto color.
● Crear dos objetos “Auto” de la misma marca, mismo color y distinto precio.
● Crear un objeto “Auto” utilizando la sobrecarga restante.

● Utilizar el método “AgregarImpuesto” en los últimos tres objetos, agregando $ 1500
al atributo precio.
● Obtener el importe sumado del primer objeto “Auto” más el segundo y mostrar el
resultado obtenido.
● Comparar el primer “Auto” con el segundo y quinto objeto e informar si son iguales o
no.
● Utilizar el método de clase “MostrarAuto” para mostrar cada los objetos impares (1, 3,
5) -->



<!-- Nicolas Caliari -->

<?php

class Auto
{
    private $_color;
    private $_precio;
    private $_marca;
    private $_fecha;

    public function __construct($_marca, $_color, $_precio = "", $_fecha = "")
    {
        $this->_marca = $_marca;
        $this->_color = $_color;
        $this->_precio = $_precio;
        $this->_fecha = $_fecha;
    }

    public function AgregarImpuestos($precio)
    {
        $this->_precio += $precio;
    }
    static function MostrarAuto($auto)
    {
        foreach ($auto as $key => $value) {
            echo $key . " " . $value . "<br>";
        }
    }


    function Equals($autoUno, $autoDos)
    {
        $retorno = false;
        if ($autoUno->_marca === $autoDos->_marca) {
            $retorno = true;
            echo '<br/>Los autos tienen la misma marca';
        } else {
            echo '<br/>Los autos no tienen la misma marca';
        }
        return $retorno;
    }


    static function Add($autoUno, $autoDos)
    {
        $sum = 0;
        if ($autoUno->_marca === $autoDos->_marca && $autoUno->_color === $autoDos->_color) {
            $sum = $autoUno->_precio += $autoDos->_precio;
        } else {
            echo '<br/>Los autos no tienen la misma marca o color';
        }

        return $sum;
    }
}

// $auto1 = new Auto("Ford", "Rojo", 3000);

// $auto2 = new Auto("Ford", "Rojo", 1000);

// $auto1->AgregarImpuestos(1500);
// $auto1->MostrarAuto($auto1);


// $value = $auto1->Equals($auto1, $auto2);
// $sum = $auto1::Add($auto1, $auto2);

// echo "<br/>Suma de los dos autos: " , $sum;

// echo $value;

?>