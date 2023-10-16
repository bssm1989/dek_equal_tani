<?php
require '../service/connect.php'; // Include your database connection script

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $perid = $_POST['id']; // Get the perid of the person to delete from the POST data

    // Start a transaction to ensure data consistency
    mysqli_autocommit($conn, false);

    // Delete dispform data first
    $deleteDispformDataQuery = "DELETE FROM hhelpjob WHERE hhjobid = $perid";
    $resultDispformData = mysqli_query($conn, $deleteDispformDataQuery);

    if ($resultDispformData) {


        $response['success'] = true;
        $response['message'] = 'Data deleted successfully.';
    } else {
        // Rollback the transaction on error
        mysqli_rollback($conn);

        $response['success'] = false;
        $response['message'] = 'Error deleting person data: ' . mysqli_error($conn);
    }


    // Restore autocommit mode
    mysqli_autocommit($conn, true);
} else {
    $response['success'] = false;
    $response['message'] = 'Invalid request method.';
}

echo json_encode($response);
