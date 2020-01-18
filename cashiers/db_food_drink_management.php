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
	<h2>Foods & Drinks Management</h2>
		
        <div align="right" id="rb_menu" style="margin-right:25px;"><a href="manage_type.php">1. Manage Type of Meals</a> > <a href="manage_category.php">2. Manage Meals Category</a> > <a href="db_food_drink_management.php"  style=" background:#F33;">3. Manage Food & Drinks</a></div>
    <br />
        
	<div align="center" style="margin-left:35px;">
        <?php
			$qtype = mysqli_query($conn, "SELECT * FROM types");
			while($rqtype = mysqli_fetch_array($qtype)){
				$type_name = $rqtype["type_name"];
		?>

		<div id="type_label" style="" align="center">
                <a>
                <div align="center">
                <strong style="font-size:30px; color:#fff;"><?= $rqtype["type_name"] ?></strong><br /><br />
                <div align="left">
                    <strong>Quick Add Item:</strong><br /><br />
                    <form action="add_item.php" method="GET" enctype="multipart/form-data">
                        <input type="text" name="item_name" size="25" placeholder="Item Name" autofocus="on" /><br /><br />
                   		<input type="text" hidden="" name="item_type" value="<?= $rqtype["type_name"] ?>"  />
                        <select name="item_category">
                        	<option value="0"> Please Select Category</option>
                            <?php
								$qcategory = mysqli_query($conn, "SELECT * FROM categorys WHERE category_type = '{$type_name}'");
								while($rqcategory = mysqli_fetch_array($qcategory)){
							?>
                            <option value="<?= $rqcategory["category_name"] ?>"><?= $rqcategory["category_name"] ?></option>
                            <?php
								}
							?>
                        </select>
                        <br /><br />
                        RM: <input type="text" name="item_price" placeholder="Price" />
						<br /><br />
						Keywords: <input type="text" name="item_short" placeholder="Keywords" />
                       
                        
                        <br /><br />
                        <input type="submit" name="type" value="<?= $rqtype["type_name"] ?>" />
                    </form>
                    <hr />
                    <button onclick="popitup('items.php?type_name=<?= $rqtype["type_name"] ?>')">Show All <?= $rqtype["type_name"] ?></button>
                    
					<script language="javascript" type="text/javascript">
							<!--
							function popitup(url) {
							newwindow=window.open(url,'name','height=700,width=1000');
							if (window.focus) {newwindow.focus()}
							return false;
							}
							
							// -->
                    </script>
                </div>
              </div>
              
              
              </a>
           </div>

        <?php
			}
			?>


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
                   
                   <div id="menudb_inactive" style="" align="center">
                        <a href="db_table_management.php">
                        <div align="center">
                        <strong style="color:#fff;">Tables Management</strong>
                        </div></a>
                   </div>
                   
                   <div id="menudb_active" style="" align="center">
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