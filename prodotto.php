<?php
require 'db.php'; // Assicurati che questo file contenga la connessione PDO

// Recupera il nome del prodotto dall'URL
$product_name = isset($_GET['name']) ? $_GET['name'] : '';

if (!empty($product_name)) {
    // Query per ottenere i dettagli del prodotto
    $sql = "SELECT * FROM products WHERE name = :name";
    $stmt = $conn->prepare($sql);

    // Usa bindParam per legare il parametro
    $stmt->bindParam(':name', $product_name, PDO::PARAM_STR);

    // Esegui la query
    $stmt->execute();

    // Controlla se ci sono risultati
    if ($stmt->rowCount() > 0) {
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        echo "Prodotto non trovato.";
        exit;
    }
} else {
    echo "Nome prodotto non valido.";
    exit;
}

// Chiudi la connessione
$conn = null;
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['name']); ?> - Prodotto</title>
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

<div class="container">
    <div class="main-content">
        <div class="product-details">
            <div class="product-image">
                <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?> Album Cover">
            </div>
            <div class="product-info">
                <h1><?php echo htmlspecialchars($product['name']); ?></h1>
                <p><strong>Prezzo: </strong><?php echo number_format($product['price'], 2, ',', ' '); ?> €</p>
                <p><strong>Disponibilità: </strong><?php echo $product['stock'] > 0 ? 'Disponibile' : 'Non disponibile'; ?></p>
                <p><strong>Descrizione: </strong><?php echo htmlspecialchars($product['description']); ?></p>
                <p><strong>Formato: </strong><?php echo htmlspecialchars($product['formato']); ?></p>
                <p><strong>Versione: </strong><?php echo htmlspecialchars($product['versione']); ?></p>

                <!-- Modulo per aggiungere al carrello -->
                <form action="add_to_cart.php" method="post">
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                    <label>Quantità:</label>
                    <input type="number" name="quantity" value="1" min="1" required>
                    <button type="submit" name="add_to_cart">Aggiungi al carrello</button>
                </form>

                <button onclick="location.href='prodotto2.php?name=<?php echo urlencode($product['name']); ?>'">Vedi meglio</button>
            </div>
        </div>

        <div class="description">
            <h2>Descrizione</h2>
            <p><?php echo htmlspecialchars($product['description']); ?></p>
        </div>


    </div>
</div>

<footer>
    &copy; 2025 Negozio di Dischi. Tutti i diritti riservati.
</footer>
</body>
</html>