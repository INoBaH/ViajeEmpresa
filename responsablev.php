<?php

class responsableV
{
    private $responsable;


    public function __construct($nombResp)
    {
        $this->responsable = $nombResp;
    }

    public function getresponsable(){
        return $this->responsable;
    }

    public function setresponsable($responsable){
        $this->responsable=$responsable;
    }

    public function __toString()
    {   
        $nomb=$this->getresponsable();
        $nombre="
        Nombre: $nomb. \n";
        return $nombre;
    }
}
