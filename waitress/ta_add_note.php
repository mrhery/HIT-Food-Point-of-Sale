<?php
session_start();
if(isset($_SESSION["user_name"])){
	
	$user_name = $_SESSION["user_name"];
require_once("includes/connection.php");
require_once("template/._header.php");
$customer = $_GET["customer"];

?>

	<div id="header" align="center">
    	<h2 style="padding:5px; color: #FFF;">Waiteress (Take Away)</h2>
   </div>

	<div id="nav_bar" align="center">
    	<?php
			
			$qtype = mysqli_query($conn, "SELECT * FROM types");
			
			while($rtypq = mysqli_fetch_array($qtype)){
				
		?>
        <a href="ta_type.php?type_name=<?= $rtypq["type_name"] ?>&customer=<?= $customer ?>"><strong><?= $rtypq["type_name"] ?></strong></a>
    	
    	<?php
			}
		?>
        <a href="ta_summary.php?customer=<?= $customer ?>"><strong>Summary</strong></a>
    </div><br />
    <hr />
    
    <?php
		if(isset($_GET["customer"], $_GET["order_id"])){
			
			$customer = $_GET["customer"];
			$order_id = $_GET["order_id"];
			
			$qorder = mysqli_query($conn, "SELECT * FROM orders WHERE order_id = '{$order_id}'");
			$rorder = mysqli_fetch_array($qorder);
			$order_price = $rorder["order_price"];
			
			if(isset($_POST["submit"])){
				
				$order_quantity = $_POST["order_quantity"];
				$order_note = $_POST["order_note"];
				$new_total = $order_quantity * $order_price;
				
				
				$uorder = mysqli_query($conn, "UPDATE orders SET order_quantity = '{$order_quantity}', order_total = '{$new_total}', order_note = '{$order_note}' WHERE order_id = '{$order_id}'");
				
				if($uorder == TRUE){
					header("Location: ta_summary.php?customer=$customer");
				}
				
			}
	?>
		
        <div align="center">
        <h3>Edit Order:  <?= $rorder["order_item"] ?> | Table No.: <?= $customer ?></h3>

		<table width="100%">
        	<tr>
            	<th>ID</th>
                <th>Item</th>
                <th>Quantity</th>
            </tr>
            <form action="" method="post" >
            <tr>
            	<td align="center"><?= $order_id ?></td>
                <td align="center"><?= $rorder["order_item"] ?></td>
                <td align="center"><input type="number" size="3" value="<?= $rorder["order_quantity"] ?>" name="order_quantity" /></td>
            </tr>
            
        </table>
        <br />
        <textarea name="order_note" cols="100%" rows="5" placeholder="Add notes here..."><?= $rorder["order_note"] ?></textarea>   
        <br /><br />
        <input style="padding:10px;" type="submit" name="submit" value="Update!" />    
        </form>
        
		</div>
	<?php
		}
	?>


<?php
	
require_once("template/._footer.php");	
}else{
header("Location: ../index.php");
}
?>
