<!-- <h1 class="app-page-title">เพิ่มข้อมูลผู้ดูแลระบบ</h1> -->
<h4 class="card-header text-right">เพิ่มข้อมูลผู้ดูแลระบบ</h4>
<hr class="mb-4">
<div class="row g-4 settings-section">
    <div class="col-12 col-md-12">

        <div class="app-card app-card-settings shadow-sm p-4">

            <div class="app-card-body">
                <!-- ?php print_r($_POST); ?> -->

                <form action="" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="first_name" class="col-form-label">ชื่อ-นามสกุล:</label>
                            <input type="text" class="form-control" id="first_name" name="first_name"
                                placeholder="first name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="col-form-label">อีเมลล์:</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="email" required>
                        </div>
                        <div class="col-md-12">
                            <label for="agency" class="col-form-label">หน่วยงาน/ศูนย์ฯ:</label>
                            
                            <select class="form-control" name="agency" id="agency"
                                required>
                                <?php
                                    $sql = "select schid,schnme from constschool order by schid,schnme";
                                    $result = mysqli_query($conn,$sql);
                                    while ($row = mysqli_fetch_array($result)) {
                                ?>
                                <option value="<?=$row["schid"];?>"
                                    <?php if ($rows["agency"]==$row["schid"]) echo "selected";?>>
                                    <?=$row["schnme"];?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="username" class="col-form-label">ชื่อผู้ใช้งาน:</label>
                            <input type="text" class="form-control" id="username" name="username"
                                placeholder="username" required>
                        </div>
                        <div class="col-md-3">
                            <label for="password" class="col-form-label">รหัสผ่าน:</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="password" required>
                        </div>
                    </div>

                    <button type="submit" class="mt-3 btn app-btn-primary">บันทึก</button>
                </form>
            </div>
            <!--//app-card-body-->

        </div>
        <!--//app-card-->
    </div>
</div>
<!--//row-->

<!--//row-->