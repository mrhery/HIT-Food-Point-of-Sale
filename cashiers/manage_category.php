<?php
session_start();
if(isset($_SESSION["user_name"])){
	
	$user = $_SESSION["user_name"];

require_once("template/._header.php");
require_once("includes/connection.php");

$available = "0";
$reserved = "1";

$qtable_ava = mysqli_query($conn, "SELECT * FROM tables WHERE table_status = '{$available}'");
$rwqt_ava = mysqli_num_rows($qtable_ava);

$qtable_res = mysqli_query($conn, "SELECT * FROM tables WHERE table_status = '{$reserved}'");
$rwqt_res = mysqli_num_rows($qtable_res);

if(isset($_POST["category_name"])){
	$category_name = $_POST["category_name"];
	$category_type = $_POST["category_type"];
	$category_user = $user;
	$category_date = date("d-M-Y", time() + 54000);
	
	$qtype = mysqli_query($conn, "SELECT * FROM categorys WHERE category_name = '{$category_name}'");
	$rowcount = mysqli_num_rows($qtype);
	
	if($rowcount == "0"){
		
		$qnewtype = mysqli_query($conn, "INSERT INTO categorys(category_name, category_type, category_date, category_user) VALUES('{$category_name}', '{$category_type}', '{$category_date}', '{$category_user}')");
		
		if($qnewtype == TRUE){
			header("Location: manage_category.php");
		}
		
	}else{
		echo "
			<script>
				alert('Sorry, this Type of Meal has been registered, please inser anpter Type of Meal.')
			</script>
		";
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
	<h2>Foods & Drinks Management</h2>
		
        <div align="right" id="rb_menu" style="margin-right:25px;"><a href="manage_type.php">1. Manage Type of Meals</a> > <a href="manage_category.php" style=" background:#F33;">2. Manage Meals Category</a> > <a href="db_food_drink_management.php">3. Manage Food & Drinks</a></div>
    <br /><br />
    <div align="center">
        <form action="" method="POST" >
    	<input
        style=" font-size:16px;"
        type="text" placeholder="Create new Category of Meals" name="category_name" size="50" autofocus="on" />
        <select name="category_type" style=" font-size:16px;" >
        <?php
			$qtype = mysqli_query($conn, "SELECT * FROM types");
			while($rqtype = mysqli_fetch_array($qtype)){
		?>
        	<option value="<?= $rqtype["type_name"] ?>"><?= $rqtype["type_name"] ?></option>
        <?php } ?>
        </select>
        <input style="font-size:16px;" type="submit" value="Add" name="submit" />
    </form>
    </div>
    <br />
	 <table width="90%" align="center" class="tbl" style="border:#F30 groove; border-top-right-radius:10px; border-top-left-radius:10px;">
    	<tr style="background:#F30;" >
			<th>No</th>
            <th>Category Name</th>
            <th>Type</th>
            <th>Action</th>
        </tr>
       
       	<?php
			$no = 0 + 1;
			$qcategory = mysqli_query($conn, "SELECT * FROM categorys");
			while($rqcategory = mysqli_fetch_array($qcategory)){
		?>
       	<tr>
        	<td align="center"><?= $no ?></td> 
            <td align="center"><?= $rqcategory["category_name"] ?></td>
            <td align="center"><?= $rqcategory["category_type"] ?></td>
            <td align="center"><div id="delete_button"><a href="del_category.php?category_id=<?= $rqcategory["category_id"] ?>"><strong>Delete</strong></a></div></td>   
		</tr>
		<?php $no++; } ?>
	</table>





































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