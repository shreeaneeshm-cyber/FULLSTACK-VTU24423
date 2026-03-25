<?php
session_start();
include 'db.php';

$id = intval($_GET['id']);

$result  = mysqli_query($conn, "SELECT * FROM products WHERE id = $id");
$product = mysqli_fetch_assoc($result);

if ($product) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['quantity']++;
    } else {
        $_SESSION['cart'][$id] = [
            'id'       => $product['id'],
            'name'     => $product['name'],
            'price'    => $product['price'],
            'image'    => $product['image'],
            'quantity' => 1
        ];
    }
}

header("Location: index.php");
exit();
?>