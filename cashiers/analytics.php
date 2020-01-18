<?php
session_start();
if(!isset($_SESSION["user_name"])){
	header("Location: index.php");
}
	
$user_name = $_SESSION["user_name"];
require_once("includes/connection.php");
if(isset($_GET["data"])){
	$data = $_GET["data"];
}else{
	$data = date("Y");
}

$qpaid = mysqli_query($conn, "SELECT SUM(paid_total) FROM paids WHERE paid_date LIKE '%$data%'");
$rpaid = mysqli_fetch_array($qpaid);
?>

<html>
<header>
	<title>Hanc Kitchen Analysis</title>
</header>

<body style="margin-left: 100px; margin-top: 100px; margin-right: 100px;">

	<h2>Hanc Kitchen - <small>Analysis Report <form action="" method="GET">Date :<input type="text" value="<?= $data ?>" name="data" /> <input type="submit" value="submit" /></form></small></h2>
	<table style="width: 100%;" border="1">
		<tr>
			<th>No</th>
			<th>Item</th>
			<th>Quantity</th>
			<th>Price</th>
			<th>Total (RM)</th>
		</tr>
	<?php
		$no = 1;
		$qana = mysqli_query($conn, "SELECT * FROM anas WHERE ana_date LIKE '%$data%' ");
		while($rana = mysqli_fetch_array($qana)){
	?>
		<tr>
			<td align="center" width="5%"><?= $no ?></td>
			<td align="center"><?= $rana["ana_item"] ?></td>
			<td align="center"><?= $rana["ana_qty"] ?></td>
			<td align="right"><?= number_format($rana["ana_price"], 2) ?></td>
			<td align="right"><?= number_format($rana["ana_qty"] * $rana["ana_price"], 2) ?></td>
		</tr>
	<?php
		$no++;
		}
	?>
	
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td align="right">
				<?= number_format($rpaid["SUM(paid_total)"], 2) ?>
			</td>
		</tr>
		
	</table>


</body>
</html>

