<?php


class Medico  {
    public $nombre;
    public $matricula;
    public $especialidad;

    public function __construct($nombre, $matricula, $especialidad) {
       $this->nombre=$nombre;
        $this->matricula = $matricula;
        $this->especialidad = $especialidad;
    }
}
