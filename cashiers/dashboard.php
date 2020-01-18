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

?>
<div align="center">
        <strong style="font-size:25px; padding: 5px;">User Dashboard</strong> 
     
            <strong>Reserved:</strong> <?= $rwqt_res ?> &nbsp;  <strong>Available:</strong> <?= $rwqt_ava ?> 
            &nbsp; | &nbsp; 
            <strong>Date:</strong> <?= date("d-M-Y",time() - 54000) ?>  &nbsp; 
            <strong>Time:</strong> <?= date("H:i:s",time() + 54000) ?>
        
            	<hr /></div>
	<h2>Business Overview</h2>

		<div id="overview_waiteress" style="">
                <a href="db_waiteress_info.php">
                <div align="center">
                <strong style="font-size:50px; color:#fff;"><?= $sumquser_section ?></strong><br /><br />
                <strong>Active Waitress</strong>
                </div></a>
        </div>
        
        <div id="overview_sales" style="">
                <a href="db_table_management.php">
                <div align="center">
                <strong style="font-size:50px; color:#fff;"><?= $sum_table ?></strong>
                <br /><br />
                Registered Table
                </div></a>
        </div>
        
        <div id="overview_cash" style="">
                <a href="db_sale_journal.php">
                <div align="center">
                <strong style="font-size:25px; color:#fff;">RM<br/><?= number_format($rsale["SUM(paid_total)"], 2) ?></strong>
                <br /><br />
                Today's Sales
                </div></a>
        </div>
        
        <div id="overview_item" style="">
                <a href="db_food_drink_management.php">
                <div align="center">
                <strong style="font-size:35px; color:#fff;"><?= $sum_item ?></strong>
                <br /><br />
                Item(s) Registered
                </div></a>
        </div>
        
		<div id="overview_promo" style="">
                <a href="promotion.php">
                <div align="center">
                <strong style="font-size:35px; color:#fff;"><?= $sum_promo ?></strong>
                <br /><br />
				Promotion(s)
                </div></a>
        </div>
        <br /><br />



<?php
require_once("template/._footer_dashboard.php");

}else{
	header("Location: ../index.php");
}
?>