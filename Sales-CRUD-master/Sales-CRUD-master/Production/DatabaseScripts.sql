create table UserAccount(
UserID int PRIMARY KEY AUTO_INCREMENT,
Email varchar(50),
UserPass varchar(30),
Constraint chk_pass_email CHECK (Email like '%@%' and UserPass like '%[a-z]%' and UserPass like '%[0-9]%' and len(UserPass) >= 8)
)

create table Customer_Indiv(
CustomerID int Primary KEY REFERENCES customer.CustomerID,
FName varchar(25),
LName varchar(25)
)

create table customer_org(
CustomerID int Primary KEY REFERENCES customer.CustomerID,
OrgName varchar(70)
)

INSERT INTO `customer`(`CustomerType`, `Email`, `Phone`) VALUES ('i','raju@yahoo.com', '2067789909');
INSERT INTO `customer`(`CustomerType`, `Email`, `Phone`) VALUES ('i','raj@yahoo.com', '2067789809');
INSERT INTO 


create table ProductCategory(
CategoryID int Primary Key Auto_Increment,
CategoryName varchar(25),
PricePerKg decimal(15, 3),
Constraint Chk_positive CHECK (PricePerKg > 0)
)

create table OrderProduct(
ProductID int Primary Key Auto_Increment,
CategoryID int References ProductCategory.CategoryID,
Length_m decimal (6, 3),
Thickness_mm decimal(7, 3),
Weight_kg decimal(10, 3),
Constraint Chk_positive CHECK (Length_m > 0 and Thickness_mm > 0 and Weight_kg > 0)
)

create table OrderQuote(
CustomerID int References Customer.CustomerID,
ProductID int References OrderProduct.ProductID,
OrderDate date,
DueDate date,
OrderStatus varchar(25),
QuantityOrdered int,
TotalPrice decimal(15, 2),
Primary Key (CustomerID, ProductID, OrderDate, DueDate),
Constraint Chk_pos CHECK (QuantityOrdered > 0 and TotalPrice > 0)
)

create table ProductRound(
ProductID int,
OutsideDiameter_mm decimal(7, 3),
Constraint Chk_pos CHECK (OutsideDiameter_mm > 0),
FOREIGN KEY (ProductID) REFERENCES OrderProduct(ProductID),
PRIMARY KEY (ProductID)
)

create table ProductRectSquare(
ProductID int,
SideA_mm decimal(7, 3),
SideB_mm decimal(7, 3),
Constraint Chk_pos CHECK (SideB_mm > 0  and SideA_mm > 0),
FOREIGN KEY (ProductID) REFERENCES OrderProduct(ProductID),
PRIMARY KEY (ProductID)
)

create table ProductCoil(
ProductID int,
Width_m decimal(6, 3),
Constraint Chk_pos CHECK (Width_m > 0),
FOREIGN KEY (ProductID) REFERENCES OrderProduct(ProductID),
PRIMARY KEY (ProductID)
)

CREATE PROCEDURE submitOrder(
	IN categID int,
    IN length decimal(6, 3),
    IN thickness decimal(7, 3),
    IN wt decimal(10, 3),
    IN width decimal(6, 3),
    IN sideA decimal(7, 3),
    IN sideB decimal(7, 3),
    IN outDia decimal(7, 3)
)
BEGIN
DECLARE prodID int;
INSERT into orderproduct(CategoryID, Length_m, Thickness_mm, Weight_kg) VALUES(categID, length, thickness, wt);
SET prodID = SELECT LAST_INSERT_ID();
IF categID = 1 THEN
	INSERT INTO productround(ProductID, OutsideDiameter_mm) VALUES(prodID, outDia);
ELSEIF categID = 2 THEN
	INSERT INTO productrectsquare(ProductID, SideA_mm, SideB_mm) VALUES(prodID, sideA, sideB);
ELSEIF categID = 3 THEN
	INSERT INTO productcoil(ProductID, Width_m) VALUES (prodID, width);
END IF;
END;

IF (NEW.Email not like '%@%' OR LENGTH(NEW.Phone) <> 10 OR NEW.Phone like '%[a-z]%') THEN
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT="Invalid Entry";
END IF

IF(NEW.QuantityOrdered <= 0 OR NEW.TotalPrice <= 0)
THEN
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT="Invalid Entry";
END IF