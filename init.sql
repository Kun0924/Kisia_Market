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

-- 액세서리 6개
INSERT INTO products (name, description, price, stock, image_url, deliver_price, category) VALUES
('삼성 ssd T7 1TB', '장시간 타이핑에도 편안한 손목 보호대', 1480000, 100, '../uploads/etc1.png', 2000, '액세서리'),
('앱코 게이밍 헤드셋', '개성있는 키캡으로 키보드 꾸미기', 34000, 50, '../uploads/etc2.png', 2500, '액세서리'),
('캔스톤 F1BT', '키보드/마우스 연결에 용이한 USB 허브', 70000, 80, '../uploads/etc3.png', 2500, '액세서리'),
('아펙스 4 블루투스 게임패드', '윤활 도구 포함된 키보드 유지보수 키트', 180000, 60, '../uploads/etc4.png', 2500, '액세서리'),
('닌텐도 스위치 OLED', '먼지 방지용 키보드 커버', 370000, 150, '../uploads/etc5.png', 1500, '액세서리'),
('삼성전자 SL-C510', '책상 위 케이블을 깔끔하게 정리', 180000, 200, '../uploads/etc6.png', 1000, '액세서리');

-- 키보드 5개
INSERT INTO products (name, description, price, stock, image_url, deliver_price, category) VALUES
('한성컴퓨터 GK698', '정숙하고 부드러운 타건감의 무선 키보드', 39000, 70, '../uploads/keyboard1.png', 3000, '키보드'),
('AULA F87 Pro', 'RGB 백라이트, 기계식 게이밍 키보드', 67000, 90, '../uploads/keyboard2.png', 2000, '키보드'),
('로지텍 MX Keys Mini for Mac', '사무용으로 적합한 무접점 키보드', 125000, 40, '../uploads/keyboard3.png', 3000, '키보드'),
('Razer Huntsman V2 TKL KR', '스위치 교체형 기계식 키보드', 189000, 75, '../uploads/keyboard4.png', 2500, '키보드'),
('ASUS ROG FALCHION ACE HFX', '심플하고 실용적인 유선 키보드', 29900, 100, '../uploads/keyboard5.png', 2000, '키보드');

-- 마우스 6개
INSERT INTO products (name, description, price, stock, image_url, deliver_price, category) VALUES
('로지텍 지슈라', '인체공학 디자인의 프리미엄 무선 마우스', 139000, 50, '../uploads/mouse1.png', 3000, '마우스'),
('Razer Viper V3 Pro', '게이밍용 무선 마우스, 경량 디자인', 329000, 100, '../uploads/mouse2.png', 2000, '마우스'),
('삼성 마우스', '고성능 센서의 인체공학 마우스', 9900, 70, '../uploads/mouse3.png', 2500, '마우스'),
('앱코 A660', '가성비 좋은 게이밍 마우스', 27000, 150, '../uploads/mouse4.png', 2000, '마우스'),
('펄사 X2H 미니 무선 게이밍 마우스', '독특한 접이식 디자인의 블루투스 마우스', 83300, 30, '../uploads/mouse5.png', 3000, '마우스'),
('CORSAIR DARKSTAR', '휴대성이 뛰어난 무선 마우스', 187000, 120, '../uploads/mouse6.png', 1500, '마우스');

-- 마우스패드 5개
INSERT INTO products (name, description, price, stock, image_url, deliver_price, category) VALUES
('로지텍 POWERPLAY 2', '프로 게이머를 위한 대형 마우스패드', 142000, 60, '../uploads/pad1.png', 2500, '마우스패드'),
('마이크로닉스 WIZMAX GP50', 'RGB 조명 포함 고급 패드', 16100, 40, '../uploads/pad2.png', 3000, '마우스패드'),
('Razer FireFly V2', '방수 소재의 게이밍 마우스패드', 77000, 80, '../uploads/pad3.png', 2000, '마우스패드'),
('ASUS ROG MoonStone ACE L', '고무 베이스, 미끄럼 방지 기능', 160000, 100, '../uploads/pad4.png', 2000, '마우스패드'),
('CORSAIR MM700 RGB Extended 3XL Cloth', '친환경 소재 사용한 마우스패드', 2130000, 90, '../uploads/pad5.png', 1500, '마우스패드');
