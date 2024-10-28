<?php
include "db_conn.php";
$foot_id = $_GET["foot_id"];
$sql = "DELETE FROM `foot_data` WHERE foot_id = $foot_id";
$result = mysqli_query($conn, $sql);

if ($result) {
  header("Location: index.php?msg=Data deleted successfully");
} else {
  echo "Failed: " . mysqli_error($conn);
}