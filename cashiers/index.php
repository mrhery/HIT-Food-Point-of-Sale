<?php
session_start();
if(isset($_SESSION["user_name"])){
require_once("template/._header.php");
require_once("includes/connection.php");

$available = "0";
$reserved = "1";

$qtable_ava = mysqli_query($conn, "SELECT * FROM tables WHERE table_status = '{$available}'");
$rwqt_ava = mysqli_num_rows($qtable_ava);

$qtable_res = mysqli_query($conn, "SELECT * FROM tables WHERE table_status = '{$reserved}'");
$rwqt_res = mysqli_num_rows($qtable_res);
?>
<script>
setTimeout(function(){
   window.location.reload(1);
}, 5000);
</script>
<div align="center">
        <strong style="font-size:25px; padding: 5px;">Tables Interface</strong> 
     
            <strong>Reserved:</strong> <?= $rwqt_res ?> &nbsp;  <strong>Available:</strong> <?= $rwqt_ava ?> 
            &nbsp; | &nbsp; 
            <strong>Date:</strong> <?= date("d-M-Y",time() - 54000) ?>  &nbsp; 
            <strong>Time:</strong> <?= date("H:i:s",time() + 54000) ?>
        
            	<hr />
                <br />
			<?php
			$empty = "";
			$a = "1";
			$b = "2";
			$qbill = mysqli_query($conn, "SELECT * FROM bills WHERE bill_print = '{$empty}' OR  bill_print = '{$a}' OR bill_print = '{$b}'");
			while($rbill = mysqli_fetch_array($qbill)){
			?>
				<div id="alert" style="margin:15px; width: 75%;" align="center">
					<a href="table.php?table_no=<?= $rbill["bill_table"] ?>">
				<div align="center">                
					<strong><?= $rbill["bill_no"] ?> - <?= $rbill["bill_table"] ?> - 
					<?php
						$bill_print = $rbill["bill_print"];
						if(empty($bill_print)){
							echo "This Order Are Not Printed Yet!";
						}elseif($bill_print == 1){
							echo "This Order Only Printed To Food!";
						}elseif($bill_print == 2){
							echo "This Order Only Printed To Drinks!";
						}
					?>
					
					</strong>
				</div>
					</a>
				</div>
			<?php
				}
			?>
			
            <div id="tables"> 
            <?php
				$qtable = mysqli_query($conn, "SELECT * FROM tables");
				while($rqtable = mysqli_fetch_array($qtable)){
					$table_status = $rqtable["table_status"];
					if($table_status == "0"){
						$status = "table_zero";
					}else{
						$status = "table_full";
					}
			?>  
            <div id="<?= $status ?>" style="">
                <a href="table.php?table_no=<?= $rqtable["table_no"] ?>">
                <div align="center">
                <strong style="font-size:50px; color:#fff;"><?= $rqtable["table_no"] ?></strong>
                </div></a>
           </div>
           <?php
				}
		   ?>
           
         </div>
       </div>
<?php
require_once("template/._footer.php");
}else{
	header("Location: ../index.php");
}
?>    