<?php

require "database.php";
require "function.php";

session_start();

if (!isset($_SESSION["login"])) {
    header("Location: ../index.php");
    exit;
}

$jumlahDataPerHalaman = 100;
$jumlahData = count(query("SELECT * FROM berita"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;

$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$histori = query("SELECT * FROM histori ORDER BY created_at DESC LIMIT $awalData, $jumlahDataPerHalaman");

if (isset($_POST["cari"])) {
    $keyword = htmlspecialchars($_POST["keyword"]);
    $histori = query("SELECT * FROM histori WHERE aksi LIKE '%$keyword%' OR created_at LIKE '%$keyword%' OR (SELECT nama FROM admin WHERE nama LIKE '%$keyword%') ORDER BY created_at DESC");
    $jumlahData = count($histori);
    $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
    $halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;

    $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/riwayat.css">
    <title>Riwayat</title>
</head>

<body>
    <!-- Sidebar -->
    <div id="sidebar">
        <ul>
            <li><a href="../index.php">Home</a></li>
            <li><a href="../rute.php">Rute</a></li>
            <li><a href="../layanan.php">Layanan</a></li>
            <li><a href="../tentang.php">Tentang</a></li>
            <li><a href="dashboard.php" class="dashboard">Dashboard</a></li>
            <li><a href="logout.php" class="logout">logout <img src="../img/logout.png" alt=""></a></li>
        </ul>
    </div>
    <!-- Header -->
    <header>
        <div class="logo">
            <img src="../img/logo-white.png" alt="">
            <img src="../img/trans.png" alt="">
        </div>
        <nav>
            <ul>
                <li><a href="../index.php">Home</a></li>
                <li><a href="../rute.php">Rute</a></li>
                <li><a href="../layanan.php">Layanan</a></li>
                <li><a href="../tentang.php">Tentang</a></li>
                <li><a href="dashboard.php" class="dashboard">Dashboard</a></li>
                <li><a href="logout.php" class="logout">logout <img src="../img/logout.png" alt=""></a></li>
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
        <div class="content">
            <a href="dashboard.php" class="btn btn-dark">Kembali</a>
            <div class="judul">
                <p class="h3">Riwayat</p>
            </div>
            <div class="riwayat">
                <form action="" method="POST">
                    <div class="search input-group mb-3 float-end">
                        <input type="text" class="form-control" placeholder="Cari" name="keyword" id="keyword" aria-label="Search" aria-describedby="button-addon2">
                        <button class="btn btn-outline-secondary" type="submit" name="cari" id="button-addon2">&#x1F50E;</button>
                    </div>
                </form>
                <table class="table">
                    <tbody>
                        <?php foreach ($histori as $h) :
                            $id = $h["id_admin"];
                            $result = query("SELECT * FROM admin WHERE id='$id' ")[0];
                            $nama = $result["nama"];
                            $date = date_create($h["created_at"]);
                        ?>
                            <tr class="row">
                                <td class="col-3"><?= date_format($date, "d F Y - H:i") ?></td>
                                <td class="col-8"><?= $nama . " " . $h["aksi"]; ?></td>
                                <td class="col-1"></td>
                            </tr>
                        <?php endforeach; ?>
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
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="../scripts/header.js"></script>
</body>

</html>