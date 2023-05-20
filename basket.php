
<?php
session_start();

// Check if the basket array exists in the session
if (!isset($_SESSION['basket'])) {
    $_SESSION['basket'] = []; // Create an empty basket array
}

// Handle adding an item to the basket
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['item_id'])) {
    $item_id = $_POST['item_id'];
    $quantity = $_POST['quantity'] ?? 1;

    // Add the item to the basket or update the quantity if already added
    if (isset($_SESSION['basket'][$item_id])) {
        $_SESSION['basket'][$item_id] += $quantity;
    } else {
        $_SESSION['basket'][$item_id] = $quantity;
    }

    // Redirect back to the previous page or a dedicated shopping basket page
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit;
}

// Handle updating the basket (e.g., removing an item)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_basket'])) {
    $item_id = $_POST['item_id'];

    // Remove the item from the basket
    unset($_SESSION['basket'][$item_id]);

    // Redirect back to the shopping basket page
    header("Location: shopping_basket.php");
    exit;
}

// Calculate the total price of the items in the basket
function calculateTotalPrice() {
    $total = 0;

    // Connect to the database
    $host = 'localhost';
    $username = 'basket_user';
    $password = '777pas';
    $dbname = 'your_dbname';
    $conn = new mysqli($host, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve merchandise prices from the database
    $sql = "SELECT id, price FROM merchandise";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Create an associative array to store item prices
        $item_prices = [];
        while ($row = $result->fetch_assoc()) {
            $item_id = $row['id'];
            $item_price = $row['price'];
            $item_prices[$item_id] = $item_price;
        }

        // Calculate the total price based on item quantities in the basket
        foreach ($_SESSION['basket'] as $item_id => $quantity) {
            if (isset($item_prices[$item_id])) {
                $total += $item_prices[$item_id] * $quantity;
            }
        }
    }

    // Close the database connection
    $conn->close();

    return $total;
}
?>
