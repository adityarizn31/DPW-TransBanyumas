<?php

require_once("../database.php");
require_once("../function.php");

if (!isset($_SESSION["login"])) {
    header("Location: ../../index.php");
    exit;
};

function tambahHalte()
{
    global $conn;
    $nama = mysqli_real_escape_string($conn, htmlspecialchars($_POST["nama"]));
    $link = htmlspecialchars($_POST["link"]);
    $koridor = htmlspecialchars($_POST["koridor"]);
    $id_admin = $_SESSION['id'];

    mysqli_query($conn, "INSERT INTO halte(nama, link, koridor) 
    VALUES ('$nama', '$link', (SELECT id FROM koridor WHERE nama='$koridor'))");
    if (mysqli_affected_rows($conn) > 0) {
        $aksi = "menambah halte dengan nama " . $nama;
        mysqli_query($conn, "INSERT INTO kelola_halte (id_admin,id_halte) 
        VALUES ('$id_admin', (SELECT id FROM halte WHERE nama='$nama'))");

        mysqli_query($conn, "INSERT INTO histori (aksi,id_admin)
        VALUES ('$aksi','$id_admin')");
        $status = 'berhasil';
    } else {
        $status = 'gagal';
    }

    return $status;
};
