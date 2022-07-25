<?php

require_once("../database.php");
require_once("../function.php");

if (!isset($_SESSION["login"])) {
    header("Location: ../../index.php");
    exit;
};

function tambahBerita()
{
    global $conn;
    $judul = mysqli_real_escape_string($conn, htmlspecialchars($_POST["judul"]));
    $preview = mysqli_real_escape_string($conn, htmlspecialchars($_POST["preview"]));
    $content = mysqli_real_escape_string($conn, htmlspecialchars($_POST["content"]));
    $thumbnail = upload("berita");
    $id_admin = $_SESSION['id'];
    if (!$thumbnail) {
        return false;
    }

    mysqli_query($conn, "INSERT INTO berita(judul, preview, content, thumbnail) 
    VALUES ('$judul', '$preview', '$content', '$thumbnail')");
    if (mysqli_affected_rows($conn) > 0) {
        $aksi = "menambah berita dengan judul " . $judul;
        mysqli_query($conn, "INSERT INTO kelola_berita (id_admin,id_berita) 
        VALUES ('$id_admin', (SELECT id FROM berita WHERE judul='$judul'))");

        mysqli_query($conn, "INSERT INTO histori (aksi,id_admin)
        VALUES ('$aksi','$id_admin')");
        $status = 'berhasil';
    } else {
        $status = 'gagal';
    }

    return $status;
};
