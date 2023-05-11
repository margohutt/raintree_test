<?php
// Open the connection
require_once 'mysql_connection.php';

// Query to retrieve all patients' information and insurance data ordered by insurance earliest date and patient last name
$query = "SELECT patient.pn, patient.last, patient.first, insurance.iname, DATE_FORMAT(insurance.from_date, '%m-%d-%y') as from_date, DATE_FORMAT(insurance.to_date, '%m-%d-%y') as to_date
FROM patient
INNER JOIN insurance ON patient._id = insurance.patient_id
ORDER BY insurance.from_date ASC, patient.last ASC";

// Execute the query and store the result in $result
$result = mysqli_query($connection, $query);

// Check if the query was successful
if ($result) {

    // Loop over the result set and output each row in a separate line
    while ($row = mysqli_fetch_assoc($result)) {
        echo $row['pn'] . ",";
        echo $row['last'] . ",";
        echo $row['first'] . ",";
        echo $row['iname'] . ",";
        echo $row['from_date'] . ",";
        echo $row['to_date'] . "\n";
    }

    // Free up the memory used by the result
    mysqli_free_result($result);
} else {

    // Display an error message if the query failed
    echo "Error: " . mysqli_error($connection);
}

// Close the connection
mysqli_close($connection);
