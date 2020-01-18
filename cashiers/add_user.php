<?php
session_start();
if(isset($_SESSION["user_name"])){
require_once("includes/connection.php");
require_once("template/._header.php");

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
	

<?php
if(isset($_GET["user_section"])){
	
	$user_section = $_GET["user_section"];
	
	if($user_section == "waitress"){
		
		if(isset($_POST["submit"])){
			$user_name = $_POST["user_name"];
			$user_password = $_POST["user_password"];
			
			if(empty($user_name) || empty($user_password)){
				echo "
					<script>
						alert('Error! Please fill up form completely')
					</script>
				";
			}else{
			
			$iuser = mysqli_query($conn, "INSERT INTO users(user_name, user_password, user_section) VALUES('{$user_name}', '{$user_password}', '{$user_section}')");
			
			if($iuser == TRUE){
				header("Location: db_waiteress_info.php");
			}else{
				echo "Add Waitress query error";
			}
			}
			
		}

?>
<h2>Register new Waitress</h2>
<div align="center">
	<div align="center">
	<div align="right" id="rb_menu" style="margin-right:25px;"><a href="db_waiteress_info.php">Waitress List</a></div>
    <br />
	<table class="tbl" width="80%" style="border:#F30 groove; border-top-right-radius:10px; border-top-left-radius:10px;">
    	<tr style="background:#F30;" >
        	<th>No</th>
            <th>Username</th>
            <th>Password</th>
			<th>Section</th>
        </tr>
        
        <tr>
        	<form action="" method="post">
        	<td align="center">1</td>
            <td align="center"><input type="text" name="user_name" /></td>
            <td align="center"><input type="text" name="user_password" /></td> 
            <td align="center"><input type="text" name="user_section" readonly="readonly" value="<?= $user_section ?>" /></td>        
        </tr>

    </table>
    <br />
    <input type="submit" name="submit" value="Add"  />
</form>
	
<?php
	}elseif($user_section == "cashier"){
		
		if(isset($_POST["submit"])){
			$user_name = $_POST["user_name"];
			$user_password = $_POST["user_password"];
			
			if(empty($user_name) || empty($user_password)){
				echo "
					<script>
						alert('Error! Please fill up form completely')
					</script>
				";
			}else{
			
			$iuser = mysqli_query($conn, "INSERT INTO users(user_name, user_password, user_section) VALUES('{$user_name}', '{$user_password}', '{$user_section}')");
			
			if($iuser == TRUE){
				header("Location: db_cashier_info.php");
			}else{
				echo "Add Waitress query error";
			}
			}
			
		}
?>

<h2>Register new Cashier</h2>
<div align="center">
	<div align="center">
	<div align="right" id="rb_menu" style="margin-right:25px;"><a href="db_cashier_info.php">Cashier List</a></div>
    <br />
	<table class="tbl" width="80%" style="border:#F30 groove; border-top-right-radius:10px; border-top-left-radius:10px;">
    	<tr style="background:#F30;" >
        	<th>No</th>
            <th>Username</th>
            <th>Password</th>
			<th>Section</th>
        </tr>
        
        <tr>
        	<form action="" method="post">
        	<td align="center">1</td>
            <td align="center"><input type="text" name="user_name" /></td>
            <td align="center"><input type="text" name="user_password" /></td> 
            <td align="center"><input type="text" name="user_section" readonly="readonly" value="<?= $user_section ?>" /></td>        
        </tr>

    </table>
    <br />
    <input type="submit" name="submit" value="Add"  />
</form>


<?php

	}else{
		header("Location: error_page.php");	
	}
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