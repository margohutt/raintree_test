<?php
//Server name. Wamp server's default server name is localhost
$server_name = "localhost";

//Username. Wamp server's default username is root
$user_name = "root";

//Password. Wamp server's default password is empty
$password = "";

// Creating the connection by specifying the connection details
$connection = mysqli_connect($server_name, $user_name, $password);

// Checking the  connection
if (!$connection) {
    die("Failed ". mysqli_connect_error());
}
echo "Connection established successfully" . "\n";
