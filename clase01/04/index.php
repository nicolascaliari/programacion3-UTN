<!-- Aplicación No 4 (Calculadora)
Escribir un programa que use la variable $operador que pueda almacenar los símbolos
matemáticos: ‘+’, ‘-’, ‘/’ y ‘*’; y definir dos variables enteras $op1 y $op2. De acuerdo al
símbolo que tenga la variable $operador, deberá realizarse la operación indicada y mostrarse el
resultado por pantalla. -->

<?php

function calculadora($numeroUno, $numeroDos, $operador)
{
    $resultado = 0;
    switch ($operador) {
        case '+':
            $resultado = $numeroUno + $numeroDos;
            echo "el resultado es : ", $resultado;
            break;

        case '-':
            $resultado = $numeroUno - $numeroDos;
            echo "el resultado es : ", $resultado;
            break;

        case '*':
            $resultado = $numeroUno * $numeroDos;
            echo "el resultado es : ", $resultado;
            break;

        case '/':
            $resultado = $numeroUno / $numeroDos;
            echo "el resultado es : ", $resultado;
            break;

        default:
            printf("Ingreso mal algun signo");
            break;
    }
}


calculadora(5, 3, '/');


?>