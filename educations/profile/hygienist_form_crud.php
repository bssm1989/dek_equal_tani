<?php
@session_start();
require '../service/connect.php';
require '../service/commonFns.php';
$ofcid = $_SESSION['ofcid'];

//savdte
date_default_timezone_set('Asia/Bangkok');
$year = date('Y')+543;
$savdte = $year.date('m').date('d');
$upddte  = $year.date('m').date('d');

$act	= $_POST["act"];
// echo "xxxxxxxxx".$act;
if ($act=="save"){ 
    $ofc_no1 = $_POST["ofc_no"];
    if ($ofc_no1==""){
        $sql 		= "select max(ofc_no) as id from ofc_hygienist";
        $result 	= mysqli_query($conn,$sql);
        $row 		= mysqli_fetch_array($result);
        $ofc_no      = $row["id"]+1;
    } else $ofc_no=$ofc_no1;
	// if ($ofc_id1==""){
    //     $ofc_id = rand(time(), 100000000); //สร้างรหัสใหม่
	// } else $ofc_id=$ofc_id1;
    $$ofcid                 = $ofcid;
    $ofc_preid    	        = $_POST["ofc_preid"];
    $ofc_fname   			= trim($_POST["ofc_fname"]);
    $ofc_lname    	        = trim($_POST["ofc_lname"]);
    $ofc_nickname    	    = trim($_POST["ofc_nickname"]);
    $ofc_pid    	        = trim($_POST["ofc_pid"]);
    $ofc_brtdte			    = getfotmatDateYMD($_POST["ofc_brtdte"]);
    $ofc_age    		    = trim($_POST["ofc_age"]);
    $ofc_reg    		    = $_POST["ofc_reg"];
    $ofc_edulev    		    = $_POST["ofc_edulev"];
    $ofc_graduated_sch      = trim($_POST["ofc_graduated_sch"]);
    $ofc_stsmar    	        = $_POST["ofc_stsmar"];
    $ofc_numchi    		    = trim($_POST["ofc_numchi"]);

    $ofc_roladr   			= trim($_POST["ofc_roladr"]);
    $ofc_rolvllsoi     		= trim($_POST["ofc_rolvllsoi"]);
    $ofc_rolprv   		    = $_POST["ofc_rolprv"];
    $ofc_rolamp   		    = $_POST["ofc_rolamp"];
    $ofc_roltmb   		    = $_POST["ofc_roltmb"];
    $ofc_rolvll    		    = $_POST["ofc_rolvll"];

    $che_adr			    = $_POST["che_adr"];
    $ofc_adr      		    = trim($_POST["ofc_adr"]);
    $ofc_vllsoi             = trim($_POST["ofc_vllsoi"]);
    $ofc_prv   				= $_POST["ofc_prv"];
    $ofc_amp       		    = $_POST["ofc_amp"];
    $ofc_tmb       			= $_POST["ofc_tmb"];
    $ofc_vll        		= $_POST["ofc_vll"];

    $ofc_tel    	  		= trim($_POST["ofc_tel"]);
    $ofc_fb   	  		 	= trim($_POST["ofc_fb"]);
    $ofc_line_id   	  		= trim($_POST["ofc_line_id"]);
    $ofc_email 	            = trim($_POST["ofc_email"]);

    $optid         	  		= $_POST["optid"];
    $ofc_pos               	= trim($_POST["ofc_pos"]);
    $period             	= trim($_POST["period"]);
    $work_exp             	= trim($_POST["work_exp"]);
    $training_exp           = trim($_POST["training_exp"]);
    $impression             = trim($_POST["impression"]);
    $feedback             	= trim($_POST["feedback"]);
        
    if(!$ofc_rolprv)  $ofc_rolprv = '00';
    if($ofc_rolamp)  $ofc_rolamp = substr($ofc_rolamp,2,2);  else $ofc_rolamp = '00';
    if($ofc_roltmb)  $ofc_roltmb = substr($ofc_roltmb,4,2);  else $ofc_roltmb = '00';
    $ofc_rolplcid = $ofc_rolprv.$ofc_rolamp.$ofc_roltmb;

    if(!$ofc_rolvll) $ofc_rolvll = '00';

    if($che_adr == "1"){
      $ofc_adr					= $ofc_roladr;
      $ofc_soi   			  = $ofc_rolvllsoi;
      $ofc_plcid				= $ofc_rolplcid;
      $ofc_vll  				= $ofc_rolvll;
    }else{
      //adress now
      if(!$ofc_prv)  $ofc_prv = '00';
      if($ofc_amp)  $ofc_amp = substr($ofc_amp,2,2);  else $ofc_amp = '00';
      if($ofc_tmb)  $ofc_tmb = substr($ofc_tmb,4,2);  else $ofc_tmb = '00';
      $ofc_plcid = $ofc_prv.$ofc_amp.$ofc_tmb;

      if(!$ofc_vll) $ofc_vll = '00';
    }

    //insert data to table
    if($ofc_no1==""){
        $sql = "insert into ofc_hygienist(ofc_no,ofcid,ofc_preid,ofc_fname,ofc_lname,ofc_nickname,ofc_pid,ofc_brtdte,ofc_age,ofc_reg,ofc_edulev,ofc_graduated_sch,ofc_stsmar,ofc_numchi,"; //graduation_date,graduation_cmm,
        $sql.= "ofc_roladr,ofc_rolvllsoi,ofc_rolvllno,ofc_rolplcid,ofc_adr,ofc_vllsoi,ofc_vllno,ofc_plcid,ofc_tel,ofc_fb,ofc_line_id,ofc_email,optid,ofc_pos,period,work_exp,";
        $sql.= "training_exp,impression,feedback,";
        $sql.= "savofc,savdte,updofc,upddte)";
        $sql.= " values ('$ofc_no','$ofcid','$ofc_preid','$ofc_fname','$ofc_lname','$ofc_nickname','$ofc_pid','$ofc_brtdte','$ofc_age','$ofc_reg','$ofc_edulev','$ofc_graduated_sch','$ofc_stsmar','$ofc_numchi',";
        $sql.= " '$ofc_roladr','$ofc_rolvllsoi','$ofc_rolvll','$ofc_rolplcid','$ofc_adr','$ofc_vllsoi','$ofc_vll','$ofc_plcid','$ofc_tel','$ofc_fb','$ofc_line_id','$ofc_email','$optid','$ofc_pos','$period','$work_exp',";
        $sql.= " '$training_exp','$impression','$feedback',";
        $sql.= " '$ofcid','$savdte','$ofcid','$upddte')";
        $result = mysqli_query($conn,$sql);
        //echo "xxxxx_ofc".$sql;
        }else{
            $sql = "update ofc_hygienist set ";
            $sql.= "ofcid='$ofcid',ofc_preid='$ofc_preid',ofc_fname='$ofc_fname',ofc_lname='$ofc_lname',ofc_nickname='$ofc_nickname',ofc_pid='$ofc_pid',ofc_brtdte='$ofc_brtdte',ofc_age='$ofc_age',";
            $sql.= "ofc_reg='$ofc_reg',ofc_edulev='$ofc_edulev',ofc_graduated_sch='$ofc_graduated_sch',ofc_stsmar='$ofc_stsmar',ofc_numchi='$ofc_numchi',";
            $sql.= "ofc_roladr='$ofc_roladr',ofc_rolvllsoi='$ofc_rolvllsoi',ofc_rolvllno='$ofc_rolvll',ofc_rolplcid='$ofc_rolplcid',";
            $sql.= "ofc_adr='$ofc_adr',ofc_vllsoi='$ofc_vllsoi',ofc_vllno='$ofc_vll',ofc_plcid='$ofc_plcid',";
            $sql.= "ofc_tel='$ofc_tel',ofc_fb='$ofc_fb',ofc_line_id='$ofc_line_id',ofc_email='$ofc_email',";
            $sql.= "optid='$optid',ofc_pos='$ofc_pos',period='$period',work_exp='$work_exp',";
            $sql.= "training_exp='$training_exp',impression='$impression',feedback='$feedback',";
            $sql.= "updofc='$ofcid',upddte='$upddte'";
            $sql.= " where ofc_no=$ofc_no";
            $result = mysqli_query($conn,$sql);
            // echo "xxxxx_ofc_update".$sql;
        }
}else if($act=="delete"){
          $ofc_id = $_POST["ofc_no"];
          $sql = "delete from ofc_hygienist where ofc_no=$ofc_no";
		      $result = mysqli_query($conn,$sql);
		
            /*$sql = "select picname from person where perid=$perid";
            $result = mysql_query($sql);
            if ($rows = mysql_fetch_array($result)){
                $filename = $rows["picname"];
                @unlink ($filename);
            }*/
	
		

}
  
//who do save and update data
//   $sql = "select o1.ofcnme as savofc,savdte,o2.ofcnme as updofc,upddte";
//   $sql.= " from enrollments a left join ofcusers o1 on a.savofc=o1.ofcid";
//   $sql.= " left join ofcusers o2 on a.updofc=o2.ofcid where a.ofc_id='$ofc_id'";
//   $result = mysqli_query($conn,$sql); 
//   if ($rows = mysqli_fetch_array($result)){
//     $savofc = $rows["savofc"];
//     $savdte = $rows["savdte"];
//     $savdte = substr($savdte,6,2)."-".substr($savdte,4,2)."-".substr($savdte,0,4);	
//     $updofc = $rows["updofc"];
//     $upddte = $rows["upddte"];	
//     $upddte = substr($upddte,6,2)."-".substr($upddte,4,2)."-".substr($upddte,0,4);	
//   }

if($result){
   $returnValue = array("checkSave"=>"yes","ofc_no0"=>$ofc_no);
    $output = json_encode($returnValue);
    echo $output;
}
?>