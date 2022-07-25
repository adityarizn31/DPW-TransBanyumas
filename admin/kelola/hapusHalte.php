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
$result = query("SELECT nama FROM halte WHERE id=$id")[0];

$nama = $result["nama"];

mysqli_query($conn, "DELETE FROM halte WHERE id= $id");
if (mysqli_affected_rows($conn) > 0) {
    $aksi = "menghapus halte dengan nama " . $nama;
    mysqli_query($conn, "INSERT INTO histori (aksi,id_admin) VALUES ('$aksi','$id_admin')");
    echo "
        <script>
            alert('Data berhasil dihapus!');
            document.location.href='halte.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Data gagal dihapus!');
            document.location.href='halte.php';
        </script>
    ";
}
