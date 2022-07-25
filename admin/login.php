<?php
session_start();

require 'database.php';

if (isset($_POST["login"])) {
    $username = $_POST["user"];
    $password = $_POST["pass"];

    $result = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username'");

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_array($result);
        $id = $row["id"];
        $nama = $row["nama"];
        if (password_verify($password, $row["password"])) {
            $_SESSION["login"] = true;
            $_SESSION["id"] = $id;
            $_SESSION["nama"] = $nama;
            $_SESSION["koridor"] = "Koridor 1";
            header("Location: dashboard.php?pesan=berhasil");
            exit;
        }
    }
    $error = true;
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
    <link rel="stylesheet" href="../css/login.css">
    <title>Login Admin</title>
</head>

<body>

    <!-- form login -->
    <main>
        <div class="masuk" data-aos="flip-down">
            <?php
            if (isset($_GET['email'])) :
                if ($_GET['email'] == "terkirim") :
            ?>
                    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.
                            75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                        </symbol>
                    </svg>
                    <div class="query alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                            <use xlink:href="#check-circle-fill" />
                        </svg>
                        <div>
                            Email berhasil terkirim!
                        </div>
                        <button type="button" name="close" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                    </div>
                <?php
                elseif ($_GET['email'] == 'gagal') :
                ?>
                    <div class="query alert alert-danger alert-dismissible fade show" role="alert">
                        Email tidak terdaftar!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
            <?php
                endif;
            endif;
            ?>
            <form action="" method="post">
                <div class="contain-logo">
                    <div class="logo">
                        <img src="../img/logo.png" alt="logo">
                    </div>
                </div>
                <p class="h4 text-center">Login</p>

                <?php if (isset($error)) : ?>
                    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                        </symbol>
                    </svg>
                    <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                            <use xlink:href="#exclamation-triangle-fill" />
                        </svg>
                        <div>
                            <strong>Username/password salah!</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="input-group">
                    <input type="text" name="user" id="user" required>
                    <label for="user">Username</label>
                </div>
                <div class="input-group">
                    <input type="password" name="pass" id="pass" required>
                    <label for="pass">Password</label>
                </div>
                <div class="tombol">
                    <button type="submit" name="login" class="btn btn-primary">Login</button>
                </div>
                <div class="tombol">
                    <a href="../index.html" class="btn btn-secondary">Kembali</a>
                </div>
                <div class="link">
                    <a href="lupa_password.php">Lupa Password?</a>
                </div>
            </form>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>