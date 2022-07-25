<?php
require_once("../database.php");
require_once("../function.php");

if (!isset($_SESSION["login"])) {
    header("Location: ../../index.php");
    exit;
}


function updatePetaIntegrasi($id)
{
    global $conn;
    $peta = query("SELECT * FROM petaintegrasi WHERE id='$id'")[0];
    $imgLama = $peta["img"];
    unlink("../../media/petaIntegrasi/" . $imgLama);
    $img = uploadPetaIntegrasi();
    $id_admin = $_SESSION['id'];


    $query = "UPDATE petaintegrasi SET img= '$img' WHERE id=$id";
    mysqli_query($conn, $query);
    if ($img != "") {
        $aksi = "mengupdate peta integrasi";
        mysqli_query($conn, "INSERT INTO histori (aksi,id_admin)
        VALUES ('$aksi','$id_admin')");

        $status = "berhasil";
    } else {
        $status = "gagal";
    }

    return $status;
}

function uploadPetaIntegrasi()
{
    $namaFile = $_FILES['peta']['name'];
    $ukuranFile = $_FILES['peta']['size'];
    $error = $_FILES['peta']['error'];
    $tmpName = $_FILES['peta']['tmp_name'];

    // cek apakah tidak ada gambar yang diupload
    if ($error === 4) {
        echo "<script>
                alert('Pilih gambar terlebih dahulu!');
            </script>";
        return false;
    }


    // cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
                alert('Yang anda upload bukan gambar! Hanya menerima (jpg, jpeg, png)');
            </script>";
        return false;
    }
    //  cek jika ukurannya terlalu besar
    if ($ukuranFile > 2000000) {
        echo "<script>
                alert('Gambar terlalu besar! Gambar tidak boleh lebih dari 2mb');
            </script>";
        return false;
    }

    // lolos pengecekan, gambaar siap diupload
    // generate nama gambar baru
    $namaFileBaru = "peta-trans-banyumas";
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    move_uploaded_file($tmpName, '../../media/petaIntegrasi/' . $namaFileBaru);

    return $namaFileBaru;
}
