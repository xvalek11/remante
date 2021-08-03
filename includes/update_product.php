<?php
    include_once './config.php';

    $id = $_POST['id'];
    $name = trim($_POST['Name']);
    $Type = $_POST['Type'];
    $Man = $_POST['Man'];
    $Price = trim($_POST['Price']);
    $Code = trim($_POST['Code']);
    $Descrp = $_POST['Descrp'];

    $sql = "UPDATE product SET Type = '$Type', Manufacturer = '$Man', Name = '$name', Price = '$Price', Code = '$Code', Descrp = '$Descrp' WHERE ID = $id;";
    echo $sql;
    mysqli_query($connection,$sql) or header("Location: ../index.php?update=fail");

    header("Location: ../index.php?update=success");