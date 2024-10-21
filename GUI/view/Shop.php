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
    <style>
        <?php require('../css/Header.css');
        require('../css/Footer.css');

        require('../css/shop.css');
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
                <a href="#!">Shop</a>

            </div>
        </div>
        <div class="container">

            <div class="container-path">
                <div class="row">

                    <!-- sidebar trai -->
                    <div class="search-categories">
                        <div class="sidebar_page sidebar_product">
                            <h3 class="title_widget">
                                <span>Category product</span>
                            </h3>
                            <!-- Category product -->
                            <div class="filter-Category">
                                <div id="filter-gender">
                                    <h3 class="title_widget">
                                        <span>Gender</span>
                                    </h3>
                                    <ul class="cate-list unstyled">
                                        <li>
                                            <input type="radio" name="gender"> Male
                                        </li>
                                        <li>
                                            <input type="radio" name="gender"> Female
                                        </li>
                                    </ul>
                                </div>
                                <div id="filter-color">
                                    <h3 class="title_widget">
                                        <span>Color</span>
                                    </h3>
                                    <ul class="cate-list unstyled">
                                        <li>
                                            <input type="radio" name="gender"> Male
                                        </li>
                                        <li>
                                            <input type="radio" name="gender"> Female
                                        </li>
                                    </ul>
                                </div>
                                <div id="filter-bagMaterial">
                                    <h3 class="title_widget">
                                        <span>Material Handbag</span>
                                    </h3>
                                    <ul class="cate-list unstyled">
                                        <li>
                                            <input type="radio" name="gender"> Male
                                        </li>
                                        <li>
                                            <input type="radio" name="gender"> Female
                                        </li>
                                    </ul>
                                </div>
                                <div id="filter-shirtMaterial">
                                    <h3 class="title_widget">
                                        <span>Material Shirt</span>
                                    </h3>
                                    <ul class="cate-list unstyled">
                                        <li>
                                            <input type="radio" name="gender"> Male
                                        </li>
                                        <li>
                                            <input type="radio" name="gender"> Female
                                        </li>
                                    </ul>
                                </div>
                                <div id="filter-shirtStyle">
                                    <h3 class="title_widget">
                                        <span>Shirt Style</span>
                                    </h3>
                                    <ul class="cate-list unstyled">
                                        <li>
                                            <input type="radio" name="gender"> Male
                                        </li>
                                        <li>
                                            <input type="radio" name="gender"> Female
                                        </li>
                                    </ul>
                                </div>
                                <!-- <div>
                                    
                                    <div class="filter-price">
                                        <h3 class="title_widget">
                                            <span>Price</span>
                                        </h3>
                                    </div>
                                    <div id="slider-range"></div>
                                    <div><input type="range" min="0" max="100" value="50"></div>
                                    <div class="btn-filter-showprice">
                                        
                                        <div id="price-display"> <span>Price:</span> $0 - $540</div>
                                        
                                    </div>
                                </div> -->
                                <div id="filter-price">
                                    <h3 class="title_widget">
                                        <span>PRICE</span>
                                    </h3>
                                    <ul class="cate-list unstyled">
                                        <li>
                                            <input style="width: 200px;" type="range" min="0" max="100" value="100" step="1">
                                        </li>
                                        <li>
                                            <span id="show-price">0$ - 100$</span>
                                        </li>

                                    </ul>
                                </div>
                                <div>
                                    <button id="filter-button" class="filter-button">Filter</button>
                                    <button id="reset-filter-button" class="filter-button">Reset</button>
                                </div>


                            </div>


                            <!-- <div class="filter-price">
                                <h3 class="title_widget">
                                    <span>Price</span>
                                </h3>
                                <form method="get" action="https://minimal.crv.vn/shop/">
                                    <div class="price_slider_wrapper">
                                        <div class="price_slider ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                            style>
                                            <div class="ui-slider-range ui-corner-all ui-widget-header"
                                                style="left: 0%; width: 100%;"></div>
                                            <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"
                                                style="left: 0%;">
                                            </span>
                                            <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"
                                                style="left: 100%;">
                                            </span>
                                        </div>
                                        <div class="price_slider_amount" data-step="10">
                                            <label class="screen-reader-text" for="min_price">Min price</label>
                                            <input type="text" id="min_price" name="min_price" value="0" data-min="0"
                                                placeholder="Min price" style="display: none;">
                                            <label class="screen-reader-text" for="max_price">Max price</label>
                                            <input type="text" id="max_price" name="max_price" value="540"
                                                data-max="540" placeholder="Max price" style="display: none;">
                                            <button type="submit" class="button" fdprocessedid="zoeoh8">Filter</button>
                                            <div class="price_label" style>
                                                Price: <span class="from">$0</span> — <span class="to">$540</span>
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                    </div>
                                </form>
                            </div> -->
                            <!--Color-->
                            <div class="filter-color">

                                <!-- <div id="woocommerce_layered_nav-3" class="visible-all-devices widget">
                                    <h3 class="title_widget"><span>Color</span></h3>
                                    <ul class="woocommerce-widget-layered-nav-list">
                                        <li class="woocommerce-widget-layered-nav-list__item wc-layered-nav-term "><a rel="nofollow" class="sub-cate-title" href="https://minimal.crv.vn/shop/?filter_color=black">Black</a> </li>
                                        <li class="woocommerce-widget-layered-nav-list__item wc-layered-nav-term "><a rel="nofollow" class="sub-cate-title" href="https://minimal.crv.vn/shop/?filter_color=blue">Blue</a> </li>
                                        <li class="woocommerce-widget-layered-nav-list__item wc-layered-nav-term "><a rel="nofollow" class="sub-cate-title" href="https://minimal.crv.vn/shop/?filter_color=brown">Brown</a> </li>
                                        <li class="woocommerce-widget-layered-nav-list__item wc-layered-nav-term "><a rel="nofollow" class="sub-cate-title" href="https://minimal.crv.vn/shop/?filter_color=green">Green</a> </li>
                                        <li class="woocommerce-widget-layered-nav-list__item wc-layered-nav-term "><a rel="nofollow" class="sub-cate-title" href="https://minimal.crv.vn/shop/?filter_color=khaki-green">Khaki
                                                green</a>

                                        </li>
                                        <li class="woocommerce-widget-layered-nav-list__item wc-layered-nav-term "><a rel="nofollow" class="sub-cate-title" href="https://minimal.crv.vn/shop/?filter_color=orange">Orange</a> </li>
                                        <li class="woocommerce-widget-layered-nav-list__item wc-layered-nav-term "><a rel="nofollow" class="sub-cate-title" href="https://minimal.crv.vn/shop/?filter_color=yellow">Yellow</a> </li>
                                    </ul>
                                </div> -->
                            </div>
                            <!--brand-->
                            <div class="filter-brands">
                                <!-- <div id="woocommerce_layered_nav-2" class="visible-all-devices widget">
                                    <h3 class="title_widget"><span>Brands</span></h3>
                                    <ul class="woocommerce-widget-layered-nav-list">
                                        <li class="woocommerce-widget-layered-nav-list__item wc-layered-nav-term "><a rel="nofollow" class="sub-cate-title" href="https://minimal.crv.vn/shop/?filter_brands=calvin-klein">Calvin
                                                Klein</a> </li>
                                        <li class="woocommerce-widget-layered-nav-list__item wc-layered-nav-term "><a rel="nofollow" class="sub-cate-title" href="https://minimal.crv.vn/shop/?filter_brands=columbia">Columbia</a>

                                        </li>
                                        <li class="woocommerce-widget-layered-nav-list__item wc-layered-nav-term "><a rel="nofollow" class="sub-cate-title" href="https://minimal.crv.vn/shop/?filter_brands=haute-hippie">Haute
                                                Hippie</a> </li>
                                    </ul>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="content-page">
                        <!-- lọc sản phẩm đầu trang -->
                        <div class="left-right-result">
                            <!--show result-->
                            <div class="l_filter">
                                <p id="number-product-show" class="woocommerce-result-count">Show 1–12 of 19 result</p>
                            </div>
                            <!--sort by...-->
                            <div class="r_filter">
                                <form class="woocommerce-ordering" method="get">
                                    <select id="sort-price" name="orderby" class="orderby" fdprocessedid="037fbn">
                                        <!-- <option value="popularity">Sort by popularity</option> -->
                                        <!-- <option value="rating">Sort by average rating</option> -->
                                        <option value="" selected="selected">Select --</option>
                                        <option value="ASC">Sort by price: low to high</option>
                                        <option value="DESC">Sort by price: high to low</option>
                                    </select>
                                </form>
                            </div>
                        </div>
                        <!-- chứa list sản phẩm -->
                        <div class="row list-product">
                            <div class="product-list">

                                <div style="margin: 30% auto;" class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>

                                <!--Chứa 1 sản phẩm-->
                                <!-- <div class="product-container">
                                    
                                    <div class="image">
                                        <a href="" class="">
                                            <img src="../image/product/product1/product-detail-1.png" alt="">
                                        </a>
                                        
                                        <div class="action-custom">
                                            
                                            <div class="add-to-cart">
                                                <a href="" class="" title="add cart">
                                                    <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                            
                                            <div class="readmore">
                                                <a href="" title="Detail">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="product-meta">
                                        <div class="name">
                                            <a href="">Super-soft wrap jumpsuit</a>
                                        </div>

                                    </div>
                                    
                                    <div class="price">
                                        <div itemprop="offers" class="pricelist"></div>
                                        <ins class="giamoi"><span class="price-sale">$22.00</span> $14.99</ins>
                                    </div>
                                </div> -->


                            </div>
                        </div>
                        <!--chuyển trang sản phẩm 1->2 -->
                        <div class="list-page">
                            <div class="item-active">
                                1
                            </div>
                            ...
                            <div>
                                2
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
    <script src="../Js/shop.js?v=<?php echo $version ?>"></script>
    <script src="../Js/pricesidebar.js?v=<?php echo $version ?>"></script>
</body>

</html>