<?php



class Venta
{
    private $_id;
    private $_codigoDeBarra;
    private $_idUsuario;
    private $_cantidad;


    public function __construct($codigoDeBarra, $idUsuario, $cantidad)
    {
        $this->_codigoDeBarra = $codigoDeBarra;
        $this->_idUsuario = $idUsuario;
        $this->_cantidad = $cantidad;
        $this->_id = rand(1, 10000);
    }



    public function ValidarVenta($producto, $usuario)
    {
        if (Producto::VerificarProductoExistente($producto)) {
            if(Usuario::VerificarUsuarioExistente($usuario)){
                echo "pase el validar venta";
                return true;
            }
        } else {
            return false;
        }
    }



    public function AltaVenta($venta)
    {
        $ventaArray = [
            'id' => $venta->_id,
            'codigoDeBarra' => $venta->_codigoDeBarra,
            'idUsuario' => $venta->_idUsuario,
            'cantidad' => $venta->_cantidad,
        ];

        $ventas = [];
        if (file_exists('ventas.json')) {
            $ventas = json_decode(file_get_contents('ventas.json'), true);
        }
        $ventas[] = $ventaArray;

        //el json pretty es para que quede bien ordenado.
        file_put_contents('ventas.json', json_encode($ventas, JSON_PRETTY_PRINT));

        return true;
    }
}
