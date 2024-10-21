-- Tạo bảng roles
CREATE TABLE roles (
    codeRole INT AUTO_INCREMENT PRIMARY KEY,
    nameRole VARCHAR(255)
);

-- Tạo bảng permissions
CREATE TABLE permissions (
    codePermission INT AUTO_INCREMENT PRIMARY KEY,
    namePermission VARCHAR(255)
);

-- Tạo bảng roles_permissions
CREATE TABLE roles_permissions(
    role_permission_id INT AUTO_INCREMENT PRIMARY KEY,
    codeRole INT, -- Khóa ngoại từ bảng roles
    codePermission INT, -- Khóa ngoại từ bảng permissions
    FOREIGN KEY (codeRole) REFERENCES roles(codeRole),
    FOREIGN KEY (codePermission) REFERENCES permissions(codePermission)
);

-- Tạo bảng accounts
CREATE TABLE accounts (
    userName VARCHAR(255) PRIMARY KEY NOT NULL,
    passWord VARCHAR(255),
    email VARCHAR(255),
    fullName VARCHAR(255),
    address  VARCHAR(255),
    phoneNumber VARCHAR(255),
    birth DATE,
    sex TINYINT(1) Default 1,
    avatar VARCHAR(255),
    active TINYINT(1) Default 1,
    dateCreated DATE,
    codeRole INT, -- Khóa ngoại từ bảng roles
    FOREIGN KEY (codeRole) REFERENCES roles(codeRole)
);

-- Tạo bảng payments
CREATE TABLE payments(
    codePayment VARCHAR(255) PRIMARY KEY NOT NULL,
    namePayment VARCHAR(255),
    linkedBank VARCHAR(255)
);

-- Tạo bảng transports
CREATE TABLE transports(
    codeTransport VARCHAR(255) PRIMARY KEY NOT NULL,
    nameTransport VARCHAR(255),
    nameCompany VARCHAR(255)
);

-- Tạo bảng orders
CREATE TABLE orders(
    codeOrder INT AUTO_INCREMENT PRIMARY KEY,
    phoneNumber VARCHAR(255),
    deliveryAddress VARCHAR(255),
    dateCreated DATE,
    dateFinish DATE,
    status VARCHAR(255),
    discounts INT,
    totalPrice FLOAT,
    notes VARCHAR(255),
    userName VARCHAR(255), -- Khóa ngoại từ bảng accounts
    codePayment VARCHAR(255), -- Khóa ngoại từ bảng payments
    codeTransport VARCHAR(255), -- Khóa ngoại từ bảng transports
    FOREIGN KEY (userName) REFERENCES accounts(userName),
    FOREIGN KEY (codePayment) REFERENCES payments(codePayment),
    FOREIGN KEY (codeTransport) REFERENCES transports(codeTransport)
);

-- Tạo bảng discounts
CREATE TABLE discounts(
    codeDiscount INT AUTO_INCREMENT PRIMARY KEY,
    nameDiscount VARCHAR(255),
    percentDiscount INT,
    ConditionDiscount INT,
    beginDate DATE,
    endDate DATE
);

-- Tạo bảng categories
CREATE TABLE categories(
    codeCategory INT AUTO_INCREMENT PRIMARY KEY,
    nameCategory VARCHAR(255),
    parentID INT, -- cấp danh mục
    userNameCreated VARCHAR(255), -- Khóa ngoại từ bảng accounts
    FOREIGN KEY (userNameCreated) REFERENCES accounts(userName)
);

-- Tạo bảng brands
CREATE TABLE brands(
    codeBrand INT AUTO_INCREMENT PRIMARY KEY,
    nameBrand VARCHAR(255)
);

-- Tạo bảng articles
CREATE TABLE articles(
    codeArticle INT AUTO_INCREMENT PRIMARY KEY,
    nameArticle VARCHAR(255),
    userNameCreated VARCHAR(255), -- Khóa ngoại từ bảng accounts
    codeCategory INT, -- Khóa ngoại từ bảng categories
    FOREIGN KEY (userNameCreated) REFERENCES accounts(userName),
    FOREIGN KEY (codeCategory) REFERENCES categories(codeCategory)
);

-- Tạo bảng supplies
CREATE TABLE supplies(
    codeSupplier VARCHAR(255) PRIMARY KEY NOT NULL,
    nameSupplier VARCHAR(255),
    address VARCHAR(255),
    email VARCHAR(255),
    phoneNumber VARCHAR(255),
    brandSupplier VARCHAR(255)
);

-- Tạo bảng materials
CREATE TABLE materials(
    codeMaterial INT AUTO_INCREMENT PRIMARY KEY,
    nameMaterial VARCHAR(255)
);

-- Tạo bảng colors
CREATE TABLE colors(
    codeColor INT AUTO_INCREMENT PRIMARY KEY,
    nameColor VARCHAR(255)
);

-- Tạo bảng products
CREATE TABLE products(
    codeProduct INT AUTO_INCREMENT PRIMARY KEY,
    nameProduct VARCHAR(255),
    quantity INT,
    describeSort VARCHAR(255),
    describeDetail VARCHAR(255),
    active TINYINT(1) Default 1,
    price FLOAT,
    imgProduct VARCHAR(255),
    codeBrand INT, -- Khóa ngoại từ bảng brands
    codeCategory INT, -- Khóa ngoại từ bảng categories
    codeMaterial INT, -- Khóa ngoại từ bảng materials
    codeSupplier VARCHAR(255), -- Khóa ngoại từ bảng supplies
    codeDiscount INT, -- Khóa ngoại từ bảng discounts
    FOREIGN KEY (codeBrand) REFERENCES brands(codeBrand),
    FOREIGN KEY (codeCategory) REFERENCES categories(codeCategory),
    FOREIGN KEY (codeMaterial) REFERENCES materials(codeMaterial),
    FOREIGN KEY (codeSupplier) REFERENCES supplies(codeSupplier),
    FOREIGN KEY (codeDiscount) REFERENCES discounts(codeDiscount)
);
-- Tạo bảng comments
CREATE TABLE comments(
    codeComment INT AUTO_INCREMENT PRIMARY KEY,
    comment VARCHAR(255),
    sentDate DATE,
    active TINYINT(1) Default 1,
    likeNumber INT,
    dislikeNumber INT,
    userNameComment VARCHAR(255), -- Khóa ngoại từ bảng accounts
    userNameRepComment VARCHAR(255), -- Khóa ngoại từ bảng accounts
    codeProduct INT, -- Khóa ngoại từ bảng products
    FOREIGN KEY (userNameComment) REFERENCES accounts(userName),
    FOREIGN KEY (userNameRepComment) REFERENCES accounts(userName),
    FOREIGN KEY (codeProduct) REFERENCES products(codeProduct)
);

-- Tạo bảng products_colors
CREATE TABLE products_colors(
    product_color_id INT AUTO_INCREMENT PRIMARY KEY,
    codeProduct INT, -- Khóa ngoại từ bảng products
    codeColor INT, -- Khóa ngoại từ bảng colors
    FOREIGN KEY (codeProduct) REFERENCES products(codeProduct),
    FOREIGN KEY (codeColor) REFERENCES colors(codeColor)
);

-- Tạo bảng orders_detail
CREATE TABLE orders_detail(
    nameProduct VARCHAR(255),
    quantity INT,
    priceProduct FLOAT,
    totalPrice FLOAT,
    codeOrder INT, -- Khóa ngoại từ bảng orders
    codeProduct INT, -- Khóa ngoại từ bảng products
    FOREIGN KEY (codeOrder) REFERENCES orders(codeOrder),
    FOREIGN KEY (codeProduct) REFERENCES products(codeProduct)
);

-- Tạo bảng subjects
CREATE TABLE subjects(
    codeSubject INT AUTO_INCREMENT PRIMARY KEY,
    nameSubject VARCHAR(255)
);

-- Tạo bảng contacts
CREATE TABLE contacts(
    codeContact INT AUTO_INCREMENT PRIMARY KEY,
    fullName VARCHAR(255),
    phoneNumber VARCHAR(255),
    email VARCHAR(255),
    content TEXT,
    dateCreated DATE,
    codeSubject INT, -- Khóa ngoại từ bảng subjects
    FOREIGN KEY (codeSubject) REFERENCES subjects(codeSubject)
);

-- Tạo bảng wish_list
CREATE TABLE wish_list(
    codeWishList int AUTO_INCREMENT PRIMARY KEY,
    userName VARCHAR(255), -- Khóa ngoại từ bảng accounts
    codeProduct INT, -- Khóa ngoại từ bảng products
    quantity INT, 
    FOREIGN KEY (userName) REFERENCES accounts(userName),
    FOREIGN KEY (codeProduct) REFERENCES products(codeProduct)
);


-- Thêm dữ liệu cho bảng roles
INSERT INTO roles (nameRole) VALUES 
('admin'),
('user');

-- Thêm dữ liệu cho bảng permissions
INSERT INTO permissions (namePermission) VALUES 
('view_users'),
('edit_users'),
('delete_users'),
('view_products'),
('edit_products'),
('delete_products'),
('manage_orders');

-- Thêm dữ liệu cho bảng roles_permissions
INSERT INTO roles_permissions (codeRole, codePermission) VALUES 
(1, 1), -- admin có quyền view_users
(1, 2), -- admin có quyền edit_users
(1, 3), -- admin có quyền delete_users
(1, 4), -- admin có quyền view_products
(1, 5), -- admin có quyền edit_products
(1, 6), -- admin có quyền delete_products
(1, 7), -- admin có quyền manage_orders
(2, 4), -- user có quyền view_products
(2, 7); -- user có quyền manage_orders

-- Thêm dữ liệu cho bảng accounts
INSERT INTO accounts (userName, passWord, email, fullName, address, phoneNumber, birth, sex, avatar, active, dateCreated, codeRole) VALUES 
('admin1', 'password123', 'admin1@example.com', 'Admin One', '123 Admin St', '1234567890', '1985-01-01', 1, 'avatar1.jpg', 1, '2024-01-01', 1),
('user1', 'password123', 'user1@example.com', 'User One', '123 User St', '0987654321', '1990-05-15', 1, 'avatar2.jpg', 1, '2024-01-01', 2),
('user2', 'password123', 'user2@example.com', 'User Two', '456 User St', '1122334455', '1992-07-22', 0, 'avatar3.jpg', 1, '2024-01-01', 2),
('user3', 'password123', 'user3@example.com', 'User Three', '789 User St', '2233445566', '1993-11-30', 1, 'avatar4.jpg', 1, '2024-01-01', 2),
('user4', 'password123', 'user4@example.com', 'User Four', '101 User St', '3344556677', '1988-04-10', 1, 'avatar5.jpg', 1, '2024-01-01', 2),
('user5', 'password123', 'user5@example.com', 'User Five', '202 User St', '4455667788', '1989-08-20', 0, 'avatar6.jpg', 1, '2024-01-01', 2),
('user6', 'password123', 'user6@example.com', 'User Six', '303 User St', '5566778899', '1995-02-25', 1, 'avatar7.jpg', 1, '2024-01-01', 2);

-- Thêm dữ liệu cho bảng payments
INSERT INTO payments (codePayment, namePayment, linkedBank) VALUES 
('PAY001', 'Credit Card', 'Bank A'),
('PAY002', 'PayPal', 'PayPal Inc.'),
('PAY003', 'Bank Transfer', 'Bank B'),
('PAY004', 'Cash on Delivery', NULL),
('PAY005', 'Google Pay', 'Bank C'),
('PAY006', 'Apple Pay', 'Bank D'),
('PAY007', 'Bitcoin', 'Crypto Exchange');

-- Thêm dữ liệu cho bảng transports
INSERT INTO transports (codeTransport, nameTransport, nameCompany) VALUES 
('TRANS001', 'Standard Shipping', 'Logistics Co.'),
('TRANS002', 'Express Shipping', 'Fast Logistics'),
('TRANS003', 'Overnight Shipping', 'Speedy Delivery'),
('TRANS004', 'Drone Delivery', 'Airborne Inc.'),
('TRANS005', 'Pickup in Store', 'Local Store'),
('TRANS006', 'International Shipping', 'Global Freight'),
('TRANS007', 'Courier Service', 'Quick Couriers');

-- Thêm dữ liệu cho bảng orders
INSERT INTO orders (phoneNumber, deliveryAddress, dateCreated, dateFinish, status, discounts, totalPrice, notes, userName, codePayment, codeTransport) VALUES 
('1234567890', '123 Admin St', '2024-01-01', '2024-01-05', 'Completed', 10, 1000.00, 'N/A', 'admin1', 'PAY001', 'TRANS001'),
('0987654321', '123 User St', '2024-02-10', '2024-02-15', 'Pending', 0, 200.00, 'Deliver on weekend', 'user1', 'PAY002', 'TRANS002'),
('1122334455', '456 User St', '2024-03-20', '2024-03-22', 'Cancelled', 5, 500.00, 'Changed mind', 'user2', 'PAY003', 'TRANS003'),
('2233445566', '789 User St', '2024-04-25', '2024-04-30', 'Shipped', 15, 300.00, 'Gift wrap', 'user3', 'PAY004', 'TRANS004'),
('3344556677', '101 User St', '2024-05-05', '2024-05-10', 'Completed', 0, 150.00, 'Urgent', 'user4', 'PAY005', 'TRANS005'),
('4455667788', '202 User St', '2024-06-15', '2024-06-20', 'Processing', 10, 250.00, 'Deliver in evening', 'user5', 'PAY006', 'TRANS006'),
('5566778899', '303 User St', '2024-07-22', '2024-07-25', 'Returned', 20, 750.00, 'Defective item', 'user6', 'PAY007', 'TRANS007');

-- Thêm dữ liệu cho bảng discounts
INSERT INTO discounts (nameDiscount, percentDiscount, ConditionDiscount, beginDate, endDate) VALUES 
('New Year Sale', 20, 500, '2024-01-01', '2024-01-31'),
('Black Friday', 50, 1000, '2024-11-29', '2024-11-30'),
('Summer Sale', 30, 300, '2024-06-01', '2024-06-30'),
('Christmas Sale', 25, 400, '2024-12-24', '2024-12-25'),
('Clearance Sale', 40, 200, '2024-08-01', '2024-08-31'),
('Birthday Special', 15, 100, '2024-02-01', '2024-02-28'),
('Anniversary Sale', 35, 600, '2024-03-15', '2024-03-31');

-- Thêm dữ liệu cho bảng categories
INSERT INTO categories (nameCategory, parentID, userNameCreated) VALUES 
('Watches', NULL, 'admin1'),
('Smartwatches', 1, 'admin1'),
('Luxury Watches', 1, 'user1'),
('Sport Watches', 1, 'user1'),
('Fashion Watches', 1, 'user2'),
('Classic Watches', 1, 'user3'),
('Accessories', NULL, 'user4');

-- Thêm dữ liệu cho bảng brands
INSERT INTO brands (nameBrand) VALUES 
('Rolex'),
('Omega'),
('Tag Heuer'),
('Casio'),
('Seiko'),
('Apple'),
('Garmin');

-- Thêm dữ liệu cho bảng articles
INSERT INTO articles (nameArticle, userNameCreated, codeCategory) VALUES 
('How to Choose a Watch', 'admin1', 1),
('The Evolution of Smartwatches', 'admin1', 2),
('Top 10 Luxury Watch Brands', 'user1', 3),
('Best Sport Watches for Athletes', 'user1', 4),
('Latest Fashion Watch Trends', 'user2', 5),
('Why Classic Watches are Timeless', 'user3', 6),
('Essential Accessories for Your Watch', 'user4', 7);

-- Thêm dữ liệu cho bảng supplies
INSERT INTO supplies (codeSupplier, nameSupplier, address, email, phoneNumber, brandSupplier) VALUES 
('SUP001', 'Supplier One', '123 Supply St', 'supplier1@example.com', '1234567890', 'Rolex'),
('SUP002', 'Supplier Two', '456 Supply St', 'supplier2@example.com', '0987654321', 'Omega'),
('SUP003', 'Supplier Three', '789 Supply St', 'supplier3@example.com', '1122334455', 'Tag Heuer'),
('SUP004', 'Supplier Four', '101 Supply St', 'supplier4@example.com', '2233445566', 'Casio'),
('SUP005', 'Supplier Five', '202 Supply St', 'supplier5@example.com', '3344556677', 'Seiko'),
('SUP006', 'Supplier Six', '303 Supply St', 'supplier6@example.com', '4455667788', 'Apple'),
('SUP007', 'Supplier Seven', '404 Supply St', 'supplier7@example.com', '5566778899', 'Garmin');

-- Thêm dữ liệu cho bảng materials
INSERT INTO materials (nameMaterial) VALUES 
('Stainless Steel'),
('Leather'),
('Gold'),
('Titanium'),
('Rubber'),
('Silicone'),
('Carbon Fiber');

-- Thêm dữ liệu cho bảng colors
INSERT INTO colors (nameColor) VALUES 
('Black'),
('White'),
('Silver'),
('Gold'),
('Blue'),
('Red'),
('Green');

-- Thêm dữ liệu cho bảng products
INSERT INTO products (nameProduct, quantity, describeSort, describeDetail, active, price, imgProduct, codeBrand, codeCategory, codeMaterial, codeSupplier, codeDiscount) VALUES 
('Rolex Submariner', 10, 'Luxury Dive Watch', 'The Rolex Submariner is a line of sports watches...', 1, 15000.00, 'rolex_submariner.jpg', 1, 3, 1, 'SUP001', 1),
('Omega Seamaster', 15, 'Professional Diver Watch', 'The Omega Seamaster has been the choice...', 1, 8000.00, 'omega_seamaster.jpg', 2, 3, 4, 'SUP002', 2),
('Tag Heuer Carrera', 20, 'Racing Chronograph', 'The Tag Heuer Carrera is inspired by...', 1, 5000.00, 'tag_heuer_carrera.jpg', 3, 4, 2, 'SUP003', 3),
('Casio G-Shock', 25, 'Durable Sports Watch', 'The Casio G-Shock is known for its...', 1, 100.00, 'casio_gshock.jpg', 4, 4, 5, 'SUP004', 4),
('Seiko 5', 30, 'Affordable Automatic Watch', 'The Seiko 5 is a popular choice for...', 1, 150.00, 'seiko_5.jpg', 5, 5, 1, 'SUP005', 5),
('Apple Watch', 40, 'Smartwatch', 'The Apple Watch is a leading smartwatch...', 1, 400.00, 'apple_watch.jpg', 6, 2, 6, 'SUP006', 6),
('Garmin Fenix', 35, 'Outdoor Smartwatch', 'The Garmin Fenix is built for adventurers...', 1, 600.00, 'garmin_fenix.jpg', 7, 4, 7, 'SUP007', 7),
('Tissot Le Locle', 20, 'Automatic Watch', 'Tissot Le Locle is a classic automatic watch...', 1, 500.00, 'tissot_lelocle.jpg', 3, 6, 1, 'SUP002', 1),
('Breitling Navitimer', 10, 'Pilot\'s Watch', 'The Breitling Navitimer is a renowned pilot\'s watch...', 1, 7500.00, 'breitling_navitimer.jpg', 1, 3, 4, 'SUP001', 2),
('Fossil Grant', 25, 'Chronograph Watch', 'Fossil Grant is a stylish chronograph watch...', 1, 150.00, 'fossil_grant.jpg', 4, 5, 2, 'SUP004', 5),
('Citizen Eco-Drive', 30, 'Solar Powered Watch', 'Citizen Eco-Drive is powered by light...', 1, 300.00, 'citizen_ecodrive.jpg', 5, 5, 1, 'SUP005', 3),
('Hublot Big Bang', 5, 'Luxury Sports Watch', 'Hublot Big Bang is a luxury sports watch...', 1, 12000.00, 'hublot_bigbang.jpg', 1, 3, 7, 'SUP003', 4),
('Swatch Sistem51', 40, 'Automatic Swatch', 'Swatch Sistem51 is an automatic watch...', 1, 100.00, 'swatch_sistem51.jpg', 6, 4, 5, 'SUP006', 6),
('Panerai Luminor', 8, 'Italian Luxury Watch', 'Panerai Luminor is a luxury Italian watch...', 1, 9000.00, 'panerai_luminor.jpg', 2, 3, 6, 'SUP002', 7),
('Longines Master', 15, 'Elegant Dress Watch', 'Longines Master is an elegant dress watch...', 1, 2500.00, 'longines_master.jpg', 7, 6, 1, 'SUP007', 1),
('Hamilton Khaki Field', 18, 'Military Watch', 'Hamilton Khaki Field is inspired by military watches...', 1, 600.00, 'hamilton_khakifield.jpg', 4, 4, 4, 'SUP004', 5),
('Patek Philippe Nautilus', 5, 'Luxury Sports Watch', 'Patek Philippe Nautilus is an iconic luxury sports watch...', 1, 30000.00, 'patek_philippe_nautilus.jpg', 1, 3, 2, 'SUP001', 2),
('Omega Seamaster', 12, 'Diver\'s Watch', 'Omega Seamaster is a famous diver\'s watch...', 1, 4500.00, 'omega_seamaster.jpg', 3, 2, 1, 'SUP002', 3),
('Rolex Submariner', 7, 'Iconic Diver\'s Watch', 'The Rolex Submariner is an iconic diver\'s watch...', 1, 8500.00, 'rolex_submariner.jpg', 1, 2, 4, 'SUP001', 4),
('Tag Heuer Carrera', 20, 'Racing Watch', 'Tag Heuer Carrera is a stylish racing watch...', 1, 3200.00, 'tagheuer_carrera.jpg', 2, 4, 2, 'SUP003', 5),
('Casio G-Shock', 50, 'Durable Sports Watch', 'Casio G-Shock is known for its durability...', 1, 200.00, 'casio_gshock.jpg', 6, 5, 5, 'SUP006', 6),
('Seiko Presage', 25, 'Elegant Dress Watch', 'Seiko Presage combines elegance and precision...', 1, 800.00, 'seiko_presage.jpg', 5, 6, 3, 'SUP005', 7),
('Audemars Piguet Royal Oak', 5, 'Luxury Sports Watch', 'Audemars Piguet Royal Oak is a luxury sports watch...', 1, 25000.00, 'ap_royal_oak.jpg', 1, 3, 7, 'SUP003', 2),
('Tudor Black Bay', 15, 'Diver\'s Watch', 'Tudor Black Bay is a modern diver\'s watch...', 1, 3500.00, 'tudor_black_bay.jpg', 3, 2, 4, 'SUP002', 1),
('IWC Pilot\'s Watch', 10, 'Aviation Watch', 'IWC Pilot\'s Watch is designed for aviation...', 1, 5000.00, 'iwc_pilot_watch.jpg', 7, 3, 6, 'SUP007', 4);



-- Thêm dữ liệu cho bảng comments
INSERT INTO comments (comment, sentDate, active, likeNumber, dislikeNumber, userNameComment, userNameRepComment, codeProduct) VALUES 
('Great watch!', '2024-01-02', 1, 5, 0, 'user1', 'user2', 1),
('Not worth the price.', '2024-02-10', 1, 2, 3, 'user3', 'user1', 2),
('Would recommend.', '2024-03-15', 1, 4, 1, 'user2', 'user4', 3),
('Excellent durability.', '2024-04-20', 1, 6, 0, 'user4', 'user3', 4),
('Affordable and reliable.', '2024-05-25', 1, 3, 1, 'user5', 'user2', 5),
('Love the features.', '2024-06-30', 1, 7, 0, 'user6', 'user1', 6),
('Perfect for outdoors.', '2024-07-15', 1, 5, 2, 'user2', 'user5', 7);

-- Thêm dữ liệu cho bảng products_colors
INSERT INTO products_colors (codeProduct, codeColor) VALUES 
(1, 3), -- Rolex Submariner - Silver
(2, 3), -- Omega Seamaster - Silver
(3, 1), -- Tag Heuer Carrera - Black
(4, 1), -- Casio G-Shock - Black
(5, 4), -- Seiko 5 - Gold
(6, 2), -- Apple Watch - White
(7, 5); -- Garmin Fenix - Blue

-- Thêm dữ liệu cho bảng orders_detail
INSERT INTO orders_detail (nameProduct, quantity, priceProduct, totalPrice, codeOrder, codeProduct) VALUES 
('Rolex Submariner', 1, 15000.00, 15000.00, 1, 1),
('Omega Seamaster', 1, 8000.00, 8000.00, 2, 2),
('Tag Heuer Carrera', 2, 5000.00, 10000.00, 3, 3),
('Casio G-Shock', 3, 100.00, 300.00, 4, 4),
('Seiko 5', 1, 150.00, 150.00, 5, 5),
('Apple Watch', 1, 400.00, 400.00, 6, 6),
('Garmin Fenix', 2, 600.00, 1200.00, 7, 7);

-- Thêm dữ liệu cho bảng subjects
INSERT INTO subjects (nameSubject) VALUES 
('Customer Support'),
('Technical Support'),
('Sales Inquiry'),
('General Inquiry'),
('Partnership'),
('Feedback'),
('Complaint');

-- Thêm dữ liệu cho bảng contacts
INSERT INTO contacts (fullName, phoneNumber, email, content, dateCreated, codeSubject) VALUES 
('John Doe', '1234567890', 'john@example.com', 'Need help with an order.', '2024-01-05', 1),
('Jane Smith', '0987654321', 'jane@example.com', 'Interested in buying.', '2024-02-15', 3),
('Bill Gates', '1122334455', 'bill@example.com', 'Technical issue with the website.', '2024-03-25', 2),
('Elon Musk', '2233445566', 'elon@example.com', 'Looking to partner.', '2024-04-30', 5),
('Warren Buffett', '3344556677', 'warren@example.com', 'General inquiry about your products.', '2024-05-10', 4),
('Jeff Bezos', '4455667788', 'jeff@example.com', 'Feedback on recent purchase.', '2024-06-20', 6),
('Mark Zuckerberg', '5566778899', 'mark@example.com', 'Not satisfied with the service.', '2024-07-25', 7);
