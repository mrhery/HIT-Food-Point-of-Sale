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
	<h2>Prmotion Management</h2>

	
	<div align="center">
	<div align="right" id="rb_menu" style="margin-right:25px;"><a href="add_promo.php">Register New Promotion</a></div>
    <br />
	<table class="tbl" width="80%" style="border:#F30 groove; border-top-right-radius:10px; border-top-left-radius:10px;">
    	<tr style="background:#F30;" >
        	<th>No</th>
            <th>Name</th>
            <th>Time Type</th>
            <th>TIme</th>
            <th>Rate Type</th>
            <th>Rate</th>
			<th>Action</th>
        </tr>
        
        <?php
		$no = 0 + 1;
		$qpromo = mysqli_query($conn, "SELECT * FROM promos")	;
		while($rpromo = mysqli_fetch_array($qpromo)){
		?>
        <tr>
        	
        	<td align="center"><?= $no ?></td>
            <td align="center"><?= $rpromo["promo_name"] ?></td>
            <td align="center"><?= $rpromo["promo_twhen"] ?></td>
            <td align="center"><?= $rpromo["promo_when"] ?></td>
            <td align="center"><?= $rpromo["promo_trate"] ?></td>
            <td align="center"><?= $rpromo["promo_rate"] ?></td>
			<td><div id="delete_button"><a href="del_promo.php?promo=<?= $rpromo["promo_id"] ?>"><strong>Delete</a></strong></div></td>
        </tr>
    	<?php
		$no++;
				}
        ?>
    </table>

</div>
        

        

        

        <br /><br />



<?php
require_once("template/._footer_dashboard.php");

}else{
	header("Location: ../index.php");
}
?>