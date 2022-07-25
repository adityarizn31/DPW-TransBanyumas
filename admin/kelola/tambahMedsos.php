<?php
require_once("../database.php");
require_once("../function.php");

if (!isset($_SESSION["login"])) {
    header("Location: ../../index.php");
    exit;
};

function tambahMedsos()
{
    global $conn;
    $nama = htmlspecialchars($_POST["nama"]);
    $link = htmlspecialchars($_POST["link"]);
    $platform = htmlspecialchars($_POST["platform"]);
    $id_admin = $_SESSION['id'];

    mysqli_query($conn, "INSERT INTO medsos(nama, link, platform) 
    VALUES ('$nama', '$link', '$platform')");
    if (mysqli_affected_rows($conn) > 0) {
        $aksi = "menambah medsos dengan nama " . $nama . " (" . $platform . ")";
        mysqli_query($conn, "INSERT INTO kelola_medsos (id_admin,id_medsos) 
        VALUES ('$id_admin', (SELECT id FROM medsos WHERE link='$link'))");

        mysqli_query($conn, "INSERT INTO histori (aksi,id_admin)
        VALUES ('$aksi','$id_admin')");
        $status = 'berhasil';
    } else {
        $status = 'gagal';
    }

    return $status;
}
