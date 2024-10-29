<?php
session_start();
include "db_conn.php";

$api_key_value = "tPmAT5Ab3j7F9";

$api_key = $temp = $heartrate = $bloodsat = $bodyweight = $gsr = $foot = "";
$patient_id = (int)$_SESSION['patient_id'];
echo  $patient_id;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $api_key = test_input($_POST["api_key"]);
    if ($api_key == $api_key_value) {
        $temp = test_input($_POST["temp"]);
        $heartrate = test_input($_POST["heartrate"]);
        $bloodsat = test_input($_POST["bloodsat"]);
        $bodyweight = test_input($_POST["bodyweight"]);
        $gsr = test_input($_POST["gsr"]);
        $foot = test_input($_POST["foot"]);

        echo "Patient ID (before query execution): " . $patient_id . "<br>";
        echo "Executing query with values: temp=$temp, heartrate=$heartrate, bloodsat=$bloodsat, bodyweight=$bodyweight, gsr=$gsr, foot=$foot<br>";

        // Direct query to troubleshoot prepared statement issues
        $sql = "INSERT INTO `feet_diagnostics` (`patient_id`, `temp`, `heartrate`, `bloodsat`, `bodyweight`, `gsr`, `foot`) 
                                    VALUES ('$patient_id', '$temp', '$heartrate', '$bloodsat', '$bodyweight', '$gsr', '$foot')";
        
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully with direct query.";
        } else {
            echo "Error with direct query: " . $conn->error;
        }

        $conn->close();
    } else {
        echo "Wrong API Key provided.";
    }
} else {
    echo "No data posted with HTTP POST.";
}

function test_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}
