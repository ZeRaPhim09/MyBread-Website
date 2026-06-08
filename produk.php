<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
include 'koneksi.php';

$query_reguler = mysqli_query($conn, "SELECT * FROM products WHERE category = 'Reguler'");
$query_custom = mysqli_query($conn, "SELECT * FROM products WHERE category = 'Custom'");

$page_title = "Katalog Menu - MyBread";
include 'header.php'; 
?>

<style>
    .main-content { padding: 40px 0; }
    .container { width: 90%; max-width: 1200px; margin: 0 auto; }
    
    .tab-container { display: flex; justify-content: center; gap: 15px; margin: 30px 0 40px 0; }
    .tab-btn { padding: 12px 30px; border: 2px solid #E0A96D; background: transparent; color: #C97A3E; border-radius: 30px; cursor: pointer; font-weight: 800; font-size: 16px; transition: 0.3s; }
    .tab-btn.active { background-color: #C97A3E; color: #FFFFFF; }
    .tab-content { display: none; }
    .tab-content.active-tab { display: block; }

    .product-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
    }

    .product-card {
        background: #fff;
        border-radius: 15px;
        padding: 15px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        display: flex;
        flex-direction: column;
    }
    
    .product-card img { width: 100%; height: 150px; object-fit: cover; border-radius: 10px; }
    .card-body { padding: 10px 0; flex-grow: 1; }
    
    @media (max-width: 1024px) { .product-grid { grid-template-columns: repeat(3, 1fr); } }
    @media (max-width: 768px) { .product-grid { grid-template-columns: repeat(2, 1fr); } }
</style>

<div class="main-content">
    <div class="container">
        <h2 style="text-align: center; color: #2C1E18;">Katalog Menu Kami</h2>
        
        <div class="tab-container">
            <button class="tab-btn active" onclick="bukaTab(event, 'Reguler')">Roti Reguler</button>
            <button class="tab-btn" onclick="bukaTab(event, 'Custom')">Pesanan Custom</button>
        </div>

        <div id="Reguler" class="tab-content active-tab">
            <div class="product-grid"> 
                <?php while($p = mysqli_fetch_assoc($query_reguler)): ?>
                <div class="product-card">
                    <img src="<?= $p['img'] ?>" alt="<?= $p['name'] ?>">
                    <div class="card-body">
                        <h3><?= $p['name'] ?></h3>
                        <p class="price">Rp. <?= number_format($p['price'], 0, ',', '.') ?></p>
                        <div class="card-buttons">
                            <a href="detail.php?id=<?= $p['id'] ?>" class="btn btn-detail">Detail</a>
                            <a href="detail.php?id=<?= $p['id'] ?>" class="btn btn-tambah">🛒 Tambah</a>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>

        <div id="Custom" class="tab-content">
            <div class="product-grid"> 
                <?php while($p = mysqli_fetch_assoc($query_custom)): ?>
                <div class="product-card">
                    <img src="<?= $p['img'] ?>" alt="<?= $p['name'] ?>">
                    <div class="card-body">
                        <h3><?= $p['name'] ?></h3>
                        <p class="price">Mulai Rp. <?= number_format($p['price'], 0, ',', '.') ?></p>
                        <a href="detail.php?id=<?= $p['id'] ?>&jenis=custom" class="btn btn-detail">Request Custom</a>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</div> <script>
function bukaTab(evt, namaTab) {
    let tabcontent = document.getElementsByClassName("tab-content");
    for (let i = 0; i < tabcontent.length; i++) { tabcontent[i].classList.remove("active-tab"); }
    let tablinks = document.getElementsByClassName("tab-btn");
    for (let i = 0; i < tablinks.length; i++) { tablinks[i].classList.remove("active"); }
    document.getElementById(namaTab).classList.add("active-tab");
    evt.currentTarget.classList.add("active");
}
</script>

<?php include 'footer.php'; ?>