<?php
if (session_status() === PHP_SESSION_NONE) { 
    session_start(); 
}
include 'koneksi.php';

// Panggil Header Modular
$page_title = "Tentang Kami - MyBread";
include 'header.php';
?>

<style>
    /* Desain Container About Us Modern */
    .about-wrapper {
        background: #FFFFFF;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(44,30,24,0.05);
        padding: 50px;
        max-width: 900px;
        margin: 0 auto 50px auto;
    }

    .about-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .about-header h2 {
        color: #2C1E18;
        font-size: 32px;
        display: inline-block;
        border-bottom: 3px solid #C97A3E;
        padding-bottom: 10px;
        margin: 0;
    }

    /* Flexbox untuk Teks dan Gambar (Bisa diisi gambar dapur/toko) */
    .about-content {
        display: flex;
        gap: 40px;
        align-items: center;
        margin-bottom: 40px;
    }

    .about-text {
        flex: 1;
        color: #555;
        line-height: 1.8;
        font-size: 16px;
        text-align: justify;
    }

    .about-image {
        flex: 1;
        text-align: center;
    }

    .about-image img {
        width: 100%;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        object-fit: cover;
    }

    /* Styling Kotak Visi Misi */
    .vision-mission {
        background: #FDFBF7;
        padding: 30px;
        border-radius: 15px;
        border-left: 5px solid #F6BD60;
        margin-bottom: 40px;
    }

    .vision-mission h3 { 
        color: #C97A3E; 
        margin-top: 0; 
        font-size: 22px; 
    }

    /* Styling Grid Kontak */
    .contact-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    .contact-card {
        background: #FAFAFA;
        border: 2px solid #F0E6D6;
        padding: 25px 20px;
        border-radius: 15px;
        text-align: center;
        transition: transform 0.3s;
    }

    .contact-card:hover {
        transform: translateY(-5px);
        border-color: #C97A3E;
    }

    .contact-card .icon { 
        font-size: 35px; 
        margin-bottom: 10px; 
    }

    .contact-card strong {
        color: #2C1E18;
        font-size: 18px;
        display: block;
        margin-bottom: 5px;
    }

    /* Bagian Bawah: Arahkan ke Menu */
    .cta-section {
        text-align: center;
        margin-top: 50px;
        padding-top: 40px;
        border-top: 2px dashed #F0E6D6;
    }

    /* Responsif untuk HP */
    @media (max-width: 768px) {
        .about-wrapper { padding: 30px 20px; }
        .about-content { flex-direction: column; }
    }
</style>

<div class="main-content">
    <div class="container">
        <div class="about-wrapper">
            
            <div class="about-header">
                <h2>Tentang Kami</h2>
            </div>

            <div class="about-content">
                <div class="about-text">
                    <h3 style="color: #C97A3E; margin-top:0; font-size: 24px;">Selamat Datang di MyBread!</h3>
                    <p>
                        Kami adalah penyedia berbagai macam roti dan kue lezat untuk menemani hari-hari Anda. Mulai dari Roti Sobek yang lembut hingga Roti Maryam yang gurih, semua dibuat dengan bahan berkualitas premium dan dipanggang segar setiap hari.
                    </p>
                    <p>
                        Kami percaya bahwa roti yang lezat tidak hanya mengenyangkan, tetapi juga mampu memberikan kehangatan dan kebahagiaan di setiap momen keluarga Anda.
                    </p>
                </div>
                <div class="about-image">
                    <img src="img/toko1.jpg" alt="Dapur MyBread" onerror="this.src='https://images.unsplash.com/photo-1509440159596-0249088772ff?q=80&w=800&auto=format&fit=crop'">
                </div>
            </div>

            <div class="vision-mission">
                <h3>🎯 Visi & Misi Kami</h3>
                <ul style="color: #555; line-height: 1.8; font-size: 16px; padding-left: 20px; margin-bottom: 0;">
                    <li><strong>Kualitas Terbaik:</strong> Menyediakan makanan dengan bahan baku premium yang sehat dan harga terjangkau.</li>
                    <li><strong>Kemudahan Akses:</strong> Memberikan pelayanan pemesanan yang cepat dan mudah melalui website modern.</li>
                    <li><strong>Cita Rasa Otentik:</strong> Menjaga higienitas, resep rahasia, dan kehangatan di setiap gigitan roti kami.</li>
                </ul>
            </div>

            <h3 style="color: #2C1E18; text-align: center; font-size: 24px;">Kontak & Lokasi Kami</h3>
            <div class="contact-grid">
                <div class="contact-card">
                    <div class="icon">📞</div>
                    <strong>WhatsApp</strong>
                    <p style="color: #777; margin: 0;">0812-3456-7890</p>
                </div>
                <div class="contact-card">
                    <div class="icon">✉️</div>
                    <strong>Email</strong>
                    <p style="color: #777; margin: 0;">admin@mybread.com</p>
                </div>
                <div class="contact-card">
                    <div class="icon">📍</div>
                    <strong>Alamat</strong>
                    <p style="color: #777; margin: 0;">Jl. Raya Mahasiswa No. 123,<br>Kampus Indah</p>
                </div>
            </div>

            <div class="cta-section">
                <h3 style="color: #2C1E18; font-size: 24px; margin-top: 0;">Penasaran dengan Rasa Roti Kami?</h3>
                <p style="color: #777; margin-bottom: 25px; font-size: 16px;">Jelajahi berbagai pilihan menu lezat yang siap dihidangkan hangat untuk Anda dan keluarga.</p>
                <a href="produk.php" class="btn btn-tambah" style="padding: 14px 40px; font-size: 18px; border-radius: 30px;">🍞 Lihat Katalog Menu Kami</a>
            </div>

        </div>
    </div>
</div>

<?php include 'footer.php'; ?>