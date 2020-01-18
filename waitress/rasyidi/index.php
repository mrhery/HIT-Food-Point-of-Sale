<?php

$conn = mysqli_connect("localhost", "root", "", "hanc");

if(isset($_POST["submit"])){
	
	$qtest = mysqli_query($conn, "SELECT * FROM test ORDER BY test_id DESC LIMIT 1");
	$rqtest = mysqli_fetch_array($qtest);
	$id = $rqtest["test_id"];
	
	$new = $id + 1;
	$new_id = "S".$new;
	
	$itest = mysqli_query($conn, "INSERT INTO test(test_no) VALUES('{$new_id}')");
	
}

?>

<form action="" method="post">
	<input type="text" name="uniq"  />
    <input type="submit" name="submit" value="Submit" />
</form>