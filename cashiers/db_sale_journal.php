<?php
session_start();
if(isset($_SESSION["user_name"])){
	
	$user_name = $_SESSION["user_name"];
require_once("includes/connection.php");
require_once("template/._header.php");

$available = "0";
$reserved = "1";

$qtable_ava = mysqli_query($conn, "SELECT * FROM tables WHERE table_status = '{$available}'");
$rwqt_ava = mysqli_num_rows($qtable_ava);

$qtable_res = mysqli_query($conn, "SELECT * FROM tables WHERE table_status = '{$reserved}'");
$rwqt_res = mysqli_num_rows($qtable_res);

$date = date("d-M-Y", time() - 54000);
$month = date("M", time() - 54000);
$year = date("Y", time() - 54000);
$qcash_today = mysqli_query($conn, "SELECT SUM(paid_total) FROM paids WHERE paid_date = '{$date}'");
$sqcash_today = mysqli_fetch_array($qcash_today);

$qcash_month = mysqli_query($conn, "SELECT SUM(paid_total) FROM paids WHERE paid_month = '{$month}'");
$sqcash_month = mysqli_fetch_array($qcash_month);

$qcash_year = mysqli_query($conn, "SELECT SUM(paid_total) FROM paids WHERE paid_year = '{$year}'");
$sqcash_year = mysqli_fetch_array($qcash_year);
?>
<div align="center">
        <strong style="font-size:25px; padding: 5px;">User Dashboard</strong> 
     
            <strong>Reserved:</strong> <?= $rwqt_res ?> &nbsp;  <strong>Available:</strong> <?= $rwqt_ava ?> 
            &nbsp; | &nbsp; 
            <strong>Date:</strong> <?= date("d-M-Y",time() - 54000) ?>  &nbsp; 
            <strong>Time:</strong> <?= date("H:i:s",time() + 54000) ?>
        
            	<hr /></div>
	<h2>Sale Journal</h2>
<div align="center">
	<div align="center" style="border:black groove; width: 80%; border-radius: 5px;">
		<div align="left" style="padding: 10px;">
			<strong>Today's Cashier Overview: <?= $user_name ?></strong> <br /><br />
			<?php
				$tsale = mysqli_query($conn, "SELECT SUM(paid_total) FROM paids WHERE paid_date = '{$date}' AND paid_cashier = '{$user_name}'");
				$rtsale = mysqli_fetch_array($tsale);
				$msale = mysqli_query($conn, "SELECT SUM(paid_total) FROM paids WHERE paid_month = '{$month}' AND paid_cashier = '{$user_name}'");
				$rmsale = mysqli_fetch_array($msale);
				$ysale = mysqli_query($conn, "SELECT SUM(paid_total) FROM paids WHERE paid_date = '{$year}' AND paid_cashier = '{$user_name}'");
				$rysale = mysqli_fetch_array($ysale);
				
			?>
			Today's Sales: <strong>RM <?= number_format($rtsale["SUM(paid_total)"], 2) ?></strong><br />
			Today's Foods: RM (None)<br />
			Today's Drinks: RM (None)<br />
			<hr />
			Month's Sales: RM <?= number_format($rmsale["SUM(paid_total)"], 2) ?><br />
			Year's Sales: RM <?= number_format($rysale["SUM(paid_total)"], 2) ?><br />
			
				
			
		</div>
	</div>
	<br /><br />

	<div align="center" id="rb_menu" style="margin-right:25px;">
    	<a href="analytics.php?data=<?= date("d-M-Y") ?>" target="blank">Today's Sales : RM <?= number_format($sqcash_today["SUM(paid_total)"], 2) ?></a> &nbsp; 
        <a href="analytics.php?data=<?= date("M-Y") ?>" target="blank">Monthly Sales : RM <?= number_format($sqcash_month["SUM(paid_total)"], 2) ?></a> &nbsp; 
        <a href="analytics.php?data=<?= date("Y") ?>" target="blank">Yearly Sales : RM <?= number_format($sqcash_year["SUM(paid_total)"], 2) ?></a>
    </div>
    <br />
	<table class="tbl" width="80%" style="border:#F30 groove; border-top-right-radius:10px; border-top-left-radius:10px;">
    	<tr style="background:#F30;" >
        	<th>No</th>
            <th>ID</th>
            <th>Document No</th>
            <th>Date</th>
            <th>Waitress</th>
            <th>Cashier</th>
            <th width="10%">Total</th>
        </tr>
        
        <?php
		$no = 0 + 1;
        	$qpaid = mysqli_query($conn, "SELECT * FROM paids ORDER BY paid_id DESC LIMIT 25");
				while($rqpaid = mysqli_fetch_array($qpaid)){
		?>
        <tr>
        	
        	<td align="center"><?= $no ?></td>
            <td align="center"><?= $rqpaid["paid_id"] ?></td>
            <td align="center"><?php 
				$paid_no = $rqpaid["paid_no"];
				if(empty($paid_no)){
				
				echo "Lunch";
			}else{
				echo $paid_no;
			}
			?>
			</td>
            <td align="center"><?= $rqpaid["paid_date"] ?></td>
            <td align="center"><?= $rqpaid["paid_waiteress"] ?></td>
            <td align="center"><?= $rqpaid["paid_cashier"] ?></td>
            <td align="center"><?php
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

</td>
        
        <td width="35%" valign="top" align="center">

            <div id="right_bar" align="center">
                <div id="rb_total" align="center" style="height:275px;">
                    <div align="center" id="rbt_rm" style="background:#F30; border-radius:5px; padding:5px;">
                        <strong style="font-size:20px;">Menu</strong>
                    </div>
                   
                   <div id="menudb_inactive" style="" align="center">
                        <a href="dashboard.php">
                        <div align="center">
                        <strong style="color:#fff;">Overview</strong>
                        </div></a>
                   </div>
                   
                   <div id="menudb_active" style="" align="center">
                        <a href="db_sale_journal.php">
                        <div align="center">
                        <strong style="color:#fff;">Sales Journal</strong>
                        </div></a>
                   </div>
                   
                   <div id="menudb_inactive" style="" align="center">
                        <a href="db_waiteress_info.php">
                        <div align="center">
                        <strong style="color:#fff;">Waiteress Info</strong>
                        </div></a>
                   </div>
                   
                   <div id="menudb_inactive" style="" align="center">
                        <a href="db_cashier_info.php">
                        <div align="center">
                        <strong style="color:#fff;">Cashiers Info</strong>
                        </div></a>
                   </div>
                   
                   <div id="menudb_inactive" style="" align="center">
                        <a href="db_table_management.php">
                        <div align="center">
                        <strong style="color:#fff;">Tables Management</strong>
                        </div></a>
                   </div>
                   
                   <div id="menudb_inactive" style="" align="center">
                        <a href="db_food_drink_management.php">
                        <div align="center">
                        <strong style="color:#fff;">Foods & Drinks Management</strong>
                        </div></a>
                   </div>


                    
           		</div>
            
            <br /><br /><br /><br />
         <hr />

         <table width="100%" height="100" border="0">
         	<tr>
         		<td width="50%" >
                	<div align="center" id="rb_menu">
                    	<a href="">Take Away Order</a>
                    </div>                
                </td>
                <td>
                	<div align="center" id="rb_menu">
                		<a href="index.php">Table Interface</a><br /><br /><br />
                		<a href="logout.php">Logout</a>
                   	</div>
                </td>
         	</tr>
         </table>
         
         </div>
         </td>
     </tr>
</table>
</body>
</html>
<?php
}else{
	header("Location: ../index.php");
}
?>