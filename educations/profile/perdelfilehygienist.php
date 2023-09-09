<?php
    @session_start();
	require '../service/connect.php';
    require '../service/commonFns.php';

    $ofc_no = $_GET["ofc_no"];
	$filename = $_GET["filename"];
	if($filename){
		//@unlink ("docs/".$filename);
		//@unlink ("../php/images/".$filename);
		@unlink(".".$filename);
		//$sql = "delete from student where stu_id=$stu_id";
        $sql = "update ofc_hygienist set ofc_photo='' where ofc_no=$ofc_no";
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