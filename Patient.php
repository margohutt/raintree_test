<?php

require_once('PatientRecord.php');

class Patient implements PatientRecord {
    private $_id;
    private $_pn;
    private $firstName;
    private $lastName;
    private $insurances = [];

    public function __construct($pn, $firstName, $lastName) {
        $this->_pn = $pn;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    public function getPatientId() {
        return $this->_id;
    }

    public function getPatientNumber() {
        return $this->_pn;
    }

    public function getFullName() {
        return $this->firstName . ' ' . $this->lastName;
    }

    public function getInsurances(): array
    {
        return $this->insurances;
    }

    public function addInsurance(Insurance $insurance) {
        $this->insurances[] = $insurance;
    }

    public function printInsuranceTable($date) {
        $output = "";

        foreach ($this->insurances as $insurance) {
            $isValid = $insurance->checkValidity($date) ? 'Yes' : 'No';
            $output .= $this->_pn . ', ' . $this->getFullName() . ', ' . $insurance->getPatientId() . ', ' . $isValid . PHP_EOL;
        }

        echo $output;
    }
}

