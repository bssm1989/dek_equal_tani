<?php
@session_start();
$ofcid = $_SESSION['ofcid'];
// echo "xxxxxxxxx".$ofcid;
require '../service/connect.php';
require '../service/commonFns.php';

//savdte
date_default_timezone_set('Asia/Bangkok');
$year = date('Y')+543;
$savdte = $year.date('m').date('d');
$upddte  = $year.date('m').date('d');

$act	= $_POST["act"];
// echo "xxxxxxxxx".$act;
if ($act=="save"){ //1 check for save or delete
		$perid1 = $_POST["perid"];
		if ($perid1==""){
			$sql 		= "select max(perid) as id from person";
			$result 	= mysqli_query($conn,$sql);
			$row 		= mysqli_fetch_array($result);
			$perid      = $row["id"]+1;
		} else $perid=$perid1;
		//echo "perid: ".$perid;

		$pid    	    = trim($_POST["pid"]);
		#check pid before insert/update
		if(isset($pid) && !empty($pid)){
			$sql = "select perid,pid from person where pid='$pid' and pid<>'' and perid<>'$perid'";
			$result 	= mysqli_query($conn,$sql);
			// echo "xxxxxxxxxx".$sql;
			if($row = mysqli_fetch_array($result)){
			    //echo "repeatttttttttttttttttttttt";
				$returnValue = array("checkSave"=>"no");
				$output = json_encode($returnValue);
				echo $output;
				exit();
			}
		}

    $preid    	    = $_POST["preid"];
    $nme   			    = trim($_POST["nme"]);
    $surnme    	    = trim($_POST["surnme"]);
    $brtdte			    = getfotmatDateYMD($_POST["brtdte"]);
		//$brtday    	= $_POST["brtday"];
    //$brtmon    	= $_POST["brtmon"];
    //$brtyear    = $_POST["brtyear"];

    $age    		    = trim($_POST["age"]);
    $sex    		    = $_POST["sex"];
    $reg    		    = $_POST["reg"];
    $stsmar    	        = $_POST["stsmar"];
    $numchi  	        = trim($_POST["numchi"]);
    $numchistd  	    = trim($_POST["numchistd"]);
    $edulev             = $_POST["edulev"];
    $currlevid        	= $_POST["currlevid"];
    $blood_type      			= trim($_POST["blood_type"]);
    $occid    		    = $_POST["occid"];
    $add_occid    		    = $_POST["add_occid"];
    $sal      			= trim($_POST["sal"]);

    // รหัส person_qtn_additional ข้อมูลคำถามบุคคล เพิ่มเติม
    if ($perqaid1==""){
			$sql 		= "select max(perqaid) as id from person_qtn_additional";
			$result 	= mysqli_query($conn,$sql);
			$row 		= mysqli_fetch_array($result);
			$perqaid = $row["id"]+1;
		} else $perqaid=$perqaid1;

    // รหัสที่อยู่ตามสำเนาทะเบียนบ้าน 
    if ($roladdrid1==""){
			$sql 		= "select max(addrid) as id from address";
			$result 	= mysqli_query($conn,$sql);
			$row 		= mysqli_fetch_array($result);
			$rolhomid = $row["id"]+1;
		} else $rolhomid=$roladdrid1;

    $roladr				    = trim($_POST["roladr"]);
    $rolvllsoi   		  = trim($_POST["rolvllsoi"]);
    $rolprv   		    = $_POST["rolprv"];
    $rolamp   		    = $_POST["rolamp"];
    $roltmb   		    = $_POST["roltmb"];
    $rolvll    		    = $_POST["rolvll"];

    // รหัสที่อยู่ปัจจุบัน
    if ($addrid1==""){
      $sql 		= "select max(addrid) as id from address";
      $result 	= mysqli_query($conn,$sql);
      $row 		= mysqli_fetch_array($result);
      $curhomid 	= $row["id"]+2;
    } else $curhomid=$addrid1;

    $che_adr			    = $_POST["che_adr"];
    $adr				      = trim($_POST["adr"]);
    $vllsoi   		    = trim($_POST["vllsoi"]);
    $prv   		        = $_POST["prv"];
    $amp   		        = $_POST["amp"];
    $tmb   		        = $_POST["tmb"];
    $vll    		      = $_POST["vll"];

    $tel	  		 	= trim($_POST["tel"]);

    $lat	  		 	= trim($_POST["lat"]);
    $lon	  		 	= trim($_POST["lon"]);
    $house_conid  = $_POST["house_conid"];  

    $congenital_disease1			= $_POST["congenital_disease1"];
    $congenital_disease2			= $_POST["congenital_disease2"];
    $congenital_disease3			= $_POST["congenital_disease3"];
    $congenital_disease4			= $_POST["congenital_disease4"];
    $congenital_disease5			= $_POST["congenital_disease5"];
    $congenital_disease6			= $_POST["congenital_disease6"];
    $congenital_disease7			= $_POST["congenital_disease7"];
    $congenital_disease8			= $_POST["congenital_disease8"];
    $congenital_disease9			= $_POST["congenital_disease9"];
    $congenital_disease10			= $_POST["congenital_disease10"];
    $congenital_disease11			= $_POST["congenital_disease11"];
    $congenital_disease12			= $_POST["congenital_disease12"];
    $congenital_disease_oth		= trim($_POST["congenital_disease_oth"]);

    $congenital_disease = $congenital_disease1.",".$congenital_disease2.",".$congenital_disease3.",".$congenital_disease4.",".$congenital_disease5.",".$congenital_disease6.",".$congenital_disease7.",".$congenital_disease8.",".$congenital_disease9.",".$congenital_disease10.",".$congenital_disease11.",".$congenital_disease12 ;

    $medical_permis1			= $_POST["medical_permis1"];
    $medical_permis2			= $_POST["medical_permis2"];
    $medical_permis3			= $_POST["medical_permis3"];
    $medical_permis4			= $_POST["medical_permis4"];
    $medical_permis5			= $_POST["medical_permis5"];
    $medical_permis6			= $_POST["medical_permis6"];
    $medical_permis_oth   = trim($_POST["medical_permis_oth"]);

    $medical_permis = $medical_permis1.",".$medical_permis2.",".$medical_permis3.",".$medical_permis4.",".$medical_permis5.",".$medical_permis6;

    $medical_permis_office   = trim($_POST["medical_permis_office"]);
    $vaccination_id   = $_POST["vaccination_id"];
    $num_covid   = trim($_POST["num_covid"]);
    $pertypid   = $_POST["pertypid"];
    $elderly_grpid   = $_POST["elderly_grpid"];
    $distypid   = $_POST["distypid"];

    $hav_attendant   = $_POST["hav_attendant"];
    $main_attendant_nme   = $_POST["main_attendant_nme"];
    $main_attendant_surnme   = $_POST["main_attendant_surnme"];
    $main_attendant_brtdte	= getfotmatDateYMD($_POST["main_attendant_brtdte"]);
    $main_attendant_rel   = $_POST["main_attendant_rel"];
    $main_attendant_occid   = $_POST["main_attendant_occid"];
    $main_attendant_sal   = trim($_POST["main_attendant_sal"]);
    $main_attendant_tel   = trim($_POST["main_attendant_tel"]);
    $optid                = $_POST["optid"];
    $alive                = $_POST["alive"];
    $percmm	  		 	      = trim($_POST["percmm"]);

    if(!$rolprv)  $rolprv = '00';
    if($rolamp)  $rolamp = substr($rolamp,2,2);  else $rolamp = '00';
    if($roltmb)  $roltmb = substr($roltmb,4,2);  else $roltmb = '00';
    $rolplcid = $rolprv.$rolamp.$roltmb;

    if(!$rolvll) $rolvll = '00';

    if($che_adr == "1"){
      $adr					= $roladr;
      $vllsoi   		= $rolvllsoi;
      $plcid				= $rolplcid;
      $vll  				= $rolvll;
    }else{
      //adress now
      if(!$prv) $prv = '00';
      if($amp)  $amp = substr($amp,2,2);  else $amp = '00';
      if($tmb)  $tmb = substr($tmb,4,2);  else $tmb = '00';
      $plcid = $prv.$amp.$tmb;

      if(!$vll) $vll = '00';
    }

    $sql 		= "select plcid as rolplc from `const_plc` where plcidgen='$rolplcid'";
		$result 	= mysqli_query($conn,$sql); 
		$rows 		= mysqli_fetch_array($result);
		$rolplc		= $rows["rolplc"];
		//echo $rolplc;

    //if(!$pid) $pid = NULL;
		$sql 		= "select plcid as plc from `const_plc` where plcidgen='$plcid'";
		$result 	= mysqli_query($conn,$sql); 
		$rows 		= mysqli_fetch_array($result);
		$plc		= $rows["plc"];
		//echo $plc;

    //insert data to table
    if($perid1==""){
        $sql = "insert into person(perid,pid,preid,nme,surnme,brtdte,sex,reg,nnt,race,age,agem,age_now,agem_now,";
        $sql.= "evndte,stsmar,numchi,numchistd,occid,sal,edulev,currlevid,rolhomid,curhomid,";
        $sql.= "tel,havdebt,numdebt,alive,optid,percmm,";
        $sql.= "savofc,savdte,updofc,upddte)";
        $sql.= " values ('$perid','$pid','$preid','$nme','$surnme','$brtdte','$sex','$reg','ไทย','ไทย','$age','0','0','0',";
        $sql.= "'0000-00-00','$stsmar','$numchi','$numchistd','$occid','$sal','$edulev','$currlevid','$rolhomid','$curhomid',";
        $sql.= "'$tel','0','0','$alive','$optid','$percmm',";
        $sql.= "'$ofcid','$savdte','$ofcid','$upddte')";
        $result = mysqli_query($conn,$sql);
        //echo "xxxxx23".$sql;

        $sql = "insert into person_qtn_additional(perqaid,perid,blood_type,add_occid,roladr,rolvllsoi,rolvllno,rolplcid,adr,vllsoi,vllno,plcid,";
        $sql.= "lat,lon,house_conid,congenital_disease,congenital_disease_oth,medical_permis,medical_permis_oth,";
        $sql.= "medical_permis_office,vaccination_id,num_covid,pertypid,elderly_grpid,";
        $sql.= "distypid,hav_attendant,main_attendant_nme,main_attendant_surnme,";
        $sql.= "main_attendant_brtdte,main_attendant_rel,main_attendant_occid,";
        $sql.= "main_attendant_sal,main_attendant_tel,";
        $sql.= "savofc,savdte,updofc,upddte)";
        $sql.= " values ('$perqaid','$perid','$blood_type','$add_occid','$roladr','$rolvllsoi','$rolvll','$rolplcid','$adr','$vllsoi','$vll','$plcid',";
        $sql.= "'$lat','$lon','$house_conid','$congenital_disease','$congenital_disease_oth','$medical_permis','$medical_permis_oth',";
        $sql.= "'$medical_permis_office','$vaccination_id','$num_covid','$pertypid','$elderly_grpid',";
        $sql.= "'$distypid','$hav_attendant','$main_attendant_nme','$main_attendant_surnme',";
        $sql.= "'$main_attendant_brtdte','$main_attendant_rel','$main_attendant_occid',";
        $sql.= "'$main_attendant_sal','$main_attendant_tel',";
        $sql.= "'$ofcid','$savdte','$ofcid','$upddte')";
        $result1 = mysqli_query($conn,$sql);
        //echo "xxxxx23".$sql;

        $sql = "insert into address(addrid,addrno,addrroad,addrmoo,vllid,plcid,addrpost,lat,lng,latlng_true)";
        $sql.= " values ('$rolhomid','$roladr','$rolvllsoi','$rolvll','0','$rolplc','','0','0','0')";
        $result2 = mysqli_query($conn,$sql);
        // echo "xxxxxx0".$sql;

        $sql = "insert into address(addrid,addrno,addrroad,addrmoo,vllid,plcid,addrpost,lat,lng,latlng_true)";
        $sql.= " values ('$curhomid','$adr','$vllsoi','$vll','0','$plc','','$lat','$lon','1')";
        $result3 = mysqli_query($conn,$sql);
        // echo "xxxxxx1".$sql;

        if($pertypid<>0){
          $sql = "insert into typeofper(perid,pertypid,typelevel)";
          $sql.= " values ('$perid','$pertypid','0')";
          $result4 = mysqli_query($conn,$sql);
          // echo $sql;
        }      
        
      }else{
          $sql = "update person set ";
          $sql.= "pid='$pid',
                  preid='$preid',
                  nme='$nme',
                  surnme='$surnme',
                  brtdte='$brtdte',
                  sex='$sex',
                  reg='$reg',
                  nnt='ไทย',
                  race='ไทย',
                  age='$age',
                  agem='0',
                  age_now='0',
                  agem_now='0',
                  evndte='0000-00-00',
                  stsmar='$stsmar',
                  numchi='$numchi',
                  numchistd='$numchistd',
                  occid='$occid',
                  edulev='$edulev',
                  currlevid='$currlevid',
                  tel='$tel',
                  havdebt='0',
                  numdebt='0',
                  alive='$alive',
                  optid='$optid',
                  percmm='$percmm',
                  updofc='$ofcid',
                  upddte='$upddte'";
          $sql.= " where perid=$perid";
          $result = mysqli_query($conn,$sql);
          // echo "xxxxx23".$sql;  
          
          $sql = "update person_qtn_additional set ";
          $sql.= "blood_type='$blood_type',
                  add_occid='$add_occid',
                  roladr='$roladr',
                  rolvllsoi='$rolvllsoi',
                  rolvllno='$rolvll',
                  rolplcid='$rolplcid',
                  adr='$adr',
                  vllsoi='$vllsoi',
                  vllno='$vll',
                  plcid='$plcid',
                  lat='$lat',
                  lon='$lon',
                  house_conid='$house_conid',
                  congenital_disease='$congenital_disease',
                  congenital_disease_oth='$congenital_disease_oth',
                  medical_permis='$medical_permis',
                  medical_permis_oth='$medical_permis_oth',
                  medical_permis_office='$medical_permis_office',
                  vaccination_id='$vaccination_id',
                  num_covid='$num_covid',
                  pertypid='$pertypid',
                  elderly_grpid='$elderly_grpid',
                  distypid='$distypid',
                  hav_attendant='$hav_attendant',
                  main_attendant_nme='$main_attendant_nme',
                  main_attendant_surnme='$main_attendant_surnme',
                  main_attendant_brtdte='$main_attendant_brtdte',
                  main_attendant_rel='$main_attendant_rel',
                  main_attendant_occid='$main_attendant_occid',
                  main_attendant_sal='$main_attendant_sal',
                  main_attendant_tel='$main_attendant_tel',
                  updofc='$ofcid',
                  upddte='$upddte'";
          $sql.= " where perid='$perid'";
          $result1 = mysqli_query($conn,$sql);
          // echo "xxxxx23".$sql;  

          // $sql = mysqli_query($conn, "SELECT rolhomid,curhomid FROM person b WHERE b.perid= '{$perid}'");
          // if(mysqli_num_rows($sql) > 0){
          //   $row = mysqli_fetch_assoc($sql);
          //   /** ทีอยู่ตามภูมิลำเนา */
          //   $sql2 = mysqli_query($conn, "UPDATE `address` SET addrno='$roladr',
          //         addrroad='$rolvllsoi',
          //         addrmoo='$rolvll',
          //         vllid='0',
          //         plcid='$rolplc',
          //         addrpost='',
          //         lat='0',
          //         lng='0',
          //         latlng_true='0' 
          //   WHERE ofcid = {$row['rolhomid']}");
          //   // echo "xxxxx23".$sql2;

          //   $sql3 = mysqli_query($conn, "UPDATE `address` SET addrno='$adr',
          //         addrroad='$vllsoi',
          //         addrmoo='$vll',
          //         vllid='0',
          //         plcid='$plc',
          //         addrpost='',
          //         lat='$lat',
          //         lng='$lon',
          //         latlng_true='1' 
          //   WHERE ofcid = {$row['curhomid']}");
          //   echo "xxxxx24".$sql3;
          // }
          /** ทีอยู่ตามภูมิลำเนา */
          $sql = "update `address` a inner join person b on a.addrid=b.rolhomid ";
          $sql.= " set a.addrno='$roladr',
                        a.addrroad='$rolvllsoi',
                        a.addrmoo='$rolvll',
                        a.vllid='0',
                        a.plcid='$rolplc',
                        a.addrpost='',
                        a.lat='0',
                        a.lng='0',
                        a.latlng_true='0' ";
          $sql.= " where b.perid=$perid";
          $result2 = mysqli_query($conn,$sql);
          // echo "xxxxx23".$sql; 

          /** ที่อยู่ปัจจุบัน */
          $sql = "update `address` a inner join person b on a.addrid=b.curhomid ";
          $sql.= " set addrno='$adr', 
                        addrroad='$vllsoi',
                        addrmoo='$vll',
                        vllid='0',
                        plcid='$plc',
                        addrpost='',
                        lat='$lat',
                        lng='$lon',
                        latlng_true='1'";
          $sql.= " where b.perid=$perid";
          $result3 = mysqli_query($conn,$sql);

          $sql = "delete from typeofper where perid=$perid";
          if($pertypid<>0){
            $sql = "insert into typeofper(perid,pertypid,typelevel)";
            $sql.= " values ('$perid','$pertypid','0')";
            $result4 = mysqli_query($conn,$sql);
            // echo $sql;
          }                
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
			$perid = $_POST["perid"];
			$sql = "delete from person where perid=".$perid;
			$result = mysqli_query($conn,$sql);
      if($result){
        $returnValue = array("checkSave"=>"yes","perid0"=>$perid);
        $output = json_encode($returnValue);
        echo $output;
        exit();
      }
      
	}

  

  if($result){
      $returnValue = array("checkSave"=>"yes","perid0"=>$perid,"savofc0"=>$savofc,"savdte0"=>$savdte,"updofc0"=>$updofc,"upddte0"=>$upddte);
      $output = json_encode($returnValue);
      echo $output;
  }
    
?>