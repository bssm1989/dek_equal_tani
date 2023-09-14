<?php
@session_start();
$optid = $_SESSION['optid'];
$sql = "SELECT
    i.perid,
    CONCAT(p.name, ' ', p.sname) AS person_fullname,
    i.instid,
    ins.instname,
    i.persince,
    t.staytypnme,
    i.helpmoney,
    i.helpobject,
    i.helpaccom,
    i.helpfood,
    i.helpfare,
    i.helpedu,
    i.helphealth,
    i.helppayment,
    i.needscholar
FROM
    inststay AS i
JOIN
    person AS p ON i.perid = p.perid
JOIN
    institute AS ins ON i.instid = ins.instid
JOIN
    inststaytyp AS t ON i.staytypid = t.staytypid";

$results = mysqli_query($conn, $sql);


?>
<div class="row justify-content-between card-header text-right mb-0">
    <div class="col-auto">
        <h4 class="app-page-title mb-0">ประวัติการได้รับความช่วยเหลือด้านการศึกษา</h4>
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
                <table class="table responsive nowrap" id="myTableAll">
                    <thead class="table-light">
                        <tr>
                            <th class="align-middle text-center" scope='col'>#</th>
                            <th class="align-middle text-start" scope='col'>รหัสบุคคล</th>
                            <th class="align-middle text-start" scope='col'>ชื่อ-นามสกุล บุคคล</th>
                            <th class="align-middle text-start" scope='col'>รหัสสถาบัน</th>
                            <th class="align-middle text-start" scope='col'>ชื่อสถาบัน</th>
                            <th class="align-middle text-start" scope='col'>วันที่เข้ารับการช่วยเหลือ</th>
                            <th class="align-middle text-start" scope='col'>ลักษณะที่พักอาศัยในสถาบัน</th>
                            <th class="align-middle text-start" scope='col'>สถาบันให้ความช่วยเหลือด้วยวิธีเงินสด</th>
                            <th class="align-middle text-start" scope='col'>สถาบันให้ความช่วยเหลือด้วยวิธีสิ่งของ</th>
                            <th class="align-middle text-start" scope='col'>สถาบันให้ความช่วยเหลือด้วยวิธีที่พักอาศัย</th>
                            <th class="align-middle text-start" scope='col'>สถาบันให้ความช่วยเหลือด้วยวิธีอาหาร</th>
                            <th class="align-middle text-start" scope='col'>สถาบันให้ความช่วยเหลือด้วยวิธีการเดินทาง</th>
                            <th class="align-middle text-start" scope='col'>สถาบันให้ความช่วยเหลือด้วยวิธีการศึกษา</th>
                            <th class="align-middle text-start" scope='col'>สถาบันให้ความช่วยเหลือด้วยวิธีสุขภาพ</th>
                            <th class="align-middle text-start" scope='col'>สถาบันมีรายจ่ายเฉลี่ยในการดูแลนักเรียน</th>
                            <th class="align-middle text-start" scope='col'>สถาบันมีความประสงค์รับเงินอุดหนุนจาก กสศ.
                            ความประสงค์ปฏิบัติตามเงื่อนไขการรับทุนส่งเสริมการศึกษาหรือไม่</th>
                            <th>แก้ไข</th>
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
                            echo "<td class='align-middle text-start'>" . $row['instid'] . "</td>";
                            echo "<td class='align-middle text-start'>" . $row['instname'] . "</td>";
                            echo "<td class='align-middle text-start'>" . $row['persince'] . "</td>";
                            echo "<td class='align-middle text-start'>" . $row['staytypnme'] . "</td>";
                            echo "<td class='align-middle text-start'>" . ($row['helpmoney'] == 1 ? 'ให้เงินสด' : 'ไม่ให้เงินสด') . "</td>";
                            echo "<td class='align-middle text-start'>" . ($row['helpobject'] == 1 ? 'ให้สิ่งของ' : 'ไม่ให้สิ่งของ') . "</td>";
                            echo "<td class='align-middle text-start'>" . ($row['helpaccom'] == 1 ? 'ให้ที่พักอาศัย' : 'ไม่ให้ที่พักอาศัย') . "</td>";
                            echo "<td class='align-middle text-start'>" . ($row['helpfood'] == 1 ? 'ให้อาหาร' : 'ไม่ให้อาหาร') . "";
                            echo "<td class='align-middle text-start'>" . ($row['helpfare'] == 1 ? 'ให้การเดินทาง' : 'ไม่ให้การเดินทาง') . "";
                            echo "<td class='align-middle text-start'>" . ($row['helpedu'] == 1 ? 'ดูแลด้านการศึกษา' : 'ไม่ดูแลด้านการศึกษา') . "";
                            echo "<td class='align-middle text-start'>" . ($row['helphealth'] == 1 ? 'ดูแลด้านสุขภาพ' : 'ไม่ดูแลด้านสุขภาพ') . "";
                            echo "<td class='align-middle text-start'>" . $row['helppayment'] . " บาท/คน/ปีการศึกษา";
                            echo "<td class='align-middle text-start'>" . ($row['needscholar'] == 1 ? 'ต้องการ' : 'ไม่ต้องการ') . "";
                            echo "<td class='align-middle text-center'><a href='?page=6.2inststay/index&function=edit&perid=" . $row['perid'] . "' class='btn btn-warning text-white'><i class='fas fa-edit'></i></a></td>";
                            echo "</tr>";
                            $counter++;
                        }
                        ?>
                    </tbody>
                </table>
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