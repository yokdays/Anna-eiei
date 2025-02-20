<?php
session_start();
require_once 'config/db.php';

if (!isset($_SESSION['admin_login'])) {
    $_SESSION['error'] = 'Please login.';
    header('location: signin.php');
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
        <?php if (isset($_SESSION['add'])) { ?>
            <div class="alert alert-success" role="alert">
                <?php
                echo $_SESSION['add'];
                unset($_SESSION['add']);
                ?>
            </div>

            
        <?php } ?>
        <?php if (isset($_SESSION['upload'])) { ?>
            <div class="alert alert-success" role="alert">
                <?php
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
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
                    <td>Name:</td>
                    <td><input type="text" name="title" placeholder="title"></td>

                </tr>
                <tr>
                    <td>Price:</td>
                    <td><input type="number" name="price" placeholder="Price"></td>
                </tr>
                <tr>
                    <td>Select img:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="add" class="btn btn-secondary">
                        <button onclick="admin.php" type="button" class="btn btn-secondary">ย้อนกลับ</button>
                    </td>
                </tr>
            </table>
        </form>
        <?php
        if (isset($_POST['submit'])) {
            $title = $_POST['title'];
            $price = $_POST['price'];
            $image_name = NULL; // กำหนดค่าเริ่มต้นเป็น NULL

            // ตรวจสอบและอัปโหลดภาพ
            if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
                $image_name = $_FILES['image']['name'];
                $temp = explode('.', $image_name);
                $ext = end($temp);
                $image_name = "coffee_" . rand(1000, 9999) . "." . $ext;

                $src = $_FILES['image']['tmp_name'];
                $dst = "productimg/" . $image_name;

                if (!move_uploaded_file($src, $dst)) {
                    $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
                    header('location: addProducts.php');
                    exit();
                }
            }

            if (empty($title) || empty($price)) {
                $_SESSION['error'] = 'Please enter all required fields.';
                header("location: addProducts.php");
                exit();
            }

            try {
                $stmt = $conn->prepare("INSERT INTO products(name, price, image) VALUES(:title, :price, :image_name)");
                $stmt->bindParam(":title", $title);
                $stmt->bindParam(":price", $price);

                // ถ้าไม่มีภาพให้ใส่ NULL
                if ($image_name === NULL) {
                    $stmt->bindValue(":image_name", NULL, PDO::PARAM_NULL);
                } else {
                    $stmt->bindParam(":image_name", $image_name);
                }

                $stmt->execute();

                $_SESSION['add'] = "<div class='success'>product added successfully.</div>";
                header('location: addProducts.php');
                exit();
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }


        ?>
    </div>


</body>

</html>