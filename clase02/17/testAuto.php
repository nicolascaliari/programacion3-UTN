<!-- 
En testAuto.php:
● Crear dos objetos “Auto” de la misma marca y distinto color.
● Crear dos objetos “Auto” de la misma marca, mismo color y distinto precio.
● Crear un objeto “Auto” utilizando la sobrecarga restante.

● Utilizar el método “AgregarImpuesto” en los últimos tres objetos, agregando $ 1500
al atributo precio.
● Obtener el importe sumado del primer objeto “Auto” más el segundo y mostrar el
resultado obtenido.
● Comparar el primer “Auto” con el segundo y quinto objeto e informar si son iguales o
no.
● Utilizar el método de clase “MostrarAuto” para mostrar cada los objetos impares (1, 3,
5) -->


<!-- Nicolas Caliari -->

<?php
include "./index.php";

echo "<br/>Estoy en el test<br/>";

$autoUno = new Auto("Ferrari", "Verde");
$autoDos = new Auto("Ferrari", "Negro");
$autoTres = new Auto("Ferrari", "Negro", 3000);
$autoCuatro = new Auto("Ferrari", "Negro", 5000);
$autoCinco = new Auto("Ferrari", "Negro", 5000, "28/10/2001");




// ● Utilizar el método “AgregarImpuesto” en los últimos tres objetos, agregando $ 1500
// al atributo precio.
$autoTres->AgregarImpuestos(1500);
$autoCuatro->AgregarImpuestos(1500);
$autoCinco->AgregarImpuestos(1500);




// ● Obtener el importe sumado del primer objeto “Auto” más el segundo y mostrar el
// resultado obtenido.
$getAmount = $autoUno::Add($autoUno, $autoDos);
echo $getAmount;




// ● Comparar el primer “Auto” con el segundo y quinto objeto e informar si son iguales o
// no.
$autoUno->Equals($autoUno, $autoDos);
$autoUno->Equals($autoUno, $autoDos);




// ● Utilizar el método de clase “MostrarAuto” para mostrar cada los objetos impares (1, 3,
// 5) -->
Auto::MostrarAuto($autoUno);
Auto::MostrarAuto($autoTres);
Auto::MostrarAuto($autoCinco);


?>