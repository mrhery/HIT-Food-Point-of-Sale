<?php
session_start();
if(isset($_SESSION["user_name"])){
	
	$user_name = $_SESSION["user_name"];
	
	require_once("includes/connection.php");
	
	if(isset($_GET["type_name"], $_GET["table_no"], $_GET["bill_no"])){
		
		$table_no = $_GET["table_no"];
		$type_name = $_GET["type_name"];
		$bill_no = $_GET["bill_no"];
		$zero = "0";
		$ubill = mysqli_query($conn, "UPDATE bills SET bill_print = '{$zero}' WHERE bill_table = '{$table_no}'");
		
		$qorder = mysqli_query($conn, "SELECT * FROM orders WHERE order_type = '{$type_name}' AND order_table = '{$table_no}'");
		
		$qbill = mysqli_query($conn, "SELECT * FROM bills WHERE bill_no = '{$bill_no}'");
		$rqbill = mysqli_fetch_array($qbill);
		
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
	<div id="mydiv">
    <hr />
		<strong >
		<?php
		$qtable = mysqli_query($conn, "SELECT * FROM tables WHERE table_no = '{$table_no}'");
		$ntable = mysqli_num_rows($qtable);
		if($ntable == 0){
			echo "Bungkus: " . $table_no; 
		}else{
			echo "Table: " . $table_no;
		}
		
		
		?></strong><br />
        <strong  style="font-size:9px;">Bill no: <?= $bill_no ?></strong><br />
        <strong  style="font-size:9px;">Date : <?= $rqbill["bill_date"] ?></strong><br />
		<br /><br />
        
    	<?php
			while($rqorder = mysqli_fetch_array($qorder)){
				$order_item = $rqorder["order_item"];
		?>
    			
               <strong><?= $rqorder["order_item"] ?> x <?= $rqorder["order_quantity"] ?></strong>  <br />
			   <strong style="font-size:12px;">*<?= $rqorder["order_note"] ?> &nbsp;*
			   <?php
					$qitem = mysqli_query($conn, "SELECT * FROM items WHERE item_name = '{$order_item}'");
					$ritem = mysqli_fetch_array($qitem);
					$item_desc = $ritem["item_desc"];
					echo "$item_desc";
			   ?>
			   </strong><br />
                
        <?php
			}
		?>
	</div>
    <br /><br />
    <input type="button" value="Print" onclick="PrintElem('#mydiv')" />
    
    
<?php
	}
}else{
	header("Location: ../index.php");
}
?>