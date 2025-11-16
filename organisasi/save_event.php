<?php
session_start();
include "../config/koneksi.php";

if (!isset($_SESSION['user_id'])) {
    die("Anda harus login terlebih dahulu!");
}

$user_id = $_SESSION['user_id']; 
$nama_event = $_POST['nama_event'] ?? '';
$tanggal = $_POST['tanggal'] ?? '';
$waktu = $_POST['waktu'] ?? '';
$gedung = $_POST['gedung'] ?? '';
$deskripsi = $_POST['deskripsi'] ?? '';
$poster = "";

if (isset($_FILES['poster']) && $_FILES['poster']['error'] == 0) {
    $targetDir = "../uploads/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $fileName = time() . "_" . basename($_FILES['poster']['name']);
    $targetFile = $targetDir . $fileName;

    if (move_uploaded_file($_FILES['poster']['tmp_name'], $targetFile)) {
        $poster = $fileName;
    } else {
        header("Location: upload_event.php?msg=upload_error");
        exit;
    }
}
$sql = "INSERT INTO events (user_id, nama_event, poster, tanggal, waktu, gedung, deskripsi, status, created_at)
        VALUES (?, ?, ?, ?, ?, ?, ?, 'pending', NOW())";

$stmt = $conn->prepare($sql);
$stmt->bind_param("issssss", $user_id, $nama_event, $poster, $tanggal, $waktu, $gedung, $deskripsi);

if ($stmt->execute()) {
    header("Location: upload_event.php?msg=success");
} else {
    echo "Error: " . $stmt->error;
}
$stmt->close();
$conn->close();
?>
