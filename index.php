<?php
session_start();

include 'koneksi.php';

// Proses Logout
if (isset($_GET['logout'])) {
    unset($_SESSION['user']);
    header("Location: index.php");
    exit();
}

// PANGGIL HEADER DI SINI
$page_title = "Toko Makanan - Home";
include 'header.php'; 
?>

<style>
    /* Slider Produk Unggulan Berbentuk Card Fullscreen */
    .featured-wrapper {
        max-width: 800px;
        margin: 0 auto 50px auto;
        position: relative;
    }
    
    .featured-card {
        border-radius: 20px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2); /* Shadow lebih pekat agar menonjol */
        overflow: hidden;
        position: relative;
        background: #2C1E18; /* Warna dasar jika gambar telat dimuat */
    }
    
    .featured-slide {
        display: none;
        animation: fadeEffect 0.8s;
        position: relative;
        height: 480px; /* Tinggi keseluruhan card */
    }
    
    .featured-slide img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    /* Info Teks Melayang (Overlay) dengan Gradasi Gelap */
    .featured-info {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        padding: 80px 30px 35px 30px; /* Padding atas lebih besar untuk gradasi mulus */
        text-align: center;
        background: linear-gradient(to top, rgba(20, 10, 5, 0.95) 0%, rgba(20, 10, 5, 0.5) 60%, transparent 100%);
        box-sizing: border-box;
    }
    
    .featured-info h3 {
        font-size: 28px;
        color: #FFFFFF; /* Teks diubah jadi putih */
        margin-bottom: 10px;
        font-weight: 800;
        text-shadow: 0 2px 4px rgba(0,0,0,0.5); /* Efek bayangan agar teks terbaca jelas */
    }
    
    .featured-info p {
        color: #FDFBF7; /* Teks diubah jadi warna terang */
        font-size: 15px;
        line-height: 1.6;
        margin: 0 auto;
        max-width: 600px;
        opacity: 0.9;
    }
    
    .rating-stars {
        color: #F6BD60;
        font-size: 15px;
        margin-bottom: 8px;
    }
    
    /* Memaksa warna tulisan "(Terjual...)" menjadi abu-abu terang */
    .rating-stars span {
        color: #E0E0E0 !important; 
    }
    
    /* Panah Kiri Kanan */
    .arrow-btn {
        cursor: pointer;
        position: absolute;
        top: 50%; /* Diturunkan sedikit ke tengah card */
        transform: translateY(-50%);
        width: 50px;
        height: 50px;
        background: rgba(253, 251, 247, 0.85); /* Efek glassmorphism */
        backdrop-filter: blur(5px);
        color: #C97A3E;
        font-size: 20px;
        font-weight: bold;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 0 5px 15px rgba(0,0,0,0.15);
        transition: 0.3s;
        z-index: 10;
        user-select: none;
    }
    
    .arrow-btn:hover { background: #C97A3E; color: white; }
    .arrow-left { left: -25px; }
    .arrow-right { right: -25px; }

    /* Titik Indikator Bawah Tengah */
    .dots-wrapper {
        text-align: center;
        padding-top: 25px;
    }
    
    .dot-indicator {
        cursor: pointer;
        height: 10px;
        width: 10px;
        margin: 0 5px;
        background-color: #E0A96D;
        border-radius: 50%;
        display: inline-block;
        transition: 0.3s ease;
        opacity: 0.4;
    }
    
    .dot-indicator.active, .dot-indicator:hover {
        opacity: 1;
        transform: scale(1.3);
        background-color: #C97A3E;
    }
    
    @keyframes fadeEffect { from {opacity: 0.5} to {opacity: 1} }

    /* Responsif untuk layar kecil (HP) */
    @media (max-width: 768px) {
        .featured-slide { height: 380px; }
        .featured-info { padding: 60px 20px 25px 20px; }
        .featured-info h3 { font-size: 22px; }
        .arrow-left { left: 10px; }
        .arrow-right { right: 10px; }
        .checkout-box { flex-direction: column !important; padding: 25px !important; }
    }
</style>

<div class="main-content">

    <?php if (!isset($_SESSION['user'])): ?>
        <div class="hero-section">
            <div class="hero-content">
                <h1>Selamat Datang di Toko Kami</h1>
                <p>Jelajahi kelezatan roti premium kami. Silakan masuk atau buat akun untuk melihat katalog lengkap dan mulai berbelanja.</p>
                <div style="display: flex; gap: 15px; justify-content: center; margin-top: 20px;">
                    <a href="login.php" class="btn btn-detail hero-btn">Login Sekarang</a>
                </div>
            </div>
        </div>

        <div class="container" style="margin-top: 50px;">
            
            <div style="text-align: center; margin-bottom: 30px;">
                <h2 style="color: #2C1E18; font-size: 30px; margin-top:0; border-bottom: 2px solid #E0A96D; display: inline-block; padding-bottom: 10px;">Produk Unggulan Kami</h2>
            </div>

            <div class="featured-wrapper">
                <div class="featured-card">
                    <div class="featured-slide">
                        <img src="img/croissant.jpeg" alt="Croissant">
                        <div class="featured-info">
                            <div class="rating-stars">★★★★★ <span style="color:#888; font-size:12px;">(Terjual 1.2k+)</span></div>
                            <h3>Croissant Premium</h3>
                            <p>Croissant ala Prancis yang sangat renyah di luar dengan aroma mentega premium yang menggugah selera.</p>
                        </div>
                    </div>
                    <div class="featured-slide">
                        <img src="img/roti.jpg" alt="Roti Sobek">
                        <div class="featured-info">
                            <div class="rating-stars">★★★★★ <span style="color:#888; font-size:12px;">(Terjual 980+)</span></div>
                            <h3>Roti Sobek Manis</h3>
                            <p>Roti sobek sangat empuk dengan serat halus dan rasa manis yang pas. Cocok dinikmati bersama teh hangat.</p>
                        </div>
                    </div>
                    <div class="featured-slide">
                        <img src="img/maryam.jpg" alt="Maryam">
                        <div class="featured-info">
                            <div class="rating-stars">★★★★☆ <span style="color:#888; font-size:12px;">(Terjual 850+)</span></div>
                            <h3>Roti Maryam Gurih</h3>
                            <p>Roti berlapis yang gurih dan renyah di luar, lembut di dalam. Sangat lezat dimakan langsung atau dicelup kuah kari.</p>
                        </div>
                    </div>
                    <div class="featured-slide">
                        <img src="img/baguette.jpeg" alt="Baguette">
                        <div class="featured-info">
                            <div class="rating-stars">★★★★★ <span style="color:#888; font-size:12px;">(Terjual 500+)</span></div>
                            <h3>Classic Baguette</h3>
                            <p>Roti panjang khas Prancis yang otentik. Bertekstur keras di luar namun lembut berongga di dalam.</p>
                        </div>
                    </div>
                </div>

                <a class="arrow-btn arrow-left" onclick="geserSlide(-1)">&#10094;</a>
                <a class="arrow-btn arrow-right" onclick="geserSlide(1)">&#10095;</a>

                <div class="dots-wrapper">
                    <span class="dot-indicator" onclick="lompatSlide(1)"></span> 
                    <span class="dot-indicator" onclick="lompatSlide(2)"></span> 
                    <span class="dot-indicator" onclick="lompatSlide(3)"></span> 
                    <span class="dot-indicator" onclick="lompatSlide(4)"></span> 
                </div>
            </div>

            <div style="text-align: center; margin-top: 50px; margin-bottom: 30px;">
                <h2 style="color: #2C1E18; font-size: 30px; margin-top:0; border-bottom: 2px solid #E0A96D; display: inline-block; padding-bottom: 10px;">Apa Kata Mereka?</h2>
            </div>

            <div class="slider-wrapper">
                <div class="slider-track">
                    <div class="testi-card">
                        <div class="stars">★★★★★</div>
                        <p class="testi-text">"Roti sobeknya benar-benar lembut dan wangi menteganya premium banget. Wajib coba, keluarga saya sangat suka!"</p>
                        <h4 class="testi-name">- Sarah W.</h4>
                    </div>
                    <div class="testi-card">
                        <div class="stars">★★★★★</div>
                        <p class="testi-text">"Pengiriman sangat cepat dan roti sampai dalam keadaan masih hangat. Pelayanannya juara, websitenya juga mudah digunakan."</p>
                        <h4 class="testi-name">- Zeraphim</h4>
                    </div>
                    <div class="testi-card">
                        <div class="stars">★★★★☆</div>
                        <p class="testi-text">"Croissant-nya flaky dan renyah parah. Rasanya nggak kalah sama bakery bintang 5 di mall besar."</p>
                        <h4 class="testi-name">- Budi Santoso</h4>
                    </div>
                </div>
            </div>

        </div>

    <?php else: ?>

        <div class="hero-section">
            <div class="hero-content">
                <h1>Halo, <?= htmlspecialchars($_SESSION['user']) ?>!</h1>
                <p>Selamat datang kembali di dapur kami. Roti hangat dan manis spesial hari ini sudah menanti untuk Anda pesan.</p>
                <a href="produk.php" class="btn btn-tambah hero-btn">Mulai Belanja</a>
            </div>
        </div>

        <div class="container" style="margin-top: 40px;">
            <div class="checkout-box" style="display: flex; gap: 40px; align-items: center;">
                <div style="flex: 1.2;">
                    <h2 style="color: #C97A3E; font-size: 32px; margin-top:0; margin-bottom:5px;">Profil Eksklusif Member</h2>
                    <h4 style="color: #777; font-size: 16px; margin-top:0; margin-bottom: 25px; font-weight: normal;">Rahasia Dapur Kami Sejak 2020</h4>
                    
                    <p style="line-height: 1.8; color: #555; font-size: 16px; text-align: justify; margin-bottom: 15px;">
                        Terima kasih telah bergabung sebagai member setia kami, <strong><?= htmlspecialchars($_SESSION['user']) ?></strong>. Sebagai member, Anda kini memiliki akses penuh ke seluruh katalog produk kami, termasuk varian roti <em>limited edition</em> yang kami panggang khusus setiap akhir pekan.
                    </p>
                    
                    <p style="line-height: 1.8; color: #555; font-size: 16px; text-align: justify; margin-bottom: 25px;">
                        Rahasia dari kelembutan Roti Sobek dan kerenyahan Croissant kami terletak pada ragi alami (<em>sourdough starter</em>) yang kami budidayakan sendiri dengan sabar selama bertahun-tahun. Kami juga hanya menggunakan mentega premium dari sapi perah pilihan untuk memastikan aroma wangi khas yang tidak bisa Anda temukan di tempat lain.
                    </p>

                    <div style="background: #FDFBF7; padding: 15px 20px; border-radius: 8px; border-left: 5px solid #F6BD60;">
                        <p style="margin: 0; font-size: 15px; font-weight: bold; color: #2C1E18;">🌟 Promo Spesial Member: Nikmati gratis ongkos kirim untuk setiap pembelanjaan di atas Rp. 100.000!</p>
                    </div>
                </div>
                
                <div style="flex: 1; text-align: center;">
                    <img src="img/toko1.jpg" style="width: 100%; border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);" alt="Dapur Toko">
                </div>
            </div>
        </div>

    <?php endif; ?>

</div> <script>
    let indexGambar = 1;
    tampilGambar(indexGambar);

    function geserSlide(n) { tampilGambar(indexGambar += n); }
    function lompatSlide(n) { tampilGambar(indexGambar = n); }

    function tampilGambar(n) {
        let i;
        let slides = document.getElementsByClassName("featured-slide");
        let dots = document.getElementsByClassName("dot-indicator");
        
        if (slides.length === 0) return; // Mencegah error jika di halaman login

        if (n > slides.length) { indexGambar = 1 }    
        if (n < 1) { indexGambar = slides.length }
        
        for (i = 0; i < slides.length; i++) { slides[i].style.display = "none"; }
        for (i = 0; i < dots.length; i++) { dots[i].className = dots[i].className.replace(" active", ""); }
        
        slides[indexGambar - 1].style.display = "block";  
        dots[indexGambar - 1].className += " active";
    }

    // Auto-play setiap 5 detik
    setInterval(function() {
        if(document.getElementsByClassName("featured-slide").length > 0){
            geserSlide(1);
        }
    }, 5000);
</script>

<?php 
// PANGGIL FOOTER DI SINI (Berada di luar main-content)
include 'footer.php'; 
?>