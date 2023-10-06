
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
                $sql = "INSERT INTO $table ($columns) VALUES ($values)";

                  echo "SQL Query: $sql<br>";

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
        /*
        action:"insert"
plcid:"100101"
savdte:""
savofc:""
staffemail:"sfgsdds@gmsil.vom"
staffid:""
staffnme:"refdfdfd"
stafforg:"sdgfdsfgdfg"
staffposid:"1"
staffprioid:"0"
staffsnme:"fdfdfrwgft"
stafftell:"53563563"
title_id:"2"
upddte:""
updofc:""
*/
/*staff	ข้อมูลผู้ใช้งานโปรแกรม				
ชื่อฟิลด์	ประเภทข้อมูล	ความยาว	ความหมาย	PK/FK	คำอธิบายเพิ่มเติม
staffid	int	4	รหัสผู้ใช้งาน	PK	
pid	varchar	13	เลขบัตรประชาชน	FK	มีตารางย่อย
titid	int	2	รหัสคำนำหน้าชื่อ		
staffnme	varchar	30	ชื่อ		
staffsnme	varchar	30	สกุล		
stafftell	varchar	10	เบอร์โทรศัพท์		
staffemail	varchar	50	อีเมล์		
stafforg	varchar	50	หน่วยงานที่สังกัด		
plcid	varchar	6	จังหวัดอำเภอตำบล หน่วยงานที่สังกัด	FK	มีตารางย่อย 940101 เก็บ 6 หลัก
staffposid	int	2	รหัสตำแหน่ง/ภาระหน้าที่สำหรับระบบนี้ เช่น ผู้ดูแลระบบ หัวหน้าโครงการ เจ้าหน้าที่ภาคสนาม เป็นต้น	FK	มีตารางย่อย
staffprioid	int	2	รหัสสิทธิการเข้าถึงข้อมูล	FK	มีตารางย่อย
*/
        // Insert person data
        $Data = array(
     
            'pid' => $_POST['pid'],
            'titid' => $_POST['title_id'],
            'staffnme' => $_POST['staffnme'],//name
            'staffsnme' => $_POST['staffsnme'],//surname
            'stafftell' => $_POST['stafftell'],
            'staffemail' => $_POST['staffemail'],
            'stafforg' => $_POST['stafforg'],
            'plcid' => $_POST['plcid'],
            'staffposid' => $_POST['staffposid'],
            'staffprioid' => $_POST['staffprioid'],

            // ... other fields to insert


          
        );
       
        // Remove null values from personData array
        $Data = array_filter($Data, function ($value) {
            return $value !== null;
        });
   
        $personInsert = insertData('staff', $Data, $conn);
        if ($personInsert) {
            $response['success'] = true;
            $response['message'] = 'Data inserted successfully.';
        } else {
            $response['success'] = false;
            $response['message'] = 'Error inserting  data.';
        }
       
        // Rest of your code...

    } elseif ($action === 'update') {

        $peridToUpdate = isset($_POST['staffid']) ? $_POST['staffid'] : '';

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
            var_dump($personDataToUpdate);
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
        $personid = $_POST['staffid'];
        $updatePersonCondition = "staffid =$personid"; // Use the appropriate condition for updating person data  
               
        var_dump($personDataToUpdate);
        $updatedPerson = updateData('person', $personDataToUpdate, $updatePersonCondition, $conn,$personid);

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
