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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- thư viện dùng cho alert -->
        <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css" rel="stylesheet">
        <link rel="shortcut icon" href="../image/logo-sgu.png" type="image/x-icon">
        <style>
                <?php
                require('../css/Header.css');
                require('../css/Footer.css');
                require('../css/OrderDetail.css');
                ?>
        </style>


</head>

<body>
        <!-- header -->
        <?php require('./header.php'); ?>
        <!-- body -->
        <section class="body">
                <div class="content">
                        <div class="path">
                                <div class="container-path"><a href="">Home</a>
                                        /
                                        <a href="#!">Order Detail</a>
                                </div>
                        </div>
                        <div class="main-content">
                                <div class="container-main-content">
                                        <!-- <div class="content-left">
                                                
                                                <div class="user-infor-left">
                                                        <i class="fas fa-user"></i>
                                                        <span class="user-name">Hi, AliceJohnson</span>
                                                </div>
                                                <hr>
                                                <ul class="user-menu-main">
                                                        <li class="menu-active"><i class="fa-regular fa-id-badge"></i>Profile</li>
                                                        <li><i class="fa-solid fa-key"></i>Change Password</li>
                                                        <li><a href="../../GUI/view/UserProfile.php"><i class="fa-solid fa-cart-shopping"></i>Order</a></li>

                                        </div> -->
                                        <div class="content-right order ">
                                                <div class="title-right">
                                                        <h1>Orders Detail</h1>
                                                        <hr>
                                                </div>
                                                <div class="content-main-right">
                                                        <div class="item-order">
                                                                <div class="order-start">
                                                                        <div class="head-order">
                                                                                <p>#ORD001</p>
                                                                                <p>COMPLETED</p>
                                                                        </div>
                                                                        <hr>
                                                                        <div class="box-order">
                                                                                <table>
                                                                                        <thead>
                                                                                                <tr>
                                                                                                        <th>No</th>
                                                                                                        <th>Name</th>
                                                                                                        <th>Image</th>
                                                                                                        <th>Price</th>
                                                                                                        <th>Quantity</th>
                                                                                                        <th>Total</th>
                                                                                                        <th>Reviews</th>
                                                                                                </tr>
                                                                                        </thead>
                                                                                        <tbody id="content-data-orderDetail">
                                                                                                <tr>
                                                                                                        <td>1</td>
                                                                                                        <td>Jumpsuit quấn siêu mềm</td>
                                                                                                        <td><img src="../image/product/product1/product-detail-1.png" alt=""></td>
                                                                                                        <td>31.99$</td>
                                                                                                        <td>1</td>
                                                                                                        <td>31.99</td>
                                                                                                        <td><a href="#!">Review</a></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td>2</td>
                                                                                                        <td>JDenim playsuit</td>
                                                                                                        <td><img src="../image/product/product2/product-detail-1.png" alt=""></td>
                                                                                                        <td>39.99$</td>
                                                                                                        <td>2</td>
                                                                                                        <td>79.98</td>
                                                                                                        <td><a href="#!">Review</a></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td>3</td>
                                                                                                        <td>Halterneck jumpsuitm</td>
                                                                                                        <td><img src="../image/product/product3/product-detail-1.png" alt=""></td>
                                                                                                        <td>39.99$</td>
                                                                                                        <td>1</td>
                                                                                                        <td>39.99</td>
                                                                                                        <td><a href="#!">Review</a></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td colspan="5">Total</td>
                                                                                                        <td>151.96$</td>
                                                                                                        <td></td>
                                                                                                </tr>

                                                                                        </tbody>
                                                                                </table>
                                                                        </div>
                                                                        <div class="box-review">
                                                                                <div>
                                                                                        <h2>Review</h2>
                                                                                        <div class="box-product-review">
                                                                                                <div class="product-img-name">
                                                                                                        <p>JDenim playsuit</p>
                                                                                                        <img src="../image/product/product1/product-detail-1.png" alt="">
                                                                                                </div>
                                                                                                <div class="input-review">
                                                                                                        <textarea rows="10" cols="60" placeholder="Write something....."></textarea>
                                                                                                        <div><a href="#!">Send</a></div>
                                                                                                </div>
                                                                                        </div>
                                                                                </div>
                                                                                <div>
                                                                                        <h2>Review</h2>
                                                                                        <div class="box-product-review">
                                                                                                <div class="product-img-name">
                                                                                                        <p>JDenim playsuit</p>
                                                                                                        <img src="../image/product/product2/product-detail-1.png" alt="">
                                                                                                </div>
                                                                                                <div class="input-review">
                                                                                                        <textarea rows="10" cols="60" placeholder="Write something....."></textarea>
                                                                                                        <div><a href="#!">Send</a></div>
                                                                                                </div>
                                                                                        </div>
                                                                                </div>
                                                                                <div>
                                                                                        <h2>Review</h2>
                                                                                        <div class="box-product-review">
                                                                                                <div class="product-img-name">
                                                                                                        <p>JDenim playsuit</p>
                                                                                                        <img src="../image/product/product3/product-detail-1.png" alt="">
                                                                                                </div>
                                                                                                <div class="input-review">
                                                                                                        <textarea rows="10" cols="60" placeholder="Write something....."></textarea>
                                                                                                        <div><a href="#!">Send</a></div>
                                                                                                </div>
                                                                                        </div>
                                                                                </div>

                                                                        </div>
                                                                </div>
                                                        </div>
                                                </div>

                                        </div>
                                </div>
                        </div>
        </section>

        <!-- footer -->
        <?php require('./footer.php'); ?>

        <script src="../Js/Header.js?v=<?php echo $version ?>"></script>
        <!-- <script src="../Js/UserProfile.js?v=<?php echo $version ?>"></script> -->
        <script src="../Js/orderdetails.js?v=<?php echo $version ?>"></script>
        <!-- thư viện dùng cho alert -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>
</body>

</html>