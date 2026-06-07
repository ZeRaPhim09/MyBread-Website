<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'koneksi.php';
// Proses Logout 
if (isset($_GET['logout'])) {
    unset($_SESSION['user']);
    header("Location: produk.php");
    exit();
}

// Data Produk (Mock DB)
$products = [
    1 => ['name' => 'Roti Sobek', 'price' => 10000, 'img' => 'img/roti.jpg'],
    2 => ['name' => 'Maryam', 'price' => 15000, 'img' => 'img/maryam.jpg'],
    3 => ['name' => 'Roti Tawar', 'price' => 12000, 'img' => 'img/tawar.jpeg'],
    4 => ['name' => 'Roti Sisir', 'price' => 11000, 'img' => 'img/sisir.jpeg'],
    5 => ['name' => 'Croissant', 'price' => 18000, 'img' => 'img/croissant.jpeg'],
    6 => ['name' => 'Roti Cokelat', 'price' => 8000, 'img' => 'img/cokelat.jpeg'],
    7 => ['name' => 'Roti Keju', 'price' => 9000, 'img' => 'img/keju.jpeg'],
    8 => ['name' => 'Donat Kampung', 'price' => 5000, 'img' => 'img/donat.jpeg'],
    9 => ['name' => 'Baguette', 'price' => 20000, 'img' => 'img/baguette.jpeg'],
    10 => ['name' => 'Roti Gandum', 'price' => 16000, 'img' => 'img/gandum.jpeg']
];

// Logika Tambah Jumlah (+)
if (isset($_GET['plus'])) {
    $id = $_GET['plus'];
    $_SESSION['cart'][$id]++;
    header("Location: keranjang.php");
    exit();
}

// Logika Kurang Jumlah (-)
if (isset($_GET['minus'])) {
    $id = $_GET['minus'];
    $_SESSION['cart'][$id]--;
    if ($_SESSION['cart'][$id] <= 0) {
        unset($_SESSION['cart'][$id]);
    }
    header("Location: keranjang.php");
    exit();
}

// Kosongkan keranjang
if (isset($_GET['clear'])) {
    unset($_SESSION['cart']);
    header("Location: keranjang.php");
    exit();
}

// Panggil Header
$page_title = "Keranjang Belanja - MyBread";
include 'header.php';
?>

<style>
    /* Desain Kotak Keranjang Modern */
    .cart-wrapper {
        background: #FFFFFF;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(44,30,24,0.05);
        padding: 40px;
        margin-bottom: 50px;
    }

    /* Styling Tabel */
    .cart-table { 
        width: 100%; 
        border-collapse: collapse; 
    }
    
    .cart-table th { 
        background-color: transparent; 
        color: #888; 
        font-weight: 700; 
        border-bottom: 2px solid #E0A96D; 
        padding: 15px 10px; 
        text-align: left; 
        text-transform: uppercase;
        font-size: 13px;
        letter-spacing: 1px;
    }
    
    .cart-table td { 
        padding: 20px 10px; 
        border-bottom: 1px solid #F0E6D6; 
        vertical-align: middle; 
    }

    /* Kontrol Jumlah (Digabung ke dalam satu kapsul) */
    .qty-control {
        display: inline-flex;
        align-items: center;
        background: #FAFAFA;
        border: 1px solid #F0E6D6;
        border-radius: 30px;
        padding: 4px;
    }
    
    .qty-control span {
        width: 40px;
        text-align: center;
        font-weight: 800;
        color: #2C1E18;
        font-size: 16px;
    }
    
    .btn-qty { 
        width: 32px;
        height: 32px;
        display: flex;
        justify-content: center;
        align-items: center;
        text-decoration: none; 
        border-radius: 50%; 
        font-weight: bold; 
        font-size: 18px; 
        transition: all 0.3s; 
    }
    
    /* === PERUBAHAN WARNA TOMBOL - DI SINI === */
    .btn-min { 
        background-color: #E74C3C; /* Warna Merah */
        color: #FFFFFF; /* Teks Putih untuk Kontras */
    }
    
    .btn-min:hover { 
        background-color: #C0392B; /* Warna Merah yang Lebih Gelap saat Hover */
        color: #FFFFFF;
    }
    /* ========================================= */
    
    .btn-plus { background-color: #F6BD60; color: #2C1E18; }
    .btn-plus:hover { background-color: #C97A3E; color: white; }

    /* Baris Total & Tombol Aksi */
    .cart-total-row td {
        padding-top: 35px;
        border-bottom: none;
        text-align: right;
        font-size: 18px;
        font-weight: 700;
        color: #555;
    }
    
    .total-amount {
        color: #C97A3E;
        font-size: 26px;
        font-weight: 800;
        margin-left: 15px;
    }

    .cart-actions {
        display: flex;
        justify-content: flex-end;
        gap: 15px;
        margin-top: 30px;
    }

    /* Responsif untuk HP */
    @media (max-width: 768px) {
        .cart-wrapper { padding: 20px; }
        .cart-table th, .cart-table td { padding: 15px 5px; font-size: 14px; }
        .qty-control span { width: 25px; font-size: 14px; }
        .btn-qty { width: 26px; height: 26px; font-size: 14px; }
        .cart-actions { flex-direction: column; }
        .cart-actions .btn { width: 100%; text-align: center; }
    }
</style>

<div class="main-content">
    <div class="container">
        <h2 style="border-bottom: 2px solid #C97A3E; color: #2C1E18; padding-bottom: 5px; display: inline-block; margin-bottom: 30px;">Keranjang Belanja</h2>

        <?php if(empty($_SESSION['cart'])): ?>
            <div class="checkout-box" style="text-align: center; padding: 60px 20px;">
                <div style="font-size: 60px; margin-bottom: 15px;">🛒</div>
                <h3 style="color: #2C1E18;">Keranjang Masih Kosong</h3>
                <p style="color: #777; font-size: 16px; margin-bottom: 25px;">Sepertinya Anda belum memilih roti yang lezat hari ini.</p>
                <a href="produk.php" class="btn btn-tambah" style="padding: 12px 35px; font-size: 16px;">Lihat Menu Kami</a>
            </div>
        <?php else: ?>
            <div class="cart-wrapper">
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Harga Satuan</th>
                            <th style="text-align: center;">Jumlah</th>
                            <th style="text-align: right;">Subtotal</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $grand_total = 0;
                        foreach($_SESSION['cart'] as $id => $qty): 
                            if(!isset($products[$id])) continue; 
                            
                            $subtotal = $products[$id]['price'] * $qty;
                            $grand_total += $subtotal;
                        ?>
                        <tr>
                            <td style="font-weight: 800; color: #2C1E18; font-size: 16px;">
                                <?= $products[$id]['name'] ?>
                            </td>
                            <td style="color: #777;">
                                Rp. <?= number_format($products[$id]['price'], 0, ',', '.') ?>
                            </td>
                            <td style="text-align: center;">
                                <div class="qty-control">
                                    <a href="?minus=<?= $id ?>" class="btn-qty btn-min">-</a>
                                    <span><?= $qty ?></span>
                                    <a href="?plus=<?= $id ?>" class="btn-qty btn-plus">+</a>
                                </div>
                            </td>
                            <td style="text-align: right; font-weight: 800; color: #2C1E18; font-size: 16px;">
                                Rp. <?= number_format($subtotal, 0, ',', '.') ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        
                        <tr class="cart-total-row">
                            <td colspan="4">
                                Total Keseluruhan: <span class="total-amount">Rp. <?= number_format($grand_total, 0, ',', '.') ?></span>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="cart-actions">
                    <a href="?clear=1" class="btn" style="background-color: #F0E6D6; color: #555;">Kosongkan Keranjang</a>
                    <a href="checkout.php" class="btn btn-tambah" style="padding: 12px 35px; font-size: 16px;">Checkout (Bayar) &rarr;</a> 
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'footer.php'; ?>