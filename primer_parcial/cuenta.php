<?php
class Cuenta{
    public $numeroCuenta;
    public $nombre;
    public $tipoDoc;
    public $numeroDoc;
    public $mail;
    public $tipoCuenta;
    public $moneda;
    public $saldo;

    public function __construct(){
		$params = func_get_args();
		$num_params = func_num_args();
		$funcion_constructor ='__construct'.$num_params;
		if (method_exists($this,$funcion_constructor)) {
			call_user_func_array(array($this,$funcion_constructor),$params);
		}
    }

    public function __construct7($nombre, $tipoDoc, $numeroDoc, $mail, $tipoCuenta, $moneda, $saldo) {
        $this->numeroCuenta = rand(100000, 999999);
        $this->nombre = $nombre;
        $this->tipoDoc = $tipoDoc;
        $this->numeroDoc = $numeroDoc;
        $this->mail = $mail;
        $this->tipoCuenta = $tipoCuenta;
        $this->moneda = $moneda;
        $this->saldo = $saldo;
    }
    public function __construct8($numeroCuenta, $nombre, $tipoDoc, $numeroDoc, $mail, $tipoCuenta, $moneda, $saldo) {
        $this->numeroCuenta = $numeroCuenta;
        $this->nombre = $nombre;
        $this->tipoDoc = $tipoDoc;
        $this->numeroDoc = $numeroDoc;
        $this->mail = $mail;
        $this->tipoCuenta = $tipoCuenta;
        $this->moneda = $moneda;
        $this->saldo = $saldo;
    }

    public static function LeerJSONCuenta(){
        $pathJSON = './banco.json';
        if(file_exists($pathJSON)){
            $cuentas = json_decode(file_get_contents($pathJSON), true);
            if($cuentas != null){
                $cuentasObj = array();
                foreach($cuentas as $cuenta){
                    $cuentaObj = new Cuenta($cuenta['numeroCuenta'], $cuenta['nombre'], $cuenta['tipoDoc'], $cuenta['numeroDoc'], $cuenta['mail'], $cuenta['tipoCuenta'], $cuenta['moneda'], $cuenta['saldo']); 
                    $cuentasObj[] = $cuentaObj;
                }
                return $cuentasObj;
            }  
        }
        return [];
    }

    public static function EscribirJSONCuenta($cuentas){
        if(file_put_contents('banco.json', json_encode($cuentas)) != false){
            return true;
        }
        
        return false;
    }

    public function ActualizarSaldo($saldo){
        $cuentas = Cuenta::LeerJSONCuenta();
        if(count($cuentas)> 0){
            foreach($cuentas as &$cuenta){
                if($cuenta->numeroDoc === $this->numeroDoc){
                    $cuenta->saldo = $saldo;
                    Cuenta::EscribirJSONCuenta($cuentas);
                    return true;
                }
            }
        }
       
        return false;
    } 

    public function DestinoImagenCuenta($ruta){
        $destino = $ruta."\\".$this->numeroCuenta."-".$this->tipoCuenta.".png";
        return $destino;
    }
     
    public static function CuentaExiste($numeroCuenta){
        echo "estoy";
        $cuentas = Cuenta::LeerJSONCuenta();
        if(count($cuentas)> 0){
            foreach($cuentas as $cuenta){
                if($cuenta->numeroCuenta == $numeroCuenta){
                    return $cuenta;
                }
            }
        }
        return false;
    }

    public function TipoCuentaCorresponde($tipoCuenta){
        if($this->tipoCuenta == $tipoCuenta){
            return true;
        }
        return false;
    }
   
}
?>