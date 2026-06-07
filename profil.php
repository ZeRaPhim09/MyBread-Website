<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'koneksi.php';
// Wajib login untuk melihat profil
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['user'];
// Mengambil data pengguna dari session
$user_data = isset($_SESSION['user_data']) ? $_SESSION['user_data'] : [];

// Panggil Header Modular
$page_title = "Profil Saya - MyBread";
include 'header.php';
?>

<style>
    /* Desain Kartu Profil Modern */
    .profile-wrapper {
        background: #FFFFFF;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(44,30,24,0.05);
        padding: 40px;
        max-width: 600px;
        margin: 0 auto 50px auto;
    }

    .profile-header {
        text-align: center;
        margin-bottom: 35px;
    }

    /* Lingkaran Avatar */
    .profile-avatar {
        font-size: 60px;
        background: #FDFBF7;
        width: 110px;
        height: 110px;
        line-height: 110px; /* Menyelaraskan emoji ke tengah */
        border-radius: 50%;
        display: inline-block;
        border: 3px solid #E0A96D;
        box-shadow: 0 5px 15px rgba(224, 169, 109, 0.2);
        margin-bottom: 15px;
    }

    .profile-header h2 {
        color: #2C1E18;
        font-size: 28px;
        margin: 0;
        font-weight: 800;
    }

    .profile-header p {
        color: #777;
        margin: 5px 0 0 0;
        font-size: 15px;
    }

    /* Kotak Detail Informasi */
    .profile-details {
        background: #FAFAFA;
        border: 2px solid #F0E6D6;
        border-radius: 15px;
        padding: 10px 30px;
    }

    .detail-row {
        display: flex;
        justify-content: space-between;
        padding: 20px 0;
        border-bottom: 1px solid #F0E6D6;
    }

    /* Hilangkan garis bawah pada baris terakhir */
    .detail-row:last-child {
        border-bottom: none;
        flex-direction: column; /* Alamat dibuat atas-bawah agar lega */
    }

    .detail-label {
        color: #555;
        font-weight: 600;
        font-size: 15px;
    }

    .detail-value {
        color: #2C1E18;
        font-weight: 800;
        font-size: 15px;
        text-align: right;
    }

    /* Khusus untuk teks alamat */
    .detail-row:last-child .detail-value {
        text-align: left;
        margin-top: 10px;
        line-height: 1.6;
    }

    .profile-actions {
        margin-top: 35px;
        text-align: center;
    }

    /* Responsif HP */
    @media (max-width: 768px) {
        .profile-wrapper { padding: 30px 20px; }
        .detail-row { flex-direction: column; gap: 5px; }
        .detail-value { text-align: left; }
    }
</style>

<div class="main-content">
    <div class="container">
        <h2 style="text-align: center; border-bottom: 2px solid #C97A3E; padding-bottom: 5px; display: table; margin: 0 auto 30px auto; color: #2C1E18;">Pengaturan Akun</h2>

        <div class="profile-wrapper">
            <div class="profile-header">
                <div class="profile-avatar">🧑‍🍳</div>
                <h2>Profil Saya</h2>
                <p>Informasi detail akun Anda</p>
            </div>

            <div class="profile-details">
                <div class="detail-row">
                    <span class="detail-label">Nama Lengkap</span>
                    <span class="detail-value"><?= isset($user_data['nama']) ? htmlspecialchars($user_data['nama']) : '-' ?></span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">Username</span>
                    <span class="detail-value"><?= htmlspecialchars($username) ?></span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">Email</span>
                    <span class="detail-value"><?= isset($user_data['email']) ? htmlspecialchars($user_data['email']) : '-' ?></span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">NIK</span>
                    <span class="detail-value"><?= isset($user_data['nik']) ? htmlspecialchars($user_data['nik']) : '-' ?></span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">No. Telepon / WA</span>
                    <span class="detail-value"><?= isset($user_data['telepon']) ? htmlspecialchars($user_data['telepon']) : '-' ?></span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">Alamat Pengiriman Utama</span>
                    <span class="detail-value">
                        <?= isset($user_data['alamat']) ? nl2br(htmlspecialchars($user_data['alamat'])) : '-' ?>
                    </span>
                </div>
            </div>

            <div class="profile-actions">
                <a href="index.php" class="btn btn-detail" style="padding: 14px 40px; font-size: 16px;">Kembali ke Home</a>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>