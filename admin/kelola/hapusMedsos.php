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
$result = query("SELECT nama,platform FROM medsos WHERE id=$id")[0];

$nama = $result["nama"];
$platform = $result["platform"];


mysqli_query($conn, "DELETE FROM medsos WHERE id= $id");
if (mysqli_affected_rows($conn) > 0) {
    $aksi = "menghapus medsos dengan nama " . $nama . " (" . $platform . ")";
    mysqli_query($conn, "INSERT INTO histori (aksi,id_admin) VALUES ('$aksi','$id_admin')");
    echo "
        <script>
            alert('Data berhasil dihapus!');
            document.location.href='footer.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Data gagal dihapus!');
            document.location.href='footer.php';
        </script>
    ";
}
