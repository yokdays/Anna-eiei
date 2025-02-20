<?php
session_start();
require_once 'config/db.php';

if (!isset($_SESSION['admin_login'])) {
    $_SESSION['error'] = 'Please login.';
    header('location: signin.php');
}
if (isset($_REQUEST['update_id'])) {
    try {
        $id = $_REQUEST['update_id'];
        $select_stmt = $conn->prepare("SELECT * FROM products WHERE id = :id");
        $select_stmt->bindParam(':id', $id);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
        $title = $row['name'];
        $price = $row['price'];
        $current_image = $row['image'];
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
if (isset($_REQUEST['btn_update'])) {
    $title_up = $_REQUEST['title_up'];
    $price_up = $_REQUEST['price_up'];

    if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
        $image_name = $_FILES['image']['name'];
        $temp = explode('.', $image_name);
        $ext = end($temp);
        $image_name = "product_" . rand(1000, 9999) . "." . $ext;

        $src = $_FILES['image']['tmp_name'];
        $dst = "productimg/" . $image_name;

        if (!move_uploaded_file($src, $dst)) {
            $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
            header('location: addProducts.php');
            exit();
        }
    }

    if (empty($title_up)) {
        $errorMsg = "please enter name";
    } else if (empty($price_up)) {
        $errorMsg = "please enter price";
    } else {
        try {
            if (!isset($errorMsg)) {
                $update_stmt = $conn->prepare("UPDATE products SET name = :title_up, price = :price_up, image = :image_name WHERE id = :id");
                $update_stmt->bindParam(":title_up", $title_up);
                $update_stmt->bindParam(":price_up", $price_up);
                $update_stmt->bindParam(":image_name", $image_name);
                $update_stmt->bindParam(":id", $id);
                if ($update_stmt->execute()) {
                    $updateMsg = "Record Update Successfully";
                    header("refresh:2; admin.php");
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <?php
    if (isset($errorMsg)) {
    ?>
        <div class="alert alert danger">
            <strong>Wrong !<?php echo $errorMsg; ?></strong>
        </div>
    <?php } ?>

    <?php
    if (isset($updateMsg)) {
    ?>
        <div class="alert alert danger">
            <strong>Success !<?php echo $updateMsg; ?></strong>
        </div>
    <?php } ?>
    <?php
    if (isset($_SESSION['add'])) {
        echo $_SESSION['add'];
        unset($_SESSION['add']);
    }
    ?>
    <?php
    if (isset($_SESSION['upload'])) {
        echo $_SESSION['upload'];
        unset($_SESSION['upload']);
    }
    ?>
    <div class="container text-center mt-5">
        <?php if (isset($_SESSION['error'])) { ?>
            <div class="alert alert-danger" role="alert">
                <?php
                echo $_SESSION['error'];
                unset($_SESSION['error']);
                ?>
            </div>
        <?php } ?>
        <?php if (isset($_SESSION['success'])) { ?>
            <div class="alert alert-success" role="alert">
                <?php
                echo $_SESSION['success'];
                unset($_SESSION['success']);
                ?>
            </div>
        <?php } ?>
        <?php if (isset($_SESSION['warning'])) { ?>
            <div class="alert alert-warning" role="alert">
                <?php
                echo $_SESSION['warning'];
                unset($_SESSION['warning']);
                ?>
            </div>
        <?php } ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="table">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title_up" value=<?php echo $title; ?>></td>

                </tr>
                <tr>
                    <td>Price:</td>
                    <td><input type="number" name="price_up" value=<?php echo $price; ?>></td>
                </tr>
                <tr>
                    <td>current_image</td>
                    <td>
                        <?php
                        if ($current_image == "") {
                            echo "<div class='error'>image not available.</div>";
                        } else {
                        ?>
                            <img src="productimg/<?php echo $current_image; ?> " width="100px">
                        <?php
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Select img:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <td>Active</td>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="btn_update" class="btn btn-success" value="Update">
                        <a href="../index.php" class="btn btn-danger">Cancel</a>
                    </td>
                </tr>
            </table>
        </form>
        <?php
        if (isset($_POST['submit'])) {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            $featured = "No";
            if (isset($_POST['active'])) {
                $active = $_POST['active'];
            } else {
                $active = "No";
            }
            if (isset($_FILES['image']['name'])) {
                $image_name = $_FILES['image']['name'];
                if ($image_name != "") {

                    $ext = end(explode('.', $image_name));
                    $image_name = "cofeename" . rand(0000, 9999) . "." . $ext;


                    $src = $_FILES['image']['tmp_name'];

                    $dst = "../images/" . $image_name;

                    $upload = move_uploaded_file($src, $dst);

                    if ($upload == false) {
                        $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
                        header('location: index.php');
                        die();
                    }
                } else {
                    $image_name = "";
                }
            }
            if (empty($title)) {
                $_SESSION['error'] = 'Please enter title.';
                header("location: index.php");
            } else if (empty($price)) {
                $_SESSION['error'] = 'Please enter price.';
                header("location: index.php");
            } else
                try {
                    $select_stmt2 = $conn->prepare("INSERT INTO tbl_coffee(title, description, price, img_name, featured, active) VALUES(:title, :description, :price, :image_name, :featured,:active)");
                    $select_stmt2->bindParam(":title", $title);
                    $select_stmt2->bindParam(":description", $description);
                    $select_stmt2->bindParam(":price", $price);
                    $select_stmt2->bindParam(":image_name", $image_name);
                    $select_stmt2->bindParam(":featured", $featured);
                    $select_stmt2->bindParam(":active", $active);
                    $select_stmt2->execute();


                    if ($select_stmt2 == true) {
                        $_SESSION['add'] = "<div calss='success'>coffee added successfully.</div>";
                        header('location: index.php');
                    } else {
                        $_SESSION['add'] = "<div calss='error'>coffee added failed.</div>";
                        header('location: index.php');
                    }
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
        }

        ?>
    </div>


</body>

</html>