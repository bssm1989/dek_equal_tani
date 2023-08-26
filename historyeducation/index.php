<?php
@session_start();
$optid = $_SESSION['optid'];

// Your database connection code here

$sql = "SELECT
h.perid,
CONCAT(p.name, ' ', p.sname) AS person_fullname,
h.heduid,
e.edulevnme,
h.edusemester,
h.edugrade,
h.edudetail
FROM
hedu AS h
JOIN
person AS p ON h.perid = p.perid
JOIN
edulev AS e ON h.eduid = e.eduid;";

$results = mysqli_query($conn, $sql);
?>
<div class="row justify-content-between card-header text-right mb-0">
    <div class="col-auto">
        <h4 class="app-page-title mb-0">ข้อมูลประวัติการศึกษา</h4>
    </div>
    <div class="col-auto">
        <a href="?page=<?= $_GET['page'] ?>&function=add" class="btn btn-primary text-white"><i class="fas fa-plus"></i>
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
                                <th class="align-middle text-start" scope='col'>รหัสบุคคล</th>
                                <th class="align-middle text-start" scope='col'>ชื่อ-นามสกุล บุคคล</th>
                                <th class="align-middle text-start" scope='col'>รหัสประวัติการศึกษา</th>
                                <th class="align-middle text-start" scope='col'>ระดับการศึกษา</th>
                                <th class="align-middle text-start" scope='col'>ปีการศึกษา</th>
                                <th class="align-middle text-start" scope='col'>เกรดเฉลี่ย</th>
                                <th class="align-middle text-start" scope='col'>รายละเอียดอื่น ๆ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $counter = 1;
                            while ($row = mysqli_fetch_assoc($results)) {
                                echo "<tr>";
                                echo "<td class='align-middle text-center'>" . $counter . "</td>";
                                echo "<td class='align-middle text-start'>" . $row['perid'] . "</td>";
                                echo "<td class='align-middle text-start'>" . $row['person_fullname'] . "</td>";
                                echo "<td class='align-middle text-start'>" . $row['heduid'] . "</td>";
                                echo "<td class='align-middle text-start'>" . $row['edulevnme'] . "</td>";
                                echo "<td class='align-middle text-start'>" . $row['edusemester'] . "</td>";
                                echo "<td class='align-middle text-start'>" . $row['edugrade'] . "</td>";
                                echo "<td class='align-middle text-start'>" . $row['edudetail'] . "</td>";
                                echo "</tr>";
                                $counter++;
                            }
                            ?>
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