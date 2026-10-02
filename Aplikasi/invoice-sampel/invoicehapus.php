<?php
// Hubungkan ke database
include '../koneksi.php';

// Pastikan parameter invoice_id ada di URL
if (isset($_GET['invoice_id'])) {
    // Sanitasi input
    $invoice_id = mysqli_real_escape_string($conn, $_GET['invoice_id']);

    // Cukup jalankan SATU query pada tabel induk (invoice)
    // Karena ON DELETE CASCADE aktif, database otomatis menghapus baris di invoice_detail
    $query = "DELETE FROM invoice WHERE invoice_id = '$invoice_id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Berhasil, kembali ke daftar invoice
        header("Location: invoicelihat.php");
        exit();
    } else {
        // Tampilkan error jika query gagal
        echo "Gagal menghapus invoice: " . mysqli_error($conn);
    }
} else {
    echo "ID Invoice tidak ditemukan.";
}
?>