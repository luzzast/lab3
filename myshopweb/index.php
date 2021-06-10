<?php
include_once("php/dbconnect.php");


$sqlall = "SELECT * FROM tbl_product";
$stmt = $conn->prepare($sqlall);
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$rows = $stmt->fetchAll();




//search and list products
if (isset($_GET['button'])) {
    $prname = $_GET['prname'];
    $prtype = $_GET['prtype'];
    if ($prtype == "all") {
        $sqlsearch = "SELECT * FROM tbl_product WHERE prname LIKE '%$prname%'";
    } else {
        $sqlsearch = "SELECT * FROM tbl_product WHERE prtype = '$prtype' AND prname LIKE '%$prname%'";
    }
} else {
    $sqlsearch = "SELECT * FROM tbl_product";
}
$stmt = $conn->prepare($sqlsearch);
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$rows = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="header">
        <a href=index.php class="logo">Myshop</a>
        <img src="images/logo.png" width="90" height="60">
        <div class="header-right">
            <a class="active" href=index.php>Home</a>
            <a href="php/cart.php">My Cart</a>
            <a href=php/addnewproduct.php>My Purcase</a>
            <a href="#contact" onClick="return loadCookies()">Email</a>
        </div>
    </div>
    <center>
        <h2>List of Products</h2>
    </center>
    <div class="container-src">
        <form action="index.php" method="get">
            <div class="row">
                <div class="column">
                    <input type="text" id="fprname" name="prname" placeholder="Product name..">
                </div>
                <div class="column">
                    <select id="idprtype" name="prtype">
                        <option value="all">All</option>
                        <option value="beverage">Cake</option>
                        <option value="canned">Dessert</option>
                        <option value="electronic">Bread</option>
                    </select>
                </div>
                <div class="column">
                    <input type="submit" name="button" value="Search">
                </div>
            </div>
        </form>
    </div>

    <?php

    echo "<div class='container'>";
    
    foreach ($rows as $products) {
       
        $imgurl = "images/" . $products['picture'];
        echo "<img src='$imgurl' class='primage'>";
        echo "<h2 align= 'center'>" . ($products['prname']) . "</h2>";
        echo "<p align= 'center'>Product Type :" . ($products['prtype']) . "</p>";
        echo "<p RM align= 'center'>RM :" . ($products['prprice']) . "</p>";
        echo "<p align= 'center'>Product Quantity :" . ($products['prqty']) . "</p>";
        
    }



    ?>
</body>

</html>

