<?php

function getProductById($pdo, $productId) {
    $stmt = $pdo->prepare("SELECT * FROM Product WHERE Product_ID = :productId");
    $stmt->execute(['productId' => $productId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function fetchAllProducts($pdo) {
    $stmt = $pdo->prepare("SELECT p.Product_ID, p.Product_Type, p.Product_Name, p.Price, p.Quantity, b.Designer_Brand 
                            FROM Product p 
                            JOIN Brand b ON p.Brand_ID = b.Brand_ID");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function insertProduct($pdo, $brandId, $productType, $productName, $price, $quantity) {
    $stmt = $pdo->prepare("INSERT INTO Product (Brand_ID, Product_Type, Product_Name, Price, Quantity) 
                            VALUES (:brandId, :productType, :productName, :price, :quantity)");
    return $stmt->execute([
        'brandId' => $brandId,
        'productType' => $productType,
        'productName' => $productName,
        'price' => $price,
        'quantity' => $quantity,
    ]);
}

function updateProduct($pdo, $productId, $brandId, $productType, $productName, $price, $quantity) {
    $stmt = $pdo->prepare("UPDATE Product 
                            SET Brand_ID = :brandId, Product_Type = :productType, Product_Name = :productName, Price = :price, Quantity = :quantity 
                            WHERE Product_ID = :productId");
    return $stmt->execute([
        'brandId' => $brandId,
        'productType' => $productType,
        'productName' => $productName,
        'price' => $price,
        'quantity' => $quantity,
        'productId' => $productId,
    ]);
}

function deleteProduct($pdo, $productId) {
    $stmt = $pdo->prepare("DELETE FROM Product WHERE Product_ID = :productId");
    return $stmt->execute(['productId' => $productId]);
}

function insertBrand($pdo, $designerBrand, $dateFounded) {
    $stmt = $pdo->prepare("INSERT INTO Brand (Designer_Brand, Date_Founded) VALUES (:designerBrand, :dateFounded)");
    return $stmt->execute([
        'designerBrand' => $designerBrand,
        'dateFounded' => $dateFounded,
    ]);
}

function fetchAllBrands($pdo) {
    $stmt = $pdo->query("SELECT * FROM Brand");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getBrandById($pdo, $brandId) {
    $stmt = $pdo->prepare("SELECT * FROM Brand WHERE Brand_ID = :brandId");
    $stmt->execute(['brandId' => $brandId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function updateBrand($pdo, $brandId, $designerBrand, $dateFounded) {
    $stmt = $pdo->prepare("UPDATE Brand SET Designer_Brand = :designerBrand, Date_Founded = :dateFounded WHERE Brand_ID = :brandId");
    return $stmt->execute([
        'designerBrand' => $designerBrand,
        'dateFounded' => $dateFounded,
        'brandId' => $brandId,
    ]);
}

function deleteBrand($pdo, $brandId) {
    $stmt = $pdo->prepare("DELETE FROM Brand WHERE Brand_ID = :brandId");
    return $stmt->execute(['brandId' => $brandId]);
}
?>
