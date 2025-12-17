<?php

require_once('../../conn.php');

$get = $_GET["id"];

$query = mysqli_query($conn, "DELETE FROM home
WHERE id='$get'");

if ($query) {
    header("location:../home.php");
}
else{
    echo "Error deleting record: " . mysqli_error($conn);
}

?>