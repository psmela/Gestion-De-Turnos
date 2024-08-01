<?php
// Sala.php

require_once 'Turno.php';

class Sala {
    public $numero;
    public $turno;

    public function __construct($numero, $turno) {
        $this->numero = $numero;
        $this->turno = $turno;
    }
}
