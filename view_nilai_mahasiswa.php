<?php require 'database_config.php '?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Kampus - Nilai Mahasiswa</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="src/bootstrap.min.css">

    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">
  </head>

  <body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="view_data_mahasiswa.php">Tugas Kelompok</a>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link" href="view_data_mahasiswa.php">
                  <span data-feather="users"></span>
                  Data Mahasiswa
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="view_nilai_mahasiswa.php">
                  <span data-feather="star"></span>
                  Data Nilai <span class="sr-only">(current)</span>
                </a>
              </li>
            </ul>
          </div>
        </nav>

        <?php
          $query1 = oci_parse($conn, 'SELECT id, m.npm, nama_mahasiswa, k.nama_matakuliah, absensi, tugas, uts, uas FROM mahasiswa m, nilai n, matakuliah k where m.npm=n.npm AND n.kd_matakuliah=k.kd_matakuliah ORDER BY id ASC');
          oci_execute($query1);

          $query2 = oci_parse($conn, 'SELECT * FROM mahasiswa');
          oci_execute($query2);

          $query3 = oci_parse($conn, 'SELECT * FROM MATAKULIAH');
          oci_execute($query3);
        ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
            <h1 class="h2">Data Nilai Mahasiswa</h1>
          </div>

          <button class="btn btn-sm btn-primary mb-2" data-toggle="modal" data-target="#tambahMahasiswa">
            <span data-feather="user-plus"></span> Tambah Mahasiswa
          </button>

          <!-- Modal Tambah Mahasiswa -->
          <div class="modal fade" id="tambahMahasiswa" tabindex="-1" role="dialog" aria-labelledby="tambahMahasiswaModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="tambahMahasiswaModalLabel">Tambah Mahasiswa</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="proses_nilai_mahasiswa/simpan_nilai_mahasiswa.php" method="POST">
                  <div class="modal-body">
                    <div class="form-group">
                      <label for="inputNpm">NPM</label>
                      <select name="inputNpm" id="inputNpm" class="form-control">
                      <?php
                        echo "<option value='' selected>Pilih</option>";
                        while ($row = oci_fetch_array($query2, OCI_ASSOC+OCI_RETURN_NULLS)) {
                          echo "<option value='". $row['NPM'] ."'>" . $row['NPM'] . "</option>\n";
                        }
                      ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="inputNamaMahasiswa">Nama Mahasiswa</label>
                      <input type="text" class="form-control" name="inputNamaMahasiswa" id="inputNamaMahasiswa" placeholder="Nama Mahasiswa" disabled>
                    </div>
                    <div class="form-group">
                      <label for="inputMatkul">Mata Kuliah</label>
                      <select name="inputMatkul" id="inputMatkul" class="form-control">
                      <?php
                        echo "<option value='' selected>Pilih</option>";
                        while ($row = oci_fetch_array($query3, OCI_ASSOC+OCI_RETURN_NULLS)) {
                          echo "<option value='". $row['KD_MATAKULIAH'] ."'>" . $row['NAMA_MATAKULIAH'] . "</option>\n";
                        }
                      ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="inputAbsensi">Nilai Absensi</label>
                      <input type="number" class="form-control" name="inputAbsensi" id="inputAbsensi" placeholder="Nilai Absensi">
                    </div>
                    <div class="form-group">
                      <label for="inputTugas">Nilai Tugas</label>
                      <input type="number" class="form-control" name="inputTugas" id="inputTugas" placeholder="Nilai Tugas">
                    </div>
                    <div class="form-group">
                      <label for="inputUTS">Nilai UTS</label>
                      <input type="number" class="form-control" name="inputUTS" id="inputUTS" placeholder="Nilai UTS">
                    </div>
                    <div class="form-group">
                      <label for="inputUAS">Nilai UAS</label>
                      <input type="number" class="form-control" name="inputUAS" id="inputUAS" placeholder="Nilai UAS">
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary"><span data-feather="save"></span> Simpan</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <!-- Modal Ubah Mahasiswa -->
          <div class="modal fade" id="ubahMahasiswa" tabindex="-1" role="dialog" aria-labelledby="ubahMahasiswaModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="ubahMahasiswaModalLabel">Ubah Mahasiswa</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="proses_nilai_mahasiswa/ubah_nilai_mahasiswa.php" method="POST">
                  <div class="modal-body">
                    <div class="form-group">
                      <label for="ubahNpm">NPM</label>
                      <input type="text" class="form-control" name="ubahNpm" id="ubahNpm" placeholder="NPM" readonly>
                    </div>
                    <div class="form-group">
                      <label for="ubahAbsensi">Nilai Absensi</label>
                      <input type="number" class="form-control" name="ubahAbsensi" id="ubahAbsensi" placeholder="Nilai Absensi">
                    </div>
                    <div class="form-group">
                      <label for="ubahTugas">Nilai Tugas</label>
                      <input type="number" class="form-control" name="ubahTugas" id="ubahTugas" placeholder="Nilai Tugas">
                    </div>
                    <div class="form-group">
                      <label for="ubahUTS">Nilai UTS</label>
                      <input type="number" class="form-control" name="ubahUTS" id="ubahUTS" placeholder="Nilai UTS">
                    </div>
                    <div class="form-group">
                      <label for="ubahUAS">Nilai UAS</label>
                      <input type="number" class="form-control" name="ubahUAS" id="ubahUAS" placeholder="Nilai UAS">
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary"><span data-feather="save"></span> Ubah</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>NPM</th>
                  <th>Nama Mahasiswa</th>
                  <th>Nama Mata Kuliah</th>
                  <th>Absen</th>
                  <th>Tugas</th>
                  <th>UTS</th>
                  <th>UAS</th>
                  <th>Edit</th>
                  <th>Hapus</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  while ($row = oci_fetch_array($query1, OCI_ASSOC+OCI_RETURN_NULLS)) {
                    echo "<tr>\n";
                    foreach ($row as $item) {
                      echo "<td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
                    }
                    ?>
                      <td><button class="btn btn-sm btn-success btnUbah" data-ubah="<?php echo $row["ID"]?>" data-toggle="modal" data-target="#ubahMahasiswa"><span data-feather="edit"></span> Edit</button></td>
                      <td><a class="btn btn-sm btn-danger" href="proses_nilai_mahasiswa/hapus_nilai_mahasiswa.php?npm=<?php echo $row["NPM"]?>"><span data-feather="trash"></span> Hapus</a></td>
                    <?php
                    echo "</tr>\n";
                  }
                ?>
              </tbody>
            </table>
          </div>
        </main>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="src/jquery.min.js"></script>
    <script src="src/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="src/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <!-- Icons -->
    <script src="src/feather.min.js"></script>
    <script>
      feather.replace();
    </script>

    <script>
      $(document).on('change', '#inputNpm', function () {
        var npm = $("#inputNpm").val();
        $.ajax({
          url: "getData.php",
          type: "POST",
          data: {npm:npm},
          success: function (data) {
            var json = $.parseJSON(data);
            $('#inputNamaMahasiswa').val(json.NAMA_MAHASISWA);
          }
        });
      });
    </script>

    <script>
      $(document).on('click', '.btnUbah', function () {
        var id = $(this).data('ubah');
        $.ajax({
          url: "getNilai.php",
          type: "POST",
          data: {id:id},
          success: function (data) {
            var json = $.parseJSON(data);
            $('#ubahNpm').val(json.NPM);
            $('#ubahNamaMahasiswa').val(json.NAMA_MAHASISWA);
            $('#ubahAbsensi').val(json.ABSENSI);
            $('#ubahTugas').val(json.TUGAS);
            $('#ubahUTS').val(json.UTS);
            $('#ubahUAS').val(json.UAS);
          }
        });
      });
    </script>
  </body>
</html>
