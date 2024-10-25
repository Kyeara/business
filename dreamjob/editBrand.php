<?php
require_once 'core/dbConfig.php'; 
require_once 'core/models.php'; 

$brand = null;
if (isset($_GET['brand_id'])) {
    $brand = getBrandById($pdo, $_GET['brand_id']);
    if (!$brand) {
        die("Brand not found!");
    }
} else {
    die("Invalid brand ID.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Brand</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        input {
            font-size: 1em;
            height: 30px;
            width: 200px;
        }
    </style>
</head>
<body>
    <h3>Edit Brand Information</h3>
    <form action="core/handleForms.php" method="POST">
        <input type="hidden" name="brand_id" value="<?php echo $brand['Brand_ID']; ?>">
        <p><label for="designerBrand">Designer Brand</label> <input type="text" name="designerBrand" value="<?php echo htmlspecialchars($brand['Designer_Brand']); ?>" required></p>
        <p><label for="dateFounded">Date Founded</label> <input type="date" name="dateFounded" value="<?php echo htmlspecialchars($brand['Date_Founded']); ?>" required></p>
        <p><input type="submit" name="updateBrandBtn" value="Update"></p>
    </form>
    <p><a href="index.php">Back to Brand List</a></p>
</body>
</html>
