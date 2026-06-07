<?php
/**
 * Fungsi untuk menghitung total item di dalam keranjang belanja
 */
function hitungTotalKeranjang() {
    $total = 0;
    if (isset($_SESSION['cart']) && isset($_SESSION['user'])) {
        foreach ($_SESSION['cart'] as $qty) {
            $total += $qty;
        }
    }
    return $total;
}
?>