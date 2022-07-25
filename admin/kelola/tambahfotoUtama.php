<?php

require_once("../database.php");
require_once("../function.php");

if (!isset($_SESSION["login"])) {
  header("Location: ../../index.php");
  exit;
};

function tambahFotoUtama()
{
  global $conn;
  $gambarutama = upload("fotoUtama"); // Nama folder
  $id_admin = $_SESSION['id'];
  if (!$gambarutama) {
    return false;
  }

  mysqli_query($conn, "INSERT INTO fotoutama(img) 
  VALUES ('$gambarutama')");
  if (mysqli_affected_rows($conn) > 0) {
    $aksi = " Menambah foto utama " . $gambarutama;
    mysqli_query($conn, "INSERT INTO kelola_fotoutama (id_admin, id_fotoutama) 
      VALUES ('$id_admin', (SELECT id FROM fotoutama WHERE img='$gambarutama'))");

    mysqli_query($conn, "INSERT INTO histori (aksi, id_admin)
      VALUES ('$aksi','$id_admin')");
    $status = 'berhasil';
  } else {
    $status = 'gagal';
  }

  return $status;
}
