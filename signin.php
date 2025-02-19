<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration System PDO</title>
    <link rel="stylesheet" href="signin.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

    <div class="wrapper">
        
        <form action="signin_db.php" method="post">
            <?php if(isset($_SESSION['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php 
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    ?>
                </div>
            <?php } ?>
            <?php if(isset($_SESSION['success'])) { ?>
                <div class="alert alert-success" role="alert">
                    <?php 
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                    ?>
                </div>
            <?php } ?>
            <h1>Login</h1>
             <hr>
            <div class="input-box">
                <input type="email" class="form-control" name="email" placeholder="email" aria-describedby="email">
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" class="form-control" name="password" placeholder="Password">
                <i class='bx bxs-lock-alt' ></i>
            </div>
            <hr>
            <div class="input-box">
            <button type="submit" name="signin" class="btn btn-primary">Sign In</button>
            </div>
            <div class="register">
            <p>Don't have an account? <a href="index.php">Sign up</a></p>
            </div>
            
        </form>
        
    </div>
    
</body>
</html>