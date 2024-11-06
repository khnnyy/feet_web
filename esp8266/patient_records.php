<?php
include "db_conn.php";

// Check if patient_id is set
if (!isset($_GET["patient_id"])) {
    echo "Patient not found.";
    exit;
}

$patient_id = intval($_GET["patient_id"]); // Ensure the patient_id is an integer for security
$records_per_page = 15;

// Get the current page number
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($current_page - 1) * $records_per_page;

// Initialize date variable
$date = '';
if (isset($_POST["search"])) {
    $date = trim($_POST['search_date']);
} elseif (isset($_GET["search_date"])) {
    $date = trim($_GET['search_date']); // Retain search date on pagination links
}

// Fetch patient name
$patient_name = '';
$sql = "SELECT `name` FROM `patients` WHERE `patient_id` = $patient_id";
$result = mysqli_query($conn, $sql);
if ($result && mysqli_num_rows($result) > 0) {
    $patient_row = mysqli_fetch_assoc($result);
    $patient_name = $patient_row['name'];
} else {
    echo "Patient not found.";
    exit;
}

// Prepare SQL statement for pagination
$sql = "SELECT `diagnostic_id`, `datetime` FROM `feet_diagnostics` WHERE `patient_id` = $patient_id";
if ($date) {
    $sql .= " AND `datetime` LIKE '%$date%'";
}
$sql .= " LIMIT $offset, $records_per_page";

$result = mysqli_query($conn, $sql);
if ($result) {
    $diagnostic = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    echo "Failed: " . mysqli_error($conn);
    exit;
}

// Get the total number of records for pagination
$count_sql = "SELECT COUNT(*) as total FROM `feet_diagnostics` WHERE `patient_id` = $patient_id";
if ($date) {
    $count_sql .= " AND `datetime` LIKE '%$date%'";
}
$count_result = mysqli_query($conn, $count_sql);
$total_records = mysqli_fetch_assoc($count_result)['total'];
$total_pages = ceil($total_records / $records_per_page);
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

    <title>PHP CRUD Application</title>
</head>

<body>
    <?php include "includes/header.php"; ?>

    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <span class="fs-5 fw-normal">PATIENT:
                    <span class="fw-bold"><?php echo htmlspecialchars($patient_name); ?></span>
                </span>
            </div>
            <div class="col-md-5">
                <form method="POST" class="d-flex">
                    <input type="date" class="form-control custom-input me-2" id="search_date" name="search_date" value="<?php echo htmlspecialchars($date); ?>" required>
                    <button type="submit" class="btn btn-primary" name="search">Search</button>
                </form>
            </div>
        </div>

        <table class="table table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Diagnostic ID</th>
                    <th scope="col">Date</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($diagnostic) {
                    foreach ($diagnostic as $row) {
                        // Format the date and time from the database
                        $formatted_datetime = date("Y-m-d H:i:s", strtotime($row["datetime"]));
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row["diagnostic_id"]); ?></td>
                            <td><?php echo $formatted_datetime; ?></td>
                            <td>
                                <a href="diagnose.php?diagnostic_id=<?php echo $row["diagnostic_id"]; ?>" class="link-dark" title="View Records"><i class="bi bi-file-medical-fill fs-5 me-3"></i></a>
                                <a href="edit.php?diagnostic_id=<?php echo $row["diagnostic_id"]; ?>" class="link-dark" title="Edit"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
                                <a href="delete.php?diagnostic_id=<?php echo $row["diagnostic_id"]; ?>" class="link-dark" title="Delete"><i class="fa-solid fa-trash fs-5 me-3"></i></a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='3'>No records found.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <nav>
            <ul class="pagination justify-content-center">
                <?php if ($current_page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $current_page - 1; ?>&patient_id=<?php echo $patient_id; ?>&search_date=<?php echo htmlspecialchars($date); ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?php echo $current_page == $i ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>&patient_id=<?php echo $patient_id; ?>&search_date=<?php echo htmlspecialchars($date); ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($current_page < $total_pages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $current_page + 1; ?>&patient_id=<?php echo $patient_id; ?>&search_date=<?php echo htmlspecialchars($date); ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
            crossorigin="anonymous"></script>
</body>
</html>
