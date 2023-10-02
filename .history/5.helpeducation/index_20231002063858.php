<?php
@session_start();
$optid = $_SESSION['optid'];

// Make sure to update the database connection settings if needed

// Replace the empty SQL query with your modified query to fetch data from the person, hwork, and prv tables, and join them accordingly.
// You will need to adjust the JOIN conditions based on your table structure.
$optid = $_SESSION['optid'];

$sql = "SELECT
    hh.hheduid, hh.perid, hh.eduid, hh.hedulev, hh.hedusemester, hh.hedufundtyp, hh.hedumoney, hh.hedudetail,
    p.perid AS person_perid, p.pid, t.titnme, p.name, p.sname, c.plcnmegen, df.dispfrmnme, el.edulevnme
FROM
    hhelpedu hh
LEFT JOIN
    person p ON hh.perid = p.perid
LEFT JOIN
    titname t ON p.titid = t.titid
LEFT JOIN
    const_plcnmegen c ON p.plcid = c.plcidgen
LEFT JOIN
    disptyp dt ON p.perid = dt.perid
LEFT JOIN
    dispform df ON dt.dispfrmid = df.dispfrmid
LEFT JOIN
    hedu ed ON p.perid = ed.perid
LEFT JOIN
    edulev el ON ed.edulev = el.eduid";
// echo $sql;
$results = mysqli_query($conn, $sql);

function getEducationLevel($eduid)
{
    // Define an array mapping eduid to the corresponding edulevnme
    $eduLevelMapping = array(
        0 => 'ไม่ระบุ',
        1 => 'ไม่ได้เรียนหนังสือ',
        2 => 'ไม่จบระดับประถมศึกษา',
        3 => 'ประถมศึกษา',
        4 => 'มัธยมตอนต้น',
        5 => 'มัธยมตอนปลาย',
        6 => 'ปวช',
        7 => 'ปวส',
        8 => 'ปริญญาตรี',
        9 => 'ปริญญาโท',
        10 => 'ปริญญาเอก',
        11 => 'มศ.3',
        12 => 'มศ.5',
        13 => 'วัยก่อนเรียน',
        14 => 'บริบาล/ปฐมวัย',
        15 => 'อนุบาล',
        16 => 'ศาสนาอิบตีดาอีย์ (ชั้น 1-4)',
        17 => 'ศาสนามูตาวัตซิด (ชั้น 5-7)',
        18 => 'ศาสนาซานาวีย์ (ชั้น 8-10)',
        19 => 'กศน.ม.ต้น',
        20 => 'กศน.ม.ปลาย',
        21 => 'อนุปริญญา'
    );

    // Return the educational level name based on the given eduid
    return isset($eduLevelMapping[$eduid]) ? $eduLevelMapping[$eduid] : 'ไม่ระบุ';
}
?>

<!-- Rest of your HTML code as before -->

<!-- Existing HTML code -->
<div class="row justify-content-between card-header text-right mb-0">
    <div class="col-auto">
        <h4 class="app-page-title mb-0">ข้อมูลประวัติการประกอบอาชีพ</h4>
    </div>
    <div class="col-auto">
        <a href="?page=<?= $_GET['page'] ?>&function=add" class="btn btn-primary text-white"><i class="fas fa-plus"></i>
            เพิ่มข้อมูลใหม่</a>
    </div>
</div>
<hr class="mb-0">
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

            <table class="table" id="myTableAll">
                <!-- Table headings in Thai language -->
                <thead class="table-light">
                    <tr>
                        <th class="align-middle text-center" scope='col'>รหัสประวัติการประกอบอาชีพ</th>
                        <th class="align-middle text-start" scope='col'>รหัสเด็ก</th>
                        <th class="align-middle text-start" scope='col'>รหัสอาชีพ</th>
                        <th class="align-middle text-start" scope='col'>ชื่อสถานประกอบการ</th>
                        <th class="align-middle text-start" scope='col'>จังหวัดที่ทำงาน</th>
                        <th class="align-middle text-start" scope='col'>ทำงานในตำแหน่ง</th>
                        <th class="align-middle text-start" scope='col'>ปีที่เริ่มประกอบอาชีพ</th>
                        <th class="align-middle text-start" scope='col'>ทำงานเป็นระยะเวลา (ปี)</th>
                        <th class="align-middle text-start" scope='col'>ทำงานเป็นระยะเวลา (เดือน)</th>
                        <th class="align-middle text-start" scope='col'>ปีที่ลาออก</th>
                        <th class="align-middle text-start" scope='col'>เหตุผลที่ลาออก</th>
                        <th class="align-middle text-start" scope='col'>ลักษณะความเหลื่อมล้ำ</th>
                        <th>แก้ไข</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Loop through the $results array to display the data in the table
                    while ($row = mysqli_fetch_assoc($results)) {
                        // Extract the data from the current row
                        $hwrkid = $row['hwrkid'];
                        $person_id = $row['person_id'];
                        //name
                        $name = $row['name'];
                        //sname
                        $sname = $row['sname'];
                        $occupation_id = $row['occupation_id'];
                        $workplace_name = $row['workplace_name'];
                        $province_name = $row['province_name'];
                        $workplace_position = $row['workplace_position'];
                        $start_year = $row['start_year'];
                        $work_period_years = $row['work_period_years'];
                        $work_period_months = $row['work_period_months'];
                        $end_year = $row['end_year'];
                        $end_reason = $row['end_reason'];
                        $dispfrmnme = $row['dispfrmnme'];
                    ?>
                        <!-- Display the data in each row of the table -->
                        <tr id="row<?= $hwrkid ?>" data-id="<?= $hwrkid ?>">
                            <td class="align-middle text-center"><?= $hwrkid ?></td>
                            <td class="align-middle text-start"><?= $person_id ?></td>
                            <td class="align-middle text-start"><?= $occupation_id ?></td>
                            <td class="align-middle text-start"><?= $workplace_name ?></td>
                            <td class="align-middle text-start"><?= $province_name ?></td>
                            <td class="align-middle text-start"><?= $workplace_position ?></td>
                            <td class="align-middle text-start"><?= $start_year ?></td>
                            <td class="align-middle text-start"><?= $work_period_years ?></td>
                            <td class="align-middle text-start"><?= $work_period_months ?></td>
                            <td class="align-middle text-start"><?= $end_year ?></td>
                            <td class="align-middle text-start"><?= $end_reason ?></td>
                            <td class="align-middle text-start"><?= $dispfrmnme ?></td>
                            <td>
                                <div class="btn-group" role="group">
                                    
                                <a href="?page=<?= $_GET['page'] ?>&function=add&perid=<?= $hwrkid ?>" class="btn btn-warning text-white"><i class="fas fa-edit"></i></a>
                                <button" type="button" class="btn btn-sm btn-danger text-white" onclick="deletePerson2(<?= $hwrkid ?>,'<?= $name ?>','<?= $sname ?>','hwork','hwrkid')"><i class="fas fa-trash-alt"></i></button>

                                </div>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!--//app-card-body-->
    </div>
    <!--//app-card-->
</div>
<!-- ... Rest of your HTML code as before ... -->
</div>
<!-- End of your HTML code -->

<!-- ... Rest of your HTML and PHP code as before ... -->
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
            },
            responsive: true,
            columnDefs: [{
                    responsivePriority: 2,
                    targets: 2
                },
                {
                    responsivePriority: 3,
                    targets: 3
                },
                {
                    responsivePriority: 4,
                    targets: 4
                },
                {
                    responsivePriority: 2,
                    targets: -1
                }
            ],
        });

        // Event listener to trigger the search on the dispfrmnme column when the dropdown or search box changes
        $('#searchBox, #dispfrmnmeDropdown').on('keyup change', function() {
            const searchBoxValue = $('#searchBox').val().trim();
            const selectedValue = $('#dispfrmnmeDropdown').val();

            // Perform the custom search based on the values in the search box and the dropdown
            dataTable.column(11).search(searchBoxValue || selectedValue).draw();
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