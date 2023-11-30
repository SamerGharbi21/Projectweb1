<?php 

$conn = mysqli_connect('localhost', 'root', 'root', 'projectweb');

if (!$conn) {
    echo 'Error: ' . mysqli_connect_error();
}

$sql = "SELECT * FROM products ";
$result = mysqli_query($conn, $sql);
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
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
<header>
        <h2 class="logo"><i><b>Market Hub</b></i></h2>
        <nav>
            <ul class="nav_links">
                <li><a href="#">Home</a></li>
                <li><a href="#">Orders</a></li>
                <li><a href="#">Cart</a></li>
            </ul>
        </nav>
        <a href="#"><button class="profile_btn">Profile</button></a>
    </header>

    <div class="container">
    <?php foreach($products as $p): ?>
        <div class="product">
            <img src='<?php echo $p['image1']; ?>' alt='<?php echo $p['name1']; ?>' class="product-image">
            
            <div class="product-details">
                <h2 class="product-name"><?php echo htmlspecialchars($p['name']); ?></h2>
                <h3 class="product-price"><?php echo htmlspecialchars($p['price']); ?> SAR</h3>
            </div>
            <p class="product-description"><?php echo htmlspecialchars($p['description1']); ?></p>

        </div>

        <div class="product-btn">
            <button class="buy-btn">Buy</button>
            <button class="cart-btn">Add To Cart</button>    
        </div>
        
    <?php endforeach; ?>
    </div>




</body>
</html>