<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$search = "";
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search  = mysqli_real_escape_string($conn, $_GET['search']);
    $result  = mysqli_query($conn, "SELECT * FROM products WHERE name LIKE '%$search%' OR description LIKE '%$search%'");
} else {
    $result = mysqli_query($conn, "SELECT * FROM products");
}

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
    <title>ShopEasy - Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar">
    <div class="logo">🛒 ShopEasy</div>

    <form class="search-form" method="GET" action="">
        <input type="text" name="search" placeholder="Search products..."
               value="<?php echo htmlspecialchars($search); ?>">
        <button type="submit">🔍</button>
    </form>

    <div class="nav-right">
        <span class="welcome-msg">Hi, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</span>
        <a href="cart.php" class="cart-btn">
            🛒 Cart
            <span class="cart-count"><?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?></span>
        </a>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</nav>

<!-- HERO BANNER -->
<div class="hero">
    <div class="hero-content">
        <div class="hero-badge">🔥 Hot Deals This Week</div>
        <h1>Shop the Latest <span class="highlight">Tech Gadgets</span></h1>
        <p>Premium products at unbeatable prices. Free delivery on orders above Rs.999</p>
        <a href="#products" class="hero-btn">Shop Now →</a>
    </div>
    <div class="hero-image">
        <img src="https://images.unsplash.com/photo-1491933382434-500287f9b54b?w=500" alt="gadgets">
    </div>
</div>

<!-- CATEGORY CHIPS -->
<div class="categories">
    <a href="index.php" class="chip <?php echo empty($search) ? 'active' : ''; ?>">All Products</a>
    <a href="?search=headphones" class="chip">🎧 Audio</a>
    <a href="?search=watch" class="chip">⌚ Watches</a>
    <a href="?search=speaker" class="chip">🔊 Speakers</a>
    <a href="?search=keyboard" class="chip">⌨️ Keyboards</a>
    <a href="?search=bag" class="chip">🎒 Bags</a>
    <a href="?search=hub" class="chip">🔌 Accessories</a>
</div>

<!-- PRODUCTS -->
<div class="container" id="products">
    <?php if (!empty($search)) { ?>
        <h2 class="section-title">Results for: "<?php echo htmlspecialchars($search); ?>"</h2>
    <?php } else { ?>
        <h2 class="section-title">✨ Featured Products</h2>
    <?php } ?>

    <?php $count = mysqli_num_rows($result);
    if ($count == 0) { ?>
        <div class="no-results">
            <p>😕 No products found for "<?php echo htmlspecialchars($search); ?>"</p>
            <a href="index.php" class="add-btn">View All Products</a>
        </div>
    <?php } else { ?>
    <div class="products-grid">
    <?php while ($product = mysqli_fetch_assoc($result)) {
        $img = isset($product_images[$product['id']]) ? $product_images[$product['id']] : "https://via.placeholder.com/400x300?text=" . urlencode($product['name']);
    ?>
        <div class="product-card">
            <div class="product-img-wrap">
                <img src="<?php echo $img; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                <div class="product-badge">In Stock</div>
            </div>
            <div class="product-info">
                <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                <p class="description"><?php echo htmlspecialchars($product['description']); ?></p>
                <div class="stars">⭐⭐⭐⭐⭐</div>
                <div class="price-row">
                    <span class="price">Rs.<?php echo number_format($product['price'], 2); ?></span>
                    <span class="old-price">Rs.<?php echo number_format($product['price'] * 1.2, 2); ?></span>
                </div>
                <a href="add_to_cart.php?id=<?php echo $product['id']; ?>" class="add-btn">
                    🛒 Add to Cart
                </a>
            </div>
        </div>
    <?php } ?>
    </div>
    <?php } ?>
</div>

<!-- FOOTER -->
<footer class="footer">
    <div class="footer-content">
        <div class="footer-brand">
            <h3>🛒 ShopEasy</h3>
            <p>Best tech products delivered fast</p>
        </div>
        <div class="footer-links">
            <span>About Us</span>
            <span>Contact</span>
            <span>Privacy Policy</span>
            <span>Returns</span>
        </div>
    </div>
    <p class="footer-copy">© 2024 ShopEasy. All rights reserved.</p>
</footer>

</body>
</html>