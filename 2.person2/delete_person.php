<?php
require '../service/connect.php'; // Include your database connection script

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $perid = $_POST['id']; // Get the perid of the person to delete from the POST data

    // Start a transaction to ensure data consistency
    mysqli_autocommit($conn, false);

    // Delete dispform data first
    $deleteDispformDataQuery = "DELETE FROM disptyp WHERE perid = $perid";
    $resultDispformData = mysqli_query($conn, $deleteDispformDataQuery);

    if ($resultDispformData) {
        // Delete child data
        $deleteChildQuery = "DELETE FROM child WHERE perid = $perid";
        $resultChild = mysqli_query($conn, $deleteChildQuery);

        if ($resultChild) {
            // Delete person data
            $deletePersonQuery = "DELETE FROM person WHERE perid = $perid";
            $resultPerson = mysqli_query($conn, $deletePersonQuery);

            if ($resultPerson) {
                // Commit the transaction
                mysqli_commit($conn);

                $response['success'] = true;
                $response['message'] = 'Data deleted successfully.';
            } else {
                // Rollback the transaction on error
                mysqli_rollback($conn);

                $response['success'] = false;
                $response['message'] = 'Error deleting person data: ' . mysqli_error($conn);
            }
        } else {
            // Rollback the transaction on error
            mysqli_rollback($conn);

            $response['success'] = false;
            $response['message'] = 'Error deleting child data: ' . mysqli_error($conn);
        }
    } else {
        // Rollback the transaction on error
        mysqli_rollback($conn);

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
