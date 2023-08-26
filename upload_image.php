<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if the image file is uploaded successfully
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == UPLOAD_ERR_OK) {
        // Set the directory to save the uploaded images and thumbnails
        $uploadDir = "photo/";
        $thumbnailDir = "photo/thumbnail/";

        // Generate a unique filename for the image
        $imageName = uniqid("instimg1_") . "." . pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
        $imagePath = $uploadDir . $imageName;

        // Move the uploaded image to the destination folder
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $imagePath)) {
            // Create a thumbnail (resize to 100x100 pixels) and save it in the thumbnail folder
            $thumbnailPath = $thumbnailDir . $imageName;
            $thumbnailCreationSuccess = createThumbnail($imagePath, $thumbnailPath);

            if ($thumbnailCreationSuccess) {
                // Prepare the JSON response
                $response = array(
                    "success" => true,
                    "thumbnail_url" => "photo/thumbnail/" . $imageName // Replace with the URL of the thumbnail
                );
            } else {
                // Failed to move the uploaded image
                $response = array(
                    "success" => false,
                    "error_message" => "Failed to move the uploaded image"
                );
            }
        } else {
            // No image file uploaded or upload error
            $response = array(
                "success" => false,
                "error_message" => "No image file uploaded or upload error"
            );
        }

        // Return the JSON response
        header("Content-Type: application/json");
        echo json_encode($response);
        exit;
    }
}
function createThumbnail($sourcePath, $thumbnailPath)
{
    // Load the image from the source path
    $imageType = exif_imagetype($sourcePath);
    $image = null;

    switch ($imageType) {
        case IMAGETYPE_JPEG:
            $image = imagecreatefromjpeg($sourcePath);
            break;
        case IMAGETYPE_PNG:
            $image = imagecreatefrompng($sourcePath);
            break;
        // Add more cases for other image types if needed (e.g., GIF)
        default:
            throw new Exception("Unsupported image type: " . $imageType);
    }

    if (!$image) {
        throw new Exception("Failed to load the image from the source path: " . $sourcePath);
    }

    // Get the original image dimensions
    $originalWidth = imagesx($image);
    $originalHeight = imagesy($image);

    // Calculate the new dimensions for the thumbnail
    $thumbnailWidth = 100;
    $thumbnailHeight = ($originalHeight / $originalWidth) * $thumbnailWidth;

    // Create a new blank image (thumbnail)
    $thumbnail = imagecreatetruecolor($thumbnailWidth, $thumbnailHeight);

    if (!$thumbnail) {
        imagedestroy($image);
        throw new Exception("Failed to create a new blank image for the thumbnail.");
    }

    // Resize the original image to the thumbnail
    $thumbnailCreationSuccess = imagecopyresampled($thumbnail, $image, 0, 0, 0, 0, $thumbnailWidth, $thumbnailHeight, $originalWidth, $originalHeight);

    if (!$thumbnailCreationSuccess) {
        imagedestroy($thumbnail);
        imagedestroy($image);
        throw new Exception("Failed to resize the original image to the thumbnail.");
    }

    // Save the thumbnail in the correct image format
    switch ($imageType) {
        case IMAGETYPE_JPEG:
            $thumbnailSaveSuccess = imagejpeg($thumbnail, $thumbnailPath);
            break;
        case IMAGETYPE_PNG:
            $thumbnailSaveSuccess = imagepng($thumbnail, $thumbnailPath);
            break;
        // Add more cases for other image types if needed (e.g., GIF)
        default:
            imagedestroy($thumbnail);
            imagedestroy($image);
            throw new Exception("Unsupported image type: " . $imageType);
    }

    if (!$thumbnailSaveSuccess) {
        imagedestroy($thumbnail);
        imagedestroy($image);
        throw new Exception("Failed to save the thumbnail image to the thumbnail path: " . $thumbnailPath);
    }

    // Free up memory
    imagedestroy($thumbnail);
    imagedestroy($image);

    // Return true if both resizing and saving were successful, otherwise throw an exception
    if ($thumbnailCreationSuccess && $thumbnailSaveSuccess) {
        return true;
    } else {
        throw new Exception("Unknown error occurred during thumbnail creation and saving.");
    }
}
