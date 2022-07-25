<?php

session_start();
require_once("../database.php");
require_once("../function.php");

if (!isset($_SESSION["login"])) {
    header("Location: ../../index.php");
    exit;
}

$kor = query("SELECT * FROM koridor");

$id = $_GET["id"];
$halte = query("SELECT * FROM halte WHERE id= $id")[0];
if (isset($_POST["ubah"])) {
    $nama = mysqli_real_escape_string($conn, htmlspecialchars($_POST["nama"]));
    $link = htmlspecialchars($_POST["link"]);
    $koridor = htmlspecialchars($_POST["koridor"]);
    $id_koridor = query("SELECT id FROM koridor WHERE nama = '$koridor'")[0]["id"];

    $id_admin = $_SESSION["id"];

    $query = "UPDATE halte SET nama= '$nama', link= '$link', koridor= '$id_koridor' WHERE id=$id";
    mysqli_query($conn, $query);
    if (mysqli_affected_rows($conn) > 0) {
        $aksi = "mengubah halte dengan nama " . $nama;
        mysqli_query($conn, "INSERT INTO histori (aksi,id_admin)
        VALUES ('$aksi','$id_admin')");
        echo "
        <script>
            alert('Data berhasil diubah');
            document.location.href='halte.php';
        </script>
    ";
    } else {
        echo "
        <script>
            alert('Data gagal diubah!');
            document.location.href='halte.php';
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
    <title>Ubah Halte</title>
</head>

<body>
    <div class="d-flex justify-content-center align-items-center p-5">
        <div class="card w-50">
            <div class="card-header bg-primary">
                <p class="h4 text-white">Ubah Halte</p>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Halte</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $halte["nama"]; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="link" class="form-label">Link Google Maps</label>
                        <input type="text" class="form-control" id="link" name="link" value="<?= $halte["link"]; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="koridor" class="form-label">Koridor</label>
                        <div class="input-group">
                            <label class="input-group-text" for="koridor">Pilih</label>
                            <select class="form-select" id="koridor" name="koridor">
                                <?php foreach ($kor as $k) : ?>
                                    <option <?php if ($k["id"] == $halte["koridor"]) : ?> selected <?php endif; ?> value="<?= $k["nama"]; ?>"><?= $k["nama"]; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <button type=" button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" name="ubah">Ubah</button>

                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>