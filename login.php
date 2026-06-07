<?php
session_start();
include 'koneksi.php'; // Memanggil koneksi database

$error = '';
$sukses = '';

if (isset($_SESSION['pesan_sukses'])) {
    $sukses = $_SESSION['pesan_sukses'];
    unset($_SESSION['pesan_sukses']); 
}

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password_input = $_POST['password'];

    // Cari user di database MySQL
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Jika username ditemukan
    if ($row = mysqli_fetch_assoc($result)) {
        // Cocokkan password input dengan password hash di database
        if (password_verify($password_input, $row['password'])) {
            
            session_regenerate_id(true); // Keamanan dari Session Fixation
            
            $_SESSION['user'] = $row['username'];
            
            // Simpan data lengkap ke session agar bisa dipakai di profil & checkout
            $_SESSION['user_data'] = [
                'nama' => $row['nama'],
                'email' => $row['email'],
                'nik' => $row['nik'],
                'telepon' => $row['telepon'],
                'alamat' => $row['alamat']
            ];

            header("Location: index.php");
            exit();
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username tidak ditemukan!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Toko - MyBread</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="auth-container">
        <div class="auth-box">
            <h2>Login ke Akun Anda</h2>
            
            <?php if($sukses): ?>
                <div style="background: #d4edda; color: #155724; padding: 10px; border-radius: 4px; margin-bottom: 15px;">
                    <?= $sukses ?>
                </div>
            <?php endif; ?>

            <?php if($error): ?>
                <div style="background: #f8d7da; color: #721c24; padding: 10px; border-radius: 4px; margin-bottom: 15px;">
                    <?= $error ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="" class="auth-form">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" placeholder="Masukkan username" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Masukkan password" required>
                </div>
                <button type="submit" name="login" class="btn btn-detail auth-btn">Login</button>
            </form>
            <div class="auth-link">
                Belum punya akun? <a href="register.php">Daftar sekarang</a>
            </div>
            <div style="margin-top:20px;">
                <a href="index.php" style="text-decoration: none; color:#777; font-size:14px;">&larr; Kembali ke Home</a>
            </div>
        </div>
    </div>
</body>
</html>