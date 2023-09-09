<?php
@session_start();
//require_once("../checkpermission.php"); //เอาไว้บรรทัดแรกของ page เสมอ
require '../service/connect.php';
date_default_timezone_set('Asia/Bangkok');
// require 'lib/commonFns.php';
// $ofcid = $_SESSION['member_id'];
// $ofcnme = $_SESSION['member_id'];

$act	= $_POST["act"];
//echo "xxxxxxxxx".$act;
if ($act=="save"){ //1 check for save or delete
    $ofcnme         = mysqli_real_escape_string($conn, trim($_POST['ofcnme']));
    $email          = mysqli_real_escape_string($conn, trim($_POST['email']));
    $optid    	    = $_POST["optid"];
    $username       = mysqli_real_escape_string($conn,  trim($_POST['username']));
    $password       = mysqli_real_escape_string($conn,  trim($_POST['password']));
    $permission    	= $_POST["permission"];
    $ofc_status    	= "1";

    if(!empty($ofcnme) && !empty($email) && !empty($username) && !empty($password)){
        $ofcid1    	    = $_POST["ofcid"];
        if ($ofcid1==""){
            $sql 		= "select max(ofcid) as id from ofc";
            $result 	= mysqli_query($conn,$sql);
            $row 		= mysqli_fetch_array($result);
            $ofcid      = $row["id"]+1;
        } else $ofcid=$ofcid1;

        $sql = mysqli_query($conn, "SELECT * FROM ofc WHERE usrnme = '{$username}'");
        if(mysqli_num_rows($sql) > 0){            
            $returnValue = array("checkSave"=>"usrnme");
            $output = json_encode($returnValue);
            echo $output;
            exit();
        }

        $sql = mysqli_query($conn, "SELECT * FROM ofc WHERE email = '{$email}'");
        if(mysqli_num_rows($sql) > 0){            
            $returnValue = array("checkSave"=>"email");
            $output = json_encode($returnValue);
            echo $output;
            exit();
        }

        $passwordHashed = password_hash($password, PASSWORD_DEFAULT);
        // $crated_at		= DateTime();
        // $updated_at		= DateTime();

        if($ofcid1=="") {
            $sql = "INSERT INTO `ofc` (`ofcid`,`ofcnme`, `email`, `optid`,`usrnme`, `pwd`,`pio`,`status`, `crated_at`, `updated_at`) 
                VALUES ('".$ofcid."', 
                        '".$ofcnme."', 
                        '".$email."', 
                        '".$optid."', 
                        '".$username."', 
                        '".$passwordHashed."',
                        '".$permission."', 
                        '".$ofc_status."', 
                        '".date("Y-m-d H:i:s")."', 
                        '".date("Y-m-d H:i:s")."')";
                $result = mysqli_query($conn,$sql);
                // echo "xxxxsql_insertxxxxx ".$sql;
        }
    }else{
        // echo "repeatttttttttttttttttttttt";
        $returnValue = array("checkSave"=>"no");
        $output = json_encode($returnValue);
        echo $output;
        exit();
    }
    
}else if($act=="update"){
        // $ofcid = $_POST["ofcid"];
        // $ofcnme    	    = trim($_POST["ofcnme"]);
        // $email    	    = trim($_POST["email"]);
        // $agency    	    = $_POST["agency"];
        // $permission    	= $_POST["permission"];
        // $ofc_status    	= $_POST["ofc_status"];

        $ofcid          = mysqli_real_escape_string($conn, trim($_POST['ofcid']));
        $ofcnme         = mysqli_real_escape_string($conn, trim($_POST['ofcnme']));
        $email          = mysqli_real_escape_string($conn, trim($_POST['email']));
        $optid    	    = $_POST["optid"];
        $permission    	= $_POST["permission"];
        $ofc_status    	= $_POST["ofc_status"];

        $sql = "update ofc set ";
        $sql.= "ofcnme='$ofcnme',email='$email',optid='$optid',pio='$permission',`status`='$ofc_status',"; //,password='$passwordHashed'
        $sql.= "updated_at='".date("Y-m-d H:i:s")."'";
        $sql.= " where ofcid=$ofcid";
        $result = mysqli_query($conn,$sql);

}else if($act=="changeuser"){
    $ofcid = $_POST["ofcid"];
    $username    	= trim($_POST["username"]);
    
    $sql = "update ofc set ";
    $sql.= "usrnme='$username',";
    $sql.= "updated_at='".date("Y-m-d H:i:s")."'";
    $sql.= " where ofcid=$ofcid";
    $result = mysqli_query($conn,$sql);

}else if($act=="changepwd"){
    $ofcid = $_POST["ofcid"];
    $password    	= trim($_POST["password"]);
    $passwordHashed = password_hash($password, PASSWORD_DEFAULT);
    
    $sql = "update ofc set ";
    $sql.= "pwd='$passwordHashed',"; //,password='$passwordHashed'
    $sql.= "updated_at='".date("Y-m-d H:i:s")."'";
    $sql.= " where ofcid=$ofcid";
    $result = mysqli_query($conn,$sql);
}else if($act=="delete"){
    $ofcid = $_POST["ofcid"];
    $sql = "delete from ofc where ofcid=".$ofcid;
    $result = mysqli_query($conn,$sql);
}

if($result){
   $returnValue = array("checkSave"=>"yes","ofcid0"=>$ofcid);
    $output = json_encode($returnValue);
    echo $output;
}

mysqli_close($conn);
?>