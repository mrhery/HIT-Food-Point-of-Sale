<?php
session_start();
if(isset($_SESSION["user_name"])){
	
	$user_name = $_SESSION["user_name"];
	
	require_once("includes/connection.php");
	
	if(isset($_GET["type_name"], $_GET["addon"])){
		
		$order_id = $_GET["order_id"];
		$addon = $_GET["addon"];
		$type_name = $_GET["type_name"];
		$order_ad = "ad";
		
		
		$qorder = mysqli_query($conn, "SELECT * FROM orders WHERE order_id = '{$order_id}' AND order_ad = '{$order_ad}'");

		$printed = "printed";
		$uorder = mysqli_query($conn, "UPDATE orders SET order_adprint = '{$printed}' WHERE order_id = '{$order_id}'");
		
?>
	<script type="text/javascript" src="jquery.js" > </script> 
	<script>

    function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data) 
    {
        var mywindow = window.open('', 'my div', 'height=700,width=300');
        mywindow.document.write('<html><head><title>my div</title>');
        /*optional stylesheet*/ //mywindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10

        mywindow.print();
        mywindow.close();

        return true;
    }

	</script>
	<title>Print Order: <?= $type_name ?></title>
	
	
	<a href="addon.php">&larr; Back</a>
	<div id="mydiv">
    <hr />
		<strong  style="font-size:12px;">
        	Addon Order
            <?php
				$qorder1 = mysqli_query($conn, "SELECT * FROM orders WHERE order_id = '{$order_id}' AND order_ad = '{$order_ad}'");
				$rorder = mysqli_fetch_array($qorder1);
				$order_adprint = $rorder["order_adprint"];
				if($order_adprint == "printed"){
					echo "REPRINT";
				}
			?>
            <br />
           <?php
				$qtable = mysqli_query($conn, "SELECT * FROM tables WHERE table_no = '{$addon}'");
				$ntable = mysqli_num_rows($qtable);
				if($ntable == 0){
					echo "Bungkus: " . $addon;
				}else{
					echo "Table: " . $addon;
				}
			
			?></strong><br />
        <strong  style="font-size:12px;">Time : <?= date("H:i:s", time() + 28800) ?></strong><br />
		<br /><br />
        
    	<?php
			while($rqorder = mysqli_fetch_array($qorder)){
		?>
    			
               <strong style="font-size:12px;"><?= $rqorder["order_item"] ?> x <?= $rqorder["order_quantity"] ?></strong>  <br />
               *<?= $rqorder["order_note"] ?>*<?php
			   	$order_item = $rqorder["order_item"];
					$qitem = mysqli_query($conn, "SELECT * FROM items WHERE item_name = '{$order_item}'");
					$ritem = mysqli_fetch_array($qitem);
					$item_desc = $ritem["item_desc"];
					echo "$item_desc";
			   ?>
                <br /><br >
        <?php
			}
		?>
	</div>
    <br /><br />
    <form method="post" action="">
    	<input name="print" type="button" value="Print" onclick="PrintElem('#mydiv')" />
	</form>
    
<?php
	}
}else{
	header("Location: ../index.php");
}
?>