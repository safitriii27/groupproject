<?php
session_start();
include "config/koneksi.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = md5(trim($_POST['password']));

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        $_SESSION['username'] = $row['username'];
        $_SESSION['password'] = $row['password'];
        $_SESSION['role']     = $row['role'];
        $_SESSION['user_id']  = $row['id'];

        if ($row['role'] === "admin") {
            header("Location: admin/dashboard.php");
        } else {
            header("Location: organisasi/dashboard.php");
        }
        exit();
    } else {
        $error = "Username atau Password salah!";
    }
}
?>

<?php include 'layout/header.php'; ?>

<div class="d-flex align-items-center vh-100"
     style="background: url('assets/images/login bg.png') no-repeat center center / cover;">

  <div class="card shadow-lg border-0 rounded-4 ms-auto" 
       style="width: 340px; margin-right: 100px;"> 
    <div class="card-body p-4">
      <h4 class="text-center fw-bold mb-4" style="color: #ff7a00;">Login</h4>

      <?php if (!empty($error)) : ?>
        <div class="alert alert-danger text-center py-2"><?= $error; ?></div>
      <?php endif; ?>

      <form method="post">
        <div class="mb-3">
          <label class="form-label fw-semibold">Username</label>
          <input type="text" name="username" class="form-control rounded-3" placeholder="Masukkan Username" required>
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold">Password</label>
          <div class="input-group">
            <input type="password" id="password" name="password" class="form-control rounded-start-3" placeholder="Masukkan Password" required>
            <button type="button" class="btn btn-outline-secondary" id="togglePassword">
              <i class="bi bi-eye"></i>
            </button>
          </div>
        </div>

        <div class="d-grid mt-3">
          <button type="submit" 
                  class="btn fw-bold text-white rounded-3 py-2" 
                  style="background-color: #ff7a00; border: none;">
            Login
          </button>
        </div>
      </form>

      <div class="text-center mt-3 small text-muted">© 2025 EventNela</div>
    </div>
  </div>
</div>

<script>
  const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#password');
  togglePassword.addEventListener('click', function () {
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    this.querySelector('i').classList.toggle('bi-eye');
    this.querySelector('i').classList.toggle('bi-eye-slash');
  });
</script>

