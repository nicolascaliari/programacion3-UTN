<?php

class Producto
{
    private $_nombre;
    private $_tipo;
    private $_stock;
    private $_precio;
    private $_id;
    private $_codigoDeBarra;

    public function __construct($nombre, $tipo, $stock, $precio, $codigoDeBarra)
    {
        $this->_nombre = $nombre;
        $this->_tipo = $tipo;
        $this->_stock = $stock;
        $this->_precio = $precio;
        $this->_codigoDeBarra = $codigoDeBarra;
        $this->_id = rand(1, 10000);
    }


    public static function VerificarProductoExistente($producto)
    {
        $rutaArchivo = __DIR__ . '/productos.json';

        if (file_exists($rutaArchivo)) {
            $productosJSON = json_decode(file_get_contents($rutaArchivo), true);
            echo "entro";
            foreach ($productosJSON as $productoJSON) {
                if ($productoJSON['codigoDeBarra'] == $producto->_codigoDeBarra) {
                    echo "pase el producto";
                    return true;
                }
            }
        } else {
            echo 'El archivo "producto.json" no existe.';
            return false;
        }
    }




    public function AltaProducto($producto)
    {
        $productoArray = [
            'id' => $producto->_id,
            'nombre' => $producto->_nombre,
            'tipo' => $producto->_tipo,
            'stock' => $producto->_stock,
            'precio' => $producto->_precio,
            'codigoDeBarra' => $producto->_codigoDeBarra,
        ];

        $productos = [];
        if (file_exists('productos.json')) {
            $productos = json_decode(file_get_contents('productos.json'), true);
        }

        $productos[] = $productoArray;

        //el json pretty es para que quede bien ordenado.
        file_put_contents('productos.json', json_encode($productos, JSON_PRETTY_PRINT));

        return true;
    }
}
