<?php
include '../koneksi.php';

if (isset($_POST['proses'])) {
    $invoice_id = $_POST['invoice_id'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $extension = $_POST['extension'];

    $query_total = "SELECT payment FROM invoice WHERE invoice_id = '$invoice_id'";
    $result_total = mysqli_query($conn, $query_total);
    $row_total = mysqli_fetch_assoc($result_total);
    $total_sebelumnya = $row_total['payment'];

    $query_insert = "INSERT INTO invoice_detail (invoice_id, product_id, quantity, extension) 
                     VALUES ('$invoice_id', '$product_id', '$quantity', '$extension')";
    $result_insert = mysqli_query($conn, $query_insert);

if ($result_insert) {
        $total = $total_sebelumnya + $extension;
        mysqli_query($conn, "UPDATE invoice SET payment='$total' WHERE invoice_id = '$invoice_id'");
        header("Location: invoicedetail-lihat.php?invoice_id=$invoice_id");
        exit;
    }
}

    
    if (isset($_GET['invoice_id'])) {
        $invoice_id = $_GET['invoice_id'];
        $query_header = mysqli_query($conn, "SELECT i.*, c.customer_name 
                                                FROM invoice i 
                                                JOIN customer c ON i.customer_id = c.customer_id 
                                                WHERE i.invoice_id = '$invoice_id'");
            
            $data = mysqli_fetch_assoc($query_header);

            if ($data) {
                // Format tanggal untuk ditampilkan di input
                $invoice_date = date('d/m/Y', strtotime($data['invoice_date']));
            } else {
                die("Data Invoice $invoice_id tidak ditemukan di database.");
            }
        } else {
            die("ID Invoice tidak ditemukan.");
    }

// --- LOGIKA PAGINATION UNTUK TABEL DETAIL ---
$limit = 2; // Batas jumlah baris per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$mulai_dari = ($page > 1) ? ($page * $limit) - $limit : 0;

$query_count = mysqli_query($conn, "SELECT COUNT(*) AS total FROM invoice_detail WHERE invoice_id = '$invoice_id'");
$row_count = mysqli_fetch_assoc($query_count);
$total_data = $row_count['total'];
$total_halaman = ceil($total_data / $limit);

$start_item = ($total_data > 0) ? $mulai_dari + 1 : 0;
$end_item = min($mulai_dari + $limit, $total_data);
?>

<!doctype html>
<html lang="en">
<head>
    <title>invoicedetail-lihat</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        /* --- DESIGN MINIMALIS & MODERN --- */
        body { background-color: #f8f9fa; font-family: 'Poppins', sans-serif; }
        :root { --accent-color: #00bfa5; --accent-hover: #00a08a; --sidebar-bg: #1a1d21; --light-text: rgba(255, 255, 255, 0.7); }

        #sidebar { background: var(--sidebar-bg); }
        #sidebar ul li a { font-size: 13px; color: var(--light-text); padding: 12px 20px; transition: all 0.3s; border-radius: 5px; margin: 2px 10px; }
        #sidebar ul li a:hover { background: rgba(255, 255, 255, 0.05); color: #fff; }
        #sidebar ul li.active>a { background: var(--accent-color); color: #fff !important; font-weight: 500; box-shadow: 0 4px 15px rgba(0,191,165,0.2); }

        #content { background-color: #f8f9fa; padding: 20px 30px !important; }
        .navbar { background: #fff; border: none; box-shadow: 0 2px 10px rgba(0,0,0,0.03); border-radius: 10px; margin-bottom: 15px; }

        .page-title-box { background: #fff; padding: 10px 20px; border-radius: 12px; box-shadow: 0 3px 15px rgba(0,0,0,0.02); margin-bottom: 15px; }
        .page-title-box h3 { margin: 0; font-size: 1.1rem; color: #333; font-weight: 700; display: flex; align-items: center; gap: 10px; }
        .page-title-box .icon-wrapper { background: rgba(0, 191, 165, 0.1); color: var(--accent-color); padding: 6px 10px; border-radius: 8px; font-size: 1rem; }

        .form-card { background: #fff; padding: 20px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.03); margin-bottom: 15px;}
        
        .info-header-kecil label { font-size: 11px; margin-bottom: 2px; color:#555; }
        .info-header-kecil input { font-size: 11px; padding: 4px 8px; height: auto; background-color: #f8f9fa; border: 1px solid #eee; border-radius: 6px; }
        
        .table-kecil th, .table-kecil td { font-size: 11px; padding: 6px !important; vertical-align: middle; }
        .table-kecil strong { font-size: 11px; }
        .table-kecil thead th { background-color: #f1f3f5 !important; border: none; color: #495057; text-transform: uppercase; letter-spacing: 0.5px;}
        .table-kecil tbody td { border-bottom: 1px solid #f1f3f5; }

        .btn-super-sm { font-size: 10px; padding: 4px 8px; border-radius: 5px; }
        .btn-success { background-color: #2ecc71; border: none; }
        .btn-warning-modern { background-color: #ffca28; color: #fff; border: none; }
        .btn-warning-modern:hover { background-color: #ffb300; color: #fff; }
        .btn-danger { background-color: #ff5252; border: none; }
        
        .pagination-sm .page-item .page-link { color: #6c757d; border: 1px solid #dee2e6; font-size:11px; padding: 4px 8px;}
        .pagination-sm .page-item.active .page-link { background-color: var(--accent-color); border-color: var(--accent-color); color: white; }
    </style>
</head>

<body>
    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar">
            <div class="p-4 pt-5">
                <a href="#" class="img logo rounded-circle mb-5" style="background-image: url(../images/bengkel.png);"></a>
                <ul class="list-unstyled components mb-5">
                    <li><a href="../home.php"><i class="fa-solid fa-home mr-2"></i> Home</a></li>
                    <li><a href="../customer/customerlihat.php"><i class="fa-solid fa-users mr-2"></i> customer</a></li>
                    <li><a href="../product/productlihat.php"><i class="fa-solid fa-box mr-2"></i> product</a></li>
                    <li class="active"><a href="../invoice/invoicelihat.php"  aria-expanded="false"><i class="fa-solid fa-file-invoice mr-2"></i> invoice</a></li>
                    <li><a href="../index.php" onclick="return confirm('yakin keluar?')"><i class="fa-solid fa-sign-out-alt mr-2"></i> Logout</a></li>
                </ul>
                <div class="footer">
                    <p>Mbd &copy;<script>document.write(new Date().getFullYear());</script> <br>  <i class="icon-heart" aria-hidden="true"></i></p>
                </div>
            </div>
        </nav>

        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-primary"><i class="fa-solid fa-bars"></i></button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item"><a class="nav-link" href="../home.php">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="../customer/customerlihat.php">customer</a></li>
                            <li class="nav-item"><a class="nav-link" href="../product/productlihat.php">product</a></li>
                            <li class="nav-item active"><a class="nav-link" href="../invoice/invoicelihat.php">invoice</a></li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="page-title-box d-flex justify-content-between align-items-center">
                <h3><span class="icon-wrapper"><i class="fa-solid fa-list"></i></span> Detail Invoice: <?php echo htmlspecialchars($data['invoice_id']);?></h3>
                <a class="btn btn-danger rounded-pill" style="font-size: 11px; padding: 4px 12px;" href="invoicelihat.php">
                    <i class="fa-solid fa-arrow-left"></i> Kembali
                </a>
            </div>

            <div class="form-card info-header-kecil mb-3 pb-2 pt-3">
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <label style="font-weight: bold;">TANGGAL</label>
                        <input class="form-control" value="<?php echo $invoice_date; ?>" readonly>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label style="font-weight: bold;">CUSTOMER</label>
                        <input class="form-control" value="<?php echo htmlspecialchars($data['customer_id'] . " - " . $data['customer_name']); ?>" readonly>
                    </div>
                    <div class="col-md-2 mb-2">
                        <label style="font-weight: bold;">NO. PO</label>
                        <input class="form-control" value="<?php echo htmlspecialchars($data['no_po']); ?>" readonly>
                    </div>
                    <div class="col-md-2 mb-2">
                        <label style="font-weight: bold;">NO. PR</label>
                        <input class="form-control" value="<?php echo htmlspecialchars($data['no_pr']); ?>" readonly>
                    </div>
                </div>
            </div>

            <div class="form-card pb-2 pt-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 style="font-size: 13px; font-weight:700; margin:0;">Item Barang</h6>
                    <div>
                        <a type="button" class="btn btn-success btn-super-sm" href="invoicedetail-tambah.php?invoice_id=<?php echo htmlspecialchars($data['invoice_id']); ?>"><i class="fa-solid fa-plus"></i> Tambah</a>
                        <a type="button" class="btn btn-warning-modern btn-super-sm" href="invoicecetak.php?invoice_id=<?php echo htmlspecialchars($data['invoice_id']); ?>"><i class="fa-solid fa-print"></i> Cetak</a>
                    </div>
                </div>
                
                <table class="table table-hover table-sm table-kecil" width='100%' style="text-align: center; margin-bottom: 0;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Qty</th>
                            <th style="text-align:left;">Description</th>
                            <th style="text-align:right;">Price</th>
                            <th style="text-align:right;">Extension</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $index = $mulai_dari + 1;
                        $query = mysqli_query($conn, "SELECT B.product_id, B.description, B.price, B.unit, DB.quantity, N.invoice_id, DB.extension
                                                        FROM invoice N
                                                        JOIN invoice_detail DB ON N.invoice_id = DB.invoice_id
                                                        JOIN product B ON DB.product_id = B.product_id
                                                        WHERE N.invoice_id = '$invoice_id' 
                                                        LIMIT $mulai_dari, $limit");

                        $query_grand_total = mysqli_query($conn, "SELECT SUM(DB.extension) as grand_total FROM invoice_detail DB WHERE DB.invoice_id = '$invoice_id'");
                        $row_grand_total = mysqli_fetch_assoc($query_grand_total);
                        $extension_rp_total = $row_grand_total['grand_total'];

                        while ($data_barang = mysqli_fetch_array($query)) {
                            $extension = $data_barang['price'] * $data_barang['quantity'];
                        ?>
                            <tr>
                                <td><?php echo $index++; ?></td>
                                <td><?php echo htmlspecialchars($data_barang['quantity'] . " " . strtoupper($data_barang['unit'])); ?></td>
                                <td style="text-align:left;"><?php echo htmlspecialchars($data_barang['description']); ?></td>
                                <td style="text-align: right;">Rp <?php echo number_format($data_barang['price'], 0, ',', '.'); ?></td>
                                <td style="text-align: right; font-weight:600;">Rp <?php echo number_format($extension, 0, ',', '.'); ?></td>
                                <td>
                                    <a class="btn btn-warning-modern btn-super-sm" href="invoicedetail-ubah.php?invoice_id=<?php echo $data_barang['invoice_id']; ?>&product_id=<?php echo $data_barang['product_id']; ?>"><i class="fa-solid fa-pen"></i></a> 
                                    <a class="btn btn-danger btn-super-sm" href="invoicedetail-hapus.php?invoice_id=<?php echo $data_barang['invoice_id']; ?>&product_id=<?php echo $data_barang['product_id']; ?>" onclick="return confirm('Yakin hapus?')"><i class="fa-solid fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php 
                        } 
                        mysqli_query($conn, "UPDATE invoice SET payment = '$extension_rp_total' WHERE invoice_id = '$invoice_id'");
                        ?>
                        <tr style="background-color: #fafafa;">
                            <td colspan="4" style="text-align: right;"> <strong> TOTAL HARGA </strong> </td>
                            <td style="text-align: right; color:var(--accent-color);"> <strong> Rp <?php echo number_format($extension_rp_total, 0, ',', '.'); ?> </strong> </td>
                            <td></td>
                        </tr>
                    </tbody>
                </table> 
                
                <div class="d-flex justify-content-between align-items-center mt-2">
                    <div class="text-secondary" style="font-size: 10px;">
                        Showing <?php echo $start_item; ?> to <?php echo $end_item; ?> of <?php echo $total_data; ?> entries
                    </div>
                    <nav>
                        <ul class="pagination pagination-sm mb-0">
                            <li class="page-item <?php if($page <= 1){ echo 'disabled'; } ?>">
                                <a class="page-link" href="<?php if($page > 1){ echo "?invoice_id=$invoice_id&page=".($page - 1); } else { echo '#'; } ?>">Prev</a>
                            </li>
                            <?php for($i = 1; $i <= $total_halaman; $i++): ?>
                                <li class="page-item <?php if($page == $i){ echo 'active'; } ?>">
                                    <a class="page-link" href="?invoice_id=<?php echo $invoice_id; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                </li>
                            <?php endfor; ?>
                            <li class="page-item <?php if($page >= $total_halaman){ echo 'disabled'; } ?>">
                                <a class="page-link" href="<?php if($page < $total_halaman){ echo "?invoice_id=$invoice_id&page=".($page + 1); } else { echo '#'; } ?>">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/jquery.min.js"></script>
    <script src="../js/popper.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/main.js"></script>
</body>
</html>