<?php
session_start();
include 'koneksi.php'; // Memanggil koneksi database

$error = '';

// Proses Pendaftaran
if (isset($_POST['register'])) {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password_asli = $_POST['password'];
    $password_hash = password_hash($password_asli, PASSWORD_DEFAULT); // Enkripsi BCRYPT
    $nik = $_POST['nik'];
    $telepon = $_POST['telepon'];
    $alamat = $_POST['alamat'];

    // Cek apakah username atau email sudah pernah didaftarkan
    $cek_query = "SELECT * FROM users WHERE username = ? OR email = ?";
    $stmt_cek = mysqli_prepare($conn, $cek_query);
    mysqli_stmt_bind_param($stmt_cek, "ss", $username, $email);
    mysqli_stmt_execute($stmt_cek);
    $hasil_cek = mysqli_stmt_get_result($stmt_cek);

    if (mysqli_num_rows($hasil_cek) > 0) {
        $error = "Pendaftaran Gagal: Username atau Email sudah digunakan!";
    } else {
        // Masukkan data ke MySQL
        $insert_query = "INSERT INTO users (nama, username, email, password, nik, telepon, alamat) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt_insert = mysqli_prepare($conn, $insert_query);
        mysqli_stmt_bind_param($stmt_insert, "sssssss", $nama, $username, $email, $password_hash, $nik, $telepon, $alamat);
        
        if (mysqli_stmt_execute($stmt_insert)) {
            $_SESSION['pesan_sukses'] = "Pendaftaran berhasil! Silakan login.";
            header("Location: login.php");
            exit();
        } else {
            $error = "Terjadi kesalahan sistem saat mendaftar.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Akun - MyBread</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="auth-container">
        <div class="auth-box" style="max-width: 500px;">
            <h2 style="margin-bottom: 25px;">Daftar Akun Baru</h2>
            
            <?php if($error): ?>
                <div style="background: #f8d7da; color: #721c24; padding: 10px; border-radius: 4px; margin-bottom: 15px;">
                    <?= $error ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="" class="auth-form">
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama" placeholder="Masukkan nama lengkap" required>
                </div>
                
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" placeholder="Buat username (tanpa spasi)" required>
                </div>
                
                <div class="form-group">
                    <label>Alamat Email</label>
                    <input type="email" name="email" placeholder="Contoh: nama@email.com" required>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Buat password" required>
                </div>
                <div class="form-group">
                    <label>NIK (16 Digit)</label>
                    <input type="number" name="nik" placeholder="Contoh: 3500000000000000" required>
                </div>
                <div class="form-group">
                    <label>Nomor Telepon / WA</label>
                    <input type="number" name="telepon" placeholder="Contoh: 08123456789" required>
                </div>
                <div class="form-group">
                    <label>Alamat Lengkap</label>
                    <textarea name="alamat" rows="3" placeholder="Nama Jalan, RT/RW, Desa, Kecamatan..." required></textarea>
                </div>

                <button type="submit" name="register" class="btn btn-tambah auth-btn">Daftar Sekarang</button>
            </form>
            <div class="auth-link">
                Sudah punya akun? <a href="login.php">Masuk di sini</a>
            </div>
            <div>
                <a href="index.php" style="text-decoration: none; color:#777;">&larr; Kembali ke Home</a>
            </div>
        </div>
    </div>
</body>
</html>