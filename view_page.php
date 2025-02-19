<?php
session_start();
require_once 'config/db.php';
if (isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
}
// Check if database connection is established
if (!$conn) {
    die("Database connection failed!");
}
//adding products in wishlist
if (isset($_POST['add_to_wishlist'])) {
    $id = uniqid();
    $product_id = $_POST['product_id'];

    $varify_wishlist = $conn->prepare("SELECT * FROM 'wishlist' WHERE user_id = ? AND product_id = ?");
    $varify_wishlist->execute([$user_id, $product_id]);

    $cart_num = $conn->prepare("SELECT * FROM 'cart' WHERE user_id = ? AND product_id = ?");
    $cart_num->execute([$user_id, $product_id]);

    if ($varify_wishlist->rowCount() > 0) {
        $warning_msg[] = 'product already exist in your wishlist';
    }else if ($cart_num->rowCount() > 0) {
        $warning_msg[] = 'product already exist in your cart';
    }else{
        $select_price = $conn->prepare("SELECT * FROM 'products' WHERE id = ? LIMIT 1");
        $select_price->execute([$product_id]);
        $fetch_price = $select_price->fetch(PDO::FETCH_ASSOC);

        $insert_wishlist = $conn->prepare("INSERT INTO'wishlist'(id,user_id,product_id,price) VALUES(?,?,?,?)");
        $insert_wishlist->execute([$id, $user_id, $product_id, $fetch_price['price']]);
        $success_msg[] = 'product added to wishlist successfully';
    }
}
//adding products in cart
if (isset($_POST['add_to_cart'])) {
    $id = uniqid();
    $product_id = $_POST['product_id'];

    $qty = $_POST['qty'];
    $qty = filter_var($qty, FILTER_SANITIZE_NUMBER_INT);

    $varify_num = $conn->prepare("SELECT * FROM 'cart' WHERE user_id = ? AND product_id = ?");
    $varify_num->execute([$user_id, $product_id]);

    $max_cart_item = $conn->prepare("SELECT * FROM 'cart' WHERE user_id = ?");
    $max_cart_item->execute([$user_id]);

    if ($varify_cart->rowCount() > 0) {
        $warning_msg[] = 'product already exist in your wishlist';
    }else if ($max_cart_item->rowCount() > 20) {
        $warning_msg[] = 'cart is full';
    }else{
        $select_price = $conn->prepare("SELECT * FROM 'products' WHERE id = ? LIMIT 1");
        $select_price->execute([$product_id]);
        $fetch_price = $select_price->fetch(PDO::FETCH_ASSOC);

        $insert_cart = $conn->prepare("INSERT INTO'cart'(id,user_id,product_id,price) VALUES(?,?,?,?)");
        $insert_cart->execute([$id, $user_id, $product_id, $fetch_price['price']]);
        $success_msg[] = 'product added to cart successfully';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="stylesheet" href="style.css">
    <title>View Products</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="main">
        <div class="banner">
            <h1>Product detail</h1>
        </div>
        <section class="view_page">
            <?php
                if (isset($_GET['pid'])) {
                    $pid = $_GET['pid'];
                    $select_products = $conn->prepare("SELECT *FROM 'products' WHERE id = '$pis'");
                    $select_products->execute();
                    if ($select_products->rowCount()>0) {
                        while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
            ?>
            <form method="post">
                <img src="image/<?php echo $fetch_products['image']; ?>">
                <div class="deail">
                    <div class="price">$<?php echo $fetch_products['price']; ?>/-</div>
                    <div class="name"><?php echo $fetch_products['name']; ?></div>
                    <div class="detail">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi fuga, aperiam possimus veritatis laboriosam perspiciatis et modi molestias eligendi dolores!</p>
                    </div>
                    <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
                    <div class="button">
                        <button type="submit" name="add_to_wishlist" class="btn">add to wishlish <i class="bx bx-heart"></i></button>
                        <input type="hidden" name="qty" value="1" min="0" class="quantity">
                        <button type="submit" name="add_to_cart" class="btn">add to cart <i class="bx bx-cart"></i></button>
                    </div>
                </div>
            </form>
            <?php
                        }
                    }
                }
            ?>
        </section>
    <?php include 'footer.php'; ?>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="script.js" defer></script>
</body>
</html>