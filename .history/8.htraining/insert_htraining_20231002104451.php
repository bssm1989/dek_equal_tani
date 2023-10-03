
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

                //   echo $sql;

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

                // echo $sql;

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
            $childDataToUpdate = array(
                    'chiord' => $_POST['child_order'],
                    'livewid' => $_POST['livew_id'],
                    'famsttid' => $_POST['family_status'],
                    'distschkm' => $_POST['distance_to_school_km'],
                    'distschm' => $_POST['distance_to_school_m'],
                    // if distschhrs' ==0 is null
                    'distschhrs' => $_POST['travel_time_to_school_hour'],

                    'distschmin' => $_POST['travel_time_to_school_minute'],
                    'farepay' => $_POST['fare_per_month'],
                    'schmethid' => $_POST['main_transportation_id'],
                    'chidetail' => $_POST['child_details'],
    
    
                    // ... add more fields as needed
             

            );
            // var_dump($childDataToUpdate);

            // Convert fields with empty values to null for child data
            foreach ($childDataToUpdate as $key => $value) {
                if ($value === '') {
                    $childDataToUpdate[$key] = null;
                }
            }

            $updateChildCondition ="perid = $personid"; // Use the appropriate condition for updating child data

           

            $updatedChild = updateData('child', $childDataToUpdate, $updateChildCondition, $conn,$personid);

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
