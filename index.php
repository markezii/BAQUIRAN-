<?php
session_start();

// --- SAMPLE USER ACCOUNT (you can replace this) ---
$valid_username = "Baquiran";
$valid_password_hash = password_hash("12345", PASSWORD_DEFAULT); 
// Change "12345" to your password

// --- LOGOUT ---
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}

// --- LOGIN PROCESS ---
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $valid_username && password_verify($password, $valid_password_hash)) {
        $_SESSION['user'] = $username;
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Simple Login</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        input { padding: 8px; width: 250px; margin-bottom: 10px; }
        button { padding: 10px 20px; }
        .box { width: 300px; padding: 20px; border: 1px solid #ccc; }
    </style>
</head>
<body>

<div class="box">

<?php if (!isset($_SESSION['user'])) : ?>

    <h2>Login</h2>

    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

    <form method="POST">
        <label>Username</label><br>
        <input type="text" name="username" required><br>

        <label>Password</label><br>
        <input type="password" name="password" required><br>

        <button type="submit" name="login">Login</button>
    </form>

<?php else : ?>

    <h3>Welcome, <?php echo $_SESSION['user']; ?>!</h3>
    <a href="?logout=true"><button>Logout</button></a>

<?php endif; ?>

</div>

</body>
</html>