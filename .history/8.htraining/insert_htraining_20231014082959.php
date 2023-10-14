
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
// $requiredFields = array(
//     'national_id',
//     'title_id',
//     'name',
//     'surname',
//     'gender_id',
//     'religion_id',
//     'religion_other',
//     // 'birth_date',
//     'age',
//     'address',
//     'street',
//     // 'village_id',
//     'place_id',
//     'postcode',
//     'phone_number',
//     'dispform',
// );
	
// submit		
// $missingFields = array();
// foreach ($requiredFields as $field) {
//     if (!isset($_POST[$field])) {
//         $missingFields[] = $field;
//     }
// }

// if (!empty($missingFields)) {
//     $response['success'] = false;
//     $response['message'] = 'Required fields are not set: ' . implode(', ', $missingFields);
//     echo json_encode($response);
//     exit(); // Stop further processing
// }
	
                        
   
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

                //   echo "SQL Query: $sql<br>";

                $user_id = $_SESSION['staffid'];
        mysqli_query($conn,"SET @user_id =$user_id,@query_value ='$sql'");
        $result = mysqli_query($conn, $sql);

                if ($result) {
                    // echo "Inserted ID: " . mysqli_insert_id($conn) . "<br>";
                    return true;// Return the inserted ID
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
        function updateData($table, $data, $condition, $conn,$id)
        {
            // ... Your code before
            try {
                $updateString = '';
                foreach ($data as $key => $value) {
                    $updateString .= "$key = '$value', ";
                }
                $updateString = rtrim($updateString, ', ');

                $sql = "UPDATE $table SET $updateString WHERE $condition";

                // echo "SQL Query: $sql<br>";

                $user_id = $_SESSION['staffid'];
        mysqli_query($conn,"SET @user_id =$user_id,@query_value ='$sql'");
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
        /*
        perid: 1
htrndtestr: 2566-09-15
htrndteend: 2566-09-15
htrntit: หกหกหกหกหกหกห
prvid: หกหกหกหกหกไำไกไกไ
htrndetail: dfdfdfdf
*/
/*htraining	ประวัติการอบรม				
ชื่อฟิลด์	ประเภทข้อมูล	ความยาว	ความหมาย	PK/FK	คำอธิบายเพิ่มเติม
hhtrnid	bigint		รหัสประวัติการอบรม	PK	
perid	bigint		รหัสบุคคล --> รหัสเด็ก	FK	
htrndtestr	varchar	8	วันที่เริ่มอบรม เปิดไว้กรณีอบรมหลายวัน		เก็บ 8 หลัก เช่น 25660426
htrndteend	varchar	8	วันที่อบรมเสร็จ		เก็บ 8 หลัก เช่น 25660426
htrntit	varchar	50	เรื่องที่อบรม		
prvid	varchar	2	จังหวัดที่อบรม	FK	มีตารางย่อย
htrndetail	varchar	1000	รายละเอียดการอบรม		
*/
        // Insert person data
        $Data = array(
            'perid'=> $_POST['perid'],
            'htrndtestr' => $_POST['htrndtestr'],
            'htrndteend' => $_POST['htrndteend'],
            'htrntit' => $_POST['htrntit'],
            'prvid' => $_POST['prvid'],
            'htrndetail' => $_POST['htrndetail'],
            
            // ... other fields to insert


          
        );
       
        // Remove null values from personData array
        $Data = array_filter($Data, function ($value) {
            return $value !== null;
        });
   
        $personInsert = insertData('htraining', $Data, $conn);
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
                'perid'=> $_POST['perid'],
            'htrndtestr' => $_POST['htrndtestr'],
            'htrndteend' => $_POST['htrndteend'],
            'htrntit' => $_POST['htrntit'],
            'prvid' => $_POST['prvid'],
            'htrndetail' => $_POST['htrndetail'],

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
        $personid = $_POST['hhtrnid'];
        $updatePersonCondition = "hhtrnid = $personid";
        
        $updatedPerson = updateData('htraining', $personDataToUpdate, $updatePersonCondition, $conn,$personid);
        if ($updatedPerson) {
            $response['success'] = true;
            $response['message'] = 'Person data updated successfully.';
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
