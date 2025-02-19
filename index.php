<?php 

    session_start();
    require_once 'config/db.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration System PDO</title>
    <link rel="stylesheet" href="signin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

<div class="wrapper">

        <form action="signup_db.php" method="post">
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
            <?php if(isset($_SESSION['warning'])) { ?>
                <div class="alert alert-warning" role="alert">
                    <?php 
                        echo $_SESSION['warning'];
                        unset($_SESSION['warning']);
                    ?>
                </div>
            <?php } ?>
            <h1>Sign up</h1>
            <hr>
            <div class="input-box">
                <input type="text" class="form-control" name="firstname" placeholder="First name" aria-describedby="firstname">
            </div>
            <div class="input-box">
                <input type="text" class="form-control" name="lastname" placeholder="Last name" aria-describedby="lastname">
            </div>
            <div class="input-box">
                <input type="email" class="form-control" name="email" placeholder="email" aria-describedby="email">
            </div>
            <div class="input-box">
                <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
            <div class="input-box">
                <input type="password" class="form-control" name="c_password" placeholder="Confirm password">
            </div>
            <div class="input-box">
            <button type="submit" name="signup" class="btn btn-primary">Sign Up</button>
            </div>
            <div class="register">
            <hr>
            <p>Already a member? <a href="signin.php">sign in</a></p>
            </div>
        </form>
        
    </div>
    
</body>
</html>