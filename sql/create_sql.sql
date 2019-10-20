USE 1802237mhr;
CREATE TABLE seller
(sellerId CHAR(20),
name VARCHAR(255),
contactNo INT(8) CHECK (sellerContactNo between 80000000 AND 99999999),
password CHAR(20),
isAgent BOOLEAN,
PRIMARY KEY (sellerId));

CREATE TABLE agent
(sellerId CHAR(20),
companyName VARCHAR(255),
experience INT,
rating DOUBLE,
registeredDate DATE,
sales INT,
PRIMARY KEY (sellerId),
FOREIGN KEY (sellerId) REFERENCES seller(sellerId));

CREATE TABLE owner
(sellerId CHAR(20),
yearsOfStay INT,
PRIMARY KEY (sellerId),
FOREIGN KEY (sellerId) REFERENCES seller(sellerId));

CREATE TABLE resale_putUp
(resaleId INT,
town VARCHAR(40),
block CHAR(10),
streetName VARCHAR(80),
flatType CHAR(10),
storey INT,
floorArea INT,
flatModel CHAR(20),
leaseStart INT,
remainingLease VARCHAR(30),
resalePrice INT,
available BOOLEAN,
sellerId CHAR(20),
date DATE,
PRIMARY KEY (resaleId),
FOREIGN KEY (sellerID) REFERENCES seller(sellerId));

CREATE TABLE housingGrant
(grantId CHAR(20),
grantType VARCHAR(40),
incomeFloor INT,
incomeCeiling INT,
grantAmount INT,
aboveAge35 CHAR(10),
firstTimer BOOLEAN,
married BOOLEAN,
citizenship CHAR(20),
flatType CHAR(10),
locationNearParents CHAR(10),
livingWithParents CHAR(10),
PRIMARY KEY (grantId));

CREATE TABLE buyer
(buyerId INT,
name VARCHAR(255),
age INT,
married BOOLEAN,
parentLocation VARCHAR(40),
citizenship CHAR(20),
income INT,
firstTime BOOLEAN,
password CHAR(20), 
email VARCHAR(50),
verified BOOLEAN,
hash VARCHAR(32),
PRIMARY KEY (buyerId));

CREATE TABLE resale_buyer
(bookmarkId INT,
resaleId INT,
buyerId INT,
PRIMARY KEY (bookmarkId),
FOREIGN KEY (resaleId) REFERENCES resale_putUp(resaleId),
FOREIGN KEY (buyerId) REFERENCES buyer(buyerId));

Create TABLE housingGrant_resale
(grantId char(20),
resaleId INT,
PRIMARY KEY (grantId,resaleId),
FOREIGN KEY (grantId) REFERENCES housingGrant(grantId),
FOREIGN KEY (resaleId) REFERENCES resale_putUp(resaleId));
