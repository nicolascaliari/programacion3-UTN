<?php

function POST_consultarVentas($arrayVentas){
    if(!isset($_POST['fechaInicio'],  $_POST['fechaLimite'], $_POST['mail'], $_POST['sabor']))
    {
        echo "ERROR!! Carga de datos invalida";
    }
    else{
        $fechaInicio = $_POST['fechaInicio'];
        $fechaLimite = $_POST['fechaLimite'];
        $mail =  $_POST['mail'];
        $sabor = $_POST['sabor'];

        $totalPizzasVendidas = Venta::CantidadTotalDePizzasVendidas($arrayVentas);
        echo "a- La cantidad de pizzas vendidas es: ", $totalPizzasVendidas, "\n\n";

        $arrayFiltradoFechas = Venta::FiltrarVentasPorFecha($arrayVentas, $fechaInicio, $fechaLimite);
        $arrayOdenado = Venta::OrdenarVentasPorSabor($arrayFiltradoFechas);
        echo "b- Ventas realizadas entre el: ", $fechaInicio, " y el: ", $fechaLimite, "\n\n";
        Venta::MostrarVentas($arrayOdenado);

        $arrayFiltradoUsuario = Venta::FiltrarPorUsuario($arrayVentas, $mail);
        echo "c- Ventas realizadas al usuario: ", $mail, "\n\n";
        Venta::MostrarVentas($arrayFiltradoUsuario);
       
        $arrayFiltradoSabor = Venta::FiltrarPorSabor($arrayVentas, $sabor); 
        echo "d- Ventas realizadas de sabor: ", $sabor, "\n\n";
        Venta::MostrarVentas($arrayFiltradoSabor);
    }
}
?>