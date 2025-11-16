<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'organisasi') {
    header("Location: ../login.php");
    exit();
}
include "../config/koneksi.php";

$user_id = $_SESSION['user_id'];
$q = mysqli_query($conn, "SELECT * FROM events WHERE user_id='$user_id' ORDER BY created_at DESC");
?>

<?php include '../layout/header1.php'; ?>
<div class="container mt-4">
  <h3>Riwayat Event Saya</h3>
  <table class="table table-bordered mt-3">
    <tr>
      <th>Poster</th>
      <th>Nama Event</th>
      <th>Tanggal</th>
      <th>Waktu</th>
      <th>Gedung</th>
      <th>Status</th>
    </tr>
    <?php if (mysqli_num_rows($q) > 0): ?>
      <?php while($e = mysqli_fetch_assoc($q)): ?>
      <tr>
        <td><img src="../uploads/<?= $e['poster'] ?>" width="100"></td>
        <td><?= htmlspecialchars($e['nama_event']) ?></td>
        <td><?= $e['tanggal'] ?></td>
        <td><?= $e['waktu'] ?></td>
        <td><?= htmlspecialchars($e['gedung']) ?></td>
        <td>
          <span class="badge bg-<?= $e['status']=='approved'?'success':($e['status']=='rejected'?'danger':'warning'); ?>">
            <?= ucfirst($e['status']); ?>
          </span>
        </td>
      </tr>
      <?php endwhile; ?>
    <?php else: ?>
      <tr><td colspan="6" class="text-center">Belum ada event yang diupload.</td></tr>
    <?php endif; ?>
  </table>
  <a href="upload_event.php" class="btn btn-primary">➕ Upload Event Baru</a>
</div>
<?php include '../layout/footer.php'; ?>
