<?php
require_once 'core/dbConfig.php'; 
require_once 'core/models.php'; 

// Fetch all brands to display in the dropdown
$brands = fetchAllBrands($pdo);

// Fetch all products to display in the table
$products = fetchAllProducts($pdo);

// Check for success or error message
$successMessage = '';
$errorMessage = '';

// Handling form submission for adding a brand
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['insertNewBrandBtn'])) {
    $designerBrand = trim($_POST['designerBrand']);
    $dateFounded = trim($_POST['dateFounded']);

    if (!empty($designerBrand) && !empty($dateFounded)) {
        $brandInserted = insertBrand($pdo, $designerBrand, $dateFounded);
        if ($brandInserted) {
            $successMessage = "Brand added successfully!";
            $brands = fetchAllBrands($pdo); // Refresh brand list
        } else {
            $errorMessage = "Failed to add brand.";
        }
    } else {
        $errorMessage = "Please fill in all fields.";
    }
}

// Handling form submission for adding a product
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['insertNewProductBtn'])) {
    $brandID = trim($_POST['brandID']);
    $productType = trim($_POST['productType']);
    $productName = trim($_POST['productName']);
    $price = (float)$_POST['price'];
    $quantity = (int)$_POST['quantity'];

    if (!empty($brandID) && !empty($productType) && !empty($productName) && 
        $price >= 0 && $quantity >= 0) {
        
        $productInserted = insertProduct($pdo, $brandID, $productType, $productName, $price, $quantity);
        if ($productInserted) {
            $successMessage = "Product added successfully!";
            $products = fetchAllProducts($pdo); // Refresh product list
        } else {
            $errorMessage = "Failed to add product.";
        }
    } else {
        $errorMessage = "Please fill in all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to the external CSS file -->
</head>
<body>
    <h3>Add New Brand</h3>
    <?php if ($successMessage) echo "<div class='message success'>$successMessage</div>"; ?>
    <?php if ($errorMessage) echo "<div class='message error'>$errorMessage</div>"; ?>

    <form action="" method="POST">
        <p><label for="designerBrand">Designer Brand</label> <input type="text" name="designerBrand" required></p>
        <p><label for="dateFounded">Date Founded</label> <input type="date" name="dateFounded" required></p>
        <p><input type="submit" name="insertNewBrandBtn" value="Add Brand"></p>
    </form>

    <h3>Add New Product</h3>
    <form action="" method="POST">
        <p>
            <label for="brandID">Designer Brand</label>
            <select name="brandID" required>
                <option value="">Select a Brand</option>
                <?php foreach ($brands as $brand): ?>
                    <option value="<?php echo $brand['Brand_ID']; ?>"><?php echo htmlspecialchars($brand['Designer_Brand']); ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        <p><label for="productType">Product Type</label> <input type="text" name="productType" required></p>
        <p><label for="productName">Product Name</label> <input type="text" name="productName" required></p>
        <p><label for="price">Price</label> <input type="number" step="0.01" name="price" required></p>
        <p><label for="quantity">Quantity</label> <input type="number" name="quantity" required></p>
        <p><input type="submit" name="insertNewProductBtn" value="Add Product"></p>
    </form>

    <h3>Product List</h3>
    <table>
        <tr>
            <th>Product ID</th>
            <th>Designer Brand</th>
            <th>Product Type</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Action</th>
        </tr>
        <?php foreach ($products as $product): ?>
        <tr>
            <td><?php echo htmlspecialchars($product['Product_ID']); ?></td>
            <td><?php echo htmlspecialchars($product['Designer_Brand']); ?></td>
            <td><?php echo htmlspecialchars($product['Product_Type']); ?></td>
            <td><?php echo htmlspecialchars($product['Product_Name']); ?></td>
            <td><?php echo htmlspecialchars($product['Price']); ?></td>
            <td><?php echo htmlspecialchars($product['Quantity']); ?></td>
            <td>
                <a href="editProduct.php?product_id=<?php echo $product['Product_ID']; ?>">Edit</a>
                <a href="core/handleForms.php?action=delete&product_id=<?php echo $product['Product_ID']; ?>" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
