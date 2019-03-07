<?php
// config oracle database
$servername = "localhost/XE";
$dbUsername = "tugas";
$dbPassword = "tugas";

// create connection to oracle database
$conn = oci_connect($dbUsername, $dbPassword, $servername);
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
?>