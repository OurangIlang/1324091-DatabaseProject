<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CV Kanthi Harum — Invoice System</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    
    /* --- TEMA ABU-ABU GRADASI & MODERN (Aksen Teal/Hijau) --- */
    :root {
      --accent: #00bfa5; /* Hijau Teal */
      --accent-dark: #00a08a;
      --accent-glow: rgba(0, 191, 165, 0.15);
      
      /* Palet Abu-abu Elegan */
      --bg-gradient-start: #e9ecef;
      --bg-gradient-end: #ced4da;
      --panel-bg: #ffffff;
      
      --text-main: #2b3035; /* Dark Gray untuk teks utama */
      --text-muted: #6c757d; /* Gray untuk teks sekunder */
      --border-color: #dee2e6;
    }
    
    /* Mengizinkan scrolling secara alami */
    html, body { min-height: 100vh; overflow-x: hidden; }
    
    body { 
        font-family: 'Poppins', sans-serif; 
        /* Background Gradasi Abu-abu Lembut */
        background: linear-gradient(135deg, var(--bg-gradient-start) 0%, var(--bg-gradient-end) 100%);
        color: var(--text-main); 
        display: flex; 
        align-items: center;
        justify-content: center;
        padding: 40px 20px; /* Padding luar agar card tidak menempel tepi layar di monitor kecil */
    }

    /* KONTENER UTAMA (Card Lebar) */
    .login-container {
        display: flex;
        width: 100%;
        max-width: 1100px; /* Lebar maksimal yang ideal */
        background: var(--panel-bg);
        border-radius: 24px;
        box-shadow: 0 20px 50px rgba(0,0,0,0.08); /* Shadow lembut yang melayang */
        overflow: hidden;
    }

    /* LEFT PANEL (Informasi & Branding) */
    .left-panel { 
        flex: 1.2; 
        display: flex; 
        flex-direction: column; 
        justify-content: center; 
        padding: 5rem 4rem; 
        position: relative; 
        background: #f8f9fa; /* Abu-abu sangat pucat di dalam card */
        border-right: 1px solid var(--border-color);
    }
    
    /* Dekorasi Latar Belakang Kiri */
    .left-panel::before { 
        content: ''; position: absolute; inset: 0; 
        background: radial-gradient(circle at 0% 0%, rgba(0,191,165,.08) 0%, transparent 50%), 
                    radial-gradient(circle at 100% 100%, rgba(0,191,165,.05) 0%, transparent 50%); 
        pointer-events: none; 
    }
    .grid-bg { 
        position: absolute; inset: 0; 
        background-image: radial-gradient(rgba(0,0,0,.04) 1px, transparent 1px);
        background-size: 30px 30px; 
        pointer-events: none; 
    }

    .brand { display: flex; align-items: center; gap: 16px; margin-bottom: 4rem; position: relative; }
    .brand-icon { 
        width: 54px; height: 54px; background: var(--accent); border-radius: 14px; 
        display: flex; align-items: center; justify-content: center; font-size: 24px; color: #fff; 
        box-shadow: 0 8px 20px rgba(0,191,165,0.25);
    }
    .brand-name { font-size: 19px; font-weight: 700; letter-spacing: -.5px; line-height: 1.2; color: var(--text-main); }
    .brand-name span { display: block; font-size: 11px; font-weight: 500; color: var(--text-muted); letter-spacing: 2px; text-transform: uppercase; margin-top: 4px; }

    .hero-label { 
        font-size: 12px; font-weight: 600; letter-spacing: 3px; text-transform: uppercase; 
        color: var(--accent); margin-bottom: 1.2rem; position: relative; display: flex; align-items: center; gap: 12px; 
    }
    .hero-label::before { content: ''; display: block; width: 40px; height: 2px; background: var(--accent); border-radius: 2px; }

    h1 { font-size: clamp(2.2rem, 3.5vw, 3.2rem); font-weight: 800; line-height: 1.2; letter-spacing: -1.5px; margin-bottom: 1.5rem; position: relative; color: var(--text-main);}
    h1 em { font-style: normal; color: var(--accent); }

    .hero-desc { font-size: 15px; line-height: 1.8; color: var(--text-muted); max-width: 450px; margin-bottom: 3rem; position: relative; }

    .feature-list { list-style: none; display: flex; flex-direction: column; gap: 16px; position: relative; margin-bottom: 2rem;}
    .feature-list li { display: flex; align-items: center; gap: 14px; font-size: 14px; color: var(--text-main); font-weight: 500;}
    .feature-list li .fi { 
        width: 32px; height: 32px; background: var(--accent-glow); border: 1px solid rgba(0,191,165,.2); 
        border-radius: 10px; display: flex; align-items: center; justify-content: center; color: var(--accent); font-size: 13px; flex-shrink: 0; 
    }

    /* RIGHT PANEL (Form Login) */
    .right-panel { 
        flex: 1; min-width: 400px; background: var(--panel-bg); 
        display: flex; flex-direction: column; justify-content: center; 
        padding: 4rem 3.5rem; position: relative; 
    }
    
    /* Garis dekorasi atas pada form login */
    .right-panel::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 5px; background: linear-gradient(90deg, var(--accent), var(--accent-dark)); }

    .login-title { font-size: 26px; font-weight: 700; margin-bottom: 8px; letter-spacing: -.5px; color: var(--text-main);}
    .login-sub { font-size: 14px; color: var(--text-muted); margin-bottom: 2.5rem; }

    .form-group { margin-bottom: 20px; }
    .form-group label { display: block; font-size: 11px; font-weight: 600; letter-spacing: 1px; text-transform: uppercase; color: #adb5bd; margin-bottom: 8px; }
    .input-wrap { position: relative; }
    .input-wrap .ii { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: #ced4da; font-size: 14px; pointer-events: none; transition: color 0.3s;}
    
    .input-wrap input { 
        width: 100%; padding: 14px 15px 14px 44px; background: #fff; 
        border: 2px solid #e9ecef; border-radius: 12px; color: var(--text-main); 
        font-family: 'Poppins', sans-serif; font-size: 15px; transition: all .3s; outline: none; 
    }
    .input-wrap input:focus { border-color: var(--accent); box-shadow: 0 0 0 4px var(--accent-glow); }
    .input-wrap input:focus + .ii, .input-wrap input:focus ~ .ii { color: var(--accent); }
    .input-wrap input::placeholder { color: #adb5bd; }
    
    .toggle-pw { position: absolute; right: 16px; top: 50%; transform: translateY(-50%); color: #adb5bd; cursor: pointer; font-size: 14px; transition: color .2s; }
    .toggle-pw:hover { color: var(--accent); }

    .form-row { display: flex; align-items: center; justify-content: space-between; margin-bottom: 25px; }
    .remember { display: flex; align-items: center; gap: 8px; font-size: 14px; color: var(--text-muted); cursor: pointer; user-select: none;}
    .remember input[type=checkbox] { accent-color: var(--accent); width: 16px; height: 16px; cursor: pointer;}
    .forgot { font-size: 13px; color: var(--accent); text-decoration: none; font-weight: 500; transition: opacity .2s; }
    .forgot:hover { opacity: .8; text-decoration: underline;}

    .btn-login { 
        width: 100%; padding: 15px; background: var(--accent); color: #fff; border: none; 
        border-radius: 12px; font-family: 'Poppins', sans-serif; font-size: 15px; font-weight: 600; 
        cursor: pointer; transition: all .3s; text-align: center; display: block; text-decoration: none; 
        box-shadow: 0 6px 20px rgba(0,191,165,0.25); margin-top: 10px;
    }
    .btn-login:hover { background: var(--accent-dark); transform: translateY(-2px); box-shadow: 0 8px 25px rgba(0,191,165,0.35); }
    .btn-login:active { transform: translateY(0); }

    .divider { display: flex; align-items: center; gap: 15px; margin: 25px 0; color: #ced4da; font-size: 13px; text-transform: uppercase; font-weight: 500;}
    .divider::before, .divider::after { content: ''; flex: 1; height: 1px; background: #e9ecef; }

    .btn-register { 
        width: 100%; padding: 14px; background: transparent; color: var(--text-main); 
        border: 2px solid #e9ecef; border-radius: 12px; font-family: 'Poppins', sans-serif; 
        font-size: 14px; font-weight: 500; cursor: pointer; transition: all .3s; text-align: center; 
        display: block; text-decoration: none; 
    }
    .btn-register:hover { border-color: var(--accent); background: var(--accent-glow); color: var(--accent-dark); }

    .right-footer { margin-top: 2.5rem; text-align: center; font-size: 12px; color: var(--text-muted); }

    /* RESPONSIVE DESIGN */
    @media (max-width: 992px) {
      .login-container { flex-direction: column; max-width: 600px; }
      .left-panel { border-right: none; border-bottom: 1px solid var(--border-color); padding: 4rem 3rem; }
      .right-panel { min-width: unset; padding: 3rem; }
    }
    
    @media (max-width: 576px) {
      body { padding: 20px 10px; }
      .left-panel { padding: 3rem 2rem; }
      .right-panel { padding: 2.5rem 2rem; }
      h1 { font-size: 2rem; }
    }
  </style>
</head>
<body>

  <div class="login-container">
      
      <div class="left-panel">
        <div class="grid-bg"></div>
        <div class="brand">
          <div class="brand-icon"><i class="fas fa-boxes-packing"></i></div>
          <div class="brand-name">CV Kanthi Harum <span>industrial and cleaning chemicals</span></div>
        </div>
        
        <div class="hero-label">Invoice System</div>
        <h1>Standar Mutu<br>Perawatan <br><em>Industri Modern</em></h1>
        <p class="hero-desc">Spesialis bahan kimia pembersih dan perawatan industri berbasis di Surabaya. Kami menyediakan produk CRIPTON yang dirancang khusus untuk standar tinggi hotel, rumah sakit, dan kebutuhan korporat.</p>
        
        <ul class="feature-list">
          <li><span class="fi"><i class="fas fa-calendar-check"></i></span> Berpengalaman Lebih dari 30 Tahun</li>
          <li><span class="fi"><i class="fas fa-flask"></i></span> Produk Spesialis Industri (CRIPTON)</li>
          <li><span class="fi"><i class="fas fa-bolt"></i></span> Manajemen Invoice Cepat & Akurat</li>
        </ul>
      </div>

      <div class="right-panel">
        <div class="login-title">Selamat Datang 👋</div>
        <div class="login-sub">Silakan masuk ke akun Anda</div>
        
        <form action="home.php">
          <div class="form-group">
            <label>Username</label>
            <div class="input-wrap">
              <input type="text" name="username" placeholder="Masukkan username" required autocomplete="username">
              <i class="fas fa-user ii"></i>
            </div>
          </div>
          
          <div class="form-group">
            <label>Password</label>
            <div class="input-wrap">
              <input id="pw" type="password" name="password" placeholder="Masukkan password" required autocomplete="current-password">
              <i class="fas fa-lock ii"></i>
              <i class="fas fa-eye toggle-pw" id="togglePw"></i>
            </div>
          </div>
          
          <div class="form-row">
            <label class="remember"><input type="checkbox" checked> Ingat saya</label>
            <a href="#" class="forgot">Lupa password?</a>
          </div>
          
          <button type="submit" class="btn-login"><i class="fas fa-sign-in-alt" style="margin-right:10px"></i>Masuk Sekarang</button>
        </form>
        
        <div class="divider">atau</div>
        <a href="login.php" class="btn-register"><i class="fas fa-headset" style="margin-right:10px"></i>Admin Only</a>
        
        <div class="right-footer">&copy; <script>document.write(new Date().getFullYear())</script> CV Kanthi Harum. All rights reserved.</div>
      </div>
      
  </div>

  <script>
    // Script Toggle Show/Hide Password
    document.getElementById('togglePw').addEventListener('click', function() {
      var pw = document.getElementById('pw');
      if(pw.type === 'password') {
          pw.type = 'text';
          this.className = 'fas fa-eye-slash toggle-pw';
          this.style.color = 'var(--accent)';
      } else {
          pw.type = 'password';
          this.className = 'fas fa-eye toggle-pw';
          this.style.color = '#adb5bd';
      }
    });
  </script>
</body>
</html>