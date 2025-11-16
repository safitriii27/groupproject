<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}
include "../config/koneksi.php";

$id = intval($_GET['id']);

$res = mysqli_query($conn, "SELECT poster FROM events WHERE id=$id");
if ($row = mysqli_fetch_assoc($res)) {
    $poster = "../uploads/".$row['poster'];
    if (file_exists($poster)) {
        unlink($poster);
    }
}

mysqli_query($conn, "DELETE FROM events WHERE id=$id");
header("Location: manage_event.php");
exit();
?>
