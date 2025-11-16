<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}
include "../config/koneksi.php";


$q_org = mysqli_query($conn, "SELECT COUNT(*) as total FROM users WHERE role='organisasi'");
$total_org = mysqli_fetch_assoc($q_org)['total'];

$q_event = mysqli_query($conn, "SELECT COUNT(*) as total FROM events");
$total_event = mysqli_fetch_assoc($q_event)['total'];
?>

<?php include '../layout/header1.php'; ?>


<div class="container mt-4">
  <h3 class="mb-4">Dashboard Admin</h3>
  <div class="row g-4">
    <div class="col-md-6">
      <div class="card shadow border-0 rounded-4">
        <div class="card-body text-center">
          <h5 class="card-title">Total Organisasi</h5>
          <p class="display-6 fw-bold text-success"><?= $total_org; ?></p>
          <a href="manage_organisasi.php" class="btn btn-success btn-sm">Kelola Organisasi</a>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card shadow border-0 rounded-4">
        <div class="card-body text-center">
          <h5 class="card-title">Total Event</h5>
          <p class="display-6 fw-bold text-primary"><?= $total_event; ?></p>
          <a href="manage_event.php" class="btn btn-primary btn-sm">Kelola Event</a>
        </div>
      </div>
    </div>
  </div>

  <div class="card mt-5 shadow border-0 rounded-4">
    <div class="card-body">
      <h5 class="card-title mb-3">📋 Menu Admin</h5>
      <ul class="list-group list-group-flush">
        <li class="list-group-item"><a href="manage_organisasi.php">➕ Tambah / Kelola Akun Organisasi</a></li>
        <li class="list-group-item"><a href="manage_event.php">✅ Validasi Event</a></li>
        <li class="list-group-item"><a href="laporan.php">📊 Laporan Event</a></li>
      </ul>
    </div>
  </div>
</div>

<?php include '../layout/footer.php'; ?>
