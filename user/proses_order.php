<?php
// This file would handle the order processing
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $itemId = $_POST['item_id'] ?? '';
    $quantity = $_POST['quantity'] ?? 1;

    // In a real application, you would:
    // 1. Validate the input
    // 2. Check if the item exists in your database
    // 3. Add the item to the user's cart (stored in session or database)
    // 4. Redirect back to the menu page or to a cart page

    // For this example, we'll just store in session
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Add to cart or increase quantity if already in cart
    if (isset($_SESSION['cart'][$itemId])) {
        $_SESSION['cart'][$itemId] += $quantity;
    } else {
        $_SESSION['cart'][$itemId] = $quantity;
    }

    // Redirect back to the menu page with a success message
    header("Location: index.php?order_status=success&item_id=$itemId");
    exit;
} else {
    // If someone tries to access this file directly, redirect to the home page
    header("Location: index.php");
    exit;
}
