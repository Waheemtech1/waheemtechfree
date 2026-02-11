<?php
session_start();
include '../connection/connect.php';

// Kira files din PHPMailer
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['status'])) {
    $student_id = $_POST['student_id'];
    $status = $_POST['status'];
    $admin_message = $_POST['admin_message'];
    $student_email = $_POST['student_email'];
    $student_name = $_POST['student_name'];

    // 1. Update Database Status
    $stmt = $conn->prepare("UPDATE `free_class_applications` SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $student_id);
    
    if ($stmt->execute()) {
        $mail = new PHPMailer(true);

        try {
            // SMTP Settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'your_email@gmail.com'; // An gyara nan (ba sarari, ba karin rubutu)
            $mail->Password   = 'your_app_password'; // An gyara nan (ba sarari, ba karin rubutu)
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Recipients
            $mail->setFrom('info@waheemtech.com', 'WaheemTech Academy');
            $mail->addAddress($student_email, $student_name);

            // Content
            $mail->isHTML(true);
            $mail->Subject = "Application Status: $status";
$mail->Body = "
<div style='font-family: Arial, sans-serif; padding: 24px; border: 1px solid #e5e7eb; border-radius: 8px; background-color: #ffffff;'>
    
    <h2 style='color: #2563eb; margin-bottom: 10px;'>WaheemTech Academy</h2>
    
    <p style='font-size: 15px; color: #111827;'>
        Hello <strong>$student_name</strong>,
    </p>

    <p style='font-size: 14px; color: #374151;'>
        Your request has been reviewed. Below is your current status:
    </p>

    <p style='font-size: 16px;'>
        <strong>Status:</strong>
        <span style='color: " . ($status === 'Approved' ? '#16a34a' : '#dc2626') . "; font-weight: bold;'>
            $status
        </span>
    </p>

    <div style='margin-top: 15px; padding: 12px; background-color: #f9fafb; border-left: 4px solid #2563eb;'>
        <p style='margin: 0; font-size: 14px; color: #111827;'>
            <strong>Message from WaheemTech Admin:</strong><br>
            $admin_message
        </p>
    </div>

    <hr style='margin: 20px 0; border: none; border-top: 1px solid #e5e7eb;'>

    <p style='font-size: 12px; color: #6b7280;'>
        This is an automated message from the WaheemTech Portal.<br>
        Please do not reply to this email.
    </p>

</div>
";

            $mail->send();
            echo "<script>alert('Status Updated & Email Sent!'); window.location='students.php';</script>";
        } catch (Exception $e) {
            echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
            echo "$admin_message"; // An gyara nan (ba sarari, ba karin rubutu)
        }
    }
}
?>