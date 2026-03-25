<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$cart  = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$total = 0;

$product_images = [
    1 => "https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=400",
    2 => "https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=400",
    3 => "https://images.unsplash.com/photo-1608043152269-423dbba4e7e1?w=400",
    4 => "https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=400",
    5 => "https://images.unsplash.com/photo-1625723044792-44de16ccb4e9?w=400",
    6 => "https://images.unsplash.com/photo-1587829741301-dc798b83add3?w=400"
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart - ShopEasy</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav class="navbar">
    <div class="logo">🛒 ShopEasy</div>
    <div class="nav-right">
        <span class="welcome-msg">Hi, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</span>
        <a href="index.php" class="cart-btn">← Shop</a>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</nav>

<div class="container" style="margin-top:30px;">
    <h2 class="section-title">🛒 Your Cart</h2>

    <?php if (empty($cart)) { ?>
        <div class="empty-cart">
            <div style="font-size:4rem;">🛒</div>
            <h3>Your cart is empty!</h3>
            <p>Looks like you haven't added anything yet.</p>
            <a href="index.php" class="add-btn" style="display:inline-block;margin-top:15px;">
                Start Shopping →
            </a>
        </div>
    <?php } else { ?>

    <div class="cart-layout">

        <!-- Cart Items -->
        <div class="cart-items">
        <?php foreach ($cart as $item) {
            $subtotal = $item['price'] * $item['quantity'];
            $total   += $subtotal;
            $img      = isset($product_images[$item['id']]) ? $product_images[$item['id']] : "https://via.placeholder.com/100";
        ?>
            <div class="cart-item-card">
                <img src="<?php echo $img; ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
                <div class="cart-item-info">
                    <h4><?php echo htmlspecialchars($item['name']); ?></h4>
                    <p class="cart-item-price">Rs.<?php echo number_format($item['price'], 2); ?> each</p>
                    <p>Quantity: <strong><?php echo $item['quantity']; ?></strong></p>
                    <p>Subtotal: <strong class="subtotal-amount">Rs.<?php echo number_format($subtotal, 2); ?></strong></p>
                </div>
                <a href="remove_from_cart.php?id=<?php echo $item['id']; ?>" class="remove-btn">✕ Remove</a>
            </div>
        <?php } ?>
        </div>

        <!-- Order Summary -->
        <div class="order-summary">
            <h3>Order Summary</h3>
            <div class="summary-row">
                <span>Items (<?php echo count($cart); ?>)</span>
                <span>Rs.<?php echo number_format($total, 2); ?></span>
            </div>
            <div class="summary-row">
                <span>Delivery</span>
                <span class="free-delivery"><?php echo $total > 999 ? 'FREE' : 'Rs.99'; ?></span>
            </div>
            <div class="summary-row discount">
                <span>Discount (20%)</span>
                <span>- Rs.<?php echo number_format($total * 0.20, 2); ?></span>
            </div>
            <hr style="border-color:#444;margin:15px 0;">
            <div class="summary-row total-row">
                <span>Total</span>
                <span>Rs.<?php echo number_format($total - ($total * 0.20) + ($total > 999 ? 0 : 99), 2); ?></span>
            </div>
            <button class="checkout-btn" onclick="alert('Order placed successfully! 🎉')">
                Checkout Now 🚀
            </button>
            <a href="index.php" class="continue-shopping">← Continue Shopping</a>
        </div>

    </div>
    <?php } ?>
</div>

<footer class="footer">
    <p class="footer-copy">© 2024 ShopEasy. All rights reserved.</p>
</footer>

</body>
</html>