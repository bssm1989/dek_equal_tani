<?php
	@session_start();
	require '../service/connect.php';
	require '../service/commonFns.php';
?>
<?php

		$ofcid = $_POST["ofcid"];
		$fileupload = $_FILES['fileupload']['tmp_name'];
		$fileupload_name=$_FILES['fileupload']['name'];
		$fileupload_size=$_FILES['fileupload']['size'];
		$fileupload_type=$_FILES['fileupload']['type'];
		
		//$img_folder = "ofc_no".$ofc_no;

		// if (!file_exists("../includes/images")) {
    	// 	mkdir("../includes/images", 0777, true);
		// }

?>

<?php
if($ofcid=="" ) {
	echo "<script>alert('กรุณาแนบรูปภาพก่อนครับ');</script>"; 
	echo "<script>window.history.back();</script>";exit();
}




		//if($perid<>"" )
		if ($fileupload) {//3		
			$sql1 = "update ofc set profile_photo='' where ofcid=$ofcid";
			$result = mysqli_query($conn,$sql1);
			
			$array_last=explode(".",$fileupload_name);
			$c=count($array_last)-1; 
			$lastname=strtolower($array_last[$c]) ;
			if (($lastname=="jpeg") or ($lastname=="jpg") or ($lastname=="png")) {//4
				$time = time();
                $perdocnme = $ofc_no."_".$time.".".$lastname;
				move_uploaded_file($fileupload,"../php/images/".$perdocnme);
				$sql = "update ofc set ";
				$sql.= "profile_photo='$perdocnme'";
				$sql.= " where ofcid=$ofcid";
				$result=mysqli_query($conn,$sql);
			} //4
			unlink($fileupload);
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