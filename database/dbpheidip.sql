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
    `BrandID` varchar(50) NOT NULL,
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
    `ProductID` varchar(50) NOT NULL,
    `ProductName` varchar(50) NOT NULL,
    `Price` decimal(10,2) NOT NULL,
    `Thumbnail` varchar(100) NOT NULL,
    `Image` varchar(100) NOT NULL,
    `BrandID` varchar(50) NOT NULL,
    `TypeID` varchar(10) NOT NULL,
    `Desc` text,
    PRIMARY KEY (ProductID)
);

DROP TABLE IF EXISTS `tbTag`;
CREATE TABLE `tbTag`(
    `TagID` varchar(50) NOT NULL,
    `TagName` varchar(40) NOT NULL,
    `ProductID` varchar(50) NOT NULL,
    `Desc` text,
    PRIMARY KEY (TagID)
);

DROP TABLE IF EXISTS `tbInventory`;
CREATE TABLE `tbInventory`(
    `InventoryID` varchar(10) NOT NULL,
    `ProductID` varchar(50) NOT NULL,
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
    `GuestID` int NOT NULL AUTO_INCREMENT,
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

INSERT INTO `tbGuest` VALUES
(1, 'The Guest', 'Themailwhichisntexist@mail.com', '0978767670');

INSERT INTO `tbFeedBack` VALUES 
(1, null, 1, 'Feedback is the bridge to effectively connect lesson-learned from the past to the future performance and potential', '2022-11-12 13:19:20'),
(2, 1, null, 'I saw that you learned how to use pivot tables for your Excel project and it really helped display the data', '2022-11-13 13:19:20');

INSERT INTO `tbBrand` VALUES
('NIK001', 'Nike', 'img/brand_nike.png', ''),
('ADI002', 'Adidas', 'img/brand_adidas.png', ''),
('TIM003', 'Timberland', 'img/brand_Timberland.png', '');

INSERT INTO `tbType`VALUES 
('001SNE', 'Sneaker', 'Sneaker shoes'),
('002BOO', 'Boots', 'Boots shoes'),
('003SAN', 'Sandals', 'Sandals'),
('004SLI', 'Slippers', 'Slippers');

INSERT INTO `tbProduct` VALUES 	
('NIK01', 'Nike K50 Ultra', '555', 'img/thumbnail_1.jpg', 'img/image_1.jpg', 'NIK001', '001SNE', ''),
('NIK02', 'Nike JS Ultra', '199', 'img/thumbnail_2.jpg', 'img/image_2.jpg', 'NIK001', '001SNE', ''),
('NIK03', 'Nike 12S Premium', '199', 'img/thumbnail_2.jpg', 'img/image_2.jpg', 'NIK001', '001SNE', ''),
('NIK04', 'Nike F4 Gt ', '199', 'img/thumbnail_2.jpg', 'img/image_2.jpg', 'NIK001', '001SNE', ''),
('ADI01', 'Adidas Ultra Pro Max', '80', 'img/thumbnail_product-4.jpg', 'img/image_product-4.jpg', 'ADI002', '001SNE', ''),
('ADI02', 'Adidas Ultra Pro Max', '80', 'img/thumbnail_product-4.jpg', 'img/image_product-4.jpg', 'ADI002', '001SNE', ''),
('ADI03', 'Adidas Ultra Pro Max', '80', 'img/thumbnail_product-4.jpg', 'img/image_product-4.jpg', 'ADI002', '001SNE', ''),
('ADI04', 'Adidas Ultra Pro Max', '80', 'img/thumbnail_product-4.jpg', 'img/image_product-4.jpg', 'ADI002', '001SNE', ''),
('TIM01', 'Timberland Boots New Earth', '96', 'img/thumbnail_timberland-1.jpg', 'img/image_timberland-1.jpg', 'TIM003', '002BOO', ''),
('TIM02', 'Timberland Boots New Earth', '96', 'img/thumbnail_timberland-1.jpg', 'img/image_timberland-1.jpg', 'TIM003', '002BOO', ''),
('TIM03', 'Timberland Boots New Earth', '96', 'img/thumbnail_timberland-1.jpg', 'img/image_timberland-1.jpg', 'TIM003', '002BOO', ''),
('TIM04', 'Timberland Boots New Earth', '96', 'img/thumbnail_timberland-1.jpg', 'img/image_timberland-1.jpg', 'TIM003', '002BOO', '');

INSERT INTO `tbInventory` VALUES
('NIK0138', 'NIK01', '38', 10),
('NIK0139', 'NIK01', '39', 10),
('NIK0140', 'NIK01', '40', 10),
('NIK0141', 'NIK01', '41', 10),
('NIK0142', 'NIK01', '42', 10),
('NIK0238', 'NIK02', '38', 10),
('NIK0239', 'NIK02', '39', 10),
('NIK0240', 'NIK02', '40', 10),
('NIK0241', 'NIK02', '41', 10),
('NIK0242', 'NIK02', '42', 10),
('NIK0338', 'NIK03', '38', 10),
('NIK0339', 'NIK03', '39', 10),
('NIK0340', 'NIK03', '40', 10),
('NIK0341', 'NIK03', '41', 10),
('NIK0342', 'NIK03', '42', 10),
('NIK0438', 'NIK04', '38', 10),
('NIK0439', 'NIK04', '39', 10),
('NIK0440', 'NIK04', '40', 10),
('NIK0441', 'NIK04', '41', 10),
('NIK0442', 'NIK04', '42', 10),
('ADI0138', 'ADI01', '38', 10),
('ADI0139', 'ADI01', '39', 10),
('ADI0140', 'ADI01', '40', 10),
('ADI0141', 'ADI01', '41', 10),
('ADI0142', 'ADI01', '42', 10),
('ADI0238', 'ADI02', '38', 10),
('ADI0239', 'ADI02', '39', 10),
('ADI0240', 'ADI02', '40', 10),
('ADI0241', 'ADI02', '41', 10),
('ADI0242', 'ADI02', '42', 10),
('ADI0338', 'ADI03', '38', 10),
('ADI0339', 'ADI03', '39', 10),
('ADI0340', 'ADI03', '40', 10),
('ADI0341', 'ADI03', '41', 10),
('ADI0342', 'ADI03', '42', 10),
('ADI0438', 'ADI04', '38', 10),
('ADI0439', 'ADI04', '39', 10),
('ADI0440', 'ADI04', '40', 10),
('ADI0441', 'ADI04', '41', 10),
('ADI0442', 'ADI04', '42', 10),
('TIM0138', 'TIM01', '38', 10),
('TIM0139', 'TIM01', '39', 10),
('TIM0140', 'TIM01', '40', 10),
('TIM0141', 'TIM01', '41', 10),
('TIM0142', 'TIM01', '42', 10),
('TIM0238', 'TIM02', '38', 10),
('TIM0239', 'TIM02', '39', 10),
('TIM0240', 'TIM02', '40', 10),
('TIM0241', 'TIM02', '41', 10),
('TIM0242', 'TIM02', '42', 10),
('TIM0338', 'TIM03', '38', 10),
('TIM0339', 'TIM03', '39', 10),
('TIM0340', 'TIM03', '40', 10),
('TIM0341', 'TIM03', '41', 10),
('TIM0342', 'TIM03', '42', 10),
('TIM0438', 'TIM04', '38', 10),
('TIM0439', 'TIM04', '39', 10),
('TIM0440', 'TIM04', '40', 10),
('TIM0441', 'TIM04', '41', 10),
('TIM0442', 'TIM04', '42', 10)
;

INSERT INTO `tbPayment`(`Method`, `Desc`) VALUES 
('Cash', 'Cash payment method'),
('VISA', 'VISA payment method'),
('MOMO', 'MOMO wallet');

INSERT INTO `tbTag` VALUES
('MenADI01', 'Men', 'ADI01', 'Men'),
('MenADI03', 'Men', 'ADI03', 'Men'),
('MenNIK01', 'Men', 'NIK01', 'Men'),
('MenTIM01', 'Men', 'TIM01', 'Men'),
('MenTIM02', 'Men', 'TIM02', 'Men'),
('MenTIM03', 'Men', 'TIM03', 'Men'),
('MenTIM04', 'Men', 'TIM04', 'Men'),
('NewADI02', 'New', 'ADI02', 'New'),
('NewADI03', 'New', 'ADI03', 'New'),
('NewNIK01', 'New', 'NIK01', 'New'),
('NewNIK02', 'New', 'NIK02', 'New'),
('NewTIM01', 'New', 'TIM01', 'New'),
('NewTIM04', 'New', 'TIM04', 'New'),
('WomADI02', 'Women', 'ADI02', 'Women'),
('WomADI04', 'Women', 'ADI04', 'Women'),
('WomNIK02', 'Women', 'NIK02', 'Women'),
('WomNIK03', 'Women', 'NIK03', 'Women'),
('WomenNIK04', 'Women', 'NIK04', 'Women'),
('WomTIM01', 'Women', 'TIM01', 'Women'),
('WomTIM02', 'Women', 'TIM02', 'Women'),
('WomTIM03', 'Women', 'TIM03', 'Women'),
('WomTIM04', 'Women', 'TIM04', 'Women');