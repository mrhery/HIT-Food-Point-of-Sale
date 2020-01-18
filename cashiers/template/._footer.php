</td>
        
        <td width="35%" valign="top">

            <div id="right_bar">
                <div id="rb_total">
                    <div align="center" id="rbt_rm" style="background:#F30; border-radius:5px; padding:5px;">
                        <strong style="font-size:20px;">New Add-On Orders</strong> (<a href="addon.php" style="color:#FFF;">View all</a>)
                    </div>
                    <div id="rbt_valu" style="border:#F60 groove; border-radius:5px; padding:5px;" align="center">
                        
                        <?php
							$addon = "ad";
							$inprint = "inprint";
							$qnorder = mysqli_query($conn, "SELECT * FROM orders WHERE order_ad = '{$addon}' AND order_adprint = '{$inprint}'");
							while($rnorder = mysqli_fetch_array($qnorder)){
						?>
            	<li><a href="addon.php">Table / Customer: <?= $rnorder["order_table"] ?></a></li>
						<?php
							}
						?>
            </ul>
                        
                        
                    </div>
                </div>
            
            
         <hr />
         
          <div align="center" id="rb_recent_tables" style="height:250px;">
         	<br />
            <div align="center" id="rbt_rm" style="background:#F30; border-radius:5px; padding:5px;">
            <strong style="font-size:20px;">New Take Away Orders</strong>
            </div>
			
            <div id="responsecontainer">
            <ul style="padding-right:50px;">
            <?php
				$ta = "ta";
				$qtaorder = mysqli_query($conn, "SELECT * FROM bills WHERE bill_type = '{$ta}' ORDER BY bill_id DESC");
				while($rtaorder = mysqli_fetch_array($qtaorder)){
            ?>
            	<li><a href="bill_ta.php?customer=<?= $rtaorder["bill_table"] ?>"><?= $rtaorder["bill_table"] ?></a></li>
			<?php
				}
			?>
            </ul>
         </div>
         
         <hr />
         
         
         
         
         <div align="center" id="rb_recent_tables" style="height:250px;">
         	<br />
            <div align="center" id="rbt_rm" style="background:#F30; border-radius:5px; padding:5px;">
            <strong style="font-size:20px;">Recent Dine-in Tables</strong>
            </div>
			
            <div id="responsecontainer">
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
         </div>
         
         <hr /></div>
         <table width="100%" height="100" border="0">
         	<tr>
         		<td width="50%" >
                	<div align="center" id="rb_menu">
                    	<a href="takeaway.php">Addon & Take Away</a><br /><br /><br />
						<a href="index.php">Table Interfaces</a><br /><br /><br />
						<a href="lunch.php">Lunch's Sales</a>
                    </div>                
                </td>
                <td>
                	<div align="center" id="rb_menu">
                		<a href="dashboard.php">Dashboard</a><br /><br /><br />
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
