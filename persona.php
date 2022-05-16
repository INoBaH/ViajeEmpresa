<?php

class persona {
    private $nombre;
    private $apellido;
    private $numDNI;
    private $telefono;

    public function __construct($name, $surname, $DNI, $phone)
    {
        $this->nombre=$name;
        $this->apellido=$surname;
        $this->numDNI=$DNI;
        $this->telefono=$phone;
    }

    public function getnombre() {
        return $this->nombre;
    }
    public function setnombre($nombre) {
        $this->nombre=$nombre;
    }

    public function getapellido() {
        return $this->apellido;
    }
    public function setapellido($apellido) {
        $this->apellido=$apellido;
    }

    public function getnumDNI() {
        return $this->numDNI;
    }
    public function setnumDNI($numDNI) {
        $this->numDNI=$numDNI;
    }

    public function gettelefono() {
        return $this->telefono;
    }
    public function settelefono($telefono) {
        $this->telefono=$telefono;
    }
}
