<?php
session_start();
if(isset($_SESSION["user_name"])){
$user_name = $_SESSION["user_name"];
require_once("template/._header.php");
require_once("includes/connection.php");

$available = "0";
$reserved = "1";

$qtable_ava = mysqli_query($conn, "SELECT * FROM tables WHERE table_status = '{$available}'");
$rwqt_ava = mysqli_num_rows($qtable_ava);

$qtable_res = mysqli_query($conn, "SELECT * FROM tables WHERE table_status = '{$reserved}'");
$rwqt_res = mysqli_num_rows($qtable_res);

if(isset($_POST["submit"])){
	
	$paid_total = $_POST["paid_total"];
	
	if(empty($paid_total)){
		echo"
			<script>
				alert('Please insert Paid Amount!');
			</script>
		";
		
	}else{
	
	
	$paid_cashier = $user_name;
	$paid_date = date("d-M-Y",time() - 54000);
	$paid_time = date("H:i:s", time() + 54000);
	$paid_month = date("M", time() - 54000);
	$paid_year = date("Y", time() - 54000);
	$paid_type = "lunch";
	
	$ipaid = mysqli_query($conn, "INSERT INTO paids(paid_date, paid_time, paid_month, paid_year, paid_type, paid_cashier, paid_total) VALUES('{$paid_date}', '{$paid_time}', '{$paid_month}', '{$paid_year}', '{$paid_type}', '{$paid_cashier}', '{$paid_total}')");
}}

?>

<div align="center">
        <strong style="font-size:25px; padding: 5px;">Lunch's Sales</strong> 
     
            <strong>Reserved:</strong> <?= $rwqt_res ?> &nbsp;  <strong>Available:</strong> <?= $rwqt_ava ?> 
            &nbsp; | &nbsp; 
            <strong>Date:</strong> <?= date("d-M-Y",time() - 54000) ?>  &nbsp; 
            <strong>Time:</strong> <?= date("H:i:s",time() + 54000) ?>
        
            	<hr />
                <br />
			
			<form action="" method="POST">
				<input type="number" name="paid_total" style="font-size:20px;" placeholder="Sales amount" autofocus="on" />
				<input type="submit" name="submit" value="Submit" style="font-size: 20px;"/>
			</form>
			
			<br /><br />
			
			<table class="tbl" width="80%" style="border:#F30 groove; border-top-right-radius:10px; border-top-left-radius:10px;">
    	<tr style="background:#F30;" >
        	<th>No</th>
            <th>ID</th>
            <th>Date</th>
            <th>Cashier</th>
            <th width="10%">Total</th>
        </tr>
        
        <?php
		$no = 0 + 1;
		$paid_type = "lunch";
        	$qpaid = mysqli_query($conn, "SELECT * FROM paids WHERE paid_type = '{$paid_type}' ORDER BY paid_id DESC LIMIT 25 ");
				while($rqpaid = mysqli_fetch_array($qpaid)){
		?>
        <tr>
        	
        	<td align="center"><?= $no ?></td>
            <td align="center"><?= $rqpaid["paid_id"] ?></td>
            <td align="center"><?= $rqpaid["paid_date"] ?></td>
            <td align="center"><?= $rqpaid["paid_cashier"] ?></td>
            <td align="right"><?php
			$paid_total = $rqpaid["paid_total"];
			if($paid_total == 0 || empty($paid_total)){
				
				echo "0.00";
			}else{
				echo number_format($paid_total, 2);
			}
			
			?></td>
        </tr>
    	<?php
		$no++;
				}
        ?>
    </table>

  
  </div>
<?php
require_once("template/._footer.php");
}else{
	header("Location: ../index.php");
}
?>    