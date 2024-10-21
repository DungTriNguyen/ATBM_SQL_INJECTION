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
       <link rel="shortcut icon" href="../image/logo-sgu.png" type="image/x-icon">

       <!-- thư viện dùng cho alert -->
       <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css" rel="stylesheet">
       <style>
              <?php
              require('../css/Header.css');
              require('../css/Footer.css');
              require('../css/UserProfile.css');
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
                            <div class="container-path"><a href="#!">Home</a>
                                   /
                                   <a href="#!">My account</a>
                            </div>
                     </div>
                     <div class="main-content">
                            <div style="margin-bottom: 70px;" class="container-main-content">
                                   <div class="content-left">
                                          <!-- Ten nguoi dung -->
                                          <div class="user-infor-left">
                                                 <i class="fas fa-user"></i>
                                                 <span id="user-name" class="user-name">Hi, AliceJohnson</span>
                                          </div>
                                          <hr>
                                          <ul class="user-menu-main">
                                                 <li class="menu-active"><i class="fa-regular fa-id-badge"></i>Profile</li>
                                                 <li id="change-password"><i class="fa-solid fa-key"></i>Change Password</li>
                                                 <li id="show-orders"><i class="fa-solid fa-cart-shopping"></i>Order</li>
                                          </ul>
                                   </div>
                                   <div class="content-right">
                                          <div class="title-right">
                                                 <h1>My Profile</h1>
                                                 <hr>
                                          </div>
                                          <form class="content-main-right">
                                                 <div class="item-my-profile">
                                                        <label for="username">User Name:</label>
                                                        <input type="text" id="username" name="username" value="AliceJohnson" disabled>
                                                 </div>
                                                 <div class="item-my-profile">
                                                        <label for="name">Name:</label>
                                                        <input type="text" id="name" name="name" value="Alice Johnson">
                                                 </div>
                                                 <div class="item-my-profile">
                                                        <label for="email">Gmail:</label>
                                                        <input type="email" id="email" name="email" value="alice@example.com">
                                                 </div>
                                                 <div class="item-my-profile">
                                                        <label for="address">Address:</label>
                                                        <input type="text" id="address" name="address" value="1010 Pine St">
                                                 </div>
                                                 <div class="item-my-profile">
                                                        <label for="phonenumber">Phone Number:</label>
                                                        <input type="text" id="phonenumber" name="phonenumber" value="0823072871">
                                                 </div>
                                                 <div class="item-my-profile">
                                                        <label for="datecreate">BirthDay: </label>
                                                        <input type="date" id="datebirth" name="birthday" value="1995-02-15">
                                                 </div>
                                                 <div class="item-my-profile">
                                                        <label for="datecreate">Date Create:</label>
                                                        <input type="date" id="datecreate" name="birthday" value="1995-02-15">
                                                 </div>
                                                 <div class="item-my-profile">
                                                        <p for="sex">Sex: </p>
                                                        <div id="sex-select" class="sex-select">
                                                               <div class="male-sex">
                                                                      <input type="radio" id="male" name="sex">
                                                                      <label for="male">Male</label>
                                                               </div>
                                                               <div class="female-sex">
                                                                      <input type="radio" id="female" name="sex" checked>
                                                                      <label for="female">Female</label>
                                                               </div>
                                                        </div>
                                                 </div>
                                                 <input style="margin-top: 40px;" id="save-infor-change" onclick="save_change_infor(event)" type="submit" class="save-profile-btn" value="Save"></input>


                                          </form>

                                   </div>
                                   <div class="content-right change-password display_none">
                                          <div class="title-right">
                                                 <h1>Change Password</h1>
                                                 <hr>
                                          </div>
                                          <form class="content-main-right">
                                                 <div class="item-my-password">
                                                        <label for="currentpassword">Current Password:</label>
                                                        <input type="password" id="currentpassword" name="currentpassword" value="asdasdasdasdasd" disabled>
                                                 </div>
                                                 <div class="item-my-password">
                                                        <label for="newpassword">New Password:</label>
                                                        <input type="password" id="newpassword" name="newpassword" value="">
                                                 </div>
                                                 <div class="item-my-password">
                                                        <label for="confirmpassword">Confirm Password:</label>
                                                        <input type="password" id="confirmpassword" name="confirmpassword" value="">
                                                 </div>
                                                 <input id="save-password-change" type="submit" class="save-password-btn" value="Save"></input>


                                          </form>

                                   </div>
                                   <div class="content-right order display_none">
                                          <div class="title-right">
                                                 <h1>Orders</h1>
                                                 <div>
                                                        <span style="margin-right: 10px;"><i class="fas fa-search"></i></span>
                                                        <input id="search-order" type="text" placeholder="Enter ordercode">
                                                 </div>
                                                 <hr>
                                          </div>
                                          <div style="height: 600px; overflow-y: auto; scrollbar-width: thin;" class="content-main-right" id="content-order">
                                                 <div class="item-order">
                                                        <div class="order-start">
                                                               <div class="head-order">
                                                                      <p>#ORD001</p>
                                                                      <p>COMPLETED</p>
                                                               </div>
                                                               <hr>
                                                               <div class="box-order">
                                                                      <img src="../image/product/product1/product-detail-1.png" alt="">
                                                                      <div class="product-name-and-quantity">
                                                                             <p>Jumpsuit quấn siêu mềm</p>
                                                                             <span>X1</span>
                                                                      </div>
                                                                      <div class="price-product">
                                                                             <span>39.99$</span>
                                                                             <span>31.99$</span>
                                                                      </div>
                                                               </div>
                                                        </div>

                                                        <div class="order-end">
                                                               <div class="detail">
                                                                      <p>Total: <span>31.99$</span></p>
                                                                      <div>
                                                                             <p>Order completion date: <span>2024-3-25</span>
                                                                             </p>
                                                                             <p><a href="./OrderDetail.php">Detail</a></p>
                                                                      </div>
                                                               </div>
                                                        </div>
                                                 </div>
                                                 <div class="item-order">
                                                        <div class="order-start">
                                                               <div class="head-order">
                                                                      <p>#ORD001</p>
                                                                      <p>COMPLETED</p>
                                                               </div>
                                                               <hr>
                                                               <div class="box-order">
                                                                      <img src="../image/product/product1/product-detail-1.png" alt="">
                                                                      <div class="product-name-and-quantity">
                                                                             <p>Jumpsuit quấn siêu mềm</p>
                                                                             <span>X1</span>
                                                                      </div>
                                                                      <div class="price-product">
                                                                             <span>39.99$</span>
                                                                             <span>31.99$</span>
                                                                      </div>
                                                               </div>
                                                        </div>

                                                        <div class="order-end">
                                                               <div class="detail">
                                                                      <p>Total: <span>31.99$</span></p>
                                                                      <div>
                                                                             <p>Order completion date: <span>2024-3-25</span>
                                                                             </p>
                                                                             <p><a href="./OrderDetail.php">Detail</a></p>
                                                                      </div>
                                                               </div>
                                                        </div>
                                                 </div>
                                                 <div class="item-order">
                                                        <div class="order-start">
                                                               <div class="head-order">
                                                                      <p>#ORD001</p>
                                                                      <p>COMPLETED</p>
                                                               </div>
                                                               <hr>
                                                               <div class="box-order">
                                                                      <img src="../image/product/product1/product-detail-1.png" alt="">
                                                                      <div class="product-name-and-quantity">
                                                                             <p>Jumpsuit quấn siêu mềm</p>
                                                                             <span>X1</span>
                                                                      </div>
                                                                      <div class="price-product">
                                                                             <span>39.99$</span>
                                                                             <span>31.99$</span>
                                                                      </div>
                                                               </div>
                                                        </div>

                                                        <div class="order-end">
                                                               <div class="detail">
                                                                      <p>Total: <span>31.99$</span></p>
                                                                      <div>
                                                                             <p>Order completion date: <span>2024-3-25</span>
                                                                             </p>
                                                                             <p><a href="./OrderDetail.php">Detail</a></p>
                                                                      </div>
                                                               </div>
                                                        </div>
                                                 </div>
                                                 <div class="item-order">
                                                        <div class="order-start">
                                                               <div class="head-order">
                                                                      <p>#ORD001</p>
                                                                      <p>COMPLETED</p>
                                                               </div>
                                                               <hr>
                                                               <div class="box-order">
                                                                      <img src="../image/product/product1/product-detail-1.png" alt="">
                                                                      <div class="product-name-and-quantity">
                                                                             <p>Jumpsuit quấn siêu mềm</p>
                                                                             <span>X1</span>
                                                                      </div>
                                                                      <div class="price-product">
                                                                             <span>39.99$</span>
                                                                             <span>31.99$</span>
                                                                      </div>
                                                               </div>
                                                        </div>

                                                        <div class="order-end">
                                                               <div class="detail">
                                                                      <p>Total: <span>31.99$</span></p>
                                                                      <div>
                                                                             <p>Order completion date: <span>2024-3-25</span>
                                                                             </p>
                                                                             <p><a href="./OrderDetail.php">Detail</a></p>
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
       <script src="../Js/UserProfile.js?v=<?php echo $version ?>"></script>

       <!-- thư viện dùng cho alert -->
       <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>
</body>

</html>