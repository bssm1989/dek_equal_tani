<?php
//require_once("common/con_occ_oxfam.php");

	/*
	function getPioName($i){ //ขนาดธุรกิจ
		$arrPioName = array(1=>"เจ้าหน้าที่เยียวยา" ,2=> "หัวหน้างาน/ผู้บริหาร",3=> "ผู้ดูแลระบบ");
		return $arrPioName[$i];
	}

	function getOrgTypNme($i){ //ขนาดธุรกิจ
		$arrOrgTypNme = array(1=>"รัฐ" ,2=> "เอกชน",3=> "หน่วยงานอิสระ");
		return $arrOrgTypNme[$i];
	}

	function getBizSizeName($i){ //ขนาดธุรกิจ
		$arrBizSizeName = array(1=>"เล็ก" ,2=> "กลาง",3=> "ใหญ่");
		return $arrBizSizeName[$i];
	}


	function getPlcnmegen($id){//ตำบล อำเภอ จังหวัด

		$query_rs_plc = "SELECT plcnmegen FROM const_plcnmegen WHERE plcidgen='$id'";
		$rs_plc = mysqli_query($con,$query_rs_plc) or die(mysql_error());
		$row_rs_plc = mysqli_fetch_assoc($rs_plc);
		$totalRows_rs_plc = mysqli_num_rows($rs_plc);
		if($totalRows_rs_plc>0){
			return $row_rs_plc['plcnmegen'];
		}else{
			return "-";
		}
	}

	function getLosbodyName($id){//ลักษณะการบาดเจ็บทางร่างกาย

		$query_str = "SELECT losbodynme FROM const_losbody WHERE losbody='$id'";
		$rs = mysqli_query($query_str) or die(mysql_error());
		$row = mysql_fetch_assoc($rs);
		$totalRows = mysql_num_rows($rs);
		if($totalRows>0){
			return $row['losbodynme'];
		}else{
			return "-";
		}
	}

	function getComboboxOptions($table,$field_value,$field_txt,$selected_value){
	$STRSQL="SELECT ".$field_value.",".$field_txt." FROM ".$table." order by ".$field_txt;
    //echo $STRSQL;
	$rstGetOptions=mysql_query($STRSQL);
	$txtresult = "";
	if($selected_value == ""){
	  echo "<option value=\"\" selected></option>";
	}else{
	  echo "<option value=\"\"></option>";
	}
	while($rowGetOptions=mysql_fetch_array($rstGetOptions)){
	    if($rowGetOptions[0]==$selected_value)
		    $txtresult = $txtresult."<option value='".$rowGetOptions[0]."' selected>".$rowGetOptions[1]."</option>\n";
		else
			$txtresult = $txtresult."<option value='".$rowGetOptions[0]."'>".$rowGetOptions[1]."</option>\n";
	}
	return $txtresult;
	}*/

function getPK($pre,$fpk,$len,$tb){ //get primary key
    $nlen = $len-2;
	$STRSQL="SELECT substr(max(".$fpk."),3,$len) as mpk FROM ".$tb;
	//echo $STRSQL;
	$rstPK=mysql_query($STRSQL);
	if(!rstPK){
		$newid = 1;
	}else{
		$rowPK=mysql_fetch_array($rstPK);
		//echo "firest:".$rowPK["mpk"]."<br>";
		$newid=(int)$rowPK["mpk"]+1;
	}
	//echo $newid;
	//$len_now = length($newid);
	while(strlen($newid)<>$nlen){ // max lenght of primary key
	      $newid="0".$newid;
	}
	return $pre.$newid;
}

///  follow this not sure use or not ---------------------------------------------------------------------------------

	function getDateTimeNow($fotmat){ // fix start with year yyyy define only after yyyy such as getDateTtimeNow("-m-d")
	  	$tempY=date("Y");
		if($tempY<"2550"){
			$tempY=(int)$tempY+543;
		}
		$datetime_now= $tempY.date($fotmat);

		return $datetime_now;
	}

  //fotmat date ddmmyyyy to yyymmdd
	function getfotmatDateYMD($brtdte){
		return substr($brtdte,6,4).substr($brtdte,3,2).substr($brtdte,0,2);
	}
  //fotmal data datetime
  function getDateTimeYMD($qtn_tme){
		return substr($qtn_tme,0,2).substr($qtn_tme,3,2);
	}


  //function getDateTimeYMD($d){
	//	return substr($d,0,4)."-".substr($d,4,2)."-".substr($d,6,2);
	//}

	// function getDateTimeDMY($d){
	// 	return substr($d,2,2)."-".substr($d,4,2)."-".substr($d,0,4);
	// }

	function getDateTimeDMY($d){
		return substr($d,8,2)."-".substr($d,5,2)."-".substr($d,0,4);
	}

  function getDateTime($qtn_tme){
		return substr($qtn_tme,0,2).":".substr($qtn_tme,2,2);
	}

//-----------------------------------------------------------------
/*
function mydate_format($dt){
	date_default_timezone_set('Asia/Bangkok');
	//input 25551201
	///ouput date 01-12-2555
    $dd = substr($dt,6,2);
	$mm = substr($dt,4,2);
	$yy = substr($dt,0,4);
	return ($dd."-".$mm."-".$yy);
}*/

function mydate_format(){
	date_default_timezone_set('Asia/Bangkok');
	//input 25551201
	///ouput date 01-12-2555
	$dt = date("Y-m-d");
	$yy = substr($dt,0,4)+543;
	$mm = substr($dt,5,2);
    $dd = substr($dt,8,2);
	return $dt = $yy."-".$mm."-".$dd;
}

function mytime_format($tme){


	//input hhmm
	///ouput hh:mm น.
	$mm = substr($tme,2,2);
	$hh = substr($tme,0,2);
	return ($hh.":".$mm." น.");
}


function date_stored_format($dt){

    //input date $dt 01-12-2555
	//output is 25551201
    $dd = substr($dt,0,2);
	$mm = substr($dt,3,2);
	$yyyy = substr($dt,6,4);
	return ($yyyy.$mm.$dd);
}

function getDays($dt){

    //input date $dt 01-12-2555
	//25551201
    $dd = substr($dt,0,2);
	$mm = substr($dt,3,2);
	$yyyy = substr($dt,6,4);
	$days = $yyy*365 + $mm*30 + $dd;
	return ($days);
}

/** คำนวณอายุ อัตโนมัติ จากอายุวันเดือนปีเกิด */
function getAge($dateinput) {
	$d = $dateinput;
	// $dateOfBirth = '1987-11-12'; //วันเกิด รูปแบบ ปี เดือน วัน
	$dateOfBirth = (substr($d,0,4)-543).substr($d,5,2).substr($d,8,2);

	$currentDate  = date('Y-m-d'); //วันที่ปัจจุบัน

	$diff = abs(strtotime($currentDate) - strtotime($dateOfBirth));

	$years = floor($diff / (365*60*60*24));
	$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
	$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

	// echo '<h4> สรุป นายโปรแกรมเมอร์ มีอายุ : ';
	// printf("%d ปี, %d เดือน, %d วัน\n", $years, $months, $days);

    return $years.".".$months;

}



?>