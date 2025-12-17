<?php

require_once('../../conn.php');

$get = $_GET["id"];

$query1 = mysqli_query($conn, "DELETE FROM growjetd
WHERE id='$get'");

if($query1){
      header("location:../../fetch.php");
}
else{
    echo "Error deleting record: " . mysqli_error($conn);
}

?>