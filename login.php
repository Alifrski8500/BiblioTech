<?php
error_reporting(0);
session_start();

$koneksi = new mysqli("localhost", "root", "", "db_perpustakaan");

if (isset($_SESSION['admin']) || isset($_SESSION['user'])) {
    header("location:index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Bibliotech | Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Segoe+UI&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', sans-serif;
            background-color: #1e1e2e;
            color: #f5f5f5;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .container {
            text-align: center;
            padding: 20px;
        }

        .school-logo {
            width: 90px;
            margin-bottom: 10px;
            filter: drop-shadow(0 0 5px rgba(255,255,255,0.3));
        }

        h1 {
            font-size: 28px;
            margin: 10px 0 5px;
        }

        .bibliotech-title {
            font-size: 22px;
            color: #00bfff;
            font-weight: bold;
            margin-bottom: 8px;
        }

        p.description {
            font-size: 14px;
            color: #ccc;
        }

        .panel {
            background-color: #2c2c3a;
            padding: 20px;
            border-radius: 10px;
            width: 90%;
            max-width: 400px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
            margin-top: 30px;
        }

        .panel-heading {
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 15px;
            color: #ffffff;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #666;
            background-color: #444;
            color: white;
        }

        .form-control:focus {
            outline: none;
            background-color: #555;
            border-color: #00bfff;
            box-shadow: 0 0 5px #00bfff;
        }

        .btn {
            background-color: #00bfff;
            border: none;
            color: white;
            padding: 10px 15px;
            width: 100%;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #0099cc;
        }

        .alert-danger {
            background-color: #ff4d4d;
            color: white;
            padding: 10px;
            border-radius: 5px;
            margin-top: 10px;
        }

        .footer {
            margin-top: 40px;
            font-size: 12px;
            color: #888;
        }

        @media (max-width: 500px) {
            h1 {
                font-size: 22px;
            }

            .bibliotech-title {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="assets/img/logo.png" alt="Logo SMK" class="school-logo" />
        <h1>SMK NEGERI 8 BULUKUMBA</h1>
        <div class="bibliotech-title">BIBLIOTECH</div>
        <p class="description">Sistem Informasi Perpustakaan Digital</p>

        <div class="panel">
            <div class="panel-heading">Masukkan Username dan Password</div>
            <form method="POST">
                <input type="text" name="nama" class="form-control" placeholder="Username" required>
                <input type="password" name="pass" class="form-control" placeholder="Password" required>
                <button type="submit" class="btn" name="login">Login</button>
            </form>

            <?php
            if (isset($_POST['login'])) {
                $nama = htmlspecialchars($_POST['nama']);
                $pass = htmlspecialchars($_POST['pass']);

                $ambil = $koneksi->query("SELECT * FROM tb_user WHERE username='$nama' AND password='$pass'");
                $data = $ambil->fetch_assoc();
                $ketemu = $ambil->num_rows;

                if ($ketemu >= 1) {
                    $_SESSION['username'] = $data['username'];
                    $_SESSION['pass'] = $data['password'];
                    $_SESSION['level'] = $data['level'];

                    if ($data['level'] == "admin") {
                        $_SESSION['admin'] = $data['id'];
                    } else if ($data['level'] == "user") {
                        $_SESSION['user'] = $data['id'];
                    }

                    header("location:index.php");
                    exit();
                } else {
                    echo "<div class='alert-danger'>Username atau Password salah.</div>";
                }
            }
            ?>
        </div>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bibliotech</title>
    <style>
        .footer {
            text-align: center;
            padding: 10px;
            background-color: #f1f1f1;
            font-size: 10px;
            color: #555;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <!-- Your page content here -->

    <div class="footer">© 2025 Bibliotech - Alif Reski - RPL</div>
</body>
</html>
