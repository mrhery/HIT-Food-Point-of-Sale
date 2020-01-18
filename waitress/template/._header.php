<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="template/jquery.js"></script>
<link href="style/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="style.css" rel="stylesheet" />
<title>i-POS : Waitress</title>

<script> 
$(document).ready(function(){
    $("#flip").click(function(){
        $("#panel").slideToggle("slow");
    });
});
</script>

</head>

<body>
<div id="flip"><strong style="font-size:18px; color:#CCC;">Menu</strong></div>
	<div id="panel">
                <a href="index.php">Main Page</a>
                <a href="table.php">Dine-In</a>
                <a href="takeaway.php">Take Away</a>
                <a href="addon.php">Add On</a>
                <a href="logout.php">Logout</a>
           </div>
	</div>