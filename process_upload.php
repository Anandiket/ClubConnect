<?php
// Establishing connection to MySQL database
$servername = "localhost";
$username = "root"; // Default username for MySQL is root
$password = ""; // Default password is blank
$database = "user"; // Change this to your database name

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process image upload
$targetDirectory = ""; // Directory where images will be stored
$targetFile = $targetDirectory . basename($_FILES["image"]["name"]);
$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
$check = getimagesize($_FILES["image"]["tmp_name"]);
if($check !== false) {
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            // Insert image path into database
            $imagePath = $targetFile;
            $sql = "INSERT INTO uploads (images) VALUES ('$imagePath')";
            if ($conn->query($sql) === TRUE) {
                echo "Image uploaded successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
} else {
    echo "File is not an image.";
}

// Close connection
$conn->close();
?>

