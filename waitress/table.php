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

?>

<style>
body{
	font-family:Verdana, Geneva, sans-serif;
}

div#header{
	background: #F90;
}


</style>
<div id="header" align="center">
    <strong style="color:#fff; font-size:36px;">Waiteress</strong><br />
    <strong>Waitress: <?= $user_name ?></strong>
</div>

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
                <a href="summary.php?table_no=<?= $rqtable["table_no"] ?>">
                <div align="center">
                <strong style="font-size:50px; color:#fff;"><?= $rqtable["table_no"] ?></strong>
                </div></a>
           </div>
           <?php
				}
		   ?>
           <br /><br />
         </div>
<br /><br />




<?php
require_once("template/._footer.php");
}else{
header("Location: ../index.php");
}
?>