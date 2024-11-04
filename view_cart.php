<?php
session_start();
require 'config.php';

// Check if the user is logged in

$username = mysqli_real_escape_string($con, $_SESSION['Name']);

// Fetch cart items for the logged-in user
$sql = "SELECT product_name, farmer_name, quantity FROM cart WHERE username = '$username'";
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
    <title>Your Cart</title>
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
</head>
<body>

<div class="container">
    <h1>Your Cart</h1>
    
    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Farmer Name</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['product_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['farmer_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['quantity']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No products in your cart.</td></tr>";
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
