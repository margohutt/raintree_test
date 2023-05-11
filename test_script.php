<?php

require_once('mysql_connection.php');
require_once('PatientRecord.php');
require_once('Insurance.php');
require_once('Patient.php');

// Fetch patients and their insurances from the database
$query = "SELECT patient.pn, patient.first, patient.last, insurance.patient_id, insurance.iname, insurance.from_date, insurance.to_date
          FROM patient patient
          JOIN insurance insurance ON patient._id = insurance.patient_id
          ORDER BY patient.pn ASC";

$result = $connection->query($query);

if ($result->num_rows > 0) {
    $patients = [];
    $currentDate = date('m-d-y');

    while ($row = $result->fetch_assoc()) {
        $patientNumber = $row['pn'];
        $firstName = $row['first'];
        $lastName = $row['last'];
        $insuranceName = $row['iname'];
        $fromDate = $row['from_date'];
        $toDate = $row['to_date'];

//        // Check if the patient object already exists in the patients array
        if (isset($patients[$patientNumber])) {
            $patient = $patients[$patientNumber];
        } else {
            $patient = new Patient($patientNumber, $firstName, $lastName);
            $patients[$patientNumber] = $patient;
        }

        // Create and add the insurance object to the patient
        $insurance = new Insurance($insuranceName, $patientNumber, $fromDate, $toDate);
        $patient->addInsurance($insurance);
    }

    // Print patients and their insurances
    foreach ($patients as $patient) {
        $patient->printInsuranceTable($currentDate);
    }
} else {
    echo "No patients found.";
}

// Close the database connection
$connection->close();