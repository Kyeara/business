<?php
require_once 'dbConfig.php'; 
require_once 'models.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['insertNewProductBtn'])) {
        $brandId = $_POST['brandID'];
        $productType = $_POST['productType'];
        $productName = $_POST['productName'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];

        insertProduct($pdo, $brandId, $productType, $productName, $price, $quantity);
        header("Location: ../index.php");
        exit();

    } elseif (isset($_POST['updateProductBtn'])) {
        $productId = $_POST['product_id'];
        $brandId = $_POST['brandID']; // Added brand ID
        $productType = $_POST['productType'];
        $productName = $_POST['productName'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
    
        updateProduct($pdo, $productId, $brandId, $productType, $productName, $price, $quantity); // Pass brand ID to update function
        header("Location: ../index.php");
        exit();
    }
    

    } elseif (isset($_POST['insertNewBrandBtn'])) {
        $designerBrand = $_POST['designerBrand'];
        $dateFounded = $_POST['dateFounded'];

        insertBrand($pdo, $designerBrand, $dateFounded);
        header("Location: ../index.php");
        exit();
    }
 elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action'])) {
    if ($_GET['action'] === 'delete' && isset($_GET['product_id'])) {
        $productId = $_GET['product_id'];
        deleteProduct($pdo, $productId);
        header("Location: ../index.php");
        exit();
    } elseif ($_GET['action'] === 'delete' && isset($_GET['brand_id'])) {
        $brandId = $_GET['brand_id'];
        deleteBrand($pdo, $brandId);
        header("Location: ../index.php");
        exit();
    }
}
?>
