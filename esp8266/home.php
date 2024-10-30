<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bootstrap Homepage</title>
  
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<?php include "includes/header.php" ?>
<body>
  <div class="container vh-80 d-flex justify-content-center align-items-center">
    <div class="text-center">
      <h1 class="mb-4">Welcome to the Homepage Khan</h1>
      <div class="d-flex justify-content-center gap-3">
      <a href="patient_form.php" class="btn btn-primary btn-lg px-5 py-3 fs-3">Add Patients</a>
      <a href="view.php" class="btn btn-success btn-lg px-5 py-3 fs-3">View Patients</a>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>
