<?php
session_start();
if(isset($_SESSION["user_name"])){
	
	$user = $_SESSION["user_name"];
	
require_once("includes/connection.php");


$table_no = $_GET["table_no"];

require_once("template/._header.php");

$qtable = mysqli_query($conn, "SELECT * FROM tables");
$rqtable = mysqli_fetch_array($qtable);
$nqtable = mysqli_num_rows($qtable);
$next = $table_no + 1;
if($next > $nqtable){
	$next_table = 1;
}else{
	$next_table = $next;
}
$prev = $table_no - 1;
if($prev <= 0){
	$prev_table = $nqtable;
}else{
	$prev_table = $prev;
}


$available = "0";
$reserved = "1";

$qtable_ava = mysqli_query($conn, "SELECT * FROM tables WHERE table_status = '{$available}'");
$rwqt_ava = mysqli_num_rows($qtable_ava);

$qtable_res = mysqli_query($conn, "SELECT * FROM tables WHERE table_status = '{$reserved}'");
$rwqt_res = mysqli_num_rows($qtable_res);

if(isset($_GET["table_no"])){
	$table_no = $_GET["table_no"];
	
	$qbill = mysqli_query($conn, "SELECT * FROM bills WHERE bill_table = '{$table_no}'");
	$rqbill = mysqli_num_rows($qbill);

?>
<div align="center" style="height:500px;">
	<strong style="font-size:25px; padding: 5px;">Table No: <?= $table_no ?></strong> 
	<strong>Reserved:</strong> <?= $rwqt_res ?> &nbsp;  
    <strong>Available:</strong> <?= $rwqt_ava ?> &nbsp; | &nbsp; 
	<strong>Date:</strong> <?= date("d-M-Y",time() - 54000) ?>  &nbsp; 
            <strong>Time:</strong> <?= date("H:i:s",time() + 54000) ?>
<hr />
<br /> 
	<div id="rb_menu">
    	<a href="index.php">&larr; Go to Table Interface</a> <a style="background:#090;" href="submit_order.php?table_no=<?= $table_no ?>">Submit Order</a> <a href="table.php?table_no=<?= $prev_table ?>">&larr; Prev Table</a> <a href="table.php?table_no=<?= $next_table ?>">Next Table &rarr;</a>
	</div>
    <br /><br />
    <div id="rb_menu">
    	<a href="cancel_order.php?table_no=<?= $table_no ?>">&times; Cancel Order</a>
	</div>
    
    
      <h4>Table's Order (<?= $table_no ?>) 
      <?php
	  if($rqbill == 0 || empty($rqbill)){
	  ?>
      - <small style="color:red;">This order are not submit yet.</small></h4>
      
      <?php
	  }else{
		  $dbill = mysqli_fetch_array($qbill);
	  ?>
        - <small>Receipt Number: <?= $dbill["bill_no"] ?> | Date: <?= $dbill["bill_date"] ?> | Time: <?= $dbill["bill_time"] ?> </small></h4>
        
        <?php
	  }
		?>
        
     <?php
	 	$qtype = mysqli_query($conn, "SELECT * FROM types");
			while($rqtype = mysqli_fetch_array($qtype)){
				$type_name = $rqtype["type_name"];
	 ?>   
        
        <div id="type_label_menu" style="" align="center" class="e">
                
                <div align="center">
                <strong style="font-size:30px; color:#fff;"><?= $rqtype["type_name"] ?></strong><br /><br />
                <div align="left">
                    <strong>Item:</strong><br /><br />
                    
				<?php
                $qcategory = mysqli_query($conn, "SELECT * FROM categorys WHERE category_type = '{$type_name}'");
                while($rqcategory = mysqli_fetch_array($qcategory)){
					$category_name = $rqcategory["category_name"];
                ?>
                <u><?= $rqcategory["category_name"] ?></u><br />
                
					<?php
                    $qitem = mysqli_query($conn, "SELECT * FROM items WHERE item_category = '{$category_name}'");
                    while($rqitem = mysqli_fetch_array($qitem)){
                    ?>
                    <div id="menu_list">
                    	<a href="add_order_item_new.php?table_no=<?= $table_no ?>&item_id=<?= $rqitem["item_id"] ?>&type_name=<?= $rqtype["type_name"] ?>">
                    	<?= $rqitem["item_name"] ?> (RM <?= number_format($rqitem["item_price"], 2) ?>)<br />
                    	</a>
                    </div>
                    <?php
					}
					?>
                <br />
                <?php
				}
				?>
                </div>
              </div>
           </div>
        
  		<?php
			}
		?>
        
</div>


<br />
<br /><br /><br />

<br />
<div style="width:100%; border:#000 grove; height:400px" align="center">
<table width="100%" border="0" class="tbl"  style="border:#F30 groove; border-top-right-radius:10px; border-top-left-radius:10px;">
	<tr style="background:#F30;">
    	<th width="5%">No</th>
        <th width="40%">Item(s)</th>
        <th width="5%">Qty</th>
        <th width="20%">Price (RM)</th>
        <th width="20%">Total (RM)</th>
        <th width="10%">Action</th>
    </tr>
    
    <?php
		$qorder = mysqli_query($conn, "SELECT * FROM orders WHERE order_table = '{$table_no}'");
		$qsumorder = mysqli_query($conn, "SELECT SUM(order_total) FROM orders WHERE order_table = '{$table_no}'");
		$rqsumorder = mysqli_fetch_array($qsumorder);
		$no = 0 + 1;
		while($rqorder = mysqli_fetch_array($qorder))
		{		
	?>
    
    <tr>
    	<td align="center"><?= $no ?></td>
        <td align="center"><?= $rqorder["order_item"] ?></td>
        <td align="center"><?= $rqorder["order_quantity"] ?></td>
        <td align="right"><?= number_format($rqorder["order_price"], 2) ?></td>
        <td align="right"><?= number_format($rqorder["order_total"], 2) ?></td>
        <td align="center"><div id="delete_button"><a href="del_order.php?bill_no=<?= $bill_no ?>&table_no=<?= $table_no ?>&order_id=<?= $rqorder["order_id"] ?>"><strong>Delete</strong></a></div></td>
    </tr>
    <?php
	$no++;
		}
	?>
</table>
</div>
<?php 
}else{
	header("Location: index.php");
}
?>    

</td>
        
        <td width="35%" valign="top">

            <div id="right_bar">
                <div id="rb_total">
                    <div align="center" id="rbt_rm" style="background:#F30; border-radius:5px; padding:5px;">
                        <strong style="font-size:20px;">Total (RM)</strong>
                    </div>
                    <div id="rbt_valu" style="border:#F60 groove; border-radius:5px; padding:5px;" align="center">
                        <strong style="font-size:36px">0.00</strong>
                    </div>
                </div>
            
            
         <hr />
         
         <div align="center" id="rb_recent_tables" style="height:250px;">
         	<br />
            <div align="center" id="rbt_rm" style="background:#F30; border-radius:5px; padding:5px;">
            <strong style="font-size:20px;">Recent Dine-in Tables</strong>
            </div>
            <ul style="padding-right:50px;">
            	<?php
				$full = "1";
            	$qtable = mysqli_query($conn, "SELECT * FROM tables WHERE table_status = '{$full}' LIMIT 10");
				$numqtable = mysqli_num_rows($qtable);
				if($numqtable = "0"){
					echo "Sorry, no recent order yet";
				}else{
				while($rqtable = mysqli_fetch_array($qtable)){
            ?>
            	<li><a href="table.php?table_no=<?= $rqtable["table_no"] ?>">Table <?= $rqtable["table_no"] ?></a></li>
			<?php
				}
				}
			?>

            </ul>
         
         
         <hr /></div>
         <table width="100%" height="100" border="0">
         	<tr>
         		<td width="50%" >
                	<div align="center" id="rb_menu">
                    	<a href="">Take Away Order</a>
                    </div>                
                </td>
                <td>
                	<div align="center" id="rb_menu">
                		<a href="dashboard.php">Dashboard</a><br /><br /><br />
                		<a href="">Logout</a>
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