<?php
// Include database configuration
require 'config.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = mysqli_real_escape_string($con, $_POST['product_name']);
    $quantity = mysqli_real_escape_string($con, $_POST['quantity']);
    $price_per_kg = mysqli_real_escape_string($con, $_POST['price_per_kg']);
    $description = mysqli_real_escape_string($con, $_POST['description']);

    // Insert product into database without farmer_id
    $query = "INSERT INTO products (product_name, quantity, price_per_kg, description) VALUES ('$product_name', '$quantity', '$price_per_kg', '$description')";
    
    if (mysqli_query($con, $query)) {
        echo "<script>alert('Product added successfully!'); window.location.href = 'farmerhome.html';</script>";
    } else {
        echo "<script>alert('Error: Could not add product');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Add New Product</h2>
        <form action="add_product.php" method="post">
            <div class="form-group">
                <label for="product_name">Product Name</label>
                <input type="text" class="form-control" id="product_name" name="product_name" required>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity (in kg)</label>
                <input type="number" class="form-control" id="quantity" name="quantity" min="1" required>
            </div>
            <div class="form-group">
                <label for="price_per_kg">Price per kg</label>
                <input type="number" class="form-control" id="price_per_kg" name="price_per_kg" step="0.01" min="0" required>
            </div>
            <div class="form-group">
                <label for="description">Description (optional)</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Add Product</button>
        </form>
    </div>
</body>
</html>
