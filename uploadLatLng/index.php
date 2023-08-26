<?php
$conn = new mysqli("localhost", "dsrd", "L;=9,vxo", "dek_equal_tani");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<?php
$page_id = $_GET['id'] ?? null;

if (!$page_id) {
    echo 'ไม่พบข้อมูลสำหรับชุดที่';
    exit;
}
?>
<?php
#	Name	Type	Collation	Attributes	Null	Default	Comments	Extra	Action

$query = "SELECT lat, lng, imageInput1, imageInput2, imageInput3 FROM images WHERE page_id = ? ORDER BY timestam DESC LIMIT 1";

$stmt = $conn->prepare($query);
if (!$stmt) {
    // This will print the error message related to preparing the statement
    die("Prepare failed: " . $conn->error);
}

if (!$stmt->bind_param('i', $page_id)) {
    // This will print the error message related to binding parameters
    die("Binding parameters failed: " . $stmt->error);
}

if (!$stmt->execute()) {
    // This will print the error message related to executing the statement
    die("Execute failed: " . $stmt->error);
}

$result = $stmt->get_result();
if (!$result) {
    // This will print the error message related to fetching the result
    die("Getting result failed: " . $stmt->error);
}

$row = $result->fetch_assoc();
if (!$row) {
    echo "No data found for page ID";
} else {
    // Process the data here
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GPS Location</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function loadScript() {
            var script = document.createElement('script');
            script.type = 'text/javascript';
            script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyA8UJeSz5dgi0SB9rA9JGsEnlQkltjN9f8&callback=initMap';
            document.body.appendChild(script);
        }
        <?php
        $lat = isset($row['lat']) ? $row['lat'] : 0;
        $lng = isset($row['lng']) ? $row['lng'] : 0;
        ?>


        var latFromPHP = <?php echo $lat ? $lat : 0; ?>;
        var lngFromPHP = <?php echo $lng ? $lng : 0; ?>;




        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 25,
                center: {
                    lat: latFromPHP,
                    lng: lngFromPHP
                },
                mapTypeId: 'satellite' // Setting the map type to satellite
            });

            var marker = new google.maps.Marker({
                position: {
                    lat: latFromPHP,
                    lng: lngFromPHP
                },
                map: map,
                draggable: true // Allows the marker to be dragged
            });

            // Listener to update the input fields when the marker is dragged
            google.maps.event.addListener(marker, 'dragend', function() {
                var pos = marker.getPosition();
                $('#lat').val(pos.lat());
                $('#lng').val(pos.lng());
            });

            if (latFromPHP === 0 && lngFromPHP === 0) {
                navigator.geolocation.watchPosition(function(position) {
                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    $('#lat').val(position.coords.latitude);
                    $('#lng').val(position.coords.longitude);

                    marker.setPosition(pos);
                    map.setCenter(pos);
                });
            }
        }

        window.onload = loadScript;
    </script>
</head>

<body class="bg-gradient-to-r from-yellow-100 via-green-150 to-green-400">

    <nav class="bg-blue-500">
        <div class="container mx-auto px-6 py-4 flex flex-wrap items-center justify-between">
            <div class="flex items-center space-x-2">
                <img src="../includes/images/logo1.jpg" alt="Logo 1" class="h-12">
                <img src="../includes/images/logo2.jpg" alt="Logo 2" class="h-12 ml-2">
            </div>
            <h1 class="text-white text-xl font-semibold">
                โครงการการจัดการศึกษาเชิงพื้นที่เพื่อลดความเหลื่อมล้ำทางการศึกษา จ.ปัตตานี
            </h1>

        </div>
    </nav>

    <!-- div//margin-top: 50px;
    margin-left: 10px;
    margin-right: 10px; -->
    <input type="hidden" id="pageId" value="">
    <div id="content">
        <h1>ชุดที่ <?php echo $page_id; ?></h1>


        <?php $conn->close(); ?>
</body>

</html>

<form id="uploadForm" method="post" enctype="multipart/form-data">

    <div class="bg-white rounded-lg overflow-hidden shadow-lg ring-4 ring-red-500 ring-opacity-40 max-w-sm m-3 card">
        <div class="relative  ">
            <div id="map" style='width:100%;height:300px;'></div>

        </div>
        <div class="p-4">
            <h3 class="text-lg font-medium mb-2">ตำแหน่ง</h3>
            <div class="mb-4">
                <label for="lat" class="block mb-1 text-sm font-medium">ละติจูด</label>
                <input type="text" id="lat" name="lat" value="<?php echo $row['lat'] ?? ''; ?>" class="w-full border border-gray-300 rounded-md py-2 px-3">
            </div>
            <div class="mb-4">
                <label for="lng" class="block mb-1 text-sm font-medium">ลองจิจูด</label>
                <input type="text" id="lng" name="lng" value="<?php echo $row['lng'] ?? ''; ?>" class="w-full border border-gray-300 rounded-md py-2 px-3">
            </div>

            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded" id="refreshButton">
                    รีเฟรช
                </button>

            </div>
        </div>
    </div>
    <hr class="my-4 opacity-0">

    <div class="bg-white rounded-lg overflow-hidden shadow-lg ring-4 ring-red-500 ring-opacity-40 max-w-sm m-3 card">

        <div class="relative">
            <div class="h-64 bg-gray-300 flex items-center justify-center">
                <!-- Display uploaded image or default message -->
                <img id="uploadedImage1" class="max-h-full" src="<?php echo $row['imageInput1'] ? $row['imageInput1'] : "No-photo-m.png"; ?> " alt="Uploaded Image">
            </div>
            <!--<button id="deleteButton" class="absolute bottom-0 right-0 bg-red-500 text-white px-2 py-1 m-2 rounded-md text-sm font-medium">
                        Delete
                    </button>-->
        </div>
        <div class="p-4">
            <h3 class="text-lg font-medium mb-2">อัปโหลดรูปถ่ายเด็ก</h3>
            <div class="mb-4">
                <input type="file" id="imageInput1" name="imageInput1" accept="image/*" value="<?php echo $row['imageInput1'] ? $row['imageInput1'] : ""; ?>" class="border border-gray-300 rounded-md py-2 px-3">
            </div>
            <div class="flex items-center justify-end">

            </div>
        </div>

    </div>
    <div class="bg-white rounded-lg overflow-hidden shadow-lg ring-4 ring-red-500 ring-opacity-40 max-w-sm m-3 card">

        <div class="relative">
            <div class="h-64 bg-gray-300 flex items-center justify-center">
                <!-- Display uploaded image or default message -->
                <img id="uploadedImage2" class="max-h-full" src="<?php echo $row['imageInput2'] ? $row['imageInput2'] : "No-photo-m.png"; ?> " alt="Uploaded Image">
            </div>
            <!--<button id="deleteButton" class="absolute bottom-0 right-0 bg-red-500 text-white px-2 py-1 m-2 rounded-md text-sm font-medium">
                        Delete
                    </button>-->
        </div>
        <div class="p-4">
            <h3 class="text-lg font-medium mb-2">อัปโหลดรูป พื่้นและบริเวณภายในของที่พักอาศัย</h3>
            <div class="mb-4">
                <input type="file" id="imageInput2" name="imageInput2" accept="image/*" class="border border-gray-300 rounded-md py-2 px-3">
            </div>
            <div class="flex items-center justify-end">

            </div>
        </div>

    </div>
    <div class="bg-white rounded-lg overflow-hidden shadow-lg ring-4 ring-red-500 ring-opacity-40 max-w-sm m-3 card">

        <div class="relative">
            <div class="h-64 bg-gray-300 flex items-center justify-center">
                <!-- Display uploaded image or default message -->
                <img id="uploadedImage3" class="max-h-full" src="<?php echo $row['imageInput3'] ? $row['imageInput3'] : "No-photo-m.png"; ?> " alt="Uploaded Image">
            </div>
            <!--<button id="deleteButton" class="absolute bottom-0 right-0 bg-red-500 text-white px-2 py-1 m-2 rounded-md text-sm font-medium">
                        Delete
                    </button>-->
        </div>
        <div class="p-4">
            <h3 class="text-lg font-medium mb-2">อัปโหลดรูปถ่ายบ้าน กรุณาถ่ายให้เห็นหลังคาและฝาผนัง</h3>
            <div class="mb-4">
                <input type="file" id="imageInput3" name="imageInput3" accept="image/*" class="border border-gray-300 rounded-md py-2 px-3">
            </div>
            <div class="flex items-center justify-end">

            </div>
        </div>


    </div>
</form>
</div>
</div>
<button id="saveButton" class="fixed bottom-4 right-4 bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700">
    บันทึก
</button>


</body>
<script>
    // Your existing JavaScript code...

    // Add an event listener to the image input
    document.getElementById('imageInput1').addEventListener('change', function(event) {
        var uploadedImage = document.getElementById('uploadedImage1');
        var file = event.target.files[0]; // Get the selected file

        if (file) {
            var reader = new FileReader();

            // Read the uploaded file as a data URL
            reader.readAsDataURL(file);

            // When the file is loaded, update the uploadedImage source
            reader.onload = function(e) {
                uploadedImage.src = e.target.result;
            };
        } else {
            uploadedImage.src = 'No-photo-m.png'; // Display default image if no file is selected
        }
    });
    document.getElementById('imageInput2').addEventListener('change', function(event) {
        var uploadedImage = document.getElementById('uploadedImage2');
        var file = event.target.files[0]; // Get the selected file

        if (file) {
            var reader = new FileReader();

            // Read the uploaded file as a data URL
            reader.readAsDataURL(file);

            // When the file is loaded, update the uploadedImage source
            reader.onload = function(e) {
                uploadedImage.src = e.target.result;
            };
        } else {
            uploadedImage.src = 'No-photo-m.png'; // Display default image if no file is selected
        }
    });
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('imageInput3').addEventListener('change', function(event) {
            var uploadedImage = document.getElementById('uploadedImage3');
            var file = event.target.files[0]; // Get the selected file

            if (file) {
                var reader = new FileReader();

                // Read the uploaded file as a data URL
                reader.readAsDataURL(file);

                // When the file is loaded, update the uploadedImage source
                reader.onload = function(e) {
                    uploadedImage.src = e.target.result;
                };
            } else {
                uploadedImage.src = 'No-photo-m.png'; // Display default image if no file is selected
            }
        });
    });

    // Your existing JavaScript code...
</script>
<script>
    // Your existing JavaScript code...

    // Add event listener to the "Refresh" button
    $('#refreshButton').click(function() {
        // Request current position and update input fields
        navigator.geolocation.getCurrentPosition(function(position) {
            $('#lat').val(position.coords.latitude);
            $('#lng').val(position.coords.longitude);

            // Update marker and map
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            marker.setPosition(pos);
            map.setCenter(pos);
        });
    });



    function handleImageUpload(inputId, imageId) {
        document.getElementById(inputId).addEventListener('change', function(event) {
            var uploadedImage = document.getElementById(imageId);
            var file = event.target.files[0];

            if (file) {
                var reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = function(e) {
                    uploadedImage.src = e.target.result;
                };
            } else {
                uploadedImage.src = 'No-photo-m.png';
            }
        });
    }

    handleImageUpload('imageInput1', 'uploadedImage1');
    handleImageUpload('imageInput2', 'uploadedImage2');
    handleImageUpload('imageInput3', 'uploadedImage3');

    // Extract the ID from the URL
    var urlParams = new URLSearchParams(window.location.search);
    var pageId = urlParams.get('id');
    document.getElementById('pageId').value = pageId;
    document.getElementById('saveButton').addEventListener('click', function() {
        setLoading(true)
        var formData = new FormData(document.getElementById('uploadForm'));

        for (var i = 1; i <= 3; i++) {
            var fileInput = document.getElementById('imageInput' + i);
            var message = "";

            switch (i) {
                case 1:
                    message = "อัปโหลดรูปถ่ายเด็ก";
                    break;
                case 2:
                    message = "อัปโหลดรูป พื้นและบริเวณภายในของที่พักอาศัย";
                    break;
                case 3:
                    message = "อัปโหลดรูปถ่ายบ้าน กรุณาถ่ายให้เห็นหลังคาและฝาผนัง";
                    break;
            }

            if (fileInput.files.length == 0) {
                Swal.fire('ข้อผิดพลาด!', 'โปรดเลือกไฟล์สำหรับ ' + message, 'error');
                setLoading(false);
                // Highlight the corresponding card
                document.querySelectorAll('.card')[i - 1].classList.add('ring-8', 'ring-yellow-400');
                // Scroll to the corresponding card
                document.querySelectorAll('.card')[i - 1].scrollIntoView({
                    behavior: 'smooth'
                });
                return;
            }




            var file = fileInput.files[0];
            var img = document.createElement("img");
            var reader = new FileReader();

            reader.onloadend = function() {
                img.src = reader.result;
                var canvas = document.createElement('canvas');
                var ctx = canvas.getContext("2d");

                canvas.width = 800; // Desired width
                canvas.height = 600; // Desired height

                ctx.drawImage(img, 0, 0, canvas.width, canvas.height);

                var resizedImage = canvas.toDataURL("image/jpeg");
                formData.append('resizedImage' + i, resizedImage);
            }

            reader.readAsDataURL(file);
        }

        // Submit the form
        fetch('upload.php?id=' + pageId, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                setLoading(false); // Revert the button to the normal state
                if (data.success) {
                    Swal.fire('สำเร็จ!', 'ไฟล์ของคุณถูกอัพโหลดเรียบร้อยแล้ว.', 'success');
                } else {
                    Swal.fire('ข้อผิดพลาด!', 'เกิดข้อผิดพลาดในการอัพโหลดไฟล์ของคุณ.', 'error');
                }
            })
            .catch(error => {
                setLoading(false); // Revert the button to the normal state even in case of an error
                Swal.fire('ข้อผิดพลาด!', 'เกิดข้อผิดพลาดในการประมวลผลคำขอของคุณ.', 'error');
            });






    });

    function setLoading(isLoading) {
        var button = document.getElementById("saveButton");
        if (isLoading) {
            button.innerHTML = '<svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">' +
                '<circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>' +
                '<path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>' +
                '</svg>กำลังประมวลผล...'; // Updated to Thai language
            button.disabled = true;
            button.classList.add('bg-blue-400'); // optional: change color while loading
        } else {
            button.textContent = "บันทึก";
            button.disabled = false;
            button.classList.remove('bg-blue-400'); // optional: revert color change
        }
    }

    // Your existing JavaScript code...
</script>

<!-- ... Rest of your HTML code ... -->

</html>