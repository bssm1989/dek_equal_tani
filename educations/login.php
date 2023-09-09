<?php 
  session_start();
  if(isset($_SESSION['staffid'])){
    header("location: index.php");
  }
?>

<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="form login">
      <header><h5>ระบบฐานข้อมูลเด็กที่มีความเหลื่อมล้ำทางการศึกษา</h5></header>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="field input">
          <label>อีเมล หรือ ชื่อผู้ใช้งาน  </label>
          <input type="text" name="username" placeholder="กรอกชื่อผู้ใช้งาน " required>
        </div>
        <div class="field input">
          <label>รหัสผ่าน</label>
          <input type="password" name="password" placeholder="กรอกรหัสผ่าน" required>
          <i class="fas fa-eye"></i>
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="เข้าสู่ระบบ">
        </div>
      </form>
      <div class="link">ลงทะเบียนสมัครผู้ใช้งานระบบ+ <a href="signup.php">คลิกที่นี่</a></div>
    </section>
  </div>
  
  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/login.js"></script>

</body>
</html>
