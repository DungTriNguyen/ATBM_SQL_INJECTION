<!DOCTYPE html>
<html lang="en">
<?php require('../../config.php') ?>

<head>
    <title>Đăng nhập</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../GUI/css/reset.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../GUI/css/login.css" type="text/css" media="all" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="../image/logo-sgu.png" type="image/x-icon">
</head>

<body>
    <section class="w3l-form-36">
        <div class="form-36-mian section-gap">
            <div class="wrapper">
                <div class="form-inner-cont">
                    <h3>LOGIN</h3>
                    <form action="" method="post" class="signin-form">
                        <div class="form-input">
                            <span class="fa fa-envelope" aria-hidden="true"></span> <input id="userNameInput" type="text" name="email" placeholder="Username" required />
                        </div>
                        <div class="form-input">
                            <span class="fa fa-key" aria-hidden="true"></span> <input id="passWordInput" type="password" name="password" placeholder="Password" required />
                        </div>
                        <div class="login-remember d-grid">
                            <label class="check-remaind">
                                <!-- <input type="checkbox">
								<span class="checkmark"></span>
								<p class="remember">Remember</p> -->
                            </label>
                            <button class="btn theme-button" onclick="Login(event)">Login</button>
                        </div>
                        <div class="new-signup">
                            <a href="./forgot-password.php" class="signuplink">Forgot password?</a>
                        </div>
                    </form>
                    <div class="social-icons">
                        <p class="continue"><span>Or</span></p>
                        <div class="social-login">
                            <a href="https://www.facebook.com/thanh.sang.528" target="_blank">
                                <div class="facebook">
                                    <span class="fa-brands fa-facebook" aria-hidden="true"></span>

                                </div>
                            </a>
                            <a href="#google">
                                <div class="google">
                                    <span class="fa-brands fa-google-plus" aria-hidden="true"></span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <p class="signup">Do not have an account? <a href="../../GUI/view/signup.php" class="signuplink">Register now</a></p>
                    <a href="../../GUI/view/HomePage.php" class="login-now text-dark"><span class="fw-bold">Continue
                    </a>without needing an account</span>
                </div>
            </div>
        </div>
    </section>
    <script src="../../GUI/Js/Login.js?v=<?php echo $version ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>
</body>

</html>