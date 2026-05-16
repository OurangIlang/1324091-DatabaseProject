<!doctype html>
<html lang="en">

<head>
  <title>Dashboard - CV Kanthi Harum</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">

  <style>
    /* --- THEME GLOBAL --- */
    body { background-color: #f8f9fa; font-family: 'Poppins', sans-serif; }
    :root {
        --accent-color: #00bfa5; 
        --accent-hover: #00a08a;
        --sidebar-bg: #1a1d21; 
        --light-text: rgba(255, 255, 255, 0.7);
    }

    /* --- SIDEBAR MODERN --- */
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

    #content { padding: 20px 30px !important; }
    .navbar {
        background: #fff; border: none; box-shadow: 0 2px 10px rgba(0,0,0,0.03);
        border-radius: 10px; margin-bottom: 25px;
    }

    /* --- DASHBOARD HEADER --- */
    .dash-header {
        display: flex; justify-content: space-between; align-items: flex-end;
        margin-bottom: 25px; padding: 10px 5px;
    }
    .dash-header h2 { margin: 0; font-size: 1.8rem; font-weight: 700; color: #2c3e50; }
    .dash-greeting { font-size: 0.9rem; color: #6c757d; margin-top: 5px; }
    .date-badge {
        background: #fff; padding: 8px 15px; border-radius: 30px;
        font-size: 0.85rem; font-weight: 500; color: var(--accent-color);
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        display: flex; align-items: center; gap: 8px;
    }

    /* --- MODERN STAT CARDS --- */
    .stat-card {
        border-radius: 20px;
        padding: 25px 20px;
        position: relative;
        overflow: hidden;
        border: none;
        display: flex;
        flex-direction: column;
        height: 100%;
        background: #fff;
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        z-index: 1;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    /* Color Variants (Soft Gradients + Colored Shadows) */
    .stat-card.c-blue { 
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); 
        box-shadow: 0 10px 25px rgba(79, 172, 254, 0.3); color: #fff; 
    }
    .stat-card.c-teal { 
        background: linear-gradient(135deg, #00bfa5 0%, #009688 100%); 
        box-shadow: 0 10px 25px rgba(0, 191, 165, 0.3); color: #fff; 
    }
    .stat-card.c-purple { 
        background: linear-gradient(135deg, #a18cd1 0%, #fbc2eb 100%); 
        box-shadow: 0 10px 25px rgba(161, 140, 209, 0.3); color: #fff; 
    }

    /* Card Content Formatting */
    .stat-card .sc-icon-wrapper {
        width: 50px; height: 50px;
        background: rgba(255,255,255,0.25);
        border-radius: 14px;
        display: flex; justify-content: center; align-items: center;
        font-size: 20px; margin-bottom: 20px;
        backdrop-filter: blur(5px);
    }
    
    .stat-card .sc-label {
        font-size: 0.8rem; font-weight: 600; text-transform: uppercase;
        letter-spacing: 1px; opacity: 0.9; margin-bottom: 5px;
    }
    
    .stat-card .sc-num {
        font-size: 2.8rem; font-weight: 800; line-height: 1; margin-bottom: 15px;
    }
    
    .stat-card .sc-link {
        font-size: 0.85rem; font-weight: 500; color: #fff; text-decoration: none;
        display: inline-flex; align-items: center; gap: 8px;
        opacity: 0.8; transition: 0.3s; margin-top: auto;
        background: rgba(0,0,0,0.1); padding: 8px 15px; border-radius: 20px;
        width: fit-content;
    }
    .stat-card .sc-link:hover { opacity: 1; background: rgba(0,0,0,0.15); }

    /* The Background Big Icon Effect */
    .stat-card .bg-icon {
        position: absolute;
        right: -20px;
        bottom: -20px;
        font-size: 140px;
        opacity: 0.15;
        transform: rotate(-15deg);
        z-index: -1;
    }

  </style>
</head>

<body>

  <div class="wrapper d-flex align-items-stretch">
    <nav id="sidebar">
      <div class="p-4 pt-5">
        <a href="#" class="img logo rounded-circle mb-5" style="background-image: url(images/bengkel.png);"></a>
        <ul class="list-unstyled components mb-5">
          <li class="active"><a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false"><i class="fa-solid fa-home mr-2"></i> Home</a></li>
          <li><a href="customer/customerlihat.php"><i class="fa-solid fa-users mr-2"></i> customer</a></li>
          <li><a href="product/productlihat.php"><i class="fa-solid fa-box mr-2"></i> product</a></li>
          <li><a href="invoice/invoicelihat.php"><i class="fa-solid fa-file-invoice mr-2"></i> invoice</a></li>
          <li><a href="index.php"><i class="fa-solid fa-sign-out-alt mr-2"></i> Logout</a></li>
        </ul>
        <div class="footer">
          <p>Mbd &copy;<script>document.write(new Date().getFullYear())</script></p>
        </div>
      </div>
    </nav>

    <div id="content">

      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
          <button type="button" id="sidebarCollapse" class="btn btn-primary"><i class="fa-solid fa-bars"></i></button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto">
              <li class="nav-item active"><a class="nav-link" href="#">Home</a></li>
              <li class="nav-item"><a class="nav-link" href="customer/customerlihat.php">customer</a></li>
              <li class="nav-item"><a class="nav-link" href="product/productlihat.php">product</a></li>
              <li class="nav-item"><a class="nav-link" href="invoice/invoicelihat.php">invoice</a></li>
            </ul>
          </div>
        </div>
      </nav>

      <div class="dash-header">
        <div>
          <h2>Dashboard</h2>
          <div class="dash-greeting">Overview Data System CV Kanthi Harum</div>
        </div>
        <div class="date-badge">
          <i class="fa-regular fa-calendar"></i>
          <span id="todayDate"></span>
        </div>
      </div>
      
      <div class="row mb-4 d-flex align-items-stretch">
        
        <div class="col-md-4 mb-4">
          <div class="stat-card c-blue">
            <i class="fa-solid fa-users bg-icon"></i>
            <div class="sc-icon-wrapper"><i class="fa-solid fa-users"></i></div>
            <div class="sc-label">Total Customer</div>
            <div class="sc-num">
              <?php
                include 'koneksi.php';
                $r = mysqli_query($conn, "SELECT COUNT(*) AS n FROM customer");
                echo mysqli_fetch_assoc($r)['n'];
              ?>
            </div>
            <a href="customer/customerlihat.php" class="sc-link">Kelola Customer <i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </div>
        
        <div class="col-md-4 mb-4">
          <div class="stat-card c-teal">
            <i class="fa-solid fa-box-open bg-icon"></i>
            <div class="sc-icon-wrapper"><i class="fa-solid fa-box-open"></i></div>
            <div class="sc-label">Total Produk</div>
            <div class="sc-num">
              <?php
                $r = mysqli_query($conn, "SELECT COUNT(*) AS n FROM product");
                echo mysqli_fetch_assoc($r)['n'];
              ?>
            </div>
            <a href="product/productlihat.php" class="sc-link">Kelola Produk <i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </div>
        
        <div class="col-md-4 mb-4">
          <div class="stat-card c-purple">
            <i class="fa-solid fa-file-invoice-dollar bg-icon"></i>
            <div class="sc-icon-wrapper"><i class="fa-solid fa-file-invoice-dollar"></i></div>
            <div class="sc-label">Total Invoice</div>
            <div class="sc-num">
              <?php
                $r = mysqli_query($conn, "SELECT COUNT(*) AS n FROM invoice");
                echo mysqli_fetch_assoc($r)['n'];
              ?>
            </div>
            <a href="invoice/invoicelihat.php" class="sc-link">Kelola Invoice <i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </div>

      </div>

    </div>
  </div>

  <script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
  <script>
    // Script untuk memunculkan tanggal hari ini (Format Indonesia)
    var d = new Date();
    var days = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
    var months = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
    document.getElementById('todayDate').textContent = days[d.getDay()] + ', ' + d.getDate() + ' ' + months[d.getMonth()] + ' ' + d.getFullYear();
  </script>
</body>

</html>