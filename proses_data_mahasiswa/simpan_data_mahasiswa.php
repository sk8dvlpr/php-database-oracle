<?php
  // get database config
  require '../database_config.php';

  // get data from view
  $npm = $_POST['inputNpm'];
  $namaMahasiswa = $_POST['inputNamaMahasiswa'];
  $semester = $_POST['inputSemester'];
  $prodi = $_POST['inputProdi'];

  // query for insert data
  $query = oci_parse($conn, "INSERT INTO mahasiswa (npm, nama_mahasiswa, semester, kd_prodi) VALUES ('$npm', '$namaMahasiswa', '$semester', '$prodi')");
  oci_execute($query);

  // page redirect
  header("location: ../view_data_mahasiswa.php");
?>