
-- create database webshop;
--
-- use webshop;

DROP TABLE IF EXISTS `Prod2Cat`;
DROP TABLE IF EXISTS `ProdCategory`;
DROP TABLE IF EXISTS `Inventory`;
DROP TABLE IF EXISTS `InvenShelf`;
DROP TABLE IF EXISTS `OrderRow`;
DROP TABLE IF EXISTS `InvoiceRow`;
DROP TABLE IF EXISTS `VarukorgRow`;
DROP TABLE IF EXISTS `Invoice`;
DROP TABLE IF EXISTS `Order`;
DROP TABLE IF EXISTS `Varukorg`;
DROP TABLE IF EXISTS `Product`;
DROP TABLE IF EXISTS `Customer`;
DROP TABLE IF EXISTS WebshopLog;
DROP TABLE IF EXISTS HaveToOrderLog;

-- SHOW TABLES;
-- SHOW PROCEDURE STATUS;


--
-- Product and product category
--

CREATE TABLE `ProdCategory` (
	`id` INT AUTO_INCREMENT,
	`category` CHAR(10),

	PRIMARY KEY (`id`)
);

CREATE TABLE `Product` (
	`id` INT AUTO_INCREMENT,
	`description` VARCHAR(20),
	`price` INT,
	`picture` VARCHAR(40),

	PRIMARY KEY (`id`),
    KEY `index_description` (`description`)
);

CREATE TABLE `Prod2Cat` (
	`id` INT AUTO_INCREMENT,
	`prod_id` INT,
	`cat_id` INT,

	PRIMARY KEY (`id`),
    FOREIGN KEY (`prod_id`) REFERENCES `Product` (`id`),
    FOREIGN KEY (`cat_id`) REFERENCES `ProdCategory` (`id`)
);

--
-- Inventory and shelfs
--

CREATE TABLE `InvenShelf` (
    `shelf` CHAR(6),
    `description` VARCHAR(40),

	PRIMARY KEY (`shelf`)
);

CREATE TABLE `Inventory` (
	`id` INT AUTO_INCREMENT,
    `prod_id` INT,
    `shelf_id` CHAR(6),
    `items` INT,

	PRIMARY KEY (`id`),
	FOREIGN KEY (`prod_id`) REFERENCES `Product` (`id`),
	FOREIGN KEY (`shelf_id`) REFERENCES `InvenShelf` (`shelf`)
);

--
-- Customer
--
CREATE TABLE `Customer` (
	`id` INT AUTO_INCREMENT,
    `firstName` VARCHAR(20),
    `lastName` VARCHAR(20),

	PRIMARY KEY (`id`)
);


--
-- Start with the product catalogue
--
INSERT INTO `Product` (`description`, `price`, `picture`) VALUES
("NMD_R2", 1395, "img/webshop/NMD_R2.jpg"),
("ML373", 899, "img/webshop/ML373.jpg"),
("SWIFT RUN", 849, "img/webshop/SWIFT_RUN.jpg"),
("DUALTONE RACER", 679, "img/webshop/DUALTONE.jpg"),
("TUBULAR", 949, "img/webshop/TUBULAR.jpg"),
("HYDE", 1095, "img/webshop/HYDE.jpg"),
("SUPERSTAR", 899, "img/webshop/SUPERSTAR.jpg"),
("FRESH FOAM", 759, "img/webshop/FRESH_FOAM.jpg"),
("FOAM CRUZ", 849, "img/webshop/FOAM_CRUZ.jpg"),
("ROSHE ONE", 999, "img/webshop/ROSHE.jpg")
;

INSERT INTO `ProdCategory` (`category`) VALUES
("Nike"), ("Adidas"), ("NewBalance")
;

INSERT INTO `Prod2Cat` (`prod_id`, `cat_id`) VALUES
(1, 1), (2, 1), (3, 1), (4, 1),
(5, 2), (6, 2), (7, 2), (8, 2),
(9, 3), (10, 3)
;

-- SELECT
-- 	P.id,
--     P.description,
--     P.price,
--     P.picture,
--     GROUP_CONCAT(category) AS category
-- FROM Product AS P
-- 	INNER JOIN Prod2Cat AS P2C
-- 		ON P.id = P2C.prod_id
-- 	INNER JOIN ProdCategory AS PC
-- 		ON PC.id = P2C.cat_id
-- GROUP BY P.id
-- ORDER BY P.description
-- ;


--
-- The truck has arrived, put the stuff into shelfs and update the database
--
INSERT INTO `InvenShelf` (`shelf`, `description`) VALUES
("AAA101", "House A, aisle A, part A, shelf 101"),
("AAA102", "House A, aisle A, part A, shelf 102"),
("AAA103", "House A, aisle A, part A, shelf 103")
;

INSERT INTO `Inventory` (`prod_id`, `shelf_id`, `items`) VALUES
(1, "AAA101", 30), (2, "AAA101", 20), (3, "AAA101", 25), (4, "AAA101", 15),
(5, "AAA102", 20), (6, "AAA102", 25), (7, "AAA102", 15), (8, "AAA102", 10),
(9, "AAA103", 20), (10, "AAA103", 30)
;

-- SELECT
--     GROUP_CONCAT(category) AS category
-- FROM Product AS P
-- 	INNER JOIN Prod2Cat AS P2C
-- 		ON P.id = P2C.prod_id
-- 	INNER JOIN ProdCategory AS PC
-- 		ON PC.id = P2C.cat_id
-- WHERE P.id = 4
-- ;

--
-- The customers are arriving
--
INSERT INTO `Customer` (`firstName`, `lastName`) VALUES
("Mumin", "Trollet"),
("Mamma", "Mumin"),
("Pappa", "Mumin")
;


-- ------------------------------------------------------------------------
--
-- Varukorg
--
CREATE TABLE `Varukorg` (
	`id` INT AUTO_INCREMENT,
    `customer` INT,
	`created` DATETIME DEFAULT CURRENT_TIMESTAMP,
	`updated` DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
	`deleted` DATETIME DEFAULT NULL,

	PRIMARY KEY (`id`),
	FOREIGN KEY (`customer`) REFERENCES `Customer` (`id`)
);

CREATE TABLE `VarukorgRow` (
	`id` INT AUTO_INCREMENT,
    `varukorg` INT,
    `product` INT,
	`items` INT,

	PRIMARY KEY (`id`),
	FOREIGN KEY (`varukorg`) REFERENCES `Varukorg` (`customer`),
	FOREIGN KEY (`product`) REFERENCES `Product` (`id`)
);


-- ------------------------------------------------------------------------
--
-- Order
--
CREATE TABLE `Order` (
	`id` INT AUTO_INCREMENT,
    `customer` INT,
	`created` DATETIME DEFAULT CURRENT_TIMESTAMP,
	`updated` DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
	`deleted` DATETIME DEFAULT NULL,

	PRIMARY KEY (`id`),
	FOREIGN KEY (`customer`) REFERENCES `Customer` (`id`)
);

CREATE TABLE `OrderRow` (
	`id` INT AUTO_INCREMENT,
    `order` INT,
    `product` INT,
	`items` INT,

	PRIMARY KEY (`id`),
	FOREIGN KEY (`order`) REFERENCES `Order` (`id`),
	FOREIGN KEY (`product`) REFERENCES `Product` (`id`)
);

-- CREATE VIEW Vinventory AS
-- SELECT
-- 	I.shelf_id,
--   P.description,
-- 	PC.category,
--   I.items
-- FROM Inventory AS I
-- 	INNER JOIN Product AS P
-- 		ON I.prod_id = P.id
-- 	INNER JOIN Prod2Cat AS P2C
-- 		ON P.id = P2C.prod_id
-- 	INNER JOIN ProdCategory AS PC
-- 		ON PC.id = P2C.cat_id
-- GROUP BY I.prod_id
-- ;
--

-- ------------------------------------------------------------------------
--
-- WebshopLog
--
CREATE TABLE WebshopLog
(
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT,
    `when` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `what` VARCHAR(20),
    `product` CHAR(4),
    `balance` DECIMAL(4, 2),
    `amount` DECIMAL(4, 2)
);


DROP TRIGGER IF EXISTS InventoryUpdates;

CREATE TRIGGER InventoryUpdates
AFTER UPDATE
ON Inventory FOR EACH ROW
    INSERT INTO WebshopLog (`what`, `product`, `balance`, `amount`)
        VALUES ("Inventory", NEW.prod_id, NEW.items, NEW.items - OLD.items);

DROP TRIGGER IF EXISTS newVarukorgRow;

CREATE TRIGGER newVarukorgRow
AFTER INSERT
ON VarukorgRow FOR EACH ROW
    INSERT INTO WebshopLog (`what`, `product`, `balance`, `amount`)
        VALUES (NEW.varukorg, NEW.product, NEW.items, NEW.items);

DROP TRIGGER IF EXISTS deleteVarukorgRow;

CREATE TRIGGER deleteVarukorgRow
AFTER DELETE
ON VarukorgRow FOR EACH ROW
    INSERT INTO WebshopLog (`what`, `product`, `balance`, `amount`)
        VALUES ("deletedVarukorgRow", OLD.product, '0', 0 - OLD.items);

-- DROP TRIGGER IF EXISTS newOrderRow;
--
-- CREATE TRIGGER newOrderRow
-- AFTER INSERT
-- ON OrderRow FOR EACH ROW
--     INSERT INTO WebshopLog (`what`, `product`, `balance`, `amount`)
--         VALUES ("newVarukorgRow", NEW.varukorg, NEW.items, NEW.items);

-- ------------------------------------------------------------------------
--
-- HaveToOrderLog
--
CREATE TABLE HaveToOrderLog
(
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT,
    `when` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `what` VARCHAR(20),
    `product` CHAR(4),
    `balance` DECIMAL(4, 2)
);

--
-- Trigger for logging updating balance
--
DROP TRIGGER IF EXISTS HaveToOrderUpdates;

DELIMITER //

CREATE TRIGGER HaveToOrderUpdates
BEFORE UPDATE
ON Inventory FOR EACH ROW
	IF NEW.items < 5 THEN
    INSERT INTO HaveToOrderLog (`what`, `product`, `balance`)
        VALUES ("Need to refill", NEW.prod_id, NEW.items);
	END IF;
//

DELIMITER ;

-- ------------------------------------------------------------------------

-- SELECT * FROM WebshopLog;
-- SELECT * FROM HaveToOrderLog;
-- SELECT * FROM VarukorgRow;
-- SELECT * FROM `Order`;
-- SELECT * FROM Inventory;

-- ------------------------------------------------------------------------
--
-- create Varukorg
--
DROP PROCEDURE IF EXISTS createVarukorg;

DELIMITER //

CREATE PROCEDURE createVarukorg(
	thisCustomer INT
)
BEGIN
	START TRANSACTION;

	INSERT INTO Varukorg
	SET
	customer = thisCustomer;
	COMMIT;

END
//
DELIMITER ;

-- CALL createVarukorg(1);

-- ------------------------------------------------------------------------
--
-- add To Varukorg
--
DROP PROCEDURE IF EXISTS addToVarukorg;

DELIMITER //

CREATE PROCEDURE addToVarukorg(
    varukorg INT,
		product INT,
    amount INT
)
BEGIN
	DECLARE currentItems INT;

	START TRANSACTION;

	SET currentItems = (SELECT items FROM Inventory WHERE id = product);

	IF currentItems - amount < 0 THEN
	ROLLBACK;
    SELECT "There is not enough items in Inventory to make a transaction.";

	ELSE

    INSERT INTO `VarukorgRow` (`varukorg`, `product`, `items`)
    VALUES
		(varukorg, product, amount)
		;

    UPDATE Inventory
    SET
    	items = items - amount
    WHERE
    	id = product;

    COMMIT;

	END IF;
END
//

DELIMITER ;


-- CALL createVarukorgRow(1, 2, 10);

-- ------------------------------------------------------------------------
--
-- remove From Varukorg
--
DROP PROCEDURE IF EXISTS removeFromVarukorg;

DELIMITER //

CREATE PROCEDURE removeFromVarukorg(
		varukorg INT,
		product INT,
		amount INT
)
BEGIN

	START TRANSACTION;

	DELETE FROM VarukorgRow WHERE varukorg = varukorg;

  UPDATE Inventory
  SET
  	items = items + amount
  WHERE
  	id = product;

  COMMIT;
END
//

DELIMITER ;

-- CALL deleteVarukorgRow(1, 2, 20);

-- ------------------------------------------------------------------------
--
-- from Varukorg To Order
--
DROP PROCEDURE IF EXISTS fromVarukorgToOrder;

DELIMITER //

CREATE PROCEDURE fromVarukorgToOrder(
	varukorg INT
)
BEGIN
	DECLARE amount INT;
	DECLARE i INT DEFAULT 0;
	DECLARE n INT DEFAULT 0;
	DECLARE productId INT;
	DECLARE orderNr INT;

	START TRANSACTION;

	-- INSERT INTO `Order` (`customer`) VALUES (varukorg);
	INSERT INTO `Order` (`customer`)
	SELECT customer FROM Varukorg
	WHERE id = varukorg;
	SET orderNr = LAST_INSERT_ID();

	SELECT COUNT(*) FROM VarukorgRow WHERE varukorg = varukorg INTO n;
	SET i = 0;
	aLoop: WHILE i < n DO
		SELECT items FROM VarukorgRow WHERE varukorg = varukorg LIMIT i,1
	    INTO amount;
		SELECT product FROM VarukorgRow WHERE varukorg = varukorg LIMIT i,1
	    INTO productId;

	INSERT INTO OrderRow
	(`order`, `product`, `items`)
	SELECT
		orderNr, `product`, `items`
	FROM VarukorgRow
		WHERE varukorg = varukorg
			LIMIT i,1;

SET i = i + 1;
END WHILE;

DELETE FROM VarukorgRow WHERE varukorg = varukorg;

COMMIT;

END
//
DELIMITER ;

-- CALL fromVarukorgToOrder(1);

DROP VIEW IF EXISTS showWebshop;
CREATE VIEW showWebshop AS
SELECT
	S.shelf,
	I.items,
	P.description,
	P.price,
	P.id,
	P.picture,
	GROUP_CONCAT(category) AS category
FROM Inventory AS I
	INNER JOIN InvenShelf AS S
		ON I.shelf_id = S.shelf
	INNER JOIN Product AS P
		ON P.id = I.prod_id
	INNER JOIN Prod2Cat AS P2C
		ON P.id = P2C.prod_id
	INNER JOIN ProdCategory AS PC
		ON PC.id = P2C.cat_id
GROUP BY P.id
;


DROP VIEW IF EXISTS showCart;
CREATE VIEW showCart AS
SELECT
	P.picture,
	P.description,
	P.price,
	V.items,
	GROUP_CONCAT(category) AS category
FROM VarukorgRow AS V
	INNER JOIN Product AS P
		ON P.id = V.product
	INNER JOIN Prod2Cat AS P2C
		ON P.id = P2C.prod_id
	INNER JOIN ProdCategory AS PC
		ON PC.id = P2C.cat_id
GROUP BY V.id
;
