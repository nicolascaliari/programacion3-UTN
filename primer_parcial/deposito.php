<?php

class Deposito
{
    public $id;
    public $fecha;
    public $monto;
    public $tipoCuenta;
    public $numeroCuenta;
    public $moneda;


    public function __construct($id, $fecha, $monto, $tipoCuenta, $numeroCuenta, $moneda)
    {
        $this->id = $id;
        $this->fecha = $fecha;
        $this->monto = $monto;
        $this->tipoCuenta = $tipoCuenta;
        $this->numeroCuenta = $numeroCuenta;
        $this->moneda = $moneda;
    }



    public static function LeerJSONDeposito()
    {
        $pathJSON = './depositos.json';
        if (file_exists($pathJSON)) {
            $cuentas = json_decode(file_get_contents($pathJSON), true);
            if ($cuentas != null) {
                $cuentasObj = array();
                foreach ($cuentas as $cuenta) {
                    $cuentaObj = new Deposito($cuenta['id'], $cuenta['fecha'], $cuenta['monto'], $cuenta['tipoCuenta'], $cuenta['numeroCuenta'], $cuenta['moneda']);
                    $cuentasObj[] = $cuentaObj;
                }
                return $cuentasObj;
            }
        }
        return [];
    }

    public static function EscribirJSONDeposito($depositos)
    {
        echo "estoy en escribir json";
        if (file_put_contents('depositos.json', json_encode($depositos)) != false) {
            return true;
        }

        return false;
    }


    public function DestinoImagenDeposito($ruta){
        $destino = $ruta."\\".$this->tipoCuenta."-".$this->numeroCuenta."-".$this->id.".png";
        return $destino;
    }
}

?>