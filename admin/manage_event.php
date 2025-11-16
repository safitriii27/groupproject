<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}
include "../config/koneksi.php";

$q = mysqli_query($conn, "SELECT e.*, u.username 
                          FROM events e 
                          JOIN users u ON e.user_id = u.id 
                          ORDER BY e.created_at DESC");
?>

<?php include '../layout/header1.php'; ?>

<div class="container my-4">
  <h3 class="mb-4 text-center">Kelola Event Organisasi</h3>

  <div class="card shadow border-0 rounded-4">
    <div class="card-body p-4" style="max-height: 80vh; overflow-y: auto;">
      <table class="table table-bordered align-middle text-center">
        <thead class="table-light">
          <tr>
            <th>Poster</th>
            <th>Nama Event</th>
            <th>Tanggal</th>
            <th>Waktu</th>
            <th>Gedung</th>
            <th>Organisasi</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php if (mysqli_num_rows($q) > 0): ?>
            <?php while($e = mysqli_fetch_assoc($q)): ?>
              <tr>
                <td>
                  <a href="#" data-bs-toggle="modal" data-bs-target="#posterModal<?= $e['id'] ?>">
                    <img src="../uploads/<?= htmlspecialchars($e['poster']); ?>" width="100" class="rounded">
                  </a>
                </td>

                <td>
                  <strong><?= htmlspecialchars($e['nama_event']); ?></strong><br>
                  <button class="btn btn-link btn-sm text-primary" data-bs-toggle="modal" data-bs-target="#descModal<?= $e['id'] ?>">
                    📖 Lihat Deskripsi
                  </button>
                </td>

                <td><?= $e['tanggal']; ?></td>
                <td><?= $e['waktu']; ?></td>
                <td><?= htmlspecialchars($e['gedung']); ?></td>
                <td><?= htmlspecialchars($e['username']); ?></td>
                <td>
                  <span class="badge bg-<?= $e['status']=='approved'?'success':($e['status']=='rejected'?'danger':($e['status']=='cancelled'?'secondary':'warning')); ?>">
                    <?= ucfirst($e['status']); ?>
                  </span>
                </td>
                <td>
                  <?php if ($e['status'] == 'pending'): ?>
                    <a href="validate.php?id=<?= $e['id'] ?>" class="btn btn-success btn-sm mb-1">✅ Approve</a>
                    <a href="reject.php?id=<?= $e['id'] ?>" class="btn btn-danger btn-sm mb-1">❌ Reject</a>
                  <?php elseif ($e['status'] == 'approved'): ?>
                    <a href="cancel.php?id=<?= $e['id'] ?>" class="btn btn-warning btn-sm mb-1">⚠️ Cancel</a>
                  <?php endif; ?>

                  <a href="delete.php?id=<?= $e['id'] ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Yakin ingin menghapus event ini?');">🗑 Hapus</a>
                </td>
              </tr>

              <div class="modal fade" id="posterModal<?= $e['id'] ?>" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                  <div class="modal-content">
                    <div class="modal-body text-center">
                      <img src="../uploads/<?= htmlspecialchars($e['poster']); ?>" class="img-fluid rounded">
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal fade" id="descModal<?= $e['id'] ?>" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Deskripsi: <?= htmlspecialchars($e['nama_event']); ?></h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body text-start">
                      <?= nl2br(htmlspecialchars($e['deskripsi'])); ?>
                    </div>
                  </div>
                </div>
              </div>

            <?php endwhile; ?>
          <?php else: ?>
            <tr>
              <td colspan="9" class="text-center text-muted">Belum ada event yang diajukan.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php include '../layout/footer.php'; ?>
