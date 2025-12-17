<?php

require_once('../../conn.php');

$get = $_GET["id"];

$query = mysqli_query($conn, "DELETE FROM detailshome
WHERE id='$get'");

if ($query) {
    header("location:../details-home.php");
}

?>