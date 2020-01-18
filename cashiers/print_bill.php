<?php
session_start();
if(isset($_SESSION["user_name"])){
	
	$user_name = $_SESSION["user_name"];
	
	require_once("includes/connection.php");
	
	if(isset($_GET["table_no"], $_GET["bill_no"])){
		
		$table_no = $_GET["table_no"];
		$bill_no = $_GET["bill_no"];
		
		$qorder = mysqli_query($conn, "SELECT * FROM orders WHERE order_table = '{$table_no}'");
		
		$qbill = mysqli_query($conn, "SELECT * FROM bills WHERE bill_no = '{$bill_no}'");
		$rqbill = mysqli_fetch_array($qbill);
		
		
		
?>
<!DOCTYPE html>
<head>
<style>
table tr td {
  font-size: 8pt;
  font-family:'Times New Roman',Times,serif;
}
</style>
	<script type="text/javascript" src="jquery.js" > </script> 
	<script type="text/javascript">

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
	<title>Print Bill: <?= $bill_no ?></title>
</head>

<body>
   
	<div id="mydiv">
   		<div align="center">
        	<strong style="font-size:10px;">Restoran Ayam Kampung Hanc</strong><br />
            <strong style="font-size:10px;">No 12 & 14, Jalan Kampung Tengah,</strong><br />
            <strong style="font-size:10px;">Taman Fajar Jaya, 86000</strong><br />
			<strong style="font-size:10px;">Kluang, JOhor.</strong><br />
            <strong style="font-size:10px;">07-771 2322 / hanckitchen@gmail.com</strong>
        </div>
    <hr />
    <div style="margin-left:25px;">
		<strong style="font-size:20px;">Table / Customer <?= $table_no ?></strong><br />
        <strong  style="font-size:10px;">Bill no: <?= $bill_no ?></strong><br />
        <strong  style="font-size:10px;">Date : <?= $rqbill["bill_date"] ?></strong><br />
        <strong  style="font-size:10px;">Cashier : <?= $rqbill["bill_cashier"] ?></strong><br />
		<br /><br />
    </div>
        <table align="center" width="100%">
        	
            <tr style="font-size: 10px;">
            	<th>No</th>
                <th>Item</th>
                <th>Qty</th>
                <th>Total</th>
            </tr>
            
    	<?php
			$no = 0 + 1;
			while($rqorder = mysqli_fetch_array($qorder)){
		?>
        	<tr>
            	<td style="font-size:10px;"><?= $no ?></td>
                <td style="font-size:10px;">
					<?= $rqorder["order_item"] ?><br />
					*<?php
						$item_name = $rqorder["order_item"];
						$qitem = mysqli_query($conn, "SELECT * FROM items WHERE item_name = '{$item_name}'");
						$ritem = mysqli_fetch_array($qitem);
						
						echo $ritem['item_desc'];
					?>
				</td>
                <td style="font-size:10px;"><?= $rqorder["order_quantity"] ?></td>
                <td align="right" style="font-size:10px;"><?= number_format($rqorder["order_total"], 2) ?></td>
            </tr>
                
                
        <?php
			$no++;
			}
		?>
        <tr>
            	<td></td>
                <td><strong>Total</strong></td>
                <td></td>
                <td align="right"><?= number_format($rqbill["bill_total"], 2) ?></td>
            </tr>
        </table>
	</div>
    <br /><br />
    <input type="button" value="Print" onclick="PrintElem('#mydiv')" />
    
</body>
</html>
<?php
	}
}else{
	header("Location: ../index.php");
}
?>