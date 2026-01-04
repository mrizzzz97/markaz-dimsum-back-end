<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Internal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Mengambil Font Modern dari Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        /* Reset Dasar */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif; /* Font Modern */
            background: linear-gradient(135deg, #1dbf73 0%, #17a2b8 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        /* Container Login */
        .box {
            width: 100%;
            max-width: 380px; /* Sedikit lebih lebar agar proporsional */
            background: rgba(255, 255, 255, 0.98);
            padding: 40px 30px;
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2); /* Bayangan lebih dalam */
            position: relative;
            overflow: hidden;
        }

        /* Dekorasi Lingkaran di Background (Opsional untuk estetika) */
        .box::before {
            content: '';
            position: absolute;
            top: -50px;
            left: -50px;
            width: 100px;
            height: 100px;
            background: rgba(29, 191, 115, 0.1);
            border-radius: 50%;
        }

        .box h3 {
            text-align: center;
            margin-bottom: 30px;
            color: #2c3e50;
            font-weight: 600;
            font-size: 24px;
            letter-spacing: -0.5px;
        }

        /* Styling Input Group */
        .input-group {
            position: relative;
            margin-bottom: 20px;
        }

        input {
            width: 100%;
            padding: 14px 15px 14px 45px; /* Padding kiri lebih besar untuk ikon */
            border: 2px solid #eef2f7;
            border-radius: 10px;
            background: #f9fafb;
            outline: none;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            color: #333;
            transition: all 0.3s ease;
        }

        /* Ikon SVG menggunakan CSS Background Image */
        .icon-email {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            width: 18px;
            height: 18px;
            pointer-events: none;
            opacity: 0.5;
            transition: 0.3s;
        }
        
        .icon-lock {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            width: 18px;
            height: 18px;
            pointer-events: none;
            opacity: 0.5;
            transition: 0.3s;
        }

        /* Placeholder Text Color */
        input::placeholder {
            color: #aab2bd;
        }

        /* Efek Focus */
        input:focus {
            border-color: #1dbf73;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(29, 191, 115, 0.1);
        }

        input:focus + .icon-email,
        input:focus + .icon-lock {
            opacity: 1;
            color: #1dbf73;
        }

        /* Styling Tombol */
        button {
            width: 100%;
            margin-top: 10px;
            padding: 14px;
            border: none;
            border-radius: 10px;
            background: #1dbf73;
            color: #fff;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(29, 191, 115, 0.3);
        }

        button:hover {
            background: #17a864;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(29, 191, 115, 0.4);
        }

        button:active {
            transform: translateY(0);
        }

        /* Styling Pesan Error */
        .error {
            background: #fff5f5;
            color: #e53e3e;
            border: 1px solid #fed7d7;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 25px;
            font-size: 13px;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            animation: shake 0.5s ease-in-out;
        }

        /* Animasi getar untuk error */
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }

        /* Hint Text */
        .hint {
            text-align: center;
            font-size: 12px;
            color: #7f8c8d;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid #eee;
        }
    </style>
</head>
<body>

<div class="box">
    <h3>Login Akun</h3>

    @if (session('error'))
        <!-- Menambahkan ikon peringatan sederhana -->
        <div class="error">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="12" y1="8" x2="12" y2="12"></line>
                <line x1="12" y1="16" x2="12.01" y2="16"></line>
            </svg>
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login.post') }}">
        @csrf

        <!-- Input Email -->
        <div class="input-group">
            <!-- Ikon Email (SVG inline) -->
            <svg class="icon-email" viewBox="0 0 24 24" fill="none" stroke="#1dbf73" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                <polyline points="22,6 12,13 2,6"></polyline>
            </svg>
            <input type="email" name="email" placeholder="Alamat Email" required autocomplete="email">
        </div>

        <!-- Input Password -->
        <div class="input-group">
            <!-- Ikon Gembok (SVG inline) -->
            <svg class="icon-lock" viewBox="0 0 24 24" fill="none" stroke="#1dbf73" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
            </svg>
            <input type="password" name="password" placeholder="Kata Sandi" required autocomplete="current-password">
        </div>

        <button type="submit">Masuk Dashboard</button>
    </form>

    <div class="hint">
        Halaman ini khusus untuk akses internal staf
    </div>
</div>

</body>
</html>