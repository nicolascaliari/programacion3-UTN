<!-- Aplicación No 6 (Carga aleatoria)
Definir un Array de 5 elementos enteros y asignar a cada uno de ellos un número (utilizar la
función rand). Mediante una estructura condicional, determinar si el promedio de los números
son mayores, menores o iguales que 6. Mostrar un mensaje por pantalla informando el
resultado.

Nicolas Caliari -->

<?php


$arr = array(rand(10,100),rand(10,100),rand(10,100),rand(10,100),rand(10,100));

$promedio = array_sum($arr) / count($arr);

if($promedio > 6)
{
    echo "El promedio es mayor a 6";
}
else if($promedio < 6)
{
    echo "El promedio es menor a 6";
}
else
{
    echo "El promedio es igual a 6";
}

?>