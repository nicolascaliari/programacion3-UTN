<?php

class Venta
{
    public $mail;
    public $sabor;
    public $tipo;
    public $cantidad;
    public $fecha;
    public $numeroDePedido;
    public $id;

    public function __construct($mail, $sabor, $tipo, $cantidad, $id, $fecha = null, $numeroDePedido = null)
    {
       $this->mail = $mail;
       $this->sabor = $sabor;
       $this->tipo = $tipo;
       $this->cantidad = $cantidad;
       $this->id = $id;
       if($fecha == null){
        $this->fecha =  date("d-m-Y");
       }
       else{
        $this->fecha = $fecha;
       }
       if($numeroDePedido == null){
        $this->numeroDePedido = rand(1, 100000);
       }
       else{
        $this->numeroDePedido = $numeroDePedido;
       }
    }

    public static function RealizarVenta($arrayVentas, $path)
    {
        $ventasJson = json_encode($arrayVentas);
        $archivo = fopen($path, "w");

        if ($archivo == FALSE) {
            echo "No se creo el archivo\n";
        } else 
        {
            if ((fwrite($archivo, $ventasJson)) !== FALSE) 
            {
                echo "Venta registrada\n";
            }
        }
        fclose($archivo);
    }

    public static function LeerIdJson($path){
        $id = 0;
        $datos = "";
        $bufferId = -1;
        if(file_exists($path)){
            $archivo = fopen($path, "r");
            if($archivo == FALSE)
            {
                echo "El archivo no existe";
            }
            else
            {
                while (!feof($archivo))
                {
                    $datos .= fgets($archivo);    
                }
                $buffer = json_decode($datos, true);
                if($buffer != null){
                    if(count($buffer)==1){
                        $id = $buffer[0]['id'];
                    }
                    else{
                        
                        foreach($buffer as $i){
                            $bufferId = $i['id'];
                                if($bufferId > $id)
                                {
                                    $id = $bufferId;
                                }
                        }
                    }
                }
                fclose($archivo);
            }
        }
        return (int)$id;
    }
    public static function LeerVentasJson($path){
        $datos = "";
        $arrayVentas = array();
        if(file_exists($path)){
            $archivo = fopen($path, "r");
            if($archivo == FALSE)
            {
                echo "El archivo no existe";
            }
            else
            {
                while (!feof($archivo))
                {
                    $datos .= fgets($archivo);
                }
                $buffer = json_decode($datos, true);
                if($buffer != null){
                    if(count($buffer)==1){
                        $nuevaVenta = new Venta($buffer[0]["mail"], $buffer[0]["sabor"], $buffer[0]["tipo"], $buffer[0]["cantidad"], $buffer[0]["id"], $buffer[0]["fecha"], $buffer[0]["numeroDePedido"]);
                        array_push($arrayVentas, $nuevaVenta);
                    }
                    else{ 
                        foreach($buffer as $i){
                            $nuevaVenta = new Venta($i["mail"], $i["sabor"], $i["tipo"], $i["cantidad"], $i["id"], $i["fecha"], $i["numeroDePedido"]);
                            array_push($arrayVentas, $nuevaVenta); 
                        }
                    }    
                }
                       
                fclose($archivo);
            }
        }
        
        return $arrayVentas;
    }
    public static function CantidadTotalDePizzasVendidas($arrayVentas)
    {
        $sumatoria = 0;
        if(count($arrayVentas) > 0)
        {
            foreach($arrayVentas as $venta){
                $sumatoria += $venta->cantidad;
            }
        }
        return $sumatoria;
    }
    public function FechaDentroRango($fechaInicio, $fechaLimite)
    {
        $fechaVenta = strtotime($this->fecha);
        $inicio = strtotime($fechaInicio);
        $fin = strtotime($fechaLimite);
        if($fechaVenta >= $inicio && $fechaVenta <=$fin)
        {
            return true;
        }
        return false;
    }
    public static function FiltrarVentasPorFecha($arrayVentas, $fechaInicio, $fechaLimite)
    {
        $nuevoArrayFiltrado = array();
        if(count($arrayVentas) > 0)
        {
            foreach($arrayVentas as $venta){
                if($venta->FechaDentroRango($fechaInicio, $fechaLimite)){
                    array_push($nuevoArrayFiltrado, $venta);
                }
            }
        }
        return $nuevoArrayFiltrado;
    }
    public static function CompareSabor($a, $b){
        return strcmp($a->sabor, $b->sabor);
    }
    public static function OrdenarVentasPorSabor($arrayVentas){
        usort($arrayVentas, 'Venta::CompareSabor');
        return $arrayVentas;
    }
    public static function FiltrarPorUsuario($arrayVentas, $mail)
    {
        $nuevoArrayFiltrado = array();
        if(count($arrayVentas) > 0)
        {
            foreach($arrayVentas as $venta){
                if($venta->mail == $mail){
                    array_push($nuevoArrayFiltrado, $venta);
                }
            }
        }
        return $nuevoArrayFiltrado;
    }
    public static function FiltrarPorSabor($arrayVentas, $sabor)
    {
        $nuevoArrayFiltrado = array();
        if(count($arrayVentas) > 0)
        {
            foreach($arrayVentas as $venta){
                if($venta->sabor == $sabor){
                    array_push($nuevoArrayFiltrado, $venta);
                }
            }
        }
        return $nuevoArrayFiltrado;
    }
    public static function MostrarVentas($arrayVentas){
        if(count($arrayVentas) > 0){
            foreach($arrayVentas as $venta){
            
                echo "Usuario: ", $venta->mail, "\n";
                echo "sabor: ", $venta->sabor, "\n";
                echo "tipo: ", $venta->tipo, "\n";
                echo "cantidad: ", $venta->cantidad, "\n";
                echo "fecha: ", $venta->fecha, "\n";
                echo "numero de pedido: ", $venta->numeroDePedido, "\n";
                echo "id: ", $venta->id, "\n\n";
            }
        }
        else{
            echo "No se encontraron coincidencias\n";
        }
    }
    public static function VentaYaExiste($arrayVentas, $numeroDePedido)
    {
        $index = -1;
        if(count($arrayVentas) > 0){
            foreach($arrayVentas as $indice => $venta){
                if($venta->numeroDePedido == $numeroDePedido){
                    $index = $indice;
                    break;
                }
            }
        } 
        return $index;
    }
    public static function ModificarVenta($venta, $arrayVentas, $indice, $path)
    {
        $arrayVentas[$indice]->mail = $venta->mail;
        $arrayVentas[$indice]->sabor = $venta->sabor;
        $arrayVentas[$indice]->tipo = $venta->tipo;
        $arrayVentas[$indice]->cantidad = $venta->cantidad;

        $ventaJson = json_encode($arrayVentas);
        $archivo = fopen($path, "w");

        if ($archivo == FALSE) {
            echo "Hay un problema con el archivo\n";
        } else 
        {
            if ((fwrite($archivo, $ventaJson)) !== FALSE) 
            {
                echo "Archivo de ventas actualizado\n";
            }
        }
        fclose($archivo);
    }
    public function DefinirDestinoImagen($ruta){
        $usuarioMail = strtok($this->mail, '@');
        $destino = $ruta."\\".$this->tipo."-".$this->sabor."-".$usuarioMail."-".$this->fecha.".png";
        return $destino;
    }
    public static function BorrarVenta($arrayVentas, $path, $indice, $rutaImagenes, $rutaEliminarImagen){
        $nombreImagenOrigen = $arrayVentas[$indice]->DefinirDestinoImagen($rutaImagenes);
        $destinoImagenBorrada = $arrayVentas[$indice]->DefinirDestinoImagen($rutaEliminarImagen);
        
        unset($arrayVentas[$indice]);

        $ventaJson = json_encode($arrayVentas);
        $archivo = fopen($path, "w");

        if ($archivo == FALSE) {
            echo "Hay un problema con el archivo\n";
        } else 
        {
            if ((fwrite($archivo, $ventaJson)) !== FALSE) 
            {
                echo "Archivo de ventas actualizado\n";
            }
        }
        fclose($archivo);
        if(rename($nombreImagenOrigen, $destinoImagenBorrada))
        {
            echo "Se guardo la imagen en: ", $destinoImagenBorrada;
        }
        else{
            echo "La imagen sigue en: ", $nombreImagenOrigen;
        }
    }
}
?>