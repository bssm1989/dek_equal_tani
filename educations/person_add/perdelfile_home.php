<?php
    @session_start();
	require '../service/connect.php';
    require '../service/commonFns.php';

    $perid = $_GET["perid"];
	$filename1 = $_GET["picname1"];
	$filename2 = $_GET["picname2"];

	if($filename1){
		//@unlink ("docs/".$filename);
		//@unlink ("../php/images/".$filename);
		@unlink(".".$filename1);
		//$sql = "delete from student where stu_id=$stu_id";
        $sql = "update person_qtn_additional set picname1='' where perid=$perid";
		$result=mysqli_query($conn,$sql);
		//echo $sql;
	}

	
	if($filename2){
		//@unlink ("docs/".$filename);
		//@unlink ("../php/images/".$filename);
		@unlink(".".$filename2);
		//$sql = "delete from student where stu_id=$stu_id";
        $sql = "update person_qtn_additional set picname2='' where perid=$perid";
		$result=mysqli_query($conn,$sql);
		//echo $sql;
	}
?>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<head>
</head>
<body>
<script language="javascript">
    alert("ลบเรียบร้อยครับ");
    window.history.back();
</script>
</body>
</html>