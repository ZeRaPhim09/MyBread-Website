<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Panggil fungsi keranjang
require_once 'functions.php';
$total_cart = hitungTotalKeranjang();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= isset($page_title) ? $page_title : "MyBread - Toko Roti Premium" ?></title>
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
        
        <div class="dropdown">
            <div class="dropdown-btn" onclick="toggleDropdown()">
                👤 <strong><?= htmlspecialchars($_SESSION['user']) ?></strong> ▼
            </div>
            <div class="dropdown-content" id="logoutMenu">
                <a href="profil.php">Profil Saya</a>
                <a href="pesanan.php">Riwayat Pesanan</a>
                <a href="index.php?logout=1" style="color: #e74c3c;">Logout</a>
            </div>
        </div>
    <?php else: ?>
        <div class="auth-buttons">
            <a href="login.php" class="btn btn-detail">Login</a>
            <a href="register.php" class="btn btn-tambah">Register</a>
        </div>
    <?php endif; ?>
</div>
    </div>