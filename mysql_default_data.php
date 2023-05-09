<?php
//Open the connection
require_once 'mysql_connection.php';

//Create new database named raintree
$query1 = "CREATE DATABASE IF NOT EXISTS raintree";
if (mysqli_query($connection, $query1)) {
    echo "Database created successfully" . "\n";
} else {
    echo "Error creating database: " . mysqli_error($connection) . "\n";
}

//Use raintree database
mysqli_select_db($connection, "raintree");

//Create new tables named patient and insurance
$query2 = "CREATE TABLE IF NOT EXISTS patient (
    _id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    pn VARCHAR(11) DEFAULT NULL,
    first VARCHAR(15) DEFAULT NULL,
    last VARCHAR(25) DEFAULT NULL,
    dob DATE DEFAULT NULL,
    PRIMARY KEY (_id))";

$query3 = "CREATE TABLE IF NOT EXISTS insurance (
    _id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    patient_id INT(10) UNSIGNED NOT NULL,
    iname VARCHAR(40) DEFAULT NULL,
    from_date DATE DEFAULT NULL,
    to_date DATE DEFAULT NULL,
    PRIMARY KEY (_id),
    FOREIGN KEY (patient_id) REFERENCES patient(_id))";

//Show the (error) message if the tables are created successfully or not
if (mysqli_query($connection, $query2)  && mysqli_query($connection, $query3)) {
    echo "Tables created successfully" . "\n";
} else {
    echo "Error creating tables: " . mysqli_error($connection) . "\n";
}

//Use the raintree database
mysqli_select_db($connection, "raintree");

//Insert default data into patient table
$query4 = "INSERT INTO patient (pn, first, last, dob) VALUES
    ('12345678901', 'Buubert', 'Tamm', '1990-01-01'),
    ('23456789012', 'Senne', 'Kask', '1985-05-15'),
    ('34868987421', 'Meelike', 'Lehis', '1999-01-20'),
    ('22245863873', 'Aadu', 'Lepp', '2015-12-24'),
    ('34567890123', 'Leemeke', 'Haab', '1978-12-31')";

//Show the (error) message if the data are created successfully or not
if (mysqli_query($connection, $query4)) {
    echo "Default data inserted into patient table successfully" . "\n";
} else {
    echo "Error inserting default data into patient table: " . mysqli_error($connection) . "\n";
}

//Insert default data into insurance table
$query5 = "INSERT INTO insurance (patient_id, iname, from_date, to_date) VALUES
    (1, 'A Insurance', '2010-01-01', '2015-12-31'),
    (1, 'F Insurance', '2018-01-01', '2022-12-31'),
    (2, 'B Insurance', '2016-01-01', '2020-12-31'),
    (2, 'G Insurance', '2021-01-01', '2024-12-31'),
    (3, 'C Insurance', '2017-01-01', '2025-12-31'),
    (3, 'H Insurance', '2020-01-01', '2026-12-31'),
    (4, 'D Insurance', '2023-01-01', '2030-12-31'),
    (4, 'I Insurance', '2028-01-01', '2032-12-31'),
    (5, 'E Insurance', '2020-01-01', '2020-12-31'),
    (5, 'J Insurance', '2019-01-01', '2022-12-31')";

//Show the (error) message if the data are created successfully or not
if (mysqli_query($connection, $query5)) {
    echo "Default data inserted into insurance table successfully" . "\n";
} else {
    echo "Error inserting default data into insurance table: " . mysqli_error($connection) . "\n";
}

//Close the connection
mysqli_close($connection);
echo "Connection closed successfully";