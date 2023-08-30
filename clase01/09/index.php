<!-- Aplicación No 9 (Arrays asociativos)
Realizar las líneas de código necesarias para generar un Array asociativo $lapicera, que
contenga como elementos: ‘color’, ‘marca’, ‘trazo’ y ‘precio’. Crear, cargar y mostrar tres
lapiceras. -->

<!-- Nicolas Caliari -->

<?php


function mostrarLapicera($lapicera)
{
    foreach($lapicera as $key => $value)
    {
        echo $key . " => " . $value . "<br>";
    }
}



$lapiceraUno = array("color" => "rojo", "marca" => "bic", "trazo" => "fino", "precio" => 10);
$lapiceraDos = array("color" => "azul", "marca" => "bic", "trazo" => "grueso", "precio" => 15);
$lapiceraTres = array("color" => "verde", "marca" => "bic", "trazo" => "medio", "precio" => 12);

echo "Lapicera 1: <br>";

mostrarLapicera($lapiceraUno);

echo "<br>Lapicera 2: <br>";

mostrarLapicera($lapiceraDos);

echo "<br>Lapicera 3: <br>";

mostrarLapicera($lapiceraTres);


?>