<?php
require 'database.php';

if (isset($_POST['submit_password'])) {
    require('database.php');
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $pass2 = $_POST['password2'];

    if ($pass == $pass2) {
        $encrypt = password_hash($pass, PASSWORD_DEFAULT);

        $select = mysqli_query($conn, "UPDATE admin SET password='$encrypt' WHERE email='$email'");
        if (mysqli_affected_rows($conn) > 0) {
            echo "<script>alert('Reset Password Berhasil'); window.close();</script>";
        } else {
            echo "<script>alert('Reset Password Gagal');</script>";
        }
    } else {
        echo "<script>alert('Password tidak sama');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/reset_pass.css">
    <title>Reset Password</title>
</head>

<body>
    <!-- form login -->
    <main>
        <div class="masuk" data-aos="flip-down">
            <?php
            if ($_GET["key"] && $_GET["reset"]) {
                $email = $_GET["key"];
                $pass = $_GET["reset"];

                $select = mysqli_query($conn, "SELECT email, password FROM admin WHERE email='$email' AND password='$pass'");

                if (mysqli_num_rows($select) === 1) {

            ?>
                    <form action="" method="post">
                        <p class="h4">Reset Password</p>
                        <div class="alert" id="message">
                            <h6 id="message"></h6>
                        </div>
                        <div class="input-group">
                            <input type="password" name="password" id="password" onkeyup='check();' required>
                            <input type="hidden" name="email" value="<?php echo $email; ?>">
                            <input type="hidden" name="pass" value="<?php echo $pass; ?>">
                            <label for="password">Password Baru</label>
                        </div>
                        <div class="input-group">
                            <input type="password" name="password2" id="confirm_password" onkeyup='check();' required>
                            <label for="password2">Ulangi Password</label>
                        </div>
                        <div class="tombol">
                            <button type="submit" name="submit_password" class="btn btn-primary">Reset</button>
                        </div>
                    </form>
                <?php
                } else {
                    echo "Data tidak ditemukan";
                }
                ?>
            <?php

            } else {
                echo "<p>Gagal menerima data!</p>";
            }
            ?>


        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script type="text/javascript">
        var check = function() {
            if (document.getElementById('password').value == document.getElementById('confirm_password').value) {
                document.getElementById('message').style.color = 'green';
                document.getElementById('message').innerHTML = 'Password dan konfirmasi sama';
            } else {
                document.getElementById('message').style.color = 'red';
                document.getElementById('message').innerHTML = 'Password dan konfirmasi tidak sama';
            }
        }
    </script>
</body>

</html>