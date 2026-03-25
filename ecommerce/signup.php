<?php
session_start();
include 'db.php';

$error   = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $confirm  = $_POST['confirm'];

    if (empty($fullname) || empty($email) || empty($password)) {
        $error = "All fields are required!";
    } elseif ($password !== $confirm) {
        $error = "Passwords do not match!";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters!";
    } else {
        $check = mysqli_query($conn, "SELECT id FROM users WHERE email='$email'");
        if (mysqli_num_rows($check) > 0) {
            $error = "Email already registered! Please login.";
        } else {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $sql    = "INSERT INTO users (fullname, email, password) VALUES ('$fullname', '$email', '$hashed')";
            if (mysqli_query($conn, $sql)) {
                $success = "Account created! You can now login.";
            } else {
                $error = "Something went wrong. Try again.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - ShopEasy</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="auth-body">

<div class="auth-wrapper">

    <!-- Left Panel -->
    <div class="auth-left">
        <div class="auth-brand">
            <div class="brand-icon">🛒</div>
            <h1>ShopEasy</h1>
            <p>Join thousands of happy shoppers</p>
        </div>
        <div class="auth-features">
            <div class="feature-item">⚡ Fast Delivery</div>
            <div class="feature-item">🔒 Secure Payments</div>
            <div class="feature-item">🎁 Exclusive Deals</div>
            <div class="feature-item">⭐ Top Rated Products</div>
        </div>
    </div>

    <!-- Right Panel - Form -->
    <div class="auth-right">
        <div class="auth-card">
            <h2>Create Account</h2>
            <p class="auth-subtitle">Start shopping today!</p>

            <?php if ($error) { ?>
                <div class="alert alert-error">❌ <?php echo $error; ?></div>
            <?php } ?>
            <?php if ($success) { ?>
                <div class="alert alert-success">✅ <?php echo $success; ?></div>
            <?php } ?>

            <form method="POST" action="">

                <div class="form-group">
                    <label>Full Name</label>
                    <div class="input-wrapper">
                        <span class="input-icon">👤</span>
                        <input type="text" name="fullname" placeholder="John Doe" required
                               value="<?php echo isset($_POST['fullname']) ? htmlspecialchars($_POST['fullname']) : ''; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label>Email Address</label>
                    <div class="input-wrapper">
                        <span class="input-icon">📧</span>
                        <input type="email" name="email" placeholder="john@email.com" required
                               value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <div class="input-wrapper">
                        <span class="input-icon">🔑</span>
                        <input type="password" name="password" placeholder="Min 6 characters" required>
                        <span class="toggle-pw" onclick="togglePw('password')">👁</span>
                    </div>
                </div>

                <div class="form-group">
                    <label>Confirm Password</label>
                    <div class="input-wrapper">
                        <span class="input-icon">🔑</span>
                        <input type="password" name="confirm" placeholder="Repeat password" required>
                        <span class="toggle-pw" onclick="togglePw('confirm')">👁</span>
                    </div>
                </div>

                <button type="submit" class="auth-submit-btn">Create Account 🚀</button>
            </form>

            <p class="auth-switch">Already have an account? <a href="login.php">Login here</a></p>
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