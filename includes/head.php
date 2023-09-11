<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>

<meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
<meta name="author" content="Xiaoying Riley at 3rd Wave Media">
<link rel="shortcut icon" href="./upload/admin/favicon.ico">
<!-- FontAwesome JS-->
<script defer src="./assets/assets/plugins/fontawesome/js/all.min.js"></script>

<!-- App CSS -->
<link id="theme-style" rel="stylesheet" href="./assets/assets/css/portal.css">
<link rel="stylesheet" href="styles.css">
<style>
    .table {
        font-size: 14px;
    }

    div.container {
        max-width: 1200px
    }

    /* Style for the invalid Select2 */

</style>
<!-- App datatables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Add these lines in the <head> section of your HTML -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

<!-- Include datepicker CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.css">
<!-- Include Thai locale file for Flatpickr -->




<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include jQuery Validation -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

<!-- Include other scripts -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/th.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<!-- <script src="./service/js/jquery-2.1.1.min.js"></script> -->
<script language="javascript" src="./service/js/jscommonFns.js"></script> <!--?php function popup here?-->
<script language=Javascript>
    function Inint_AJAX() {
        try {
            return new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {} //IE
        try {
            return new ActiveXObject("Microsoft.XMLHTTP");
        } catch (e) {} //IE
        try {
            return new XMLHttpRequest();
        } catch (e) {} //Native Javascript
        alert("XMLHttpRequest not supported");
        return null;
    };

    //ฟังก์ชันเพื่อเลือกจังหวัด อำเภอ ตำบล และหมุ่บ้าน
    function dochange(src, val, adr) {
        var req = Inint_AJAX();
        req.onreadystatechange = function() {
            if (req.readyState == 4) {
                if (req.status == 200) {
                    document.getElementById(src).innerHTML = req.responseText; //รับค่ากลับมา
                }
            }
        };
        //req.open("GET", "getplcnme.php?data=" + src + "&val=" + val + "&adr=" + adr); //สร้าง connection
        req.open("GET", "./service/getplcnme.php?data=" + src + "&val=" + val + "&adr=" + adr); //สร้าง connection
        req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=tis-620"); // set Header
        req.send(null); //ส่งค่า
    }
</script>

<!-- /**เรียกใช้ jquery**/ -->

<!-- /**เรียกใช้ datepicker ภาษาไทย**/ -->
<link href="./service/css/datepicker.css" rel="stylesheet">
<script type="text/javascript" src="./service/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="./service/js/bootstrap-datepicker-thai.js"></script>
<script type="text/javascript" src="./service/js/locales/bootstrap-datepicker.th.js"></script>

<!-- /**เรียกใช้ jquery ให้สามารถเรียกใช้ datapicker **/ -->
<script>
    $(function() {
        $("#testdate").datepicker({
            language: 'th-th',
            //format:'dd/mm/yyyy',
            format: 'dd-mm-yyyy',
            autoclose: true
        });
    });

    $(function() {
        $("#testdate1").datepicker({
            language: 'th-th',
            format: 'dd-mm-yyyy',
            autoclose: true
        });
    });

    $(function() {
        $("#testdate2").datepicker({
            language: 'th-th',
            format: 'dd-mm-yyyy',
            autoclose: true
        });
    });
</script>