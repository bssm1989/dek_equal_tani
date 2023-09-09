<?php 
    @session_start();
    $optid = $_SESSION['optid'];

    $sql = "SELECT q.`qtn_visid`,a.perid,a.pid,CONCAT(prenme,nme,' ',surnme) AS nme,a.sex,a.brtdte,p.roladr,p.rolvllno,e.plcnmegen AS rolplc,a.tel,o.optnme,t.pertypnme,
    `qtn_assessor`,`pos_ofcid`,`qtn_round`,`qtn_date`,`qtnvs1`,`qtnvs2`,`qtnvs3`,`qtnvs4`,`qtnvs5`,`qtnvs6`,`qtnvs7`,`qtnvs8`,`qtnvs_sum`,`qtnvsoth`,
    CONCAT(o1.`ofcnme`) AS savofc,p.savdte,CONCAT(o2.`ofcnme`) AS updofc,p.upddte 
    FROM `questionnaire_visit` q INNER JOIN person a ON q.perid = a.perid
    LEFT JOIN `person_qtn_additional` p ON a.perid = p.perid
    LEFT JOIN `const_plcnmegen` e ON p.rolplcid=e.plcidgen
    LEFT JOIN `const_prenme` pre ON a.preid=pre.preid 
    LEFT JOIN opt o ON a.optid = o.optid 
    LEFT JOIN `const_pertyp` t ON p.pertypid = t.pertypid
    LEFT JOIN ofc o1 ON o1.ofcid=p.savofc
    LEFT JOIN ofc o2 ON o2.ofcid=p.updofc";
    $sql.= " where a.optid=$optid";
    $sql.= " order by qtn_date DESC";
    $results = mysqli_query($conn,$sql);
?>
<div class="row justify-content-between card-header text-right mb-0">
    <div class="col-auto">
        <h4 class="app-page-title mb-0"> ข้อมูลติดตามสุขภาวะผู้เปราะบาง</h4>
    </div>
    <div class="col-auto">
        <a href="?page=<?=$_GET['page']?>&function=add" class="btn btn-primary text-white"><i class="fas fa-plus"></i>
            เพิ่มข้อมูลใหม่</a>
    </div>
</div>
<hr class="mb-0">
<div class="row g-2 settings-section">
    <div class="col-12 col-md-12">
        <div class="app-card app-card-settings shadow-sm p-4">

            <div class="app-card-body">
                <form name="frmUserSearch" id="frmUserSearch" method="post" action="" enctype="" onSubmit="" target="">
                    <table class="table" id="myTableAll">
                        <thead class="table-light">
                            <tr>
                                <th class="align-middle text-center" scope='col'>#</th>
                                <!-- <th class="align-middle text-center" scope='col'>เลขบัตรประชาชน</th> -->
                                <th class="align-middle text-start" scope='col'>ชื่อ-นามสกุล</th>
                                <th class="align-middle text-center" scope='col'>อายุ (ปี.เดือน)</th>
                                <th class="align-middle text-start" scope='col'>ที่อยู่ตามภูมิลำเนาทะเบียนบ้าน</th>
                                <th class="align-middle text-center" scope='col'>ประเภทกลุ่มเปราะบาง</th>
                                <th class="align-middle text-center" scope='col'>ครั้งที่</th>
                                <th class="align-middle text-center" scope='col'>วันที่</th>
                                <th class="align-middle text-center" scope='col'>การดำเนินการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- ?php $n = 0; ?> -->
                            <?php foreach($results as $rows):
                                //$fno			= ++$n;
                                $perid 			= $rows["perid"];
                                //$pid			= $rows["pid"];
                                $nme			= $rows["nme"];
                                $brtdte         = $rows["brtdte"];
                                $age_now        = getAge($rows["brtdte"]);
                                $plcnme2 		= $rows["rolplc"];
                                $vllno2 		= $rows["rolvllno"];
                                $roladr 		= $rows["roladr"];  
                                $qtn_date    	= getDateTimeDMY($rows["qtn_date"]);                
                            
                                $plc2 =$roladr." ม.".$vllno2." ".$plcnme2;
                            ?>
                            <tr>
                                <td class="align-middle text-center"><?=++$n?></td>
                                <td class="align-middle text-start"><?php echo $nme; ?></td>
                                <td class="align-middle text-center"><?php echo $age_now; ?></td>
                                <td class="align-middle text-center"><?php echo $plc2; ?></td>
                                <td class="align-middle text-center"><?=$rows['pertypnme']?></td>
                                <td class="align-middle text-center"><?=$rows['qtn_round']?></td>
                                <td class="align-middle text-center"><?php echo $qtn_date; ?></td>
                                <td class="align-middle text-center">
                                    <div class="btn-group" role="group">
                                        <a href="?page=<?=$_GET['page']?>&function=update&id=<?=$rows['qtn_visid']?>"
                                            type="button" class="btn btn-sm btn-warning text-white">
                                            <i class="far fa-edit"></i>
                                        </a>
                                        <a href="#"
                                            onClick="if(confirm('ต้องการลบข้อมูล <?=$rows['nme']?> หรือไม่')==true) delUser(<?=$rows['qtn_visid']?>);"
                                            type='button' class="btn btn-sm btn-danger text-white">
                                            <i class="far fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                    <!-- </form> -->
                </form>
                <!--//app-card-body-->

            </div>
            <!--//app-card-body-->
        </div>
        <!--//app-card-->
    </div>
</div>
<!--//row-->
<?php 
    mysqli_close($conn);
?>
<script language=Javascript>
$(document).ready(function() {
    $('#myTableAll').DataTable({
        language: {
            "lengthMenu": "แสดงข้อมูล _MENU_ แถว",
            "zeroRecords": "ไม่พบข้อมูลที่ต้องการ",
            //"info": "แสดงหน้า _PAGE_ จาก _PAGES_",
            "info": "แสดง _START_ - _END_ จากทั้งหมด _TOTAL_ รายการ",
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

function delUser(qtn_visid) {
    var xmlhttp = Inint_AJAX();
    var Url = "./visit/qtn_visit_crud.php";
    //alert("xxxxxxxxxxx");
    var POSTBody = "";
    POSTBody += "qtn_visid=" + qtn_visid;
    POSTBody += "&act=delete";
    //alert(POSTBody);
    xmlhttp.open('POST', Url, true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(POSTBody);
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            //eval("var decoded_data = "+xmlhttp.responseText);
            //window.document.frmUser.perid.value = decoded_data['perid0'];
            //window.document.getElementById('showSql').innerHTML=xmlhttp.responseText;
            //clearForm();
            //alert("ลบข้อมูลเรียบร้อยแล้ว");
            Swal.fire({
                text: 'ลบข้อมูลเรียบร้อยแล้ว',
                icon: 'success',
                showConfirmButton: false,
                timer: 15000
            })
            window.history.replaceState(null, null, window.location.reload());
            //$("#frmUser")[0].reset(); // reset form

        }
    }
};

function clearForm() {
    //window.document.frmEnroll.reset();
    form.reset();
    location.reload();

};

function createFile() {
    var xmlhttp = Inint_AJAX();
    var Url = "./qtn_teachers/qtn_teachers_create_file.php";
    // alert("xxxxxxxxxxx");
    var POSTBody = "";
    POSTBody += "enroll_year=" + document.frmUserSearch.enroll_year.value;
    POSTBody += "&room_id=" + document.frmUserSearch.room_id.value;

    POSTBody += "&act=save";
    // alert(POSTBody);
    xmlhttp.open('POST', Url, true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(POSTBody);
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            // window.document.getElementById('showSql').innerHTML=xmlhttp.responseText; // แสดงบนหน้าจอ
            eval("var decoded_data = " + xmlhttp.responseText);
            if (decoded_data['checkSave'] == "yes") {
                window.location.href = './qtn_teachers/qtn_teachers_export_file.php?action=Export';
                alert("สร้างข้อมูลเรียบร้อยแล้ว");
                // window.document.getElementById('showSql').innerHTML=xmlhttp.responseText; // แสดงบน co
            } else alert('ไม่สามารถนำออกเป็นไฟล์ EXCEL ได้ กรุณาคลิกเลือกข้อมูลปีการศึกษาก่อน');
        } //else alert(
        // 'ไม่สามารถบันทึกข้อมูลได้ เนื่องจากเลขบัตรประชาชนนี้ซ้ำกับบุคคลอื่นที่อยู่ในฐานข้อมูล กรุณาตรวจสอบข้อมูลก่อนค่ะ/ครับ'
        //);
    }
};
</script>