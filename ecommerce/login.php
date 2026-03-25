<?php
session_start();
include 'db.php';

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $error = "Please fill in all fields!";
    } else {
        $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
        $user   = mysqli_fetch_assoc($result);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id']   = $user['id'];
            $_SESSION['user_name'] = $user['fullname'];
            header("Location: index.php");
            exit();
        } else {
            $error = "Wrong email or password!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ShopEasy</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="auth-body">

<div class="auth-wrapper">

    <!-- Left Panel -->
    <div class="auth-left">
        <div class="auth-brand">
            <div class="brand-icon">🛒</div>
            <h1>ShopEasy</h1>
            <p>Your one-stop tech shop</p>
        </div>
        <div class="auth-features">
            <div class="feature-item">⚡ Fast Delivery</div>
            <div class="feature-item">🔒 Secure Payments</div>
            <div class="feature-item">🎁 Exclusive Deals</div>
            <div class="feature-item">⭐ Top Rated Products</div>
        </div>
    </div>

    <!-- Right Panel -->
    <div class="auth-right">
        <div class="auth-card">
            <h2>Welcome Back!</h2>
            <p class="auth-subtitle">Login to continue shopping</p>

            <?php if ($error) { ?>
                <div class="alert alert-error">❌ <?php echo $error; ?></div>
            <?php } ?>

            <form method="POST" action="">

                <div class="form-group">
                    <label>Email Address</label>
                    <div class="input-wrapper">
                        <span class="input-icon">📧</span>
                        <input type="email" name="email" placeholder="john@email.com" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <div class="input-wrapper">
                        <span class="input-icon">🔑</span>
                        <input type="password" name="password" placeholder="Your password" required>
                        <span class="toggle-pw" onclick="togglePw('password')">👁</span>
                    </div>
                </div>

                <button type="submit" class="auth-submit-btn">Login →</button>
            </form>

            <p class="auth-switch">No account yet? <a href="signup.php">Sign up free</a></p>
        </div>
    </div>

</div>

<script>
function togglePw(name) {
    const input = document.querySelector(`input[name="${name}"]`);
    input.type = input.type === 'password' ? 'text' : 'password';
}
</script>

</body>
</html>