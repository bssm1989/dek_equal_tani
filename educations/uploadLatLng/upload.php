<?php
$id = $_GET['id'];
$lat = $_POST['lat'];
$lng = $_POST['lng'];
$timestamp = time();

// Folder to save images
$target_dir = "../photo/";

$imagePaths = [];

for ($i = 1; $i <= 3; $i++) {
    $fileKey = "imageInput" . $i;
    $imageFileType = pathinfo($_FILES[$fileKey]["name"], PATHINFO_EXTENSION);
    $nameOriginal = pathinfo($_FILES[$fileKey]["name"], PATHINFO_FILENAME);
    $newFileName = $nameOriginal . '_imageInput' . $i . '_' . $timestamp . '.' . $imageFileType;
    $target_file = $target_dir . $newFileName;

    if (move_uploaded_file($_FILES[$fileKey]["tmp_name"], $target_file)) {
        $imagePaths[] = $target_file;
    } else {
        $response["success"] = false;
        $response["message"] = "Error uploading image" . $i;
        echo json_encode($response);
        exit;
    }
}

// Connect to MySQL
$conn = new mysqli("localhost", "dsrd", "L;=9,vxo", "dek_equal_tani");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO images (page_id, lat, lng, imageInput1, imageInput2, imageInput3, timestam) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('iddsssi', $id, $lat, $lng, $imagePaths[0], $imagePaths[1], $imagePaths[2], $timestamp);

if ($stmt->execute() === TRUE) {
    $response["success"] = true;
} else {
    $response["success"] = false;
    $response["message"] = "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();

echo json_encode($response); // Send the response as JSON
?>
