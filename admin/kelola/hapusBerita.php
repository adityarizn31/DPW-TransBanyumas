<?php
session_start();
require_once("../database.php");
require_once("../function.php");

if (!isset($_SESSION["login"])) {
    header("Location: ../../index.php");
    exit;
}

$id = $_GET["id"];
$id_admin = $_SESSION["id"];
$result = query("SELECT thumbnail,judul FROM berita WHERE id=$id")[0];

$namaGambar = $result["thumbnail"];
$judul = $result["judul"];


mysqli_query($conn, "DELETE FROM berita WHERE id= $id");
unlink("../../media/berita/" . $namaGambar);
if (mysqli_affected_rows($conn) > 0) {
    $aksi = "menghapus berita dengan judul " . $judul;
    mysqli_query($conn, "INSERT INTO histori (aksi,id_admin) VALUES ('$aksi','$id_admin')");
    echo "
        <script>
            alert('Data berhasil dihapus!');
            document.location.href='berita.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Data gagal dihapus!');
            document.location.href='berita.php';
        </script>
    ";
}
