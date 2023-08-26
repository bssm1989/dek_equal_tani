$('#uploadForm').on('submit', function(e) {
    e.preventDefault();

    var file = $('#image')[0].files[0];

    // ตรวจสอบว่าไฟล์เป็นรูปภาพหรือไม่
    if (!file.type.startsWith('image/')) {
        alert('กรุณาเลือกไฟล์รูปภาพเท่านั้น'); // แสดงข้อความเตือน
        return;
    }

    // ตรวจสอบขนาดไฟล์
    if (file.size > 1 * 1024 * 1024) {
        // แต่งขนาดรูปภาพ
        var reader = new FileReader();
        reader.onload = function(e) {
            var img = new Image();
            img.src = e.target.result;
            img.onload = function() {
                var canvas = document.createElement('canvas');
                var ctx = canvas.getContext('2d');
                // ปรับขนาดให้ตรงกับต้องการ
                canvas.width = img.width / 2;
                canvas.height = img.height / 2;
                ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
                canvas.toBlob(function(blob) {
                    uploadImage(blob);
                }, file.type);
            }
        }
        reader.readAsDataURL(file);
    } else {
        uploadImage(file);
    }
});

// ...existing code...

function uploadImage(file) {
    var formData = new FormData();
    formData.append('image', file);

    $.ajax({
        url: 'upload.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            var result = JSON.parse(response);
            if (result.success) {
                Swal.fire('สำเร็จ!', 'อัปโหลดรูปภาพสำเร็จ', 'success'); // ใช้ SweetAlert
            } else {
                Swal.fire('ผิดพลาด!', result.message, 'error'); // ใช้ SweetAlert
            }
        },
        error: function() {
            Swal.fire('ผิดพลาด!', 'เกิดข้อผิดพลาดในการอัปโหลด', 'error'); // ใช้ SweetAlert
        }
    });
}

