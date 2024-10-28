<?php
include "db_conn.php";

// Set the number of records per page
$records_per_page = 15;

// Get the current page number from the query string, default to 1 if not set
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($current_page - 1) * $records_per_page;

// Initialize search name variable
$search_name = '';
if (isset($_POST["search"])) {
    // Get the combined patient name and convert it to uppercase
    $search_name = strtoupper(trim($_POST['search_name']));
}

// Prepare SQL statement for pagination
$sql = "SELECT * FROM `patients`";

// If a search term is provided, modify the SQL query
if ($search_name) {
    $sql .= " WHERE `name` LIKE '%$search_name%'";
}

$sql .= " LIMIT $offset, $records_per_page";

$result = mysqli_query($conn, $sql);
if ($result) {
    $patients = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    echo "Failed: " . mysqli_error($conn);
}

// Prepare the SQL query for counting total records
$count_sql = "SELECT COUNT(*) as total FROM `patients`";
if ($search_name) {
    $count_sql .= " WHERE `name` LIKE '%$search_name%'";
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
        <div class="row mb-2">
            <div class="col-md-5">
                <form method="POST" class="d-flex">
                    <input type="text" class="form-control custom-input me-2" id="search_name" name="search_name"
                           placeholder="Enter patient name" maxlength="100" required>
                    <button type="submit" class="btn btn-primary" name="search">Search</button>
                </form>
            </div>
        </div>

        <table class="table table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Patient ID</th>
                    <th scope="col">Patient Name</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($patients) {
                    foreach ($patients as $row) {
                ?>
                    <tr>
                        <td><?php echo $row["patient_id"] ?></td>
                        <td><?php echo $row["name"] ?></td>
                        <td>
                            <a href="diagnose.php?patient_id=<?php echo $row["patient_id"] ?>" class="link-dark" title="Diagnose"><i class="bi bi-lungs-fill fs-5 me-3"></i></a>
                            <a href="patient_records.php?patient_id=<?php echo $row["patient_id"] ?>" class="link-dark" title="View Records"><i class="bi bi-file-medical-fill fs-5 me-3"></i></a>
                            <a href="edit.php?patient_id=<?php echo $row["patient_id"] ?>" class="link-dark" title="Edit"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
                            <a href="delete.php?patient_id=<?php echo $row["patient_id"] ?>" class="link-dark" title="Delete"><i class="fa-solid fa-trash fs-5 me-3"></i></a>
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
                        <a class="page-link" href="?page=<?php echo $current_page - 1; ?>&search_name=<?php echo $search_name; ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php endif; ?>
                
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?php echo $current_page == $i ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>&search_name=<?php echo $search_name; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
                
                <?php if ($current_page < $total_pages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $current_page + 1; ?>&search_name=<?php echo $search_name; ?>" aria-label="Next">
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
