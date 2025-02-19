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
    <title>Contact us page</title>
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="main">
    <div class="banner">
            <h1>contact us</h1>
        </div>
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
            <div class="form-container">
                <form method="post">
                    <div class="title">
                        <img src="img/download.png" class="logo">
                        <h1>leave a messege</h1>
                    </div>
                    <div class="input-field">
                        <p>your name <sup>*</sup></p>
                        <input type="text" name="name">
                    </div>
                    <div class="input-field">
                        <p>your email <sup>*</sup></p>
                        <input type="email" name="email">
                    </div>
                    <div class="input-field">
                        <p>your number <sup>*</sup></p>
                        <input type="text" name="number">
                    </div>
                    <div class="input-field">
                        <p>your messege <sup>*</sup></p>
                        <textarea name="messege"></textarea>
                    </div>
                    <button type="submit" name="submit-btn" class="btn"> send messege</button>
                </form>
            </div>
            <div class="address">
                    <div class="title">
                        <img src="img/download.png" class="logo">
                        <h1>contact detail</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo, aliquam!</p>
                    </div>
                    <div class="box-container">
                        <div class="box">
                            <i class="bx bxs-map-pin"></i>
                            <div>
                                <h4>address</h4>
                                <p>Lorem ipsum dolor sit amet.</p>
                            </div>
                        </div>
                        <div class="box">
                            <i class="bx bxs-phone-call"></i>
                            <div>
                                <h4>phone number</h4>
                                <p>099-999-9999</p>
                            </div>
                        </div>
                        <div class="box">
                            <i class="bx bxs-map-pin"></i>
                            <div>
                                <h4>email</h4>
                                <p>anna.siwaphon@gmail.com</p>
                            </div>
                        </div>
                    </div>
                </div>
        <?php include 'footer.php'; ?>
    </div> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="script.js" defer></script>
</body>
</html>