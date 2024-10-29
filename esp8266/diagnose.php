<?php
session_start(); // Start the session
$patient_id = isset($_GET['patient_id']) ? $_GET['patient_id'] : null;

if ($patient_id) {
    $_SESSION['patient_id'] = $patient_id; // Store in session
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foot Analysis Display</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #e8f3ff, #ffffff);
            color: #333;
            font-family: Arial, sans-serif;
        }
        .img-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            overflow: hidden;
        }
        .img-container img {
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            max-height: 75vh;
            width: auto; /* Allow image to scale properly */
        }
        .summary-container {
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        .data-label {
            font-weight: bold;
            color: #495057;
        }
        .data-value {
            background-color: #f1f3f5;
            border: none;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            padding: 10px;
        }
        .btn-danger {
            width: 100%;
            margin-bottom: 10px;
            font-weight: bold;
        }
        h2 {
            color: #007bff;
            font-weight: bold;
            border-bottom: 3px solid #e9ecef;
            padding-bottom: 10px;
        }
        .loading {
            display: none;
        }
        .loading.active {
            display: block;
            font-size: 1.2em;
            color: #007bff;
        }
    </style>
</head>
<body>
    <?php include_once "includes/header.php"; ?>
    <div class="container-fluid">
        <div class="row">
            <!-- Image Section -->
            <div class="col-md-7 img-container">
                <img src="assests/feet.jpg" class="img-fluid" alt="Foot Image">
            </div>

            <!-- Summary Section -->
            <div class="col-md-5 summary-container">
                <h2>Foot Analysis Summary</h2>
                <button id="diagnoseButton" class="btn btn-danger">Diagnose</button>
                <div id="loading" class="loading">Loading... Please wait.</div>

                <div id="dataDisplay">
                    <!-- Data will be displayed here after POST request -->
                    <p class="text-muted">No data available. Click "Diagnose" to start data retrieval.</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
