<?php

function ValidarTipoCuenta($tipoCuenta)
{
    $retorno = false;
    if ($tipoCuenta == "CA$" || $tipoCuenta == "CAU$" || $tipoCuenta == "CC$" || $tipoCuenta == "CCU$") {
        $retorno = true;
        return $retorno;
    } else {
        return $retorno;
    }
}


function ValidarMoneda($moneda)
{
    $retorno = false;
    if ($moneda == "ARS" || $moneda == "USD") {
        $retorno = true;
        return $retorno;
    } else {
        return $retorno;
    }
}




?>