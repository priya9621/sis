<?php

$mysqli = new mysqli('localhost','root','','import-project');

if($mysqli->connect_errno){
    echo "Failed to connect MySQLi:".$mysqli->connect_error;
    die;
}
?>
<?php
// $con = new mysqli('localhost', 'root', '', 'import-project');

// if ($con->connect_errno) {
//     echo "Failed to connect to MySQL: " . $con->connect_error;
//     die;
// }
?>


