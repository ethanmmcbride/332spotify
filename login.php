<?php
// login.php
session_start();
$error = '';

// Database connection - using music_project database
$conn = new mysqli('localhost', 'root', '', 'music_project');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Prevent SQL injection
    $username = $conn->real_escape_string($username);
    
    // Query the users table in music_project database
    $sql = "SELECT * FROM users WHERE Username = '$username'";
    $result = $conn->query($sql);
    
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        
        // Verify password (assuming passwords are stored as plain text - NOT recommended for production)
        // For production, you should use password_hash() and password_verify()
        if ($password === $user['Password']) {
            // Store user data in session
            $_SESSION['username'] = $user['Username'];
            $_SESSION['premium_user'] = $user['Premium_User'];
            
            // Redirect to index.php
            header('Location: index.php');
            exit();
        } else {
            $error = "Invalid username or password";
        }
    } else {
        $error = "Invalid username or password";
    }
    
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Music Database</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Login to Music Database</h1>
        
        <?php if ($error): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form method="POST" action="login.php">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit" class="btn">Login</button>
        </form>
    </div>
</body>
</html>