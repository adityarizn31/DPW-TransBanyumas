<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

require 'database.php';

if (isset($_POST["kirim"])) {
    $email = $_POST["email"];

    $result = mysqli_query($conn, "SELECT email, password FROM admin WHERE email='$email'");

    if (mysqli_num_rows($result) === 1) {
        while ($row = mysqli_fetch_object($result)) {
            $email = $row->email;
            $pass = $row->password;
        }

        $email_pengirim = 'kitchifypbo@gmail.com';
        $nama_pengirim = 'Trans Banyumas';
        $email_penerima = $email;
        $subjek = 'Ubah Password';
        $pesan =
            "Klik link berikut untuk reset Password, 
            <a href='localhost/trans-2/admin/reset_pass.php?reset=$pass&key=$email'>Reset Password</a>";

        $mail = new PHPMailer;
        $mail->isSMTP();

        $mail->Host = 'smtp.gmail.com';
        $mail->Username = $email_pengirim;
        $mail->Password = 'lkysebntgmxyccsj';
        $mail->Port = 465;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->SMTPDebug = 2;

        $mail->setFrom($email_penerima, $nama_pengirim);
        $mail->addAddress($email_penerima);
        $mail->isHTML(true);
        $mail->Subject = $subjek;
        $mail->Body = $pesan;

        $send = $mail->send();

        if ($send) {
            header("Location: login.php?email=terkirim");
            exit;
        } else {
            header("Location: login.php?email=gagal");
            exit;
        }
    } else {
        $error = true;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/forget.css">
    <title>Lupa Password</title>
</head>

<body>

    <main>
        <div class="card">
            <form action="" method="post">
                <h2>Lupa Password</h2>
                <?php if (isset($error)) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Email tidak terdaftar!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <div class="input-group">
                    <input type="email" name="email" id="email" required>
                    <label for="email">Email</label>
                </div>
                <a href="login.php" class="btn btn-secondary">Kembali</a>
                <button type="submit" name="kirim" class="btn btn-primary">Kirim</button>
            </form>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>