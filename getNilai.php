<?php
  // get database config
  require "database_config.php";

  // get parameter by post method
  $id = $_POST['id'];

  // query for get data by npm
  $query = oci_parse($conn, "SELECT * FROM nilai WHERE id = '$id'");
  oci_execute($query);

  // return data as json
  while ($row = oci_fetch_array($query, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo json_encode($row);
  }
?>