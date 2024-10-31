<?php
require '../koneksi.php';
$sql = "SELECT * FROM konten ORDER BY judul DESC";
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
        .btn-square {
          width: 40px;
          height: 40px;
          display: flex;
          align-items: center;
          justify-content: center;
          padding: 0;
          border-radius: 20%; /* Menghapus bentuk bulat */
          margin-top: 5px;
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
                            <a class="nav-link" href="konten.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Open Lesson
                            </a>
                          </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Open Lesson</h1>

                        <div class="card mb-4">
                            <div class="card-header">
                              <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                              data-bs-target="#modalkonten">Tambah Konten</button>
                            </div>
                            <div class="card-body">
                              <div class="table-responsive">
                                <div style="overflow-x: auto;">
                              <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Judul</th>
                                        <th>Deskripsi</th>
                                        <th>Video</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                      <th>Nomor</th>
                                      <th>Judul</th>
                                      <th>Deskripsi</th>
                                      <th>Video</th>
                                      <th>Aksi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    $ambilkonten = mysqli_query($koneksi, "SELECT * FROM konten");

                                    if (mysqli_num_rows($ambilkonten) > 0) {
                                        $i = 1;
                                        while ($data = mysqli_fetch_array($ambilkonten)) {
                                            $id_konten = $data['id_konten'];
                                            $judul = $data['judul'];
                                            $deskripsi = $data['deskripsi'];
                                            $video = $data['video_url'];
                                    ?>
                                    <tr>
                                        <td><?=$i++?></td>
                                        <td><?=$judul?></td>
                                        <td><?=$deskripsi?></td>
                                        <td><img src="<?=$video?>" width="100" alt="Video"></td>
                                        <td>
                                          <!-- Tombol Edit -->
                                          <button type="button" class="btn btn-warning btn-square" data-bs-toggle="modal" data-bs-target="#editkonten<?=$id_konten?>">
                                            <i class="fas fa-edit"></i>
                                          </button>
                                          <!-- Tombol Hapus -->
                                          <button type="button" class="btn btn-danger btn-square" onclick="confirmDelete(<?=$id_konten?>)">
                                            <i class="fas fa-trash"></i>
                                          </button>
                                        </td>
                                    </tr>
                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="editkonten<?=$id_konten?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Konten</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form method="post" enctype="multipart/form-data">
                                                    <div class="modal-body">
                                                        <input type="hidden" name="id_konten" value="<?=$id_konten?>">
                                                        <input type="text" name="judul" value="<?=$judul?>" class="form-control">
                                                        <br>
                                                        <input type="text" name="deskripsi" value="<?=$deskripsi?>" class="form-control">
                                                        <br>
                                                        <input type="file" name="video" class="form-control">
                                                        <br>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" name="editkonten" class="btn btn-primary">Simpan Perubahan</button>
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
                  window.location.href = "konten.php?delete=" + id;
              }
          }
        </script>

    </body>

<!-- Modal Tambah Team -->
    <div class="modal fade" id="modalkonten">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Tambah Konten</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <!-- Modal body -->
          <form method ="post" enctype="multipart/form-data" >
            <div class="modal-body">
              <input type="text" name="judul" placeholder="Judul" class="form-control">
              <br>
              <input type="text" name="desc" placeholder="Deskripsi" class="form-control">
              <br>
              <input type="file" name="video" class="form-control" required>
              <br>
              <button type="submit" class="btn btn-primary" name="tambahkonten">Tambah Konten</button>
            </div>
          </form>
          <!-- Modal footer -->
          <!-- <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          </div> -->
        </div>
      </div>
    </div>


</html>