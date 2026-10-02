<?php
// Hubungkan ke database
include '../koneksi.php';

// Pastikan parameter invoice_id dan product_id ada di URL
if (isset($_GET['invoice_id']) && isset($_GET['product_id'])) {
    $invoice_id = mysqli_real_escape_string($conn, $_GET['invoice_id']);
    $product_id = mysqli_real_escape_string($conn, $_GET['product_id']);
    
    // 1. Hapus item dari tabel invoice_detail berdasarkan Composite Key (invoice_id + product_id)
    $queryDelete = "DELETE FROM invoice_detail WHERE invoice_id = '$invoice_id' AND product_id = '$product_id' LIMIT 1";
    $result = mysqli_query($conn, $queryDelete);

    if ($result) {
        // 2. Hitung ulang total (SUM) dari sisa barang yang ada di invoice tersebut
        $querySum = "SELECT SUM(extension) AS total_baru FROM invoice_detail WHERE invoice_id = '$invoice_id'";
        $sumResult = mysqli_query($conn, $querySum);
        
        if ($sumResult) {
            $row = mysqli_fetch_assoc($sumResult);
            // Jika tidak ada barang tersisa, set total ke 0
            $total_baru = $row['total_baru'] ?? 0;

            // 3. Update kolom 'payment' di tabel invoice agar saldo sinkron
            $updateInvoice = mysqli_query($conn, "UPDATE invoice SET payment = '$total_baru' WHERE invoice_id = '$invoice_id'");

            if ($updateInvoice) {
                // Berhasil, redirect kembali ke halaman detail invoice
                header("Location: invoicedetail-lihat.php?invoice_id=$invoice_id");
                exit();
            } else {
                echo "Gagal update saldo invoice: " . mysqli_error($conn);
            }
        } else {
            echo "Gagal menghitung total baru: " . mysqli_error($conn);
        }
    } else {
        echo "Gagal menghapus item: " . mysqli_error($conn);
    }
} else {
    echo "Parameter tidak lengkap. Pastikan invoice_id dan product_id tersedia.";
}
?>