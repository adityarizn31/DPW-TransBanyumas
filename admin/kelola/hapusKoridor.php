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
$result = query("SELECT nama, img FROM koridor WHERE id=$id")[0];

$img = $result["img"];
$nama = $result["nama"];


mysqli_query($conn, "DELETE FROM koridor WHERE id= $id");
unlink("../../media/koridor/" . $img);
if (mysqli_affected_rows($conn) > 0) {
    $aksi = "menghapus koridor dengan nama " . $nama;
    mysqli_query($conn, "INSERT INTO histori (aksi,id_admin) VALUES ('$aksi','$id_admin')");
    echo "
        <script>
            alert('Data berhasil dihapus!');
            document.location.href='koridor.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Data gagal dihapus!');
            document.location.href='koridor.php';
        </script>
    ";
}
