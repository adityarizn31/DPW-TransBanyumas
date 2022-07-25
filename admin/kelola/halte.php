<?php

session_start();
require_once("../function.php");
require_once("tambahHalte.php");


if (!isset($_SESSION["login"])) {
    header("Location: ../../index.php");
    exit;
}

$status = "";

$koridor = query("SELECT * FROM koridor");

if (isset($_POST["tambah"])) {
    $status = tambahHalte();
}

if (isset($_POST["halKoridor"])) {
    $_SESSION["koridor"] = $_POST["halaman"];
}

$halKoridor = $_SESSION["koridor"];

$jumlahDataPerHalaman = 20;
$jumlahData = count(query("SELECT * FROM halte WHERE koridor= (SELECT id FROM koridor WHERE nama = '$halKoridor')"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;

$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$halte = query("SELECT * FROM halte WHERE koridor= (SELECT id FROM koridor WHERE nama = '$halKoridor') ORDER BY created_at DESC LIMIT $awalData, $jumlahDataPerHalaman");

if (isset($_POST["cari"])) {
    $keyword = htmlspecialchars($_POST["telusuri"]);
    $halte = query("SELECT * FROM halte WHERE nama LIKE '%$keyword%' ORDER BY created_at DESC");
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
    <link rel="stylesheet" href="../../css/halte.css">
    <title>Halte</title>
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
                    <!-- Tabel Halte -->
                    <p class="h3">Halte</p>
                    <div class="body">
                        <?php if ($status == 'berhasil') : ?>
                            <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
                                <div>
                                    Data Berhasil Ditambah!
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
                        <div>
                            <p class="h5 m-2">Pilih koridor</p>
                            <form action="" method="post">
                                <div class="search input-group mb-3 float-end w-50">
                                    <input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="button-addon2" name="telusuri" id="telusuri">
                                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2" name="cari">&#x1F50E;</button>
                                </div>
                            </form>
                            <div class="custom-pagination">
                                <?php $j = 1; ?>
                                <?php foreach ($koridor as $k) : ?>
                                    <form method="POST">
                                        <input type="hidden" name="halaman" value="Koridor <?= $j; ?>">
                                        <button type="submit" <?php if ($_SESSION["koridor"] == "Koridor " . $j) : ?> class="active" <?php endif; ?> name="halKoridor"><?= $j; ?></button>
                                    </form>
                                    <?php $j++; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 5%;">No</th>
                                    <th scope="col" style="width: 25%;">Nama halte</th>
                                    <th scope="col" style="width: 40%;">Link Google Maps</th>
                                    <th scope="col" style="width: 10%;">Koridor</th>
                                    <th scope="col" style="width: 20%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($halte as $row) : ?>
                                    <?php $id_koridor = $row["koridor"]; ?>
                                    <?php $namaKoridor = query("SELECT nama FROM koridor WHERE id='$id_koridor'")[0]["nama"]; ?>
                                    <tr>
                                        <td scope="row" class="text-center align-middle"><?= $i; ?></td>
                                        <td class="text-center align-middle"><?= $row["nama"]; ?></td>
                                        <td class="text-center align-middle">
                                            <a href="<?= $row["link"]; ?>" target="_blank"><?= $row["link"]; ?></a>
                                        </td class="text-center align-middle">
                                        <td class="text-center align-middle"><?= $namaKoridor; ?></td>
                                        <td class="text-center align-middle">
                                            <a href="ubahHalte.php?id=<?= $row["id"]; ?>" class="btn btn-warning m-1">Edit</a>
                                            <a href="hapusHalte.php?id=<?= $row["id"]; ?>" class="btn btn-danger m-1" onclick="
                                            return confirm('Apakah anda yakin ingin menghapus?');">Hapus</a>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
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
            </div>
        </div>

        <div class="modal" tabindex="-1" id="modalTambah">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Halte</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <form method="post">
                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama Halte</label>
                                        <input type="text" class="form-control" id="nama" name="nama" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="link" class="form-label">Link Google Maps</label>
                                        <input type="text" class="form-control" id="link" name="link" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="koridor" class="form-label">Koridor</label>
                                        <div class="input-group">
                                            <label class="input-group-text" for="koridor">Pilih</label>
                                            <select class="form-select" id="koridor" name="koridor">
                                                <?php foreach ($koridor as $k) : ?>
                                                    <option value="<?= $k["nama"]; ?>"><?= $k["nama"]; ?></option>
                                                <?php endforeach; ?>
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

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="../../scripts/header.js"></script>
</body>

</html>