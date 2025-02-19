<?php

session_start();
require_once 'config/db.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Artshop</title>
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="main">
        <section class="home-section">
            <div class="slider">
                <div class="slider_slider slide1">
                    <div class="overlay"></div>
                    <div class="slide-detail">
                        <h1>Lorem ipsum dolor sit amet.</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis, nulla.</p>
                        <a href="view_products.php" class="btn">shop now</a>
                    </div>
                    <div class="hero-dec-top"></div>
                    <div class="hero-dec-bottom"></div>
                </div>
                <!---slide end--->
                <div class="slider_slider slide2">
                    <div class="overlay"></div>
                    <div class="slide-detail">
                        <h1>welcome to my shop.</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis, nulla.</p>
                        <a href="view_products.php" class="btn">shop now</a>
                    </div>
                    <div class="hero-dec-top"></div>
                    <div class="hero-dec-bottom"></div>
                </div>
                <!---slide end--->
                <div class="slider_slider slide3">
                    <div class="overlay"></div>
                    <div class="slide-detail">
                        <h1>Lorem ipsum dolor sit amet.</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis, nulla.</p>
                        <a href="view_products.php" class="btn">shop now</a>
                    </div>
                    <div class="hero-dec-top"></div>
                    <div class="hero-dec-bottom"></div>
                </div>
                <!---slide end--->
                <div class="slider_slider slide4">
                    <div class="overlay"></div>
                    <div class="slide-detail">
                        <h1>Lorem ipsum dolor sit amet.</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis, nulla.</p>
                        <a href="view_products.php" class="btn">shop now</a>
                    </div>
                    <div class="hero-dec-top"></div>
                    <div class="hero-dec-bottom"></div>
                </div>
                <!---slide end--->
                <div class="slider_slider slide5">
                    <div class="overlay"></div>
                    <div class="slide-detail">
                        <h1>Lorem ipsum dolor sit amet.</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis, nulla.</p>
                        <a href="view_products.php" class="btn">shop now</a>
                    </div>
                    <div class="hero-dec-top"></div>
                    <div class="hero-dec-bottom"></div>
                </div>
                <!---slide end--->
                <div class="left-arrow"><i class="bx bxs-left-arrow"></i></div>
                <div class="right-arrow"><i class="bx bxs-right-arrow"></i></div>
            </div>
        </section>
        <!---home slider end--->
        <section class="thumb">
            <div class="box-container">
                <div class="box">
                    <img src="img/thumb.png">
                    <h3>art commission</h3>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quam, laboriosam.</p>
                    <i class="bx bx-chevron-right"></i>
                </div>
                <div class="box">
                    <img src="img/thumb2.png">
                    <h3>art commission</h3>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quam, laboriosam.</p>
                    <i class="bx bx-chevron-right"></i>
                </div>
                <div class="box">
                    <img src="img/thumb3.png">
                    <h3>art commission</h3>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quam, laboriosam.</p>
                    <i class="bx bx-chevron-right"></i>
                </div>
                <div class="box">
                    <img src="img/thumb4.png">
                    <h3>art commission</h3>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quam, laboriosam.</p>
                    <i class="bx bx-chevron-right"></i>
                </div>
            </div>
        </section>
        <section class="container">
            <div class="box-container">
                <div class="box">
                    <img src="img/about-us.jpg">
                </div>
                <div class="box">
                    <img src="img/download.png">
                    <span>healthy tea</span>
                    <h1>save up to 50% off</h1>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nostrum, ad!</p>
                </div>
            </div>
        </section>
        <section class="shop">
            <div class="title">
                <img src="img/download.png">
                <h1>Trending Products</h1>
            </div>
            <div class="row">
                <img src="img/x_03.jpg">
                <div class="row-detail">
                    <img src="img/x_02.jpg">
                    <div class="top-footer">
                        <h1>Lorem ipsum dolor sit amet.</h1>
                    </div>
                </div>
            </div>
            <div class="box-container">
                <div class="box">
                    <img src="img/p_01.jpg">
                    <a href="view_products.php" class="btn">shop now</a>
                </div>
                <div class="box">
                    <img src="img/p_02.jpg">
                    <a href="view_products.php" class="btn">shop now</a>
                </div>
                <div class="box">
                    <img src="img/p_03.jpg">
                    <a href="view_products.php" class="btn">shop now</a>
                </div>
                <div class="box">
                    <img src="img/p_04.jpg">
                    <a href="view_products.php" class="btn">shop now</a>
                </div>
                <div class="box">
                    <img src="img/p_05.jpg">
                    <a href="view_products.php" class="btn">shop now</a>
                </div>
                <div class="box">
                    <img src="img/p_06.jpg">
                    <a href="view_products.php" class="btn">shop now</a>
                </div>
            </div>
        </section>
        <section class="shop-category">
                <div class="box-container">
                    <div class="box">
                        <img src="img/x_01.jpg">
                        <div class="detail">
                            <span>BIG OFFERS</span>
                            <h1>Extra 15% off</h1>
                            <a href="view_products.php" class="btn">shop now</a>
                        </div>
                    </div>
                    <div class="box">
                        <img src="img/x_01.jpg">
                        <div class="detail">
                            <span>new in taste</span>
                            <h1>Lorem ipsum dolor sit.</h1>
                            <a href="view_products.php" class="btn">shop now</a>
                        </div>
                    </div>
                </div>
            </section>
            <section class="services">
                <div class="box-container">
                    <div class="box">
                        <img src="img/icon2.png">
                        <div class="detail">
                            <h3>great savings</h3>
                            <p>save big every order</p>
                        </div>
                    </div>
                    <div class="box">
                        <img src="img/icon1.png">
                        <div class="detail">
                            <h3>24*7 support</h3>
                            <p>one-on-one support</p>
                        </div>
                    </div>
                    <div class="box">
                        <img src="img/icon0.png">
                        <div class="detail">
                            <h3>gift vouchers</h3>
                            <p>vouchers on every fastivals</p>
                        </div>
                    </div>
                    <div class="box">
                        <img src="img/icon.png">
                        <div class="detail">
                            <h3>worldwide delivery</h3>
                            <p>dropship worldwide</p>
                        </div>
                    </div>
                </div>
            </section>
            <section class="brand">
                <div class="box-container">
                    <div class="box">
                        <img src="img/brand (1).jpg">
                    </div>
                    <div class="box">
                        <img src="img/brand (2).jpg">
                    </div>
                    <div class="box">
                        <img src="img/brand (3).jpg">
                    </div>
                    <div class="box">
                        <img src="img/brand (4).jpg">
                    </div>
                    <div class="box">
                        <img src="img/brand (5).jpg">
                    </div>
                </div>
            </section>
            <?php include 'footer.php'; ?>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="script.js" defer></script>
</body>

</html>