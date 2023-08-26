<?php
@session_start();
$staffid = $_SESSION['staffid'];
// echo "xxxxxxxxx".$ofcid;
require '../service/connect.php';
require '../service/commonFns.php';

//savdte
date_default_timezone_set('Asia/Bangkok');
$year = date('Y')+543;
$savdte = $year.date('m').date('d');
$upddte  = $year.date('m').date('d');

$act	= $_POST["act"];
echo "xxxxxxxxx".$act;
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

    $titid    	    = $_POST["titid"];
    $name   		= trim($_POST["name"]);
    $sname    	    = trim($_POST["sname"]);
    $genid    		= $_POST["genid"];
    $brtdte			= getfotmatDateYMD($_POST["brtdte"]);
    $age    		= trim($_POST["age"]);
    $religid        = $_POST["religid"];
    $religoth    	= trim($_POST["religoth"]);
    
    $adr			= trim($_POST["adr"]);
    $soi   		    = trim($_POST["soi"]);
    $prv   		    = $_POST["prv"];
    $amp   		    = $_POST["amp"];
    $tmb   		    = $_POST["tmb"];
    $vll    		= $_POST["vll"];
    $postcode	  	= trim($_POST["postcode"]);
    $pertel	  		= trim($_POST["pertel"]);

    $chiord	  		= trim($_POST["chiord"]);
    $livewid	  	= $_POST["livewid"];
    $famsttid       = $_POST["famsttid"]; 
    $distschkm	  	= trim($_POST["distschkm"]);
    $distschm	  	= trim($_POST["distschm"]);
    $distschhrs	  	= trim($_POST["distschhrs"]);
    $distschmin	  	= trim($_POST["distschmin"]);
    $farepay	  	= trim($_POST["farepay"]);
    $schmethid	  	= $_POST["schmethid"];
    $chidetail	  	= trim($_POST["chidetail"]); 
    // $dispfrmid      = $_POST["dispfrmid"];

    //adress now
    if(!$prv) $prv = '00';
    if($amp)  $amp = substr($amp,2,2);  else $amp = '00';
    if($tmb)  $tmb = substr($tmb,4,2);  else $tmb = '00';
    $plcid = $prv.$amp.$tmb;

    if(!$vll) $vll = '00';


    //insert data to table
    if($perid1==""){
        /** table person */
        $sql = "insert into person(perid,pid,titid,name,sname,genid,religid,religoth,brtdte,age,";
        $sql.= "adr,soi,vllid,plcid,postcode,pertel)";
        //$sql.= "savofc,savdte,updofc,upddte)";
        $sql.= " values ('$perid','$pid','$titid','$name','$sname','$genid','$religid','$religoth','$brtdte','$age',";
        $sql.= "'$adr','$soi','$vll','$plcid','$postcode','$pertel')";
        // $sql.= "'$ofcid','$savdte','$ofcid','$upddte')";
        $result = mysqli_query($conn,$sql);
        echo "xxxxx23".$sql;

        /** table child */
        $sql = "insert into child(perid,chiord,livewid,famsttid,distschkm,distschm,distschhrs,";
        $sql.= "distschmin,farepay,schmethid,chidetail)";
        //$sql.= "savofc,savdte,updofc,upddte)";
        $sql.= " values ('$perid','$chiord','$livewid','$famsttid','$distschkm','$distschm','$distschhrs',";
        $sql.= "'$distschmin','$farepay','$schmethid','$chidetail')";
        // $sql.= "'$ofcid','$savdte','$ofcid','$upddte')";
        $result = mysqli_query($conn,$sql);
        //echo "xxxxx23".$sql;
    
    }else{
          $sql = "update person set ";
          $sql.= "pid='$pid',
          titid='$titid',
          name='$name',
          sname='$sname',
          genid='$genid',
          religid='$religid',
          religoth='$religoth',
          brtdte='$brtdte',
          age='$age',
          adr='$adr',
          soi='$soi',
          vll='$vll',
          plcid='$plcid',
          postcode='$postcode',
          pertel='$pertel'";
                //   updofc='$ofcid',
                //   upddte='$upddte'";
          $sql.= " where perid=$perid";
          $result = mysqli_query($conn,$sql);
          // echo "xxxxx23".$sql;  
          
          /** update table child */
          $sql = "update child set ";
          $sql.= "chiord='$chiord',
          livewid='$livewid',
          famsttid='$famsttid',
          distschkm='$distschkm',
          distschm='$distschm',
          distschm='$distschm',
          distschhrs='$distschhrs',
          distschmin='$distschmin',
          farepay='$farepay',
          schmethid='$schmethid',
          chidetail='$chidetail'";
                //   updofc='$ofcid',
                //   upddte='$upddte'";
          $sql.= " where perid='$perid'";
          $result1 = mysqli_query($conn,$sql);
          // echo "xxxxx23".$sql;  
          
          
      }

      //who do save and update data
    //   $sql = "SELECT CONCAT(o1.ofcnme) AS savofc,a.savdte,CONCAT(o2.ofcnme) AS updofc,a.upddte 
    //   FROM person a LEFT JOIN ofc o1 ON a.savofc=o1.ofcid
    //   LEFT JOIN ofc o2 ON a.updofc=o2.ofcid WHERE a.perid='$perid'";    
    //   $result = mysqli_query($conn,$sql); 
    //   if ($rows = mysqli_fetch_array($result)){
    //       $savofc = $rows["savofc"];
    //       $savdte = $rows["savdte"];
    //       $savdte = substr($savdte,8,2)."-".substr($savdte,5,2)."-".substr($savdte,0,4);	
    //       $updofc = $rows["updofc"];
    //       $upddte = $rows["upddte"];	
    //       $upddte = substr($upddte,8,2)."-".substr($upddte,5,2)."-".substr($upddte,0,4);	
    //   }

    }else if($act=="delete"){
      $perid = $_POST["perid"];

      $sql = "delete from `address` a inner join person b on a.addrid=b.rolhomid where b.perid=$perid";
      $result = mysqli_query($conn,$sql);
      //echo $sql;

      $sql = "delete from update `address` a inner join person b on a.addrid=b.curhomid where b.perid=$perid";
      $result = mysqli_query($conn,$sql);
      //echo $sql;

      $sql = "delete from typeofper where perid=$perid";
      $result = mysqli_query($conn,$sql);
      //echo $sql;

      $sql = "delete from person_qtn_additional where perid=$perid";
      $result = mysqli_query($conn,$sql);
    
      $sql = "delete from person where perid=$perid";
      $result = mysqli_query($conn,$sql);
      
      
      //echo $sql;		
      //@unlink ("docs/".$filename);
      $filename = $_GET["filename"];
      $sql = "select * from perdoc  where perid=$perid";
      $result = mysqli_query($con_dsrd,$sql);
      while($array = mysqli_fetch_array($result)){
      @unlink($filename);
      }
      $sqls = "delete from perdoc where perid=$perid";
      $results = mysqli_query($con_dsrd,$sqls);


			// $perid = $_POST["perid"];
			// $sql = "delete from person where perid=".$perid;
			// $result = mysqli_query($conn,$sql);
      // if($result){
      //   $returnValue = array("checkSave"=>"yes","perid0"=>$perid);
      //   $output = json_encode($returnValue);
      //   echo $output;
      //   exit();
      // }
      
	}

  

  if($result){
      $returnValue = array("checkSave"=>"yes","perid0"=>$perid,"savofc0"=>$savofc,"savdte0"=>$savdte,"updofc0"=>$updofc,"upddte0"=>$upddte);
      $output = json_encode($returnValue);
      echo $output;
  }
    
?>