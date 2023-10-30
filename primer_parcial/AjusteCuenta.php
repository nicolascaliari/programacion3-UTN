<?php

include "Cuenta.php";
include "Ajuste.php";
include "deposito.php";
function AjusteCuenta()
{


    if (isset($_POST["idOperacion"]) && $_POST["motivo"]) {
        $idOperacion = $_POST["idOperacion"];
        $motivo = $_POST["motivo"];
        if ($motivo == "deposito") {
            if ($deposito = Deposito::BuscarDeposito($idOperacion)) {
                var_dump($deposito);
                $ajuste = new Ajuste($idOperacion, $motivo, $deposito->monto);
                
                if (Cuenta::AjustarCuenta($deposito->numeroCuenta, $deposito->monto)) {
                    //Cuenta::EscribirJSONCuenta($cuentasAjustada);
                    $ajustes = Ajuste::LeerJSONAjuste();
                    $ajustes[] = $ajuste;
                    Ajuste::EscribirJSONAjuste($ajustes);
                    echo "El ajuste de deposito se realizó exitosamente";
                } else {
                    echo "No se encontro el numero de cuenta";
                }

            } else {
                echo "El deposito no existe";
            }
        } else if ($motivo == "retiro") {
            if ($montoAjusteRetiro = Retiro::BuscarMontoRetiro($idOperacion)) {
                $ajuste = new Ajuste($idOperacion, $motivo, $montoAjusteRetiro);
                $cuentasAjustada = Retiro::AjustarRetiroEnCuenta($idOperacion, $montoAjusteRetiro);
                Cuenta::EscribirJSONCuenta($cuentasAjustada);
                $ajustes = Ajuste::LeerJSONAjuste();
                $ajustes = $ajuste;
                Ajuste::EscribirJSONAjuste($ajustes);
                echo "El ajuste de retiro se realizó exitosamente";

            } else {
                echo "El retiro no existe";
            }
        }
    } else {
        echo "Parametros insufientes para el ajuste de cuenta. ";
    }

}

?>