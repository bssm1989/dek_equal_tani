<?php

    session_start();
    // session_unset();
    // session_destroy();
    if(isset($_SESSION['staffid'])){
        // include_once "config.php";
        require "../service/connect";
        $logout_id = mysqli_real_escape_string($conn, $_GET['logout_id']);
        if(isset($logout_id)){
            // $status = "0";
            $sql = mysqli_query($conn, "UPDATE staff SET `status` = '{$status}', updated_at = '".date("Y-m-d H:i:s")."' WHERE staffid={$_GET['logout_id']}");
            if($sql){
                session_unset();
                session_destroy();
                header("location: ../login.php");
            }
        }else{
            header("location: ../index.php");
        }
    }else{  
        header("location: ../login.php");
    }
?>