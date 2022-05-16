<?php

require_once('viajeFeliz.php');
class Terrestre extends ViajeFeliz{
    private $comodidad;
    private $asientosTipo;

    public function __construct($asientoCom, $tipoAsientos,$codigo, $destino, $cantMaxima, $responsable, $import, $status)
    {   
        parent::__construct($codigo, $destino, $cantMaxima, $responsable, $import, $status);
        $this->comodidad=$asientoCom;
        $this->asientosTipo=$tipoAsientos;
    }

    public function getcomodidad()
    {
        return $this->comodidad;
    }
    public function setnroVuelo($comodidad){
        $this->comodidad=$comodidad;
    }

    public function getasientosTipo()
    {
        return $this->asientosTipo;
    }
    public function setasientosTipo($asientosTipo){
        $this->asientosTipo=$asientosTipo;
    }

    public function __toString()
    {
        $aereoCad= parent:: __toString();
        $aereoCad="
        Comodidad del Asiento: {$this->getcomodidad()}\n
        Tipo de Asiento: {$this->getasientosTipo()}\n
        return $aereoCad";
    }

    public function venderPasaje($pasajero) {
        $importeTotal=parent::venderPasajero($pasajero);
        $cama=$this->getasientosTipo();
        if ($cama == "c") {
            $importeTotal+=$importeTotal*0.25;
        }
        parent::agregarPasajeros($pasajero);
        return $importeTotal;
    }
}