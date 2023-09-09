<?php
    @session_start();
	require '../service/connect.php';
    require '../service/commonFns.php';

    $ofcid = $_GET["ofcid"];
	$filename = $_GET["filename"];
	if($filename){
		//@unlink ("docs/".$filename);
		//@unlink ("../php/images/".$filename);
		@unlink(".".$filename);
		//$sql = "delete from student where stu_id=$stu_id";
        $sql = "update ofc set profile_photo='' where ofcid=$ofcid";
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