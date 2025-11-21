<?php include 'config/koneksi.php'; ?>
<?php include 'layout/header.php'; ?>

<section class="container-fluid d-flex align-items-center justify-content-start bg-white position-relative overflow-hidden" 
         style="height: 100vh; max-height: 1080px;">

  <img src="assets/images/bg depan.png" 
       class="position-absolute top-0 end-0 w-100 h-100" 
       alt="Background" 
       style="object-fit: cover; object-position: right;">

  <div class="text-center text-dark z-3 position-relative" 
       style="margin-left: 140px; transform: translateY(-30px);">
    <img src="assets/images/logo_polinela.png" 
         alt="Logo Polinela" 
         class="mb-3" 
         style="width: 120px;">
    <h2 class="fw-bold display-4 mb-2">Event Ricky</h2>
    <p class="fs-4 text-secondary mb-4">Platform Event Politeknik Negeri Lampung</p>

    <div class="d-flex flex-wrap justify-content-center gap-4 mt-3">
      <a href="#events" 
         class="btn px-5 py-3 rounded-pill fw-semibold fs-5 text-white shadow"
         style="background-color: #ff7a00; border: none;">
        <i class="bi bi-calendar-event me-2"></i>Lihat Event
      </a>
      <a href="#about" 
         class="btn px-5 py-3 rounded-pill fw-semibold fs-5 text-white shadow"
         style="background-color: #ff7a00; border: none;">
        <i class="bi bi-info-circle me-2"></i>Tentang Kami
      </a>
    </div>
  </div>
</section>
  </div>
</section>

<section id="events" class="py-5 bg-light">
  <div class="container-fluid px-5">
    <h1 class="fw-bold text-center mb-5">EventNela</h1>
    <h2 class="fw-bold text-center mb-5">📅 Daftar Event Kampus</h2>
    <div class="row">
      <?php
      $result = mysqli_query($conn, "SELECT * FROM events WHERE status='approved' ORDER BY tanggal ASC");
      if (mysqli_num_rows($result) > 0) {
        while ($e = mysqli_fetch_assoc($result)) {
      ?>
        <div class="col-md-4">
          <div class="card mb-4 shadow border-0 rounded-4">
            <img src="uploads/<?= htmlspecialchars($e['poster']) ?>" 
                 class="card-img-top rounded-top-4" 
                 style="height:200px; object-fit:cover;">
            <div class="card-body">
              <h5 class="card-title fw-bold"><?= htmlspecialchars($e['nama_event']) ?></h5>
              <p class="card-text text-muted">
                📅 <?= date("d M Y", strtotime($e['tanggal'])) ?><br>
                ⏰ <?= htmlspecialchars($e['waktu']) ?><br>
                🏛 <?= htmlspecialchars($e['gedung']) ?>
              </p>
              <a href="detail_event.php?id=<?= $e['id'] ?>" class="btn btn-sm btn-primary rounded-pill">Lihat Detail</a>
            </div>
          </div>
        </div>
      <?php 
        }
      } else { 
      ?>
        <div class="col-12 text-center">
          <div class="alert alert-warning"> Belum ada event tersedia.</div>
        </div>
      <?php } ?>
    </div>
  </div>
</section>

<section id="about" class="py-5">
  <div class="container-fluid px-5">
    <h2 class="fw-bold text-center mb-4">Tentang EventNela</h2>
    <div class="row justify-content-center">
      <div class="col-md-8 text-center">
        <p class="lead text-muted">
          EventNela adalah platform digital untuk mempublikasikan dan mengatur jadwal kegiatan kampus di Politeknik Negeri Lampung. 
          Kami hadir untuk menyatukan informasi agar lebih mudah diakses oleh seluruh mahasiswa, dosen, dan civitas akademika.
        </p>
      </div>
    </div>
  </div>
</section>
<?php include 'layout/footer.php'; ?>
