<!-- Aplicación No 1 (Sumar números)
Confeccionar un programa que sume todos los números enteros desde 1 mientras la suma no
supere a 1000. Mostrar los números sumados y al finalizar el proceso indicar cuantos números
se sumaron. -->

<?php
$numero = 0;
$acumulador = 0;
    for($i = 0; $i < 40 ; $i++)
    { 
            $numero++;
            $acumulador+=$numero;
           echo  "   " , $numero;
    }

    echo " Total: ", $i;
?>