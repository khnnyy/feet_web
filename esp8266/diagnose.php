<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foot Analysis Display</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .img-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            overflow: hidden;
        }
        .summary-container {
            padding: 20px;
        }
        .data-label {
            font-weight: bold;
        }
        .data-value {
            background-color: #f8f9fa;
        }
        .loading-spinner {
            display: none;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
</head>
<body>
    <?php include_once "includes/header.php" ?>

    <div class="container-fluid">
        <div class="row">
            <!-- Image Section -->
            <div class="col-md-7 img-container">
                <img src="assests/feet.jpg" class="img-fluid" alt="Foot Image" style="max-height: 80vh;">
            </div>

            <!-- Summary Section -->
            <div class="col-md-5 summary-container">
                <h2>Foot Analysis Summary</h2>
                <button id="fetchDataBtn" class="btn btn-primary mb-3">Fetch Data</button>
                <div class="loading-spinner">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <div id="dataDisplay" style="display: none;">
                    <div class="form-group">
                        <label class="data-label" for="temp">Temperature</label>
                        <input type="text" class="form-control data-value" id="temp" placeholder="Value" readonly>
                    </div>
                    <div class="form-group">
                        <label class="data-label" for="heartrate">Heart Rate</label>
                        <input type="text" class="form-control data-value" id="heartrate" placeholder="Value" readonly>
                    </div>
                    <div class="form-group">
                        <label class="data-label" for="bloodsat">Blood Saturation</label>
                        <input type="text" class="form-control data-value" id="bloodsat" placeholder="Value" readonly>
                    </div>
                    <div class="form-group">
                        <label class="data-label" for="bodyweight">Body Weight</label>
                        <input type="text" class="form-control data-value" id="bodyweight" placeholder="Value" readonly>
                    </div>
                    <div class="form-group">
                        <label class="data-label" for="gsr">GSR</label>
                        <input type="text" class="form-control data-value" id="gsr" placeholder="Value" readonly>
                    </div>
                    <div class="form-group">
                        <label class="data-label" for="foot">Foot</label>
                        <input type="text" class="form-control data-value" id="foot" placeholder="Value" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('fetchDataBtn').addEventListener('click', function () {
            // Show loading spinner
            document.querySelector('.loading-spinner').style.display = 'block';

            // Fetch data via POST request
            fetch('post_data.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    api_key: 'tPmAT5Ab3j7F9'
                })
            })
            .then(response => response.json())
            .then(data => {
                // Hide loading spinner and display data
                document.querySelector('.loading-spinner').style.display = 'none';
                document.getElementById('dataDisplay').style.display = 'block';

                // Populate fields with received data
                document.getElementById('temp').value = data.temp;
                document.getElementById('heartrate').value = data.heartrate;
                document.getElementById('bloodsat').value = data.bloodsat;
                document.getElementById('bodyweight').value = data.bodyweight;
                document.getElementById('gsr').value = data.gsr;
                document.getElementById('foot').value = data.foot;
            })
            .catch(error => {
                console.error('Error fetching data:', error);
                document.querySelector('.loading-spinner').style.display = 'none';
                alert('Failed to fetch data. Please try again.');
            });
        });
    </script>
</body>
</html>
