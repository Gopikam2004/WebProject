<?php
// Start a session to store user login status
session_start();

// Include the database configuration file
require 'config.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = $_POST['password']; // Do not hash yet, we'll verify this against the hashed password in the database.

    // Fetch user details from the database based on the email
    $query = "SELECT * FROM buyerreg WHERE Email = '$email'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        
        // Verify the entered password against the hashed password stored in the database
        if (password_verify($password, $user['Password'])) {
            // Password is correct, set session variables and redirect to farmerhome.php
            $_SESSION['user_id'] = $user['id']; // Assuming there's an 'id' column in farmerreg table
            $_SESSION['user_email'] = $user['Email'];
            header("Location: buyerhome.html");
            exit;
        } else {
            // Incorrect password
            $error = "Invalid email or password. Please try again.";
        }
    } else {
        // Email not found
        $error = "Invalid email or password. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* Style adjustments for centered alignment */
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #e8f5e9;
            margin: 0;
        }

        .form-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
        }

        form {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .login-btn {
            width: 100%;
            padding: 10px;
            background-color: #388e3c;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        .login-btn:hover {
            background-color: #2e7d32;
        }

        .options {
            text-align: center;
            margin-top: 15px;
        }

        .options a {
            color: #388e3c;
            text-decoration: none;
            margin: 5px;
        }

        .options a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="form-wrapper">
        <form action="buyer.php" method="post">
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="login-btn">Login</button>

            <!-- Display error message if login fails -->
            <?php if (isset($error)): ?>
                <p style="color: red; text-align: center;"><?php echo $error; ?></p>
            <?php endif; ?>

            <!-- Additional options: Forgot Password and Sign Up -->
            <div class="options">
                <a href="forgot-password.html">Forgot Password?</a> | 
                <a href="buyerreg.php">Sign Up</a>
            </div>
        </form>
    </div>
</body>
</html>
