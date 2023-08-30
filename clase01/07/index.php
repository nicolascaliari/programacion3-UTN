<!-- Aplicación No 7 (Mostrar impares)
Generar una aplicación que permita cargar los primeros 10 números impares en un Array.
Luego imprimir (utilizando la estructura for) cada uno en una línea distinta (recordar que el
salto de línea en HTML es la etiqueta <br/>). Repetir la impresión de los números
utilizando las estructuras while y foreach.

Nicolas Caliari --> -->

<?php

$arr = array();

for($i = 0; $i < 10; $i++)
{
    $arr[$i] = rand(1,100);
}

echo "Con for: <br/>";  

for($i = 0; $i < 10; $i++)
{
    if($arr[$i] % 2 != 0)
    {
        echo $arr[$i] . "<br/>";
    }
}

echo "Con while: <br/>";

$i = 0;

while($i < 10)
{
    if($arr[$i] % 2 != 0)
    {
        echo $arr[$i] . "<br/>";
    }
    $i++;
}


echo "Con foreach: <br/>";


foreach($arr as $value)
{
    if($value % 2 != 0)
    {
        echo $value . "<br/>";
    }
}



?>