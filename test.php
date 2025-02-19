<?php

include 'config/db.php';
if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    setcookie('user_id');
}
?>

<?php
    $user_id = $_SESSION['user_login'];
    $sql = $conn->prepare("SELECT * FROM users WHERE id = :user_id LIMIT 1");
    $sql->bindParam(":user_id", $user_id);
    $sql->execute();
    $row = $sql->fetch(PDO::FETCH_ASSOC)
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
                <?php
                    $count_wishlist_item = $conn->prepare("SELECT *FROM 'wishlish' WHERE user_id = ?");
                    $count_wishlist_item->execute([$user_id]);
                    $total_wishlist_item = $count_wishlist_item->rowCount()
                ?>
                <a href="wishlist.php" class="cart-btn"><i class="bx bx-heart"></i><sup>
                        <p class="nav-info"><?=$total_wishlist_item?></p>
                    </sup></a>
                <?php
                    $count_cart_item = $conn->prepare("SELECT *FROM 'wishlish' WHERE user_id = ?");
                    $count_cart_item->execute([$user_id]);
                    $count_cart_item = $count_cart_item->rowCount()
                ?>
                <a href="cart.php" class="cart-btn"><i class="bx bx-cart-download"></i><sup>
                        <p class="nav-info"><?=$total_cart_item?></p>
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