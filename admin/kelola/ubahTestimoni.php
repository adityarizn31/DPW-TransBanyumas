<?php

session_start();
require_once("../database.php");
require_once("../function.php");

if (!isset($_SESSION["login"])) {
    header("Location: ../../index.php");
    exit;
}

$id = $_GET["id"];
$testi = query("SELECT * FROM testi WHERE id= $id")[0];
if (isset($_POST["ubah"])) {
    $nama = mysqli_real_escape_string($conn, htmlspecialchars($_POST["nama"]));
    $kalimat = htmlspecialchars($_POST["kalimat"]);
    $fotoLama = $_POST["gambarLama"];
    $id_admin = $_SESSION["id"];

    if ($_FILES['gambar']['error'] === 4) {
        $foto = $fotoLama;
    } else {
        unlink("../../media/testi/" . $fotoLama);
        $foto = upload("testi");
    }

    $query = "UPDATE testi SET nama= '$nama', kalimat = '$kalimat', img='$foto' WHERE id=$id";
    mysqli_query($conn, $query);
    if (mysqli_affected_rows($conn) > 0) {
        $aksi = "mengubah testimoni dengan nama " . $nama;
        mysqli_query($conn, "INSERT INTO histori (aksi,id_admin)
        VALUES ('$aksi','$id_admin')");
        echo "
        <script>
            alert('Data berhasil diubah');
            document.location.href='testimoni.php';
        </script>
    ";
    } else {
        echo "
        <script>
            alert('Data gagal diubah!');
            document.location.href='testimoni.php';
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
    <title>Ubah Testimoni</title>
</head>

<body>
    <div class="d-flex justify-content-center align-items-center p-5">
        <div class="card w-50">
            <div class="card-header bg-primary">
                <p class="h4 text-white">Ubah Testimoni</p>
            </div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                    <input type="hidden" name="gambarLama" value="<?= $testi["img"]; ?>">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $testi["nama"]; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="kalimat" class="form-label">Kalimat</label>
                        <input type="text" class="form-control" id="kalimat" name="kalimat" value="<?= $testi["kalimat"]; ?>" maxlength="226" required>
                    </div>
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Foto Anda</label>
                        <input type="file" class="form-control" name="gambar" id="gambar">
                    </div>
                    <a href="berita.php" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary" name="ubah">Ubah</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>