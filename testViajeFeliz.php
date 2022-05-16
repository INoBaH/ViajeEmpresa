<?php
require_once('viajeFeliz.php');
include_once('persona.php');
include_once('responsablev.php');
include_once('terrestres.php');
include_once('aereos.php');

echo "Bienvenido\n";
echo "Por favor ingrese los siguientes datos que se le mostraran a continuacion:\n";
echo "\n";
echo "Ingrese su codigo de Viaje:\n";
$codigoViaje = trim(fgets(STDIN));
echo "Ahora ingrese su destino:\n";
$destinoViaje = trim(fgets(STDIN));
echo "Ingrese la maxima cantidad de asientos:\n";
$asientosViaje = trim(fgets(STDIN));
echo "Ingrese el importe basico: \n";
$importe = trim(fgets(STDIN));
echo "Su viaje es de ida y vuelta? Escriba (s) para confirmar o (n) para negar. \n";
$viajeIdaVuelta = trim(fgets(STDIN));
$objResponsable = new responsableV("Timmieeeh");
$objViaje = new ViajeFeliz($codigoViaje, $destinoViaje, $asientosViaje, $objResponsable,$importe,$viajeIdaVuelta);

function menu()
{
    return $echo = "MENU:\n
    ----------------------------------------------\n
    1. Ver el estado del viaje\n
    ----------------------------------------------\n
    2. Modificar el codigo del viaje\n
    ----------------------------------------------\n
    3. Modificar el destino del viaje\n
    ----------------------------------------------\n
    4. Modificar la cantidad de asientos del viaje\n
    ----------------------------------------------\n
    5. Modificar un pasajero \n
    ----------------------------------------------\n
    6. Agregar un pasajero \n
    ----------------------------------------------\n
    7. Vender boleto a un pasajero \n
    ----------------------------------------------\n
    8. Salir del menu\n
    ----------------------------------------------\n";
}


do {
    echo menu();
    $opciones = trim(fgets(STDIN));
    switch ($opciones) {
        case '1':

            echo $objViaje;
            $cierre = true;
            break;

        case '2':

            echo "El viaje tiene el codigo: {$objViaje->getcodViaje()}. \n";
            echo "Ingrese un nuevo codigo: \n";
            $codigo = trim(fgets(STDIN));
            $codigo = intval($codigo);
            $objViaje->setcodViaje($codigo);
            $cierre = true;
            break;

        case '3':

            echo "El destino del viaje actual es: {$objViaje->getdestinoViaje()} \n";
            echo "Ingrese un nuevo destino: \n";
            $destino = trim(fgets(STDIN));
            $objViaje->setdestinoViaje($destino);
            $cierre = true;
            break;

        case '4':

            echo "El viaje tiene {$objViaje->getcantPasajerosMax()} asientos\n";
            echo "Ingrese una nueva cantidad de asientos: \n";
            $cantAsientos = trim(fgets(STDIN));
            $cantAsientos = intval($cantAsientos);
            $objViaje->setcantPasajerosMax($cantAsientos);
            $cierre = true;
            break;

        case '5':

            echo "Ingrese los datos del pasajero a modificar: \n";
            $pasajero = obtenerDatos();
            echo "Ingrese los nuevos datos del pasajero: \n";
            $pasajero2 = obtenerDatos();
            if ($objViaje->modificarPasajeros($pasajero, $pasajero2)) {
                echo "Se han modificado los datos del pasajero.\n";
            } else {
                echo "No se ha encontrado el pasajero buscado para modificar.\n";
            }
            $cierre = true;
            break;

        case '6':

            echo "Ingrese los datos de un pasajero: \n";
            $pasajero = obtenerDatos();
            if ($objViaje->lugarPasajeros()) {
                if ($objViaje->agregarPasajeros($pasajero)) {
                    echo "El pasajero ha sido agregado con exito.\n";
                } else {
                    echo "El pasajero ya esta en el viaje.\n";
                }
            } else {
                echo "Lo sentimos, pero ya no hay mas lugares en este viaje.\n";
            }
            $cierre = true;
            break;

        case '7':
            echo"Ingrese los datos del Pasajero:\n";
            $pasajero=obtenerDatos();
            echo "Su viaje sera terrestre (t) o aereo (a)? \n";
            $suViaje = trim(fgets(STDIN));
            if ($suViaje == "a") {
                echo"Ingrese su numero de Vuelo:\n";
                $numVuelo=trim(fgets(STDIN));
                echo"Cual es su categoria? (ingrese 1 para 1ra clase o 0 para otros).\n";
                $categoria=trim(fgets(STDIN));
                echo"Ingrese el nombre de la Aerolinea: \n";
                $nombAereo=trim(fgets(STDIN));
                echo"Ingrese la cantidad de escalas:\n";
                $cantEscalas=trim(fgets(STDIN));
                $objAereo = new Aereo($numVuelo, $categoria, $nombAereo, $cantEscalas, $codigoViaje, $destinoViaje, $asientosViaje, $objResponsable,$importe,$viajeIdaVuelta);
                $importeTotal=$objAereo->venderPasaje($pasajero);
                echo"\nEl importe total a pagar es de$importeTotal\n";
            } elseif ($suViaje == "t") {
                echo"Cual es su comodidad?\n";
                $comodidad=trim(fgets(STDIN));
                echo"Su asientos es cama (c) o semi-cama (s)?\n";
                $catAsientos=trim(fgets(STDIN));
                $objTerrestre = new Terrestre($comodidad, $catAsientos, $codigoViaje, $destinoViaje, $asientosViaje, $objResponsable,
                $importe,$viajeIdaVuelta);
                $total=$objTerrestre->venderPasaje($pasajero);
                echo"\nEl importe total a pagar es de $total\n";
            } else {
                $cierre = true;
                break;
            }
            $cierre = true;
            break;

        case '8':
            $cierre = false;
            break;

        default:
            $cierre = false;
            break;
    }
} while ($cierre);

function obtenerDatos()
{
    echo "Nombre: \n";
    $nombre = trim(fgets(STDIN));
    echo "Apellido: \n";
    $apellido = trim(fgets(STDIN));
    echo "DNI: \n";
    $dni = intval(trim(fgets(STDIN)));
    echo "Telefono: \n";
    $tel = intval(trim(fgets(STDIN)));
    $pasajero = new Persona($nombre, $apellido, $dni, $tel);
    return $pasajero;
}
