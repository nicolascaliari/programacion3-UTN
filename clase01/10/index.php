<!-- Aplicación No 10 (Arrays de Arrays)
Realizar las líneas de código necesarias para generar un Array asociativo y otro indexado que
contengan como elementos tres Arrays del punto anterior cada uno. Crear, cargar y mostrar los
Arrays de Arrays. -->

<!-- Nicolas Caliari -->

<?php

$lapiceraUno = array("color" => "rojo", "marca" => "bic", "trazo" => "fino", "precio" => 10);
$lapiceraDos = array("color" => "azul", "marca" => "bic", "trazo" => "grueso", "precio" => 15);
$lapiceraTres = array("color" => "verde", "marca" => "bic", "trazo" => "medio", "precio" => 12);

$lapiceras = array("uno" => $lapiceraUno, "dos" => $lapiceraDos, "tres" => $lapiceraTres);

$lapicerasIndexado = array($lapiceraUno, $lapiceraDos, $lapiceraTres);

echo "Lapiceras: <br>";

foreach($lapiceras as $key => $value)
{
    echo "Lapicera " . $key . ": <br>";
    foreach($value as $key2 => $value2)
    {
        echo $key2 . " => " . $value2 . "<br>";
    }
    echo "<br>";
}

echo "<br>Lapiceras Indexado: <br>";


foreach($lapicerasIndexado as $key => $value)
{
    echo "Lapicera " . ($key + 1) . ": <br>";
    foreach($value as $key2 => $value2)
    {
        echo $key2 . " => " . $value2 . "<br>";
    }
    echo "<br>";
}




?>