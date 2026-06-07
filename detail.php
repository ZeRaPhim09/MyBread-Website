<?php
session_start();
include 'koneksi.php'; // Sertakan file koneksi

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$jenis = isset($_GET['jenis']) ? $_GET['jenis'] : 'reguler';

// Mengambil data produk dari database berdasarkan ID
$query = mysqli_query($conn, "SELECT * FROM products WHERE id = '$id'");
$product = mysqli_fetch_assoc($query);

// Validasi jika produk tidak ditemukan
if (!$product) {
    header("Location: produk.php");
    exit();
}

// Logika Tambah ke Keranjang (Tetap menggunakan session untuk keranjang)
if (isset($_POST['tambah_keranjang']) && $jenis != 'custom') {
    if (!isset($_SESSION['user'])) {
        header("Location: login.php");
        exit();
    }
    
    $jumlah = (int)$_POST['jumlah'];
    if (!isset($_SESSION['cart'])) { $_SESSION['cart'] = []; }
    
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id] += $jumlah;
    } else {
        $_SESSION['cart'][$id] = $jumlah;
    }
    $pesan_sukses = "Berhasil! $jumlah buah " . $product['name'] . " dimasukkan ke keranjang.";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail - <?= $product['name'] ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    
    <style>
        .custom-notice {
            background: #FDFBF7;
            padding: 15px 20px;
            border-radius: 12px;
            border-left: 5px solid #F6BD60;
            margin-bottom: 25px;
        }
        .custom-form-group {
            margin-bottom: 20px;
        }
        .custom-form-group label {
            display: block; font-weight: 700; color: #555; margin-bottom: 8px; font-size: 15px;
        }
        .custom-form-group input[type="date"], 
        .custom-form-group textarea {
            width: 100%; padding: 12px; border: 2px solid #F0E6D6; border-radius: 10px;
            font-family: inherit; font-size: 15px; background: #FAFAFA; box-sizing: border-box;
            transition: 0.3s;
        }
        .custom-form-group input:focus, .custom-form-group textarea:focus {
            border-color: #C97A3E; outline: none; background: #FFF;
        }
        .btn-wa {
            background-color: #25D366; /* Warna Hijau WhatsApp */
            color: white;
        }
        .btn-wa:hover {
            background-color: #1EBE57;
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(37, 211, 102, 0.4);
        }
    </style>
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
            <a href="tentang-kami.php">Tentang Kami</a>
        </div>
        <div class="nav-right">
            <?php if (isset($_SESSION['user'])): ?>
                <a href="keranjang.php" class="cart-icon">🛒 <span class="cart-badge"><?= $total_cart ?></span></a>
                <div class="user-menu dropdown">
                    <div class="dropdown-btn" onclick="toggleDropdown()">
                        👤 <strong><?= htmlspecialchars($_SESSION['user']) ?></strong> ▼
                    </div>
                    <div class="dropdown-content" id="logoutMenu">
                        <a href="profil.php" style="color: #333;">Profil Saya</a>
                        <a href="pesanan.php" style="color: #333;">Riwayat Pesanan</a>
                        <a href="index.php?logout=1" style="color: red;">Logout</a>
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

    <div class="container" style="max-width: 950px; padding-top: 40px; padding-bottom: 60px;">
        
        <div style="margin-bottom: 20px;">
            <a href="produk.php" style="color: #C97A3E; text-decoration: none; font-weight: 700; font-size: 15px;">&larr; Kembali ke Katalog</a>
        </div>

        <?php if(isset($pesan_sukses)): ?>
            <div class="alert-success" style="margin-bottom: 25px;">
                🎉 <?= $pesan_sukses ?> <a href="keranjang.php" style="color: #27AE60; font-weight: bold; margin-left: 10px;">Lihat Keranjang &rarr;</a>
            </div>
        <?php endif; ?>

        <div class="detail-card">
            <div class="detail-img-wrapper">
                <img src="<?= $product['img'] ?>" alt="<?= $product['name'] ?>" onerror="this.src='https://via.placeholder.com/400x400?text=Foto+Produk'">
            </div>
            
            <div class="detail-info-wrapper">
                <h1><?= $product['name'] ?></h1>
                
                <?php if ($jenis == 'custom'): ?>
                    <p class="detail-price">Estimasi Mulai Rp. <?= number_format($product['price'], 0, ',', '.') ?></p>
                <?php else: ?>
                    <p class="detail-price">Rp. <?= number_format($product['price'], 0, ',', '.') ?></p>
                <?php endif; ?>

                <p class="detail-desc"><?= $product['desc'] ?></p>
                
                <?php if ($jenis == 'custom'): ?>
                    
                    <div class="custom-notice">
                        <h4 style="margin:0 0 5px 0; color:#2C1E18; font-size: 16px;">💬 Konsultasi Desain & Harga</h4>
                        <p style="margin:0; font-size:14px; color:#555;">Karena produk ini bersifat custom, harga akhir akan menyesuaikan tingkat kesulitan request Anda. Silakan isi form detail di bawah untuk diteruskan ke WhatsApp Admin.</p>
                    </div>

                    <div class="custom-form-group">
                        <label>Tanggal Acara / Pengambilan:</label>
                        <input type="date" id="tgl_custom" min="<?= date('Y-m-d', strtotime('+2 days')) ?>">
                        <small style="color: #888;">*Pemesanan custom minimal H-2</small>
                    </div>

                    <div class="custom-form-group">
                        <label>Detail Request (Warna, Tema, Tulisan di Kue):</label>
                        <textarea id="catatan_custom" rows="3" placeholder="Contoh: Tema Spiderman, warna biru merah, tulisan 'Happy Birthday Budi ke-7'"></textarea>
                    </div>

                    <div class="action-buttons">
                        <button type="button" class="btn btn-wa" style="flex: 2; padding: 15px; font-size: 16px; border:none; border-radius: 10px; cursor: pointer;" onclick="kirimWA('<?= $product['name'] ?>')">
                            <span style="font-size: 20px; vertical-align: middle;">💬</span> Konsultasi ke WhatsApp Admin
                        </button>
                    </div>

                <?php else: ?>
                    
                    <form method="POST" action="">
                        <div class="qty-group">
                            <label>Jumlah Pesanan:</label>
                            <input type="number" name="jumlah" value="1" min="1" class="qty-input" required>
                        </div>
                        
                        <div class="action-buttons">
                            <button type="submit" name="tambah_keranjang" class="btn btn-tambah" style="flex: 2; padding: 15px; font-size: 16px;">
                                🛒 Tambahkan ke Keranjang
                            </button>
                            <a href="produk.php" class="btn btn-detail" style="flex: 1; padding: 15px; font-size: 16px; background-color: #F0E6D6; color: #2C1E18; text-align: center;">
                                Batal
                            </a>
                        </div>
                    </form>

                <?php endif; ?>

            </div>
        </div>

    </div>
    
    <script src="script.js"></script>
    
    <script>
        function kirimWA(namaProduk) {
            let tgl = document.getElementById('tgl_custom').value;
            let catatan = document.getElementById('catatan_custom').value;
            
            // Nama user jika sudah login
            let namaUser = "<?= isset($_SESSION['user_data']['nama']) ? $_SESSION['user_data']['nama'] : (isset($_SESSION['user']) ? $_SESSION['user'] : 'Kak') ?>";

            if (!tgl || !catatan) {
                alert("Mohon lengkapi Tanggal Acara dan Detail Request terlebih dahulu sebelum menghubungi admin.");
                return;
            }

            // Ganti nomor ini dengan nomor WA Admin Toko Anda (gunakan kode negara 62)
            let noAdmin = "6281234567890"; 

            // Menyusun format pesan WhatsApp yang rapi
            let textWA = `Halo Admin MyBread, saya ${namaUser}. Saya ingin konsultasi untuk pesanan custom berikut:%0A%0A`;
            textWA += `🎂 *Produk:* ${namaProduk}%0A`;
            textWA += `📅 *Tanggal Diperlukan:* ${tgl}%0A`;
            textWA += `📝 *Detail Request:* ${catatan}%0A%0A`;
            textWA += `Apakah slot tanggal tersebut tersedia dan kira-kira berapa estimasi total harganya? Terima kasih!`;

            // Buka WhatsApp di tab baru
            window.open('https://api.whatsapp.com/send?phone=' + noAdmin + '&text=' + textWA, '_blank');
        }
    </script>
</body>
</html>