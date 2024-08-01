<?php


class Paciente {
    public $nombre;
    public $dni;
    public $obraSocial;
    public $historiaClinica;

    public function __construct($nombre, $dni, $obraSocial, $historiaClinica) {
        
       $this->nombre=$nombre;
        $this->dni = $dni;
        $this->obraSocial = $obraSocial;
        $this->historiaClinica = $historiaClinica;
    }
}
