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


    public static function BuscarMontoRetiro($id)
    {
        $retiros = Retiro::LeerJSONRetiro();
        foreach ($retiros as $retiro) {
            if ($retiro->id == $id) {
                return $retiro->monto;
            }
        }
        return false;
    }

    public static function AjustarRetiroEnCuenta($numeroCuenta, $ajuste)
    {
        $cuentas = Cuenta::LeerJSONCuenta();
        foreach ($cuentas as &$cuenta) {
            if ($cuenta->numeroCuenta == $numeroCuenta) {
                $cuenta->saldo = $cuenta->saldo + $ajuste;
                return $cuentas;
            }
        }
        return false;

    }

    public static function MostrarRetiros($retiros)
    {
        if (count($retiros) > 0) {
            foreach ($retiros as $retiro) {
                echo "ID: ", $retiro->id, "\n";
                echo "Tipo Cuenta: ", $retiro->tipoCuenta, "\n";
                echo "Numero Cuenta: ", $retiro->numeroCuenta, "\n";
                echo "Deposito: ", $retiro->monto, "\n";
                echo "Fecha: ", $retiro->fecha, "\n\n";
            }
        }
    }


    public static function RetirosPorUsuario($numeroCuenta)
    {
        $depositos = Retiro::LeerJSONRetiro();
        $depositosUsuario = array();
        if (count($depositos) > 0) {
            foreach ($depositos as $deposito) {
                if ($deposito->numeroCuenta == $numeroCuenta) {
                    array_push($depositosUsuario, $deposito);
                }
            }
            return $depositosUsuario;
        }
        return false;
    }




    public function FechaDentroRango($fechaInicio, $fechaLimite)
    {
        $fechaDeposito = strtotime($this->fecha);
        $inicio = strtotime($fechaInicio);
        $fin = strtotime($fechaLimite);
        if ($fechaDeposito >= $inicio && $fechaDeposito <= $fin) {
            return true;
        }
        return false;
    }

    public static function FiltrarDepositosPorFecha($fechaInicio, $fechaLimite)
    {
        $nuevoArrayFiltrado = array();
        $depositos = Retiro::LeerJSONRetiro();
        if (count($depositos) > 0) {
            foreach ($depositos as $deposito) {
                if ($deposito->FechaDentroRango($fechaInicio, $fechaLimite)) {
                    array_push($nuevoArrayFiltrado, $deposito);
                }
            }
        }
        return $nuevoArrayFiltrado;
    }

    public static function CompararNumeroCuenta($a, $b)
    {
        return $a->numeroCuenta > $b->numeroCuenta;
    }
    public static function OrdenarDepositosPorNumeroCuenta($depositos)
    {
        usort($depositos, 'Retiro::CompararNumeroCuenta');
        return $depositos;
    }



    public static function RetiroPorTipoCuenta($tipoCuenta)
    {
        $depositos = Retiro::LeerJSONRetiro();
        $depositosPorTipoCuenta = array();
        foreach ($depositos as $deposito) {
            if ($deposito->tipoCuenta == $tipoCuenta) {
                array_push($depositosPorTipoCuenta, $deposito);
            }
        }
        return $depositosPorTipoCuenta;
    }


    public static function MovimientosPorMoneda($moneda)
    {
        $depositos = Retiro::LeerJSONRetiro();
        $depositosPorMoneda = array();
        foreach ($depositos as $deposito) {
            if ($deposito->moneda == $moneda) {
                array_push($depositosPorMoneda, $deposito);
            }
        }
        return $depositosPorMoneda;
    }


    public static function MovimientosPorTipoYMoneda($tipo, $moneda, $fecha)
    {
        $depositos = Retiro::LeerJSONRetiro();

        $total = 0;

        foreach ($depositos as $deposito) {
            if ($deposito->tipoCuenta == $tipo && $deposito->moneda == $moneda && $deposito->fecha == $fecha) {
                $total += $deposito->monto;
            }
        }
        return $total;
    }

}

?>