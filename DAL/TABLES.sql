-- Tạo bảng đối tượng Accounts

CREATE TABLE accounts
(
       userName VARCHAR(255) PRIMARY KEY NOT NULL,
       passWord VARCHAR(255),
       dateCreated DATE,
       accountStatus VARCHAR(255),
       name VARCHAR(255),
       address VARCHAR(255),
       email VARCHAR(255),
       phoneNumber VARCHAR(255),
       birth DATE,
       sex VARCHAR(255),
       codePermissions VARCHAR(255)
);

-- Tạo đối tượng Feedback 
USE  website_sells_clothes_and_bags;
CREATE TABLE feedback
(
       codeFeedback VARCHAR(255) PRIMARY KEY NOT NULL,
       userName VARCHAR(255),
       sentDate DATE,
       email VARCHAR(255),
       content TEXT,
       -- Adjust the data type based on your database system (e.g., VARCHAR(MAX) for SQL Server, TEXT for MySQL)
       replay TEXT
);

-- USE  website_sells_clothes_and_bags;
-- DROP TABLE IF EXISTS feedback;

-- Tạo đối tượng Comment
USE  website_sells_clothes_and_bags;
CREATE TABLE Comment
(
       codeComment VARCHAR(255) PRIMARY KEY NOT NULL,
       productCode VARCHAR(255),
       userNameComment VARCHAR(255),
       userNameRepComment VARCHAR(255),
       sentDate DATE,
       content TEXT,
       state VARCHAR(255),
       likeNumber INT,
       dislikeNumber INT
);
-- USE  website_sells_clothes_and_bags;
-- DROP TABLE IF EXISTS comment;



-- Tạo đối tượng Permissions

CREATE TABLE permissions
(
       -- Code representing the permission (Primary Key, Not Null)
       codePermissions VARCHAR(255) PRIMARY KEY NOT NULL,

       -- Name describing the permission
       namePermissions VARCHAR(255)
);

-- Tạo đối tượng Functions

CREATE TABLE functions
(
       -- Code representing the function (Primary Key, Not Null)
       functionCode VARCHAR(255) PRIMARY KEY NOT NULL,

       -- Name of the function
       functionName VARCHAR(255)
);

-- Tạo đối tượng PermissionsDetail

CREATE TABLE permissionsDetail
(
       -- Foreign Key referencing the Permissions table
       codePermissions VARCHAR(255),

       -- Foreign Key referencing the Functions table
       functionCode VARCHAR(255),

       -- Permissions columns
       addPermission INT,
       seePermission INT,
       deletePermission INT,
       fixPermission INT
);

-- Tạo đối tượng Orders

CREATE TABLE orders
(
       -- Primary Key, Not Null
       orderCode VARCHAR(255) PRIMARY KEY NOT NULL,

       deliveryAddress VARCHAR(255),

       -- Dates
       dateCreated DATE,
       dateDelivery DATE,
       dateFinish DATE,

       -- User information
       userName VARCHAR(255),

       -- Financial information
       totalMoney FLOAT,

       -- Payment and transport codes
       -- Thuộc tính khóa ngoại tham chiếu 
       codePayments VARCHAR(255),
       codeTransport VARCHAR(255),

       -- Order status
       status VARCHAR(255),

       -- Additional notes
       note VARCHAR(255)
);

-- Tạo đối tượng OrderDetail

CREATE TABLE orderDetail
(
       -- thuộc tính khóa ngoại orderCode và productCode
       orderCode VARCHAR(255),
       productCode VARCHAR(255),
       nameProduct VARCHAR(255),
       priceProduct FLOAT,
       quantity INT,
       sizeCode VARCHAR(255),
       totalMoney FLOAT
);

-- Tạo đối tượng Payment

CREATE TABLE payment
(
       namePayment VARCHAR(255),
       codePayments VARCHAR(255) PRIMARY KEY NOT NULL,
       affiliatedBank VARCHAR(255)
);

-- Tạo bảng đối tượng Transport

CREATE TABLE Transport
(
       nameTransport VARCHAR(255),
       codeTransport VARCHAR(255) PRIMARY KEY NOT NULL,
       affiliatedCompany VARCHAR(255)
);

-- Tạo bảng đối tượng 

CREATE TABLE Product
(
       productCode VARCHAR(255) PRIMARY KEY NOT NULL,
       imgProduct TEXT,
       nameProduct VARCHAR(255),
       supplierCode VARCHAR(255),
       quantity INT,
       describeProduct TEXT,
       status VARCHAR(255),
       color VARCHAR(255),
       targetGender VARCHAR(255),
       price FLOAT,
       promotion FLOAT
);




-- Tạo bảng đối tượng HandbagProduct

CREATE TABLE HandbagProduct
(
       productCode VARCHAR(255),
       bagMaterial VARCHAR(255),
       descriptionMaterial TEXT
);

-- Tao đối tượng ShirtProduct

CREATE TABLE ShirtProduct
(
       productCode VARCHAR(255),
       shirtMaterial VARCHAR(255),
       shirtStyle VARCHAR(255),
       descriptionMaterial TEXT
);

-- Tạo đối tượng ShirtSize

CREATE TABLE ShirtSize
(
       -- thuọc tính kháo ngoại
       sizeCode VARCHAR(255),
       productCode VARCHAR(255),
       quantity INT
);

-- Tạo đối tượng Size

CREATE TABLE Size
(
       sizeCode VARCHAR(255) PRIMARY KEY NOT NULL,
       sizeName VARCHAR(255)
);


-- Tạo đối tượng Supplier

CREATE TABLE Supplier
(
       codeSupplier VARCHAR(255) PRIMARY KEY NOT NULL,
       nameSupplier VARCHAR(255),
       address VARCHAR(255),
       email VARCHAR(255),
       brandSupplier VARCHAR(255),
       phoneNumber VARCHAR(255)
);

-- Tạo các liên kết giữa các bảng với nhau

-- feedback --> account
USE  website_sells_clothes_and_bags;
ALTER TABLE feedback
ADD FOREIGN KEY (userName) REFERENCES accounts(userName);

-- comment --> account
USE  website_sells_clothes_and_bags;
ALTER TABLE comment
ADD FOREIGN KEY (userNameComment) REFERENCES accounts(userName);

-- ALTER TABLE comment
-- ADD FOREIGN KEY (userNameRepComment) REFERENCES accounts(userName);

-- account --> permission
ALTER TABLE accounts
ADD FOREIGN KEY (codePermissions) REFERENCES permissions(codePermissions);

-- permissionDetail --> permission
ALTER TABLE permissionsdetail
ADD FOREIGN KEY (codePermissions) REFERENCES permissions(codePermissions);

-- permissionsDetail --> function
ALTER TABLE permissionsdetail
ADD FOREIGN KEY (functionCode) REFERENCES functions(functionCode);

-- order --> accounts
ALTER TABLE orders
ADD FOREIGN KEY (userName) REFERENCES accounts(userName);

-- orderdetail --> orders
ALTER TABLE orderdetail
ADD FOREIGN KEY (orderCode) REFERENCES orders(orderCode);

-- orderdetail --> product
ALTER TABLE orderdetail
ADD FOREIGN KEY (productCode) REFERENCES product(productCode);

-- handbagproduct --> product
ALTER TABLE handbagproduct
ADD FOREIGN KEY (productCode) REFERENCES product(productCode);

-- shirtproduct --> product
ALTER TABLE shirtproduct
ADD FOREIGN KEY (productCode) REFERENCES product(productCode);


-- shirtsize --> shirtproduct
ALTER TABLE shirtsize
ADD FOREIGN KEY (productCode) REFERENCES shirtproduct(productCode);


-- shirtsize --> size
ALTER TABLE shirtsize
ADD FOREIGN KEY (sizeCode) REFERENCES size(sizeCode);

-- orders --> payment
ALTER TABLE orders
ADD FOREIGN KEY (codePayments) REFERENCES payment(codePayments);

-- orders --> transport
ALTER TABLE orders
ADD FOREIGN KEY (codeTransport) REFERENCES transport(codeTransport);


-- supplier --> product
USE  website_sells_clothes_and_bags;
ALTER TABLE product
ADD FOREIGN KEY (supplierCode) REFERENCES supplier(codeSupplier);



-- filter table

USE  website_sells_clothes_and_bags;
CREATE TABLE filter
(
       filterParent VARCHAR(255),
       filterChild VARCHAR(255)
);















