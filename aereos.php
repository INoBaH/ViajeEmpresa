<?php
require_once('viajeFeliz.php');
class Aereo extends ViajeFeliz {
    private $nroVuelo;
    private $categoria;
    private $nombAerolinea;
    private $cantEscalas;

    public function __construct($numFly, $cat, $aerolinea, $escalasNum, $codigo, $destino, $cantMaxima, $responsable, $import, $status)
    {   
        parent::__construct($codigo, $destino, $cantMaxima, $responsable, $import, $status);
        $this->nroVuelo=$numFly;
        $this->categoria=$cat;
        $this->nombAerolinea=$aerolinea;
        $this->cantEscalas=$escalasNum;
    }

    public function getnroVuelo()
    {
        return $this->nroVuelo;
    }
    public function setnroVuelo($nroVuelo){
        $this->nroVuelo=$nroVuelo;
    }

    public function getcategoria()
    {
        return $this->categoria;
    }
    public function setcategoria($categoria){
        $this->categoria=$categoria;
    }

    public function getnombAerolinea()
    {
        return $this->nombAerolinea;
    }
    public function setnombAerolinea($nombAerolinea){
        $this->nombAerolinea=$nombAerolinea;
    }

    public function getcantEscalas()
    {
        return $this->cantEscalas;
    }
    public function setcantEscalas($cantEscalas){
        $this->cantEscalas=$cantEscalas;
    }

    public function __toString()
    {
        $aereoCad= parent:: __toString();
        $aereoCad="
        Numero del Vuelo: {$this->getnroVuelo()}\n
        Categoria de Asiento: {$this->getcategoria()}\n
        Nombre de la Aerolinea: {$this->getnombAerolinea()}\n
        Cantidad de Escalas: {$this->getcantEscalas()}";
        return $aereoCad;
    }

    public function venderPasaje($pasajero) {
        $importeTotal=parent::venderPasajero($pasajero);
        $cat=$this->getcategoria();
        $escalas=$this->getcantEscalas();
        if ($cat == 1 && $escalas < 1) {
            $importeTotal+=$importeTotal*0.4;
        } elseif ($cat == 1 && $escalas > 0) {
            $importeTotal+=$importeTotal*0.6;
        }
        parent::agregarPasajeros($pasajero);
        return $importeTotal;
    }
}