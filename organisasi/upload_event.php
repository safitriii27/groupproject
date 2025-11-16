<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'organisasi') {
    header("Location: ../login.php");
    exit();
}
include "../config/koneksi.php";
?>

<?php include '../layout/header1.php'; ?>

<?php if (isset($_GET['msg'])): ?>
  <?php if ($_GET['msg'] == 'success'): ?>
    <div class="alert alert-success">Event berhasil diupload, menunggu validasi admin.</div>
  <?php elseif ($_GET['msg'] == 'upload_error'): ?>
    <div class="alert alert-danger">Gagal upload poster. Coba lagi!</div>
  <?php endif; ?>
<?php endif; ?>

<div class="container my-4">
  <div class="row justify-content-center">
    <div class="col-md-7">
      <div class="card shadow border-0 rounded-4">
        <div class="card-body p-4" style="max-height: 80vh; overflow-y: auto;">
          <h3 class="text-center mb-4">Upload Event Organisasi</h3>

          <form action="save_event.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="nama_event" class="form-label">Nama Event</label>
              <input 
                type="text" 
                id="nama_event" 
                name="nama_event" 
                class="form-control" 
                placeholder="Masukkan nama event"
                required
              >
            </div>

            <div class="mb-3">
              <label for="poster" class="form-label">Poster Event</label>
              <input 
                type="file" 
                id="poster" 
                name="poster" 
                class="form-control" 
                accept="image/*"
                required
              >
            </div>

            <div class="mb-3">
              <label for="tanggal" class="form-label">Tanggal</label>
              <input 
                type="date" 
                id="tanggal" 
                name="tanggal" 
                class="form-control" 
                required
              >
            </div>

            <div class="mb-3">
              <label for="waktu" class="form-label">Waktu</label>
              <input 
                type="time" 
                id="waktu" 
                name="waktu" 
                class="form-control" 
                required
              >
            </div>

            <div class="mb-3">
              <label for="gedung" class="form-label">Gedung</label>
              <input 
                type="text" 
                id="gedung" 
                name="gedung" 
                class="form-control" 
                placeholder="Contoh: Aula Polinela"
                required
              >
            </div>
                        <div class="mb-3">
              <label for="deskripsi" class="form-label">Deskripsi Event</label>
              <textarea 
                id="deskripsi" 
                name="deskripsi" 
                class="form-control" 
                rows="4" 
                placeholder="Tuliskan deskripsi singkat mengenai event"
                required
              ></textarea>
            </div>

            <button type="submit" class="btn btn-success w-100">
              Kirim ke Admin
            </button>
          </form>
        </div>

        <div class="card-footer text-center small text-muted">
          © 2025 EventNela - Polinela
        </div>
      </div>
    </div>
  </div>
</div>

<?php include '../layout/footer.php'; ?>
