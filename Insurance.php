<?php

require_once('PatientRecord.php');

class Insurance implements PatientRecord {
    private $_id;
    private $_pn;
    private $from_date;
    private $to_date;

    public function __construct($id, $pn, $from_date, $to_date = null) {
        $this->_id = $id;
        $this->_pn = $pn;
        $this->from_date = $from_date;
        $this->to_date = $to_date;
    }

    public function getPatientId() {
        return $this->_id;
    }

    public function getPatientNumber() {
        return $this->_pn;
    }

    public function checkValidity($date): bool
    {
        $compareDate = date_create_from_format('m-d-y', $date);

        if ($compareDate >= date_create_from_format('Y-m-d', $this->from_date)) {
            if ($this->to_date === null || $compareDate <= date_create_from_format('Y-m-d', $this->to_date)) {
                return true;
            }
        }

        return false;
    }
}