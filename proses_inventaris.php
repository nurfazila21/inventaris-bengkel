<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Proses Peminjaman - Inventaris Bengkel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        /* Warna tema */
        :root {
            --primary-color: #003366; /* Biru tua */
            --secondary-color: #f0f0f0; /* Abu-abu terang */
            --text-color: #ffffff; /* Teks putih */
            --table-border-color: #dee2e6; /* Border tabel abu-abu terang */
            --button-hover-color: #002244; /* Biru tua lebih gelap untuk hover tombol */
        }

        .navbar {
            background-color: var(--primary-color); /* Warna gelap untuk tema profesional */
        }

        .nav-link {
            color: var(--text-color); /* Teks putih pada navbar */
            transition: background-color 0.3s;
        }

        #satu {
            background-color: var(--primary-color); /* Sesuaikan dengan navbar */
            border-radius: 10px;
        }

        .nav-item#satu.active .nav-link {
            background-color: var(--primary-color); /* Warna latar belakang beranda */
        }

        .nav-link:hover {
            background-color: var(--secondary-color); /* Warna highlight saat hover */
        }

        .footer {
            background-color: var(--primary-color); /* Warna gelap untuk footer */
            padding: 10px;
            color: var(--text-color); /* Warna teks putih untuk kontras */
        }

        .offcanvas {
            background-color: var(--secondary-color); /* Latar belakang sidebar */
        }

        .offcanvas .nav-link {
            color: var(--primary-color); /* Warna teks sidebar */
        }

        .offcanvas .nav-link.active {
            background-color: var(--primary-color); /* Latar belakang link aktif sidebar */
            color: var(--text-color); /* Teks putih pada link aktif */
        }

        .btn-primary {
            background-color: var(--primary-color); /* Warna tombol utama */
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: var(--button-hover-color); /* Warna tombol utama saat hover */
            border-color: var(--button-hover-color);
        }

        table {
            border-color: var(--table-border-color); /* Warna border tabel */
        }

        table th, table td {
            border-color: var(--table-border-color); /* Warna border tabel */
        }
    </style>
</head>
<body>
    <!-- Header -->
    <nav class="navbar navbar-expand navbar-dark">
        <div class="container-lg">
            <a class="navbar-brand" href="#"><i class="bi bi-tools"></i> Inventaris Bengkel </a>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo $_SESSION['username']; ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end mt-2">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-person-bounding-box"></i> Profil</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-sliders2-vertical"></i> Pengaturan</a></li>
                            <li><a class="dropdown-item" href="logout.php"><i class="bi bi-box-arrow-left"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Header -->

    <div class="container-lg">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3">
                <nav class="navbar navbar-expand-lg bg-light rounded border mt-2">
                    <div class="container-fluid">   
                        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel" style="width: 250px;">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <ul class="navbar-nav nav-pills flex-column justify-content-end flex-grow-1">
                                    <li class="nav-item" id="satu">
                                        <a class="nav-link link-light" aria-current="page" href="index.php"><i class="bi bi-house-door-fill"></i> Beranda </a>
                                    </li>
                                    <li class="nav-item">
                                    <a class="nav-link link-dark" href="admin.php"><i class="bi bi-tools"></i> Admin </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link link-dark" href="kasir.php"><i class="bi bi-person-fill"></i> Kasir </a>
                                    </li> 
                                    <li class="nav-item">
                                        <a class="nav-link link-dark" href="mekanik.php"><i class="bi bi-person-lines-fill"></i> Mekanik </a>
                                    </li>         
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <!-- End Sidebar -->

            <!-- Content -->
            <div class="col-lg-9 mt-2">
                <h2>kasir</h2>
                <p>Di sini Anda dapat mengelola proses peminjaman dan pengembalian alat bengkel.</p>

                <!-- Button to trigger modal -->
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addBorrowingModal">
                    Tambah Peminjaman
                </button>

                <!-- Borrowing Table -->
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID Peminjaman</th>
                            <th>Nama Peminjam</th>
                            <th>Alat</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Tanggal Pengembalian</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>John Doe</td>
                            <td>Mesin Bor</td>
                            <td>2024-07-10</td>
                            <td>2024-07-15</td>
                            <td>Tersedia</td>
                            <td>
                                <a href="#" class="btn btn-warning btn-sm">Edit</a>
                                <a href="#" class="btn btn-danger btn-sm">Hapus</a>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Jane Smith</td>
                            <td>Gerinda</td>
                            <td>2024-07-12</td>
                            <td>2024-07-17</td>
                            <td>Dipinjam</td>
                            <td>
                                <a href="#" class="btn btn-warning btn-sm">Edit</a>
                                <a href="#" class="btn btn-danger btn-sm">Hapus</a>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Bob Brown</td>
                            <td>Gergaji</td>
                            <td>2024-07-15</td>
                            <td>2024-07-20</td>
                            <td>Tersedia</td>
                            <td>
                                <a href="#" class="btn btn-warning btn-sm
