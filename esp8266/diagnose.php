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
    </style>
    <?php include "includes/header.php"; ?>
</head>

<body>
    <div class="container container-main">
        <div class="row">
            <div class="col-md-7">
                <h4 class="mb-3">Foot Diagnostic Analysis</h4>
                <div class="diagnostic-image"></div> <!-- Placeholder for image -->
            </div>
            <div class="col-md-5">
                <h4>Patient: <?php echo "ABUBAKAR, AL-KHADEEM H."; ?></h4>
                <p class="summary-text d-flex align-items-center">
                    <span class="highlight-label">Patient ID:</span> <?php echo "1"; ?>
                    <span class="mx-2">|</span>
                    <span class="highlight-label">Diagnostic ID:</span> <?php echo "5"; ?>
                    <span class="mx-2">|</span>
                    <span class="highlight-label">Date-Time:</span> <?php echo "2024-10-30"; ?>
                </p>

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
                            <td class="reading" id="leftTemperature">-</td>
                            <td class="reading" id="rightTemperature">-</td>
                        </tr>
                        <tr>
                            <td class="label">Heart Rate:</td>
                            <td class="reading" id="leftHeartRate">-</td>
                            <td class="reading" id="rightHeartRate">-</td>
                        </tr>
                        <tr>
                            <td class="label">Blood Saturation:</td>
                            <td class="reading" id="leftBloodSaturation">-</td>
                            <td class="reading" id="rightBloodSaturation">-</td>
                        </tr>
                        <tr>
                            <td class="label">Body Weight:</td>
                            <td class="reading" id="leftBodyWeight">-</td>
                            <td class="reading" id="rightBodyWeight">-</td>
                        </tr>
                        <tr>
                            <td class="label">GSR:</td>
                            <td class="reading" id="leftGSR">-</td>
                            <td class="reading" id="rightGSR">-</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        const leftFootData = { temperature: 36.5, heartRate: 72, bloodSaturation: 98, bodyWeight: 70, gsr: 0.15 };
        const rightFootData = { temperature: 36.7, heartRate: 70, bloodSaturation: 97, bodyWeight: 71, gsr: 0.13 };

        document.getElementById("leftTemperature").innerText = leftFootData.temperature;
        document.getElementById("leftHeartRate").innerText = leftFootData.heartRate;
        document.getElementById("leftBloodSaturation").innerText = leftFootData.bloodSaturation;
        document.getElementById("leftBodyWeight").innerText = leftFootData.bodyWeight;
        document.getElementById("leftGSR").innerText = leftFootData.gsr;

        document.getElementById("rightTemperature").innerText = rightFootData.temperature;
        document.getElementById("rightHeartRate").innerText = rightFootData.heartRate;
        document.getElementById("rightBloodSaturation").innerText = rightFootData.bloodSaturation;
        document.getElementById("rightBodyWeight").innerText = rightFootData.bodyWeight;
        document.getElementById("rightGSR").innerText = rightFootData.gsr;
    </script>
</body>

</html>
