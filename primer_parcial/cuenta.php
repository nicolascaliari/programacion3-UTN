<?php
class Cuenta
{
    public $numeroCuenta;
    public $nombre;
    public $tipoDoc;
    public $numeroDoc;
    public $mail;
    public $tipoCuenta;
    public $saldo;


    public function __construct()
    {
        $params = func_get_args();
        $num_params = func_num_args();
        $funcion_constructor = '__construct' . $num_params;
        if (method_exists($this, $funcion_constructor)) {
            call_user_func_array(array($this, $funcion_constructor), $params);
        }
    }

    public function __construct6($nombre, $tipoDoc, $numeroDoc, $mail, $tipoCuenta, $saldo)
    {
        $this->numeroCuenta = rand(100000, 999999);
        $this->nombre = $nombre;
        $this->tipoDoc = $tipoDoc;
        $this->numeroDoc = $numeroDoc;
        $this->mail = $mail;
        $this->tipoCuenta = $tipoCuenta;
        $this->saldo = $saldo;
    }
    public function __construct7($numeroCuenta, $nombre, $tipoDoc, $numeroDoc, $mail, $tipoCuenta, $saldo = null)
    {
        $this->numeroCuenta = $numeroCuenta;
        $this->nombre = $nombre;
        $this->tipoDoc = $tipoDoc;
        $this->numeroDoc = $numeroDoc;
        $this->mail = $mail;
        $this->tipoCuenta = $tipoCuenta;
        $this->saldo = $saldo;
    }



    public static function LeerJSONCuenta()
    {
        $pathJSON = './banco.json';
        if (file_exists($pathJSON)) {
            $cuentas = json_decode(file_get_contents($pathJSON), true);
            if ($cuentas != null) {
                $cuentasObj = array();
                // echo "go";
                foreach ($cuentas as $cuenta) {
                    // echo "go";
                    var_dump($cuentas);
                    $cuentaObj = new Cuenta($cuenta['numeroCuenta'], $cuenta['nombre'], $cuenta['tipoDoc'], $cuenta['numeroDoc'], $cuenta['mail'], $cuenta['tipoCuenta'], $cuenta['saldo']);
                    $cuentasObj[] = $cuentaObj;
                }
                //echo "go";
                return $cuentasObj;
            }
        }
        return [];
    }

    public static function EscribirJSONCuenta($cuentas)
    {
        if (file_put_contents('banco.json', json_encode($cuentas)) != false) {
            return true;
        }

        return false;
    }

    public function ActualizarSaldo($saldo)
    {
        $cuentas = Cuenta::LeerJSONCuenta();
        if (count($cuentas) > 0) {
            foreach ($cuentas as &$cuenta) {
                if ($cuenta->numeroDoc === $this->numeroDoc) {
                    $cuenta->saldo += $saldo;
                    Cuenta::EscribirJSONCuenta($cuentas);
                    return true;
                }
            }
        }

        return false;
    }

    // public function DestinoImagenCuenta($ruta)
    // {
    //     $destino = $ruta . "\\" . $this->numeroCuenta . "-" . $this->tipoCuenta . ".png";
    //     return $destino;
    // }




    public static function CuentaYaExiste($numeroDeCuenta)
    {

        $arrayCuentas = Cuenta::LeerJSONCuenta();

        $index = -1;
        if (count($arrayCuentas) > 0) {
            foreach ($arrayCuentas as $indice => $cuenta) {
                if ($cuenta->numeroCuenta == $numeroDeCuenta) {
                    $index = $indice;
                    break;
                }
            }
        }
        return $index;
    }




    public static function CuentaExiste($numeroCuenta, $tipoCuenta)
    {
        //  echo "go";
        $cuentas = Cuenta::LeerJSONCuenta();
        echo "pepe";
        if (count($cuentas) > 0) {
            //a    echo "go";
            foreach ($cuentas as $cuenta) {
                if ($cuenta->numeroCuenta == $numeroCuenta && $cuenta->tipoCuenta == $tipoCuenta) {
                    return $cuenta;
                }
            }
        }
        return false;
    }

    public function TipoCuentaCorresponde($tipoCuenta)
    {
        if ($this->tipoCuenta == $tipoCuenta) {
            return true;
        }
        return false;
    }



    public static function ModificarCuenta($venta, $indice)
    {

        $cuenta = Cuenta::LeerJSONCuenta();

        $cuenta[$indice]->numeroCuenta = $venta->numeroCuenta;
        $cuenta[$indice]->nombre = $venta->nombre;
        $cuenta[$indice]->tipoDoc = $venta->tipoDoc;
        $cuenta[$indice]->numeroDoc = $venta->numeroDoc;
        $cuenta[$indice]->mail = $venta->mail;
        $cuenta[$indice]->tipoCuenta = $venta->tipoCuenta;
        $cuenta[$indice]->moneda = $venta->moneda;

        $ventaJson = json_encode($cuenta);
        $archivo = fopen("banco.json", "w");

        if ($archivo == FALSE) {
            echo "Hay un problema con el archivo\n";
        } else {
            if ((fwrite($archivo, $ventaJson)) !== FALSE) {
                echo "Archivo de ventas actualizado\n";
            }
        }
        fclose($archivo);
    }



    public static function RetirarDinero($monto, $indice)
    {
        $cuentas = Cuenta::LeerJSONCuenta();
        $cuentas[$indice]->saldo -= $monto;

        $ventaJson = json_encode($cuentas);
        $archivo = fopen("banco.json", "w");

        if ($archivo == FALSE) {
            echo "Hay un problema con el archivo\n";
        } else {
            if ((fwrite($archivo, $ventaJson)) !== FALSE) {
                echo "Archivo de ventas actualizado\n";
            }
        }
        fclose($archivo);
    }


    public static function VerificarSaldo($monto, $numeroCuenta)
    {
        $cuentas = Cuenta::LeerJSONCuenta();
        foreach ($cuentas as &$cuenta) {
            if ($cuenta->numeroCuenta == $numeroCuenta) {
                if ($cuenta->saldo > $monto) {
                    return true;
                } else {
                    return false;
                }
            }
        }
        return false;
    }

    public static function AjustarCuenta($numeroCuenta, $ajuste)
    {
        var_dump($numeroCuenta);
        $cuentas = Cuenta::LeerJSONCuenta();
        if (count($cuentas) > 0) {
            foreach ($cuentas as &$cuenta) {
                if ($cuenta->numeroCuenta == $numeroCuenta) {
                    var_dump($cuenta->numeroCuenta);
                    $cuenta->saldo = $cuenta->saldo - $ajuste;
                    Cuenta::EscribirJSONCuenta($cuentas);
                    return true;
                }
            }
        }

        return false;
    }


    public function DefinirDestinoImagen($ruta)
    {
        echo "go";
        $destino = str_replace('\\', '/', $ruta) . $this->numeroCuenta . '.png';
        return $destino;
    }

}
?>