<?php
  // get database config
  require '../database_config.php';

  // get data from view
  $npm = $_POST['ubahNpm'];
  $absensi = $_POST['ubahAbsensi'];
  $tugas = $_POST['ubahTugas'];
  $uts = $_POST['ubahUTS'];
  $uas = $_POST['ubahUAS'];

  // query for update data
  $query = oci_parse($conn, "UPDATE nilai SET absensi = '$absensi', tugas = '$tugas', uts = '$uts', uas = '$uas' WHERE npm = '$npm'");
  oci_execute($query);

  // page redirect
  header("location: ../view_nilai_mahasiswa.php");
?>