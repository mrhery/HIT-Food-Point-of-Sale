<?php
session_start();
if(isset($_SESSION["user_name"])){
	
	$user_name = $_SESSION["user_name"];
	
	require_once("includes/connection.php");
	
	if(isset($_GET["type_name"], $_GET["customer"])){
		
		$customer = $_GET["customer"];
		$type_name = $_GET["type_name"];
		$order_ad = "ad";
		
		$qorder = mysqli_query($conn, "SELECT * FROM orders WHERE order_table = '{$customer}' AND order_ad = '{$order_ad}'");
		
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
	
	
	<a href="takeaway.php">&larr; Back</a>
	<div id="mydiv">
    <hr />
		<strong  style="font-size:12px;">Customer :<?= $customer ?></strong><br />
        <strong  style="font-size:12px;">Time : <?= date("H:i:s", time() + 28800) ?></strong><br />
		<br /><br />
        
    	<?php
			while($rqorder = mysqli_fetch_array($qorder)){
		?>
    			
               <strong style="font-size:12px;"><?= $rqorder["order_item"] ?> x <?= $rqorder["order_quantity"] ?></strong>  <br />
                
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