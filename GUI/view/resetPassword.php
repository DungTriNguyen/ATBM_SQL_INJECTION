<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên mật khẩu</title>
    <link rel="stylesheet" href="../css/forgotPassword.css?v=<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="../image/logo-sgu.png" type="image/x-icon">
</head>

<body>
    <div class="container">
        <div class="form-container" id="emailForm">
            <div class="logo-container">
                Set a new password
            </div>

            <form class="form">
                <div class="form-group">
                    <label for="email">Enter your new password</label>
                    <input type="text" id="newPassword" name="newpw" placeholder="New Password" required="">
                </div>
                <br>
                <div class="form-group">
                    <label for="email">Repeat a new password</label>
                    <input type="text" id="rePassword" name="newpw" placeholder="Confirm Password" required="">
                </div>

                <button onclick="resetPass(event)" class="form-submit-btn" id="btnSendEmail" type="submit">Reset Password</button>
            </form>

            <!-- <p class="signup-link">
                Bạn chưa có tài khoản?
                <a href="../view/signup.php" class="signup-link link"> Đăng ký ngay</a>
            </p> -->
        </div>

    </div>
    <script src="../Js/resetPass.js?v=<?php echo time(); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>

</body>