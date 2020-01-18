<?php
session_start();
require_once("includes/connection.php");
require_once("includes/item.php");

if(isset($_GET["id"])){
	$id = $_GET["id"];
	$result = mysqli_query($conn, "SELECT * FROM product WHERE id = '{$id}'");
	$product = mysqli_fetch_object($result);
	$item = new Item();
	$item->id = $product->id;
	$item->name = $product->name;
	$item->price = $product->price;
	$item->quantity = 1;
	
	$index = "-1";
	$cart = unserialize(serialize($_SESSION["cart"]));
	for($i = 0; $i <count($cart); $i++)
		if($cart[$i]->id==$_GET["id"])
		{
			$index = $i;
			break;
		}
	if($index == "-1")
		$_SESSION[][] = $item;
	else{
		$cart[$index]->quantity++;
		$_SESSION["cart"] = $cart;
	}
}

if(isset($_GET["index"])){
	$cart = unserialize(serialize($_SESSION["cart"]));
	unset($cart[$_GET["index"]]);
	$cart = array_values($cart);
	$_SESSION["cart"] = $cart;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<table cellpadding="2" cellspacing="2" border="1">
	<tr>
    	<th>Option</th>
        <th>Id</th>
        <th>Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Sub Total</th>
    </tr>
    
    <?php
		$cart = unserialize(serialize($_SESSION["cart"]));
		$s = 0;
		$index = 0;
		for($i = 0; $i < count($cart); $i++){
			$s += $cart[$i]->price * $cart[$i]->quantity;
	?>
    
    <tr>
    	<td><a href="cart.php?index=<?= $index ?>" onclick="return confirm('Are you sure?')">Delete</a></td>
        <td><?= $cart[$i]->id ?></td>
        <td><?= $cart[$i]->name ?></td>
        <td><?= $cart[$i]->price ?></td>
        <td><?= $cart[$i]->quantity ?></td>
        <td><?= $cart[$i]->price * $cart[$i]->quantity ?></td>
    </tr>
    <?php
		$index++;
		}
	?>
    <tr>
    	<td colspan="5" align="right">Sum</td>
        <td align="left"><?= $s ?></td>
    </tr>
</table>
<br />
<a href="index.php">continue Shopping</a>

</body>
</html>