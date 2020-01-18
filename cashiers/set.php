<?php
$conn = mysqli_connect("localhost", "root", "", "hanc");
if($conn == FALSE){
	echo "Error connecting DBS";
}
$set = "Set";
$qitem = mysqli_query($conn, "SELECT * FROM items WHERE item_type = '{$set}'")
while($ritem = mysqli_fetch_array($qitem)){
?>
<strong><?= $ritem["item_name"] ?> - RM <?= number_format($ritem["item_name"], 2) ?></strong>
<ul>
	<li><?= $ritem["item_desc"] ?></li>
</ul>


<?php
}
?>

