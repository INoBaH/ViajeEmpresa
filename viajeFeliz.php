<?php

include_once('persona.php');
include_once('responsablev.php');
class ViajeFeliz
{
    //atributos
    private $codViaje;
    private $destinoViaje;
    private $cantPasajerosMax;
    private $objPasajeros = [];
    private $objResponsable;
    private $importeViaje;
    private $estadoViaje;

    //Construct
    public function __construct($codigo, $destino, $cantMaxima, $responsable, $import, $status)
    {
        $this->codViaje = $codigo;
        $this->destinoViaje = $destino;
        $this->cantPasajerosMax = $cantMaxima;
        $this->objResponsable = $responsable;
        $this->importeViaje = $import;
        $this->estadoViaje = $status;
    }

    //Get y set

    //codViaje
    public function getcodViaje()
    {
        return $this->codViaje;
    }
    public function setcodViaje($codViaje)
    {
        $this->codViaje = $codViaje;
    }
    //destinoViaje
    public function getdestinoViaje()
    {
        return $this->destinoViaje;
    }
    public function setdestinoViaje($destinoViaje)
    {
        $this->destinoViaje = $destinoViaje;
    }
    //cantPasajerosMax
    public function getcantPasajerosMax()
    {
        return $this->cantPasajerosMax;
    }
    public function setcantPasajerosMax($cantPasajerosMax)
    {
        $this->cantPasajerosMax = $cantPasajerosMax;
    }
    //arrayPasajeros
    public function getobjPasajeros()
    {
        return $this->objPasajeros;
    }
    public function setobjPasajeros($objPasajeros)
    {
        $this->objPasajeros = $objPasajeros;
    }

    public function getobjResponsable()
    {
        return $this->objResponsable;
    }
    public function setobjResponsable($objResponsable)
    {
        $this->objResponsable = $objResponsable;
    }

    public function getimporteViaje()
    {
        return $this->importeViaje;
    }

    public function setimporteViaje($importeViaje)
    {
        $this->importeViaje = $importeViaje;
    }

    public function getestadoViaje()
    {
        return $this->estadoViaje;
    }

    public function setestadoViaje($estadoViaje)
    {
        $this->estadoViaje = $estadoViaje;
    }
    //funcion que agregar pasajeros
    /**
     * @param $pasajero = ['DNI'=> ;'nombre'=> ;'apellido'=> ; 'telefono'=>;]
     * @return string
     */
    public function agregarPasajeros($pasajero)
    {
        $arraySecundario = $this->getobjPasajeros();
        $booleano = false;
        if ($pasajero == $arraySecundario) {
            $booleano = false;
        } else {
            array_push($arraySecundario, $pasajero);
            $this->setobjPasajeros($arraySecundario);
            $booleano = true;
        }
        return $booleano;
    }

    //funcion que modifica los datos de los pasajeros

    public function modificarPasajeros($pasajero, $pasajeroDos)
    {
        $arrayModificable = $this->getobjPasajeros();
        $booleano = false;
        if (in_array($pasajero, $arrayModificable)) {
            $key = array_search($pasajero, $arrayModificable);
            $arrayModificable[$key] = $pasajeroDos;
            $this->setobjPasajeros($arrayModificable);
            $booleano = true;
        }
        return $booleano;
    }

    public function lugarPasajeros()
    {
        $pas1 = $this->getcantPasajerosMax();
        $pas2 = $this->getobjPasajeros();
        $n = count($pas2);
        $booleano = true;
        if ($pas1 <= $n) {
            $booleano = false;
        }
        return $booleano;
    }
    /** funcion privada que muestra los datos de los pasajeros
     * @param void
     * @return string
     */
    private function datosPasajerosStr()
    {
        $pasajeroStr = "";
        foreach ($this->getobjPasajeros() as $key => $value) {
            $nombre = $value->getnombre();
            $apellido = $value->getapellido();
            $dni = $value->getnumDNI();
            $tel = $value->gettelefono();
            $pasajeroStr .= "
            Nombre: $nombre\n
            Apellido: $apellido\n
            DNI: $dni\n
            Telefono: $tel";
        }
        return $pasajeroStr;
    }

    //funcion que muestra todos los datos pedidos, incluido el de los pasajeros
    public function __toString()
    {
        $pasajero = $this->datosPasajerosStr();
        $arrayPasajeros = $this->getobjPasajeros();
        $cantidad = count($arrayPasajeros);
        $responsable = $this->getobjResponsable();
        $varStr = "
        Viaje: {$this->getcodViaje()} -\n
        Destino: {$this->getdestinoViaje()} -\n
        Cantidad de Asientos: {$this->getcantPasajerosMax()} -\n
        Asientos ocupados por pasajeros: $cantidad -\n 
        Datos de Pasajeros: \n 
        $pasajero\n
        Dato del Responsable: \n
        $responsable
        Importe del Viaje: {$this->getimporteViaje()}\n
        Estado del Viaje: {$this->getestadoViaje()}\n
        ";
        return $varStr;
    }

    public function hayPasajesDisponible()
    {
        $asientosMax = $this->getcantPasajerosMax();
        $pasajerosMax = $this->getobjPasajeros();
        $maxPasajeros = count($pasajerosMax);
        $boolean = true;
        if ($asientosMax > $maxPasajeros) {
            $boolean = false;
        }
        return $boolean;
    }

    public function venderPasajero($pasajero)
    {
        if ($this->hayPasajesDisponible() == false) {
            $importe = $this->getimporteViaje();
            $viajeEstado = $this->getestadoViaje();
            if ($viajeEstado == "y") {
                $importe += ($importe * 0.5);

                return $importe;
            } else {
                echo "No hay espacio en el viaje, por favor, vuelva a intentarlo en otro.";
            }
        }
    }
}
