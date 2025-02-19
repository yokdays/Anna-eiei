<?php
session_start();
require_once 'config/db.php';
$user_id = $_SESSION['user_login'];

// Check if database connection is established
if (!$conn) {
    die("Database connection failed!");
}

if (isset($_POST['update_cart'])){
    $cart_id = $_POST['cart_id'];
    $cart_id = filter_var($cart_id, FILTER_SANITIZE_NUMBER_INT);
    $qty = $_POST['qty'];
    $qty = filter_var($qty, FILTER_SANITIZE_NUMBER_INT);

    $update_qty = $conn->prepare("UPDATE 'cart' SET qty = ? WHERE id = ?");
    $update_qty->execute([$qty, $cart_id]);

    $success_msg[] = 'cart quantity update successfully';
}
//delete item
if(isset($_POST['delete_item'])){

    $cart_id = $_POST['cart_id'];
    $cart_id = filter_var($cart_id);
    
    $verify_delete_item = $conn->prepare("SELECT * FROM `cart` WHERE id = ?");
    $verify_delete_item->execute([$cart_id]);
 
    if($verify_delete_item->rowCount() > 0){
       $delete_cart_id = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
       $delete_cart_id->execute([$cart_id]);
       $success_msg[] = 'Cart item deleted!';
    }else{
       $warning_msg[] = 'Cart item already deleted!';
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
            <h1>my cart</h1>
        </div>
        <section class="product">
            <h1 class="title">products added in cart</h1>
            <div class="box-container">
            <?php
                $grand_total = 0;
                $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                $select_cart->execute([$user_id]);
                if ($select_cart->rowCount()>0){
                    while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
                        $select_products = $conn->prepare("SELECT * FROM `products` WHERE id=?");
                        $select_products->execute([$fetch_cart['product_id']]);
                        if ($select_products->rowCount()>0){
                            $fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)

                ?>
                <form method="post" action="" class="box">
                    <input type="hidden" name="cart_id" value="<?=$fetch_cart['id'];?>">
                    <img src="image/<?=$fetch_products['image'];?>" class="img">
                    <h3 class="name"><?=$fetch_products['name'];?> </h3>
                    <div class="flex">
                        <p class="price">price $<?=$fetch_products['price'];?>/-</p>
                        <input type="number" name="qty" min="1" value="<?= $fetch_cart?>" max="99" maxlength="2" class="qty">
                        <button type="submit" name="update_cart" class="bx bxs-edit"></button>
                    </div>
                    <p class="sub-total">sub total : <span>$<?=$sup_total = ($fetch_cart['qty'] * $fetch_cart['price']) ?></span></p>
                    <button type="submit" name="delete_item" class="btn" onclick="return confirm('delete this item')">delete</button>
                </form>
                <?php
                            $grand_total += $sup_total;

                            }else{
                                echo '<p class"empty">product was not found</p>';
                            }
                        }
                    }else{
                        echo '<p class="empty">No products added yet!</p>';
                    }
                ?>
            </div>
        </section>
    <?php include 'footer.php'; ?>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="script.js" defer></script>
</body>
</html>