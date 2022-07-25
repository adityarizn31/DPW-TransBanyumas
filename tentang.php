<?php
session_start();
require "admin/function.php";

$medsos = query("SELECT * FROM medsos");
$lokasi = query("SELECT * FROM lokasi");
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
    <link rel="stylesheet" href="css/tentang.css">
    <title>Tentang</title>
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
        <!-- tentang -->
        <div class="tentang">
            <div class="background">
                <img src="img/organisasi.png" alt="" data-aos="zoom-in">
            </div>
            <div class="deskripsi" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="1500">
                <div class="row">
                    <div class="col-12 col-md-12 d-flex justify-content-center">
                        <img src="img/logo.png" alt="">
                    </div>
                    <div class="col-12 col-md-12 d-flex justify-content-center">
                        <p class="h3">Tentang Trans Banyumas</p>
                    </div>
                    <div class="col-12 col-md-12">
                        <div class="isi">
                            <p>PT. Banyumas Raya Transportasi merupakan perusahaan yang berjalan dalam
                                bidang pelayanan
                                transportasi modern yang mana pelayanan pada bus ini menerapkan konsep BTS (Buy The
                                Service)
                                yaitu pembelian layanan angkutan umum oleh pemerintah kepada operator angkutan umum
                                swasta.
                                Dalam hal ini pemerintah membayar operator berdasarkan nilai angkut yang di hitung per
                                kilometer. BTS merupakan sebuah program dari Kementrian Perhubungan yang menghadirkan
                                angkutan perkotaan yang aman, nyaman serta ramah lingkungan. </p>
                            <p>
                                Program BTS di Indonesia sudah berada pada 16 kota dan salah satunya yaitu di
                                Purwokerto.
                                Dalam menjalankan perusahaan nya terdapat 12 perusahaan lokal yang tergabung dengan PT.
                                Banyumas Raya Transportasi yaitu :
                            </p>
                            <ol>
                                <li>1. Koperades</li>
                                <li>2. Kopata</li>
                                <li>3. PO Asli (Purwokerto - Cilacap)</li>
                                <li>4. PT ASli Putra Pribumi</li>
                                <li>5. Teguh Muda Abadi</li>
                                <li>6. PT Amala Jaya</li>
                                <li>7. PT Putra Jaya</li>
                                <li>8. PT Jaya Mandiri Tran</li>
                                <li>9. KSU Trans Banyumas</li>
                                <li>10. Berkah Alam Sumber Sejahtera</li>
                                <li>11. PT Budi Jaya Transport</li>
                                <li>12. KSU Mandiri</li>
                            </ol>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 text-end">
                        <button class="struktur btn btn-danger m-4" data-bs-toggle="modal" data-bs-target="#myModal">Struktur Organisasi &#8702</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
            <!-- Full screen modal -->
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <a class="btn btn-primary" href="img/struktur.png" download="">Download
                            Disini</a>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img class="w-100" src="img/struktur.png" alt="">
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
    <script src="scripts/header.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>