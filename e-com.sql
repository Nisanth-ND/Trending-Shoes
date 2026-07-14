CREATE DATABASE trendingshoes;

USE trendingshoes;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    image VARCHAR(255) NOT NULL
);

INSERT INTO products (title, description, price, image)
VALUES
('Sports', 'Premium sports shoe for running and training.', 2999.00, 'sports-shoe.png'),

('Formals', 'Elegant formal shoe suitable for office and events.', 3499.00, 'formals-shoe.png'),

('Casuals', 'Comfortable casual shoe for everyday wear.', 2499.00, 'casuals-shoe.png'),

('Boots', 'Stylish boots with durable sole.', 4599.00, 'boots-shoe.png'),

('Loafers', 'Classic loafers with premium comfort.', 2799.00, 'loafers-shoe.png'),

('Sneakers', 'Trendy sneakers for daily fashion.', 3299.00, 'sneakers-shoe.png');

CREATE TABLE cart (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT DEFAULT 1,

    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);