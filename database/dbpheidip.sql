/* 
	1. Copy content in dbpheidip.sql file and paste into SQL window in MySQL
	2. Click GO to create database
*/

DROP DATABASE IF EXISTS `dbpheidip`;
CREATE DATABASE `dbpheidip`;
USE `dbpheidip`;

DROP TABLE IF EXISTS `tbAdmin`;
CREATE TABLE `tbAdmin`(
    `AdminID` int NOT NULL AUTO_INCREMENT,
    `AdminName` varchar(50) NOT NULL,
    `Password` varchar(50) NOT NULL,
    PRIMARY KEY (AdminID)
);

DROP TABLE IF EXISTS `tbUser_Account`;
CREATE TABLE `tbUser_Account` (
    `UserID` int NOT NULL AUTO_INCREMENT,
    `UserName` varchar(50) NOT NULL,
    `Password` varchar(50) NOT NULL,
    `FullName` varchar(100) NOT NULL,
    `Email` varchar(50) NOT NULL,
    `PhoneNumber` varchar(14) NOT NULL,
    `Status` boolean DEFAULT 1,
    PRIMARY KEY (UserID)
);

DROP TABLE IF EXISTS `tbDelivery_Address`;
CREATE TABLE `tbDelivery_Address`(
    `AddressID` int NOT NULL AUTO_INCREMENT,
    `UserID` int NOT NULL,	
    `Address` text NOT NULL,
    `Is_default` boolean NOT NULL,
    PRIMARY KEY (AddressID)
);


DROP TABLE IF EXISTS `tbPayment`;
CREATE TABLE `tbPayment`(
    `PaymentID` int NOT NULL AUTO_INCREMENT,
    `Method`varchar(40) NOT NULL,
    `Desc` text NOT NULL,
    PRIMARY KEY (PaymentID)
);



DROP TABLE IF EXISTS `tbBrand`;
CREATE TABLE `tbBrand`(
    `BrandID` varchar(10) NOT NULL,
    `BrandName` varchar(40) NOT NULL,
    `Logo` varchar(100) NOT NULL,
    `Desc` text,
    PRIMARY KEY (BrandID)
);

DROP TABLE IF EXISTS `tbType`;
CREATE TABLE `tbType`(
    `TypeID` varchar(10) NOT NULL,
    `TypeName`varchar(40) NOT NULL,
    `Desc` text NOT NULL,
    PRIMARY KEY (TypeID)
);

DROP TABLE IF EXISTS `tbProduct`;
CREATE TABLE `tbProduct`(
    `ProductID` varchar(10) NOT NULL,
    `ProductName` varchar(50) NOT NULL,
    `Price` decimal NOT NULL,
    `Thumbnail` varchar(100) NOT NULL,
    `Image` varchar(100) NOT NULL,
    `BrandID` varchar(10) NOT NULL,
    `TypeID` varchar(10) NOT NULL,
    `Desc` text,
    PRIMARY KEY (ProductID)
);

DROP TABLE IF EXISTS `tbTag`;
CREATE TABLE `tbTag`(
    `TagID` varchar(10) NOT NULL,
    `TagName` varchar(40) NOT NULL,
    `ProductID` varchar(10) NOT NULL,
    `Desc` text NOT NULL,
    PRIMARY KEY (TagID)
);

DROP TABLE IF EXISTS `tbInventory`;
CREATE TABLE `tbInventory`(
    `InventoryID` varchar(10) NOT NULL,
    `ProductID` varchar(10) NOT NULL,
    `Size` varchar(3) NOT NULL,
    `Quantity` int NOT NULL,
    PRIMARY KEY (InventoryID)
);

DROP TABLE IF EXISTS `tbOrder_Details`;
CREATE TABLE `tbOrder_Details`(
    `DetailsID` varchar(10) NOT NULL,
    `InventoryID` varchar(10) NOT NULL,
    `Quantity` int NOt NULL,
    PRIMARY KEY (DetailsID)
);

DROP TABLE IF EXISTS `tbOrder_Master`;
CREATE TABLE `tbOrder_Master`(
    `MasterID` varchar(10) NOT NULL,
    `DetailsID` varchar(10) NOT NULL,
    `UserID` int NOT NULL,
    `PaymentID` int NOT NULL,
    `OrderDate` datetime NOT NULL,
    `Note` text,
    PRIMARY KEY(MasterID)
);


DROP TABLE IF EXISTS `tbNews`;
CREATE TABLE `tbNews`(
    `NewsID` int NOT NULL AUTO_INCREMENT,
    `Title` varchar(100) NOT NULL,
    `Content` text NOT NULL,
    `Image` varchar(100) NOT NULL,
    `NewsDate` datetime NOT NULL,
    PRIMARY KEY (NewsID)
);

DROP TABLE IF EXISTS `tbFeedback`;
CREATE TABLE `tbFeedback`(
    `FeedbackID` int NOT NULL AUTO_INCREMENT,
    `UserID` int,
    `GuestID` int,
    `Content` text NOT NULL,
    `Date` datetime NOT NULL,
    PRIMARY KEY(FeedbackID)
);


DROP TABLE IF EXISTS `tbGuest`;
CREATE TABLE `tbGuest`(
    `GuestID` int NOT NULL,
    `GuestName` varchar(100) NOT NULL,
    `email` varchar(50) NOT NULL,
    `Phone` varchar(14) NOT NULL,
     PRIMARY KEY(GuestId)
);

ALTER TABLE `tbDelivery_Address`
ADD FOREIGN KEY (UserID) REFERENCES tbUser_Account(UserID);

ALTER TABLE `tbProduct`
ADD FOREIGN KEY (BrandID) REFERENCES tbBrand(BrandID),
ADD FOREIGN KEY (TypeID) REFERENCES tbType(TypeID);

ALTER TABLE `tbTag`
ADD FOREIGN KEY (ProductID) REFERENCES tbProduct(ProductID);

ALTER TABLE `tbInventory`
ADD FOREIGN KEY (ProductID) REFERENCES tbProduct(ProductID);

ALTER TABLE `tbOrder_Details`
ADD FOREIGN KEY (InventoryID) REFERENCES tbInventory(InventoryID);

ALTER TABLE `tbOrder_Master`
ADD FOREIGN KEY (DetailsID) REFERENCES tbOrder_Details(DetailsID),
ADD FOREIGN KEY (UserID) REFERENCES tbUser_Account(UserID),
ADD FOREIGN KEY (PaymentID) REFERENCES tbPayment(PaymentID);

ALTER TABLE `tbFeedback`
ADD FOREIGN KEY (UserID) REFERENCES tbUser_Account(UserID),
ADD FOREIGN KEY (GuestID) REFERENCES tbGuest(GuestID);

INSERT INTO `tbAdmin`(`AdminName`, `Password`) VALUES ('admin', '123');

INSERT INTO `tbUser_Account`(`UserName`, `Password`, `FullName`, `Email`, `PhoneNumber`) VALUES ('user01', 'User01', 'Tester San', 'tester01@user.com', '0989796961');

INSERT INTO `tbDelivery_Address`(`UserID`, `Address`, `Is_default`) VALUES (1, '001 Tester, Tired, Nowhere', '1');

INSERT INTO `tbBrand` VALUES
('001NIK', 'Nike', 'img/brand_nike.png', ''),
('002ADI', 'Adidas', 'img/brand_adidas.png', ''),
('003TIM', 'Timberland', 'img/brand_Timberland.png', '');

INSERT INTO `tbType`VALUES 
('001SNE', 'Sneaker', 'Sneaker shoes'),
('002BOO', 'Boots', 'Boots shoes'),
('003SAN', 'Sandals', 'Sandals'),
('004SLI', 'Slippers', 'Slippers');

INSERT INTO `tbProduct` VALUES 	
('PP01', 'Xiaomi', '555', 'img/thumbnail_1.jpg', 'img/image_1.jpg', '001NIK', '001SNE', ''),
('PP02', 'Nike Javascript Ultra', '199', 'img/thumbnail_2.jpg', 'img/image_2.jpg', '001NIK', '001SNE', ''),
('PP03', 'Adidas Ultra Pro Max', '80', 'img/thumbnail_product-4.jpg', 'img/image_product-4.jpg', '002ADI', '001SNE', ''),
('PP04', 'Timberland Boots New Earth', '96', 'img/thumbnail_timberland-1.jpg', 'img/image_timberland-1.jpg', '003TIM', '002BOO', '');

INSERT INTO `tbInventory` VALUES
('PP0138', 'PP01', '38', 10),
('PP0139', 'PP01', '39', 10),
('PP0140', 'PP01', '40', 10),
('PP0141', 'PP01', '41', 10),
('PP0142', 'PP01', '42', 10),
('PP0238', 'PP02', '38', 10),
('PP0239', 'PP02', '39', 10),
('PP0240', 'PP02', '40', 10),
('PP0241', 'PP02', '41', 10),
('PP0242', 'PP02', '42', 10),
('PP0338', 'PP03', '38', 10),
('PP0339', 'PP03', '39', 10),
('PP0340', 'PP03', '40', 10),
('PP0341', 'PP03', '41', 10),
('PP0342', 'PP03', '42', 10),
('PP0438', 'PP04', '38', 10),
('PP0439', 'PP04', '39', 10),
('PP0440', 'PP04', '40', 10),
('PP0441', 'PP04', '41', 10),
('PP0442', 'PP04', '42', 10);

INSERT INTO `tbPayment`(`Method`, `Desc`) VALUES 
('Cash', 'Cash payment method'),
('VISA', 'VISA payment method'),
('MOMO', 'MOMO wallet');
