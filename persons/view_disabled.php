<?php 
    @session_start();
    $optid = $_SESSION['optid'];

    $sql = "SELECT a.perid,a.pid,CONCAT(prenme,a.nme,' ',a.surnme) AS nme,brtdte,
    b.roladr,b.rolvllno,plcnmegen,b.pertypid,pertypnme 
    FROM person a LEFT JOIN person_qtn_additional b ON a.perid = b.perid
    LEFT JOIN const_plcnmegen e ON b.rolplcid=e.plcidgen 
    LEFT JOIN const_prenme pre ON a.preid=pre.preid 
    LEFT JOIN const_pertyp pt ON b.pertypid=pt.pertypid 
    WHERE b.pertypid='2' AND b.pertypid <> '' and optid = $optid
    ORDER BY nme,surnme";
    //echo $sql;
    $results = mysqli_query($conn,$sql);
?>
<!-- <h4 class="card-header text-right"><i class="fas fa-list"></i> จัดการข้อมูลลงทะเบียน</h4> -->
<div class="row justify-content-between card-header text-right mb-0">
    <div class="col-auto">
        <h4 class="app-page-title mb-0"> ข้อมูลกลุ่มเปราะบาง :: คนพิการ</h4>
    </div>
    <div class="col-auto">
        <!-- <a href="?page=<?=$_GET['page']?>&function=add" class="btn btn-primary text-white"><i class="fas fa-plus"></i>
            เพิ่มข้อมูลใหม่</a> -->
    </div>
</div>
<hr class="mb-0">
<div class="row g-4 settings-section">
    <div class="col-12 col-md-12">
        <div class="app-card app-card-settings shadow-sm p-4">
            <div class="app-card-body">
                <form name="frmUserSearch" id="frmUserSearch" method="post" action="" enctype="" onSubmit="" target="">
                    <div class="table-responsive-sm">
                        <table class="table" id="myTableAll">
                            <thead class="table-light">
                                <tr>
                                    <th class="align-middle text-center" scope='col'>#</th>
                                    <!-- <th class="align-middle text-center" scope='col'>เลขบัตรประชาชน</th> -->
                                    <th class="align-middle text-start" scope='col'>ชื่อ-นามสกุล</th>
                                    <th class="align-middle text-center" scope='col'>อายุ (ปี.เดือน)</th>
                                    <th class="align-middle text-start" scope='col'>ที่อยู่ตามภูมิลำเนาทะเบียนบ้าน</th>
                                    <!-- <th class="align-middle text-center" scope='col'>ประเภทกลุ่มเปราะบาง</th> -->
                                    <th class="align-middle text-center" scope='col'>การดำเนินการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- ?php $n = 0; ?> -->
                                <?php foreach($results as $rows):
                                // $fno				= ++$n;
                                $perid 			= $rows["perid"];
                                //$pid			= $rows["pid"];
                                $nme			= $rows["nme"];
                                $surnme			= $rows["surnme"];
                                $brtdte         = $rows["brtdte"];
                                $age_now        = getAge($rows["brtdte"]);
                                $plcnme2 		= $rows["plcnmegen"];
                                $vllno2 		= $rows["rolvllno"];
                                $roladr 		= $rows["roladr"];

                                $plc2 =$roladr." ม.".$vllno2." ".$plcnme2;
                            ?>
                                <tr>
                                    <td class="align-middle text-center"><?=++$n?></td>
                                    <!-- <td class="align-middle text-center"><?=$rows['pid']?></td> -->
                                    <td class="align-middle text-start"><?=$rows['nme']?></td>
                                    <td class="align-middle text-center"><?php echo $age_now; ?></td>
                                    <td class="align-middle text-start"><?php echo $plc2; ?></td>
                                    <!-- <td class="align-middle text-center"><?=$rows['pertypnme']?></td> -->
                                    <td class="align-middle text-center">
                                        <div class="btn-group" role="group">
                                            <a href="?page=<?=$_GET['page']?>&function=add&id=<?=$rows['perid']?>"
                                                type="button" class="btn btn-sm btn-warning text-white">
                                                <i class="far fa-edit"></i>
                                            </a>
                                        </div>
                                    </td>
                                    <!-- <td>
                                        <div class="btn-group" role="group">
                                            <a href="?page=<?=$_GET['page']?>&function=update&id=<?=$rows['perid']?>"
                                                type="button" class="btn btn-sm btn-warning text-white">
                                                <i class="far fa-edit"></i>
                                            </a>
                                            <a href="#"
                                                onClick="if(confirm('ต้องการลบข้อมูลหรือไม่')==true) delUser(<?=$rows['perid']?>);"
                                                type='button' class="btn btn-sm btn-danger text-white">
                                                <i class="far fa-trash-alt"></i>
                                            </a>
                                        </div>
                                    </td> -->
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                    <!-- </form> -->
                </form>
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

function delUser(perid) {
    var xmlhttp = Inint_AJAX();
    var Url = "./persons/person_form_crud.php";
    //alert("xxxxxxxxxxx");
    var POSTBody = "";
    POSTBody += "perid=" + perid;
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
</script>