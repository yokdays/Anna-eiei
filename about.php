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
    <title>Artshop - about us page</title>
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="main">
        <div class="banner">
            <h1>about us</h1>
        </div>
        <div class="about-category">
            <div class="box">
                <img src="img/3.webp">
                <div class="detail">
                    <span>Art</span>
                    <h1>commission</h1>
                    <a href="view_products.php" class="btn">shop now</a>
                </div>
            </div>
            <div class="box">
                <img src="img/about.png">
                <div class="detail">
                    <span>Art</span>
                    <h1>commission</h1>
                    <a href="view_products.php" class="btn">shop now</a>
                </div>
            </div>
            <div class="box">
                <img src="img/2.webp">
                <div class="detail">
                    <span>Art</span>
                    <h1>commission</h1>
                    <a href="view_products.php" class="btn">shop now</a>
                </div>
            </div>
            <div class="box">
                <img src="img/1.webp">
                <div class="detail">
                    <span>Art</span>
                    <h1>commission</h1>
                    <a href="view_products.php" class="btn">shop now</a>
                </div>
            </div>
        </div>
        <section class="services">
            <div class="title">
                <img src="img/download.png" class="logo">
            </div>
            <h1>why choose us</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet, dolorem?</p>
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
            <div class="about">
                <div class="row">
                    <div class="img-box">
                        <img src="img/3.png">
                    </div>
                    <div class="detail">
                        <h1>visit our beautiful showroom!</h1>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Corporis mollitia dolore voluptatibus nisi quis laborum corrupti id obcaecati ullam odio!</p>
                        <a href="view_products.php" class="btn">shop now</a>
                    </div>
                </div>
            </div>
            <div class="testimonial-container">
                <div class="title">
                    <img src="img/download.png" class="logo">
                    <h1>what people say about us</h1>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Asperiores, recusandae.</p>
                    
                </div>
                <div class="container">
                        <div class="testimonial-item active">
                            <img src="img/01.jpg">
                            <h1>sara smith</h1>
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Fugiat aut iusto unde aliquid, suscipit alias, laudantium eius rerum amet at et in dicta mollitia optio necessitatibus exercitationem ex? Dignissimos, blanditiis!</p>
                        </div>
                        <div class="testimonial-item">
                            <img src="img/02.jpg">
                            <h1>john smith</h1>
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Fugiat aut iusto unde aliquid, suscipit alias, laudantium eius rerum amet at et in dicta mollitia optio necessitatibus exercitationem ex? Dignissimos, blanditiis!</p>
                        </div>
                        <div class="testimonial-item">
                            <img src="img/03.jpg">
                            <h1>selena smith</h1>
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Fugiat aut iusto unde aliquid, suscipit alias, laudantium eius rerum amet at et in dicta mollitia optio necessitatibus exercitationem ex? Dignissimos, blanditiis!</p>
                        </div>
                        <div class="left-arrow" onclick="nextSlide()"><i class="bx bxs-left-arrow-alt"></i></div>
                        <div class="right-arrow" onclick="prevSlide()"><i class="bx bxs-right-arrow-alt"></i></div>
                </div>
            </div>
            <?php include 'footer.php'; ?>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="script.js" defer></script>
    <script type="text/javascript">
        let slides = document.querySelectorAll('.testimonial-item');
        let index = 0;

        function nextSlide(){
            slides[index].classList.remove('active');
            index = (index + 1) % slides.length;
            slides[index].classList.add('active');
        }
        function prevSlide(){
            slides[index].classList.remove('active');
            index = (index - 1 + slides.length) % slides.length;
            slides[index].classList.add('active');
        }
    </script>
</body>

</html>