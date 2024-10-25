CREATE TABLE Brand (
    Brand_ID INT AUTO_INCREMENT PRIMARY KEY,
    Designer_Brand VARCHAR(50) NOT NULL,
    Date_Founded DATE
);

CREATE TABLE Product (
    Product_ID INT AUTO_INCREMENT PRIMARY KEY,
    Brand_ID INT,
    Product_Type VARCHAR(50),
    Product_Name VARCHAR(50),
    Price INT,
    Quantity INT,
    Date_Created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (Brand_ID) REFERENCES Brand(Brand_ID) ON DELETE CASCADE
);
