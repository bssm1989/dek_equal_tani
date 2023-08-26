<?php 
    session_start();
    $ofcid   = $_SESSION['ofcid'];

    //$sql = "select ofcid,username,ofcnme,schnme,email,updated_at,permission "; //pid,
    $sql = "SELECT a.ofcid,a.`usrnme`,`ofcnme` AS nme,`email`,e.`optnme`,`updated_at`,`status`
    FROM `ofc` a INNER JOIN opt e ON a.optid = e.optid 
    ORDER BY updated_at DESC";
    $results = mysqli_query($conn,$sql);
    // echo $sql;
?>
<!-- <h4 class="card-header text-right"><i class="fas fa-list"></i> จัดการข้อมูลผู้แลระบบ</h4> -->
<div class="row justify-content-between card-header text-right mb-0">
    <div class="col-auto">
        <h4 class="app-page-title mb-0"> จัดการข้อมูลผู้แลระบบ</h4>
    </div>
    <div class="col-auto">
        <a href="?page=<?=$_GET['page']?>&function=add" class="btn btn-primary text-white"><i class="fas fa-plus"></i>
            เพิ่มข้อมูลใหม่</a>
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
                                    <th class="align-middle text-center" scope='col'>ชื่อผู้ใช้งาน</th>                                   
                                    <th class="align-middle text-center" scope='col'>ชื่อ-นามสกุลและหน่วยงาน</th>
                                    <th class="align-middle text-center" scope='col'>ใช้งานล่าสุด</th>
                                    <th class="align-middle text-center" scope='col'>สถานะ</th>
                                    <th class="align-middle text-center" scope='col'>จัดการ</th>                              
                                </tr>
                            </thead>
                            <tbody>
                                <!-- //$n = 0; -->
                                <?php foreach($results as $rows):
                                    if($rows["status"]=="2"){
                                        $ofc_status = "ปิด";
                                    }else if($rows["status"]=="1"){
                                        $ofc_status = "เปิด";
                                    }else {
                                        $ofc_status = "รออนุมัติ";
                                    }
                                ?>
                                <tr>
                                    <td class="align-middle text-center"><?=++$n?></td>
                                    <td class="align-middle text-start"><?=$rows['usrnme']?></td>
                                    <td class="align-middle text-start"><?=$rows['nme']?><br><?=$rows['optnme']?></td>
                                    <td class="align-middle text-center"><?=dateThai($rows['updated_at'])?></td>
                                    <!-- <td class="align-middle text-center"><?=($rows['status'] == '1' ? '<span class="badge bg-primary text-which">ออนไลน</span>':'<span class="badge badge-info">ปิด</span>')?>
                                    </td> -->
                                    <td class="align-middle text-center"><?php echo $ofc_status; ?></td>
                                    <td class="align-middle text-center">
                                        <div class="btn-group" role="group">
                                            <a href="?page=<?=$_GET['page']?>&function=update&id=<?=$rows['ofcid']?>"
                                                type="button" class="btn btn-sm btn-warning text-white">
                                                <i class="far fa-edit"></i>
                                            </a>
                                            <a href="#"
                                                onClick="if(confirm('ต้องการลบข้อมูล <?=$rows['username']?> หรือไม่')==true) delUser(<?=$rows['ofcid']?>);"
                                                type='button' class="btn btn-sm btn-danger text-white">
                                                <i class="far fa-trash-alt"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                    <!-- </form> -->                    
                </form>
            </div>
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

function delUser(ofcid) {
    var xmlhttp = Inint_AJAX();
    var Url = "./managers/user_form_crud.php";
    //alert("xxxxxxxxxxx");
    var POSTBody = "";
    POSTBody += "ofcid=" + ofcid;
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
                timer: 5000
            })
            window.history.replaceState(null, null, window.location.reload());
            //$("#frmUser")[0].reset(); // reset form

        }
    }
};
</script>