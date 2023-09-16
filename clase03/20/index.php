<!-- Aplicación No 20 (Auto - Garage)
Crear la clase Garage que posea como atributos privados:

_razonSocial (String)
_precioPorHora (Double)
_autos (Autos[], reutilizar la clase Auto del ejercicio anterior)
Realizar un constructor capaz de poder instanciar objetos pasándole como

parámetros: i. La razón social.
ii. La razón social, y el precio por hora.

Realizar un método de instancia llamado “MostrarGarage”, que no recibirá parámetros y que
mostrará todos los atributos del objeto.
Crear el método de instancia “Equals” que permita comparar al objeto de tipo Garaje con un objeto de
tipo Auto. Sólo devolverá TRUE si el auto está en el garaje.
Crear el método de instancia “Add” para que permita sumar un objeto “Auto” al “Garage” (sólo si el
auto no está en el garaje, de lo contrario informarlo).
Ejemplo: $miGarage->Add($autoUno);
Crear el método de instancia “Remove” para que permita quitar un objeto “Auto” del
“Garage” (sólo si el auto está en el garaje, de lo contrario informarlo). Ejemplo:
$miGarage->Remove($autoUno);
Crear un método de clase para poder hacer el alta de un Garage y, guardando los datos en un archivo
garages.csv.
Hacer los métodos necesarios en la clase Garage para poder leer el listado desde el archivo
garage.csv
Se deben cargar los datos en un array de garage.
En testGarage.php, crear autos y un garage. Probar el buen funcionamiento de todos los
métodos.

Nicolas Caliari -->



<?php
include "../19/index.php";
class Garage
{

    private $_razonSocial;
    private $_precioPorHora;
    private $_autos = [];

    public function __construct($_razonSocial, $_precioPorHora = "")
    {
        if ($_razonSocial !== null && $_precioPorHora !== null) {
            $this->_razonSocial = $_razonSocial;
            $this->_precioPorHora = $_precioPorHora;
            $this->_autos = array();
        } else {
            echo "Algo salio mal";
        }
    }



    function MostrarGarage()
    {
        $i = 0;
        echo "Razon Social: " . $this->_razonSocial . "<br>";
        echo "Precio por Hora: $" . $this->_precioPorHora . "<br>";
        echo "Autos: ";
        if (count($this->_autos) == 0) {
            echo "No hay ningun auto ingresado actualmente";
        } else {
            foreach ($this->_autos as $auto) {
                $i++;
                echo "<br><br>";
                echo "Auto Nº$i: <br>";
                Auto::MostrarAuto($auto);
            }
        }
    }

    function Equals($auto)
    {
        $retorno = false;

        if (
            is_a($auto, "Auto")
            && in_array($auto, $this->_autos)
        ) {
            $retorno = true;
        }
        return $retorno;
    }

    function Add($auto)
    {
        $retorno = "Auto ingresado";

        if (
            is_a($auto, "Auto")
            && !$this->Equals($auto)
        ) {
            array_push($this->_autos, $auto);
        } else {
            $retorno = "No se pudo ingresar el auto porque ya esta ingresado";
        }
        return $retorno;
    }

    function Remove($auto)
    {
        $retorno = "Auto fue removido";
        $indice = false;

        if (
            is_a($auto, "Auto")
            && $this->Equals($auto)
        ) {
            $indice = array_search($auto, $this->_autos);
            unset($this->_autos[$indice]);
            $this->_autos = array_values($this->_autos);
        } else {
            $retorno = "No se pudo remover el auto porque no se encuentra ingresado";
        }
        return $retorno;
    }


    public static function GuardarGarage($garage)
    {
        $archivo = fopen("garage.csv", "a");
        fwrite($archivo, $garage->_razonSocial . "," . $garage->_precioPorHora . "," . $garage->_autos . "\n");
        fclose($archivo);
    }

    public static function LeerGarage()
    {
        $archivo = fopen("garage.csv", "r");
        $arrayGarage = array();
        while (!feof($archivo)) {
            $renglon = fgets($archivo);
            $garage = explode(",", $renglon);
            $garage[0] = trim($garage[0]);
            if ($garage[0] != "") {
                $arrayAutos[] = new Auto($garage[0], $garage[1]);
            }
        }
        fclose($archivo);

        foreach ($arrayGarage as $auto) {
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


$autoUno = new Auto("Fiat", "Negro", 7500.00);
$autoDos = new Auto("Renault", "Rojo", 5000.00);
$autoTres = new Auto("Jeep", "Negro", 15000.00);




$garage = new Garage("Garage", 30000, $autoDos);
$garage->Add($autoDos);


echo "Aca uso los metodos de archivos<br>";
Garage::GuardarGarage($garage);
Garage::LeerGarage();

echo "<br><br>";

echo "Se creo el Garage: <br>";
echo $garage->MostrarGarage();
echo "<br><br>";

echo "Agrego el autoUno<br>";
echo $garage->Add($autoUno);
echo "<br><br>";

echo "Agrego de nuevo el autoUno<br>";
echo $garage->Add($autoUno);
echo "<br><br>";

echo "Agrego el autoDos<br>";
echo $garage->Add($autoDos);
echo "<br><br>";

echo $garage->MostrarGarage();
echo "<br><br>";

echo "Intento quitar el autoTres<br>";
echo $garage->Remove($autoTres);
echo "<br><br>";

echo "Quito el autoDos<br>";
echo $garage->Remove($autoDos);
echo "<br><br>";

echo $garage->MostrarGarage();
echo "<br><br>";
