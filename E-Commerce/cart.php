<?php
require 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "Devi accedere per visualizzare il carrello.";
    exit;
}

$user_id = $_SESSION['user_id']; // Ottieni l'ID dell'utente dalla sessione

// Recupera i prodotti nel carrello per l'utente
$sql = "SELECT c.quantity, p.* FROM cart c 
        JOIN products p ON c.product_id = p.id 
        WHERE c.user_id = :user_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();

$cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Chiudi la connessione
$conn = null;
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrello</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <div class="header-content">
        <nav class="nav">
            <a href="home.php">HOME</a>
            <a href="#">CD</a>
            <a href="#">VINILI</a>
        </nav>
        <div class="logo text-center">
            <img src="Screenshot%202025-02-04%20083718.png" alt="Logo">
        </div>
        <div class="search-bar">
            <input type="text" placeholder="Cerca...">
            <button type="button">🔍</button>
        </div>
    </div>
</header>

<div class="cart-container">
    <h1>Carrello</h1>

    <div class="cart-items">
        <?php if (count($cart_items) > 0): ?>
            <?php foreach ($cart_items as $item): ?>
                <div class="cart-item">
                    <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
                    <span><?php echo htmlspecialchars($item['name']); ?></span>
                    <span class="price"><?php echo number_format($item['price'], 2, ',', ' '); ?> €</span>
                    <span class="quantity">Quantità: <?php echo htmlspecialchars($item['quantity']); ?></span>
                    <button class="remove-btn" onclick="removeFromCart(<?php echo $item['id']; ?>)">Rimuovi</button>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Il carrello è vuoto.</p>
        <?php endif; ?>
    </div>

    <div class="cart-summary">
        <p><strong>Totale: </strong>
            <?php
            $total = array_sum(array_map(function($item) {
                return $item['price'] * $item['quantity'];
            }, $cart_items));
            echo number_format($total, 2, ',', ' ') . ' €';
            ?>
        </p>
        <button onclick="checkout()">Procedi al pagamento</button>
    </div>
</div>

<footer>
    &copy; 2025 Negozio di Dischi. Tutti i diritti riservati.
</footer>

<script>
    function removeFromCart(productId) {
        // Implementa la logica per rimuovere il prodotto dal carrello
        alert('Rimuovi prodotto con ID: ' + productId);
    }

    function checkout() {
        alert('Reindirizzamento al pagamento...');
    }
</script>

</body>
</html>