<?php
require_once("includes/connection.php");
	if(isset($_POST['keysearch']))
		{
			$search = $_POST["keysearch"];
			$table_no = $_GET["table_no"];
			$type_name = $_GET["type_name"];
			$data = mysqli_query($conn, "SELECT * FROM items WHERE item_type = '{$type_name}' AND item_short LIKE '%$search%' ");
			
			while($row = mysqli_fetch_array($data))
			{
			?>
			<a href="order.php?item_id=<?= $row["item_id"] ?>&table_no=<?= $table_no ?>&type_name=<?= $row["item_type"] ?>">
			<div class="show">
				<?= $row["item_name"] ?><br />
					<small>
						RM <?= number_format($row["item_price"], 2) ?> - <?= $row["item_short"] ?>
					</small>
				
			</div></a>
			<?php
			}
		}
?>