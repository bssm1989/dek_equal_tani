<?php
    @session_start();
    require '../service/connect.php';
    require '../service/commonFns.php';
    $optid = $_SESSION['optid'];

    $sql = "SELECT a.perid,a.pid,CONCAT(prenme,nme,' ',surnme) AS nme,a.sex,a.brtdte,p.roladr,p.rolvllno,e.plcnmegen AS rolplc,a.tel,o.optnme,t.pertypnme
    FROM person a 
    LEFT JOIN `person_qtn_additional` p ON a.perid = p.perid
    LEFT JOIN `const_plcnmegen` e ON p.rolplcid=e.plcidgen
    LEFT JOIN `const_prenme` pre ON a.preid=pre.preid 
    LEFT JOIN opt o ON a.optid = o.optid 
    LEFT JOIN `const_pertyp` t ON p.pertypid = t.pertypid";
    $sql.= " where a.optid=$optid";
    $sql.= " order by nme";
    $results = mysqli_query($conn,$sql);
    // echo $sql;
?>
<!doctype html>
<html lang="th">

<head>
    <!-- ?php require '../includes/head.php'; ?> -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลบุคคล</title>

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
        req.open("GET", "../service/getplcnme.php?data=" + src + "&val=" + val + "&adr=" + adr); //สร้าง connection
        req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=tis-620"); // set Header
        req.send(null); //ส่งค่า
    }

    // function showPerson(page, perPage) {
    //     var xmlhttp = Inint_AJAX();
    //     var Url = "select_parents.php";
    //     //alert("xxxxxxxxxxx");

    //     var POSTBody = "";
    //     POSTBody += "province2=" + window.document.frmSearchPerson.province2.value;
    //     POSTBody += "&district2=" + window.document.frmSearchPerson.district2.value;
    //     POSTBody += "&subdist2=" + window.document.frmSearchPerson.subdist2.value;
    //     POSTBody += "&vll2=" + window.document.frmSearchPerson.vll2.value;
    //     POSTBody += "&perid=" + window.document.frmSearchPerson.perid.value;
    //     POSTBody += "&pid=" + window.document.frmSearchPerson.pid.value;
    //     POSTBody += "&nme=" + window.document.frmSearchPerson.nme.value;
    //     POSTBody += "&surnme=" + window.document.frmSearchPerson.surnme.value;
    //     POSTBody += "&page=" + page;
    //     POSTBody += "&perPage=" + perPage;

    //     //alert(POSTBody);
    //     xmlhttp.open('POST', Url, true);
    //     xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    //     xmlhttp.send(POSTBody);
    //     xmlhttp.onreadystatechange = function() {
    //         if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
    //             //eval("var decoded_data = "+xmlhttp.responseText);
    //             //window.document.frmPerson.pre_Page.value 	= decoded_data['prePage0'];
    //             //window.document.frmPerson.next_Page.value 	= decoded_data['nextPage0'];
    //             //window.document.frmPerson.num_Page.value 	= decoded_data['numPage0'];
    //             //window.document.getElementById('showLosofper').innerHTML	= decoded_data['showData0'];;
    //             window.document.getElementById('showPerson').innerHTML = xmlhttp.responseText;
    //             //alert("perfect!!");
    //         }
    //     }

    // }

    function sendValue(e1, e2, e3, e4, e5) { 
        //window.opener.document.getElementById('person1').innerHTML = "<b>รหัส</b> "+e1+" "+e2;
        //window.opener.document.getElementById('person2').innerHTML = " <b>ที่อยู่ที่บ้าน</b> "+e3;
        window.opener.document.getElementById('perid').value = e1;
        window.opener.document.getElementById('nme').value = e2;
        window.opener.document.getElementById('age_now').value = e3;
        window.opener.document.getElementById('pertypnme').value = e4;
        window.opener.document.getElementById('optnme').value = e5;
        window.close();
    }


    $(document).ready(function() {
        $('#myTableAll').DataTable({
            language: {
                "lengthMenu": "แสดงข้อมูล _MENU_ แถว",
                "zeroRecords": "ไม่พบข้อมูลที่ต้องการ",
                //"info": "แสดงหน้า _PAGE_ จาก _PAGES_",
                "info": "แสดง _START_ - _END_ จาก _TOTAL_ รายการ",
                "infoEmpty": "ไม่พบข้อมูลที่ต้องการ",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": 'ค้นหา',
                "paginate": {
                    "previous": "ก่อนหน้านี้",
                    "next": "หน้าต่อไป"
                }
            }
        });
    });
    </script>
</head>

<body class="bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12 order-md-4 mb-4">
                <h5 class="justify-content-between card-header text-right mb-3">ข้อมูลบุคคล </h5>                   

                <form class="needs-validation" novalidate name="frmSearchPerson" id="frmSearchPerson" method="post"
                    action="" enctype="" onSubmit="" target="">
                    <table class="table" id="myTableAll">
                        <thead class="table-light">
                            <tr>
                                <th scope='col'>#</th>
                                <th scope='col'>เลขประจำตัวประชาชน</th>
                                <th scope='col'>ชื่อ-นามสกุล อายุ และ ที่อยู่</th>
                                <th scope='col'>ลักษณะบุคคล</th>
                                <th scope='col'>เลือก</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- ?php $n = 0; ?> -->
                            <?php foreach($results as $rows):

                                $perid   		= $rows["perid"];
                                $pid     		= $rows["pid"];
                                $nme     		= $rows["nme"];
                                $age_now        = getAge($rows["brtdte"]);
                                $pertypnme     	= $rows["pertypnme"];
                                $optnme     	= $rows["optnme"];
                                
                                $roladr      	= $rows["roladr"];
                                $rolvllsoi  	= $rows["rolvllsoi"];
                                $rolvllno   	= $rows["rolvllno"];
                                $rolplcid   	= $rows["rolplcid"];
                                $rolplc     	= $rows["rolplc"];
                                // $plc2           = $roladr." ม.".$rolvllno." ".$rolplc;
                                
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
                            <tr>
                                <td><?=++$n?></td>
                                <th><?php echo $pid ?></th>
                                <td><?php echo $nme."  อายุ ".$age_now." ปี" ?><br><?php echo "ที่อยู่ ".$plc2 ?></td>
                                <td><?php echo $pertypnme ?></td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <?php echo "<button class='btn btn btn-light' onclick=\"return sendValue('".$perid."','".$nme."','".$age_now."','".$pertypnme."','".$optnme."');\"><i class='far fa-edit'></i></button>"; ?>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div> <!-- row -->
    </div> <!-- container -->

    <!-- Javascript -->
    <script src="../assets/assets/plugins/popper.min.js"></script>
    <script src="../assets/assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- Charts JS -->
    <script src="../assets/assets/plugins/chart.js/chart.min.js"></script>
    <!-- <script src="../../assets/assets/js/index-charts.js"></script> -->

    <!-- Page Specific JS -->
    <!-- <script src="./../assets/assets/js/app.js"></script> -->

    <!-- datatables JS -->
    <script src="//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

</body>

</html>
<!-- ?php 
    mysqli_close($conn);
?> -->