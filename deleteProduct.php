<?php
require_once 'config/db.php';

echo '<script src="https://code.jquery.com/jquery-3.1.1.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css"/>';
if (isset($_REQUEST['delete_id'])) {
    $id = $_REQUEST['delete_id'];

    $select_stmt = $conn->prepare("SELECT * FROM products WHERE id = :id");
    $select_stmt->bindParam(":id", $id);
    $select_stmt->execute();
    $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
    $delete_stmt = $conn->prepare('DELETE FROM products WHERE id = :id');
    $delete_stmt->bindParam(":id", $id);
    $delete_stmt->execute();

    echo '
        <script>
    setTimeout(function(){
        swal({
            title:"Delete Success",
            text:"",
            type:"success"
        },function(){
            window.location = "admin.php";
        })
    },1000);
    </script>
        ';
}
?>