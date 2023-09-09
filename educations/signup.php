<?php 
  // session_start();
  // if(isset($_SESSION['unique_id'])){
  //   header("location: users.php");
  // }
  
?>

<?php 
  require 'php/config.php';
  include_once "header.php"; 
?>
<body>
  <div class="wrapper">
    <section class="form signup">
      <header>สมัครขอใช้บริการระบบฯ</header>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="field input">
            <label>สังกัดหน่วยงานของท่าน</label>            
            <select class="minimal" name="optid" required>
              <?php
                $sql = "select optid,optnme from opt order by optid,optnme";
                $result = mysqli_query($conn,$sql);
                while ($row = mysqli_fetch_array($result)) {
              ?>
              <option value="<?=$row["optid"];?>"
                  <?php if ($rows["optid"]==$row["optid"]) echo "selected";?>>
                  <?=$row["optnme"];?></option>
              <?php } ?>
            </select>
        </div>
        
        <div class="name-details">
          <div class="field input">
            <label>ชื่อจริง</label>
            <input type="text" name="fname" placeholder="ชื่อจริง" required>
          </div>
          <div class="field input">
            <label>นามสกุล</label>
            <input type="text" name="lname" placeholder="นามสกุล" required>
          </div>
        </div>
        <div class="field input">
          <label>อีเมล</label>
          <input type="text" name="email" placeholder="อีเมล" required>
        </div>
        <div class="field input">
          <label>ชื่อผู้ใช้งาน</label>
          <input type="text" name="usrnme" placeholder="ชื่อผู้ใช้งาน" required>
        </div>
        <div class="field input">
          <label>รหัสผ่าน</label>
          <input type="password" name="password" placeholder="หัสผ่าน" required>
          <i class="fas fa-eye"></i>
        </div>
        <div class="field image">
          <label>รูปภาพประจำตัว</label>
          <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" required>
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="สมัครใช้งานระบบฯ">
        </div>
      </form>
      <div class="link">สมัครแล้ว คลิก+ <a href="login.php">ลงชื่อเข้าใช้ตอนนี้</a></div>
    </section>
  </div>

  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/signup.js"></script>

</body>
</html>