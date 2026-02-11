<?php
include 'connection/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $full_name = htmlspecialchars($_POST['full_name']);
    $email     = htmlspecialchars($_POST['email']);
    $subject   = htmlspecialchars($_POST['subject']);
    $message   = htmlspecialchars($_POST['message']);

    $stmt = $conn->prepare("INSERT INTO contacts (full_name, email, subject, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $full_name, $email, $subject, $message);

    if ($stmt->execute()) {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        </head>
        <body>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Your message has been sent successfully.',
                confirmButtonColor: '#2563eb'
            }).then(() => {
                window.location.href = 'index.php';
            });
        </script>
        </body>
        </html>
        <?php
    } else {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        </head>
        <body>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Something went wrong. Please try again.',
                confirmButtonColor: '#dc2626'
            }).then(() => {
                window.location.href = 'index.php';
            });
        </script>
        </body>
        </html>
        <?php
    }

    $stmt->close();
    $conn->close();
}
?>
