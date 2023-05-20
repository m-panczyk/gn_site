
<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/base.css">
<link rel="stylesheet" href="css/light.css" id="css-link">
<title> gn - Sklep </title>
</head>
<body>
<select id="css-list" class="rt-float">
<option value="css/light.css">Light</option>
<option value="css/dark.css">Dark</option>
<option value="css/wierd.css">Wierd</option>
</select>

<header>
<a href="https://m-panczyk.github.io/gn_site/">
<img id="logo" src="logo.png" alt="gn">
</a>
<nav>
<ul class="col-2">
<li class="col-auto" id="menu" ><a>Menu</a></li>
<li class="col-auto menu-link"><a href="index.html">Start</a></li>
<li class="col-auto menu-link"><a href="o-projekcie.html">Projekt</a></li>
<li class="col-auto menu-link"><a href="zalety.html">Zalety</a></li>
<li class="col-auto menu-link"><a href="zalozenia.html">Założenia</a></li>
<li class="col-auto menu-link"><a href="o-autorach.html">Autorzy</a></li>
<li class="col-auto menu-link"><a href="kontakt.html">Kontakt</a></li>
<li class="col-auto menu-link"><a href="sklep.php">Sklep</a></li>
</ul>
</nav>
</header>
<main>
<section>
<h2 class="col-2">Sklep</h2>
    <p class="col-1">W naszym sklepie znajdziesz różne gadżety związane z GN. Wszystkie produkty są dostępne w różnych kolorach i rozmiarach. Zyski ze sprzedaży są przekazywane na rozwój projektu</p>
<div class="col-1">
	<a href="basket.php">Koszyk</a>
	 <?php
            // Check if the user is logged in
            if (isset($_SESSION['user_id'])) {
                // User is logged in, show logout link
                echo '<a href="logout.php">Wyloguj</a>';
            } else {
                // User is not logged in, show login/registration links
                echo '<a href="login.html">Zaloguj</a>';
                echo '<a href="register.html">Zarejestruj</a>';
            }
	    ?>
</div>	

<?php
// Connect to the database
$host = 'localhost';
$username = 'shop_user';
$password = '666pas';
$dbname = 'shop_db';
$conn = new mysqli($host, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve merchandise data from the database
$sql = "SELECT m.id, m.name, m.price, i.src FROM merchandise m
        INNER JOIN img_src i ON m.img_id = i.id";
$result = $conn->query($sql);

echo '<div class="col-1 flex_container">';
// Display merchandise items
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $item_id = $row['id'];
        $item_name = $row['name'];
        $item_price = $row['price'];
        $img_src = $row['src'];

        echo '<div class="col-1 merchandise-item">';
        echo '<h3>' . $item_name . '</h3>';
        echo '<img class="col-2" src="' . $img_src . '" alt="' . $item_name . '">';
        echo '<p>Cena: $' . $item_price . '</p>';
        echo '<form action="basket.php" method="POST">';
        echo '<input type="hidden" name="item_id" value="' . $item_id . '">';
        echo '<label for="quantity' . $item_id . '">Ilość:</label>';
        echo '<input type="number" name="quantity" id="quantity' . $item_id . '" value="1" min="1">';
        echo '<button type="submit">Dodaj do koszyka</button>';
        echo '</form>';
        echo '</div>';
    }
} else {
    echo 'Brak dostępnych produktów.';
}

// Close the database connection
$conn->close();
echo '</div>';
?>

</section>
</main>
<script src="script.js"></script>
</body>
</html>
