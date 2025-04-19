<?php
// Database configuration
$host = "localhost";
$username = "root";
$password = "";
$database = "marview_cafeteria";

// Create database connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set character set
$conn->set_charset("utf8mb4");

// Function to sanitize input data
function sanitize($data)
{
    global $conn;
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $conn->real_escape_string($data);
}

// Function to get all menu items from database
function getMenuItems()
{
    global $conn;
    $items = [];

    $sql = "SELECT * FROM menu_items ORDER BY id ASC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }
    }

    return $items;
}

// Function to get a single menu item by ID
function getMenuItem($id)
{
    global $conn;

    $id = sanitize($id);
    $sql = "SELECT * FROM menu_items WHERE id = '$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    }

    return null;
}

// Function to process an order
function processOrder($userId, $items, $totalAmount, $address, $phone)
{
    global $conn;

    // Sanitize inputs
    $userId = sanitize($userId);
    $totalAmount = sanitize($totalAmount);
    $address = sanitize($address);
    $phone = sanitize($phone);

    // Start transaction
    $conn->begin_transaction();

    try {
        // Insert order into orders table
        $sql = "INSERT INTO orders (user_id, total_amount, delivery_address, phone, order_date, status) 
                VALUES ('$userId', '$totalAmount', '$address', '$phone', NOW(), 'pending')";

        if ($conn->query($sql) === TRUE) {
            $orderId = $conn->insert_id;

            // Insert order items
            foreach ($items as $item) {
                $itemId = sanitize($item['id']);
                $quantity = sanitize($item['quantity']);
                $price = sanitize($item['price']);

                $sql = "INSERT INTO order_items (order_id, item_id, quantity, price) 
                        VALUES ('$orderId', '$itemId', '$quantity', '$price')";

                if (!$conn->query($sql)) {
                    throw new Exception("Error inserting order items: " . $conn->error);
                }
            }

            // Commit transaction
            $conn->commit();
            return $orderId;
        } else {
            throw new Exception("Error creating order: " . $conn->error);
        }
    } catch (Exception $e) {
        // Rollback transaction on error
        $conn->rollback();
        return false;
    }
}
