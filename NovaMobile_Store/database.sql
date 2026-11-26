CREATE DATABASE IF NOT EXISTS nova_mobile CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE nova_mobile;

CREATE TABLE IF NOT EXISTS products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150) NOT NULL,
  brand VARCHAR(60) NOT NULL,
  price DECIMAL(10,2) NOT NULL,
  old_price DECIMAL(10,2) DEFAULT NULL,
  category VARCHAR(60) NOT NULL,
  description TEXT,
  image_url VARCHAR(600) NOT NULL,
  rating DECIMAL(2,1) DEFAULT 4.5,
  badge VARCHAR(40) DEFAULT NULL,
  stock INT NOT NULL DEFAULT 10,
  is_active TINYINT(1) NOT NULL DEFAULT 1,
  sort_order INT NOT NULL DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS orders (
  id INT AUTO_INCREMENT PRIMARY KEY,
  customer_name VARCHAR(150) NOT NULL,
  email VARCHAR(190) NOT NULL,
  phone VARCHAR(30) NOT NULL,
  address TEXT NOT NULL,
  total_amount DECIMAL(10,2) NOT NULL,
  status VARCHAR(30) NOT NULL DEFAULT 'Pending',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS order_items (
  id INT AUTO_INCREMENT PRIMARY KEY,
  order_id INT NOT NULL,
  product_id INT NOT NULL,
  product_name VARCHAR(150) NOT NULL,
  quantity INT NOT NULL,
  unit_price DECIMAL(10,2) NOT NULL,
  line_total DECIMAL(10,2) NOT NULL,
  CONSTRAINT fk_order_items_order FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
  CONSTRAINT fk_order_items_product FOREIGN KEY (product_id) REFERENCES products(id)
);

CREATE TABLE IF NOT EXISTS subscribers (
  id INT AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(190) NOT NULL UNIQUE,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO products (name, brand, price, old_price, category, description, image_url, rating, badge, stock, sort_order) VALUES
('iPhone 16 Pro', 'Apple', 119900, 129900, 'Apple', 'A18 Pro performance, an advanced camera system and a beautifully refined titanium design.', 'https://images.unsplash.com/photo-1695048133142-1a20484d2569?auto=format&fit=crop&w=900&q=85', 4.9, 'BESTSELLER', 12, 1),
('Galaxy S25 Ultra', 'Samsung', 129999, 139999, 'Samsung', 'A powerful Galaxy experience with an expansive display, versatile cameras and S Pen creativity.', 'https://images.unsplash.com/photo-1610945265064-0e34e5519bbf?auto=format&fit=crop&w=900&q=85', 4.8, 'JUST IN', 8, 2),
('Pixel 9 Pro', 'Google', 99999, 109999, 'Google', 'A clean, intelligent Android experience with thoughtful AI tools and a camera made for every moment.', 'https://images.unsplash.com/photo-1598327105666-5e4a0f8b6b5a?auto=format&fit=crop&w=900&q=85', 4.8, 'STAFF PICK', 10, 3),
('OnePlus 13', 'OnePlus', 69999, 74999, 'OnePlus', 'Flagship speed, immersive viewing and all-day power in a confident, considered design.', 'https://images.unsplash.com/photo-1605236453806-6ff36851218e?auto=format&fit=crop&w=900&q=85', 4.7, 'GREAT VALUE', 14, 4),
('iPhone 15', 'Apple', 69900, 79900, 'Apple', 'A dynamic camera, vivid display and smooth everyday performance in a familiar, durable design.', 'https://images.unsplash.com/photo-1592750475338-74b7b21085ab?auto=format&fit=crop&w=900&q=85', 4.7, NULL, 9, 5),
('Galaxy Z Flip6', 'Samsung', 89999, 99999, 'Samsung', 'A pocket-sized foldable with a flexible form, expressive cover screen and creative camera features.', 'https://images.unsplash.com/photo-1610945264803-c22b62d2a7b3?auto=format&fit=crop&w=900&q=85', 4.6, 'TRENDING', 6, 6),
('Pixel 8a', 'Google', 52999, 59999, 'Google', 'A smart everyday companion with helpful Google features, dependable battery life and a brilliant camera.', 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?auto=format&fit=crop&w=900&q=85', 4.6, NULL, 16, 7),
('OnePlus 12R', 'OnePlus', 39999, 45999, 'OnePlus', 'A smooth, fast phone with a bright display and performance that punches above its price.', 'https://images.unsplash.com/photo-1512499617640-c74ae3a79d37?auto=format&fit=crop&w=900&q=85', 4.5, 'VALUE PICK', 18, 8)
ON DUPLICATE KEY UPDATE name = VALUES(name);
