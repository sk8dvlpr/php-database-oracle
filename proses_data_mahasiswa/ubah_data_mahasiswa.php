<?php
  // get database config
  require '../database_config.php';

  // get data from view
  $npm = $_POST['ubahNpm'];
  $namaMahasiswa = $_POST['ubahNamaMahasiswa'];
  $semester = $_POST['ubahSemester'];
  $prodi = $_POST['ubahProdi'];

  // query for update data
  $query = oci_parse($conn, "UPDATE mahasiswa SET nama_mahasiswa = '$namaMahasiswa', semester = '$semester', kd_prodi = '$prodi' WHERE npm = '$npm'");
  oci_execute($query);

  // page redirect
  header("location: ../view_data_mahasiswa.php");
?>