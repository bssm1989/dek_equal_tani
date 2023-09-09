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
if($act=="update"){
        $ofcid = $_POST["ofcid"];
        // $ofcnme    	    = trim($_POST["ofcnme"]);
        // $email    	    = trim($_POST["email"]);
        $ofcnme         = mysqli_real_escape_string($conn, trim($_POST['ofcnme']));
        $email          = mysqli_real_escape_string($conn, trim($_POST['email']));
        $optid    	    = $_POST["optid"];

        if(!empty($ofcnme) && !empty($email) ){
            $sql = "update ofc set ";
            $sql.= "ofcnme='$ofcnme',email='$email',optid='$optid',"; //,password='$passwordHashed'
            $sql.= "updated_at='".date("Y-m-d H:i:s")."'";
            $sql.= " where ofcid=$ofcid";
            $result = mysqli_query($conn,$sql);
        }else{
            $returnValue = array("checkSave"=>"no");
            $output = json_encode($returnValue);
            echo $output;
            exit();
        }

        

}else if($act=="changeuser"){
    $ofcid = $_POST["ofcid"];
    $username       = mysqli_real_escape_string($conn, trim($_POST['username']));
    if(!empty($username)){
        $sql = mysqli_query($conn, "SELECT * FROM ofc WHERE usrnme = '{$username}' and ofcid = '{$ofcid}' ");
        if(mysqli_num_rows($sql) > 0){
            //echo "$email - This email already exist!";
            $returnValue = array("checkSave"=>"no");
            $output = json_encode($returnValue);
            echo $output;
            exit();
        }else{
            $sql = "update ofc set ";
            $sql.= "usrnme='$username',";
            $sql.= "updated_at='".date("Y-m-d H:i:s")."'";
            $sql.= " where ofcid=$ofcid";
            $result = mysqli_query($conn,$sql);
        }
    }   
    
}else if($act=="changepwd"){
    $ofcid = $_POST["ofcid"];
    //$password    	= trim($_POST["password"]);
    $password       = mysqli_real_escape_string($conn, trim($_POST['password']));
    $passwordHashed = password_hash($password, PASSWORD_DEFAULT);
    
    $sql = "update ofc set ";
    $sql.= "pwd = '$passwordHashed',"; //,password='$passwordHashed'
    $sql.= "updated_at='".date("Y-m-d H:i:s")."'";
    $sql.= " where ofcid=$ofcid";
    $result = mysqli_query($conn,$sql);
}

if($result){
   $returnValue = array("checkSave"=>"yes","ofcid0"=>$ofcid);
    $output = json_encode($returnValue);
    echo $output;
}
mysqli_close($conn);
?>