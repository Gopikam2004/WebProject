<?php
require 'config.php';
session_start();
$sql = "SELECT product_name, quantity, price_per_kg, description FROM products";
$result = mysqli_query($con, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($con));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        table th {
            background-color: #f2f2f2;
        }
        table td {
            background-color: #fafafa;
        }
    </style>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <h1>Products List</h1>
    
    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity (kg)</th>
                <th>Price per kg</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['product_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['quantity']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['price_per_kg']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                    echo "<td>
                            <form action='view_cart.php' method='POST'>
                                <input type='hidden' name='product_name' value='" . htmlspecialchars($row['product_name']) . "'>
                                <button type='submit' class='button'>Add to Cart</button>
                            </form>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No products available.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>

<?php
mysqli_close($con);
?>
