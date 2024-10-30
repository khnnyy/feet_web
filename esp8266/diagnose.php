<?php
$response = null; // Initialize response variable
$error_message = null; // Initialize error message variable

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Initialize cURL session
    $curl = curl_init();

    // Set the URL for the POST request
    curl_setopt($curl, CURLOPT_URL, "http://172.20.10.5:80/get_data");

    // Specify that this is a POST request
    curl_setopt($curl, CURLOPT_POST, true);

    // Set options to return the response as a string
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    // Execute the POST request
    $response = curl_exec($curl);

    // Check for cURL errors
    if (curl_errno($curl)) {
        $error_message = 'Error: ' . curl_error($curl);
    }

    // Close the cURL session
    curl_close($curl);

    // Decode the JSON response if it's in JSON format
    $data = isset($response) ? json_decode($response, true) : [];

    // Assign values to variables
    $temperature = $data['temperature'] ?? null;
    $heartRate = $data['heartRate'] ?? null;
    $bloodSaturation = $data['bloodSaturation'] ?? null;
    $bodyWeight = $data['bodyWeight'] ?? null;
    $gsr = $data['gsr'] ?? null;
    $foot = $data['foot'] ?? null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Response Data</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Response Data</h1>
    
    <form method="post" action="">
        <button type="submit">Get Data</button>
    </form>

    <?php if (isset($error_message)): ?>
        <p style="color: red;"><?php echo htmlspecialchars($error_message); ?></p>
    <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && $response): ?>
        <table>
            <thead>
                <tr>
                    <th>Parameter</th>
                    <th>Value</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Temperature</td>
                    <td><?php echo htmlspecialchars($temperature); ?> °C</td>
                </tr>
                <tr>
                    <td>Heart Rate</td>
                    <td><?php echo htmlspecialchars($heartRate); ?> bpm</td>
                </tr>
                <tr>
                    <td>Blood Saturation</td>
                    <td><?php echo htmlspecialchars($bloodSaturation); ?> %</td>
                </tr>
                <tr>
                    <td>Body Weight</td>
                    <td><?php echo htmlspecialchars($bodyWeight); ?> kg</td>
                </tr>
                <tr>
                    <td>GSR</td>
                    <td><?php echo htmlspecialchars($gsr); ?></td>
                </tr>
                <tr>
                    <td>Foot</td>
                    <td><?php echo htmlspecialchars($foot); ?></td>
                </tr>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>
