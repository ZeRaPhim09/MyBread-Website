<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'koneksi.php';
// Wajib login untuk melihat pesanan
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['user'];
$riwayat = isset($_SESSION['riwayat_pesanan'][$username]) ? $_SESSION['riwayat_pesanan'][$username] : [];

// Panggil Header Modular
$page_title = "Riwayat Pesanan - MyBread";
include 'header.php';
?>

<style>
    /* Desain Kotak Riwayat Modern */
    .history-wrapper {
        background: #FFFFFF;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(44,30,24,0.05);
        padding: 40px;
        margin-bottom: 50px;
    }

    /* Agar tabel bisa digeser di HP */
    .table-responsive {
        overflow-x: auto;
    }

    /* Styling Tabel Modern (Sama seperti Keranjang) */
    .table-pesanan { 
        width: 100%; 
        border-collapse: collapse; 
        min-width: 600px; /* Mencegah tabel terlalu sempit di layar kecil */
    }
    
    .table-pesanan th { 
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
    
    .table-pesanan td { 
        padding: 20px 10px; 
        border-bottom: 1px solid #F0E6D6; 
        vertical-align: middle; 
        color: #555;
        font-size: 15px;
    }

    .pesanan-id {
        font-weight: 800;
        color: #2C1E18;
    }

    .pesanan-total {
        font-weight: 800;
        color: #C97A3E;
        font-size: 16px;
    }

    /* Badge Status */
    .badge-status { 
        background-color: #F6BD60; 
        color: #2C1E18; 
        padding: 6px 15px; 
        border-radius: 20px; 
        font-size: 12px; 
        font-weight: 800; 
        display: inline-block;
    }

    /* Tampilan Kosong */
    .empty-history {
        text-align: center;
        padding: 60px 20px;
    }

    /* Responsif untuk HP */
    @media (max-width: 768px) {
        .history-wrapper { padding: 20px; }
        .table-pesanan th, .table-pesanan td { padding: 15px 5px; font-size: 14px; }
    }
</style>

<div class="main-content">
    <div class="container">
        <h2 style="border-bottom: 2px solid #C97A3E; color: #2C1E18; padding-bottom: 5px; display: inline-block; margin-bottom: 30px;">Riwayat Pesanan Saya</h2>

        <div class="history-wrapper">
            <?php if (empty($riwayat)): ?>
                <div class="empty-history">
                    <div style="font-size: 60px; margin-bottom: 15px;">📜</div>
                    <h3 style="color: #2C1E18;">Belum Ada Pesanan</h3>
                    <p style="color: #777; font-size: 16px; margin-bottom: 25px;">Anda belum melakukan pemesanan apa pun. Yuk, intip katalog lezat kami!</p>
                    <a href="produk.php" class="btn btn-tambah" style="padding: 12px 35px; font-size: 16px;">Mulai Belanja</a>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table-pesanan">
                        <thead>
                            <tr>
                                <th>ID Pesanan</th>
                                <th>Tanggal</th>
                                <th>Total Belanja</th>
                                <th>Status</th>
                                <th style="text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach (array_reverse($riwayat, true) as $index => $pesanan): ?>
                            <tr>
                                <td class="pesanan-id"><?= $pesanan['id_pesanan'] ?></td>
                                <td><?= $pesanan['tanggal'] ?></td>
                                <td class="pesanan-total">Rp. <?= number_format($pesanan['total_bayar'], 0, ',', '.') ?></td>
                                <td><span class="badge-status"><?= $pesanan['status'] ?></span></td>
                                <td style="text-align: center;">
                                    <a href="detail_pesanan.php?id=<?= $index ?>" class="btn btn-detail" style="padding: 8px 15px; font-size: 13px; border-radius: 8px;">Lihat Detail</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>