<?php
include_once("dbconnect.php");
if (isset($_POST['button'])) {
     $prname = $_POST['prname'];
     $prtype = $_POST['prtype'];
     $prprice = $_POST['prprice'];
     $prqty = $_POST['prqty'];
     $picture = uniqid() . '.png';
    if (file_exists($_FILES["fileToUpload"]["tmp_name"]) || is_uploaded_file($_FILES["fileToUpload"]["tmp_name"])) {
        $sqlinsertprod = "INSERT INTO tbl_product(prname, prtype, prprice, prqty, picture) VALUES('$prname', '$prtype', 
        '$prprice', '$prqty', '$picture')";
        if ($conn->exec($sqlinsertprod)) {
         uploadImage($picture);
         echo "<script>alert('Item successfully added ')</script>";
         echo "<script>window.location.replace('../index.php')</script>";
        } else {
            echo "<script>alert('Failed')</script>";
            return;
        }
    } else {
        echo "<script>alert('Image not available')</script>";
        echo "<script>window.location.replace('../php/addnewproduct.php')</script>";
        return;
    }
}
    function uploadImage($picture)
    {
        $target_dir = "../images/";
        $target_file = $target_dir . $picture;
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
    }


?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/myscript.js"></script>
</head>

<body>

    <div class="header">
        <a href="../index.php" class="logo">Myshop</a>
        <img src="../images/logo.png" width="90" height="60">
        <div class="header-right">
            <a href=../index.php>Home</a>
            <a href="php/cart.php">My Cart</a>
            <a class="active" href="../php/addnewproduct.php">My Purcase</a>
            <a href="#contact" onClick="return loadCookies()">Email</a>
        </div>
    </div>
    <h1>New product</h1>
    <div class="container">
        <form action="addnewproduct.php" method="post" enctype="multipart/form-data">

            <div class="row" align="center">
                <img class="imgselection" src="../images/profile/<?php echo $username ?>.png ?"><br>
                <input type="file" onchange="previewFile()" name="fileToUpload" id="fileToUpload" accept="image/*"><br>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="fprname">Product Name</label>
                </div>
                <div class="col-75">
                    <input type="text" id="fprname" name="prname" placeholder="Product name..">
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="prtype">Product Type</label>
                </div>
                <div class="col-75">
                    <select id="idprtype" name="prtype">
                        <option value="Cake">Cake</option>
                        <option value="Dessert">Dessert</option>
                        <option value="Bread">Bread</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="lprice">Product Price</label>
                </div>
                <div class="col-75">
                    <input type="text" id="fprprice" name="prprice" placeholder="Price RM...">
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="lqty">Quantity</label>
                </div>
                <div class="col-75">
                    <input type="text" id="lqty" name="prqty" placeholder="Quantity">
                </div>
            </div>
            <div class="row">
                <input type="submit" name="button" value="Submit">
            </div>
        </form>
    </div>
</body>

</html>