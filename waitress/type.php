<?php
session_start();
if(isset($_SESSION["user_name"])){
	
	$user_name = $_SESSION["user_name"];
require_once("includes/connection.php");
require_once("template/._header.php");
$table_no = $_GET["table_no"];


	if(isset($_GET["type_name"])){
		
		$type_name = $_GET["type_name"];
		
?>
		<style type="text/css">
.panel-default{padding: 15px;}
.form-group{margin-top: 15px;}
.panel-heading{background-color: #40A2BE !important; color: #000 !important;}
#loading{display: none;}
#searchid
{
    width:500px;
    border:solid 1px #000;
    padding:10px;
    font-size:14px;
}
#result
{
	display: none;
    width:500px;
    padding:10px;
    border-top:0px;
    border:1px #CCC solid;
    background-color: white;
}
.show{font-size:20px;height: 50px;padding: 5px;}
.show:hover{background:#40A2BE;color:#000;cursor:pointer;}

</style>

	<div id="header" align="center">
    	<h2 style="padding:5px; color: #FFF;">Waiteress</h2>
   </div>

	<div id="nav_bar" align="center">
    	<?php
			
			$qtype = mysqli_query($conn, "SELECT * FROM types");
			
			while($rtypq = mysqli_fetch_array($qtype)){
				
		?>
        <a href="type.php?type_name=<?= $rtypq["type_name"] ?>&table_no=<?= $table_no ?>"><strong><?= $rtypq["type_name"] ?></strong></a>
    	
    	<?php
			}
		?>
        <a href="summary.php?table_no=<?= $table_no ?>"><strong>Summary</strong></a>
    </div><br />
    <hr />


<?php
			
?>
		<!-- Live Search -->
		<script>
$(document).ready(function(){
	var req = null;
	$('#keysearch').on('keyup', function(){
		var key = $('#keysearch').val();
		if (key && key.length > 0)
		{
			$('#loading').css('display', 'block');
			if (req)
				req.abort();
			req = $.ajax({
				url : 'search.php?table_no=<?= $table_no ?>&type_name=<?= $type_name ?>',
				type : 'POST',
				cache : false,
				data : {
					keysearch : key,
				},
				success : function(data)
				{
					console.log(data)
					if (data)
					{
						$('#loading').css('display', 'none');
						$("#result").html(data).show();
					}
				}
			});
		}
		else
		{
			$('#loading').css('display', 'none');
			$('#result').css('display', 'none');
		}

	});
});
</script>
<div class="container" align="center">
		<div class="row">
			<div class="panel panel-default">
					<div class="form-group">
							<input name="keysearch" autofocus="on" value="" placeholder="Quick Search" id="keysearch" type="text" class="form-control" style="font-size:28px;" />
						<span id="loading">Loading...</span>
					</div>
				<div id="result"></div>
			</div>
		</div>
	</div>
	<!-- Live search End -->

<?php
		$qcategory = mysqli_query($conn, "SELECT * FROM categorys WHERE category_type = '{$type_name}'");
			
		while($rqcategory = mysqli_fetch_array($qcategory)){	
		
		$category_name = $rqcategory["category_name"];
		if($category_name == $type_name){
			
			$qitem = mysqli_query($conn, "SELECT * FROM items WHERE item_category = '{$category_name}'");
			while($rqitem = mysqli_fetch_array($qitem)){
				?>
				<div id="item_menu" style="margin:15px; width: 75%;" align="center">
		<a href="order.php?item_id=<?= $rqitem["item_id"] ?>&table_no=<?= $table_no ?>&type_name=<?= $type_name ?>">
        	<div align="center">
            	
                <br />
                
				<?= $rqitem["item_name"] ?> - (<?= $rqitem["item_price"] ?>)<br />
				*<?= $rqitem["item_desc"] ?>
           	</div>
       </a>
	</div>
			<?php	
			}
			
		}else{
		
?>
	
	<div id="cat_menu" style="float: left; margin:25px;">
	<a href="category.php?category_name=<?= $rqcategory["category_name"] ?>&table_no=<?= $table_no ?>&type_name=<?= $type_name ?>">
		
		<?= $rqcategory["category_name"] ?>
		
    </a>
	</div>

<?php
		}
		}
		?>
		<br />
		<br />
		<table width="100%" border="1">
		<tr>
        	<th width="10%">No</th>
            <th width="35%">Item</th>
            <th width="10%">Qty.</th>
            <th width="20%">Total</th>
            <th width="25%">Action</th>
        </tr>
        
        <?php
			$qorder = mysqli_query($conn, "SELECT * FROM orders WHERE order_table = '{$table_no}' AND order_type = '{$type_name}'");
			$no = 0 + 1;
			$sorder = mysqli_query($conn, "SELECT SUM(order_total) FROM orders WHERE order_table = '{$table_no}'");
			$rsorder = mysqli_fetch_array($sorder);
			while($rorder = mysqli_fetch_array($qorder)){
		?>
        <tr>
        	<td align="center"><?= $no ?></td>
            <td align="center"><?= $rorder["order_item"] ?>
			</td>
            
            <td align="center" style="font-size:40px;">
            		<a style="text-decoration:none; color:red;" href="del_order.php?order_id=<?= $rorder["order_id"] ?>&table_no=<?= $table_no ?>"><strong>-</strong></a><br />
					<?= $rorder["order_quantity"] ?> <br />
                    <a href="uorder.php?order_id=<?= $rorder["order_id"] ?>" style="text-decoration:none; color:green;"><strong>+</strong></a>
            </td>
                
            <td align="right"><?= number_format($rorder["order_total"], 2) ?></td>
            <td align="center">
			<div id="sum_but">
            	<a href="del_order.php?order_id=<?= $rorder["order_id"] ?>&table_no=<?= $table_no ?>">		
                	<strong>Delete</strong>
                </a> <br />
                <a href="add_note.php?order_id=<?= $rorder["order_id"] ?>&table_no=<?= $table_no ?>">
                	<strong>Add Notes</strong>
                </a>
				</div>
            </td>
        </tr>
        <?php
			$no++;
			}
		?>
        <tr>
        	<td></td>
            <td align="center"><strong>TOTAL</strong></td>
            <td></td>
            <td align="right"><strong><?= number_format($rsorder["SUM(order_total)"], 2) ?></strong></td>    
        </tr>
	</table>

		<?php		
	}
require_once("template/._footer.php");
}else{
header("Location: ../index.php");
}
?>

