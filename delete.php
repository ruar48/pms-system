<?php
include 'config/connection.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Assuming you have a PDO connection
    $query = $con->prepare("DELETE FROM `patients` WHERE id = ?");
    $delete = $query->execute([$id]);

    if ($delete) {
        echo "<div class='alert alert-success' role='alert' id='msg'>Deleted Successfully</div>";
        echo "<script> setTimeout(function(){location.replace('patient_history.php');}, 1000);</script>";
    } else {
        echo "<div class='alert alert-danger' role='alert' id='msg'>Delete Failed</div>";
        echo "<script> setTimeout(function(){location.replace('patient_history.php');}, 1000);</script>";
    }
} else {
    echo "<div class='alert alert-danger' role='alert' id='msg'>Invalid ID</div>";
}
?>