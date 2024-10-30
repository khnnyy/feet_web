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

    <div class="container-fluid">
        <div class="row">
            <!-- Image Section -->
            <div class="col-md-7 img-container">
                <!-- Optional image or SVG goes here -->
            </div>

            <!-- Summary Section -->
            <div class="col-md-5 summary-container">
                <h2>Foot Analysis Summary</h2>
                <button id="fetchDataBtn" class="btn btn-primary mb-3">Fetch Data</button>
                <div class="loading-spinner" id="loadingSpinner">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                
                <div id="dataDisplay" style="display: none;">
                    <div class="row">
                        <!-- Left Foot Data -->
                        <div class="col-md-6">
                            <h4>Left Foot</h4>
                            <div class="form-group">
                                <label class="data-label" for="tempLeft">Temperature</label>
                                <input type="text" class="form-control data-value" id="tempLeft" readonly>
                            </div>
                            <div class="form-group">
                                <label class="data-label" for="heartrateLeft">Heart Rate</label>
                                <input type="text" class="form-control data-value" id="heartrateLeft" readonly>
                            </div>
                            <div class="form-group">
                                <label class="data-label" for="bloodsatLeft">Blood Saturation</label>
                                <input type="text" class="form-control data-value" id="bloodsatLeft" readonly>
                            </div>
                            <div class="form-group">
                                <label class="data-label" for="bodyweightLeft">Body Weight</label>
                                <input type="text" class="form-control data-value" id="bodyweightLeft" readonly>
                            </div>
                            <div class="form-group">
                                <label class="data-label" for="gsrLeft">GSR</label>
                                <input type="text" class="form-control data-value" id="gsrLeft" readonly>
                            </div>
                        </div>

                        <!-- Right Foot Data -->
                        <div class="col-md-6">
                            <h4>Right Foot</h4>
                            <div class="form-group">
                                <label class="data-label" for="tempRight">Temperature</label>
                                <input type="text" class="form-control data-value" id="tempRight" readonly>
                            </div>
                            <div class="form-group">
                                <label class="data-label" for="heartrateRight">Heart Rate</label>
                                <input type="text" class="form-control data-value" id="heartrateRight" readonly>
                            </div>
                            <div class="form-group">
                                <label class="data-label" for="bloodsatRight">Blood Saturation</label>
                                <input type="text" class="form-control data-value" id="bloodsatRight" readonly>
                            </div>
                            <div class="form-group">
                                <label class="data-label" for="bodyweightRight">Body Weight</label>
                                <input type="text" class="form-control data-value" id="bodyweightRight" readonly>
                            </div>
                            <div class="form-group">
                                <label class="data-label" for="gsrRight">GSR</label>
                                <input type="text" class="form-control data-value" id="gsrRight" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('fetchDataBtn').addEventListener('click', function() {
            console.log("Fetch Data button clicked");

            // Show loading spinner
            document.getElementById('loadingSpinner').style.display = 'block';

            // Simulate a delay for data retrieval (e.g., 2 seconds)
            setTimeout(function() {
                // Hide loading spinner
                document.getElementById('loadingSpinner').style.display = 'none';

                // Display mock data for left foot
                document.getElementById('tempLeft').value = "36.5°C";
                document.getElementById('heartrateLeft').value = "72 bpm";
                document.getElementById('bloodsatLeft').value = "98%";
                document.getElementById('bodyweightLeft').value = "35 kg";
                document.getElementById('gsrLeft').value = "0.8 µS";

                // Display mock data for right foot
                document.getElementById('tempRight').value = "36.7°C";
                document.getElementById('heartrateRight').value = "75 bpm";
                document.getElementById('bloodsatRight').value = "97%";
                document.getElementById('bodyweightRight').value = "35 kg";
                document.getElementById('gsrRight').value = "0.9 µS";

                // Show data display section
                document.getElementById('dataDisplay').style.display = 'block';
                console.log("Mock data populated for both feet");
            }, 2000);
        });
    </script>
</body>
</html>
