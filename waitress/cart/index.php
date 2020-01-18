<?php

require_once("includes/connection.php");
$result = mysqli_query($conn, "SELECT * FROM product");
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>cart</title>
</head>

<body>

<table cellpadding="2" cellspacing="2" border="0">
	<tr>
    	<th>ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Buy</th>
 	</tr>
    
    <?php
		while($product = mysqli_fetch_object($result)){
	?>
    
    <tr>
    	<td><?= $product->id ?></td>
        <td><?= $product->name ?></td>
        <td><?= $product->price ?></td>
        <td><a href="cart.php?id=<?= $product->id ?>">Order Now</a></td>
        
    </tr>
    
    <?php
		}
	?>
</table>

</body>
</html>