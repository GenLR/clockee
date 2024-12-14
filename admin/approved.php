<?php
include("includes/connection.php");

if (isset($_GET['id'])) {
    $id = $_GET['id']; 
    $query = mysqli_query($connection, "UPDATE tbl_leave SET status='approved' WHERE id='$id'");
    header("Location: leave.php");
} else {
    echo "<script>
        alert('Something went wrong.');
        </script>";
    header("Location: leave.php");
}

?>
