<?php

class Deposito
{
    public $id;
    public $fecha;
    public $monto;
    public $tipoCuenta;
    public $numeroCuenta;
    public $moneda;
    public $cuenta;

    public function __construct()
    {
        $params = func_get_args();
        $num_params = func_num_args();
        $funcion_constructor = '__construct' . $num_params;
        if (method_exists($this, $funcion_constructor)) {
            call_user_func_array(array($this, $funcion_constructor), $params);
        }
    }

    public function __construct5($tipoCuenta, $numeroCuenta, $moneda, $monto, $cuenta)
    {
        $this->id = rand(100, 999);
        $this->tipoCuenta = $tipoCuenta;
        $this->numeroCuenta = $numeroCuenta;
        $this->moneda = $moneda;
        $this->monto = $monto;
        $this->fecha = date("d-m-Y");
        $this->cuenta = $cuenta;
    }

    public function __construct7($id, $tipoCuenta, $numeroCuenta, $moneda, $monto, $fecha, $cuenta)
    {
        $this->id = $id;
        $this->tipoCuenta = $tipoCuenta;
        $this->numeroCuenta = $numeroCuenta;
        $this->moneda = $moneda;
        $this->monto = $monto;
        $this->fecha = $fecha;
        $this->cuenta = $cuenta;
    }


    public static function LeerJSONDeposito()
    {
        $pathJSON = './depositos.json';
        if (file_exists($pathJSON)) {
            $cuentas = json_decode(file_get_contents($pathJSON), true);
            if ($cuentas != null) {
                $cuentasObj = array();
                foreach ($cuentas as $cuenta) {
                    $cuentaObj = new Deposito($cuenta['id'], $cuenta['fecha'], $cuenta['monto'], $cuenta['tipoCuenta'], $cuenta['numeroCuenta'], $cuenta['moneda'], $cuenta['cuenta']);
                    var_dump($cuentaObj);
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


    public static function DepositoExiste($numeroCuenta)
    {
        $depositos = Deposito::LeerJSONDeposito();
        if (count($depositos) > 0) {
            foreach ($depositos as $deposito) {
                if ($deposito->numeroCuenta === $numeroCuenta) {
                    return true;
                }
            }
        }
        return false;
    }


    public function DestinoImagenDeposito($ruta)
    {
        $destino = $ruta . "\\" . $this->tipoCuenta . "-" . $this->numeroCuenta . "-" . $this->id . ".png";
        return $destino;
    }


    public static function MostrarDepositos($depositos)
    {
        if (count($depositos) > 0) {
            foreach ($depositos as $deposito) {
                echo "ID: ", $deposito->id, "\n";
                echo "Tipo Cuenta: ", $deposito->tipoCuenta, "\n";
                echo "Numero Cuenta: ", $deposito->numeroCuenta, "\n";
                echo "Moneda: ", $deposito->moneda, "\n";
                echo "Deposito: ", $deposito->monto, "\n";
                echo "Fecha: ", $deposito->fecha, "\n\n";
            }
        }
    }



    public static function MovimientosPorTipoYMoneda($tipo, $moneda, $fecha)
    {
        $depositos = Deposito::LeerJSONDeposito();

        $total = 0;

        foreach ($depositos as $deposito) {
            if ($deposito->tipoCuenta == $tipo && $deposito->moneda == $moneda && $deposito->fecha == $fecha) {
                $total += $deposito->monto;
            }
        }
        return $total;
    }



    public static function MovimientosPorUsuario($numeroCuenta)
    {
        $depositos = Deposito::LeerJSONDeposito();
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
        $depositos = Deposito::LeerJSONDeposito();
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
        usort($depositos, 'Deposito::CompararNumeroCuenta');
        return $depositos;
    }



    public static function MovimientosPorTipoCuenta($tipoCuenta)
    {
        $depositos = Deposito::LeerJSONDeposito();
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
        $depositos = Deposito::LeerJSONDeposito();
        $depositosPorMoneda = array();
        foreach ($depositos as $deposito) {
            if ($deposito->moneda == $moneda) {
                array_push($depositosPorMoneda, $deposito);
            }
        }
        return $depositosPorMoneda;
    }


    public static function BuscarDeposito($id)
    {
        $depositos = Deposito::LeerJSONDeposito();
        foreach ($depositos as $deposito) {
            if ($deposito->id == $id) {
                return $deposito;
            }
        }
        return false;
    }
}

?>