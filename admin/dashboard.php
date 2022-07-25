<?php

session_start();

if (!isset($_SESSION["login"])) {
    header("Location: ../index.php");
    exit;
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
    <link rel="stylesheet" href="../css/dashboardv2.css">
    <link rel="stylesheet" href="../css/nav-kelola.css">
    <title>Dashboard</title>
</head>

<body>
    <?php if (isset($_GET['pesan'])) : ?>
        <?php if ($_GET['pesan'] == "berhasil") : ?>
            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                </symbol>
            </svg>
            <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                    <use xlink:href="#check-circle-fill" />
                </svg>
                <div>
                    Login berhasil, selamat datang <?= $_SESSION["nama"]; ?>!
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
    <?php endif; ?>
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
        <div class="row">
            <input type="checkbox" name="kelola" id="kelola">
            <div class="nav-kelola">
                <div class="nama">
                    <p class="h4 text-white"><?= $_SESSION["nama"]; ?></p>
                </div>
                <div class="row">
                    <div class="col-9">
                        <ul>
                            <li><a href="">Home</a></li>
                            <li><a href="kelola/petaIntegrasi.php">Peta Integrasi</a></li>
                            <li><a href="kelola/fotoUtama.php">Foto Utama</a></li>
                            <li><a href="kelola/berita.php">Berita</a></li>
                            <li><a href="kelola/testimoni.php">Testimoni</a></li>
                            <li><a href="kelola/koridor.php">Koridor</a></li>
                            <li><a href="kelola/halte.php">Halte</a></li>
                            <li><a href="kelola/footer.php">Footer</a></li>
                        </ul>
                    </div>
                    <div class="col-3 d-flex align-items-center">
                        <label for="kelola" class="arrow d-flex justify-content-center align-items-center">
                            <img src="../img/arrow-right.png" alt="">
                        </label>
                    </div>
                </div>
            </div>
            <div class="left-side col-2"></div>
            <div class="right-side col-10">
                <div class="content">
                    <!-- riwayat -->
                    <a href="riwayat.php" class="riwayat btn btn-secondary m-3">
                        <div class="d-flex align-items-center">
                            <img src="../img/history.png" alt="..." width="30px">
                            Riwayat
                        </div>
                    </a>
                    <div class="row">
                        <div class="col-12 col-md-4 d-flex justify-content-center">
                            <a href="kelola/petaIntegrasi.php">
                                <div class="item">
                                    <img src="../img/map.png" alt="">
                                    <p class="h4 fw-bold">Peta Integrasi</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-12 col-md-4 d-flex justify-content-center">
                            <a href="kelola/fotoUtama.php">
                                <div class="item">
                                    <img src="../img/image-gallery.png" alt="">
                                    <p class="h4 fw-bold">Foto Utama</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-12 col-md-4 d-flex justify-content-center">
                            <a href="kelola/berita.php">
                                <div class="item">
                                    <img src="../img/newspaper.png" alt="">
                                    <p class="h4 fw-bold">Berita</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-12 col-md-4 d-flex justify-content-center">
                            <a href="kelola/testimoni.php">
                                <div class="item">
                                    <img src="../img/testimonial.png" alt="">
                                    <p class="h4 fw-bold">Testimoni</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-12 col-md-4 d-flex justify-content-center">
                            <a href="kelola/koridor.php">
                                <div class="item">
                                    <img src="../img/route.png" alt="">
                                    <p class="h4 fw-bold">Koridor</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-12 col-md-4 d-flex justify-content-center">
                            <a href="kelola/halte.php">
                                <div class="item">
                                    <img src="../img/halte.png" alt="">
                                    <p class="h4 fw-bold">Halte</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="../scripts/header.js"></script>
</body>

</html>