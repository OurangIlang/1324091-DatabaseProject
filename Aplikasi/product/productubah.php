<?php
    include '../koneksi.php';
    $query = mysqli_query($conn, "SELECT * FROM product WHERE product_id = '$_GET[product_id]'");
    $data = mysqli_fetch_array($query);
?>
<?php
if (isset($_POST['proses'])){
    include '../koneksi.php';
    $product_id = $_GET['product_id'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $unit = $_POST['unit'];

    mysqli_query($conn, "UPDATE product SET description='$description', price='$price', unit='$unit' WHERE product_id='$product_id'");
    header("location:productlihat.php");
}
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Product-ubah</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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

        .form-card {
            background: #fff; padding: 30px; border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.03);
        }
        .modern-input-group { display: flex; align-items: center; margin-bottom: 20px; }
        .modern-input-group label { width: 140px; font-weight: 600; color: #495057; margin-bottom: 0; font-size: 13px; }
        .modern-input-group .form-control {
            flex: 1; border-radius: 8px; border: 1px solid #e9ecef;
            padding: 10px 15px; font-size: 13px; transition: 0.3s;
        }
        .modern-input-group .form-control:focus {
            border-color: var(--accent-color); box-shadow: 0 0 0 0.2rem rgba(0, 191, 165, 0.15);
        }
        .modern-input-group .form-control[readonly] { background-color: #f8f9fa; color: #6c757d; }

        .btn { font-weight: 500; border-radius: 20px; font-size: 13px; padding: 8px 20px; }
        .btn-accent { background-color: var(--accent-color); color: #fff; border: none; }
        .btn-accent:hover { background-color: var(--accent-hover); color: #fff; }
        .btn-danger { background-color: #ff5252; border: none; }
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
            <h3><span class="icon-wrapper"><i class="fa-solid fa-pen"></i></span> Ubah Produk</h3>
        </div>

        <div class="form-card">
            <form action="" method="post">
                <div class="modern-input-group">
                    <label>ID Produk</label>            
                    <input type="text" name="product_id" value="<?php echo $data['product_id'] ?>" class="form-control" readonly>
                </div>

                <div class="modern-input-group">
                    <label>Description</label>            
                    <input type="text" name="description" value="<?php echo $data['description'] ?>" class="form-control" required>
                </div>

                <div class="modern-input-group">
                    <label>Price (Rp)</label>
                    <input type="number" name="price" value="<?php echo $data['price'] ?>" class="form-control" required>
                </div>

                <div class="modern-input-group">
                    <label>Unit</label>
                    <input type="text" name="unit" value="<?php echo $data['unit'] ?>" class="form-control" required>
                </div>
                
                <hr class="mt-4 mb-4">
                <div class="mt-4" style="text-align: right;">
                    <button type="submit" name="proses" class="btn btn-accent rounded-pill px-4 mr-2"><i class="fa-solid fa-save mr-1"></i> Simpan Perubahan</button>
                    <a href="productlihat.php" class="btn btn-danger rounded-pill px-4"><i class="fa-solid fa-times mr-1"></i> Batal</a>
                </div>
            </form>
        </div>

      </div>
    </div>

    <script src="../js/jquery.min.js"></script>
    <script src="../js/popper.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/main.js"></script>
  </body>
</html>