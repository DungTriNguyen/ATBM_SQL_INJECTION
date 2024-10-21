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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../image/logo-sgu.png" type="image/x-icon">
    <style>
        <?php
        require('../css/Header.css');
        require('../css/Footer.css');
        require('../css/ProductDetail.css');
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
                <div class="container"><a href="#!">Home</a>
                    /
                    <a href="#!">Woment</a>
                    /
                    <a href="#!">Jumpsuits</a>
                    /
                    <a href="#!">Super-soft wrap jumpsuit</a>
                </div>
            </div>

            <div class="main-content">
                <div class="container">
                    <div class="img-product">
                        <div class="show-img">
                            <img src="../image/product/product1/product-detail-1.png" alt="">
                        </div>
                        <div class="list-img">
                            <img src="../image/product/product1/product-detail-1.png" alt="" class="opacity">
                            <img src="../image/product/product1/product-detail-2.png" alt="">
                            <img src="../image/product/product1/product-detail-3.png" alt="">
                            <img src="../image/product/product1/product-detail-4.png" alt="">
                        </div>
                    </div>
                    <div class="action-img disappear">
                        <p><span class="current-img">3</span>/<span class="total-img">5</span> </p>
                        <i class="fas fa-arrow-left"></i>
                        <i class="fas fa-arrow-right"></i>
                        <i class="fas fa-times"></i>
                        <i class="fas fa-expand" id="fullscreen"></i>
                        <i class="fas fa-compress disappear" id="exitfullscreen"></i>
                        <img src="../image/product/product1/product-detail-1.png" alt="">
                    </div>
                    <div class="desc-product">
                        <h2 class="name-product">Super-soft wrap jumpsuit</h2>
                        <div class="price">$39.99</div>
                        <h3>Composition</h3>
                        <p class="composition">Modal 72%, Polyester 28%</p>
                        <h3 class="style-title">Style</h3>
                        <p class="sytle">T-Shirt</p>
                        <h3>Additional material information</h3>
                        <p class="descriptionMaterial">The total weight of this product contains: <br> <br>
                            28% Recycled polyester <br> <br>
                            We exclude the weight of minor components such as, but not exclusively: threads, buttons, zippers, embellishments and prints.<br>
                            <br>
                            The total weight of the product is calculated by adding the weight of all layers and main components together. Based on that, we calculate how much of that weight is made out by each material. For sets & multipacks all pieces are counted together as one product in calculations.
                        </p>
                        <!-- <h3>Materials in this product explained</h3>
                        <p>ModalModal is a regenerated cellulose fibre commonly made from wood, but the raw material could also consist of other cellulosic materials.
                            PolyesterPolyester is a synthetic fibre made from crude oil (a fossil resource). <br>
                            Recycled polyesterRecycled polyester is polyester made from PET bottles or end-of-life textile waste. The PET bottles or textile waste is mechanically recycled and processed into new yarn.</p> -->
                        <div class="add-to-cart">
                            <div class="quantity">
                                <label>Quantity</label>
                                <input id="quantityBuy" type="number" step="1" min="1" max="10" name="quantity" value="1" size="4" pattern="[0-9]*" inputmode="numeric">

                                <div style="margin-top:10px;">(Quantity left in store: 10)</div>
                            </div>
                            <button id='cart'>
                                <a href="">add to cart</a>
                            </button>
                        </div>

                        <div class="share-link">
                            <label>Share</label>
                            <ul>
                                <li>
                                    <a href="#!"><i class="fab fa-facebook-f"></i></a>
                                </li>
                                <li>
                                    <a href="#!"><i class="fab fa-google-plus-g"></i></a>
                                </li>
                                <li>
                                    <a href="#!"><i class="fab fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#!"><i class="fab fa-pinterest-p"></i></a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="container">
                    <div class="desc-and-review">
                        <div class="title">
                            <h4 class="desc selected">description</h4>
                            <h4 id="rev" class="rev">reviews</h4>
                        </div>
                        <hr>
                        <div class="container-des-re">
                            <div class="content-desc">
                                <h3>Description</h3>
                                <p class="description">A super-soft jumpsuit with adjustable spaghetti straps, an elasticated waist, and hidden pockets. Super-soft material. Wrap front. Wide leg. Cropped length. Elastic waist. Adjustable shoulder straps. In a size S the inseam is 54 cm.</p>
                                <!-- <p>Size: The model is 175cm/5’9″ and wears a size S</p>
                                <p>Length: Ankle length</p>
                                <p>Sleeve Length: Sleeveless</p>
                                <p>Fit: Regular fit</p>
                                <p>Style: Draped, Wide, Wrapover</p>
                                <p>Neckline: V-neck</p>
                                <p>Description: Burgundy, Solid colour</p> -->
                            </div>
                            <div class="content-rev hiddenP">
                                <h3 id="count-review">Review</h3>
                                <div style="height: 220px; overflow-y: auto; scrollbar-width: thin;" id="review" class="review">
                                    <div class="item-review-container">
                                        <div class="item-review">
                                            <img src="../image/avt-review/male.png" alt="" class="avt">
                                            <div class="main-review">
                                                <div class="content-review">
                                                    <p class="name-user">Tran Tien Phat - 20/10/2020</p>
                                                    <div class="text-review">
                                                        <p>Sản phẩm tốt chất lượng đúng vs mô tả. Giao hàng nhanh chóng đóng gói kĩ lưỡng Sản phẩm tốt chất lượng đúng vs mô tả. Giao hàng nhanh chóng đóng gói kĩ lưỡng Sản phẩm tốt chất lượng đúng vs mô tả. Giao hàng nhanh chóng đóng gói kĩ lưỡng Sản phẩm tốt chất lượng đúng vs mô tả. Giao hàng nhanh chóng đóng gói kĩ lưỡng Sản phẩm tốt chất lượng đúng vs mô tả. Giao hàng nhanh chóng đóng gói kĩ lưỡng Sản phẩm tốt chất lượng đúng vs mô tả. Giao hàng nhanh chóng đóng gói kĩ lưỡng</p>
                                                    </div>
                                                </div>
                                                <div class="behavior">
                                                    <div>
                                                        <i class="fa-solid fa-thumbs-up"></i>
                                                        <span>10</span>
                                                    </div>
                                                    <div>
                                                        <i class="fa-solid fa-thumbs-down"></i>
                                                        <span>3</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="item-review-container">
                                        <div class="item-review">
                                            <img src="../image/avt-review/male.png" alt="" class="avt">
                                            <div class="main-review">
                                                <div class="content-review">
                                                    <p class="name-user">Tran Tien Phat</p>
                                                    <div class="text-review">
                                                        <p>Sản phẩm tốt chất lượng đúng vs mô tả. Giao hàng nhanh chóng đóng gói kĩ lưỡng Sản phẩm tốt chất lượng đúng vs mô tả. Giao hàng nhanh chóng đóng gói kĩ lưỡng Sản phẩm tốt chất lượng đúng vs mô tả. Giao hàng nhanh chóng đóng gói kĩ lưỡng Sản phẩm tốt chất lượng đúng vs mô tả. Giao hàng nhanh chóng đóng gói kĩ lưỡng Sản phẩm tốt chất lượng đúng vs mô tả. Giao hàng nhanh chóng đóng gói kĩ lưỡng Sản phẩm tốt chất lượng đúng vs mô tả. Giao hàng nhanh chóng đóng gói kĩ lưỡng</p>
                                                    </div>
                                                </div>
                                                <div class="behavior">
                                                    <div>
                                                        <i class="fa-solid fa-thumbs-up"></i>
                                                        <span>10</span>
                                                    </div>
                                                    <div>
                                                        <i class="fa-solid fa-thumbs-down"></i>
                                                        <span>3</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="item-review-container">
                                        <div class="item-review">
                                            <img src="../image/avt-review/female.png" alt="" class="avt">
                                            <div class="main-review">
                                                <div class="content-review">
                                                    <p class="name-user">Tran Tien Phat</p>
                                                    <div class="text-review">
                                                        <p>Sản phẩm tốt chất lượng đúng vs mô tả. Giao hàng nhanh chóng đóng gói kĩ lưỡng Sản phẩm tốt chất lượng đúng vs mô tả. Giao hàng nhanh chóng đóng gói kĩ lưỡng Sản phẩm tốt chất lượng đúng vs mô tả. Giao hàng nhanh chóng đóng gói kĩ lưỡng Sản phẩm tốt chất lượng đúng vs mô tả. Giao hàng nhanh chóng đóng gói kĩ lưỡng Sản phẩm tốt chất lượng đúng vs mô tả. Giao hàng nhanh chóng đóng gói kĩ lưỡng Sản phẩm tốt chất lượng đúng vs mô tả. Giao hàng nhanh chóng đóng gói kĩ lưỡng</p>
                                                    </div>
                                                </div>
                                                <div class="behavior">
                                                    <div>
                                                        <i class="fa-solid fa-thumbs-up"></i>
                                                        <span>10</span>
                                                    </div>
                                                    <div>
                                                        <i class="fa-solid fa-thumbs-down"></i>
                                                        <span>3</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="item-review-container">
                                        <div class="item-review">
                                            <img src="../image/avt-review/male.png" alt="" class="avt">
                                            <div class="main-review">
                                                <div class="content-review">
                                                    <p class="name-user">Tran Tien Phat</p>
                                                    <div class="text-review">
                                                        <p>Sản phẩm tốt chất lượng đúng vs mô tả. Giao hàng nhanh chóng đóng gói kĩ lưỡng Sản phẩm tốt chất lượng đúng vs mô tả. Giao hàng nhanh chóng đóng gói kĩ lưỡng Sản phẩm tốt chất lượng đúng vs mô tả. Giao hàng nhanh chóng đóng gói kĩ lưỡng Sản phẩm tốt chất lượng đúng vs mô tả. Giao hàng nhanh chóng đóng gói kĩ lưỡng Sản phẩm tốt chất lượng đúng vs mô tả. Giao hàng nhanh chóng đóng gói kĩ lưỡng Sản phẩm tốt chất lượng đúng vs mô tả. Giao hàng nhanh chóng đóng gói kĩ lưỡng</p>
                                                    </div>
                                                </div>
                                                <div class="behavior">
                                                    <div>
                                                        <i class="fa-solid fa-thumbs-up"></i>
                                                        <span>10</span>
                                                    </div>
                                                    <div>
                                                        <i class="fa-solid fa-thumbs-down"></i>
                                                        <span>3</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                                <!-- <div class="read-more hide-readmore ">
                                    <span style="cursor: pointer;">Read More</span>
                                </div> -->
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="related-product">
                        <h3>Related products</h3>
                        <div class="list-item-related">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <!-- <div class="item-product">
                                <a href="">
                                    <div class="img-product-related">
                                        <img src="../image/product/product1/product-detail-1.png" alt="">
                                        <p>Sale!</p>
                                    </div>
                                    <p class="title-product">Suspendisse na pretium 2</p>
                                    <p class="price-product"><span class="sale-price">$22.00</span> $14.99</p>
                                </a>
                                <a href="#!" class="add-product">Add to cart</a>
                            </div>
                            <div class="item-product">
                                <div class="img-product-related">
                                    <img src="../image/product/product1/product-detail-1.png" alt="">
                                    <p>Sale!</p>
                                </div>
                                <p class="title-product">Suspendisse na pretium 2</p>
                                <p class="price-product"><span class="sale-price">$22.00</span> $14.99</p>
                                <a href="#!" class="add-product">Add to cart</a>
                            </div>
                            <div class="item-product">
                                <div class="img-product-related">
                                    <img src="../image/product/product1/product-detail-1.png" alt="">
                                    <p>Sale!</p>
                                </div>
                                <p class="title-product">Suspendisse na pretium 2</p>
                                <p class="price-product"><span class="sale-price">$22.00</span> $14.99</p>
                                <a href="#!" class="add-product">Add to cart</a>
                            </div>
                            <div class="item-product">
                                <div class="img-product-related">
                                    <img src="../image/product/product1/product-detail-1.png" alt="">
                                    <p>Sale!</p>
                                </div>
                                <p class="title-product">Suspendisse na pretium 2</p>
                                <p class="price-product"> $14.99</p>
                                <a href="#!" class="add-product">Add to cart</a>
                            </div>
                            <div class="item-product">
                                <div class="img-product-related">
                                    <img src="../image/product/product1/product-detail-1.png" alt="">
                                    <p>Sale!</p>
                                </div>
                                <p class="title-product">Suspendisse na pretium 2</p>
                                <p class="price-product"><span class="sale-price">$22.00</span> $14.99</p>
                                <a href="#!" class="add-product">Add to cart</a>
                            </div>
                            <div class="item-product">
                                <div class="img-product-related">
                                    <img src="../image/product/product1/product-detail-1.png" alt="">
                                    <p>Sale!</p>
                                </div>
                                <p class="title-product">Suspendisse na pretium 2</p>
                                <p class="price-product"><span class="sale-price">$22.00</span> $14.99</p>
                                <a href="#!" class="add-product">Add to cart</a>
                            </div>
                            <div class="item-product">
                                <div class="img-product-related">
                                    <img src="../image/product/product1/product-detail-1.png" alt="">
                                    <p>Sale!</p>
                                </div>
                                <p class="title-product">Suspendisse na pretium 2</p>
                                <p class="price-product"><span class="sale-price">$22.00</span> $14.99</p>
                                <a href="#!" class="add-product">Add to cart</a>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- footer -->
    <?php require('./footer.php'); ?>

    <script src="../Js/Header.js?v=<?php echo $version ?>"></script>
    <script src="../Js/ProductDetail.js?v=<?php echo $version ?>"></script>
</body>

</html>