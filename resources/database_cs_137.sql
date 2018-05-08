-- CREATE SCHEMA rm_fan_store_db;
-- USE rm_fan_store_db;

DROP TABLE IF EXISTS OrderInfo;
DROP TABLE IF EXISTS Orders;
DROP TABLE IF EXISTS Products;


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
    quantity        INT,
    
    PRIMARY KEY (oid, productid),
    FOREIGN KEY (productid) REFERENCES Products(pid)
    ON DELETE RESTRICT

);

CREATE TABLE IF NOT EXISTS OrderInfo (
    
    orderid         INT NOT NULL,
    totalCost       DOUBLE,
    
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
    cardNumber      BIGINT,
    expMonth        CHAR(2),
    expYear         CHAR(4),
    cardCCV         INT,
    
    PRIMARY KEY (orderid),
    FOREIGN KEY (orderid) REFERENCES Orders(oid)
    ON DELETE RESTRICT
);


-- products.sql
DELETE FROM Products;

INSERT INTO Products
(pid,name,color,material,price,description,imagePath)
VALUES
(1,"Morty T-Shirt","Yellow","Cotton",15,
"Rick's good-hearted but easily distressed 14-year-old grandson who is frequently dragged into Rick's misadventures. He is often reluctant to follow Rick's plans, and he often ends up traumatized by the unorthodox methods Rick uses to 'fix' situations",
"images/morty.png"),
(2,"Rick T-Shirt","Light Blue","Cotton",15,
"A genius scientist who is the father of Beth Smith and the maternal grandfather of Morty and Summer. His alcoholic tendencies lead his daughter's family to worry about the safety of their son Morty.",
"images/rick.png"),
(3,"Jerry T-Shirt","Lime Green","Cotton",15,
 "Summer and Morty's insecure father, Beth's husband, and Rick's son-in-law, who strongly disapproves of Rick's influence over his family.",
"images/jerry.png"),
(4,"Beth T-Shirt","Red","Cotton",15,
"Rick's daughter, Summer and Morty's mother, and Jerry's wife. She is a veterinarian who specializes in horse surgery, a job she internally feels to be beneath her and is often defensive when her career is compared to human medicine.",
"images/beth.png"),
(5,"Summer T-Shirt","Pink","Cotton",15,
"Morty's 17-year-old older sister, a more conventional and often superficial teenager, who is obsessed with improving her status among her peers.",
"images/summer.png"),
(6,"Mr. Meeseeks T-Shirt","Light Blue","Cotton",15,
"A race of blue humanoid creatures who all share the same name and personality. The Meeseeks are created from a metal box called a Meeseeks Box, and once they appear, whoever summoned them must give them a single, simple task for them to fulfill, after which they disappear in a cloud of smoke.",
"images/meeseeks.png"),
(7,"Mr. Poopy Butthole T-Shirt","Yellow","Cotton",15,
"A longtime family friend. He is a parody of wacky side characters on television shows.",
"images/poopy.png"),
(8,"Mr. Meeseeks Onsie","Light Blue","Cotton",15,
"A race of blue humanoid creatures who all share the same name and personality. The Meeseeks are created from a metal box called a Meeseeks Box, and once they appear, whoever summoned them must give them a single, simple task for them to fulfill, after which they disappear in a cloud of smoke.",
"images/meeseeksonesie.jpg"),
(9,"Morty Plush","Yellow, Blue, Brown","Cotton",15,
"Rick's good-hearted but easily distressed 14-year-old grandson who is frequently dragged into Rick's misadventures. He is often reluctant to follow Rick's plans, and he often ends up traumatized by the unorthodox methods Rick uses to 'fix' situations.",
"images/mortyplush.jpg"),
(10,"Rick and Morty Poster","All Colors","Laminated Paper",15,
"Get a cool poster of all the Rick and Morty characters to hang on your wall.",
"images/poster.png"),
(11,"Rick and Morty Portal Gun","Light Grey, Green","Plastic",15,
"Rick's Portal Gun will allow you to travel anywhere in the world in any dimension.",
"images/portalgun.jpg"),
(12,"Pick Rick Sticker","Yellow, Green","Paper",15,
"So pretty much, Rick turned himself into a pickle. It's Pickle Rick!!!",
"images/picklerick.jpg");