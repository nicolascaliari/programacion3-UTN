<!-- Aplicación No 13 (Invertir palabra)
Crear una función que reciba como parámetro un string ($palabra) y un entero ($max). La
función validará que la cantidad de caracteres que tiene $palabra no supere a $max y además
deberá determinar si ese valor se encuentra dentro del siguiente listado de palabras válidas:
“Recuperatorio”, “Parcial” y “Programacion”. Los valores de retorno serán: 1 si la palabra
pertenece a algún elemento del listado.
0 en caso contrario. -->


<!-- Nicolas Caliari -->

<?php




function ReverseWord($word, $max)
{
    $array = array("Recuperatorio", "Parcial", "Programacion");
    $WordLength =  strlen($word);
    $return = 0;

    if ($WordLength < $max && in_array($word, $array)) {
        $return = 1;
    }

    return $return;
}



 $value = ReverseWord('Recuperatorio' ,20);

 echo $value;

?>