<?php

$email = "samer" ;

$conn = mysqli_connect('localhost', 'root', 'root', 'projectweb');


if (!$conn) {
    echo 'Error: ' . mysqli_connect_error();
}

if (isset($_POST['add_product'])) {
    $pname = $_POST['pname'];
    $Pprice = $_POST['Pprice'];
    $Pquantity = $_POST['Pquantity'];
    $Pdetail = $_POST['Pdetail'];

    $target_directory = "uploadimage/";
    $target_file = $target_directory . basename($_FILES["Pimage"]["name"]);

    if (empty($pname)) {
        echo 'Product name is empty';
    } elseif (empty($Pprice)) {
        echo 'Product price is empty';
    } elseif (empty($Pquantity)) {
        echo 'Product quantity is empty';
    } elseif (empty($Pdetail)) {
        echo 'Product detail is empty';
    } else {
        
        // Move the uploaded file
        if (move_uploaded_file($_FILES["Pimage"]["tmp_name"], $target_file)) {
            $Pimage = $target_file;

            // SQL query
            $sql = "INSERT INTO products(name1, price, quantity, description1 , email , image1) 
                    VALUES ('$pname', '$Pprice', '$Pquantity', '$Pdetail', '$email' , '$Pimage')";

            if (mysqli_query($conn, $sql)) {
                header('Location: index.php');
            } else {
                echo 'Error: ' . mysqli_error($conn);
            }
        } else {
            echo "Error uploading file.";
        }
    }
}


$query = "SELECT * FROM products";
$result = mysqli_query($conn, $query);

if ($result) {
    $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    echo 'Error: ' . mysqli_error($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/di.css" >
    <title>Document</title>
</head>
<body>
    <!-- Navigation Bar -->
    <div class="navbar">
        <a href="index.php">Home</a>
        <a href="orders.php">Orders</a>
        <a href="cart.php">Cart</a>
        <a href="login.php">Login</a>
    </div>

    <form class="mt-5 text-center" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
    <h3> Product Information </h3>

    <div class="mb-3">
        <div>
            <label for="pname" class="form-label">Product name</label>
        </div>
        <div>
            <input type="text" class="form-control" name="pname" id="pname" placeholder="Enter Product name" value="<?php echo $pname ?>">
        </div>
    </div>

    <div class="mb-3">
        <div>
            <label for="Pprice" class="form-label">Product Price</label>
        </div>
        <div>
            <input type="number" class="form-control" name="Pprice" id="Pprice" placeholder="Enter Product Price" value="<?php echo $Pprice ?>">
        </div>
    </div>

    <div class="mb-3">
        <div>
            <label for="Pquantity" class="form-label">Product Quantity</label>
        </div>
        <div>
            <input type="number" class="form-control" name="Pquantity" id="Pquantity" placeholder="Enter Product Quantity" value="<?php echo $Pquantity ?>">
        </div>
    </div>

<div class="mb-3">
        <div>
            <label for="Pdetail" class="form-label">Product Details</label>
        </div>
        <div>
            <input type="text" class="form-control" name="Pdetail" id="Pdetail" placeholder="Enter Product Details" value="<?php echo $Pdetail ?>">
        </div>
    </div>

    <div class="mb-3">
        <div>
            <label for="Pimage" class="form-label">Product Image</label>
        </div>
        <div>
            <input type="file" class="form-control" name="Pimage" id="Pimage" value="<?php echo $Pimage ?>">
        </div>
    </div>

    

    <button type="submit" name="add_product" value="add product" class="btn">Add Product</button>
</form>



<div class="mt-5 text-center">
        <h3 id ="pro"> All Products </h3>
        <table>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Details</th>
                <th>Image</th>
            </tr>
            <?php
            // Loop through each product and display its information
            foreach ($products as $product) {
                echo "<tr>";
                echo "<td>{$product['name1']}</td>";
                echo "<td> $ {$product['price']}</td>";
                echo "<td>   {$product['quantity']}</td>";
                echo "<td>{$product['description1']}</td>";
                echo "<td><img src='{$product['image1']}' alt='Product Image' style='max-width: 100px; max-height: 100px;'></td>";
                echo "</tr>";
            }
            ?> 

            
        </table>
    </div>
</body>
</html>