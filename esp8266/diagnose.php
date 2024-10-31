<?php
include "db_conn.php";

$temp = $heartrate = $bloodsat = $bodyweight = $gsr = $foot = $datetime = null;

if (isset($_GET["diagnostic_id"])) {
    $diagnostic_id = $_GET["diagnostic_id"];

    $sql = "SELECT patient_id, temp, heartrate, bloodsat, bodyweight, gsr, foot, datetime FROM feet_diagnostics WHERE diagnostic_id= $diagnostic_id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
        
    $patient_id = $row["patient_id"];
    $temp = $row["temp"];
    $heartrate = $row["heartrate"];
    $bloodsat = $row["bloodsat"];
    $bodyweight = $row["bodyweight"];
    $gsr = $row["gsr"];
    $foot = $row["foot"];
    $datetime = $row["datetime"];

    $sql = "SELECT name FROM patients WHERE patient_id= $patient_id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $patient_name = $row["name"];

    // Display patient information
    echo "<div class='container my-4'>";
    echo "<h4 class='mb-3'>Patient Information</h4>";
    echo "Patient ID: $patient_id<br>";
    echo "Patient Name: $patient_name<br>";
    echo "Date-Time: $datetime<br>";
    echo "</div>";
}

// Close database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <title>PHP CRUD Application - Patient Analysis</title>

    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif !important;
            color: #333 !important;
        }

        .sensor-title {
            font-size: 1.25rem;
            color: #2c6b2f; /* Dark green color */
            margin-bottom: 10px;
        }
        
        .summary-text {
            font-size: 1rem;
            color: #555;
            margin-bottom: 10px;
        }

        .highlight-label {
            font-weight: 400 !important; /* Light, clean font weight */
            color: #6c757d !important; /* Muted gray */
        }

        .sensor-table {
            margin-bottom: 20px;
            width: 100%;
            border-collapse: collapse;
        }

        .sensor-table th, .sensor-table td {
            padding: 10px;
            text-align: left;
            font-size: 1rem;
        }

        .sensor-table th {
            color: #5a5a5a !important; /* Medium gray for headers */
            border-bottom: 2px solid #4CAF50;
        }

        .sensor-table td {
            border-bottom: none;
        }

        .label {
            font-weight: 400; /* Lighter for minimalistic look */
            color: #666 !important; /* Soft gray tone */
            font-size: 0.95rem; /* Slightly smaller text */
        }

        .reading {
            color: #333 !important; /* Darker gray for readability */
        }

        /* Card hover effect */
        .card {
            transition: transform 0.2s, box-shadow 0.2s; /* Smooth transition */
        }

        .card:hover {
            transform: scale(1.02); /* Slightly enlarge on hover */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2); /* Add shadow on hover */
        }
    </style>
    <?php include "includes/header.php"; ?>
</head>

<body>
    <div class="container container-main">
        <div class="row">
            <div class="col-md-7">
                <div class="container my-4">
                    <h4 class="mb-3">Foot Diagnostic Analysis</h4>
                    <div class="diagnostic-image"></div> <!-- Placeholder for image -->
                </div>
            </div>
            <div class="col-md-5">
                <div class="row mb-2"> <!-- Adjusted margin bottom -->
                    <div class="card p-2 shadow-sm ">
                    <div class="sensor-title">Patient Information</div>
                        <h4><?php echo $patient_name; ?></h4>
                        <p class="summary-text d-flex align-items-center">
                            <span class="highlight-label">Patient ID:</span> <?php echo $patient_id; ?>
                            <span class="mx-2">|</span>
                            <span class="highlight-label">Diagnostic ID:</span> <?php echo $diagnostic_id; ?>
                        </p>
                        <span class="highlight-label">Date-Time:</span> <?php echo $datetime; ?>
                    </div>
                </div>
                <div class="row mb-2"> <!-- Adjusted margin bottom -->
                    <div class="card p-2 shadow-sm">
                        <div class="sensor-title">Foot Sensor Readings</div>
                        <table class="table sensor-table">
                            <thead>
                                <tr>
                                    <th>Parameter</th>
                                    <th>Left Foot Value</th>
                                    <th>Right Foot Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="label">Temperature:</td>
                                    <td class="reading" id="leftTemperature"><?php echo $temp ?> °C</td>
                                    <td class="reading" id="rightTemperature">-</td>
                                </tr>
                                <tr>
                                    <td class="label">Heart Rate:</td>
                                    <td class="reading" id="leftHeartRate"><?php echo $heartrate ?> bpm</td>
                                    <td class="reading" id="rightHeartRate">-</td>
                                </tr>
                                <tr>
                                    <td class="label">Blood Saturation:</td>
                                    <td class="reading" id="leftBloodSaturation"><?php echo $bloodsat ?></td>
                                    <td class="reading" id="rightBloodSaturation">-</td>
                                </tr>
                                <tr>
                                    <td class="label">Body Weight:</td>
                                    <td class="reading" id="leftBodyWeight"><?php echo $bodyweight ?></td>
                                    <td class="reading" id="rightBodyWeight">-</td>
                                </tr>
                                <tr>
                                    <td class="label">GSR:</td>
                                    <td class="reading" id="leftGSR"><?php echo $gsr ?></td>
                                    <td class="reading" id="rightGSR">-</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-eL5EjK5mRjw1aGyfIhGo/c7UUR6DFcUny5ZBfGeEd4G5g2SuOa1yxQ4GYOwlYJ6k" crossorigin="anonymous"></script>
</body>

</html>
