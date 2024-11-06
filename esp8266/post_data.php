<?php
include_once "db_conn.php";

$response = null;
$error_message = null;

if (isset($_GET["patient_id"])) {
    $patient_id = $_GET["patient_id"];
    $current_datetime = date("Y-m-d H:i:s");
    
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "http://172.16.154.170:80/get_data");
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            $error_message = 'Error: ' . curl_error($curl);
        }

        curl_close($curl);
        $data = isset($response) ? json_decode($response, true) : [];

        $temperature = $data['temperature'] ?? null;
        $heartRate = $data['heartRate'] ?? null;
        $bloodSaturation = $data['bloodSaturation'] ?? null;
        $bodyWeight = $data['bodyWeight'] ?? null;
        $gsr = $data['gsr'] ?? null;
        $foot = $data['foot'] ?? null;

        $sql= "SELECT diagnostic_id FROM `feet_diagnostics` WHERE diagnostic_id > 0 ORDER BY diagnostic_id DESC limit 1";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            $last_id_row = mysqli_fetch_assoc($result);
            $diagnostic_id = ($last_id_row['diagnostic_id'] ?? 0) + 1;
        } else {
            echo "Failed: " . mysqli_error($conn);
        }
        echo $temperature;
        $sql = "INSERT INTO `feet_diagnostics`(`diagnostic_id`,`patient_id`, `temp`, `heartrate`, `bloodsat`, `bodyweight`, `gsr`, `foot`, `datetime`)
                VALUES ('$diagnostic_id','$patient_id','$temperature','$heartRate' ,'$bloodSaturation' ,'$bodyWeight' ,'$gsr' ,'$foot' ,'$current_datetime')";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            header("Location: index.php?msg=New record created successfully");
        } else {
            echo "Failed: " . mysqli_error($conn);
        }

        header("Location: diagnose.php?diagnostic_id=" . $diagnostic_id);
        exit();
}
?>