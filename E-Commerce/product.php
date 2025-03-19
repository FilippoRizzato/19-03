<?php
require 'db.php';

$product_id = $_GET['id'];
$sql = "SELECT * FROM products WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':id', $product_id);
$stmt->execute();
$product = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $product['name']; ?></title>
</head>
<body>
<h1><?php echo $product['name']; ?></h1>
<p>Prezzo: <?php echo $product['price']; ?>€</p>
<form action="cart.php" method="post">
    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
    <button type="submit" name="add_to_cart">Aggiungi al Carrello</button>
</form>
</body>
</html>
