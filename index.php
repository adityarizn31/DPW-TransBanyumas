<?php

require "admin/database.php";
require "admin/function.php";

session_start();

$medsos = query("SELECT * FROM medsos");
$lokasi = query("SELECT * FROM lokasi");

$jumlahDataPerHalaman = 3;
$jumlahData = count(query("SELECT * FROM berita"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);

if (isset($_POST["prev"])) {
    $_SESSION["halamanBerita"] -= 1;
} elseif (isset($_POST["next"])) {
    $_SESSION["halamanBerita"] += 1;
} elseif (isset($_POST["halKlik"])) {
    $_SESSION["halamanBerita"] = $_POST["halAktif"];
} else {
    $_SESSION["halamanBerita"] = 1;
}

$halamanAktif = $_SESSION["halamanBerita"];
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$berita = query("SELECT * FROM berita LIMIT $awalData, $jumlahDataPerHalaman");

$fotoUtama = query("SELECT * FROM fotoutama");
$jmlFoto = count($fotoUtama);

$testimoni = query("SELECT * FROM testi");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/index.css">
    <title>Halaman Utama</title>
</head>

<body>
    <!-- Sidebar -->
    <div id="sidebar">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="rute.php">Rute</a></li>
            <li><a href="layanan.php">Layanan</a></li>
            <li><a href="tentang.php">Tentang</a></li>
            <?php if (isset($_SESSION["login"])) : ?>
                <li><a href="admin/dashboard.php" class="dashboard">Dashboard</a></li>
                <li><a href="admin/logout.php" class="logout">logout <img src="img/logout.png" alt=""></a></li>
            <?php else : ?>
                <li><a href="admin/login.php" class="login">admin <img src="img/user-icon.png" alt=""></a></li>
            <?php endif; ?>
        </ul>
    </div>
    <!-- Header -->
    <header>
        <div class="logo">
            <img src="img/logo-white.png" alt="">
            <img src="img/trans.png" alt="">
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="rute.php">Rute</a></li>
                <li><a href="layanan.php">Layanan</a></li>
                <li><a href="tentang.php">Tentang</a></li>
                <?php if (isset($_SESSION["login"])) : ?>
                    <li><a href="admin/dashboard.php" class="dashboard">Dashboard</a></li>
                    <li><a href="admin/logout.php" class="logout">logout <img src="img/logout.png" alt=""></a></li>
                <?php else : ?>
                    <li><a href="admin/login.php" class="login">admin <img src="img/user-icon.png" alt=""></a></li>
                <?php endif; ?>
            </ul>
        </nav>
        <label for="checkbox" class="hamburger">
            <input type="checkbox" id="checkbox">
            <span class="line line-main"></span>
            <span class="line line-split"></span>
        </label>
        <div class="clear"></div>
    </header>

    <!-- whatsapp -->
    <div class="whatsapp">
        <a href="https://wa.me/6281353297288" target="_blank">
            <div class="row">
                <div class="col"><img src="img/wa.png" alt=""></div>
                <div class="col">081353297288</div>
            </div>
        </a>
    </div>

    <main>
        <!-- Carousel -->
        <!-- untuk foto gallery yang bisa bergerak -->
        <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php for ($i = 0; $i < $jmlFoto; $i++) : ?>
                    <?php if ($i == 0) : ?>
                        <div class="carousel-item active">
                            <img src="media/fotoUtama/<?= $fotoUtama[$i]["img"]; ?>" class="d-block w-100" alt="...">
                        </div>
                    <?php else : ?>
                        <div class="carousel-item">
                            <img src="media/fotoUtama/<?= $fotoUtama[$i]["img"]; ?>" class="d-block w-100" alt="...">
                        </div>
                    <?php endif; ?>
                <?php endfor; ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <!-- Berita -->
        <?php if (count($berita) > 0) : ?>
            <div class="berita" id="berita">
                <div class="row">
                    <div class="col-md-4">
                        <div class="judul d-flex justify-content-center align-items-center">
                            <p class="fw-bold text-white">Berita</p>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="bagian-berita p-4">
                            <div class="berita-content">
                                <?php foreach ($berita as $b) : ?>
                                    <div class="d-flex justify-content-center">
                                        <div class="konten" data-aos="fade-right">
                                            <div class="row">
                                                <div class="col-4 col-md-4">
                                                    <img src="media/berita/<?= $b["thumbnail"]; ?>" class="img-thumbnail" alt="">
                                                </div>
                                                <div class="col-8 col-md-8">
                                                    <div class="konten-text">
                                                        <p class="h5"><?= $b["judul"]; ?></p>
                                                        <p><?= $b["preview"]; ?></p>
                                                        <div class="link"></div>
                                                    </div>
                                                    <div>
                                                        <a class="float-end d-flex align-items-center" href=""><img src="img/arrow-right.png" alt="">Lanjutkan</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="d-flex justify-content-center">
                                <nav aria-label="...">
                                    <ul class="pagination">
                                        <?php if ($halamanAktif > 1) : ?>
                                            <li class="page-item">
                                                <form action="" method="POST">
                                                    <button type="submit" name="prev" class="page-link">Previous</button>
                                                </form>
                                            </li>
                                        <?php elseif ($halamanAktif == 1) : ?>
                                            <li class="page-item disabled">
                                                <a class="page-link">Previous</a>
                                            </li>
                                        <?php endif; ?>
                                        <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                                            <?php if ($i == $halamanAktif) : ?>
                                                <li class="page-item active" aria-current="page">
                                                    <form action="" method="POST">
                                                        <input type="hidden" name="halAktif" value="<?= $i; ?>">
                                                        <button type="submit" name="halKlik" class="page-link"><?= $i; ?></button>
                                                    </form>
                                                </li>
                                            <?php else : ?>
                                                <li class="page-item">
                                                    <form action="" method="POST">
                                                        <input type="hidden" name="halAktif" value="<?= $i; ?>">
                                                        <button type="submit" name="halKlik" class="page-link"><?= $i; ?></button>
                                                    </form>
                                                </li>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                        <?php if ($halamanAktif < $jumlahHalaman) : ?>
                                            <li class="page-item">
                                                <form action="" method="POST">
                                                    <button type="submit" name="next" class="page-link">Next</button>
                                                </form>
                                            </li>
                                        <?php elseif ($halamanAktif == $jumlahHalaman) : ?>
                                            <li class="page-item disabled">
                                                <a class="page-link">Next</a>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Testimoni -->
        <div class="testi">
            <div class="scroller">
                <?php foreach ($testimoni as $testi) : ?>
                    <div class="scroller-item" data-aos="fade-up">
                        <div class="row">
                            <div class="col-4">
                                <img class="foto" src="media/testi/<?= $testi["img"]; ?>" alt="">
                                <p class="fw-bold"><?= $testi["nama"]; ?></p>
                            </div>
                            <div class="col-8">
                                <div class="kalimat">
                                    <p>"<?= $testi["kalimat"]; ?>"</p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- keuntungan -->
        <div class="keuntungan">
            <div class="d-flex justify-content-center">
                <p class="judul fs-2 text-center">Mengapa Kamu Harus Menggunakan Trans Banyumas?</p>
            </div>
            <div class="row">
                <div class="col-6 col-md-3">
                    <div class="konten text-center ps-3 pe-3">
                        <div class="d-flex justify-content-center">
                            <div class="icon">
                                <img src="img/money.png" alt="">
                            </div>
                        </div>
                        <p class="fs-4 m-1 fw-bold">Hemat</p>
                        <p class="lh-sm">Dengan menggunakan Trans Banyumas,
                            Anda tidak perlu khawatir dengan saldo Anda
                            karena masih Gratis</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="konten text-center  ps-3 pe-3">
                        <div class="d-flex justify-content-center">
                            <div class="icon">
                                <img src="img/good.png" alt="">
                            </div>
                        </div>
                        <p class="fs-4 m-1 fw-bold">Mudah</p>
                        <p class="lh-sm">Anda tidak perlu repot
                            menggunakan Bus Trans Banyumas.
                            Hanya dengan mendatangi halte bus
                            dan melihat jadwal serta rute perjalanan</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="konten text-center  ps-3 pe-3">
                        <div class="d-flex justify-content-center">
                            <div class="icon">
                                <img src="img/safety.png" alt="">
                            </div>
                        </div>
                        <p class="fs-4 m-1 fw-bold">Aman</p>
                        <p class="lh-sm">Anda tidak perlu khawatir akan keamanan barang bawaan Anda karena Bus
                            dilengkapi CCTV
                            sehingga segala sesuatunya terekam. Kami juga mengutamakan keselamatan bersama dengan tidak
                            melaju dengan kecepatan lebih dari 50km/jam</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="konten text-center  ps-3 pe-3">
                        <div class="d-flex justify-content-center">
                            <div class="icon">
                                <img src="img/no-smoking.png" alt="">
                            </div>
                        </div>
                        <p class="fs-4 m-1 fw-bold">Bebas Asap Rokok</p>
                        <p class="lh-sm">Dilarang merokok saat menggunakan layanan Bus Trans banyumas kami. Demi
                            kebaikan bersama agar
                            tidak mengganggu pengguna lainnya</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- footer -->
    <footer class="bg-secondary">
        <div class="footer-part">
            <div class="slogan">
                <h1 class="fs-1 mb-2 fw-bold">Trans Banyumas</h4>
                    <p class="h3 fw-bold">#KamiAdaUntukAnda</p>
            </div>
            <div class="medsos">
                <h4 class="h5">Cari tau kita di</h4>
                <div class="medsos-part">
                    <ul class="glue-social__list glue-no-bullet">
                        <?php foreach ($medsos as $ms) : ?>
                            <li class="glue-social__item">
                                <a class="glue-social__link d-flex align-items-center" href="<?= $ms["link"]; ?>" target="_blank" aria-label="Instagram" title="Instagram">
                                    <img class="m-1" src="img/medsos/<?= $ms["platform"]; ?>-min.png" alt="">
                                    <?= $ms["nama"]; ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div class="alamat">
                <div class="row">
                    <?php foreach ($lokasi as $loc) : ?>
                        <div class="col-12 col-md-8">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <h4 class="h5 mb-3">More</h4>
                                    <ul>
                                        <li><a href="#LINK">Kebijakan Privasi</a></li>
                                        <li><a href="#LINK">Syarat dan Ketentuan</a></li>
                                        <li><a href="tentang.html">Tentang</a></li>
                                    </ul>
                                </div>
                                <div class="col-12 col-md-6">
                                    <h4 class="h5 mb-3">Lokasi Kami</h4>
                                    <ul>
                                        <li>
                                            <a href="<?= $loc["link"]; ?>">
                                                <?= $loc["alamat"]; ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <?= $loc["embed"]; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="copy text-center">
            <p class="text-white">Copyright &copy; 2022 - PT. Banyumas Raya Transportasi. All Right Reserved</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="scripts/index.js"></script>
    <script src="scripts/header.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>