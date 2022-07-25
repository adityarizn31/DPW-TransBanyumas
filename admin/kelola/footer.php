<?php

session_start();
require_once("../database.php");
require_once("../function.php");

if (!isset($_SESSION["login"])) {
    header("Location: ../../index.php");
    exit;
}

$status = "";

$lokasi = query("SELECT * FROM lokasi");

$medsos = query("SELECT * FROM medsos");

if (isset($_POST["tambah"])) {
    require_once("tambahMedsos.php");
    $status = tambahMedsos();
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
    <link rel="stylesheet" href="../../css/footerv2.css">
    <title>Footer</title>
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
                        <li><a href="footer.php">Footer</a></li>
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
                <p class="h3">Media Sosial</p>
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
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 5%;">No</th>
                                <th scope="col" style="width: 15%;">Platform</th>
                                <th scope="col" style="width: 35%;">Nama</th>
                                <th scope="col" style="width: 35%;">Link</th>
                                <th scope="col" style="width: 10%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($medsos as $ms) :
                                $i = 1;
                            ?>
                                <tr>
                                    <td scope="row" class="text-center align-middle"><?= $i; ?></td>
                                    <td class="text-center align-middle"><img src="../../img/medsos/<?= $ms["platform"]; ?>.png" alt=""></td>
                                    <td class="text-center align-middle"><?= $ms["nama"]; ?></td>
                                    <td class="text-center align-middle"><a href="<?= $ms["link"]; ?>"><?= $ms["link"]; ?></a></td>
                                    <td class="text-center align-middle">
                                        <a href="ubahMedsos.php?id=<?= $ms["id"]; ?>" class="btn btn-warning m-1">Edit</a>
                                        <a href="hapusMedsos.php?id=<?= $ms["id"]; ?>" class="btn btn-danger m-1" onclick="
                                            return confirm('Apakah anda yakin ingin menghapus?');">Hapus</a>
                                    </td>
                                </tr>
                            <?php
                                $i++;
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="content">
                <p class="h3">Lokasi</p>
                <div class="body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>

                                <th scope="col" style="width: 50%;">Map</th>
                                <th scope="col" style="width: 40%;">Alamat</th>
                                <th scope="col" style="width: 10%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($lokasi as $loc) : ?>
                                <tr>
                                    <td scope="row" class="text-center align-middle"><?= $loc["embed"]; ?></td>
                                    <td scope="row"><a href="<?= $loc["link"]; ?>" target="_blank"><?= $loc["alamat"]; ?></a></td>
                                    <td class="text-center align-middle">
                                        <a href="ubahLokasi.php?id=<?= $loc["id"]; ?>" class="btn btn-warning m-1">Update</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal" tabindex="-1" id="modalTambah">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Media Sosial</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <form method="post" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="link" class="form-label">Link</label>
                                        <input type="text" class="form-control" id="link" name="link" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="platform" class="form-label">Platform Media Sosial</label>
                                        <div class="input-group">
                                            <label class="input-group-text" for="platform">Pilih</label>
                                            <select class="form-select" id="platform" name="platform">
                                                <option value="facebook">Facebook</option>
                                                <option value="instagram">Instagram</option>
                                                <option value="tiktok">TikTok</option>
                                                <option value="twitter">Twitter</option>
                                                <option value="linkedin">LinkedIn</option>
                                                <option value="youtube">Youtube</option>
                                            </select>
                                        </div>
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

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="../../scripts/header.js"></script>
</body>

</html>