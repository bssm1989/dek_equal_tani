<?php
@session_start();
$optid = $_SESSION['optid'];

$sql = "SELECT h.hhjobid, h.perid, p.pid, t.titnme, p.name, p.sname, h.hjobdte, h.hjobmoney, h.hjobobject, h.hjobknowledge, h.hjobtranfer, h.hjobdetail FROM hhelpjob h LEFT JOIN person p ON h.perid = p.perid LEFT JOIN titname t ON p.titid = t.titid;";

$results = mysqli_query($conn, $sql);
// Return the educational level name based on the given eduid



?>
<div class="row justify-content-between card-header text-right mb-0">
    <div class="col-auto">
        <h4 class="app-page-title mb-0">ประวัติการช่วยเหลือด้านอาชีพ</h4>
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
                    <table class="table" id="myTableAll">
                        <thead class="table-light">
                            <tr>
                                <th class="align-middle text-center" scope='col'>รหัสประวัติการช่วยเหลือด้านอาชีพ</th>
                                <th class="align-middle text-start" scope='col'>รหัสบุคคล</th>
                                <th class="align-middle text-start" scope='col'>คำนำหน้าชื่อ</th>
                                <th class="align-middle text-start" scope='col'>ชื่อ</th>
                                <th class="align-middle text-start" scope='col'>สกุล</th>
                                <th class="align-middle text-start" scope='col'>วันที่ให้ความช่วยเหลือ</th>
                                <th class="align-middle text-start" scope='col'>ให้เงินสด</th>
                                <th class="align-middle text-start" scope='col'>ให้สิ่งของ/อุปกรณ์</th>
                                <th class="align-middle text-start" scope='col'>ให้ความรู้</th>
                                <th class="align-middle text-start" scope='col'>ส่งต่อให้หน่วยงาน</th>
                                <th class="align-middle text-start" scope='col'>รายละเอียดการช่วยเหลือ</th>
                                <th>แก้ไข</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Loop through the $results array to display the data in the table
                            $counter = 1;
                            while ($row = mysqli_fetch_assoc($results)) {
                                // Extract the data from the current row
                                $hhjobid = $row['hhjobid'];
                                $perid = $row['perid'];
                                $pid = $row['pid'];
                                $titnme = $row['titnme'];
                                $name = $row['name'];
                                $sname = $row['sname'];
                                $hjobdte = $row['hjobdte'];
                                $hjobmoney = $row['hjobmoney'];
                                $hjobobject = $row['hjobobject'];
                                $hjobknowledge = $row['hjobknowledge'];
                                $hjobtranfer = $row['hjobtranfer'];
                                $hjobdetail = $row['hjobdetail'];
                            ?>
                                <!-- Display the data in each row of the table -->
                                <tr>
                                    <td class="align-middle text-center"><?= $hhjobid ?></td>
                                    <td class="align-middle text-start"><?= $perid ?></td>
                                    <td class="align-middle text-start"><?= $titnme ?></td>
                                    <td class="align-middle text-start"><?= $name ?></td>
                                    <td class="align-middle text-start"><?= $sname ?></td>
                                    <td class="align-middle text-start"><?= $hjobdte ?></td>
                                    <td class="align-middle text-start"><?= $hjobmoney ? 'ให้เงินสด' : 'ไม่ให้เงินสด' ?></td>
                                    <td class="align-middle text-start"><?= $hjobobject ? 'ให้สิ่งของ/อุปกรณ์' : 'ไม่ให้สิ่งของ/อุปกรณ์' ?></td>
                                    <td class="align-middle text-start"><?= $hjobknowledge ? 'ให้ความรู้' : 'ไม่ให้ความรู้' ?></td>
                                    <td class="align-middle text-start"><?= $hjobtranfer ? 'ส่งต่อให้หน่วยงาน' : 'ไม่ส่งต่อให้หน่วยงาน' ?></td>
                                    <td class="align-middle text-start"><?= $hjobdetail ?></td>
                                    <td class="align-middle text-center">
                                        <a href="?page=<?= $_GET['page'] ?>&function=edit&hhjobid=<?= $hhjobid ?>" class="btn btn-warning text-white"><i class="fas fa-edit"></i></a>
                                        <a href="?page=<?= $_GET['page'] ?>&function=delete&hhjobid=<?= $hhjobid ?>" class="btn btn-danger text-white"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                            </tr>
                            <?php
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


<!-- Rest of your HTML and PHP code as before -->
<script language=Javascript>
    $(document).ready(function() {
        // Function to get distinct values from the dispform table


        const dataTable = $('#myTableAll').DataTable({
            language: {
                "lengthMenu": "แสดงข้อมูล _MENU_ แถว",
                "zeroRecords": "ไม่พบข้อมูลที่ต้องการ",
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

        // Event listener to trigger the search on the dispfrmnme column when the dropdown or search box changes
        $('#searchBox, #dispfrmnmeDropdown').on('keyup change', function() {
            const searchBoxValue = $('#searchBox').val().trim();
            const selectedValue = $('#dispfrmnmeDropdown').val();

            // Perform the custom search based on the values in the search box and the dropdown
            dataTable.column(7).search(searchBoxValue || selectedValue).draw();
        });
        $('#searchBoxEduLevel, #edulevDropdown').on('keyup change', function() {
            const searchBoxValue = $('#searchBoxEduLevel').val().trim();
            const selectedValue = $('#edulevDropdown').val();

            // Perform the custom search based on the values in the search box and the dropdown
            dataTable.column(8).search(searchBoxValue || selectedValue).draw();
        });
        // Fetch the distinct dispfrmnme values from the get_dispform_values.php file and populate the dropdown options
        $.ajax({
            url: 'educations/get_dispform_values.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                const dropdown = $('#dispfrmnmeDropdown');
                dropdown.empty();
                dropdown.append('<option value="">ทั้งหมด</option>'); // Add an option to show all values

                // Add the fetched dispfrmnme values to the dropdown
                data.forEach(function(value) {
                    dropdown.append('<option value="' + value + '">' + value + '</option>');
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error fetching data:', errorThrown);
            }
        });
        $.ajax({
            url: 'educations/get_edulev_values.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                const dropdown = $('#edulevDropdown');
                dropdown.empty();
                dropdown.append('<option value="">ทั้งหมด</option>'); // Add an option to show all values

                // Add the fetched dispfrmnme values to the dropdown
                data.forEach(function(value) {
                    dropdown.append('<option value="' + value + '">' + value + '</option>');
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error fetching data:', errorThrown);
            }
        });
        $('#searchBoxPersonID, #searchBoxPID, #searchBoxTitlename, #searchBoxName, #searchBoxSurname').on('keyup', function() {
            const searchBoxPersonIDValue = $('#searchBoxPersonID').val().trim();
            const searchBoxPIDValue = $('#searchBoxPID').val().trim();
            const searchBoxTitlenameValue = $('#searchBoxTitlename').val().trim();
            const searchBoxNameValue = $('#searchBoxName').val().trim();
            const searchBoxSurnameValue = $('#searchBoxSurname').val().trim();

            // Perform the custom search based on the values in the search boxes
            dataTable
                .column(1).search(searchBoxPersonIDValue)
                .column(2).search(searchBoxPIDValue)
                .column(3).search(searchBoxTitlenameValue)
                .column(4).search(searchBoxNameValue)
                .column(5).search(searchBoxSurnameValue)
                .draw();
        });

        $('#searchBoxProvince').on('keyup', function() {
            const searchBoxProvinceValue = $('#searchBoxProvince').val().trim();


            // Perform the custom search based on the values in the search boxes
            dataTable
                .column(6).search(searchBoxProvinceValue)

                .draw();
        });
    });
</script>