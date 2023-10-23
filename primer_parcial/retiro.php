<?php

class Retiro
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



    public static function LeerJSONRetiro()
    {
        $pathJSON = './retiro.json';
        if (file_exists($pathJSON)) {
            $retiros = json_decode(file_get_contents($pathJSON), true);
            if ($retiros != null) {
                $cuentasObj = array();
                foreach ($retiros as $retiro) {
                    $cuentaObj = new Retiro($retiro['id'], $retiro['fecha'], $retiro['monto'], $retiro['tipoCuenta'], $retiro['numeroCuenta'], $retiro['moneda']);
                    $cuentasObj[] = $cuentaObj;
                }
                return $cuentasObj;
            }
        }
        return [];
    }


    public static function EscribirJSONRetiro($retiros)
    {
        if (file_put_contents('retiro.json', json_encode($retiros)) != false) {
            return true;
        }
        return false;
    }


    public static function AgregarDineroARetiro()
    {
        $retiros = Retiro::LeerJSONRetiro();
        $id = 0;
        if (count($retiros) > 0) {
            $id = $retiros[count($retiros) - 1]->id + 1;
        }
        $fecha = date("d-m-Y");
        $monto = $_POST["monto"];
        $tipoCuenta = $_POST["tipoCuenta"];
        $numeroCuenta = $_POST["numeroCuenta"];
        $moneda = $_POST["moneda"];

        $retiro = new Retiro($id, $fecha, $monto, $tipoCuenta, $numeroCuenta, $moneda);
        $retiros[] = $retiro;
        Retiro::EscribirJSONRetiro($retiros);
    }
}

?>