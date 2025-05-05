-- init.sql 최상단에 추가
SET NAMES utf8mb4;
SET CHARACTER SET utf8mb4;

CREATE DATABASE IF NOT EXISTS kisia_market CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE kisia_market;

-- 유저 테이블 생성
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    userId VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(50) NOT NULL,
    phone VARCHAR(20),
    address VARCHAR(255),
    postcode VARCHAR(10),
    address_detail VARCHAR(255),
    point INT DEFAULT 0,
    role VARCHAR(10) NOT NULL DEFAULT 'USER',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- 유저 초기 데이터 삽입 
INSERT INTO users (userId, email, password, name, phone, address, postcode, address_detail)
VALUES 
('test', 'testuser01@example.com', '1234', '테스트유저', '01000000000', '서울시 강남구 테헤란로 123', '12345', '2층 123호'),
('admin', 'admin@admin.com', 'admin', '관리자 계정', '01012345678', '서울시 강남구 테헤란로 123', '12345', '2층 12호');



-- 공지사항 테이블 생성
CREATE TABLE IF NOT EXISTS notices (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- 공지사항 초기 데이터 삽입  
INSERT INTO notices (title, content) VALUES
('서비스 점검 안내', '안녕하세요. 5월 3일 오전 2시부터 4시까지 서버 점검이 예정되어 있습니다.'),
('신규 기능 출시', '이번 주부터 새로운 검색 기능이 추가됩니다. 많은 이용 바랍니다.'),
('이벤트 당첨자 발표', '4월 이벤트의 당첨자가 발표되었습니다. 자세한 내용은 이벤트 페이지를 확인해 주세요.');

-- 문의글 테이블
CREATE TABLE IF NOT EXISTS inquiry (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    title VARCHAR(255),
    content TEXT,
    is_secret BOOLEAN,
    type VARCHAR(50) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    secret_password VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- 문의글 초기 데이터 삽입 
INSERT INTO inquiry (user_id, title, content, is_secret, type, secret_password)
VALUES 
(1, '배송 문의', '언제쯤 배송되나요?', FALSE, '배송', ''),
(1, '상품 상태 문의', '박스가 찌그러졌어요. 교환 가능한가요?', TRUE, '상품', '1234'),
(1, '취소 요청', '결제를 했는데 주문 취소하고 싶습니다.', FALSE, '주문/결제', '');

-- 문의글 이미지 테이블
CREATE TABLE IF NOT EXISTS inquiry_images (
    id INT PRIMARY KEY AUTO_INCREMENT,
    inquiry_id INT,
    image_url VARCHAR(255),
    uploaded_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (inquiry_id) REFERENCES inquiry(id) ON DELETE CASCADE
);

-- 문의글 이미지 초기 데이터 삽입 
-- INSERT INTO inquiry_images (inquiry_id, image_url)
-- VALUES
-- (1, '/uploads/inquiries/box1.jpg'),
-- (2, '/uploads/inquiries/damaged_box.jpg'),
-- (2, '/uploads/inquiries/detail_view.png');

-- 상품 테이블 생성
CREATE TABLE IF NOT EXISTS products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  short_description VARCHAR(255),
  description TEXT,
  price INT NOT NULL,
  stock INT DEFAULT 0,
  image_url VARCHAR(500),
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  deliver_price INT DEFAULT 0,
  category VARCHAR(255) NOT NULL
);

-- 액세서리 6개 /초고속 전송 속도를 제공하는 외장 SSD
INSERT INTO products (name, short_description, description, price, stock, image_url, deliver_price, category) VALUES
('삼성 ssd T7 1TB', '고속 전송이 가능한 1TB 외장 SSD, 휴대용 저장 장치', 'product_dec/accessory/samsungssdT7.jpg', 1480000, 100, 'uploads/etc1.png', 2000, 'accessory'),
('앱코 게이밍 헤드셋', '가성비 좋은 유선 게이밍 헤드셋, 입문자용으로 인기', 'product_dec/accessory/abckoheadset.jpg', 34000, 50, 'uploads/etc2.png', 2500, 'accessory'),
('캔스톤 F1BT', '블루투스 스피커 기능이 있는 고출력 사운드바', 'product_dec/accessory/canstone.jpg', 70000, 80, 'uploads/etc3.png', 2500, 'accessory'),
('아펙스 4 블루투스 게임패드', '콘솔과 PC에 모두 호환되는 무선 게임 컨트롤러', '업데이트 예정', 180000, 60, 'uploads/etc4.png', 2500, 'accessory'),
('닌텐도 스위치 OLED', '개선된 OLED 화면을 갖춘 닌텐도 최신 휴대용 게임기', 'product_dec/accessory/nintendooled.jpg', 370000, 150, 'uploads/etc5.png', 1500, 'accessory'),
('삼성전자 SL-C510', '컬러 출력이 가능한 삼성 레이저 프린터', 'product_dec/accessory/samsungSL-C510.jpg', 180000, 200, 'uploads/etc6.png', 1000, 'accessory');

-- 키보드 5개
INSERT INTO products (name, short_description, description, price, stock, image_url, deliver_price, category) VALUES
('한성컴퓨터 GK698', '기계식 배열의 가성비 좋은 키보드, RGB 백라이트 탑재', '업데이트 예정', 39000, 70, 'uploads/keyboard1.png', 3000, 'keyboard'),
('AULA F87 Pro', '텐키리스 레이아웃, 게이머를 위한 기계식 키보드', 'product_dec/keyboard/AULA F87 Pro.jpg', 67000, 90, 'uploads/keyboard2.png', 2000, 'keyboard'),
('로지텍 MX Keys Mini for Mac', '맥 사용자에 최적화된 컴팩트 무선 키보드', '업데이트 예정', 125000, 40, 'uploads/keyboard3.png', 3000, 'keyboard'),
('Razer Huntsman V2 TKL KR', '광축을 사용하는 고성능 게이밍 키보드', 'product_dec/keyboard/Razer Huntsman V2 TKL KR.jpg', 189000, 75, 'uploads/keyboard4.png', 2500, 'keyboard'),
('ASUS ROG FALCHION ACE HFX', '컴팩트 디자인에 프로 게이머급 성능 탑재', 'product_dec/keyboard/ASUS ROG FALCHION ACE HFX.jpg', 29900, 100, 'uploads/keyboard5.png', 2000, 'keyboard');

-- 마우스 6개
INSERT INTO products (name, short_description, description, price, stock, image_url, deliver_price, category) VALUES
('로지텍 지슈라', '고성능 FPS 게이밍 마우스, 빠른 반응속도', 'product_dec/mouse/logitecgsuper.jpg', 139000, 50, 'uploads/mouse1.png', 3000, 'mouse'),
('Razer Viper V3 Pro', '초경량 디자인의 고사양 무선 마우스', 'product_dec/mouse/Razer Viper V3 Pro.jpg', 329000, 100, 'uploads/mouse2.png', 2000, 'mouse'),
('삼성 마우스', '사무용으로 적합한 보급형 유선 마우스', 'product_dec/mouse/samsungmouse.jpg', 9900, 70, 'uploads/mouse3.png', 2500, 'mouse'),
('앱코 A660', '가성비 좋은 센서를 탑재한 보급형 마우스', 'product_dec/mouse/abckomouse.jpg', 27000, 150, 'uploads/mouse4.png', 2000, 'mouse'),
('펄사 X2H 미니 무선 게이밍 마우스', '초경량 무선 마우스, 손이 작은 유저에게 적합', 'product_dec/mouse/pulsarmouse.jpg', 83300, 30, 'uploads/mouse5.png', 3000, 'mouse'),
('CORSAIR DARKSTAR', 'MMO 게임에 특화된 다버튼 무선 마우스', 'product_dec/mouse/CORSAIR DARKSTAR.jpg', 187000, 120, 'uploads/mouse6.png', 1500, 'mouse');

-- 마우스패드 5개
INSERT INTO products (name, short_description, description, price, stock, image_url, deliver_price, category) VALUES
('로지텍 POWERPLAY 2', '무선 충전 기능을 지원하는 하이엔드 마우스패드', 'product_dec/mousepad/logitecpowerfly.jpg', 142000, 60, 'uploads/pad1.png', 2500, 'mousepad'),
('마이크로닉스 WIZMAX GP50', '기본에 충실한 저가형 마우스패드', 'product_dec/mousepad/micronixWIZMAX GP50.jpg', 16100, 40, 'uploads/pad2.png', 3000, 'mousepad'),
('Razer FireFly V2', 'RGB 조명이 화려한 게이밍 마우스패드', 'product_dec/mousepad/Razer FireFly V2.jpg', 77000, 80, 'uploads/pad3.png', 2000, 'mousepad'),
('ASUS ROG MoonStone ACE L', '단단한 소재의 프리미엄 대형 패드', 'product_dec/mousepad/ASUS ROG MoonStone ACE L.jpg', 160000, 100, 'uploads/pad4.png', 2000, 'mousepad'),
('CORSAIR MM700 RGB', '초대형 RGB 패브릭 패드, 책상 전체를 덮는 크기', 'product_dec/mousepad/CORSAIR MM700 RGB Extended 3XL Cloth.jpg', 213000, 90, 'uploads/pad5.png', 1500, 'mousepad');

-- 장바구니 테이블 생성
CREATE TABLE cart_items (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL DEFAULT 1,
    added_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (product_id) REFERENCES products(id),
    UNIQUE (user_id, product_id)
);

INSERT INTO cart_items (user_id, product_id, quantity, added_at) VALUES 
(1, 5, 2, '2025-05-04 10:23:45'),
(1, 6, 1, '2025-05-04 11:05:12'),
(1, 7, 3, '2025-05-04 11:15:30');

-- 리뷰 테이블 생성
CREATE TABLE reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    product_id INT,
    content TEXT NOT NULL,
    rating INT CHECK (rating BETWEEN 1 AND 5),
    image_url VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

-- 리뷰 초기 데이터 삽입
INSERT INTO reviews (user_id, product_id, content, rating, image_url, created_at)
VALUES 
(1, 22, '정말 만족스러운 상품이에요!', 5, 'review_images/review1.png', '2024-05-01 10:30:00'),
(1, 22, '생각보다 품질이 떨어지네요.', 2, NULL, '2024-05-02 14:20:00'),
(1, 22, '배송이 빨랐고, 제품도 좋아요.', 4, 'review_images/review2.png', '2024-05-03 09:10:00'),
(1, 22, '가격 대비 괜찮습니다.', 3, NULL, '2024-05-03 11:45:00');

-- 주문 테이블 생성
CREATE TABLE orders (
  id INT PRIMARY KEY AUTO_INCREMENT,           -- 주문 고유 ID
  user_id INT NOT NULL,                        -- 주문한 사용자 (users 테이블 참조)
  user_name VARCHAR(100),                      -- 주문자 이름

  order_amount INT NOT NULL,                   -- 총 주문 금액
  order_status ENUM('pending', 'paid', 'cancelled') DEFAULT 'pending', -- 주문 상태
  payment_method ENUM('bank_transfer', 'point') NOT NULL, -- 결제 방식

  depositor_name VARCHAR(100),                 -- 사용자가 입력한 입금자명
  bank_name VARCHAR(100),                      -- 입금은행
  deposit_confirmed BOOLEAN DEFAULT FALSE,     -- 입금 확인 여부
  deposit_confirmed_at DATETIME NULL,          -- 입금 확인 시각

  receiver_name VARCHAR(100),                  -- 수령인 이름
  receiver_phone VARCHAR(20),                  -- 수령인 연락처
  receiver_email VARCHAR(100),                 -- 이메일 주소
  receiver_address VARCHAR(255),               -- 배송지 주소
  receiver_postcode VARCHAR(10),                     -- 우편번호
  receiver_address_detail VARCHAR(255),              -- 상세주소
  delivery_memo VARCHAR(255),              -- 배송 메모

  order_created_at DATETIME DEFAULT NOW()      -- 주문 생성 시각
);

CREATE TABLE order_items (
  id INT PRIMARY KEY AUTO_INCREMENT,
  order_id INT NOT NULL,                    -- 주문 ID (orders 테이블 FK)
  product_id INT NOT NULL,                  -- 상품 ID (products 테이블 FK)
  product_name VARCHAR(255) NOT NULL,        -- 상품 이름
  product_image_url VARCHAR(255) NOT NULL,   -- 상품 이미지 URL
  quantity INT NOT NULL,                    -- 수량
  price INT NOT NULL,                       -- 주문 당시 단가 (스냅샷용)
  deliver_price INT NOT NULL,               -- 배송비

  FOREIGN KEY (order_id) REFERENCES orders(id),
  FOREIGN KEY (product_id) REFERENCES products(id)
);
