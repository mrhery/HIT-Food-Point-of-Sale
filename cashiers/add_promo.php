<?php
session_start();
if(isset($_SESSION["user_name"])){
require_once("includes/connection.php");
require_once("template/._header.php");

$available = "0";
$reserved = "1";

$qtable = mysqli_query($conn, "SELECT * FROM tables");
$sum_table = mysqli_num_rows($qtable);

$qtable_ava = mysqli_query($conn, "SELECT * FROM tables WHERE table_status = '{$available}'");
$rwqt_ava = mysqli_num_rows($qtable_ava);

$qtable_res = mysqli_query($conn, "SELECT * FROM tables WHERE table_status = '{$reserved}'");
$rwqt_res = mysqli_num_rows($qtable_res);

$waitress = "waitress";
$active = "1";

$quser_waitress = mysqli_query($conn, "SELECT * FROM users WHERE user_section = '{$waitress}' AND user_status = '{$active}'");
$sumquser_section = mysqli_num_rows($quser_waitress);

$today = date("d-M-Y", time() - 54000);

$sale = mysqli_query($conn, "SELECT SUM(paid_total) FROM paids WHERE paid_date = '{$today}'");
$rsale = mysqli_fetch_array($sale);

$qitem = mysqli_query($conn, "SELECT * FROM items");
$sum_item = mysqli_num_rows($qitem);

$qpromo = mysqli_query($conn, "SELECT * FROM promos");
$sum_promo = mysqli_num_rows($qpromo);

if(isset($_POST["submit"])){
	$promo_name = $_POST["promo_name"];
	$promo_twhen = $_POST["promo_twhen"];
	$promo_when = $_POST["promo_when"];
	$promo_trate = $_POST["promo_trate"];
	$promo_rate = $_POST["promo_rate"];
	
	$ipromo = mysqli_query($conn, "INSERT INTO promos(promo_name, promo_twhen, promo_when, promo_trate, promo_rate) VALUES('{$promo_name}', '{$promo_twhen}', '{$promo_when}', '{$promo_trate}', '{$promo_rate}')");
	
	if($ipromo == TRUE){
		header("Location: promotion.php");
	}
}

?>
<div align="center">
        <strong style="font-size:25px; padding: 5px;">User Dashboard</strong> 
     
            <strong>Reserved:</strong> <?= $rwqt_res ?> &nbsp;  <strong>Available:</strong> <?= $rwqt_ava ?> 
            &nbsp; | &nbsp; 
            <strong>Date:</strong> <?= date("d-M-Y",time() - 54000) ?>  &nbsp; 
            <strong>Time:</strong> <?= date("H:i:s",time() + 54000) ?>
        
            	<hr /></div>
	<h2>Add New Promotion</h2>

	<div align="center">
		<div align="right" id="rb_menu" style="margin-right:25px;"><a href="promotion.php">Promotion Management</a></div>
		<br />
	<table class="tbl" width="80%" style="border:#F30 groove; border-top-right-radius:10px; border-top-left-radius:10px;">
		<tr style="background:#F30;" >
			<th>Name</th>
			<th>Type of Time</th>
			<th>Time</th>
			<th>Type of Rate</th>
			<th>Rate</th>
		</tr>

		<tr>
			<form action="" method="post">
				<td align="center"><input type="text" name="promo_name" autofocus="on" placeholder="Promo Name" /></td>
				<td align="center">
					<select name="promo_twhen">
						<option value="day">Day</option>
						<option value="date">Date</option>
					</select>
				</td>
				<td align="center"><input type="text" name="promo_when"  placeholder="Insert date or day" /></td>
				<td align="center">
					<select name="promo_trate">
						<option value="price">Fix Price</option>
						<option value="rate">Percentage</option>
					</select>
				</td>
				<td align="center"><input type="text" name="promo_rate"   placeholder="Rate"/></td>   				
		</tr>

	</table>
	<br />
			<input type="submit" name="submit" value="Add"  />
		</form>
	</div>
	
	
        

        

        

        <br /><br />



<?php
require_once("template/._footer_dashboard.php");

}else{
	header("Location: ../index.php");
}
?>