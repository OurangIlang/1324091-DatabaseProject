<!doctype html>
<html lang="en">

<head>
  <title>Product-lihat</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../css/style.css">
  
  <style>
    /* --- DESIGN MINIMALIS & MODERN --- */
    body { background-color: #f8f9fa; font-family: 'Poppins', sans-serif; }
    :root {
        --accent-color: #00bfa5; 
        --accent-hover: #00a08a;
        --sidebar-bg: #1a1d21; 
        --light-text: rgba(255, 255, 255, 0.7);
    }

    #sidebar { background: var(--sidebar-bg); }
    #sidebar ul li a {
        font-size: 13px; color: var(--light-text); padding: 12px 20px;
        transition: all 0.3s; border-radius: 5px; margin: 2px 10px;
    }
    #sidebar ul li a:hover { background: rgba(255, 255, 255, 0.05); color: #fff; }
    #sidebar ul li.active>a {
        background: var(--accent-color); color: #fff !important;
        font-weight: 500; box-shadow: 0 4px 15px rgba(0,191,165,0.2);
    }

    #content { background-color: #f8f9fa; padding: 20px 30px !important; }
    .navbar {
        background: #fff; border: none; box-shadow: 0 2px 10px rgba(0,0,0,0.03);
        border-radius: 10px; margin-bottom: 15px; 
    }

    .page-title-box {
        background: #fff; padding: 12px 20px; border-radius: 12px;
        box-shadow: 0 3px 15px rgba(0,0,0,0.02); margin-bottom: 15px; 
    }
    .page-title-box h3 { margin: 0; font-size: 1.1rem; color: #333; font-weight: 700; display: flex; align-items: center; gap: 10px; }
    .page-title-box .icon-wrapper {
        background: rgba(0, 191, 165, 0.1); color: var(--accent-color);
        padding: 6px 10px; border-radius: 8px; font-size: 1rem;
    }

    .btn { font-weight: 500; border-radius: 20px; }
    .btn-accent { background-color: var(--accent-color); color: #fff; border: none; }
    .btn-accent:hover { background-color: var(--accent-hover); color: #fff; }
    .btn-warning-modern { background-color: #ffca28; color: #fff; border: none; }
    .btn-warning-modern:hover { background-color: #ffb300; color: #fff; }
    .btn-danger { background-color: #ff5252; border: none; }

    .btn-sm-modern {
        font-size: 10px; padding: 4px 10px; border-radius: 6px; 
        display: inline-flex; align-items: center; gap: 4px;
    }

    .rectangle {
        background: #fff; padding: 15px 20px; border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.03);
    }
    
    .table-kecil { border-collapse: collapse; border-spacing: 0; margin-bottom: 0 !important; }
    .table-kecil thead th {
        font-size: 11px; text-transform: uppercase; letter-spacing: 1px;
        background-color: #f1f3f5 !important; color: #495057; font-weight: 600;
        padding: 8px !important; border: none; border-bottom: 2px solid #dee2e6;
    }
    .table-kecil tbody td {
        font-size: 11px; padding: 8px !important; vertical-align: middle !important;
        border: none; border-bottom: 1px solid #f1f3f5; color: #555;
    }

    .dataTables_wrapper .dataTables_filter label { font-size: 11px; }
    .dataTables_wrapper .form-control-sm { border-radius: 15px; padding: 4px 10px; font-size: 11px; border: 1px solid #e9ecef; }
    .dataTables_wrapper .dataTables_info, .dataTables_wrapper .dataTables_paginate { font-size: 11px; margin-top: 10px; }
    .dataTables_wrapper .pagination .page-item.active .page-link { background-color: var(--accent-color); border-color: var(--accent-color); }
    .dataTables_wrapper .page-link { color: #6c757d; border-radius: 15px; margin: 0 2px; padding: 4px 10px; }
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
          <li class="active"><a href="../product/productlihat.php" aria-expanded="false"><i class="fa-solid fa-box mr-2"></i> product</a></li>
          <li><a href="../invoice/invoicelihat.php"><i class="fa-solid fa-file-invoice mr-2"></i> invoice</a></li>
          <li><a href="../index.php" onclick="return confirm('yakin keluar?')"><i class="fa-solid fa-sign-out-alt mr-2"></i> Logout</a></li>
        </ul>
        <div class="footer">
          <p>Mbd &copy;<script>document.write(new Date().getFullYear());</script> <br> <i class="icon-heart" aria-hidden="true"></i></p>
        </div>
      </div>
    </nav>

    <div id="content">
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
          <button type="button" id="sidebarCollapse" class="btn btn-primary">
            <i class="fa-solid fa-bars"></i>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto">
              <li class="nav-item"><a class="nav-link" href="../home.php">Home</a></li>
              <li class="nav-item"><a class="nav-link" href="../customer/customerlihat.php">customer</a></li>
              <li class="nav-item active"><a class="nav-link" href="../product/productlihat.php">product</a></li>
              <li class="nav-item"><a class="nav-link" href="../invoice/invoicelihat.php">invoice</a></li>
            </ul>
          </div>
        </div>
      </nav>

      <div class="page-title-box d-flex justify-content-between align-items-center">
          <h3><span class="icon-wrapper"><i class="fa-solid fa-box-open"></i></span> Product Inventory</h3>
          <a href="producttambah.php" class="btn btn-accent btn-sm-modern rounded-pill" style="font-size: 11px; padding: 6px 14px;">
              <i class="fa-solid fa-plus-circle"></i> New Product
          </a>
      </div>

      <div class="rectangle table-responsive">
        <table id="example" class="table table-hover table-sm table-kecil" style="width:100%; text-align: center;">
          <thead class="bg-light">
            <tr>
              <th>Product ID </th>
              <th>Description</th>
              <th>Price</th>
              <th>Unit</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
              <?php
              include '../koneksi.php';
              $query = mysqli_query($conn, "SELECT * FROM product");
              while ($data = mysqli_fetch_array($query)) {
              ?>
            <tr>
              <td><?php echo $data['product_id']; ?></td>
              <td style="text-align: start;"><?php echo $data['description']; ?></td>
              <td style="text-align: right;">Rp <?php echo number_format($data['price'], 0, ',', '.'); ?></td>
              <td><?php echo strtoupper($data['unit']); ?></td>
              <td>
                <a class="btn btn-warning-modern btn-sm-modern" href="productubah.php?product_id=<?php echo $data['product_id']; ?>">
                    <i class="fa-solid fa-pen"></i> Ubah
                </a> 
                &nbsp;
                <a class="btn btn-danger btn-sm-modern" href="producthapus.php?product_id=<?php echo $data['product_id']; ?>" onclick="return confirm('yakin hapus?')">
                    <i class="fa-solid fa-trash"></i> Hapus
                </a>
              </td>
            </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
  <script src="../js/main.js"></script>
  <script>
    $(document).ready(function() {
      $('#example').DataTable({
          "pageLength": 5,           
          "lengthChange": false,
          "language": {
              "search": "",
              "searchPlaceholder": "Search Product...",
              "info": "Showing _START_ to _END_ of _TOTAL_ products",
              "paginate": {
                  "previous": "<i class='fa-solid fa-angle-left'></i>",
                  "next": "<i class='fa-solid fa-angle-right'></i>"
              }
          }      
      });
    });
  </script>
</body>

</html>