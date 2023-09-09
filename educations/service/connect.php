<?php
session_start();
//error_reporting(E_ALL); //ถ้าขึ้น server error_reporting(0);
error_reporting (E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Bangkok');

// $conn = @mysqli_connect("localhost", "dsrd", "L;=9,vxo", "dek_equal_tani") or die(mysqli_connect_error());
$conn = @mysqli_connect("localhost", "root", "root", "dek_equal_tani") or die(mysqli_connect_error());
mysqli_query($conn,"SET NAMES UTF8"); //in order to make Thai fonts visible

mysqli_query($conn,"SET character_set_results='utf-8'");
mysqli_query($conn,"SET character_set_client='utf-8'");
mysqli_query($conn,"SET character_set_connection='utf-8'");

date_default_timezone_set('Asia/Bangkok');

  /** แปลงวันที่ให้เป็นภาษาไทย */
  function dateThai($strDate){
    $strYear= date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));
    $strHour= date("H",strtotime($strDate));
    $strMinute= date("i",strtotime($strDate));
    $strSeconds= date("s",strtotime($strDate));
    $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear $strHour:$strMinute น.";
}
?>