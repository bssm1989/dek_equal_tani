<?php
//require_once("./checkpermission.php"); //เอาไว้บรรทัดแรกของ page เสมอ
require '../service/connect.php';
require '../service/commonFns.php';

$pid = trim($_GET["pid"]);
$nme 	= trim($_GET["nme"]);
$surnme = trim($_GET["surnme"]);
$perid = $_GET["perid"];

if($pid){	
	$sql = "SELECT a.perid,a.pid,CONCAT(prenme,nme,' ',surnme) AS nme,a.sex,p.roladr,p.rolvllno,e.plcnmegen AS rolplc,a.tel
    FROM person a 
    LEFT JOIN `person_qtn_additional` p ON a.perid = p.perid
    LEFT JOIN `const_plcnmegen` e ON p.rolplcid=e.plcidgen
    LEFT JOIN `const_prenme` pre ON a.preid=pre.preid ";
	$sql.= " where a.pid='$pid' and a.pid <>'' and a.perid<>'$perid'";
    $result = mysqli_query($conn,$sql);
    $numRows = @mysqli_num_rows($result);
}

if(($nme)|($surnme)){	
	$sql = "SELECT a.perid,a.pid,CONCAT(prenme,nme,' ',surnme) AS nme,a.sex,p.roladr,p.rolvllno,e.plcnmegen AS rolplc,a.tel
    FROM person a 
    LEFT JOIN `person_qtn_additional` p ON a.perid = p.perid
    LEFT JOIN `const_plcnmegen` e ON p.rolplcid=e.plcidgen
    LEFT JOIN `const_prenme` pre ON a.preid=pre.preid ";
	$sql.= " where nme like '%$nme%' and surnme like '%$surnme%' and a.perid<>'$perid'";
    $result = mysqli_query($conn,$sql);
    $numRows = @mysqli_num_rows($result);
    // echo $sql;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">
    <link rel="shortcut icon" href="./upload/admin/favicon.ico">
    <!-- FontAwesome JS-->
    <script defer src="../assets/assets/plugins/fontawesome/js/all.min.js"></script>

    <!-- App CSS -->
    <link id="theme-style" rel="stylesheet" href="../assets/assets/css/portal.css">

    <!-- App datatables CSS -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="../service/js/jquery-2.1.1.min.js"></script>
    <script language="javascript" src="../service/js/jscommonFns.js"></script>
    <!--?php function popup here?-->
    <script language=Javascript>
    function Inint_AJAX() {
        try {
            return new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {} //IE
        try {
            return new ActiveXObject("Microsoft.XMLHTTP");
        } catch (e) {} //IE
        try {
            return new XMLHttpRequest();
        } catch (e) {} //Native Javascript
        alert("XMLHttpRequest not supported");
        return null;
    };

    //ฟังก์ชันเพื่อเลือกจังหวัด อำเภอ ตำบล และหมุ่บ้าน
    function dochange(src, val, adr) {
        var req = Inint_AJAX();
        req.onreadystatechange = function() {
            if (req.readyState == 4) {
                if (req.status == 200) {
                    document.getElementById(src).innerHTML = req.responseText; //รับค่ากลับมา
                }
            }
        };
        //req.open("GET", "getplcnme.php?data=" + src + "&val=" + val + "&adr=" + adr); //สร้าง connection
        req.open("GET", "./service/getplcnme.php?data=" + src + "&val=" + val + "&adr=" + adr); //สร้าง connection
        req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=tis-620"); // set Header
        req.send(null); //ส่งค่า
    }
    </script>



</head>

<body class="app">
    <!--//app-wrapper-->
    <div class="app-wrapper">
        <!--//app-content-->
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <form name="" id="" action="" method="post">
                    <?php
                        if($numRows){
                    ?>
                    <h4>บุคคลที่มี &quot;เลขบัตรประชาชน&quot; เหมือนกัน หรือ &quot;ชื่อ-สกุล&quot; คล้ายกัน</h4>
                    <table class="table table-bordered">
                        <tr><strong>ผลการค้นหาบุคคล</strong></tr>
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">เลขบัตรประชาชน</th>
                                <th scope="col">ชื่อ-นามสกุล</th>                               
                                <th scope="col">ที่อยู่ตามภูมิลำเนาทะเบียนบ้าน</th>
                                <th scope="col">เลือก</th>
                            </tr>
                        </thead>
                        <!-- เริ่มวนรอบแสดงข้อมูล -->
                    <?php
                        $n = 0;
                        while ($rows = mysqli_fetch_array($result)) 
                        {
                            $fno			= ++$n;
                            $perid   		= $rows["perid"];
                            $pid     		= $rows["pid"];
                            $nme     		= $rows["nme"];
                            
                            $roladr      	= $rows["roladr"];
                            $rolvllsoi  	= $rows["rolvllsoi"];
                            $rolvllno   	= $rows["rolvllno"];
                            $rolplcid   	= $rows["rolplcid"];
                            $rolplc     	= $rows["rolplc"];

                            if(!$rolvllno || $rolvllno=='0'){
                                $rolvllno = " ";
                            }else{
                                $rolvllno = "ม.".$rolvllno;
                            }

                            if(!$roladr){
                                $roladr = 'ไม่ระบุ';
                            }else{
                                $roladr = " ";
                            } 

                            if(!$rolvllsoi){
                                $rolvllsoi = " ";
                            }else{
                                $rolvllsoi = " ถนน/ซอย ".$rolvllsoi;
                            }  
                            
                            $plc2			= $roladr." ".$rolvllno." ".$rolvllsoi." ".$rolplc;                      
                    ?>
                    <tbody>
                        <th scope="row"><?php echo $fno ?></th>
                        <th><?php echo $pid ?></th>
                        <td><?php echo $nme ?></td>
                        <td><?php echo $plc2 ?></td>
                        <?php
                        //<td><button class="btn btn btn-light" onclick= "return sendValue('$stu_id')"><i class="far fa-eye"></i></button></td>  ,'".$pernme."'
                            echo "    <td><button class='btn btn btn-light' onclick=\"return sendValue('".$perid."');\"><i class='far fa-edit'></i></button></td>"; //,'".$prv2."','".$amp2."','".$tmb2."','".$vll2."'
                        //echo "    <td><button class='btn btn btn-light' onclick=\"return sendValue('".$stu_id."','".$stu_preid."','".$stu_name."','".$stu_surname."','".$stu_nickname."','".$brtdte."','".$stu_age."','".$stu_sex."','".$stu_born_in."','".$stu_blood_grp."','".$stu_stature."','".$stu_weight."','".$stu_race."','".$stu_nationality."','".$stu_religion."','".$stu_congenital."','".$stu_foodallergy."','".$stu_roladr."','".$stu_rolvllsoi."','".$prv2."');\"><i class='far fa-eye'></i></button></td>"; //,'".$prv2."','".$amp2."','".$tmb2."','".$vll2."'
                        ?>
                        </tr>
                        <?php } ?>
                        <!-- close while -->
                    </tbody>
                </table>

                <?php
                } else { echo "<br><br><br><h2>ไม่ปรากฏบุคคลที่มี &quot;เลขบัตรประชาชน&quot; เหมือนกัน</h2>";
                            echo "<h2>หรือ &quot;ชื่อ-สกุล&quot; คล้ายกัน</h2>";}
                ?>
                </form>


            </div>
            <!--//container-fluid-->
        </div>
        <!--//app-footer-->
    </div>
    <!-- Javascript -->
    <!-- Javascript -->
    <script src="../assets/assets/plugins/popper.min.js"></script>
    <script src="../assets/assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- Charts JS -->
    <script src="../assets/assets/plugins/chart.js/chart.min.js"></script>
    <!-- <script src="../../assets/assets/js/index-charts.js"></script> -->

    <!-- Page Specific JS -->
    <script src="../assets/assets/js/app.js"></script>

    <!-- datatables JS -->
    <script src="//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
</body>

</html>

<script type="text/javascript">
function sendValue(e1) {

    //window.opener.close();
    window.opener.location.reload(true);
    window.close();
    // window.document.location.href="../?page=enrolls&function=add"+"&stu_id="+e1;
    window.open("../?page=persons&function=add&id=" + e1);
    // window.location.href = "../?page=enrolls&function=add&stu_id=" + e1;
    // window.location.pathname = '../?page=enrolls&function=add&stu_id=' + e1;
    //window.open ("enroll_form.php?id="+e1, "OpenerTest", "width=300, height=200");
   
}
</script>

<script language=Javascript>
//function sendValue(e1,e2,e3,e4,e5,e6,e7,e8,e9,e10,e11,e12,e13,e14,e15,e16,e17,e18,e19,e20){ //,e21,e22,e23
// function sendValue(e1){ 
//     window.opener.close();
// 	window.close();
// 	window.open("enroll_form.php?id="+e1);
//alert("xxxxx0 = "+e20+" xxxxx1 = "+e21+" xxxxx2 = "+e22+" xxxxx3 = "+e23);
//alert("xxxxx0 = "+e1);
//window.document.location.href="enroll_form.php?id="+e1;
//window.opener.close();
// window.close();
//window.open('enroll_form.php?id='+e1, { target: '_self', href: 'URL_HERE'}); //_blank
//window.close(); 
//var redirectWindow = window.open('enroll_form.php?id='+e1, '_blank');
//redirectWindow.location;
//window.open('enroll_form.php?id='+e1,'_blank');
//window.close();

/* window.opener.document.getElementById('stu_id').value = e1;
		window.opener.document.getElementById('stu_pre').value = e2;
        window.opener.document.getElementById('stu_name').value = e3;
        window.opener.document.getElementById('stu_surname').value = e4;
        window.opener.document.getElementById('stu_nickname').value = e5;
        window.opener.document.getElementById('testdate1').value = e6;
        window.opener.document.getElementById('stu_age').value = e7;
        if(e8 = '1'){
            window.opener.document.getElementById('sex1').value = e8;
        }else{
            window.opener.document.getElementById('sex2').value = e8;
        }
        window.opener.document.getElementById('stu_born_in').value = e9;
        window.opener.document.getElementById('stu_blood_grp').value = e10;
        window.opener.document.getElementById('stu_stature').value = e11;
        window.opener.document.getElementById('stu_weight').value = e12;
        window.opener.document.getElementById('stu_race').value = e13;
        window.opener.document.getElementById('stu_nationality').value = e14;
        window.opener.document.getElementById('stu_religion').value = e15;
        window.opener.document.getElementById('stu_congenital').value = e16;
        window.opener.document.getElementById('stu_foodallergy').value = e17;
        window.opener.document.getElementById('stu_roladr').value = e18;
        window.opener.document.getElementById('stu_rolvllsoi').value = e19;
        
        window.opener.document.getElementById(province2).sendValue = e20;
        // window.opener.document.getElementById('district2') = e21;
        // window.opener.document.getElementById('subdist2') = e22;
        // window.opener.document.getElementById('vll2') = e20;*/
//window.close(); 

// }
</script>