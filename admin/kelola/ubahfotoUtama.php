<?php

session_start();
require_once("../database.php");
require_once("../function.php");

if (!isset($_SESSION["login"])) {
  header("Location: ../../index.php");
  exit;
}

$id = $_GET["id"];
$foto = query("SELECT * FROM fotoutama WHERE id= $id")[0];
$imgLama = $foto["img"];

if (isset($_POST["ubah"])) {
  $fotolama = $foto["img"];
  unlink("../../media/fotoutama/" . $fotolama);
  $img = upload("fotoutama");
  $id_admin = $_SESSION['id'];


  $query = "UPDATE fotoutama SET img= '$img' WHERE id=$id";
  mysqli_query($conn, $query);
  if (mysqli_affected_rows($conn) > 0) {
    $aksi = "mengubah fotoutama dengan nama " . $imgLama . " -> " . $img;
    mysqli_query($conn, "INSERT INTO histori (aksi,id_admin)
        VALUES ('$aksi','$id_admin')");
    echo "
        <script>
            alert('Data berhasil diubah');
            document.location.href='fotoutama.php';
        </script>
    ";
  } else {
    echo "
        <script>
            alert('Data gagal diubah!');
            document.location.href='fotoutama.php';
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
  <title>Ubah Foto Utama</title>
</head>

<body>
  <div class="d-flex justify-content-center align-items-center p-5">
    <div class="card w-50">
      <div class="card-header bg-primary">
        <p class="h4 text-white">Ubah Foto Utama</p>
      </div>
      <div class="card-body">
        <form method="post" enctype="multipart/form-data">
          <div class=" mb-3">
            <label for="formFile" class="form-label"> Ubah Foto <small>(ratio 17x8)</small></label>
            <input class="form-control" type="file" id="formFile" name="gambar" required>
          </div>
          <a href="fotoUtama.php" class="btn btn-secondary">Kembali</a>
          <button type="submit" class="btn btn-primary" name="ubah">Ubah</button>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>