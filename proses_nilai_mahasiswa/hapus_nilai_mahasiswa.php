<?php
  // get database config
  require '../database_config.php';

  // get parameter npm from url
  $npm = $_GET['npm'];

  // query for delete data
  $query = oci_parse($conn, "DELETE FROM nilai WHERE npm = '$npm'");
  oci_execute($query);
  
  // page redirect
  header("location: ../view_nilai_mahasiswa.php");
?>