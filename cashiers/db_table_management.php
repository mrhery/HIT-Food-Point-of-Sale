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
<div align="center">
        <strong style="font-size:25px; padding: 5px;">User Dashboard</strong> 
     
            <strong>Reserved:</strong> <?= $rwqt_res ?> &nbsp;  <strong>Available:</strong> <?= $rwqt_ava ?> 
            &nbsp; | &nbsp; 
            <strong>Date:</strong> <?= date("d-M-Y",time() - 54000) ?>  &nbsp; 
            <strong>Time:</strong> <?= date("H:i:s",time() + 54000) ?>
        
            	<hr /></div>
	<h2>Tables Management</h2>

<div align="center">
	<div align="right" id="rb_menu" style="margin-right:25px;"><a href="add_table.php">Register New Table</a></div>
    <br />
	<table class="tbl" width="80%" style="border:#F30 groove; border-top-right-radius:10px; border-top-left-radius:10px;">
    	<tr style="background:#F30;" >
        	<th>No</th>
            <th>Table</th>
            <th>Reg Date</th>
            <th>User</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        
        <?php
		$no = 0 + 1;
        	$qtable = mysqli_query($conn, "SELECT * FROM tables");
				while($rqtable = mysqli_fetch_array($qtable)){
					$table_status = $rqtable["table_status"];
					if($table_status == "0"){
						$status = "<strong style='color:green;'>Available</strong>";
					}else{
						$status = "<strong style='color:red;'>Reserved</strong>";
					}
			
		?>
        <tr>
        	
        	<td align="center"><?= $no ?></td>
            <td align="center"><div id="delete_button"><a href="table.php?table_no=<?= $rqtable["table_no"] ?>"><strong><?= $rqtable["table_no"] ?></strong></a></div></td>
            <td align="center"><?= $rqtable["table_date"] ?></td>
            <td align="center"><?= $rqtable["table_user"] ?></td>
            <td align="center"><?= $status ?></td>
            <td align="center"><div id="delete_button"><a href="tbl_delete.php?table_id=<?= $rqtable["table_id"] ?>" >
            						<strong>Delete</strong>
                               </a></div>
            </td>
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
                   
                   <div id="menudb_inactive" style="" align="center">
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
                   
                   <div id="menudb_active" style="" align="center">
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