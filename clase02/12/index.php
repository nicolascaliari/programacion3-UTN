<?php
// Aplicación No 12 (Invertir palabra)
// Realizar el desarrollo de una función que reciba un Array de caracteres y que invierta el orden
// de las letras del Array.
// Ejemplo: Se recibe la palabra “HOLA” y luego queda “ALOH”.

//Nicolas Caliari



// strlen lo uso para el largo de la palabra


function InvertirPalabra($word){

    $wordLength = strlen($word); 

    echo $wordLength . "<br>";
    $newWord = "";

    for($i = $wordLength - 1 ; $i >= 0; $i--)
    {
        $newWord .= $word[$i];
    }

    echo $newWord;
}


$word = "hola";
InvertirPalabra($word);