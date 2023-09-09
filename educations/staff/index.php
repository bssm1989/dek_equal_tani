<?php 
    @session_start();
    $optid = $_SESSION['optid'];

    $sql = "SELECT * FROM staff
           
            LEFT JOIN titname ON staff.titid = titname.titid
            -- LEFT JOIN const_vllnmegen ON staff.plcid = const_vllnmegen.plcid
            LEFT JOIN staffpos ON staff.staffposid = staffpos.staffposid
            LEFT JOIN staffprio ON staff.staffprioid = staffprio.staffprioid";
    $results = mysqli_query($conn, $sql);
?>

<div class="row justify-content-between card-header text-right mb-0">
    <div class="col-auto">
        <h4 class="app-page-title mb-0">ข้อมูลผู้ใช้งานโปรแกรม</h4>
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
                <table class="table" id="staffTable">
                    <thead class="table-light">
                        <tr>
                            <th class="align-middle text-center">#</th>
                            <th class="align-middle text-center">รหัสผู้ใช้งาน</th>
                            <th class="align-middle text-center">เลขบัตรประชาชน</th>
                            <th class="align-middle text-center">รหัสคำนำหน้าชื่อ</th>
                            <th class="align-middle text-start">ชื่อ</th>
                            <th class="align-middle text-start">สกุล</th>
                            <th class="align-middle text-center">เบอร์โทรศัพท์</th>
                            <th class="align-middle text-center">อีเมล์</th>
                            <th class="align-middle text-center">หน่วยงานที่สังกัด</th>
                            <th class="align-middle text-center">จังหวัดอำเภอตำบล หน่วยงานที่สังกัด</th>
                            <th class="align-middle text-center">รหัสตำแหน่ง/ภาระหน้าที่สำหรับระบบนี้</th>
                            <th class="align-middle text-center">รหัสสิทธิการเข้าถึงข้อมูล</th>
                            <th class="align-middle text-center">ดำเนินการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $n = 0;
                            foreach ($results as $row) {
                                $n++;
                        ?>
                        <tr>
                            <td class="align-middle text-center"><?= $n ?></td>
                            <td class="align-middle text-center"><?= $row['staffid'] ?></td>
                            <td class="align-middle text-center"><?= $row['pid'] ?></td>
                            <td class="align-middle text-center"><?= $row['titid'] ?></td>
                            <td class="align-middle text-start"><?= $row['staffnme'] ?></td>
                            <td class="align-middle text-start"><?= $row['staffsnme'] ?></td>
                            <td class="align-middle text-center"><?= $row['stafftell'] ?></td>
                            <td class="align-middle text-center"><?= $row['staffemail'] ?></td>
                            <td class="align-middle text-center"><?= $row['stafforg'] ?></td>
                            <td class="align-middle text-center"><?= $row['plcid'] ?></td>
                            <td class="align-middle text-center"><?= $row['staffposid'] ?></td>
                            <td class="align-middle text-center"><?= $row['staffprioid'] ?></td>
                            <td class="align-middle text-center">
                                <div class="btn-group" role="group">
                                    <a href="#" class="btn btn-sm btn-warning text-white editStaffBtn" data-staffid="<?= $row['staffid'] ?>">
                                        <i class="far fa-edit"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-danger text-white deleteStaffBtn" data-staffid="<?= $row['staffid'] ?>">
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <!--//app-card-body-->

        </div>
        <!--//app-card-->
    </div>
</div>
<!--//row-->

<!-- Include DataTables library and initialization script -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize DataTable
        $('#staffTable').DataTable();

        // Add click event for addStaffBtn
        $('#addStaffBtn').click(function() {
            // Redirect to add staff page
            window.location.href = 'add_staff.php';
        });

        // Add click events for edit and delete buttons
        $('.editStaffBtn').click(function() {
            var staffId = $(this).data('staffid');
            // Redirect to edit staff page with staffId parameter
            window.location.href = 'edit_staff.php?staffid=' + staffId;
        });

        $('.deleteStaffBtn').click(function() {
            var staffId = $(this).data('staffid');
            // Implement your delete logic here (e.g., show confirmation modal)
            // Once confirmed, you can use AJAX to delete the staff record and reload the DataTable
        });
    });
</script>
