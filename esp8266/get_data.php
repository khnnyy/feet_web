<?php
session_start();

$data = [
    "temp" => isset($_SESSION['temp']) ? $_SESSION['temp'] : 'N/A',
    "heartrate" => isset($_SESSION['heartrate']) ? $_SESSION['heartrate'] : 'N/A',
    "bloodsat" => isset($_SESSION['bloodsat']) ? $_SESSION['bloodsat'] : 'N/A',
    "bodyweight" => isset($_SESSION['bodyweight']) ? $_SESSION['bodyweight'] : 'N/A',
    "gsr" => isset($_SESSION['gsr']) ? $_SESSION['gsr'] : 'N/A',
    "foot" => isset($_SESSION['foot']) ? $_SESSION['foot'] : 'N/A',
];

header('Content-Type: application/json');
echo json_encode($data);
?>
