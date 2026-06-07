<?php
session_start();

include 'koneksi.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['user'];
$id_pesanan = isset($_GET['id']) ? $_GET['id'] : -1;

// Cek apakah ID pesanan valid
if (!isset($_SESSION['riwayat_pesanan'][$username][$id_pesanan])) {
    header("Location: pesanan.php");
    exit();
}

$pesanan = $_SESSION['riwayat_pesanan'][$username][$id_pesanan];

$total_cart = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $qty) { $total_cart += $qty; }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Pesanan</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .detail-box { background: #fff; padding: 25px; border-radius: 5px; border: 1px solid #ddd; margin-top: 20px; }
        .table-items { width: 100%; border-collapse: collapse; margin-top: 15px; }
        .table-items th, .table-items td { border-bottom: 1px solid #eee; padding: 10px 5px; text-align: left; }
        .info-grid { display: flex; justify-content: space-between; margin-bottom: 20px; background: #f8f9fa; padding: 15px; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="nav-brand">
            <a href="index.php">🍞 MyBread</a>
        </div>

        <div class="nav-links">
            <a href="index.php">Home</a>
            <a href="produk.php">Produk</a>
            <a href="tentang.php">Tentang Kami</a>
        </div>
        <div class="nav-right">
            <a href="keranjang.php" class="cart-icon">🛒 <span class="cart-badge"><?= $total_cart ?></span></a>
            <div class="user-menu dropdown">
    <div class="dropdown-btn" onclick="toggleDropdown()">
        👤 <strong><?= htmlspecialchars($_SESSION['user']) ?></strong> ▼
    </div>
    
    <div class="dropdown-content" id="logoutMenu">
        <a href="profil.php" style="color: #333;">Profil Saya</a>
        <a href="pesanan.php" style="color: #333;">Riwayat Pesanan</a>
        <a href="index.php?logout=1" style="color: #e74c3c;">Logout</a>
    </div>
</div>
        </div>
    </div>

    <div class="container">
        <a href="pesanan.php" style="color: #777; text-decoration: none;">&larr; Kembali ke Riwayat Pesanan</a>
        <h2 style="margin-top: 10px; color: #333;">Detail Pesanan #<?= $pesanan['id_pesanan'] ?></h2>
        
        <div class="detail-box">
            <div class="info-grid">
                <div>
                    <p style="margin:0 0 5px 0; color:#777;">Tanggal Pesanan:</p>
                    <strong><?= $pesanan['tanggal'] ?></strong>
                </div>
                <div>
                    <p style="margin:0 0 5px 0; color:#777;">Status:</p>
                    <strong style="color: #f39c12;"><?= $pesanan['status'] ?></strong>
                </div>
                <div>
                    <p style="margin:0 0 5px 0; color:#777;">Metode Pembayaran:</p>
                    <strong style="text-transform: uppercase;"><?= $pesanan['pembayaran'] ?></strong>
                </div>
            </div>

            <h4 style="margin-bottom: 10px; border-bottom: 1px solid #ddd; padding-bottom: 5px;">Rincian Pengiriman</h4>
            <p style="margin: 5px 0;"><strong>Nama:</strong> <?= htmlspecialchars($pesanan['nama_penerima']) ?></p>
            <p style="margin: 5px 0;"><strong>Telepon:</strong> <?= htmlspecialchars($pesanan['telepon']) ?></p>
            <p style="margin: 5px 0;"><strong>Alamat:</strong> <?= nl2br(htmlspecialchars($pesanan['alamat'])) ?></p>

            <p style="margin: 5px 0; color: #e74c3c;"><strong>Jadwal Pengiriman:</strong> 
                <?= date('d F Y', strtotime($pesanan['tanggal_pengiriman'])) ?>
            </p>
            <h4 style="margin-top: 30px; margin-bottom: 5px; border-bottom: 1px solid #ddd; padding-bottom: 5px;">Produk yang Dibeli</h4>
            <table class="table-items">
                <tr>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th style="text-align:center;">Jumlah</th>
                    <th style="text-align:right;">Subtotal</th>
                </tr>
                <?php foreach ($pesanan['items'] as $item): ?>
                <tr>
                    <td><?= $item['nama_produk'] ?></td>
                    <td>Rp. <?= number_format($item['harga_satuan'], 0, ',', '.') ?></td>
                    <td style="text-align:center;">x<?= $item['jumlah'] ?></td>
                    <td style="text-align:right;"><strong>Rp. <?= number_format($item['subtotal'], 0, ',', '.') ?></strong></td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="3" style="text-align:right; padding-top: 15px;"><strong>Total Pembayaran:</strong></td>
                    <td style="text-align:right; padding-top: 15px;"><strong style="font-size: 18px; color: #e74c3c;">Rp. <?= number_format($pesanan['total_bayar'], 0, ',', '.') ?></strong></td>
                </tr>
            </table>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>