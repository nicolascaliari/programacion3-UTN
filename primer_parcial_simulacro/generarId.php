<?php

class IDGenerador
{
    private static $ultimoIDPizza = 0;
    private static $ultimoIDVenta = 0;

    public static function GenerarIdPizza($path){
        IDGenerador::$ultimoIDPizza = (Pizza::LeerIdJson($path))+1;
        return IDGenerador::$ultimoIDPizza;
    }
    public static function GenerarIdVenta($path){
        IDGenerador::$ultimoIDVenta = (Venta::LeerIdJson($path))+1;
        return IDGenerador::$ultimoIDVenta;
    }
}
?>