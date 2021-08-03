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
            <p>Vítejte
    </div>


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


<script>
    function export2csv5() {
        let data = "";
        const tableData = [];
        const rows = document.querySelectorAll("table tr");
        for (const row of rows) {
            const rowData = [];
            for (const [index, column] of row.querySelectorAll("th, td").entries()) {
                if(index < 6) {
                    rowData.push(column.innerText);
                }
            }
            tableData.push(rowData.join(","));
        }
        data += tableData.join("\n");
        const a = document.createElement("a");
        a.href = URL.createObjectURL(new Blob([data], { type: "text/csv" }));
        a.setAttribute("download", "data.csv");
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
    }
</script>

<body>

<?php
$type_sql = "SELECT * FROM typeofproduct;";
$man_sql = "SELECT * FROM manufacturer;";

$type_result = mysqli_query($connection, $type_sql);
$man_result = mysqli_query($connection, $man_sql);

$opType = "";
$opMan = "";

while($row = mysqli_fetch_assoc($type_result)){
    $opType = $opType."<option value=\"".$row["ID"]."\">".$row["Name"]."</option>";
}
while($row1 = mysqli_fetch_assoc($man_result)){
    $opMan = $opMan."<option value=\"".$row1["ID"]."\">".$row1["Name"]."</option>";
}
?>

<form class="righted" action="index.php" method="POST">
    <select  name="Type">
        <option disabled selected value> -- vyberte možnost -- </option>
        <?php echo $opType; ?>
    </select><br>
    <select name="Man">
        <option disabled selected value> -- vyberte možnost -- </option>
        <?php echo $opMan; ?>
    </select><br>
    <button class="divFind" type="submit" name="submit"> Filtrovat </button>
</form>

<table class="table table-sortable">
    <thead>
    <tr>
        <th width="15%">Jméno</th>
        <th width="15%">Typ</th>
        <th width="15%">Výrobce</th>
        <th width="15%">Cena Kč</th>
        <th width="15%">Kod</th>
        <th width="15%">Popis</th>
        <th width="3%"></th>
        <th width="3%"></th>
    </tr>
    </thead>

    <tbody id="producttable">

    <?php

    $total_pom = " SELECT COUNT(*) FROM product ;";
    if(!empty($_POST['Type']) && !empty($_POST['Man'])) {
        $total_pom = "SELECT COUNT(*) FROM product WHERE Type = " . $_POST['Type'] . " AND Manufacturer = " . $_POST['Man'] . ";";
    }
    else if(!empty($_POST['Type'])) {
        $total_pom = "SELECT COUNT(*) FROM product WHERE Type = " . $_POST['Type'] .";";
    }
    else if(!empty($_POST['Man'])) {
        $total_pom = "SELECT COUNT(*) FROM product WHERE Manufacturer = " . $_POST['Man'] . ";";
    }

    $limit = 10;
    $total_result = mysqli_query($connection, $total_pom);
    $total = mysqli_fetch_assoc($total_result);

    $pages = ceil( $total["COUNT(*)"] / $limit);

    // What page are we currently on?
    $page = min($pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
        'options' => array(
            'default'   => 1,
            'min_range' => 1,
        ),
    )));

    $offset = ($page - 1)  * $limit;

    $start = $offset + 1;
    $end = min(($offset + $limit),  $total["COUNT(*)"]);

    $prevlink = ($page > 1) ? '<a href="?page=1" title="První strana">&laquo;</a> <a href="?page=' . ($page - 1) . '" title="Předchozí strana">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';
    $nextlink = ($page < $pages) ? '<a href="?page=' . ($page + 1) . '" title="Další strana">&rsaquo;</a> <a href="?page=' . $pages . '" title="Poslední strana">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';
    echo '<div class="divFind" id="paging"><p>', $prevlink, ' Strana ', $page, ' ze ', $pages, ', zobrazeno ', $start, '-', $end, ' z ',  $total["COUNT(*)"], ' položek ', $nextlink, ' </p></div>';
    echo '<div class="pagination">';
    for( $i = 0; $i < $pages; $i++){
        if($i+1 == $page){
            echo '<a href="index.php?page=' . ($i + 1) . '" class="active">' . ($i + 1) . '  </a>';
        } else {
            echo '<a href="index.php?page=' . ($i + 1) . '">' . ($i + 1) . '  </a>';
        }
    }
    echo '</div>';

    $sql = "SELECT * FROM product LIMIT ".$limit." OFFSET ".$offset.";";
    if(!empty($_POST['Type']) && !empty($_POST['Man'])) {
        $sql = "SELECT * FROM product WHERE Type = " . $_POST['Type'] . " AND Manufacturer = " . $_POST['Man'] . " LIMIT ".$limit." OFFSET ".$offset.";";
    }
    else if(!empty($_POST['Type'])) {
        $sql = "SELECT * FROM product WHERE Type = " . $_POST['Type'] ." LIMIT ".$limit." OFFSET ".$offset.";";
    }
    else if(!empty($_POST['Man'])) {
        $sql = "SELECT * FROM product WHERE Manufacturer = " . $_POST['Man'] . " LIMIT ".$limit." OFFSET ".$offset.";";
    }

    $result = mysqli_query($connection, $sql);
    $resultcheck =  mysqli_num_rows($result);
    if ($resultcheck > 0){
        while($row = mysqli_fetch_assoc($result)){
            $id_type = $row['Type'];
            $id_man = $row['Manufacturer'];
            $type_sql = "SELECT Name FROM typeofproduct WHERE ID = \"$id_type\";";
            $type_man = "SELECT Name FROM manufacturer WHERE ID = \"$id_man\";";

            $result_type = mysqli_query($connection, $type_sql);
            $resultcheck_type =  mysqli_num_rows($result_type);

            $result_man = mysqli_query($connection, $type_man);
            $resultcheck_man =  mysqli_num_rows($result_man);

            $man_name = mysqli_fetch_assoc($result_man);
            $man_type = mysqli_fetch_assoc($result_type);

            if($resultcheck_man !== 1 or $resultcheck_type !==1)  {
                echo "ERROR 1:N connection condition violated";
            }

            echo "<tr><td>".$row['Name'].
                "</td><td>".$man_type["Name"].
                "</td><td>".$man_name["Name"].
                "</td><td>".floatval($row["Price"]).
                "</td><td>".$row['Code'].
                "</td><td>".$row['Descrp'].
                " </td><td> <li class=active><a href=./includes/delete_product.php?id=$row[ID]>Smaž</a></li> 
                </td><td> <li class=active><a href=update_product.php?id=$row[ID]>Uprav</a></li>  </td></tr>";


        }
    } else {
        echo "Nebyly nalezeny zadne polozky";
    }
    ?>
    </tbody>
</table>

<div class="btn-group">
    <button onclick="export2csv5()">Export do csv</button>
</div>

<script src="tablesort.js"></script>

</body>


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
    table {
        font-family: Arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        display:block;
    }
    td, th {
        border: 1px solid #cccccc;
        padding: 8px;
    }

    th{
        font-weight: bold;
    }

    .table-sortable th {
        cursor: pointer;
    }

    .table-sortable .th-sort-asc::after {
        content: "\25b4";
    }

    .table-sortable .th-sort-desc::after {
        content: "\25be";
    }

    .table-sortable .th-sort-asc::after,
    .table-sortable .th-sort-desc::after {
        margin-left: 5px;
    }

    .table-sortable .th-sort-asc,
    .table-sortable .th-sort-desc {
        background: rgba(0, 0, 0, 0.1);
    }
    .pagination {
        display: inline-block;
        margin-left: 80pt;
        margin-right: auto;
    }

    .pagination a {
        color: black;
        float: left;
        padding: 8px 16px;
        text-decoration: none;
        margin-bottom: 5pt;

    }
    .pagination a.active {
        background-color: #4CAF50;
        color: black;
    }
    .pagination a:hover:not(.active) {
        background-color: #ddd;
        border-radius: 5px;
    }
    .righted {
        position: absolute;
        top: 45%;
        left: 85%;
        width: 100%;
    }
</style>

</html>