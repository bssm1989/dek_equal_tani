<?php
// Your database connection code here
require '../service/connect.php';
$response = array();
$requiredFields = array(
    'national_id',
    'title_id',
    'name',
    'surname',
    'gender_id',
    'religion_id',
    'religion_other',
    // 'birth_date',
    'age',
    'address',
    'street',
    // 'village_id',
    'place_id',
    'postcode',
    'phone_number'
);

$missingFields = array();
foreach ($requiredFields as $field) {
    if (!isset($_POST[$field])) {
        $missingFields[] = $field;
    }
}

if (!empty($missingFields)) {
    $response['success'] = false;
    $response['message'] = 'Required fields are not set: ' . implode(', ', $missingFields);
    echo json_encode($response);
    exit(); // Stop further processing
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $action = isset($_POST['action']) ? $_POST['action'] : '';

    if ($action === 'insert') {
         // Insert data function
        function insertData($table, $data, $conn)
        {
            try {
                $columns = implode(', ', array_keys($data));
                $values = ':' . implode(', :', array_keys($data));

                $sql = "INSERT INTO $table ($columns) VALUES ($values)";
                $response['sql'] = $sql;
                $response['success'] = true;        $response['message'] = 'Data inserted successfully.';        echo json_encode($response);                exit();
       
                $stmt = $conn->prepare($sql);
                $stmt->execute($data);

                return $conn->lastInsertId(); // Return the inserted ID
            } catch (PDOException $e) {
                return false; // Return false on error
            }
        }
      
        if (
            isset($_POST['national_id']) &&
            isset($_POST['title_id']) &&
            isset($_POST['name']) &&
            isset($_POST['surname']) &&
            isset($_POST['gender_id']) &&
            isset($_POST['religion_id']) &&
            isset($_POST['religion_other']) &&
            isset($_POST['birth_date']) &&
            isset($_POST['age']) &&
            isset($_POST['address']) &&
            isset($_POST['street']) &&
            // isset($_POST['village_id']) &&
            isset($_POST['place_id']) &&
            isset($_POST['postcode']) &&
            isset($_POST['phone_number'])
        ) {
            // Insert person data
            $personData = array(
                'pid' => $_POST['national_id'],
                'titid' => $_POST['title_id'],
                'name' => $_POST['name'],
                'sname' => $_POST['surname'],
                'genid' => $_POST['gender_id'],
                'religid' => $_POST['religion_id'],
                'religoth' => $_POST['religion_other'],
                'brtdte' => $_POST['birth_date'],
                'age' => $_POST['age'],
                'adr' => $_POST['address'],
                'soi' => $_POST['street'],
                // 'vllid' => $_POST['village_id'],
                'plcid' => $_POST['place_id'],
                'postcode' => $_POST['postcode'],
                'pertel' => $_POST['phone_number'],
                'hholdid' => $_POST['household_id'],
                // ... other fields
            );
          
            $personInsert = insertData('person', $personData, $conn);

            if ($personInsert !== false && $personInsert !== null) {
                // Insert child data
                $childData = array(
                    'perid' => $personInsert,
                    'chiord' => $_POST['child_order'],
                    'livewid' => $_POST['living_with'],
                    // ... other fields
                );

                $childInsert = insertData('child', $childData, $conn);

                if ($childInsert) {
                    // Insert dispform data
                    $dispformData = array(
                        'perid' => $personInsert,
                        'dispfrmid' => $_POST['display_form'],
                        // ... other fields
                    );

                    $dispformInsert = insertData('disptyp', $dispformData, $conn);

                    if ($dispformInsert) {
                        $response['success'] = true;
                        $response['message'] = 'Data inserted successfully.';
                    } else {
                        $response['success'] = false;
                        $response['message'] = 'Error inserting dispform data.';
                    }
                } else {
                    $response['success'] = false;
                    $response['message'] = 'Error inserting child data.';
                }
            } else {
                $response['success'] = false;
                $response['message'] = 'Error inserting person data.';
            }
        } else {
            $response['success'] = false;
            $response['message'] = 'Required fields are not set.';
        }
    } else {
        $response['success'] = false;
        $response['message'] = 'Invalid action.';
    }
} else {
    $response['success'] = false;
    $response['message'] = 'Invalid request method.';
}

// Return JSON response
echo json_encode($response);

// Close database connection
$conn = null;
?>
