<?php
class PizzaConsultar {
    private $pizzaDataFile = 'Pizza.json';

    public function consultarPizza($request) {
        $sabor = $request['sabor'];
        $tipo = $request['tipo'];

        $pizzas = $this->leerPizzas();

        foreach ($pizzas as $pizza) {
            if ($pizza['sabor'] === $sabor && $pizza['tipo'] === $tipo) {
                return ['message' => 'Si Hay'];
            }
        }

        if (!$this->tipoExiste($tipo)) {
            return ['message' => 'El tipo de pizza no existe'];
        } elseif (!$this->saborExiste($sabor)) {
            return ['message' => 'El sabor de pizza no existe'];
        }

        return ['message' => 'No existe coincidencia'];
    }

    private function leerPizzas() {
        if (file_exists($this->pizzaDataFile)) {
            $json = file_get_contents($this->pizzaDataFile);
            return json_decode($json, true);
        } else {
            return [];
        }
    }

    private function tipoExiste($tipo) {
        $pizzas = $this->leerPizzas();
        foreach ($pizzas as $pizza) {
            if ($pizza['tipo'] === $tipo) {
                return true;
            }
        }
        return false;
    }

    private function saborExiste($sabor) {
        $pizzas = $this->leerPizzas();
        foreach ($pizzas as $pizza) {
            if ($pizza['sabor'] === $sabor) {
                return true;
            }
        }
        return false;
    }
}
?>
