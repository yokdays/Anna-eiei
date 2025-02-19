<?php
session_start();
require_once 'config/db.php';
// Check if database connection is established
if (!$conn) {
    die("Database connection failed!");
}
//adding products in cart
if (isset($_POST['add_to_cart'])) {
    $id = uniqid();
    $product_id = $_POST['product_id'];

    $qty = 1;
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
//delete item
if (isset($_POST['delete item'])) {
    $warning_id = $_POST['wishlist_id'];
    $warning_id = filter_var($wishlist_id, FILTER_SANITIZE_NUMBER_INT);

    $varify_delete_items = $conn->prepare("SELECT * FROM 'wishlist' WHERE id=?");
    $varify_delete_items->execute([$wishlist_id]);

    if ($varify_delete_items->rowCount()>0) {
        $delete_wishlist_id = $conn->prepare("DELETE FROM 'wishlist' WHERE id =?");
        $delete_wishlist_id->execute([$warning_id]);
        $success_msg[] = "wishlist item delete successfully";
    }else{
        $warning_msg[] = 'wishlist item already deleted';
    }
}
//empty_cart
if (isset($_POST['empty_cart'])) {
    $varify_empty_item = $conn->prepare("SELECT * FROM 'cart' WHERE user_id=?");
    $varify_empty_item->execute([$user_id]);

    if ($varify_empty_item->rowCount()) {
        $delete_wishlist_id = $conn->prepare("DELETE FROM 'wishlist' WHERE id =?");
        $delete_wishlist_id->execute([$warning_id]);
        $success_msg[] = "wishlist item delete successfully";
    }else{
        $warning_msg[] = 'wishlist item already deleted';
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
    <title>wishlish Products</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="main">
        <div class="banner">
            <h1>my wishlist</h1>
        </div>
        <section class="product">
            <h1 class="title">products added in wishlist</h1>
            <div class="box-container">
                <?php
                $grand_total = 0;
                $select_wishlist = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
                $select_wishlist->execute([$user_id]);
                if ($select_wishlist->rowCount()>0){
                    while($fetch_wishlist = $select_wishlist->fetch(PDO::FETCH_ASSOC)){
                        $select_products = $conn->prepare("SELECT * FROM `products` WHERE id=?");
                        $select_products->execute([$fetch_wishlist['product_id']]);
                        if ($select_products->rowCount()>0){
                            $fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)

                ?>
                <form method="post" action="" class="box">
                    <input type="hidden" name="wishlist_id" value="<?=$fetch_wishlist['id'];?>">
                    <img src="image/<?=$fetch_products['image'];?>">
                    <div class="button">
                        <button type="submit" name="add_to_cart"><i class="bx bx-cart"></i></button>
                        <a href="view_page.php?pid=<?= $fetch_products['id']; ?>" class="bx bxs-show"></a>
                        <button type="submit" name="delete_item" onclick="return confirm('delete this item');"><i class="bx bx-x"></i></button>
                    </div>
                    <h3 class="name"><?=$fetch_products['name'];?></h3>
                    <input type="hidden" name="product_id" value="<?=$fetch_products['name'];?>">
                    <div class="flex">
                        <p class="price">price $<?=$fetch_products['name'];?></p>
                    </div>
                    <a href="checkout.php?get_id=<?= $fetch_products['id']; ?>" class="btn">Buy Now</a>
                </form>
                <?php
                            $grand_total+=$fetch_wishlist['price'];
                            }
                        }
                    }else{
                        echo '<p class="empty">No products added yet!</p>';
                    }
                ?>
            </div>
            <?php
                if ($grand_total !=0) {
            ?>
            <div class="cart-total">
                <p>total amount payable : <span>$ <?= $grand_total; ?>/-</span></p>
                <div class="button">
                    <form method="post">
                        <button type="submit" name="empty_cart" class="btn" onclick="return confirm('are you sure to empty your cart')">empty cart</button>
                    </form>
                    <a href="checkout.php" class="btn">proceed to checkout</a>
                </div>
            </div>
            <?php } ?>
        </section>
    <?php include 'footer.php'; ?>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="script.js" defer></script>
</body>
</html>