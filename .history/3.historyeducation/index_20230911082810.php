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
                <div class="row g-2">
                    <div class="col-12 col-md-6">
                        <label for="searchBoxPersonID" class="form-label">ค้นหารหัสบุคคล:</label>
                        <input type="text" class="form-control" id="searchBoxPersonID" placeholder="พิมพ์รหัสบุคคลที่ต้องการค้นหา...">
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="searchBoxPID" class="form-label">ค้นหาเลขบัตรประชาชน:</label>
                        <input type="text" class="form-control" id="searchBoxPID" placeholder="พิมพ์เลขบัตรประชาชนที่ต้องการค้นหา...">
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="searchBoxTitlename" class="form-label">ค้นหาคำนำหน้าชื่อ:</label>
                        <input type="text" class="form-control" id="searchBoxTitlename" placeholder="พิมพ์คำนำหน้าชื่อที่ต้องการค้นหา...">
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="searchBoxName" class="form-label">ค้นหาชื่อ:</label>
                        <input type="text" class="form-control" id="searchBoxName" placeholder="พิมพ์ชื่อที่ต้องการค้นหา...">
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="searchBoxSurname" class="form-label">ค้นหาสกุล:</label>
                        <input type="text" class="form-control" id="searchBoxSurname" placeholder="พิมพ์สกุลที่ต้องการค้นหา...">
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col-12 col-md-6">
                        <label for="searchBox" class="form-label">ค้นหาลักษณะความเหลื่อมล้ำ:</label>
                        <input type="text" class="form-control" id="searchBox" placeholder="พิมพ์คำที่ต้องการค้นหา...">
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="dispfrmnmeDropdown" class="form-label">ลักษณะความเหลื่อมล้ำ:</label>
                        <select class="form-select" id="dispfrmnmeDropdown">
                            <!-- Dropdown options will be populated dynamically using JavaScript -->
                        </select>
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col-12 col-md-6">
                        <label for="searchBoxEduLevel" class="form-label">ค้นหาระดับการศึกษา:</label>
                        <input type="text" class="form-control" id="searchBoxEduLevel" placeholder="พิมพ์ระดับการศึกษาที่ต้องการค้นหา...">
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="edulevDropdown" class="form-label">ระดับการศึกษา:</label>
                        <select class="form-select" id="edulevDropdown">
                            <!-- Dropdown options will be populated dynamically using JavaScript -->
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="searchBoxProvince" class="form-label">จังหวัด,อำเภอ,ตำบล:</label>
                        <input type="text" class="form-control" id="searchBoxProvince" placeholder="พิมพ์จังหวัด,อำเภอ,ตำบลที่ต้องการค้นหา...">
                    </div>
                </div>

                <form name="frmUserSearch" id="frmUserSearch" method="post" action="" enctype="" onSubmit="" target="">
                    <table id="myTableAll" class="display responsive nowrap" style="width:100%">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>รหัสบุคคล</th>
                                <th>ชื่อ-นามสกุล บุคคล</th>
                                <!-- <th>รหัสประวัติการศึกษา</th> -->
                                <th>ระดับการศึกษา</th>
                                <th>ปีการศึกษา</th>
                                <th>เกรดเฉลี่ย</th>
                                <th>รายละเอียดอื่น ๆ</th>
                                <th>แก้ไข</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $counter = 1;
                            while ($row = mysqli_fetch_assoc($results)) {
                                echo "<tr>";
                                echo "<td>" . $counter . "</td>";
                                echo "<td>" . $row['perid'] . "</td>";
                                echo "<td>" . $row['person_fullname'] . "</td>";
                                // echo "<td>" . $row['heduid'] . "</td>";
                                echo "<td>" . $row['edulevnme'] . "</td>";
                                echo "<td>" . $row['edusemester'] . "</td>";
                                echo "<td>" . $row['edugrade'] . "</td>";
                                echo "<td>" . $row['edudetail'] . "</td>";
                                echo '<td>';
                                echo '<a href="?page=' . $_GET['page'] . '&function=add&perid=' . $row['perid'] . '" class="btn btn-warning text-white"><i class="fas fa-edit"></i></a>';
                                echo '<a href="javascript:void(0);" onclick="deletePerson(\'' . $row['perid'] . '\', \'' . $row['person_fullname'] . '\', \'' . $row['sname'] . '\')" class="btn btn-danger text-white"><i class="fas fa-trash-alt"></i></a>';
                                echo '</td>';
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