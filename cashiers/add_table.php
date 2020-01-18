<?php
session_start();
if(isset($_SESSION["user_name"])){
	
	$user_name = $_SESSION["user_name"];
	
require_once("template/._header.php");
require_once("includes/connection.php");

if(isset($_POST["submit"])){
	$table_no = $_POST["table_no"];
	$table_date = $_POST["table_date"];
	$table_user = $_POST["table_user"];
	$table_status = "0";
	
	$qtable = mysqli_query($conn, "SELECT * FROM tables WHERE table_no = '{$table_no}'");
	$rowcount = mysqli_num_rows($qtable);
	if($rowcount == 0){
		
		$qreg = mysqli_query($conn, "INSERT INTO tables(table_no, table_date, table_status, table_user) 
		VALUES( '{$table_no}', '{$table_date}', '{$table_status}', '{$table_user}' )");
		
	}else{
		echo "
			<script>
				alert('This Table Number has been registered, please insert another number')
			</script>
		";
	}
}

?>
<div align="center">
        <strong style="font-size:25px; padding: 5px;">User Dashboard</strong> 
     
            <strong>Reserved:</strong> 9 &nbsp;  <strong>Available:</strong> 2 
            &nbsp; | &nbsp; 
            <strong>Date:</strong> <?= date("d-M-Y",time() - 54000) ?>  &nbsp; 
            <strong>Time:</strong> <?= date("H:i:s",time() + 54000) ?>
        
            	<hr /></div>
	<h2>Tables Management</h2>

<div align="center">
	<div align="right" id="rb_menu" style="margin-right:25px;"><a href="db_table_management.php">Tables List</a></div>
    <br />
	<table class="tbl" width="80%" style="border:#F30 groove; border-top-right-radius:10px; border-top-left-radius:10px;">
    	<tr style="background:#F30;" >
        	<th>No</th>
            <th>Table</th>
            <th>Reg Date</th>
            <th>User</th>
        </tr>
        
        <tr>
        	<form action="" method="post">
        	<td align="center">1</td>
            <td align="center"><input type="text" name="table_no" autofocus="on" /></td>
            <td align="center"><input type="text" name="table_date" value="<?= date("d-M-Y", time() - 54000) ?>" readonly="readonly" /></td>
            <td align="center"><input type="text" name="table_user" value="<?= $user_name ?>" readonly="readonly" /></td>        
        </tr>

    </table>
    <br />
    <input type="submit" name="submit" value="Add"  />
</form>
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