<?php
$conn = mysqli_connect("localhost", "root", "", "hanc");

if(isset($_POST['keysearch']))
	{
		$search = $_POST["keysearch"];
		$data = mysqli_query($conn, "SELECT * FROM items WHERE item_short LIKE '%$search%'");
		while($row = mysqli_fetch_array($data))
		{
		?>
		<div class="show"><?= $row["item_name"] ?></div>
		<?php
		}
	}
?>