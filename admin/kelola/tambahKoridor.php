<?php

require_once("../database.php");
require_once("../function.php");

if (!isset($_SESSION["login"])) {
    header("Location: ../../index.php");
    exit;
};

function tambahKoridor()
{
    global $conn;
    $nama = htmlspecialchars($_POST["nama"]);
    $jurusan = htmlspecialchars($_POST["jurusan"]);
    $warna = $_POST["warna"];

    $result = query("SELECT * FROM koridor");
    $cekNama = "";
    foreach ($result as $r) {
        $cekNama = $r["nama"];
        if ($cekNama == $nama) {
            break;
        }
    }

    if ($cekNama == $nama) {
        echo "
            <script>
                alert('Nama sudah ada! Gunakan nama lain');
                document.location.href='koridor.php';
            </script>
        ";
    } else {
        $peta = uploadPetaKoridor($nama);
        $id_admin = $_SESSION['id'];
        if (!$peta) {
            return false;
        }

        mysqli_query($conn, "INSERT INTO koridor(nama, jurusan, warna, img) 
        VALUES ('$nama', '$jurusan', '$warna', '$peta')");
        if (mysqli_affected_rows($conn) > 0) {
            $aksi = "menambah koridor dengan nama " . $nama;
            mysqli_query($conn, "INSERT INTO kelola_koridor (id_admin,id_koridor) 
            VALUES ('$id_admin', (SELECT id FROM koridor WHERE nama='$nama'))");

            mysqli_query($conn, "INSERT INTO histori (aksi,id_admin)
            VALUES ('$aksi','$id_admin')");
            $status = 'berhasil';
        } else {
            $status = 'gagal';
        }
    }


    return $status;
};
