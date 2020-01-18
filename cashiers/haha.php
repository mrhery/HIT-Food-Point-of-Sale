<?php
include_once("includes/connection.php");

$drink = "Set";
$qitem = mysqli_query($conn, "SELECT * FROM items WHERE item_type = '{$drink}'");
$no = 0 + 1;
while($row = mysqli_fetch_array($qitem)){
	?>
			
			<?= $no ?>. <?= $row["item_name"] ?> (RM <?= number_format($row["item_price"], 2) ?>) (<?= $row["item_category"] ?>)<br />
			<?= $row["item_desc"] ?>
			<hr />
		
	<?php
	$no++;
}


?>