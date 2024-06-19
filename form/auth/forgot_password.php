<?php
    session_start();

    if (!isset($_SESSION['login'])) {
        header('Location: /auth/login');
        exit;
    }

    if (isset($_POST['submit'])) {
        include('../../config/database.php');
        $PasswordLama = $_POST['passwordlama'];
        $passwordBaru = $_POST['passwordbaru'];
        $VPassword = $_POST['konfirmasipassword'];   
    
        $query = "SELECT * FROM admin WHERE password = '$PasswordLama'";
    
        $result = $connect->query($query);
    
        if (mysqli_num_rows($result) > 0) {
            if ($passwordBaru == $VPassword) {
                $query = "UPDATE admin SET password = '$passwordBaru' WHERE password = '$PasswordLama'";
    
                $result = $connect->query($query);
    
                if ($result) {
                    header("Location: exit.php");
                    exit();
                } else {
                    $error = "Gagal mengubah password";
                }
            } else {
                $error = "Password Baru dan Validasi Password tidak cocok";
            }
        } else {
            $error = "Password Lama salah";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Forgot Password</title>

    <!-- Custom fonts for this template-->
    <link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <form method="post" class="user">
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="passwordlama" placeholder="Password Lama....">
                                            <input type="password" class="form-control form-control-user" name="passwordbaru" placeholder="Password Baru....">
                                            <input type="password" class="form-control form-control-user" name="konfirmasipassword" placeholder="Konfirmasi Password....">
                                        </div>
                                        <?php if (isset($error)) : ?>
                                            <p style="color:red;"><?php echo $error; ?></p>
                                        <?php endif; ?>
                                        <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">
                                            Reset Password
                                        </button>
                                    </form>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../assets/js/sb-admin-2.min.js"></script>

</body>

</html>
