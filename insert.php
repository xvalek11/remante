<? header("Content-Type: text/html; charset=UTF-8");?>
<?php
    include_once './includes/config.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>Vítejte v systému</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <div id=bg class='jumbotron text-left'>
        <h1>Seznam produktů </h1>
        <h1>autonorma.cz</h1>
            <p> Vkládání produktů
    </div>";


    <nav id=\"menu\" class='navbar navbar-default'>
        <div class=container-fluid>
        <div class=navbar-header>
            <a class=navbar-brand href=#>Navigace</a>
        </div>
        <ul class='nav navbar-nav'>
            <li class=active><a href=index.php>Home</a></li>
            <li class=active><a href=insert.php>Vložit produkt</a></li>
        </ul>
        </div>
    </nav>
</head>

<style>
    select, input[type="text"]{
        width:10%;
        box-sizing:border-box;
        padding-bottom: 5px;
        margin-bottom: 1em;
        margin-left: 3em;
    }

    button {
        margin-left: 8em;
    }
</style>

<body>
    <?php
        $query = "SELECT * FROM typeofproduct";
        $result = mysqli_query($connection,$query);
        $query1 = "SELECT * FROM manufacturer";
        $result1 = mysqli_query($connection,$query1);

        $opType = "";
        $opMan = "";

        while($row = mysqli_fetch_assoc($result)){
            $opType = $opType."<option value=\"".$row["ID"]."\">".$row["Name"]."</option>";
        }
        while($row1 = mysqli_fetch_assoc($result1)){
            $opMan = $opMan."<option value=\"".$row1["ID"]."\">".$row1["Name"]."</option>";
        }
    ?>
    <form action="includes/insert_product.php" method="POST">
         <input type="text" name="Name" placeholder="Jméno"> <br>
         <select name="Type">
            <?php echo $opType; ?>
         </select><br>
        <select name="Man">
            <?php echo $opMan; ?>
        </select><br>
         <input type="text" name="Price" placeholder="Cena"><br>
        <input type="text" name="Code" placeholder="Náš kód"><br>
        <input type="text" name="Descrp" placeholder="Popis"><br>
        <button type="submit" name="submit"> Vložit </button>
    </form>
</body>
</html>