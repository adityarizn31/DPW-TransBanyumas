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
    <link rel="stylesheet" href="css/layanan.css">
    <title>Layanan</title>
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
        <!-- info -->
        <div class="info-trans">
            <div class="foto-card float-end" data-aos="zoom-in-down">
                <img src="img/layanan-trans.png" alt="">
            </div>
            <div class="teks">
                <h1 class="h1">Info Bus Trans Banyumas</h1>
                <div class="isi">
                    <p>Total armada Bus Trans Banyumas ada 52 unit diantaranya 46 beroperasi dan 6 cadangan apabila ada
                        bus
                        yang memerlukan perbaikan sehingga jumlah bus yang beroperasi tetap 46 unit. Dari total 52 unit
                        bus
                        10 bus merupakan kendaraan khusus untuk penyandang disabilitas dengan kekhusususan pintu bus
                        berada
                        dibagian belakang guna mempermudah penumpang yang mengunakan kursi roda. Pembagian armada dan
                        ketentuan
                        ritase pada setiap koridornya sebagai berikut.</p>
                    <ul>
                        <li>koridor 1 : 16 unit (5 ritase)</li>
                        <li>koridor 2 : 17 unit (4 ritase)</li>
                        <li>koridor 3 : 13 unit (7 ritase)</li>
                    </ul>
                </div>

            </div>
        </div>

        <!-- bungkus -->
        <div class="bungkus">
            <div class="clear"></div>
            <div class="row">
                <div class="col-12 col-md-6 d-flex justify-content-center">
                    <!-- cara pengguanaan -->
                    <div class="penggunaan" data-aos="fade-right">
                        <h4 class="h4 text-center mb-5 mt-2">Bagaimana Menggunakan Trans Banyumas?</h4>
                        <ul>
                            <li>
                                <div class="icon">
                                    <img src="img/payment-card.png" alt="">
                                </div>
                                <div class="langkah">
                                    <p>Memiliki kartu e-money atau sudah menginstall aplikasi teman bus</p>
                                </div>
                                <div class="clear"></div>
                            </li>
                            <li>
                                <div class="icon">
                                    <img src="img/bus-stop.png" alt="">
                                </div>
                                <div class="langkah">
                                    <p>Menunggu bus di halte/tempat pemberhentian bus Trans Banyumas</p>
                                </div>
                                <div class="clear"></div>
                            </li>
                            <li>
                                <div class="icon">
                                    <img src="img/payment.png" alt="">
                                </div>
                                <div class="langkah">
                                    <p>Masuk bus dan membayar dengan cara men-scan QR code atau menempelkan kartu</p>
                                </div>
                                <div class="clear"></div>
                            </li>
                            <li>
                                <div class="icon">
                                    <img src="img/waiting.png" alt="">
                                </div>
                                <div class="langkah">
                                    <p>Melakukan perjalanan dan menikmati layanan bus Trans Banyumas</p>
                                </div>
                                <div class="clear"></div>
                            </li>
                            <li>
                                <div class="icon">
                                    <img src="img/bus-arrived.png" alt="">
                                </div>
                                <div class="langkah">
                                    <p>Turun di halte/tempat pemberhentian bus tujuan</p>
                                </div>
                                <div class="clear"></div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-md-6 d-flex justify-content-center">
                    <!-- layanan -->
                    <div class="layanan" data-aos="fade-left">
                        <h4 class="h4 text-center mb-5 mt-2">Apa saja layanan di bus Trans Banyumas?</h4>
                        <ol>
                            <li>
                                <div class="nomor d-flex justify-content-center align-items-center text-white fw-bold">1
                                </div>
                                <div class="layanan-item">
                                    <p>Dilengkapi dengan AC</p>
                                </div>
                                <div class="clear"></div>
                            </li>
                            <li>
                                <div class="nomor d-flex justify-content-center align-items-center text-white fw-bold">2
                                </div>
                                <div class="layanan-item">
                                    <p>Memiliki 5 CCTV di setiap Bus</p>
                                </div>
                                <div class="clear"></div>
                            </li>
                            <li>
                                <div class="nomor d-flex justify-content-center align-items-center text-white fw-bold">3
                                </div>
                                <div class="layanan-item">
                                    <p>Kebersihan yang pasti terjamin</p>
                                </div>
                                <div class="clear"></div>
                            </li>
                            <li>
                                <div class="nomor d-flex justify-content-center align-items-center text-white fw-bold">4
                                </div>
                                <div class="layanan-item">
                                    <p>Sopir berlisensi</p>
                                </div>
                                <div class="clear"></div>
                            </li>
                            <li>
                                <div class="nomor d-flex justify-content-center align-items-center text-white fw-bold">5
                                </div>
                                <div class="layanan-item">
                                    <p>Terdapat "Panic Button" untuk keadaan urgensi</p>
                                </div>
                                <div class="clear"></div>
                            </li>
                            <li>
                                <div class="nomor d-flex justify-content-center align-items-center text-white fw-bold">6
                                </div>
                                <div class="layanan-item">
                                    <p>Terdapat teknologi pendeteksi wajah sopir yang dapat mendeteksi tingkat fokus
                                        sopir saat berkendara</p>
                                </div>
                                <div class="clear"></div>
                            </li>
                            <li>
                                <div class="nomor d-flex justify-content-center align-items-center text-white fw-bold">7
                                </div>
                                <div class="layanan-item">
                                    <p>Ramah untuk penyandang disabilitas, karena terdapat bus khusus dengan ciri pintu
                                        keluar berada di belakang</p>
                                </div>
                                <div class="clear"></div>
                            </li>
                            <li>
                                <div class="nomor d-flex justify-content-center align-items-center text-white fw-bold">8
                                </div>
                                <div class="layanan-item">
                                    <p>Dilengkapi teknologi pendeteksi asap rokok</p>
                                </div>
                                <div class="clear"></div>
                            </li>
                            <li>
                                <div class="nomor d-flex justify-content-center align-items-center text-white fw-bold">9
                                </div>
                                <div class="layanan-item">
                                    <p>Pada pintu masuk terdapat teknologi sensor penghitung otomatis "Load Factor"</p>
                                </div>
                                <div class="clear"></div>
                            </li>
                        </ol>
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