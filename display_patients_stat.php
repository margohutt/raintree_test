<?php
// Open the connection
require_once 'mysql_connection.php';

// Retrieve full name from the database as uppercase letters
$sql = "SELECT UPPER(first) AS firstname, UPPER(last) AS lastname FROM patient";

//Store frequency of each character in the database
$result = mysqli_query($connection, $sql);
if (mysqli_num_rows($result) > 0) {
    $character_counts = array();
    $number_of_letters = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $name = $row["firstname"] . " " . $row["lastname"];
        $number_of_letters += strlen($name) - substr_count($name, " ");
        for ($i = 0; $i < strlen($name); $i++) {
            $character = substr($name, $i, 1);
            if ($character != " ") {
                if (isset($character_counts[$character])) {
                    $character_counts[$character]++;
                } else {
                    $character_counts[$character] = 1;
                }
            }
        }
    }

// Sort the array by the count of each character
    ksort($character_counts);

// Output the results in a tabular format
    foreach ($character_counts as $character => $count) {
        $percent = ($count / $number_of_letters) * 100;
        echo "$character\t$count\t" . number_format($percent, 2) . "%\n";
    }

// Display the total number of letters without spaces
    echo "Total number of letters without spaces: $number_of_letters\n";

} else { echo "No results found"; }
mysqli_close($connection);