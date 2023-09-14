<?php
require '../service/connect.php'; // Include your database connection script

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id']; // Get the perid of the person to delete from the POST data
    $table = $_POST['table'];
    $fillId = $_POST['fillId'];
    // Start a transaction to ensure data consistency


    // Delete dispform data first
    $deleteDispformDataQuery = "DELETE FROM $table WHERE    $fillId = $id";
    $resultDispformData = mysqli_query($conn, $deleteDispformDataQuery);

    if ($resultDispformData) {
        // Delete child data

        $response['success'] = true;
        $response['message'] = 'Data deleted successfully.';
    } else {
        // Rollback the transaction on error


        $response['success'] = false;
        $response['message'] = 'Error deleting dispform data: ' . mysqli_error($conn);
    }

    // Restore autocommit mode
    mysqli_autocommit($conn, true);
} else {
    $response['success'] = false;
    $response['message'] = 'Invalid request method.';
}

echo json_encode($response);
