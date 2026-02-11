<?php
session_start();
include '../conn/connect.php'; // database connection

// Directory to save uploaded files
$upload_dir = 'uploads/';
if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);

// Function to handle single file upload
function handle_upload($file_field) {
    global $upload_dir;
    if (isset($_FILES[$file_field]) && $_FILES[$file_field]['error'] === UPLOAD_ERR_OK) {
        $tmp_name = $_FILES[$file_field]['tmp_name'];
        $filename = time() . '_' . basename($_FILES[$file_field]['name']);
        $target = $upload_dir . $filename;
        if (move_uploaded_file($tmp_name, $target)) {
            return $filename;
        }
    }
    return null;
}

// Process POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $fullname = trim($_POST['fullname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $course = trim($_POST['course'] ?? '');
    $location = trim($_POST['location'] ?? '');
    $dob = trim($_POST['dob'] ?? '');

    // Simple validation
    if (empty($fullname) || empty($email)) {
        die("Full Name and Email are required.");
    }

    // Handle file uploads
    $youtube = handle_upload('youtube');
    $tiktok = handle_upload('tiktok');
    $instagram = handle_upload('instagram');
    $twitter = handle_upload('twitter');
    $telegram = handle_upload('telegram');
    $whatsapp = handle_upload('whatsapp');

    // Insert into DB
    $stmt = $conn->prepare("INSERT INTO free_class_applications 
        (fullname, email, phone, course, location, dob, youtube, tiktok, instagram, twitter, telegram, whatsapp) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param(
        "ssssssssssss",
        $fullname, $email, $phone, $course, $location, $dob,
        $youtube, $tiktok, $instagram, $twitter, $telegram, $whatsapp
    );

    if ($stmt->execute()) {
        echo "Application submitted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
}
$stmt->close();
?>