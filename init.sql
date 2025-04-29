-- init.sql 최상단에 추가
SET NAMES utf8mb4;
SET CHARACTER SET utf8mb4;

CREATE DATABASE IF NOT EXISTS kisia_market CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE kisia_market;

CREATE TABLE IF NOT EXISTS products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  description TEXT,
  price INT NOT NULL,
  stock INT DEFAULT 0,
  image_url VARCHAR(500),
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  deliver_price INT DEFAULT 0
);

-- 초기 데이터 삽입 예시
INSERT INTO products (name, description, price, stock, image_url, deliver_price)
VALUES
('apple', 'flesh apple lol.', 3000, 100, '/images/apple.jpg', 3000),
('바나나', '맛있는 바나나입니다.', 2000, 80, '/images/banana.jpg', 2500);
