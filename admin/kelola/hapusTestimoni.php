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
$result = query("SELECT img,nama FROM testi WHERE id=$id")[0];

$namaGambar = $result["img"];
$nama = $result["nama"];


mysqli_query($conn, "DELETE FROM testi WHERE id= $id");
unlink("../../media/testi/" . $namaGambar);
if (mysqli_affected_rows($conn) > 0) {
    $aksi = "menghapus testimoni dengan nama " . $nama;
    mysqli_query($conn, "INSERT INTO histori (aksi,id_admin) VALUES ('$aksi','$id_admin')");
    echo "
        <script>
            alert('Data berhasil dihapus!');
            document.location.href='testimoni.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Data gagal dihapus!');
            document.location.href='testimoni.php';
        </script>
    ";
}
