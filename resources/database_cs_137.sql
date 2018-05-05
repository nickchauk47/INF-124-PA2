-- CREATE SCHEMA rm_fan_store_db;
-- USE rm_fan_store_db;

DROP TABLE IF EXISTS Products;
DROP TABLE IF EXISTS Orders;


-- -----------------------------------
-- Tables
-- -----------------------------------

CREATE TABLE IF NOT EXISTS Products (
        
    -- Product Info
    pid         INT NOT NULL,
    name        VARCHAR(30),
    color       VARCHAR(20),
    material    VARCHAR(20),
    price       DOUBLE,
    description VARCHAR(750),
    imagePath   VARCHAR(50),
    
    
    PRIMARY KEY (pid)
);

CREATE TABLE IF NOT EXISTS Orders (
    
    -- Order Info
    oid             INT NOT NULL AUTO_INCREMENT,
    productid       INT,
    
    -- Personal Info
    orderDateTime   DATETIME,
    nameFirst       VARCHAR(25),
    nameLast        VARCHAR(25),
    phoneNumber     VARCHAR(15),
    
    -- Shipping Info
    addrStreet      VARCHAR(30),
    addrStreet2     VARCHAR(30),
    addrCity        VARCHAR(30),
    addrState       CHAR(2),
    addrZip         INT,
    shippingMethod  INT,
    
    -- Payment Info
    nameOnCard      VARCHAR(50),
    cardNumber      INT,
    expMonth        INT,
    expYear         INT,
    cardCCV         INT,
    
    
    PRIMARY KEY (oid),
    FOREIGN KEY (productid) REFERENCES Products(pid)
    ON DELETE RESTRICT

);
