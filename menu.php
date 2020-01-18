<?php

$conn = mysqli_connect("localhost", "root", "", "hanc");
if($conn == FALSE){
	echo "Error Connecting to Database!";
}




?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Menu List: Restoran Ayam Kampung Hanc</title>
</head>

<body>
<div align="center" style="background:orange; color:white;">
	<strong style="font-size:60px;">Restoran Ayam Kampung Hanc</strong><br />
    <strong style="font-size:24;">-Menu-</strong><br />
    <strong style="font-size:24;">(Printed by HIT Printing)</strong>
</div>
<br />
<?php

	$qtype = mysqli_query($conn, "SELECT * FROM types");
	while($rtype = mysqli_fetch_array($qtype)){
		$type_name = $rtype["type_name"];
		
		$qcategory = mysqli_query($conn, "SELECT * FROM categorys WHERE category_type = '{$type_name}'");
		
?>
<div style="width:100%;">
	<h2 style="margin-left:10px;">Type: <?= $rtype["type_name"] ?></h2>
		
        <?php
			while($rcategory = mysqli_fetch_array($qcategory)){
				$category_name = $rcategory["category_name"];
			
				$qitem = mysqli_query($conn, "SELECT * FROM items WHERE item_type = '{$type_name}' AND item_category = '{$category_name}'");
		?>
        <div>
        	<strong><u>Category: <?= $category_name ?></u></strong>
            <br />
				<br />
                <div style="margin-left:10px; margin-right:10px;">
                	<table width="100%" border="1">
                    	<tr>
                        	<th>No</th>
                            <th>Item Name</th>
                            <th>Item Shortcut</th>
                            <th>Item Price</th>
                            <th>Item Type</th>
                            <th>Item Category</th>
                    	</tr>
                      <?php
                      $no = 0 + 1;
					while($ritem = mysqli_fetch_array($qitem)){
						
				?>  
                        <tr>
                        	<td align="center"><?= $no ?></td>
                            <td align="center"><?= $ritem["item_name"] ?></td>
                            <td align="center"><?= $ritem["item_short"] ?></td>
                       		<td align="right"><?= number_format($ritem["item_price"], 2) ?></td>
                            <td align="center"><?= $ritem["item_type"] ?></td>
                            <td align="center"><?= $ritem["item_category"] ?></td>
                        </tr><?php 
						$no++;
					}
				?>
        </div>
                    </table>
                    
                </div>
                <br />
        <?php
			}
		?>
        
</div><br />


<?php } 
$items = mysqli_query($conn, "SELECT * FROM items");
$nitem = mysqli_num_rows($items);
?>
Total Registeres Items: <?= $nitem ?>
</body>
</html>