<?php

require_once("../database.php");
require_once("../function.php");

if (!isset($_SESSION["login"])) {
    header("Location: ../../index.php");
    exit;
};

function tambahTestimoni()
{
    global $conn;
    $nama = mysqli_real_escape_string($conn, htmlspecialchars($_POST["nama"]));
    $kalimat = htmlspecialchars($_POST["kalimat"]);
    $foto = upload("testi");
    $id_admin = $_SESSION['id'];
    if (!$foto) {
        return false;
    }

    mysqli_query($conn, "INSERT INTO testi(nama, kalimat, img) 
    VALUES ('$nama', '$kalimat', '$foto')");
    if (mysqli_affected_rows($conn) > 0) {
        $aksi = "menambah berita dengan nama " . $nama;
        mysqli_query($conn, "INSERT INTO kelola_testi (id_admin,id_testi) 
        VALUES ('$id_admin', (SELECT id FROM testi WHERE nama ='$nama'))");

        mysqli_query($conn, "INSERT INTO histori (aksi,id_admin)
        VALUES ('$aksi','$id_admin')");
        $status = 'berhasil';
    } else {
        $status = 'gagal';
    }

    return $status;
};
