<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}
include "../config/koneksi.php";

$id = intval($_GET['id']);
mysqli_query($conn, "UPDATE events SET status='cancelled' WHERE id=$id");
header("Location: manage_event.php");
exit();
?>
