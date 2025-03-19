

USE ecommerce;

CREATE TABLE users (
                       id INT AUTO_INCREMENT PRIMARY KEY,
                       email VARCHAR(255) NOT NULL UNIQUE,
                       password VARCHAR(255) NOT NULL
);

CREATE TABLE products (
                          id INT AUTO_INCREMENT PRIMARY KEY,
                          name VARCHAR(255) NOT NULL,
                          price DECIMAL(10, 2) NOT NULL,
                          stock INT NOT NULL,
                          image VARCHAR(255) NOT NULL,
                          description TEXT NOT NULL,
                          formato ENUM('CD', 'Vinile', 'Digitale') NOT NULL,
                          versione ENUM('Standard', 'collector\'s edition', 'deluxe') NOT NULL
);
CREATE TABLE cart (
                      id INT AUTO_INCREMENT PRIMARY KEY,
                      user_id INT NOT NULL,
                      product_id INT NOT NULL,
                      quantity INT DEFAULT 1,
                      formato VARCHAR(50) NOT NULL,
                      versione VARCHAR(50) NOT NULL,
                      FOREIGN KEY (user_id) REFERENCES users(id),
                      FOREIGN KEY (product_id) REFERENCES products(id)
);

CREATE TABLE product_images (
                                id INT AUTO_INCREMENT PRIMARY KEY,
                                product_id INT,
                                image_url VARCHAR(255) NOT NULL,
                                FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

INSERT INTO products (name, price, stock, image, description, formato, versione) VALUES
                                                                                     ('DAMN. - Kendrick Lamar', 44.99, 10, 'https://www.disclan.com/150738-home_default/damn-lamar-kendrick-lp.jpg', 'Descrizione dettagliata per DAMN. - Kendrick Lamar.', 'Vinile', 'Standard'),
                                                                                     ('All Eyez On Me - 2Pac', 34.99, 15, 'https://www.disclan.com/160944-home_default/all-eyez-on-me-2pac-lp.jpg', 'Descrizione dettagliata per All Eyez On Me - 2Pac.', 'CD', 'collector\'s edition'),
                                                                                     ('Effigy - Lamb As', 24.99, 20, 'https://www.disclan.com/162611-home_default/lamb-as-effigy-.jpg', 'Descrizione dettagliata per Effigy - Lamb As.', 'Digitale', 'Standard'),
                                                                                     ('Madra - Indie Exclusive', 22.99, 5, 'https://www.disclan.com/163550-home_default/madra-indie-exclusive-green-vinyl.jpg', 'Descrizione dettagliata per Madra - Indie Exclusive.', 'Vinile', 'deluxe'),
                                                                                     ('The Razors Edge - AC/DC', 39.99, 8, 'https://www.disclan.com/163490-home_default/the-razors-edge-lp-colore-oro-ac-dc-lp.jpg', 'Descrizione dettagliata per The Razors Edge - AC/DC.', 'CD', 'Standard'),
                                                                                     ('Where Is My Utopia - Indie Exclusive', 26.99, 12, 'https://www.disclan.com/163445-home_default/where-is-my-utopia-colored-vinyl-indie-exclusive-ltd-ed.jpg', 'Descrizione dettagliata per Where Is My Utopia - Indie Exclusive.', 'Vinile', 'collector\'s edition'),
                                                                                     ('Lives Outgrown - Deluxe', 28.99, 7, 'https://www.disclan.com/163881-home_default/lives-outgrown-deluxe-indie-only.jpg', 'Descrizione dettagliata per Lives Outgrown - Deluxe.', 'Digitale', 'deluxe'),
                                                                                     ('For Those About to Rock - AC/DC', 38.99, 6, 'https://www.disclan.com/163488-home_default/for-those-about-to-rock-we-salute-you-lp-colore-oro-ac-dc-lp.jpg', 'Descrizione dettagliata per For Those About to Rock - AC/DC.', 'Vinile', 'Standard'),
                                                                                     ('Who Made Who - AC/DC', 37.99, 9, 'https://www.disclan.com/163491-home_default/who-made-who-lp-colore-oro-ac-dc-lp.jpg', 'Descrizione dettagliata per Who Made Who - AC/DC.', 'CD', 'collector\'s edition');


INSERT INTO product_images (product_id, image_url) VALUES
                                                       (1, 'https://www.google.com/imgres?q=damn%20immagini%20%C3%A0&imgurl=https%3A%2F%2Fm.media-amazon.com%2Fimages%2FI%2F51ryoR7hU2L._UF894%2C1000_QL80_.jpg&imgrefurl=https%3A%2F%2Fwww.amazon.it%2FDAMN-Kendrick-Lamar%2Fdp%2FB0716SPKYW&docid=s5ikJUz5mbPD9M&tbnid=9hqRzYuSJJvJ3M&vet=12ahUKEwjMtK74vpaMAxXezgIHHUIMObcQM3oECBwQAA..i&w=894&h=883&hcb=2&ved=2ahUKEwjMtK74vpaMAxXezgIHHUIMObcQM3oECBwQAA'),
                                                       (1, 'https://www.example.com/image2.jpg'),
                                                       (2, 'https://www.example.com/image3.jpg'),
                                                       (2, 'https://www.example.com/image4.jpg');

-- Inserimento di un utente (esempio)
INSERT INTO users (email, password) VALUES
    ('test@example.com', 'password123');

-- Inserimento di un carrello (esempio)
INSERT INTO cart (user_id, product_id, quantity, formato, versione) VALUES
    (1, 1, 2, 'Vinile', 'Deluxe');