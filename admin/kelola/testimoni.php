<?php

session_start();
require "tambahTestimoni.php";
require_once("../function.php");

if (!isset($_SESSION["login"])) {
    header("Location: ../../index.php");
    exit;
}

$jumlahDataPerHalaman = 10;
$jumlahData = count(query("SELECT * FROM testi"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;

$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$testimoni = query("SELECT * FROM testi LIMIT $awalData, $jumlahDataPerHalaman");
$status = "";
if (isset($_POST["tambah"])) {
    $status = tambahTestimoni();
}

if (isset($_POST["cari"])) {
    $keyword = htmlspecialchars($_POST["keyword"]);
    $testimoni = query("SELECT * FROM testi WHERE nama LIKE '%$keyword%' OR kalimat LIKE '%$keyword%'");
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="shortcut icon" href="../../img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../../css/testimoni.css">
    <title>Testimoni</title>
</head>

<body>
    <!-- Sidebar -->
    <div id="sidebar">
        <ul>
            <li><a href="../../index.php">Home</a></li>
            <li><a href="../../rute.php">Rute</a></li>
            <li><a href="../../layanan.php">Layanan</a></li>
            <li><a href="../../tentang.php">Tentang</a></li>
            <li><a href="../dashboard.php" class="dashboard">Dashboard</a></li>
            <li><a href="../logout.php" class="logout">logout <img src="../../img/logout.png" alt=""></a></li>
        </ul>
    </div>
    <!-- Header -->
    <header>
        <div class="logo">
            <img src="../../img/logo-white.png" alt="">
            <img src="../../img/trans.png" alt="">
        </div>
        <nav>
            <ul>
                <li><a href="../../index.php">Home</a></li>
                <li><a href="../../rute.php">Rute</a></li>
                <li><a href="../../layanan.php">Layanan</a></li>
                <li><a href="../../tentang.php">Tentang</a></li>
                <li><a href="../dashboard.php" class="dashboard">Dashboard</a></li>
                <li><a href="../logout.php" class="logout">logout <img src="../../img/logout.png" alt=""></a></li>
            </ul>
        </nav>
        <label for="checkbox" class="hamburger">
            <input type="checkbox" id="checkbox">
            <span class="line line-main"></span>
            <span class="line line-split"></span>
        </label>
        <div class="clear"></div>
    </header>

    <main>
        <div class="row">
            <input type="checkbox" name="kelola" id="kelola">
            <div class="nav-kelola">
                <div class="nama">
                    <p class="h4 text-white"><?= $_SESSION["nama"]; ?></p>
                </div>
                <div class="row">
                    <div class="col-9">
                        <ul>
                            <li><a href="../dashboard.php">Home</a></li>
                            <li><a href="petaIntegrasi.php">Peta Integrasi</a></li>
                            <li><a href="fotoUtama.php">Foto Utama</a></li>
                            <li><a href="berita.php">Berita</a></li>
                            <li><a href="testimoni.php">Testimoni</a></li>
                            <li><a href="koridor.php">Koridor</a></li>
                            <li><a href="halte.php">Halte</a></li>
                        </ul>
                    </div>
                    <div class="col-3 d-flex align-items-center">
                        <label for="kelola" class="arrow d-flex justify-content-center align-items-center">
                            <img src="../../img/arrow-right.png" alt="">
                        </label>
                    </div>
                </div>
            </div>
            <div class="left-side col-2"></div>
            <div class="right-side col-10">
                <div class="content">
                    <!-- Tabel Testimoni -->
                    <p class="h3">Testimoni</p>
                    <div class="body">
                        <?php if ($status == 'berhasil') : ?>
                            <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
                                <div>
                                    Data Berhasil Ditambah! Silakan refresh halaman
                                </div>
                                <button type="button" name="close" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php elseif ($status == 'gagal') : ?>
                            <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                                <div>
                                    Data Gagal Ditambah!
                                </div>
                                <button type="button" name="close" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>
                        <div class="d-flex justify-content-end"><button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah</button></div>
                        <form method="POST">
                            <div class="search input-group mb-3 mt-3 float-end w-50">
                                <input type="text" class="form-control" placeholder="Search" name="keyword" aria-label="Search" aria-describedby="button-addon2">
                                <button class="btn btn-outline-secondary" type="submit" name="cari" id="button-addon2">&#x1F50E;</button>
                            </div>
                        </form>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 10%;">No</th>
                                    <th scope="col" style="width: 30%;">Foto</th>
                                    <th scope="col" style="width: 20%;">Nama</th>
                                    <th scope="col" style="width: 20%;">Kalimat</th>
                                    <th scope="col" style="width: 20%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($testimoni as $baris) :
                                ?>
                                    <tr>
                                        <td scope="row" class="text-center align-middle">
                                            <?= $i; ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <img class="w-75 rounded" src="../../media/testi/<?= $baris["img"] ?>" alt="tidak ditemukan">
                                        </td>
                                        <td class="text-center align-middle"><?= $baris["nama"] ?></td>
                                        <td class="text-center align-middle"><?= $baris["kalimat"] ?></td>
                                        <td class="text-center align-middle">
                                            <a href="ubahTestimoni.php?id=<?= $baris["id"]; ?>" class="btn btn-warning m-1">Edit</a>
                                            <a href="hapusTestimoni.php?id=<?= $baris["id"]; ?>" class="btn btn-danger m-1" onclick="
                                            return confirm('Apakah anda yakin ingin menghapus?');">Hapus</a>
                                        </td>
                                    </tr>
                                <?php
                                    $i++;
                                endforeach;
                                ?>
                            </tbody>
                        </table>
                        <div class="paging d-flex justify-content-center">
                            <ul class="pagination pagination-sm">
                                <?php if ($halamanAktif > 1) : ?>
                                    <li class="page-item"><a class="page-link" href="?halaman=<?= $halamanAktif - 1; ?>">&laquo;</a></li>
                                <?php endif; ?>
                                <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                                    <?php if ($i == $halamanAktif) : ?>
                                        <li class="page-item"><a class="page-link fw-bold" href="?halaman=<?= $i; ?>"><?= $i; ?></a></li>
                                    <?php else : ?>
                                        <li class="page-item"><a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a></li>
                                    <?php endif; ?>
                                <?php endfor; ?>
                                <?php if ($halamanAktif < $jumlahHalaman) : ?>
                                    <li class="page-item"><a class="page-link" href="?halaman=<?= $halamanAktif + 1; ?>">&raquo;</a></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="modal" tabindex="-1" id="modalTambah">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Testimoni</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <form method="post" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="nama" name="nama" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="kalimat" class="form-label">Kalimat</label>
                                        <input type="text" class="form-control" id="kalimat" name="kalimat" maxlength="226" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="gambar" class="form-label">Foto Anda</label>
                                        <input type="file" class="form-control" name="gambar" id="gambar" required>
                                    </div>
                                    <button type=" button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary" name="tambah">Buat</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="../../scripts/header.js"></script>

</body>

</html>