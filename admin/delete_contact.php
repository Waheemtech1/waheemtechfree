<?php
session_start();
include '../connection/connect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id']) && isset($_SESSION['admin_id'])) {

    $id = intval($_POST['id']);

    $stmt = $conn->prepare("DELETE FROM contacts WHERE id = ?");
    $stmt->bind_param("i", $id);

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
                title: 'Deleted!',
                text: 'Message deleted successfully.',
                confirmButtonColor: '#2563eb'
            }).then(() => {
                window.location.href = 'contact_message.php';
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
                text: 'Failed to delete message.',
                confirmButtonColor: '#dc2626'
            }).then(() => {
                window.location.href = 'contact_message.php';
            });
        </script>
        </body>
        </html>
        <?php
    }

    $stmt->close();
    $conn->close();
    exit();

} else {
    header("Location: dashboard.php");
    exit();
}
?>
