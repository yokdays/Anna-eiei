<?php

session_start();
require_once 'config/db.php';
if (!isset($_SESSION['admin_login'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
    header('location: signin.php');
}

?>

<?php

if (isset($_SESSION['admin_login'])) {
    $admin_id = $_SESSION['admin_login'];
    $stmt = $conn->query("SELECT * FROM users WHERE id = $admin_id");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h3 class="mt-4">Welcome Admin, <?php echo $row['firstname'] . ' ' . $row['lastname'] ?></h3>
        <a href="logout.php" class="btn btn-danger">Logout</a>
        <div>
            <h2>Product Items</h2>
            <table class="table ">
                <thead>
                    <tr class="text-center">
                        <th>S.N.</th>
                        <th>Product Image</th>
                        <th>Product Name</th>
                        <th>Unit Price</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <?php
                $select_stmt = $conn->prepare("SELECT * FROM products");
                $select_stmt->execute();
                $count = 1;

                if ($select_stmt->rowCount() > 0) {
                    while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
                        $id = $row['id'];
                        $name = $row['name'];
                        $price = $row['price'];
                        $image_name = $row['image'];
                ?>
                        <tr>
                            <td><?= $count ?></td>
                            <td>
                                <?php
                                if ($image_name == "") {
                                    echo "<div class='error'>image not added.</div>";
                                } else {
                                ?>
                                    <img src="productimg/<?php echo $image_name; ?> " height="40px" width="40">
                                <?php
                                }
                                ?>
                            </td>
                            <td><?php echo $name ?></td>
                            <td><?php echo $price ?></td>
                            <td><a href="updateProduct.php?update_id=<?php echo $row["id"];?>" class="btn btn-warning">Edit </a> <a href="deleteProduct.php?delete_id=<?php echo $row["id"];?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                <?php
                        $count = $count + 1;
                    }
                }
                ?>
            </table>
            <a href="addProducts.php" class="btn btn-secondary " style="height:40px">Add Product</a>




        </div>
</body>

</html>