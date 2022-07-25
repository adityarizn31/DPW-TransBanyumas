<?php

session_start();
require_once("../database.php");
require_once("../function.php");

if (!isset($_SESSION["login"])) {
    header("Location: ../../index.php");
    exit;
}

$id = $_GET["id"];
$koridor = query("SELECT * FROM koridor WHERE id= $id")[0];

if (isset($_POST["ubah"])) {
    $nama = htmlspecialchars($_POST["nama"]);
    $jurusan = htmlspecialchars($_POST["jurusan"]);
    $warna = $_POST["warna"];
    $imgLama = $_POST["imgLama"];

    if ($_FILES['peta']['error'] === 4) {
        $img = $imgLama;
    } else {
        unlink("../../media/koridor/" . $imgLama);
        $img = uploadPetaKoridor($nama);
    }

    $id_admin = $_SESSION['id'];

    $query = "UPDATE koridor SET nama='$nama', jurusan='$jurusan', warna='$warna', img= '$img' WHERE id=$id";
    mysqli_query($conn, $query);
    if (mysqli_affected_rows($conn) > 0) {
        $aksi = "mengubah koridor dengan nama " . $nama;
        mysqli_query($conn, "INSERT INTO histori (aksi,id_admin)
        VALUES ('$aksi','$id_admin')");
        echo "
        <script>
            alert('Data berhasil diubah');
            document.location.href='koridor.php';
        </script>
    ";
    } else {
        echo "
        <script>
            alert('Data gagal diubah!');
            document.location.href='koridor.php';
        </script>
    ";
    }
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
    <link rel="stylesheet" href="../../css/conf.css">
    <title>Ubah Koridor</title>
</head>

<body>
    <div class="d-flex justify-content-center align-items-center p-5">
        <div class="card w-50">
            <div class="card-header bg-primary">
                <p class="h4 text-white">Ubah Koridor</p>
            </div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $koridor["id"]; ?>">
                    <input type="hidden" name="imgLama" value="<?= $koridor["img"]; ?>">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $koridor["nama"]; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="jurusan" class="form-label">Jurusan</label>
                        <input type="text" class="form-control" id="jurusan" name="jurusan" value="<?= $koridor["jurusan"]; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="warna" class="form-label">Warna</label>
                        <input type="color" class="form-control form-control-color" id="warna" name="warna" value="<?= $koridor["warna"]; ?>" title="Pilih warna untuk koridor" required>
                    </div>
                    <div class="mb-3">
                        <label for="peta" class="form-label">Peta</label>
                        <input type="file" class="form-control" name="peta" id="peta">
                    </div>
                    <a href="koridor.php" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary" name="ubah">Ubah</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>