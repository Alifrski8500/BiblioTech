<?php
    error_reporting(0);
    session_start();
    
    $koneksi = new mysqli("mysql","root","uBkXDmjTmFu9VIDdUuz9kJgLAvEoKz7gIT2bvHos8evEQf4rlxVepVF9g4tYYNmn","bibliotech");

    include "function.php";

    if($_SESSION['admin'] || $_SESSION['user']){

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BIBLIOTECH</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/custom.css" rel="stylesheet" />
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <style>
        body.dark-mode {
            background-color: #121212 !important;
            color: #e0e0e0 !important;
        }
        .navbar-header,
        .navbar-top-tools,
        .marquee-box,
        .welcome-section {
            transition: background 0.3s ease, color 0.3s ease;
        }
        .dark-mode .navbar-header,
        .dark-mode .navbar-top-tools,
        .dark-mode .marquee-box,
        .dark-mode .welcome-section {
            background-color: #1f1f1f !important;
            color: #ffffff !important;
        }
        .dark-mode .marquee-text,
        .dark-mode a,
        .dark-mode h1, 
        .dark-mode h2, 
        .dark-mode h3 {
            color:rgb(255, 253, 253) !important;
        }
        .dark-mode .btn {
            background-color: #333;
            border-color: #555;
            color: white;
        }
        /* Navbar baru */
        .main-navbar {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            background-color: #1f1f1f;
            padding: 10px;
            gap: 20px;
        }
        .main-navbar a {
            color: white;
            font-weight: bold;
            text-decoration: none;
            padding: 8px 12px;
        }
        .main-navbar a:hover {
            background-color: #00f7ff;
            color: black;
            border-radius: 5px;
        }
        .dropdown {
            position: relative;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #333;
            min-width: 160px;
            z-index: 1;
            top: 100%;
            left: 0;
            flex-direction: column;
        }
        .dropdown-content a {
            padding: 10px;
            text-align: left;
        }
        .dropdown:hover .dropdown-content {
            display: flex;
        }
        @media (max-width: 768px) {
            .main-navbar {
                flex-direction: column;
                align-items: center;
            }
            .dropdown-content {
                position: static;
                display: none;
            }
            .dropdown.active .dropdown-content {
                display: flex;
            }
        }
    </style>
</head>
<body>
    <div class="welcome-section" style="display: flex; align-items: center; justify-content: flex-start; gap: 15px; background:rgb(14, 13, 13); padding: 20px;">
    <img src="assets/img/logo.png" alt="logo" style="height: 80px; border-radius: 8px;">
    <div style="text-align: left;">
        <h1 style="font-family: 'Open Sans', sans-serif; font-weight: 700; font-size: 28px; color: #00f7ff; margin: 0;">BIBLIOTECH</h1>
        <h2 style="font-family: 'Open Sans', sans-serif; font-weight: 500; font-size: 20px; color:rgb(249, 248, 248); margin: 0;">SMK NEGERI 8 BULUKUMBA</h2>
    </div>
</div>


    <marquee behavior="scroll" direction="left" scrollamount="4" style="background: #f5f5f5; padding: 4px; font-weight: bold; color: #333;">
    📚 Selamat datang di Sistem Informasi Perpustakaan SMKN 8 BULUKUMBA! | Tetap jaga buku dan kembalikan tepat waktu 📚
</marquee>


    <div class="main-navbar">
        
        <a href="index.php">Dashboard</a>
        <div class="dropdown">
            <a href="javascript:void(0)">Data Master ▼</a>
            <div class="dropdown-content">
                <a href="?page=lokasi">Data Lokasi Buku</a>
                <a href="?page=buku">Data Buku</a>
                <a href="?page=anggota">Data Anggota</a>
            </div>
        </div>
        <a href="?page=transaksi">Data Transaksi</a>
        <?php if ($_SESSION['admin']) { ?>
            <a href="?page=pengguna">Data Pengguna</a>
            <div class="dropdown">
                <a href="javascript:void(0)">Laporan ▼</a>
                <div class="dropdown-content">
                    <a href="?page=buku&aksi=cetak">Laporan Buku</a>
                    <a href="?page=anggota&aksi=cetak">Laporan Anggota</a>
                    <a href="?page=transaksi&aksi=cetak">Laporan Transaksi</a>
            
                </div>
            </div>
        <?php } ?>
        <a href="logout.php" class="btn btn-danger" style="padding: 5px 10px; font-weight: bold;">Logout</a>
    </div>
    <div class="info-box" style="margin: 5px px; background-color:rgb(94, 211, 243); padding: 5px; border-radius: 5px; max-width: 250px; box-shadow: 0 0 5px rgba(0,0,0,0.1);">
    <div id="tanggal" style="font-weight: bold; margin-bottom: 6px; color: #1e293b;"></div>
    <div style="font-size: 14px; color: #334155;">🌤️ Cuaca: Cerah Berawan, 30°C</div>
</div>
    <div id="page-wrapper">
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <?php
                        $page = $_GET['page'];
                        $aksi = $_GET['aksi'];

                        if ($page == "buku") {
                            if ($aksi == "") {
                                include "page/buku/buku.php";
                            } elseif ($aksi== "tambah") {
                                include "page/buku/tambah.php";
                            } elseif ($aksi== "ubah") {
                                include "page/buku/ubah.php";
                            } elseif ($aksi== "hapus") {
                                include "page/buku/hapus.php";
                            } elseif ($aksi== "cetak") {
                                include "page/buku/form_laporan_buku.php";
                            }
                        } elseif ($page == "lokasi" ) {
                            if ($aksi == "") {
                                include "page/lokasi/lokasi.php";
                            } elseif ($aksi == "tambah") {
                                include "page/lokasi/tambah.php";
                            } elseif ($aksi == "ubah") {
                                include "page/lokasi/ubah.php";
                            } elseif ($aksi == "hapus") {
                                include "page/lokasi/hapus.php";
                            }
                        } elseif ($page == "anggota" ) {
                            if ($aksi == "") {
                                include "page/anggota/anggota.php";
                            } elseif ($aksi == "tambah") {
                                include "page/anggota/tambah.php";
                            } elseif ($aksi == "ubah") {
                                include "page/anggota/ubah.php";
                            } elseif ($aksi == "hapus") {
                                include "page/anggota/hapus.php";
                            } elseif ($aksi== "cetak") {
                                include "page/anggota/form_laporan_anggota.php";
                            }
                        } elseif ($page == "transaksi" ) {
                            if ($aksi == "") {
                                include "page/transaksi/transaksi.php";
                            } elseif ($aksi == "tambah") {
                                include "page/transaksi/tambah.php";
                            } elseif ($aksi == "kembali") {
                                include "page/transaksi/kembali.php";
                            } elseif ($aksi == "perpanjang") {
                                include "page/transaksi/perpanjang.php";
                            } elseif ($aksi== "cetak") {
                                include "page/transaksi/form_laporan_transaksi.php";
                            }
                        } elseif ($page == "pengguna" ) {
                            if ($aksi == "") {
                                include "page/pengguna/pengguna.php";
                            } elseif ($aksi == "tambah") {
                                include "page/pengguna/tambah.php";
                            } elseif ($aksi == "ubah") {
                                include "page/pengguna/ubah.php";
                            } elseif ($aksi == "hapus") {
                                include "page/pengguna/hapus.php";
                            }
                        } elseif ($page=="") {
                            include "home.php";
                        }
                    ?>
                </div>
            </div>
            <hr />
        </div>
    </div>

    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.metisMenu.js"></script>
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
    <script>
        $(document).ready(function () {
            $('#dataTables-example').dataTable();

            // Responsive dropdown klik di HP
            $('.dropdown > a').click(function(e){
                if (window.innerWidth <= 768) {
                    e.preventDefault();
                    $(this).parent().toggleClass('active');
                }
            });
        });
    </script>
    <script src="assets/js/custom.js"></script>
    <script>
    // Menampilkan tanggal lokal dalam bahasa Indonesia
    const today = new Date();
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    document.getElementById("tanggal").innerText = today.toLocaleDateString('id-ID', options);
</script>

</body>
</html>

<?php
    } else {
        header("location:login.php");
    }
?>
