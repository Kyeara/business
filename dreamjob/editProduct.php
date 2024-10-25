<?php
require_once 'core/dbConfig.php'; 
require_once 'core/models.php'; 

// Fetch all brands to display in the dropdown
$brands = fetchAllBrands($pdo);

if (isset($_GET['product_id'])) {
    $product = getProductById($pdo, $_GET['product_id']);
    if (!$product) {
        die("Product not found!");
    }
} else {
    die("Invalid product ID.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
    <h3>Edit Product Information</h3>
    <form action="core/handleForms.php" method="POST">
        <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['Product_ID']); ?>">
        
        <p>
            <label for="brandID">Designer Brand</label>
            <select name="brandID" required>
                <option value="">Select a Brand</option>
                <?php foreach ($brands as $brand): ?>
                    <option value="<?php echo $brand['Brand_ID']; ?>" <?php echo ($brand['Brand_ID'] == $product['Brand_ID']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($brand['Designer_Brand']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </p>

        <p>
            <label for="productType">Product Type</label>
            <input type="text" name="productType" value="<?php echo htmlspecialchars($product['Product_Type']); ?>" required>
        </p>
        <p>
            <label for="productName">Product Name</label>
            <input type="text" name="productName" value="<?php echo htmlspecialchars($product['Product_Name']); ?>" required>
        </p>
        <p>
            <label for="price">Price</label>
            <input type="number" step="0.01" name="price" value="<?php echo htmlspecialchars($product['Price']); ?>" required>
        </p>
        <p>
            <label for="quantity">Quantity</label>
            <input type="number" name="quantity" value="<?php echo htmlspecialchars($product['Quantity']); ?>" required>
        </p>
        <p><input type="submit" name="updateProductBtn" value="Update"></p>
    </form>
    <p><a href="index.php">Back to Product List</a></p>
</body>
</html>
