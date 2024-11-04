<?php
// Start session and include database connection
session_start();
require 'config.php';  // Adjust this path according to your setup

// SQL query to fetch products
$sql = "SELECT product_name, quantity, price_per_kg, description FROM products"; // Adjust columns as necessary
$result = mysqli_query($con, $sql);

// Check if query was successful
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
        body {
            background-color: #eaf7e5; /* Light green background */
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            margin: 50px auto;
            width: 80%;
            max-width: 700px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            text-align: center;
        }
        h1 {
            color: #28a745;
            font-size: 24px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        th {
            font-weight: bold;
            color: #28a745;
            background-color: #f1f8f2;
        }
        td {
            color: #333;
        }
        tr:hover {
            background-color: #f9f9f9;
        }
    </style>
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
                <th>Additional Data</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetch and display products
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['product_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['quantity']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['price_per_kg']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No products found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>

<?php
// Close database connection
mysqli_close($con);
?>
