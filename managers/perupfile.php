<?php
	@session_start();
	require '../service/connect.php';
	require '../service/commonFns.php';

	$ofc_id = $_POST["ofcid"];
	$fileupload = $_FILES['fileupload']['tmp_name'];
	$fileupload_name=$_FILES['fileupload']['name'];
	$fileupload_size=$_FILES['fileupload']['size'];
	$fileupload_type=$_FILES['fileupload']['type'];

	if($ofc_id=="" ) {
		echo "<script>alert('กรุณาแนบรูปภาพก่อนครับ');</script>"; 
		echo "<script>window.history.back();</script>";exit();
	}




	//if($perid<>"" )
	if ($fileupload) {//3	
		$sql1 = "update ofc set profile_photo='' where ofcid=$ofc_id";
		$result = mysqli_query($conn,$sql1);
		
		$array_last=explode(".",$fileupload_name);
		$c=count($array_last)-1; 
		$lastname=strtolower($array_last[$c]) ;
		if (($lastname=="jpeg") or ($lastname=="jpg") or ($lastname=="png")) {//4
			$time = time();
			$perdocnme = $ofc_id."_".$time.".".$lastname;
			move_uploaded_file($fileupload,"../php/images/".$perdocnme);
			$sql = "update ofc set ";
			$sql.= "profile_photo='$perdocnme'";
			$sql.= " where ofcid=$ofc_id";
			//echo $sql;
			$result=mysqli_query($conn,$sql);
		} //4			
		@unlink($fileupload);	
	} //3
?>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<head>
</head>
<body>
<script language="javascript">
alert("แนบรูปภาพเรียบร้อยแล้ว");
window.history.back();
</script>
</body>
</html>