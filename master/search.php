<?php
    $key=$_GET['key'];
    $array = array();
    $conn = mysqli_connect("localhost", "root", "", "hanc");
    $query=mysqli_query($conn, "SELECT * FROM items WHERE item_short LIKE '%{$key}%'");
    while($row=mysqli_fetch_assoc($query))
    {
      $array[] = $row['title'];
    }
    echo json_encode($array);
?>
