<?php
session_start();
include '../connection/connect.php';

if (isset($_GET['id']) && isset($_SESSION['admin_id'])) {
    $id = $_GET['id'];

    // 1. Fara samo sunayen hotunan dalibin kafin mu goge shi
    $stmt_files = $conn->prepare("SELECT youtube, tiktok, instagram, twitter, telegram, whatsapp FROM `free_class_applications` WHERE id = ?");
    $stmt_files->bind_param("i", $id);
    $stmt_files->execute();
    $result = $stmt_files->get_result();
    $student_files = $result->fetch_assoc();

    if ($student_files) {
        // Inda hotunan suke (Tunda ka ce folder din tana baya/back: ../uploads/proofs/)
        $upload_path = "../uploads/proofs/";
        
        // Jerin kowace column da take dauke da hoto
        $proof_columns = ['youtube', 'tiktok', 'instagram', 'twitter', 'telegram', 'whatsapp'];

        foreach ($proof_columns as $col) {
            $filename = $student_files[$col];
            if (!empty($filename)) {
                $full_path = $upload_path . $filename;
                // Duba idan file din akwai shi da gaske, sai a goge shi
                if (file_exists($full_path)) {
                    unlink($full_path);
                }
            }
        }
    }

    // 2. Yanzu kuma sai mu goge dalibin daga Database
    $stmt_delete = $conn->prepare("DELETE FROM `free_class_applications` WHERE id = ?");
    $stmt_delete->bind_param("i", $id);
    
    if ($stmt_delete->execute()) {
        header("Location: dashboard.php?msg=deleted");
        exit();
    } else {
        echo "Error deleting record.";
    }
} else {
    header("Location: dashboard.php");
    exit();
}
?>