<?php
    include_once './config.php';

    $name = $_POST['Name'];
    $Type = $_POST['Type'];
    $Man = $_POST['Man'];
    $Price =  str_replace(' ', '', $_POST['Price']);
    $Code = $_POST['Code'];
    $Descrp = $_POST['Descrp'];

    $sql = "INSERT INTO product (Type, Manufacturer, Name, Price, Code, Descrp) VALUES ('$Type','$Man','$name','$Price','$Code','$Descrp');";

    mysqli_query($connection,$sql) or header("Location: ../index.php?insert=fail");

    header("Location: ../index.php?insert=success");