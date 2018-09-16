/*
		 _____ _____ __       _____     _           
		|   __|     |  |     |   __|___| |_ _ _ ___ 
		|__   |  |  |  |__   |__   | -_|  _| | | . |
		|_____|__  _|_____|  |_____|___|_| |___|  _|
				 |__|                          |_|                                   
			   (                         )        
			 ( )\  (        (      )  ( /(    (   
			 )((_) )\ )     )\  ( /(  )\())  ))\  
			((_)_ (()/(    ((_) )(_))((_)\  /((_) 
			 | _ ) )(_))  _ | |((_)_ | |(_)(_))   
			 | _ \| || | | || |/ _` || / / / -_)  
			 |___/ \_, |  \__/ \__,_||_\_\ \___|  
				   |__/                           


This file  is used to set up the database on a MYSQL server.
Some aspects will need to be changed so that the files can all
be located. specifically the location of the data within the
CSV files

This is the command that needes to be run within the mysql command line:
source C:/Users/Jake/OneDrive - Deakin University/Group 28/Jake/MYSQL Files/mysqlSetup.sql; 

*/

/* ---------------------------------------------------------- */
/* Removes the old tables from the database that have the     */
/* same names as the ones that we are going to be importing   */
/* into the system 											  */
/* ---------------------------------------------------------- */
DROP DATABASE scrapperTest;
CREATE DATABASE scrapperTest;
USE scrapperTest;	


/* ---------------------------------------------------------- */
/* This is the database tables for the scrapped data 		  */
/* ---------------------------------------------------------- */

CREATE TABLE brands (
	brandID INT,
	brandName VARCHAR(200),
	PRIMARY KEY(brandID)
);

/* ---------------------------------------------------------- */
/* This table will store the ID's of all the stores that are  */
/* used for collection.										  */
/* ---------------------------------------------------------- */

create table stores(
	storeID int PRIMARY KEY,
	storeName varchar(200) NOT NULL,
	storeStreet varchar(200),
	storeSuburb varchar(200),
	storePostCode int
);

LOAD DATA LOCAL INFILE 'C:/Users/Jake/OneDrive - Deakin University/Group 28/Jake/MYSQL Files/Stores.csv' -- This line needs to be changed
INTO TABLE stores 
FIELDS TERMINATED BY ',' 
LINES TERMINATED BY '\n';

CREATE TABLE products (
	productID INT,
	brandID INT,
	productName VARCHAR(200),
	packSize varchar(40),
	servingSize varchar(20),
	servingsPer FLOAT,
	productCode INT,
	energy VARCHAR(10),
	protien VARCHAR(10),
	fat VARCHAR(10),
	saturatedFats VARCHAR(10),
	carbs VARCHAR(10),
	sugars VARCHAR(10),
	sodium VARCHAR(10),
	storeID INT NOT NULL,
	equivilent INT,
	PRIMARY KEY(productID, brandID, productName, packSize),
	FOREIGN KEY (brandID) REFERENCES brands(brandID),
	FOREIGN KEY (storeID) REFERENCES stores(storeID)
);

CREATE TABLE scrappedData (
	collectionTime INT,
	productID INT,
	originalPrice FLOAT,
	pricePromoted ENUM('TRUE', 'FALSE') NOT NULL,
	promotionPrice FLOAT,
	multiBuy ENUM('TRUE', 'FALSE') NOT NULL,
	multiBuyQuanutity INT,
	multiBuyPrice FLOAT,
	PRIMARY KEY (collectionTime, productID),
	FOREIGN KEY (productID) REFERENCES products(productID)
);

/* LOAD DATA LOCAL INFILE 'C:/Users/Jake/Desktop/writeToProducts.csv' -- This line needs to be changed
INTO TABLE products 
FIELDS TERMINATED BY ',' 
LINES TERMINATED BY '\n'; */


/* ---------------------------------------------------------- */
/* 															  */
/* This is the database tables for the manually inputted data */
/* 															  */
/* ---------------------------------------------------------- */


/* ---------------------------------------------------------- */
/* This table will list all the users that have access to add */
/* and edit entries that are in the database 				  */
/* ---------------------------------------------------------- */
/* For the purpose of this database 1 = True and 0 = False    */
/* ---------------------------------------------------------- */

create table users(
	userID INT PRIMARY KEY AUTO_INCREMENT,
	username varchar(20) UNIQUE,
	password varchar(32) NOT NULL,
	name VARCHAR(100) NOT NULL,
	organisation varchar(20) NOT NULL,
	organisationAddress varchar(200),
	position varchar(50),
	email varchar(50) NOT NULL,
	contactNumber varchar(10) NOT NULL,
	confirmed tinyint DEFAULT 0,
	isAdmin tinyint DEFAULT 0
);

INSERT INTO users VALUES (1, 'Admin', '3b42341c18375f47513c433c948a44d7', 'Admin', 'Deakin', '1234 Burwood Hwy', 'Admin', 'email@email.com', '0398764321', 1, 1	);

/* ---------------------------------------------------------- */
/* This tables describes the various categories for the foods that are being stored */
/* ---------------------------------------------------------- */

create table foodCategories(
	categoryID INT PRIMARY KEY,
	categoryName VARCHAR(100)
);

/* ---------------------------------------------------------- */
/* This inserts the categories that are required for the 	  */
/* manually entered data 									  */
/* ---------------------------------------------------------- */
INSERT INTO foodCategories VALUES ("1", "Alcohol");
INSERT INTO foodCategories VALUES ("2", "Discretionary Foods");
INSERT INTO foodCategories VALUES ("3", "Extra Items Not in Supermarket");
INSERT INTO foodCategories VALUES ("4", "Fruit");
INSERT INTO foodCategories VALUES ("5", "Grain Cereal Foods - Wholegrain & Refined");
INSERT INTO foodCategories VALUES ("6", "Lean Meats and Poultry, Fish, Eggs, Nuts and Seeds");
INSERT INTO foodCategories VALUES ("7", "Milk, Yoghurt, Cheese and Alternatives");
INSERT INTO foodCategories VALUES ("8", "Other");
INSERT INTO foodCategories VALUES ("9", "Other Foods ie Core Foods Not in Both Baskets and/or Mixed Foods");
INSERT INTO foodCategories VALUES ("10", "Unsaturated Oils and Spreads or Foods from Which These are Derives");
INSERT INTO foodCategories VALUES ("11", "Vegetables and Legumes");

/* ---------------------------------------------------------- */
/* We havent decided on how the data will be initially stored */
/* identified however proof of concept 						  */
/* ---------------------------------------------------------- */

create table foodDetails(
	foodID int PRIMARY KEY,
	foodName varchar(200) NOT NULL,
	foodSpecificBrand varchar(160),
	servingSize varchar(50),
	categoryID int,
	CONSTRAINT fk_categoryID FOREIGN KEY (categoryID) REFERENCES foodCategories(categoryID)
);

/* ---------------------------------------------------------- */
/* This loads all the food items into the database rather     */
/* than loading all the information in individually 		  */
/* ---------------------------------------------------------- */
LOAD DATA LOCAL INFILE 'C:/Users/Jake/OneDrive - Deakin University/Group 28/Jake/MYSQL Files/foodDetails.csv'
INTO TABLE foodDetails 
FIELDS TERMINATED BY ',' 
LINES TERMINATED BY '\n';

/* ---------------------------------------------------------- */
/* This table will hold the information about each collection */
/* that is done. 											  */
/* ---------------------------------------------------------- */
/*
/*
CREATE TABLE collections (
	collectionID INT PRIMARY KEY,
	collectionDate DATE,
	userID INT,
	locationID INT,
	CONSTRAINT fk_collection FOREIGN KEY (userID) REFERENCES users(userID)
);
*/
/* ---------------------------------------------------------- */
/* This will be the main table where the manually entered     */
/* data is stored 											  */
/* ---------------------------------------------------------- */

create table main(
	foodID int,
	collectionDate TIMESTAMP,
	brand varchar(50),
	servingSize varchar(20),
	price decimal(5,2) NOT NULL,
	pricePer varchar(20),
	pricePromoted char(1),
	comments varchar(200),
	CONSTRAINT pk_main PRIMARY KEY(foodID，collectionDate),
	CONSTRAINT fk_foodID FOREIGN KEY (foodID) REFERENCES foodDetails(foodID)
);

LOAD DATA LOCAL INFILE 'C:/Users/Jake/OneDrive - Deakin University/Group 28/Jake/MYSQL Files/testData.csv'
INTO TABLE main 
FIELDS TERMINATED BY ',' 
LINES TERMINATED BY '\n';

/* ---------------------------------------------------------- */
/* This is one of tables that will be used to calculate the   */
/* affordability of a basket based on the manual data that is */
/* collected. 												  */
/* ---------------------------------------------------------- */ 
CREATE TABLE unhealthyBasketRating (
	foodID INT,
	HH1 INT,
	HH2 INT,
	HH3 INT,
	HH4 INT,
	HH5 INT
);

/* ---------------------------------------------------------- */
/* This is one of tables that will be used to calculate the   */
/* affordability of a basket based on the manual data that is */
/* collected. 												  */
/* ---------------------------------------------------------- */ 
CREATE TABLE healthyBasketRating (
	foodID INT,
	HH1 INT,
	HH2 INT,
	HH3 INT,
	HH4 INT,
	HH5 INT
);

/* ---------------------------------------------------------- */
/* Import the Healthy Basket List 							  */
/* ---------------------------------------------------------- */

LOAD DATA LOCAL INFILE 'C:/Users/Jake/OneDrive - Deakin University/Group 28/Jake/MYSQL Files/HealthyBasket.csv' -- This line needs to be changed
INTO TABLE healthybasketrating 
FIELDS TERMINATED BY ',' 
LINES TERMINATED BY '\n';

/* ---------------------------------------------------------- */
/* Import the Unhealthy Basket List 						  */
/* ---------------------------------------------------------- */

LOAD DATA LOCAL INFILE 'C:/Users/Jake/OneDrive - Deakin University/Group 28/Jake/MYSQL Files/UnhealthyBasket.csv' -- This line needs to be changed
INTO TABLE unhealthybasketrating 
FIELDS TERMINATED BY ',' 
LINES TERMINATED BY '\n';