CREATE DATABASE products;
use products;

CREATE TABLE items_on_sale(
    name VARCHAR(24),
    QTY int(4),
    Price float(4)
);

INSERT INTO items_on_sale
(name, qty,price)
VALUES
('Muffins','4','2.99'),
('Cake','20','2.99'),
('Nails','100','3.98');