<?php
@session_start();
//require_once("../checkpermission.php"); //เอาไว้บรรทัดแรกของ page เสมอ
require '../service/connect.php';
require '../service/commonFns.php';
$ofcid = $_SESSION['ofcid'];
$ofcnme = $_SESSION['ofcnme'];

//savdte
date_default_timezone_set('Asia/Bangkok');
$year = date('Y')+543;
$savdte = $year.date('m').date('d');
$upddte  = $year.date('m').date('d');

$act	= $_POST["act"];
if ($act=="save"){ //1 check for save or delete
    $qtn_visid1 = $_POST["qtn_visid"];
	if ($qtn_visid1==""){
			$sql 		= "select max(qtn_visid) as id from questionnaire_visit";
			$result 	= mysqli_query($conn,$sql);
			$row 		= mysqli_fetch_array($result);
			$qtn_visid = $row["id"]+1;
	} else $qtn_visid=$qtn_visid1;
  
	$perid                  = trim($_POST["perid"]);
    $qtn_assessor    	    = trim($_POST["qtn_assessor"]);
    $pos_ofcid              = $_POST["pos_ofcid"];

    $qtn_round1 = $_POST["qtn_round"];
	if ($qtn_round1==""){
        $sql = " select max(qtn_round) as id from questionnaire_visit where perid = $perid ";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        $qtn_round = $row["id"]+1;
	} else $qtn_round=$qtn_round1;

    $qtn_date			    = getfotmatDateYMD($_POST["qtn_date"]);

    $weight    	            = trim($_POST["weight"]);
    $height    	            = trim($_POST["height"]);
    $waistline    	        = trim($_POST["waistline"]);
    $blood_pressure    	    = trim($_POST["blood_pressure"]);

    $help1			        = $_POST["help1"];
    $help2			        = $_POST["help2"];
    $help3			        = $_POST["help3"];
    $help4			        = $_POST["help4"];
    $help5			        = $_POST["help5"];
    $help6			        = $_POST["help6"];
    $help7			        = $_POST["help7"];
    $helpoth		        = trim($_POST["helpoth"]);
    $help = $help1.",".$help2.",".$help3.",".$help4.",".$help5.",".$help6.",".$help7 ;

    $qtnvs1   		        = $_POST["qtnvs1"];
    $qtnvs2   		        = $_POST["qtnvs2"];
    $qtnvs3   		        = $_POST["qtnvs3"];
    $qtnvs4    		        = $_POST["qtnvs4"];
    $qtnvs5   		        = $_POST["qtnvs5"];
    $qtnvs6   		        = $_POST["qtnvs6"];
    $qtnvs7   		        = $_POST["qtnvs7"];
    $qtnvs8    		        = $_POST["qtnvs8"];
    $qtnvs_sum    		    = substr($_POST["qtnvs_sum"],0,1);
    $qtnvsoth         		= trim($_POST["qtnvsoth"]);
    
    //insert data to table
   if($qtn_visid1==""){
     $sql = "insert into questionnaire_visit(qtn_visid,perid,qtn_assessor,pos_ofcid,qtn_round,qtn_date,";
     $sql.= "weight,height,waistline,blood_pressure,help,helpoth";
     $sql.= "qtnvs1,qtnvs2,qtnvs3,qtnvs4,qtnvs5,qtnvs6,qtnvs7,qtnvs8,qtnvs_sum,qtnvsoth,";
     $sql.= "savofc,savdte,updofc,upddte)";
     $sql.= " values ('$qtn_visid','$perid','$qtn_assessor','$pos_ofcid','$qtn_round','$qtn_date',";
     $sql.= "'$weight','$height','$waistline','$blood_pressure','$help','$helpoth',";
     $sql.= "'$qtnvs1','$qtnvs2','$qtnvs3','$qtnvs4','$qtnvs5','$qtnvs6','$qtnvs7','$qtnvs8','$qtnvs_sum','$qtnvsoth',";
     $sql.= "'$ofcid','$savdte','$ofcid','$upddte')";
     $result = mysqli_query($conn,$sql);
    //  echo "xxxxx_enrollments".$sql;
    }else{
        $sql = "update questionnaire_visit set ";
        $sql.= "perid='$perid',
                qtn_assessor='$qtn_assessor',
                pos_ofcid='$pos_ofcid',
                qtn_round='$qtn_round',
                qtn_date='$qtn_date',
                weight='$weight',
                height='$height',
                waistline='$waistline',
                blood_pressure='$blood_pressure',
                help='$help',
                helpoth='$helpoth',
                qtnvs1='$qtnvs1',
                qtnvs2='$qtnvs2',
                qtnvs3='$qtnvs3',
                qtnvs4='$qtnvs4',
                qtnvs5='$qtnvs5',
                qtnvs6='$qtnvs6',
                qtnvs7='$qtnvs7',
                qtnvs8='$qtnvs8',
                qtnvs_sum='$qtnvs_sum',
                qtnvsoth='$qtnvsoth',
                updofc='$ofcid',
                upddte='$upddte' ";
        $sql.= " where qtn_visid=$qtn_visid";
        $result = mysqli_query($conn,$sql);
        // echo "xxxxx_enrollments_update ===> ".$sql;
    }

    //who do save and update data
    $sql = "SELECT CONCAT(o1.ofcnme) AS savofc,a.savdte,CONCAT(o2.ofcnme) AS updofc,a.upddte 
    FROM person a LEFT JOIN ofc o1 ON a.savofc=o1.ofcid
    LEFT JOIN ofc o2 ON a.updofc=o2.ofcid WHERE a.perid='$perid'";    
    $result = mysqli_query($conn,$sql); 
    if ($rows = mysqli_fetch_array($result)){
        $savofc = $rows["savofc"];
        $savdte = $rows["savdte"];
        $savdte = substr($savdte,8,2)."-".substr($savdte,5,2)."-".substr($savdte,0,4);	
        $updofc = $rows["updofc"];
        $upddte = $rows["upddte"];	
        $upddte = substr($upddte,8,2)."-".substr($upddte,5,2)."-".substr($upddte,0,4);	
    }
}else if($act=="delete"){
		$qtn_visid = $_POST["qtn_visid"];
		
		/*$sql = "select picname from person where perid=$perid";
		$result = mysql_query($sql);
		if ($rows = mysql_fetch_array($result)){
			$filename = $rows["picname"];
			@unlink ($filename);
		}*/
	
		$sql = "delete from questionnaire_visit where qtn_visid=$qtn_visid";
		$result = mysqli_query($conn,$sql);

}

if($result){
   $returnValue = array("checkSave"=>"yes","qtn_visid0"=>$qtn_visid,"savofc0"=>$savofc,"savdte0"=>$savdte,"updofc0"=>$updofc,"upddte0"=>$upddte);
    $output = json_encode($returnValue);
    echo $output;
}

?>