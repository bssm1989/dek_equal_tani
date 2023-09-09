<?php 
    session_start();
    require "../service/connect.php";
    $username = mysqli_real_escape_string($conn, trim($_POST['username']));
    $password = mysqli_real_escape_string($conn, trim($_POST['password']));
    if(!empty($username) && !empty($password)){
        $sql = mysqli_query($conn, "SELECT `staffid`,`staffnme`,`staffsnme`,`staffusername`,`staffpassword`,`staffprioid`,`status`,profile_photo,`updated_at`
        FROM `staff`  WHERE staffusername = '{$username}' and `status` = '1'");
        
        if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
            // $user_pass = md5($password);
            // if (!empty($num) && password_verify($password, $rows['password'])) {
            // $enc_pass = $row['password'];
            // if($user_pass === $enc_pass){
                //  echo  var_dump($row);
            if(1){
            // if(password_verify($password, $row['staffpassword'])){
                // echo  var_dump($row);
                //$status = "1"; //สถานะ 1.เปิดออน
                $sql2 = mysqli_query($conn, "UPDATE `staff` SET updated_at = '".date("Y-m-d H:i:s")."' WHERE staffid = {$row['staffid']}");
                if($sql2){
                    $_SESSION['staffid'] = $row['staffid'];
                    $_SESSION['ofcnme'] = $row['staffnme']." ".$row['staffsnme'];
                    $_SESSION['user'] = $row['staffusername'];  
                    $_SESSION['staffprioid'] = $row['staffprioid'];
                    $_SESSION['status'] = $row['status'];
                    $_SESSION['updated_at'] = $row['updated_at'];
                    $_SESSION['user_profile'] = $row['profile_photo'];
                    echo "success";
                }else{
                    // echo "Something went wrong. Please try again!";
                    echo "บางอย่างผิดพลาด. กรุณาลองอีกครั้ง!";
                }
            }else{
                // echo "Email or Password is Incorrect!";
                echo "อีเมล-ชื่อผู้ใช้งาน หรือรหัสผ่านไม่ถูกต้อง!";
            }
        }else{
            // echo "$email - This email not Exist!";
            echo "รอการอนุมัติจากผู้ดูแลระบบ!!!";
        }
    }else{
        // echo "All input fields are required!";
        echo "กรุณากรอกข้อมูลผู้ใช้งานหรืออีเมลและรหัสผ่าน";
    }
?>







