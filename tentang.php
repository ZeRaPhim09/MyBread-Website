<?php
session_start();
include 'koneksi.php';
// Menghitung total barang di keranjang untuk ikon Navbar (jika sudah login)
$total_cart = 0;
if (isset($_SESSION['cart']) && isset($_SESSION['user'])) {
    foreach ($_SESSION['cart'] as $qty) {
        $total_cart += $qty;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tentang Kami - Toko Roti</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="navbar">
        <div class="nav-brand">
            <a href="index.php">🍞 MyBread</a>
        </div>

        <div class="nav-links">
            <a href="index.php">Home</a>
            <?php if (isset($_SESSION['user'])): ?>
                <a href="produk.php">Produk</a>
            <?php endif; ?>
            <a href="tentang.php">Tentang Kami</a>
        </div>
        
        <div class="nav-right">
            <?php if (isset($_SESSION['user'])): ?>
                <a href="keranjang.php" class="cart-icon">🛒 <span class="cart-badge"><?= $total_cart ?></span></a>
                
                <div class="user-menu dropdown">
                    <div class="dropdown-btn" onclick="toggleDropdown()">
                        👤 <strong><?= htmlspecialchars($_SESSION['user']) ?></strong> ▼
                    </div>
                    
                    <div class="dropdown-content" id="logoutMenu">
                        <a href="profil.php" style="color: #555;">Profil Saya</a>
                        <a href="pesanan.php" style="color: #555;">Riwayat Pesanan</a>
                        <a href="index.php?logout=1" style="color: #e74c3c;">Logout</a>
                    </div>
                </div>
            <?php else: ?>
                <div class="auth-buttons">
                    <a href="login.php" class="btn btn-detail" style="text-decoration:none;">Login</a>
                    <a href="register.php" class="btn btn-tambah" style="text-decoration:none;">Register</a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="container" style="padding-top: 40px; padding-bottom: 60px;">
        
        <div class="checkout-box" style="margin: 0 auto;">
            
            <h2 style="border-bottom: 2px solid #E0A96D; padding-bottom: 15px; color: #2C1E18; margin-top: 0; font-size: 28px;">Tentang Kami</h2>

            <h3 style="color: #C97A3E; margin-top: 25px; font-size: 22px;">Selamat Datang di Toko Kami!</h3>
            <p style="color: #555; line-height: 1.8; font-size: 16px;">
                Kami adalah penyedia berbagai macam roti dan kue lezat untuk menemani hari-hari Anda. Mulai dari Roti Sobek yang lembut hingga Roti Maryam yang gurih, semua dibuat dengan bahan berkualitas premium dan dipanggang segar setiap hari.
            </p>

            <h4 style="color: #2C1E18; margin-top: 30px; font-size: 18px;">Visi & Misi</h4>
            <ul style="color: #555; line-height: 1.8; font-size: 16px; padding-left: 20px;">
                <li>Menyediakan makanan dengan kualitas terbaik dan harga terjangkau.</li>
                <li>Memberikan pelayanan pemesanan yang mudah melalui website modern.</li>
                <li>Menjaga higienitas, cita rasa, dan kehangatan di setiap gigitan roti kami.</li>
            </ul>

            <h4 style="color: #2C1E18; margin-top: 35px; font-size: 18px;">Kontak & Lokasi</h4>
            
            <div style="background: #FAFAFA; padding: 20px; border-radius: 12px; border: 1px solid #F0E6D6; color: #555; font-size: 16px;">
                <p style="margin: 8px 0;">📞 <strong style="color:#2C1E18;">WhatsApp:</strong> 0812-3456-7890</p>
                <p style="margin: 8px 0;">✉️ <strong style="color:#2C1E18;">Email:</strong> admin@tokomakanan.com</p>
                <p style="margin: 8px 0;">📍 <strong style="color:#2C1E18;">Alamat:</strong> Jl. Raya Mahasiswa No. 123, Kampus Indah</p>
            </div>

        </div>
    </div>
    
    <script src="script.js"></script>
</body>
</html>