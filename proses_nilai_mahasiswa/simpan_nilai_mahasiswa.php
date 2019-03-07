<?php
  // get database config
  require '../database_config.php';

  // get data from view
  $id;
  $npm = $_POST['inputNpm'];
  $matkul = $_POST['inputMatkul'];
  $absensi = $_POST['inputAbsensi'];
  $tugas = $_POST['inputTugas'];
  $uts = $_POST['inputUTS'];
  $uas = $_POST['inputUAS'];

  // couting for id value
  $count = oci_parse($conn, 'SELECT COUNT(1) as HASIL FROM nilai');
  oci_execute($count);
  while ($row = oci_fetch_array($count, OCI_ASSOC+OCI_RETURN_NULLS)) {
    $id = $row['HASIL'] + 1;
  }

  // query for insert data
  $query = oci_parse($conn, "INSERT INTO nilai (id, npm, absensi, tugas, uts, uas, kd_matakuliah) VALUES ('$id', '$npm', '$absensi', '$tugas', '$uts', '$uas', '$matkul')");
  oci_execute($query);

  // page redirect
  header("location: ../view_nilai_mahasiswa.php");
?>