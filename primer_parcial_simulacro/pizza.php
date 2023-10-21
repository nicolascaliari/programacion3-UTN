<?php       

class Pizza
{
    public $sabor;
    public $precio;
    public $tipo;
    public $cantidad;
    public $id;

    public function __construct($sabor, $precio, $tipo, $cantidad, $id)
    {
            $this->sabor = $sabor;
            $this->precio = $precio;
            $this->tipo = $tipo;
            $this->cantidad = $cantidad;
            $this->id = $id;
        
        
    }

    public function PizzaYaExiste($arrayPizzas)
    {
        $index = -1;
        if(count($arrayPizzas) > 0){
            foreach($arrayPizzas as $indice => $pizza){
                if($this->sabor == $pizza->sabor && $this->tipo == $pizza->tipo){
                    $index = $indice;
                    break;
                }
            }
        } 
        return $index;
    }
    public function ExisteTipo($arrayPizzas){
        $index = -1;
        if(count($arrayPizzas) > 0){
            foreach($arrayPizzas as $indice => $pizza){
                if($this->tipo == $pizza->tipo){
                    $index = $indice;
                    break;
                }
            }
        } 
        return $index;
    }
    public function ExisteSabor($arrayPizzas){
        $index = -1;
        if(count($arrayPizzas) > 0){
            foreach($arrayPizzas as $indice => $pizza){
                if($this->sabor == $pizza->sabor){
                    $index = $indice;
                    break;
                }
            }
        } 
        return $index;
    }
    public static function ConsultarStock($arraypizzas, $indice){
        $stock = $arraypizzas[$indice]->cantidad;
        
        return $stock;
    }
    public static function AgregarCantidad($pizza, $arraypizzas, $indice, $path)
    {
        $arraypizzas[$indice]->cantidad += $pizza->cantidad;
        echo "Nueva cantidad de: ". $arraypizzas[$indice]->sabor. " dde tipo: ". $arraypizzas[$indice]->tipo. " es: ". $arraypizzas[$indice]->cantidad."\n";
        $pizzaJson = json_encode($arraypizzas);
        $archivo = fopen($path, "w");

        if ($archivo == FALSE) {
            echo "Hay un problema con el archivo\n";
        } else 
        {
            if ((fwrite($archivo, $pizzaJson)) !== FALSE) 
            {
                echo "Actualizado\n";
            }
        }
        fclose($archivo);
    }
    public static function DescontarCantidad($pizza, $arraypizzas, $indice, $path)
    {
        $arraypizzas[$indice]->cantidad -= $pizza->cantidad;
        echo "Nueva cantidad de: ". $arraypizzas[$indice]->sabor. " dde tipo: ". $arraypizzas[$indice]->tipo. " es: ". $arraypizzas[$indice]->cantidad."\n";
        $pizzaJson = json_encode($arraypizzas);
        $archivo = fopen($path, "w");

        if ($archivo == FALSE) {
            echo "Hay un problema con el archivo\n";
        } else 
        {
            if ((fwrite($archivo, $pizzaJson)) !== FALSE) 
            {
                echo "Stock actualizado\n";
            }
        }
        fclose($archivo);
    }
    public static function ActualizarPrecio($pizza, $arraypizzas, $indice, $path)
    {
        $arraypizzas[$indice]->precio = $pizza->precio;
        echo "Nuevo precio de: ". $arraypizzas[$indice]->sabor. " de tipo: ". $arraypizzas[$indice]->tipo. " es: ". $arraypizzas[$indice]->precio."\n";
        $pizzaJson = json_encode($arraypizzas);
        $archivo = fopen($path, "w");

        if ($archivo == FALSE) {
            echo "Hay un problema con el archivo\n";
        } else 
        {
            if ((fwrite($archivo, $pizzaJson)) !== FALSE) 
            {
                echo "Actualizado\n";
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
    public static function LeerPizzaJson($path){
        $datos = "";
        $arrayPizzas = array();
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
                        $nuevaPizza = new Pizza($buffer[0]["sabor"], $buffer[0]["precio"], $buffer[0]["tipo"], $buffer[0]["cantidad"], $buffer[0]["id"]);
                        array_push($arrayPizzas, $nuevaPizza);
                    }
                    else{ 
                        foreach($buffer as $i){
                            $nuevaPizza = new Pizza($i["sabor"], $i["precio"], $i["tipo"], $i["cantidad"], $i["id"]);
                            array_push($arrayPizzas, $nuevaPizza); 
                        }
                    }    
                }
                       
                fclose($archivo);
            }
        }
        
        return $arrayPizzas;
    }
    public static function AltaPizza($arrayPizzas, $path){
        $pizasJson = json_encode($arrayPizzas);
        $archivo = fopen($path, "w");

        if ($archivo == FALSE) {
            echo "No se creo el archivo\n";
        } else 
        {
            if ((fwrite($archivo, $pizasJson)) !== FALSE) 
            {
                echo "Ingresado\n";
            }
        }
        fclose($archivo);
    }
    
}
?>