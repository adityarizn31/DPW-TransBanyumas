<?php

session_start();
require_once("../database.php");
require_once("../function.php");

if (!isset($_SESSION["login"])) {
    header("Location: ../../index.php");
    exit;
}

$id = $_GET["id"];
$medsos = query("SELECT * FROM medsos WHERE id= $id")[0];
$namaLama = $medsos["nama"];
$platformLama = $medsos["platform"];
if (isset($_POST["ubah"])) {
    $nama = htmlspecialchars($_POST["nama"]);
    $link = htmlspecialchars($_POST["link"]);
    $platform = htmlspecialchars($_POST["platform"]);
    $id_admin = $_SESSION["id"];

    $query = "UPDATE medsos SET nama='$nama', link='$link', platform='$platform' WHERE id=$id";
    mysqli_query($conn, $query);
    if (mysqli_affected_rows($conn) > 0) {
        $aksi = "mengubah medsos dengan nama " . $namaLama . " (" . $platformLama . ")" . " -> " . $nama . " (" . $platform . ")";
        mysqli_query($conn, "INSERT INTO histori (aksi,id_admin)
        VALUES ('$aksi','$id_admin')");
        echo "
        <script>
            alert('Data berhasil diubah');
            document.location.href='footer.php';
        </script>
    ";
    } else {
        echo "
        <script>
            alert('Data gagal diubah!');
            document.location.href='footer.php';
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
    <title>Ubah Media Sosial</title>
</head>

<body>
    <div class="d-flex justify-content-center align-items-center p-5">
        <div class="card w-50">
            <div class="card-header bg-primary">
                <p class="h4 text-white">Ubah Media Sosial</p>
            </div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $medsos["id"]; ?>">
                    <div class="mb-3">
                        <label for="nama" class="form-label">nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $medsos["nama"]; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="link" class="form-label">link</label>
                        <input type="text" class="form-control" id="link" name="link" value="<?= $medsos["link"]; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="platform" class="form-label">Platform Media Sosial</label>
                        <div class="input-group">
                            <label class="input-group-text" for="platform">Pilih</label>
                            <select class="form-select" id="platform" name="platform">
                                <option <?php if ($medsos["platform"] == 'facebook') : ?> selected <?php endif; ?> value="facebook">Facebook</option>
                                <option <?php if ($medsos["platform"] == 'instagram') : ?> selected <?php endif; ?>value="instagram">Instagram</option>
                                <option <?php if ($medsos["platform"] == 'tiktok') : ?> selected <?php endif; ?>value="tiktok">TikTok</option>
                                <option <?php if ($medsos["platform"] == 'twitter') : ?> selected <?php endif; ?>value="twitter">Twitter</option>
                                <option <?php if ($medsos["platform"] == 'linkedin') : ?> selected <?php endif; ?>value="linkedin">LinkedIn</option>
                                <option <?php if ($medsos["platform"] == 'youtube') : ?> selected <?php endif; ?>value="youtube">Youtube</option>
                            </select>
                        </div>
                    </div>
                    <a href="berita.php" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary" name="ubah">Ubah</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script></script>
</body>

</html>