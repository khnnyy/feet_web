<?php
include "db_conn.php";

if (isset($_POST["submit"])) {
    // Get the combined patient name and convert it to uppercase
    $patient_name = strtoupper(trim($_POST['patient_name']));

    // Prepare SQL statement to prevent SQL injection
    $sql = "INSERT INTO `patients`(`name`) VALUES ('$patient_name')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: index.php?msg=New record created successfully");
        exit; // Ensure script termination after redirect
    } else {
        echo "Failed: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Form</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .custom-input {
            width: 300px; 
        }
    </style>
    <script>
        function combineNames() {
            const lastName = document.getElementById("lastName").value.trim();
            const firstName = document.getElementById("firstName").value.trim();
            const middleInitial = document.getElementById("middleInitial").value.trim();
            const patientName = `${lastName}, ${firstName} ${middleInitial}`;
            // Set the combined name into the hidden input field
            document.getElementById("patient_name").value = patientName.toUpperCase();
        }
    </script>
</head>
<body>
    <?php include 'includes/header.php'?>
    <div class="container mt-5">
        <div class="d-flex justify-content-center">
            <form method="POST" onsubmit="combineNames()">
                <h2 class="text-center mb-4">Patient Registration Form</h2>
                <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <input type="text" class="form-control custom-input" id="lastName" placeholder="Enter last name" required>
                </div>
                <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input type="text" class="form-control custom-input" id="firstName" placeholder="Enter first name" required>
                </div>
                <div class="form-group">
                    <label for="middleInitial">Middle Initial</label>
                    <input type="text" class="form-control custom-input" id="middleInitial" placeholder="Enter middle initial" maxlength="1">
                </div>
                <input type="hidden" id="patient_name" name="patient_name" required>
                <button href="home.php" type="submit" class="btn btn-primary" name="submit">Submit</button>
                <a href="home.php" class="btn btn-danger">Cancel</a>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
