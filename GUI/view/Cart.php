<!DOCTYPE html>
<html lang="en">
<?php require('../../config.php') ?>

<head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>Cart</title>
       <!-- <link rel="stylesheet" href="../css/Footer.css">
       <link rel="stylesheet" href="../css/HomePage.css">
       <link rel="stylesheet" href="../css/Header.css"> -->
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
       <link rel="shortcut icon" href="../image/logo-sgu.png" type="image/x-icon">
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
       
       <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>
       <style>
              <?php
              require('../css/Header.css');
              require('../css/Cart.css');
              require('../css/Footer.css');
              ?>
       </style>
       <script src="https://kit.fontawesome.com/fc3c5402e6.js" crossorigin="anonymous"></script>

</head>

<body>
       <!-- header -->
       <?php require('./header.php'); ?>

       <!-- body -->
       <div class="content_holder">
              <div class="path">
                     <div class="path_container container">
                            <ul class="path_list">
                                   <li class="path_list_item">
                                          <a href="" class="path_item_link">Home</a>
                                   </li>
                                   <li class="path_list_item">
                                          <a href="" class="path_item_link">Cart</a>
                                   </li>
                            </ul>
                     </div>
              </div>
              <div class="content_cart">
                     <div class="container">
                            <div class="title_cart">
                                   <h1 class="title_cart_header">CART</h1>
                            </div>
                            <div class="content_list_item">
                                   <!-- Thông báo thêm sp muốn ẩn thêm class display_none -->
                                   <div id="warning-add-success" class="content_cart_mess">
                                          <div class="cart_mess_icon">
                                                 <i class="fa-solid fa-circle-check"></i>
                                          </div>
                                          <span id="name-item" class="cart_mess_text">“Cotton T-shirt” has been added to your cart.</span>
                                          <!-- <a class="cart_mess_btn btn_cart">Continue shopping</a> -->
                                   </div>
                                   <!-- List trống ẩn thêm class empty_status_off -->
                                   <div id="warning-empty" class="content_cart_info">
                                          <div class="cart_empty_icon">
                                                 <i class="fa-regular fa-window-maximize"></i>
                                          </div>
                                          <div class="cart_empty_text">Your cart is currently empty</div>
                                   </div>
                                   <!-- List có sp ẩn thêm class have_products_off -->
                                   <table class="content_cart_list table_cart ">
                                          <thead>
                                                 <tr>
                                                        <th class="product_item_type product_name">Product</th>
                                                        <th class="product_item_type product_quantity">Quantity</th>
                                                        <th class="product_item_type product_remove">&nbsp;</th>
                                                 </tr>
                                          </thead>
                                          <tbody id="show-cart">
                                                 <!-- <tr class="product_main_cart">
                                                        <td class="product_name" >
                                                               <div class="product_name_img" >
                                                                      
                                                                      <a href="https://minimal.crv.vn/product/cotton-t-shirt/">
                                                                             <img src="../image/product/product2/product-detail-1.png" alt="Cart">
                                                                      </a>
                                                               </div>
                                                               <div class="product_name_text">
                                                                      
                                                                      <a class="product_name_link" href="https://minimal.crv.vn/product/cotton-t-shirt/">Cotton T-Shirt</a>
                                                                      <span class="product_name_price">$9.99</span>
                                                               </div>
                                                        </td>
                                                        <td class="product_quantity">
                                                               <label class="product_quantity_text" for="">Quantity</label>
                                                               <input class="input_num_quantity" type="number" value="1" step="1" min="0">
                                                        </td>
                                                        <td class="product_remove">
                                                               <a class="product_remove_btn" href="#">×</a>
                                                        </td>
                                                 </tr>
                                                 <tr class="product_main_cart">
                                                        <td class="product_name" >
                                                               <div class="product_name_img" >
                                                                      
                                                                      <a href="https://minimal.crv.vn/product/cotton-t-shirt/">
                                                                             <img src="../image/product/product2/product-detail-1.png" alt="Cart">
                                                                      </a>
                                                               </div>
                                                               <div class="product_name_text">
                                                                      
                                                                      <a class="product_name_link" href="https://minimal.crv.vn/product/cotton-t-shirt/">Cotton T-Shirt</a>
                                                                      <span class="product_name_price"> <del>$9.99</del> $9.99  </span>
                                                               </div>
                                                        </td>
                                                        <td class="product_quantity">
                                                               <span>x 1</span>
                                                        </td>
                                                        <td class="product_remove">
                                                               <a class="product_remove_btn" href="#">×</a>
                                                        </td>
                                                 </tr> -->
                                                 <tr class="product_main_cart">
                                                        <td class="cart_list_btn" colspan="6">
                                                               <!-- <div class="btn_cart">Update cart</div> -->
                                                               <a href="./Shop.php" class="btn_cart">Continue shopping</a>
                                                        </td>
                                                 </tr>
                                          </tbody>
                                   </table>
                            </div>
                            <!-- List trống ẩn thêm class empty_status_off  -->
                            <div class="content_cart_return empty_status_off">
                                   <a href="./HomePage.php" class="btn_cart">Back to shop</a>
                            </div>
                            <!-- List có sp ẩn thêm class have_products_off -->
                            <div class="content_cart_totals">
                                   <h2 class="cart_total_header">Cart totals</h2>
                                   <table cellspacing="0" class="cart_totals_table table_cart">
                                          <tbody>
                                                 <!-- <tr class="table_cart">
                                                               <th class="cart_total_important border_top">Subtotal</th>
                                                               <td class="cart_price border_top">
                                                                      <span>$9.99</span>
                                                               </td>
                                                 </tr> -->
                                                 <tr class="table_cart">
                                                        <th class="cart_total_important border_top">Total</th>
                                                        <td class="cart_price border_top cart_total_important">
                                                               <span id="total-price">$0</span>
                                                        </td>
                                                 </tr>
                                          </tbody>
                                   </table>
                                   <div id="check_out_action" class="check_out_action">
                                          <a href="./Checkout.php" class="check_out_btn">CHECK OUT</a>
                                   </div>
                            </div>
                     </div>
              </div>
       </div>

       <!-- footer -->
       <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>
       <?php require('./footer.php'); ?>
       <script src="../Js/Header.js?v=<?php echo $version ?>"></script>
       <script src="../Js/Cart.js?v=<?php echo $version ?>"></script>
</body>

</html>