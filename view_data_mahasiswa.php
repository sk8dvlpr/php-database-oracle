<?php require 'database_config.php '?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Kampus - Data Mahasiswa</title>

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
                <a class="nav-link active" href="view_data_mahasiswa.php">
                  <span data-feather="users"></span>
                  Data Mahasiswa <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="view_nilai_mahasiswa.php">
                  <span data-feather="star"></span>
                  Data Nilai
                </a>
              </li>
            </ul>
          </div>
        </nav>

        <?php
          // query for fetch data mahasiswa
          $query1 = oci_parse($conn, 'SELECT npm, nama_mahasiswa, semester, nama_prodi FROM mahasiswa m, prodi p where m.kd_prodi=p.kd_prodi ORDER BY m.npm ASC');
          oci_execute($query1);

          // qeury for fetch data prodi on modal tambah
          $query2 = oci_parse($conn, 'SELECT * FROM prodi');
          oci_execute($query2);

          // qeury for fetch data prodi on modal ubah
          $query3 = oci_parse($conn, 'SELECT * FROM prodi');
          oci_execute($query3);
        ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
            <h1 class="h2">Data Mahasiswa</h1>
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
                <form action="proses_data_mahasiswa/simpan_data_mahasiswa.php" method="POST">
                  <div class="modal-body">
                    <div class="form-group">
                      <label for="inputNpm">NPM</label>
                      <input type="text" class="form-control" name="inputNpm" id="inputNpm" placeholder="NPM">
                    </div>
                    <div class="form-group">
                      <label for="inputNamaMahasiswa">Nama Mahasiswa</label>
                      <input type="text" class="form-control" name="inputNamaMahasiswa" id="inputNamaMahasiswa" placeholder="Nama Mahasiswa">
                    </div>
                    <div class="form-group">
                      <label for="inputSemester">Semester</label>
                      <input type="number" class="form-control" name="inputSemester" id="inputSemester" placeholder="Semester">
                    </div>
                    <div class="form-group">
                      <label for="inputProdi">Prodi</label>
                      <select name="inputProdi" id="inputProdi" class="form-control">
                      <?php
                        // fetch data prodi
                        echo "<option value='' selected>Pilih</option>";
                        while ($row = oci_fetch_array($query2, OCI_ASSOC+OCI_RETURN_NULLS)) {
                          echo "<option value=". $row['KD_PRODI'] .">" . $row['NAMA_PRODI'] . "</option>\n";
                        }
                      ?>
                      </select>
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
                <form action="proses_data_mahasiswa/ubah_data_mahasiswa.php" method="POST">
                  <div class="modal-body">
                    <div class="form-group">
                      <label for="ubahNpm">NPM</label>
                      <input type="text" class="form-control" name="ubahNpm" id="ubahNpm" placeholder="NPM">
                    </div>
                    <div class="form-group">
                      <label for="ubahNamaMahasiswa">Nama Mahasiswa</label>
                      <input type="text" class="form-control" name="ubahNamaMahasiswa" id="ubahNamaMahasiswa" placeholder="Nama Mahasiswa">
                    </div>
                    <div class="form-group">
                      <label for="ubahSemester">Semester</label>
                      <input type="number" class="form-control" name="ubahSemester" id="ubahSemester" placeholder="Semester">
                    </div>
                    <div class="form-group">
                      <label for="ubahProdi">Prodi</label>
                      <select name="ubahProdi" id="ubahProdi" class="form-control">
                      <?php
                        // fetch data prodi
                        echo "<option value='' selected>Pilih</option>";
                        while ($row = oci_fetch_array($query3, OCI_ASSOC+OCI_RETURN_NULLS)) {
                          echo "<option value=". $row['KD_PRODI'] .">" . $row['NAMA_PRODI'] . "</option>\n";
                        }
                      ?>
                      </select>
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
                  <th>NPM</th>
                  <th>Nama Mahasiswa</th>
                  <th>Semester</th>
                  <th>Jurusan</th>
                  <th>Edit</th>
                  <th>Hapus</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  // fetch data mahasiswa
                  while ($row = oci_fetch_array($query1, OCI_ASSOC+OCI_RETURN_NULLS)) {
                    echo "<tr>\n";
                    foreach ($row as $item) {
                      echo "<td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
                    }
                    ?>
                      <td><button class="btn btn-sm btn-success btnUbah" data-ubah="<?php echo $row["NPM"]?>" data-toggle="modal" data-target="#ubahMahasiswa"><span data-feather="edit"></span> Edit</button></td>
                      <td><a class="btn btn-sm btn-danger" href="proses_data_mahasiswa/hapus_data_mahasiswa.php?npm=<?php echo $row["NPM"]?>"><span data-feather="trash"></span> Hapus</a></td>
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
    <script src="src/popper.min.js"></script>
    <script src="src/bootstrap.min.js"></script>

    <!-- Icons -->
    <script src="src/feather.min.js"></script>
    <script>
      feather.replace();
    </script>

    <script>
      $(document).on('click', '.btnUbah', function () {
        var npm = $(this).data('ubah');
        $.ajax({
          url: "getData.php",
          type: "POST",
          data: {npm:npm},
          success: function (data) {
            var json = $.parseJSON(data);
            $('#ubahNpm').val(json.NPM);
            $('#ubahNamaMahasiswa').val(json.NAMA_MAHASISWA);
            $('#ubahSemester').val(json.SEMESTER);
            $('#ubahProdi').val(json.KD_PRODI);
          }
        });
      });
    </script>
  </body>
</html>
