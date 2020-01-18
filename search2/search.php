<?php
$search = $_POST["search"];
$conn = mysqli_connect("localhost", "root", "", "hanc");

$players = mysqli_query($conn, "SELECT * FROM items WHERE item_short LIKE '%$search%'");
while($player = mysql_fetch_array($players)) {
    echo "<div>" . $players["item_name"] . "</div>";
}
?>