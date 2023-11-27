<?php
// Your database connection code here
require '../service/connect.php';
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//$conn = @mysqli_connect("localhost", "root", "root", "dek_equal_tani") or die(mysqli_connect_error());
//change to pdo
// $conn = new PDO('mysql:host=localhost;dbname=dek_equal_tani', 'root', 'root');
// $dbh = new PDO('mysql:host=localhost;dbname=test', 'username', 'password');

$response = array();




function insertData($table, $data, $conn)
{
    // ... Your code before

    try {
        $columns = implode(', ', array_keys($data));
        $values = '"' . implode('", "', array_values($data)) . '"';
        // add session "staffid" to recorded_by and put datetime to recorded_date
        $columns .= ', recorded_by, recorded_date';
        $values .= ', "' . $_SESSION['staffid'] . '", "' . date('Y-m-d H:i:s') . '"';
        $sql = "INSERT INTO $table ($columns) VALUES ($values)";

        //  echo "SQL Query: $sql<br>";

        $user_id = $_SESSION['staffid'];
        mysqli_query($conn, "SET @user_id =$user_id,@query_value ='$sql'");
        $result = mysqli_query($conn, $sql);

        if ($result) {
            // echo "Inserted ID: " . mysqli_insert_id($conn) . "<br>";
            return true; // Return the inserted ID
        } else {
            // echo "Query execution failed.<br>";
            return false;
        }
    } catch (Exception $e) {
        // echo "Error Message: " . $e->getMessage() . "<br>";
        return false; // Return false on error
    }

    // ... Your code after

}
function updateData($table, $data, $condition, $conn, $id)
{
    // ... Your code before
    try {
        $updateString = '';
        foreach ($data as $key => $value) {
            $updateString .= "$key = '$value', ";
        }
        $updateString .= 'modified_by = "' . $_SESSION['staffid'] . '", modified_date = "' . date('Y-m-d H:i:s') . '"';
        $updateString = rtrim($updateString, ', ');

        $sql = "UPDATE $table SET $updateString WHERE $condition";

        // echo $sql;

        $user_id = $_SESSION['staffid'];
        mysqli_query($conn, "SET @user_id =$user_id,@query_value ='$sql'");
        $result = mysqli_query($conn, $sql);

        if ($result) {
            // echo "Updated ID: " .$id;
            return $id; // Return the updated ID
        } else {
            // echo "Query execution failed.<br>";
            return false;
        }
    } catch (Exception $e) {
        // echo "Error Message: " . $e->getMessage() . "<br>";
        return false; // Return false on error
    }

    // ... Your code after

}





if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $action = isset($_POST['action']) ? $_POST['action'] : '';

    if ($action === 'insert') {
        // Insert data function

        foreach ($requiredFields as $field) {
            if (!isset($_POST[$field])) {
                $_POST[$field] = null;
            }
        }
        // perid		
        // eduid		
        // edusemester	
        // edugrade	
        // heduid	

        // hedu	ประวัติการศึกษา				
        // ชื่อฟิลด์	ประเภทข้อมูล	ความยาว	ความหมาย	PK/FK	คำอธิบายเพิ่มเติม
        // heduid	bigint		รหัสประวัติการศึกษา	PK	
        // perid	bigint		รหัสบุคคล --> รหัสเด็ก	FK	
        // eduid	int	2	ระดับการศึกษา	FK	มีตารางย่อย
        // edulev	int	1	ชั้นปี		
        // edusemester	int	6	ปีการศึกษา		เก็บ 6 หลัก เช่น 256601
        // edugrade	number	4	เกรดเฉลี่ย		เช่น 3.50
        // edudetail	varchar	200	รายละเอียดอื่น ๆ	
        // Insert person data
        $personData = array(
            'perid' => $_POST['perid'],
            'eduid' => $_POST['eduid'],
            'edusemester' => $_POST['edusemester'],
            'edugrade' => $_POST['edugrade'],
            // 'heduid'=> $_POST['heduid'],
            'edulev' => $_POST['edulev'],
            'edudetail' => $_POST['edudetail']


        );

        // Remove null values from personData array
        $personData = array_filter($personData, function ($value) {
            return $value !== null;
        });

        $personInsert = insertData('hedu', $personData, $conn);
        if ($personInsert) {
            $response['success'] = true;
            $response['message'] = 'Data inserted successfully.';
        } else {
            $response['success'] = false;
            $response['message'] = 'Error inserting  data.';
        }

        // Rest of your code...

    } elseif ($action === 'update') {
        $peridToUpdate = isset($_POST['perid']) ? $_POST['perid'] : '';

        if (!empty($peridToUpdate)) {
            $personDataToUpdate = array(
                'perid' => $_POST['perid'],
                'eduid' => $_POST['eduid'],
                'edusemester' => $_POST['edusemester'],
                'edugrade' => $_POST['edugrade'],
                'edulev' => $_POST['edulev'],
                'edudetail' => $_POST['edudetail'],
                'heduid' => $_POST['heduid'],


                // ... other fields to update
            );
        }

        $personDataToUpdate = array_filter($personDataToUpdate, function ($value) {
            return $value !== null;
        });
        // foreach ($personDataToUpdate as $key => $value) {
        //     if ($value === '') {
        //         $personDataToUpdate[$key] = null;
        //     }
        // }
        //make  get perid to make condition in update
        $personid = $_POST['heduid'];
        $updatePersonCondition = "heduid = $personid";


        $updatedPerson = updateData('hedu', $personDataToUpdate, $updatePersonCondition, $conn, $personid);

        if ($updatedPerson) {
            $response['success'] = true;
            $response['message'] = 'Data updated successfully.';
        } else {
            $response['success'] = false;
            $response['message'] = 'Error updating person data.';
        }
    } else {
        $response['success'] = false;
        $response['message'] = 'Invalid action.';
    }
} else {
    $response['success'] = false;
    $response['message'] = 'Invalid request method.';
}

echo json_encode($response);
