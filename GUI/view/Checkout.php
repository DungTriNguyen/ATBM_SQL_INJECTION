<!DOCTYPE html>
<html lang="en">
<?php require('../../config.php') ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage</title>
    <!-- <link rel="stylesheet" href="../css/Footer.css">
       <link rel="stylesheet" href="../css/HomePage.css">
       <link rel="stylesheet" href="../css/Header.css"> -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../image/logo-sgu.png" type="image/x-icon">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>
    <style>
        <?php require('../css/Header.css');
        require('../css/Footer.css');
        require('../css/Checkout.css');
        ?>
    </style>


</head>

<body>
    <!-- header -->
    <?php require('./header.php'); ?>
    <!-- body -->
    <section class="body">
        <div class="path">
            <div class="container-path"><a href="#!">Home</a>
                /
                <a href="#!">Checkout</a>

            </div>
        </div>
        <div class="main-content">
            <div class="container">
                <div class="content-left">
                    <h2>BILLING DETAILS</h2>
                    <hr>
                    <form action="">
                        <div class="form-item fullname">
                            <label for="fullname">Full Name<span>*</span><label>
                                    <input type="text" id="fullname" name="fullname" disabled>
                        </div>
                        <div class="form-item address">
                            <label for="address">Delivery Address: <span>*</span></label>
                            <input type="address" id="address" name="address">
                        </div>
                        <div class="form-item phone">
                            <label for="phone">Phone<span>*</span></label>
                            <input type="text" id="phone" name="phone" disabled>
                        </div>
                        <div class="form-item order-note">
                            <label for="order-note">Order notes: </label>
                            <input type="text" id="order-note" name="order-note">
                            <!-- <textarea name="order-note" id="order-note" ></textarea> -->
                        </div>
                        <div class="form-item order-note">
                            <label for="payment">Payment: <span>*</span></label>
                            <select id="payment" name="payment">
                                <option value="option1">Option 1</option>
                                <option value="option2">Option 2</option>
                                <option value="option3">Option 3</option>
                            </select>
                        </div>
                        <div class="form-item order-note">
                            <label for="transport">Transport: <span>*</span></label>
                            <select id="transport" name="transport">
                                <option value="option1">Option 1</option>
                                <option value="option2">Option 2</option>
                                <option value="option3">Option 3</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="content-right">
                    <h2>YOUR ORDER</h2>
                    <hr>
                    <div class="order">
                        <div class="title">
                            <p>No</p>
                            <p>Name</p>
                            <p>Quantity</p>
                            <p>Price</p>
                            <p>Total</p>
                        </div>
                        <div style="overflow-y: auto; overflow-x:hidden; scrollbar-width: thin; height: 200px;" id="container-order-detail">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <!-- <div class="item-order">
                                <p>1</p>
                                <p>Oversized crinkled shirt</p>
                                <p>1</p>
                                <p>$100</p>
                                <p>$100</p>
                            </div>
                            <div class="item-order">
                                <p>1</p>
                                <p>Oversized crinkled shirt</p>
                                <p>1</p>
                                <p>$100</p>
                                <p>$100</p>
                            </div>
                            <div class="item-order">
                                <p>1</p>
                                <p>Oversized crinkled shirt</p>
                                <p>1</p>
                                <p>$100</p>
                                <p>$100</p>
                            </div>
                            <div class="item-order">
                                <p>1</p>
                                <p>Oversized crinkled shirt</p>
                                <p>1</p>
                                <p>$100</p>
                                <p>$100</p>
                            </div>
                            <div class="item-order">
                                <p>1</p>
                                <p>Oversized crinkled shirt</p>
                                <p>1</p>
                                <p>$100</p>
                                <p>$100</p>
                            </div> -->

                        </div>
                    </div>
                    <hr>
                    <div class="total-order">
                        <p>Total</p>
                        <p id="total-money">$400</p>
                    </div>
                    <hr>
                    <div id="checkout-button" class="button-placeorder">PLACE ORDER</div>
                </div>
            </div>
        </div>
    </section>

    <!-- footer -->
    <?php require('./footer.php'); ?>

    <script src="../Js/Header.js?v=<?php echo $version ?>"></script>
    <script src="../Js/Checkout.js?v=<?php echo $version ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>
    <!-- <script src="../Js/shop.js"></script> -->
    <!-- <script src="../Js/pricesidebar.js"></script> -->
</body>

</html>