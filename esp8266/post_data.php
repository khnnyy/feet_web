<?php
include "db_conn.php"; // Ensure this file is present and contains your database connection

$api_key_value = "tPmAT5Ab3j7F9";

$api_key = $temp = $heartrate = $bloodsat = $bodyweight = $gsr = $foot = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $api_key = test_input($_POST["api_key"]);
    if($api_key == $api_key_value) {
        $temp = test_input($_POST["temp"]);
        $heartrate = test_input($_POST["heartrate"]);
        $bloodsat = test_input($_POST["bloodsat"]);
        $bodyweight = test_input($_POST["bodyweight"]); // Corrected variable name
        $gsr = test_input($_POST["gsr"]);
        $foot = test_input($_POST["foot"]);

        // Ensure all values are set correctly before executing SQL
        $sql = "INSERT INTO `feet_diagnostics` (`temp`, `heartrate`, `bloodsat`, `bodyweight`, `gsr`, `foot`)
                VALUES ('$temp', '$heartrate', '$bloodsat', '$bodyweight', '$gsr', '$foot')";
        
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    
        $conn->close();
    } else {
        echo "Wrong API Key provided.";
    }
} else {
    echo "No data posted with HTTP POST.";
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}