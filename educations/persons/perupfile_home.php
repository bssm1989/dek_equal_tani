<?php
	@session_start();
	require '../service/connect.php';
	require '../service/commonFns.php';

	$perid = $_POST["perid"];
	$fileupload = $_FILES['fileupload']['tmp_name'];	
	$fileupload2 = $_FILES['fileupload2']['tmp_name'];

	if($perid=="" ) {
		echo "<script>alert('ไม่สามารถเพิ่มรูปได้ กรุณาบันทึกข้อมูลกลุ่มเปราะบางก่อน!!!');</script>"; 
		echo "<script>window.history.back();</script>";exit();
	}
	//if($perid<>"" )
	if ($fileupload) {//3	
		
		$fileupload_name=$_FILES['fileupload']['name'];
		$fileupload_size=$_FILES['fileupload']['size'];
		$fileupload_type=$_FILES['fileupload']['type'];

		$sql1 = "update person_qtn_additional set picname1='' where perid=$perid";
		$result = mysqli_query($conn,$sql1);
		
		$array_last=explode(".",$fileupload_name);
		$c=count($array_last)-1; 
		$lastname=strtolower($array_last[$c]) ;
		if (($lastname=="jpeg") or ($lastname=="jpg") or ($lastname=="png")) {//4
			$time = time();
			$perdocnme = $perid."_1_".$time.".".$lastname;
			move_uploaded_file($fileupload,"../php/images/".$perdocnme);
			$sql = "update person_qtn_additional set ";
			$sql.= "picname1='$perdocnme'";
			$sql.= " where perid=$perid";
			$result=mysqli_query($conn,$sql);
		} //4
		unlink($fileupload);
	} //3

	if ($fileupload2) {//3		

		$fileupload_name=$_FILES['fileupload2']['name'];
		$fileupload_size=$_FILES['fileupload2']['size'];
		$fileupload_type=$_FILES['fileupload2']['type'];

		$sql1 = "update person_qtn_additional set picname2='' where perid=$perid";
		$result = mysqli_query($conn,$sql1);
		
		$array_last=explode(".",$fileupload_name);
		$c=count($array_last)-1; 
		$lastname=strtolower($array_last[$c]) ;
		if (($lastname=="jpeg") or ($lastname=="jpg") or ($lastname=="png")) {//4
			$time = time();
			$perdocnme = $perid."_2_".$time.".".$lastname;
			move_uploaded_file($fileupload2,"../php/images/".$perdocnme);
			$sql = "update person_qtn_additional set ";
			$sql.= "picname2='$perdocnme'";
			$sql.= " where perid=$perid";
			$result=mysqli_query($conn,$sql);
		} //4
		unlink($fileupload2);
	} //3
?>
<!DOCTYPE html>
<head>
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