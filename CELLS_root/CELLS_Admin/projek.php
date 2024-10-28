<?php
require '../koneksi.php';

$sql = "SELECT * FROM projek ORDER BY sampul DESC";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

        <style>
          th {
          white-space: nowrap; /* Mencegah teks turun ke baris berikutnya */
          text-align: center;  /* Teks berada di tengah kolom */
          padding: 10px;       /* Jarak antar teks dan tepi kolom */
          }

          td, th {
              word-wrap: break-word; /* Agar konten teks di dalam sel tetap rapi */
              max-width: 500px;
          }
        </style>

    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">Cells Admin</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="#!">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <!-- <div class="sb-sidenav-menu-heading">Core</div> -->
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Data Team
                            </a>
                            <a class="nav-link" href="partnet.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Partner & Network
                            </a>
                            <a class="nav-link" href="projek.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Projek
                            </a>
                          </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Projek Cells</h1>

                        <div class="card mb-4">
                            <div class="card-header">
                              <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                              data-bs-target="#modal-projek">Tambah Team </button>
                            </div>
                            <div class="card-body">
                              <div class="table-responsive">
                                <div style="overflow-x: auto;">
                              <div class="table-responsive">
                              <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Nama Projek</th>
                                        <th>Caption Awal</th>
                                        <th>Sampul</th>
                                        <th>Deskripsi Projek (Pada Halaman Projek)</th>
                                        <th>Gambar 1</th>
                                        <th>Caption Gambar 1</th>
                                        <th>Gambar 2</th>
                                        <th>Caption Gambar 2</th>
                                        <th>Gambar 3</th>
                                        <th>Caption Gambar 3</th>
                                        <th>Aksi</th> <!-- Tambahkan Kolom Aksi -->
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                      <th>Nomor</th>
                                      <th>Nama Projek</th>
                                      <th>Caption Awal</th>
                                      <th>Sampul</th>
                                      <th>Deskripsi Projek (Pada Halaman Projek)</th>
                                      <th>Gambar 1</th>
                                      <th>Caption Gambar 1</th>
                                      <th>Gambar 2</th>
                                      <th>Caption Gambar 2</th>
                                      <th>Gambar 3</th>
                                      <th>Caption Gambar 3</th>
                                      <th>Aksi</th> <!-- Tambahkan Kolom Aksi -->
                                    </tr>
                                </tfoot>
                                <tbody>
                                  <?php
                                  // Query untuk mengambil data tambahan team
                                  $ambildataprojek = mysqli_query($koneksi, "SELECT * FROM projek");

                                  if (mysqli_num_rows($ambildataprojek) > 0) {
                                      $i = 1;
                                      while ($data = mysqli_fetch_array($ambildataprojek)) {
                                          $id_projek = $data['id_projek'];
                                          $nama_projek = $data['nama_projek'];
                                          $caption = $data['caption'];
                                          $sampul = $data['sampul'];
                                          $news = $data['news'];
                                          $gambar1 = $data['gambar1'];
                                          $capt1 = $data['capt1'];
                                          $gambar2 = $data['gambar2'];
                                          $capt2 = $data['capt2'];
                                          $gambar3 = $data['gambar3'];
                                          $capt3 = $data['capt3'];
                                  ?>
                                    <tr>
                                        <td><?=$i++?></td>
                                        <td><?=$nama_projek?></td>
                                        <td><?=$caption?></td>
                                        <td><img src="./img/projek/<?=$sampul?>" width="100" alt="Foto"></td>
                                        <td><?=$news?></td>
                                        <td><img src="./img/projek/<?=$gambar1?>" width="100" alt="Foto"></td>
                                        <td><?=$capt1?></td>
                                        <td><img src="./img/projek/<?=$gambar2?>" width="100" alt="Foto"></td>
                                        <td><?=$capt2?></td>
                                        <td><img src="./img/projek/<?=$gambar3?>" width="100" alt="Foto"></td>
                                        <td><?=$capt3?></td>
                                        <td>
                                          <!-- Tombol Edit -->
                                          <button type="button" class="btn btn-warning btn-square" data-bs-toggle="modal" data-bs-target="#edit-projek<?=$id_projek?>">
                                            <i class="fas fa-edit"></i>
                                          </button>
                                          <!-- Tombol Hapus -->
                                          <button type="button" class="btn btn-danger btn-square" onclick="confirmDelete(<?=$id_projek?>)">
                                            <i class="fas fa-trash"></i>
                                          </button>
                                        </td>
                                    </tr>
                            <!-- Modal Edit -->
                                    <div class="modal fade" id="edit-projek<?=$id_projek?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg"> <!-- Ubah ukuran modal menjadi lebih besar -->
                                            <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Projek</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <!-- Modal Body -->
                                                <form method="post" enctype="multipart/form-data">
                                                    <div class="modal-body">
                                                        <input type="hidden" name="id_projek" value="<?=$id_projek?>">

                                                        <!-- Input nama proyek -->
                                                        <div class="form-group mb-3">
                                                            <label for="nama_projek">Nama Proyek</label>
                                                            <input type="text" name="nama_projek" value="<?=$nama_projek?>" class="form-control" required>
                                                        </div>

                                                        <!-- Input caption -->
                                                        <div class="form-group mb-3">
                                                            <label for="caption">Caption</label>
                                                            <input type="text" name="caption" value="<?=$caption?>" class="form-control" required>
                                                        </div>

                                                        <!-- Input deskripsi -->
                                                        <div class="form-group mb-3">
                                                            <label for="news">Deskripsi Projek</label>
                                                            <textarea name="news" class="form-control" required><?=$news?></textarea>
                                                        </div>

                                                        <!-- Input sampul -->
                                                        <div class="form-group mb-3">
                                                            <label for="sampul">Sampul</label>
                                                            <input type="file" name="sampul" class="form-control">
                                                            <small class="form-text text-muted">File Sebelumnya: <?=$sampul?></small>
                                                        </div>

                                                        <!-- Input gambar 1 dan caption 1 -->
                                                        <div class="form-group mb-3">
                                                            <label for="gambar1">Gambar 1</label>
                                                            <input type="file" name="gambar1" class="form-control">
                                                            <small class="form-text text-muted">File Sebelumnya: <?=$gambar1?></small>
                                                            <input type="text" name="capt1" value="<?=$capt1?>" placeholder="Caption Gambar 1" class="form-control mt-2">
                                                        </div>

                                                        <!-- Input gambar 2 dan caption 2 -->
                                                        <div class="form-group mb-3">
                                                            <label for="gambar2">Gambar 2</label>
                                                            <input type="file" name="gambar2" class="form-control">
                                                            <small class="form-text text-muted">File Sebelumnya: <?=$gambar2?></small>
                                                            <input type="text" name="capt2" value="<?=$capt2?>" placeholder="Caption Gambar 2" class="form-control mt-2">
                                                        </div>

                                                        <!-- Input gambar 3 dan caption 3 -->
                                                        <div class="form-group mb-3">
                                                            <label for="gambar3">Gambar 3</label>
                                                            <input type="file" name="gambar3" class="form-control">
                                                            <small class="form-text text-muted">File Sebelumnya: <?=$gambar3?></small>
                                                            <input type="text" name="capt3" value="<?=$capt3?>" placeholder="Caption Gambar 3" class="form-control mt-2">
                                                        </div>

                                                        <!-- Submit button -->
                                                        <div class="form-group text-end">
                                                            <button type="submit" name="editprojek" class="btn btn-primary">Simpan Perubahan</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='6'>Tidak ada data yang ditemukan.</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                              </div>
                            </div>
                        </div>
                    </div>
                  </div>
              </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>
<!-- alert hapus data team -->
<script>
          function confirmDelete(id) {
              if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                  window.location.href = "projek.php?id_projek=" + id;
              }
          }

          // Fungsi untuk memperbarui nama file yang baru dipilih
    function updateFileName(inputElement, spanElementId) {
        const fileInput = document.getElementById(inputElement);
        const fileNameDisplay = document.getElementById(spanElementId);
        if (fileInput.files && fileInput.files[0]) {
            fileNameDisplay.textContent = fileInput.files[0].name;
        } else {
            fileNameDisplay.textContent = "Tidak ada file yang dipilih";
        }
    }

    // Tambahkan event listener untuk setiap input file
    document.getElementById('sampul').addEventListener('change', () => updateFileName('sampul', 'sampul-file-name'));
    document.getElementById('gambar1').addEventListener('change', () => updateFileName('gambar1', 'gambar1-file-name'));
    document.getElementById('gambar2').addEventListener('change', () => updateFileName('gambar2', 'gambar2-file-name'));
    document.getElementById('gambar3').addEventListener('change', () => updateFileName('gambar3', 'gambar3-file-name'));
        </script>

    </body>

<!-- Modal Tambah projek -->
<div class="modal fade" id="modal-projek">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">Tambah Projek</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <!-- Modal body -->
        <form method="post" enctype="multipart/form-data">
            <div class="modal-body">
                <input type="text" name="nama_projek" placeholder="Nama Projek" class="form-control" required>
                <br>
                <input type="text" name="caption" placeholder="Caption tidak lebih dari 125 karakter (huruf/angka/spasi)" class="form-control" required>
                <br>
                <textarea name="news" placeholder="Deskripsi Projek" class="form-control" required></textarea>
                <br>
                <label>Sampul</label>
                <input type="file" name="sampul" class="form-control" required>
                <br>
                <label>Gambar 1</label>
                <input type="file" name="gambar1" class="form-control">
                <br>
                <input type="text" name="capt1" placeholder="Caption" class="form-control">
                <br>

                <label>Gambar 2</label>
                <input type="file" name="gambar2" class="form-control">
                <br>
                <input type="text" name="capt2" placeholder="Caption" class="form-control">
                <br>

                <label>Gambar 3</label>
                <input type="file" name="gambar3" class="form-control">
                <br>
                <input type="text" name="capt3" placeholder="Caption" class="form-control">
                <br>
                <button type="submit" class="btn btn-primary" name="tambahprojek">Tambah Projek</button>
            </div>
        </form>
    </div>
</div>
</div>


</html>
