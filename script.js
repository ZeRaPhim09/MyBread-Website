function hitungTotal() {
    // Ambil harga dari span text
    let hargaText = document.getElementById("harga-satuan").innerText;
    let harga = parseInt(hargaText);
    
    // Ambil jumlah input
    let jumlah = document.getElementById("jumlah").value;

    if (jumlah && jumlah > 0) {
        let total = harga * jumlah;
        
        // Format angka ke format Rupiah
        let formattedTotal = new Intl.NumberFormat('id-ID', { 
            style: 'currency', 
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(total);
        
        // Tampilkan teks di bawah tombol (sesuai instruksi no 7)
        document.getElementById("hasil-total").innerHTML = "Berhasil! Total Harga: " + formattedTotal;
        
        // (Opsional) Munculkan pop-up alert
        alert("Produk ditambahkan ke keranjang!\nTotal Harga: " + formattedTotal);
    } else {
        alert("Mohon masukkan jumlah yang valid (minimal 1)!");
    }
}

// Fungsi untuk memunculkan/menyembunyikan dropdown
function toggleDropdown() {
    var menu = document.getElementById("logoutMenu");
    menu.classList.toggle("show-dropdown");
}

// Menutup dropdown jika klik di luar area
window.onclick = function(event) {
    if (!event.target.matches('.dropdown-btn') && !event.target.matches('.dropdown-btn *')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show-dropdown')) {
                openDropdown.classList.remove('show-dropdown');
            }
        }
    }
}

// Menunggu sampai seluruh halaman selesai dimuat
document.addEventListener("DOMContentLoaded", function() {
    
    // Cari elemen yang memiliki class 'alert-success'
    const alertBox = document.querySelector('.alert-success');
    
    if (alertBox) {
        // Tunggu 3 detik (3000 milidetik)
        setTimeout(function() {
            // Beri efek transisi memudar (fade out)
            alertBox.style.transition = "opacity 0.5s ease";
            alertBox.style.opacity = "0";
            
            // Hapus dari halaman setelah efek memudar selesai
            setTimeout(function() {
                alertBox.style.display = "none";
            }, 500); 
            
        }, 3000);
    }
});

// Fungsi untuk Tab Menu Produk
function bukaTab(evt, namaTab) {
    let i, tabcontent, tablinks;
    
    // Sembunyikan semua konten tab
    tabcontent = document.getElementsByClassName("tab-content");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].classList.remove("active-tab");
    }
    
    // Hapus class "active" dari semua tombol
    tablinks = document.getElementsByClassName("tab-btn");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    
    // Tampilkan tab yang dipilih dan tambahkan class "active" pada tombol yang diklik
    document.getElementById(namaTab).classList.add("active-tab");
    evt.currentTarget.className += " active";
}