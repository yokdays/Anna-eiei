<?php

include 'config/db.php';

?>

<?php
    $user_id = $_SESSION['user_login'];
    $sql = $conn->prepare("SELECT * FROM users WHERE id = :user_id LIMIT 1");
    $sql->bindParam(":user_id", $user_id);
    $sql->execute();
    $row = $sql->fetch(PDO::FETCH_ASSOC);

    $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
    $select_cart->execute([$user_id]);
    $total_cart_items = $select_cart ->rowCount();

    $select_wishlist = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
    $select_wishlist->execute([$user_id]);
    $total_wishlist_items = $select_wishlist ->rowCount();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <title>HEADER</title>
</head>

<body>
    <header class="header">
        <div class="flex">
            <a href="home.php" class="logo"><img src="img/logo2.png"></a>
            <nav class="navbar">

                <h1></h1>
                <a href="home.php">Home</a>
                <a href="view_products.php">Products</a>
                <a href="order.php">Orders</a>
                <a href="about.php">About us</a>
                <a href="contact.php">Contact us</a>
            </nav>
            <div class="icons">
                <i class="bx bxs-user" id="user-btn"></i>
                <a href="wishlist.php" class="cart-btn"><i class="bx bx-heart"></i><sup>
                        <p class="nav-info"><?= $total_wishlist_items; ?></p>
                    </sup></a>
                <a href="cart.php" class="cart-btn"><i class="bx bx-cart-download"></i><sup>
                        <p class="nav-info"><?= $total_cart_items; ?></p>
                    </sup></a>
                <i class="bx bx-list-plus" id="menu-btn" style="font-size: 2rem;"></i>
            </div>
            <div class="user-box">
                <p>username : <span><?= $row['firstname']; ?></span></p>
                <p>Email : <span><?= $row['email']; ?></span></p>
                <a href="signin.php" class="btn">Login</a>
                <a href="index.php" class="btn">register</a>
                <a href="logout.php" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </header>
</body>

</html>