<?php
$conn = mysqli_connect('localhost', 'root', 'root', 'projectweb');

if (!$conn) {
    echo 'Error: ' . mysqli_connect_error();
}

?>