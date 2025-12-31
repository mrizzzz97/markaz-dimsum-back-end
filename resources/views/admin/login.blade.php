<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(135deg, #1dbf73, #17a2b8);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .box {
            width: 320px;
            background: #fff;
            padding: 25px 20px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        .box h3 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 12px;
            border-radius: 6px;
            border: 1px solid #ddd;
            outline: none;
        }

        input:focus {
            border-color: #1dbf73;
        }

        button {
            width: 100%;
            margin-top: 18px;
            padding: 10px;
            border: none;
            border-radius: 6px;
            background: #1dbf73;
            color: #fff;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
        }

        button:hover {
            background: #17a864;
        }

        .error {
            background: #ffe0e0;
            color: #c0392b;
            padding: 8px;
            border-radius: 5px;
            margin-bottom: 10px;
            font-size: 14px;
            text-align: center;
        }

        .hint {
            text-align: center;
            font-size: 12px;
            color: #777;
            margin-top: 12px;
        }
    </style>
</head>
<body>

<div class="box">
    <h3>Login</h3>

    @if (session('error'))
        <div class="error">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('login.post') }}">
        @csrf

        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>

        <button type="submit">Masuk</button>
    </form>

    <div class="hint">
        Halaman ini khusus untuk akses internal
    </div>
</div>

</body>
</html>
