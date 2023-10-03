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
                $sql = "INSERT INTO $table ($columns) VALUES ($values)";

                //  echo $sql;

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
                var_dump($data);
                foreach ($data as $key => $value) {
                    $updateString .= "$key = '$value', ";
                }
                $updateString = rtrim($updateString, ', ');

                $sql = "UPDATE $table SET $updateString WHERE $condition";

                echo $sql;

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
            'perid'=> $_POST['perid'],
            'eduid'=> $_POST['eduid'],
            'edusemester'=> $_POST['edusemester'],
            'edugrade'=> $_POST['edugrade'],
            // 'heduid'=> $_POST['heduid'],
            'edulev'=> $_POST['edulev'],
            'edudetail'=> $_POST['edudetail']

          
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
        $personid = $_POST['perid'];
        $updatePersonCondition = "perid =$personid"; // Use the appropriate condition for updating person data  
               
        
        $updatedPerson = updateData('person', $personDataToUpdate, $updatePersonCondition, $conn,$personid);

        if ($updatedPerson) {
            // Update child data
            /*
            action:"update"
edudetail:"ดกดกดกดกดกดกดก"
edugrade:"3.00"
eduid:"5"
edulev:"1"
edusemester:"2560"
heduid:"62"
perid:"4"
submit:"แก้ไข"
*/
    // hedu	ประวัติการศึกษา				
    // ชื่อฟิลด์	ประเภทข้อมูล	ความยาว	ความหมาย	PK/FK	คำอธิบายเพิ่มเติม
    // heduid	bigint		รหัสประวัติการศึกษา	PK	
    // perid	bigint		รหัสบุคคล --> รหัสเด็ก	FK	
    // eduid	int	2	ระดับการศึกษา	FK	มีตารางย่อย
    // edulev	int	1	ชั้นปี		
    // edusemester	int	6	ปีการศึกษา		เก็บ 6 หลัก เช่น 256601
    // edugrade	number	4	เกรดเฉลี่ย		เช่น 3.50
    // edudetail	varchar	200	รายละเอียดอื่น ๆ	
            $childDataToUpdate = array(
                'perid' => $_POST['perid'],
                'eduid' => $_POST['eduid'],
                'edusemester' => $_POST['edusemester'],
                'edugrade' => $_POST['edugrade'],
                'edulev' => $_POST['edulev'],
                'edudetail' => $_POST['edudetail'],
                'heduid' => $_POST['heduid'],
    
                    // ... add more fields as needed
             

            );
            var_dump($childDataToUpdate);

            // Convert fields with empty values to null for child data
            foreach ($childDataToUpdate as $key => $value) {
                if ($value === '') {
                    $childDataToUpdate[$key] = null;
                }
            }

            $updateChildCondition ="heduid = $heduid"; // Use the appropriate condition for updating child data

           

            // $updatedChild = updateData('child', $childDataToUpdate, $updateChildCondition, $conn,$personid);
            $updatedChild = updateData('hedu', $childDataToUpdate, $updateChildCondition, $conn,$personid);

            if ($updatedChild) {
                $response['success'] = true;
                $response['message'] = 'Data updated successfully.';
            } else {
                $response['success'] = false;
                $response['message'] = 'Error updating child data.';
            }
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
