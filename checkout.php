<?php
session_start();
include 'koneksi.php'; // Menggunakan koneksi database
date_default_timezone_set('Asia/Jakarta');

if (empty($_SESSION['cart']) && !isset($_POST['proses_checkout'])) {
    header("Location: produk.php");
    exit();
}

$pesanan_sukses = false;

if (isset($_POST['proses_checkout'])) {
    $username = $_SESSION['user'];
    $id_pesanan = 'ORD-' . time();
    $nama = $_POST['nama'];
    $telepon = $_POST['telepon'];
    $alamat = $_POST['alamat'];
    $tgl_kirim = $_POST['tanggal_pengiriman'];
    $bayar = $_POST['pembayaran'];

    // Hitung total dan siapkan data
    $grand_total = 0;
    foreach ($_SESSION['cart'] as $id => $qty) {
        // Dalam aplikasi nyata, ambil harga dari tabel products
        // Untuk contoh ini, kita pakai data hardcode/session
        // (Sangat disarankan: ambil dari tabel produk di DB)
        $grand_total += ($qty * 10000); // Sesuaikan dengan harga asli
    }

    // 1. Simpan ke tabel orders
    $sql = "INSERT INTO orders (username, id_pesanan, nama_penerima, telepon, alamat, tanggal_pengiriman, pembayaran, total_bayar) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssssssd", $username, $id_pesanan, $nama, $telepon, $alamat, $tgl_kirim, $bayar, $grand_total);
    mysqli_stmt_execute($stmt);

    // 2. Simpan item ke tabel order_items (Looping)
    foreach ($_SESSION['cart'] as $id => $qty) {
        $nama_p = "Produk ID: " . $id; // Ambil nama asli dari DB jika sudah integrasi
        $sub = $qty * 10000; // Hitung subtotal
        $sql_item = "INSERT INTO order_items (id_pesanan, nama_produk, jumlah, subtotal) VALUES (?, ?, ?, ?)";
        $stmt_item = mysqli_prepare($conn, $sql_item);
        mysqli_stmt_bind_param($stmt_item, "ssii", $id_pesanan, $nama_p, $qty, $sub);
        mysqli_stmt_execute($stmt_item);
    }

    unset($_SESSION['cart']);
    $pesanan_sukses = true;
}

include 'header.php';
?>

<div class="main-content">
    <div class="container">
        <div class="checkout-wrapper">
            <?php if ($pesanan_sukses): ?>
                <div class="success-box">
                    <div class="success-icon">🎉</div>
                    <h2>Pesanan Berhasil!</h2>
                    <p>Terima kasih telah berbelanja di MyBread.</p>
                    <a href="pesanan.php" class="btn btn-detail">Lihat Status Pesanan</a>
                </div>
            <?php else: ?>
                <form method="POST" action="">
                    <button type="submit" name="proses_checkout" class="btn btn-tambah btn-submit">Buat Pesanan Sekarang</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>