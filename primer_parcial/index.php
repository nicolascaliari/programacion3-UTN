<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $request = json_decode(file_get_contents('php://input'), true);

    if (isset($request['action'])) {
        if ($request['action'] === 'cargarPizza') {
            include 'PizzaCarga.php';
            $pizzaCarga = new PizzaCarga();
            $response = $pizzaCarga->cargarPizza($request);
            echo json_encode($response);
        } elseif ($request['action'] === 'consultarPizza') {
            include 'PizzaConsultar.php';
            $pizzaConsultar = new PizzaConsultar();
            $response = $pizzaConsultar->consultarPizza($request);
            echo json_encode($response);
        } else {
            echo json_encode(['error' => 'Acción no válida']);
        }
    } else {
        echo json_encode(['error' => 'Acción no especificada']);
    }
}
?>
