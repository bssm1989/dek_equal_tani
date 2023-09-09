<?php
    session_start();
    include_once "../service/connect.php";
    
    $optid = mysqli_real_escape_string($conn, $_POST['optid']);
    $fname = mysqli_real_escape_string($conn, trim($_POST['fname']));
    $lname = mysqli_real_escape_string($conn, trim($_POST['lname']));
    $ofcnme = $fname." ".$lname;
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $usrnme = mysqli_real_escape_string($conn, trim($_POST['usrnme']));
    $password = mysqli_real_escape_string($conn, trim($_POST['password']));
    if(!empty($fname) && !empty($lname) && !empty($email) && !empty($usrnme) && !empty($password)){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $sql = mysqli_query($conn, "SELECT * FROM ofc WHERE usrnme = '{$usrnme}'");
            if(mysqli_num_rows($sql) > 0){
                // echo "$email - This email already exist!";
                echo "$email - ผู้ใช้คนนี้มีอยู่แล้ว!!!";
            }else{
                if(isset($_FILES['image'])){
                    $img_name = $_FILES['image']['name'];
                    $img_type = $_FILES['image']['type'];
                    $tmp_name = $_FILES['image']['tmp_name'];
                    
                    $img_explode = explode('.',$img_name);
                    $img_ext = end($img_explode);
    
                    $extensions = ["jpeg", "png", "jpg"];
                    if(in_array($img_ext, $extensions) === true){
                        $types = ["image/jpeg", "image/jpg", "image/png"];
                        if(in_array($img_type, $types) === true){
                            $time = time();
                            $new_img_name = $time.$img_name;
                            if(move_uploaded_file($tmp_name,"images/".$new_img_name)){
                                // $ran_id = rand(time(), 100000000);
                                $ran_id1 = "";
                                if ($ran_id1==""){
                                    $sql 		= "select max(ofcid) as id from ofc";
                                    $result 	= mysqli_query($conn,$sql);
                                    $row 		= mysqli_fetch_array($result);
                                    $ran_id     = $row["id"]+1;
                                } else $ran_id=$ran_id1;

                                // $status = "1"; //สถานะ 1.เปิดออน
                                // $pio = "3"; //สิทธิ์ การใช้งานระบบ ระดับ 3 ผู้ใช้ทั่วไป
                                // $encrypt_pass = md5($password);
                                $encrypt_pass = password_hash($password, PASSWORD_DEFAULT);                                  
                                $insert_query = mysqli_query($conn, "INSERT INTO ofc (`ofcid`,`ofcnme`,`email`,`optid`,`usrnme`,`pwd`,`pio`,`status`,`profile_photo`,`crated_at`,`updated_at`)
                                VALUES ({$ran_id}, '{$ofcnme}', '{$email}', '{$optid}', '{$usrnme}', '{$encrypt_pass}', '3', '0', '{$new_img_name}', '".date("Y-m-d H:i:s")."', '".date("Y-m-d H:i:s")."')");
                                if($insert_query){
                                    $select_sql2 = mysqli_query($conn, "SELECT * FROM ofc WHERE usrnme = '{$usrnme}'");
                                    if(mysqli_num_rows($select_sql2) > 0){
                                        $result = mysqli_fetch_assoc($select_sql2);
                                        //$_SESSION['ofc_id'] = $result['ofcid'];
                                        echo "success";
                                    }else{
                                        // echo "This email address not Exist!";
                                        echo "ผู้ใช้คนนี้ไม่มี!";
                                    }
                                }else{
                                    // echo "Something went wrong. Please try again!";
                                    echo "บางอย่างผิดพลาด. กรุณาลองอีกครั้ง!";
                                    //echo "xxxx = ".$sql;
                                }
                            }
                        }else{
                            // echo "Please upload an image file - jpeg, png, jpg";
                            echo "กรุณาอัพโหลดไฟล์ภาพ - jpeg, png, jpg";
                        }
                    }else{
                        // echo "Please upload an image file - jpeg, png, jpg"; 
                        echo "กรุณาอัพโหลดไฟล์ภาพ - .jpeg, .png, .jpg"; 
                    }
                }
            }
        }else{
            // echo "$email is not a valid email!";
            echo "$email ไม่ใช่อีเมลที่ถูกต้อง!";
        }
    }else{
        // echo "All input fields are required!";
        echo "จะต้องกรอกข้อมูลทั้งหมดทุกฟิลด์";
    }
?>