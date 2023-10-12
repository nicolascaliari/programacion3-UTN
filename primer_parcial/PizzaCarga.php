<?php
class PizzaCarga {
    private $pizzaDataFile = 'Pizza.json';

    public function cargarPizza($request) {
        $sabor = $request['sabor'];
        $precio = $request['precio'];
        $tipo = $request['tipo'];
        $cantidad = $request['cantidad'];

        $pizzas = $this->leerPizzas();

        // Verificar si ya existe una pizza con el mismo sabor y tipo
        foreach ($pizzas as &$pizza) {
            if ($pizza['sabor'] === $sabor && $pizza['tipo'] === $tipo) {
                $pizza['precio'] = $precio;
                $pizza['stock'] += $cantidad;
                $this->guardarPizzas($pizzas);
                return ['message' => 'Pizza actualizada'];
            }
        }

        // Si no existe, crear una nueva pizza
        $id = count($pizzas) + 1;
        $nuevaPizza = [
            'id' => $id,
            'sabor' => $sabor,
            'precio' => $precio,
            'tipo' => $tipo,
            'stock' => $cantidad
        ];

        $pizzas[] = $nuevaPizza;
        $this->guardarPizzas($pizzas);

        return ['message' => 'Pizza creada'];
    }

    public function leerPizzas() {
        if (file_exists($this->pizzaDataFile)) {
            $json = file_get_contents($this->pizzaDataFile);
            return json_decode($json, true);
        } else {
            return [];
        }
    }

    public function guardarPizzas($pizzas) {
        $json = json_encode($pizzas);
        file_put_contents($this->pizzaDataFile, $json);
    }
}
?>
