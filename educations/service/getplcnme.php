<?php
 //require_once("../checkpermission.php"); //เอาไว้บรรทัดแรกของ page เสมอ
     $data=$_GET['data'];
     $val=$_GET['val'];
	 $adr=$_GET['adr'];
	 //echo "data:".$data;
	 //echo "value:".$val;
	 //echo "adr:".$adr;

   require './connect.php';
//set province amphur tambon and village for search
 if($adr=='search'){
   if ($data=='province') {
          echo "<select name='province' onChange=\"dochange('district', this.value,'search');\">\n";
          echo "<option value=''> เลือกจังหวัด</option>\n";
          $result=mysqli_query($conn,"select distinct prvidgen,prvnmegen from const_plcnmegen where left(plcidgen,2) in ('00','90','94','95','96') order by prvidgen");
          while(list($id, $name)=mysqli_fetch_array($result)){
		  	   if($val==$id){
               		echo "<option value=\"$id\" selected>$name</option> \n" ;
			   }else{
               		echo "<option value=\"$id\" >$name</option> \n" ;
			   }
          }
   }else if ($data=='district') {
          echo "<select name='district' id='district' onChange=\"dochange('subdist', this.value,'search')\">\n";
          echo "<option value=''> เลือกอำเภอ</option>\n";
          $val2=$val;
          $val = substr($val,0,2);
          $result=mysqli_query($conn,"select distinct concat(prvidgen,ampidgen) as ampidgen,ampnmegen from const_plcnmegen where left(plcidgen,2)='$val' order by ampidgen");
          while(list($id, $name)=mysqli_fetch_array($result)){
		  	   if($val2==$id){
               	  echo "<option value=\"$id\" selected>$name</option> \n" ;
			   }else{
               	  echo "<option value=\"$id\" >$name</option> \n" ;
			   }
          }
     } else if ($data=='subdist') {
          echo "<select  name='subdist' id='subdist' onChange=\"dochange('vll', this.value,'search')\">\n";
          echo "<option value=''> เลือกตำบล</option>\n";
          $val2=$val;
          $val = substr($val,0,4);
          $result=mysqli_query($conn,"select distinct plcidgen as tmbidgen,tmbnmegen from const_plcnmegen where left(plcidgen,4)='$val' order by plcidgen");
	      while(list($id, $name)=mysqli_fetch_array($result)){
		  	   if($val2==$id){
               	echo "<option value=\"$id\" selected>$name</option> \n";
			   }else{
			    echo "<option value=\"$id\" >$name</option> \n";
			   }
          }
     } else if ($data=='vll') {
          echo "<select  name='vll' >\n";
          echo "<option value=''> เลือกหมู่บ้าน</option>\n";
          $val2 = substr($val,6,2);
          $val = substr($val,0,6);
          $result=mysqli_query($conn,"select vllidgen,concat(vllidgen,':',vllnmegen) as vllnmegen from const_vllnmegen where concat(prvidgen,ampidgen,tmbidgen)='$val' order by vllidgen");
	      while(list($id, $name)=mysqli_fetch_array($result)){
		  	   if($val2==$id){
               	echo "<option value=\"$id\" selected>$name</option> \n";
			   }else{
			    echo "<option value=\"$id\" >$name</option> \n";
			   }
          }
     }
     echo "</select>\n";
//=========================================================================================================================================================================
//set province amphur tambon and village for address1
} else if($adr=='adr1'){
     if ($data=='province1') {
            echo "<select class='form-control' name='province1' onChange=\"dochange('district1', this.value,'adr1');\">\n";
            echo "<option value=''> เลือกจังหวัด</option>\n";
            $result=mysqli_query($conn,"select distinct prvidgen,prvnmegen from const_plcnmegen order by prvidgen");
            while(list($id, $name)=mysqli_fetch_array($result)){
                      if($val==$id){
                           echo "<option value=\"$id\" selected>$name</option> \n" ;
                    }else{
                           echo "<option value=\"$id\" >$name</option> \n" ;
                    }
            }
     }else if ($data=='district1') {
            echo "<select class='form-control' name='district1' id='district1' onChange=\"dochange('subdist1', this.value,'adr1')\">\n";
            echo "<option value=''> เลือกอำเภอ</option>\n";
            $val2=$val;
            $val = substr($val,0,2);
            $result=mysqli_query($conn,"select distinct concat(prvidgen,ampidgen) as ampidgen,ampnmegen from const_plcnmegen where left(plcidgen,2)='$val' order by ampidgen");
            while(list($id, $name)=mysqli_fetch_array($result)){
                      if($val2==$id){
                        echo "<option value=\"$id\" selected>$name</option> \n" ;
                    }else{
                        echo "<option value=\"$id\" >$name</option> \n" ;
                    }
            }
       } else if ($data=='subdist1') {
            echo "<select class='form-control'  name='subdist1' id='subdist1' onChange=\"dochange('vll1', this.value,'adr1')\">\n";
            echo "<option value=''> เลือกตำบล</option>\n";
            $val2=$val;
            $val = substr($val,0,4);
            $result=mysqli_query($conn,"select distinct plcidgen as tmbidgen,tmbnmegen from const_plcnmegen where left(plcidgen,4)='$val' order by plcidgen");
             while(list($id, $name)=mysqli_fetch_array($result)){
                      if($val2==$id){
                      echo "<option value=\"$id\" selected>$name</option> \n";
                    }else{
                     echo "<option value=\"$id\" >$name</option> \n";
                    }
            }
       } else if ($data=='vll1') {
            echo "<select class='form-control'  name='vll1' >\n";
            echo "<option value=''> เลือกหมู่บ้าน</option>\n";
            $val2 = substr($val,6,2);
            $val = substr($val,0,6);
            $result=mysqli_query($conn,"select vllidgen,concat(vllidgen,':',vllnmegen) as vllnmegen from const_vllnmegen where concat(prvidgen,ampidgen,tmbidgen)='$val' order by vllidgen");
             while(list($id, $name)=mysqli_fetch_array($result)){
                      if($val2==$id){
                      echo "<option value=\"$id\" selected>$name</option> \n";
                    }else{
                     echo "<option value=\"$id\" >$name</option> \n";
                    }
            }
       }
       echo "</select>\n";
//=========================================================================================================================================================================
//set province amphur tambon and village for person in address2
} else if($adr=='adr2'){
   if ($data=='province2') {
          echo "<select class='form-control' name='province2' onChange=\"dochange('district2', this.value,'adr2');\">\n";
          echo "<option value=''> เลือกจังหวัด</option>\n";
          $result=mysqli_query($conn,"select distinct prvidgen,prvnmegen from const_plcnmegen order by prvidgen");
          while(list($id, $name)=mysqli_fetch_array($result)){
		  	   if($val==$id){
               		echo "<option value=\"$id\" selected>$name</option> \n" ;
			   }else{
               		echo "<option value=\"$id\" >$name</option> \n" ;
			   }
          }
   }else if ($data=='district2') {
          echo "<select class='form-control' name='district2' id='district2' onChange=\"dochange('subdist2', this.value,'adr2')\">\n";
          echo "<option value=''> เลือกอำเภอ</option>\n";
          $val2=$val;
          $val = substr($val,0,2);
          $result=mysqli_query($conn,"select distinct concat(prvidgen,ampidgen) as ampidgen,ampnmegen from const_plcnmegen where left(plcidgen,2)='$val' order by ampidgen");
          while(list($id, $name)=mysqli_fetch_array($result)){
		  	   if($val2==$id){
               	  echo "<option value=\"$id\" selected>$name</option> \n" ;
			   }else{
               	  echo "<option value=\"$id\" >$name</option> \n" ;
			   }
          }
     } else if ($data=='subdist2') {
          echo "<select class='form-control'  name='subdist2' id='subdist2' onChange=\"dochange('vll2', this.value,'adr2')\">\n";
          echo "<option value=''> เลือกตำบล</option>\n";
          $val2=$val;
          $val = substr($val,0,4);
          $result=mysqli_query($conn,"select distinct plcidgen as tmbidgen,tmbnmegen from const_plcnmegen where left(plcidgen,4)='$val' order by plcidgen");
	      while(list($id, $name)=mysqli_fetch_array($result)){
		  	   if($val2==$id){
               	echo "<option value=\"$id\" selected>$name</option> \n";
			   }else{
			    echo "<option value=\"$id\" >$name</option> \n";
			   }
          }
     } else if ($data=='vll2') {
          echo "<select class='form-control'  name='vll2' >\n";
          echo "<option value=''> เลือกหมู่บ้าน</option>\n";
          $val2 = substr($val,6,2);
          $val = substr($val,0,6);
          $result=mysqli_query($conn,"select vllidgen,concat(vllidgen,':',vllnmegen) as vllnmegen from const_vllnmegen where concat(prvidgen,ampidgen,tmbidgen)='$val' order by vllidgen");
	      while(list($id, $name)=mysqli_fetch_array($result)){
		  	   if($val2==$id){
               	echo "<option value=\"$id\" selected>$name</option> \n";
			   }else{
			    echo "<option value=\"$id\" >$name</option> \n";
			   }
          }
     }
     echo "</select>\n";
//=========================================================================================================================================================================
//set province amphur tambon and village for person in address2
} else if($adr=='adr3'){
   if ($data=='province3') {
          echo "<select class='form-control' name='province3' onChange=\"dochange('district3', this.value,'adr3');\">\n";
          echo "<option value=''> เลือกจังหวัด</option>\n";
          $result=mysqli_query($conn,"select distinct prvidgen,prvnmegen from const_plcnmegen order by prvidgen");
          while(list($id, $name)=mysqli_fetch_array($result)){
		  	   if($val==$id){
               		echo "<option value=\"$id\" selected>$name</option> \n" ;
			   }else{
               		echo "<option value=\"$id\" >$name</option> \n" ;
			   }
          }
   }else if ($data=='district3') {
          echo "<select class='form-control' name='district3' id='district3' onChange=\"dochange('subdist3', this.value,'adr3')\">\n";
          echo "<option value=''> เลือกอำเภอ</option>\n";
          $val2=$val;
          $val = substr($val,0,2);
          $result=mysqli_query($conn,"select distinct concat(prvidgen,ampidgen) as ampidgen,ampnmegen from const_plcnmegen where left(plcidgen,2)='$val' order by ampidgen");
          while(list($id, $name)=mysqli_fetch_array($result)){
		  	   if($val2==$id){
               	  echo "<option value=\"$id\" selected>$name</option> \n" ;
			   }else{
               	  echo "<option value=\"$id\" >$name</option> \n" ;
			   }
          }
     } else if ($data=='subdist3') {
          echo "<select class='form-control'  name='subdist3' id='subdist3' onChange=\"dochange('vll3', this.value,'adr3')\">\n";
          echo "<option value=''> เลือกตำบล</option>\n";
          $val2=$val;
          $val = substr($val,0,4);
          $result=mysqli_query($conn,"select distinct plcidgen as tmbidgen,tmbnmegen from const_plcnmegen where left(plcidgen,4)='$val' order by plcidgen");
	      while(list($id, $name)=mysqli_fetch_array($result)){
		  	   if($val2==$id){
               	echo "<option value=\"$id\" selected>$name</option> \n";
			   }else{
			    echo "<option value=\"$id\" >$name</option> \n";
			   }
          }
     } else if ($data=='vll3') {
          echo "<select class='form-control'  name='vll3' >\n";
          echo "<option value=''> เลือกหมู่บ้าน</option>\n";
          $val2 = substr($val,6,2);
          $val = substr($val,0,6);
          $result=mysqli_query($conn,"select vllidgen,concat(vllidgen,':',vllnmegen) as vllnmegen from const_vllnmegen where concat(prvidgen,ampidgen,tmbidgen)='$val' order by vllidgen");
	      while(list($id, $name)=mysqli_fetch_array($result)){
		  	   if($val2==$id){
               	echo "<option value=\"$id\" selected>$name</option> \n";
			   }else{
			    echo "<option value=\"$id\" >$name</option> \n";
			   }
          }
     }
     echo "</select>\n";
}
?>