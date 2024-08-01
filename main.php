<?php

require_once 'Medico.php';
require_once 'Paciente.php';
require_once 'Turno.php';
require_once 'Sala.php';

class Consultorio {
    private $medicos = [];
    private $pacientes = [];
    private $turnos = [];
    private $salas = [];
    private $contadorSala = 1;

    public function agregarMedico() {
        echo "Ingrese nombre del médico: ";
        $nombre = trim(fgets(STDIN));
        echo "Ingrese matrícula del médico: ";
        $matricula = trim(fgets(STDIN));
        echo "Ingrese especialidad del médico: ";
        $especialidad = trim(fgets(STDIN));
        $this->medicos[] = new Medico($nombre, $matricula, $especialidad);
        echo "Médico agregado con éxito.\n";
    }

    public function listarMedicos() {
        foreach ($this->medicos as $index => $medico) {
            echo "$index - Nombre: {$medico->nombre}, Matrícula: {$medico->matricula}, Especialidad: {$medico->especialidad}\n";
        }
    }

    public function agregarPaciente() {
        echo "Ingrese nombre del paciente: ";
        $nombre = trim(fgets(STDIN));
        echo "Ingrese DNI del paciente: ";
        $dni = trim(fgets(STDIN));
        echo "Ingrese obra social del paciente: ";
        $obraSocial = trim(fgets(STDIN));
        echo "Ingrese historia clínica del paciente: ";
        $historiaClinica = trim(fgets(STDIN));
        $this->pacientes[] = new Paciente($nombre, $dni, $obraSocial, $historiaClinica);
        echo "Paciente agregado con éxito.\n";
    }

    public function listarPacientes() {
        foreach ($this->pacientes as $index => $paciente) {
            echo "$index - Nombre: {$paciente->nombre}, DNI: {$paciente->dni}, Obra Social: {$paciente->obraSocial}, Historia Clínica: {$paciente->historiaClinica}\n";
        }
    }

    public function agregarTurno() {
        $this->listarMedicos();
        echo "Seleccione el índice del médico: ";
        $medicoIndex = trim(fgets(STDIN));

        $this->listarPacientes();
        echo "Seleccione el índice del paciente: ";
        $pacienteIndex = trim(fgets(STDIN));

        if (isset($this->medicos[$medicoIndex]) && isset($this->pacientes[$pacienteIndex])) {
            $this->turnos[] = new Turno($this->medicos[$medicoIndex], $this->pacientes[$pacienteIndex]);
            echo "Turno asignado.\n";
        } else {
            echo "Selección no válida.\n";
        }
    }

    public function listarTurnos() {
        foreach ($this->turnos as $index => $turno) {
            echo "$index - Médico: {$turno->medico->nombre}, Paciente: {$turno->paciente->nombre}\n";
        }
    }

    public function modificarTurno() {
        $this->listarTurnos();
        echo "Seleccione el índice del turno a modificar: ";
        $turnoIndex = trim(fgets(STDIN));

        $this->listarMedicos();
        echo "Seleccione el nuevo índice del médico: ";
        $nuevoMedicoIndex = trim(fgets(STDIN));

        $this->listarPacientes();
        echo "Seleccione el nuevo índice del paciente: ";
        $nuevoPacienteIndex = trim(fgets(STDIN));

        if (isset($this->turnos[$turnoIndex]) && isset($this->medicos[$nuevoMedicoIndex]) && isset($this->pacientes[$nuevoPacienteIndex])) {
            $this->turnos[$turnoIndex]->medico = $this->medicos[$nuevoMedicoIndex];
            $this->turnos[$turnoIndex]->paciente = $this->pacientes[$nuevoPacienteIndex];
            echo "Turno modificado con éxito.\n";
        } else {
            echo "Selección no válida.\n";
        }
    }

    public function borrarTurno() {
        $this->listarTurnos();
        echo "Seleccione el índice del turno a borrar: ";
        $turnoIndex = trim(fgets(STDIN));

        if (isset($this->turnos[$turnoIndex])) {
            unset($this->turnos[$turnoIndex]);
            $this->turnos = array_values($this->turnos); // Reindexar array
            echo "Turno eliminado con éxito.\n";
        } else {
            echo "Selección no válida.\n";
        }
    }

    public function agregarSala() {
        $this->listarTurnos();
        echo "Seleccione el índice del turno a asignar una sala: ";
        $turnoIndex = trim(fgets(STDIN));

        if (isset($this->turnos[$turnoIndex])) {
            $this->salas[] = new Sala($this->contadorSala++, $this->turnos[$turnoIndex]);
            echo "Sala asignada con éxito.\n";
        } else {
            echo "Selección no válida.\n";
        }
    }

    public function listarSalas() {
        foreach ($this->salas as $sala) {
            echo "Sala {$sala->numero} - Médico: {$sala->turno->medico->nombre}, Paciente: {$sala->turno->paciente->nombre}\n";
        }
    }
}

function main() {
    $consultorio = new Consultorio();

    while (true) {
        echo "\nIngrese la opción que desea:\n";
        echo "1 - Médicos\n";
        echo "2 - Pacientes\n";
        echo "3 - Turnos\n";
        echo "4 -  Salas\n";
        echo "0 - Salir\n";

        $rta = trim(fgets(STDIN));
        if ($rta == 0) break;

        switch ($rta) {
            case 1:
                echo "1 - Agregar Médico\n2 - Listar Médicos\n";
                $rtaSub = trim(fgets(STDIN));
                if ($rtaSub == 1) $consultorio->agregarMedico();
                else $consultorio->listarMedicos();
                break;

            case 2:
                echo "1 - Agregar Paciente\n2 - Listar Pacientes\n";
                $rtaSub = trim(fgets(STDIN));
                if ($rtaSub == 1) $consultorio->agregarPaciente();
                else $consultorio->listarPacientes();
                break;

            case 3:
                echo "1 - Agregar Turno\n2 - Listar Turnos\n3 - Modificar Turno\n4 - Borrar Turno\n";
                $rtaSub = trim(fgets(STDIN));
                if ($rtaSub == 1) $consultorio->agregarTurno();
                elseif ($rtaSub == 2) $consultorio->listarTurnos();
                elseif ($rtaSub == 3) $consultorio->modificarTurno();
                else $consultorio->borrarTurno();
                break;

            case 4:
                echo "1 - Agregar Sala\n2 - Listar Salas\n";
                $rtaSub = trim(fgets(STDIN));
                if ($rtaSub == 1) $consultorio->agregarSala();
                else $consultorio->listarSalas();
                break;

            default:
                echo "Opción no válida, intenta de nuevo.\n";
        }
    }
}

// Inicia el programa
main();
