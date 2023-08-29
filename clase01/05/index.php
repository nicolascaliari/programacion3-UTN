<!-- Aplicación No 5 (Números en letras)
Realizar un programa que en base al valor numérico de una variable $num, pueda mostrarse
por pantalla, el nombre del número que tenga dentro escrito con palabras, para los números
entre el 20 y el 60.
Por ejemplo, si $num = 43 debe mostrarse por pantalla “cuarenta y tres”.


Nicolas Caliari -->

<?php
$num = 39;

$numeros = array(
    0 => 'cero',
    1 => 'uno',
    2 => 'dos',
    3 => 'tres',
    4 => 'cuatro',
    5 => 'cinco',
    6 => 'seis',
    7 => 'siete',
    8 => 'ocho',
    9 => 'nueve',
    10 => 'diez',
    11 => 'once',
    12 => 'doce',
    13 => 'trece',
    14 => 'catorce',
    15 => 'quince',
    16 => 'dieciséis',
    17 => 'diecisiete',
    18 => 'dieciocho',
    19 => 'diecinueve',
    20 => 'veinte',
    30 => 'treinta',
    40 => 'cuarenta',
    50 => 'cincuenta',
    60 => 'sesenta'
);

if ($num >= 20 && $num <= 60) {
    if (array_key_exists($num, $numeros)) {
        echo $numeros[$num];
    } else {
        $decenas = floor($num / 10) * 10;
        $unidades = $num % 10;

        echo $decenas;
        echo $unidades;
        
        $resultado = $numeros[$decenas];
        if ($unidades > 0) {
            $resultado .= ' y ' . $numeros[$unidades];
        }
        
        echo $resultado;
    }
} else {
    echo "El número debe estar entre 20 y 60.";
}
?>
