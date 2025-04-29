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
  deliver_price INT DEFAULT 0,
  category VARCHAR(255) NOT NULL
);

-- 초기 데이터 삽입 예시
INSERT INTO products (name, description, price, stock, image_url, deliver_price, category)
VALUES
('로지텍 MX Keys', '프리미엄 무선 키보드, 인체공학적 디자인', 139000, 100, '../uploads/keyboard1.jpg', 3000, '키보드'),
('한성 GK893B', '기계식 RGB 키보드, 고급스러운 타건감', 79000, 80, '../uploads/keyboard2.jpg', 2500, '키보드'),
('앱코 K640', '컴팩트한 디자인의 무선 키보드', 45000, 80, '../uploads/keyboard3.jpg', 2500, '키보드'),
('레오폴드 FC750R', '타건감이 뛰어난 텐키리스 키보드', 119000, 50, '../uploads/keyboard4.jpg', 3000, '키보드'),
('커세어 K70 RGB MK.2', '고급스러운 알루미늄 키보드, RGB 백라이트', 199000, 30, '../uploads/keyboard5.jpg', 3500, '키보드'),
('아이락스 K9800', '가성비 좋은 기계식 키보드, RGB 조명', 55000, 120, '../uploads/keyboard6.jpg', 2000, '키보드'),
('로지텍 MX Keys(2)', '프리미엄 무선 키보드, 인체공학적 디자인', 139000, 100, '../uploads/keyboard1.jpg', 3000, '키보드'),
('한성 GK893B(2)', '기계식 RGB 키보드, 고급스러운 타건감', 79000, 80, '../uploads/keyboard2.jpg', 2500, '키보드'),
('앱코 K640(2)', '컴팩트한 디자인의 무선 키보드', 45000, 80, '../uploads/keyboard3.jpg', 2500, '키보드'),
('레오폴드 FC750R(2)', '타건감이 뛰어난 텐키리스 키보드', 119000, 50, '../uploads/keyboard4.jpg', 3000, '키보드'),
('커세어 K70 RGB MK.2(2)', '고급스러운 알루미늄 키보드, RGB 백라이트', 199000, 30, '../uploads/keyboard5.jpg', 3500, '키보드'),
('아이락스 K9800(2)', '가성비 좋은 기계식 키보드, RGB 조명', 55000, 120, '../uploads/keyboard6.jpg', 2000, '키보드');