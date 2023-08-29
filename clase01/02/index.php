<!-- Aplicación No 2 (Mostrar fecha y estación)
Obtenga la fecha actual del servidor (función date) y luego imprímala dentro de la página con
distintos formatos (seleccione los formatos que más le guste). Además indicar que estación del
año es. Utilizar una estructura selectiva múltiple. -->

<?php

$fechaActual = date("Y-m-d H:i:s");

echo "Fecha actual en formato predeterminado: $fechaActual<br>";

$mesActual = date("n");

switch ($mesActual) {
    case 6:
    case 7:
    case 8:
    case 9:
        $estacion = "Invierno";
        break;
    case 6:
    case 7:
    case 8:
    case 9:
        $estacion = "Primavera";
        break;
    case 9:
    case 10:
    case 11:
    case 12:
        $estacion = "Verano";
        break;
    case 12:
    case 1:
    case 2:
    case 3:
        $estacion = "Otoño";
        break;
    default:
        $estacion = "Mes desconocido";
        break;
}

echo "Estación del año actual: $estacion";
