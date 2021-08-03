<?php
    include_once './config.php';

    $id = $_GET['id'];

    $sql = "DELETE FROM product WHERE ID = ".$id.";";
    echo $sql;
    mysqli_query($connection,$sql) or header("Location: ../index.php?delete=fail");;

    header("Location: ../index.php?delete=success");