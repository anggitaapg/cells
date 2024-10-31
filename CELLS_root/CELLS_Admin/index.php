<?php
require '../koneksi.php';

session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ./login.php");
    exit();
}
$nama_admin = "Admin";

$sql = "SELECT * FROM about_us ORDER BY Foto DESC";
 ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard</title>
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
            <a class="navbar-brand ps-3" href="index.php">Cells Admin</a>
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
            <ul class="navbar-nav ml-auto">
            <!-- Tombol Logout langsung di navbar -->
            <li class="nav-item">
                <a class="nav-link btn btn-danger text-white" href="logout.php">Logout</a>
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
                        <h1 class="mt-4">Team Cells</h1>

                        <div class="card mb-4">
                            <div class="card-header">
                              <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                              data-bs-target="#myModal">Tambah Team </button>
                            </div>
                            <div class="card-body">
                              <div class="table-responsive">
                                <div style="overflow-x: auto;">
                              <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Nama</th>
                                        <th>Jabatan</th>
                                        <th>Kategori</th>
                                        <th>Foto</th>
                                        <th>Periode</th>
                                        <th>LinkedIn</th>
                                        <th>Email</th>
                                        <th>CV</th>
                                        <th>Aksi</th> <!-- Tambahkan Kolom Aksi -->
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Nama</th>
                                        <th>Jabatan</th>
                                        <th>Kategori</th>
                                        <th>Foto</th>
                                        <th>Periode</th>
                                        <th>LinkedIn</th>
                                        <th>Email</th>
                                        <th>CV</th>
                                        <th>Aksi</th> <!-- Tambahkan Kolom Aksi -->
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    $ambildatateam = mysqli_query($koneksi, "SELECT * FROM about_us");

                                    if (mysqli_num_rows($ambildatateam) > 0) {
                                        $i = 1;
                                        while ($data = mysqli_fetch_array($ambildatateam)) {
                                            $id_team = $data['id_team'];
                                            $nama = $data['nama'];
                                            $jabatan = $data['jabatan'];
                                            $Foto = $data['Foto'];
                                            $kategori = $data['kategori'];
                                            $periode = $data['periode'];
                                            $linkedin = $data['linkedin'];
                                            $cv = $data['cv'];
                                            $email = $data['email'];
                                    ?>
                                    <tr>
                                        <td><?=$i++?></td>
                                        <td><?=$nama?></td>
                                        <td><?=$jabatan?></td>
                                        <td><?=$kategori?></td>
                                        <td><img src="./img/<?=$Foto?>" width="100" alt="Foto"></td>
                                        <td><?=$periode?></td>
                                        <td><a href="<?=$linkedin?>" target="_blank"><?=$linkedin?></a></td>
                                        <td><a href="mailto:<?=$email?>"><?=$email?></a></td>
                                        <td><a href="<?=$cv?>" target="_blank"><?=$cv?></a></td>
                                        <td>
                                          <!-- Tombol Edit -->
                                          <button type="button" class="btn btn-warning btn-square" data-bs-toggle="modal" data-bs-target="#editModal<?=$id_team?>">
                                            <i class="fas fa-edit"></i>
                                          </button>
                                          <!-- Tombol Hapus -->
                                          <button type="button" class="btn btn-danger btn-square" onclick="confirmDelete(<?=$id_team?>)">
                                            <i class="fas fa-trash"></i>
                                          </button>
                                        </td>
                                    </tr>
                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="editModal<?=$id_team?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Team</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form method="post" enctype="multipart/form-data">
                                                    <div class="modal-body">
                                                        <input type="hidden" name="id_team" value="<?=$id_team?>">
                                                        <input type="text" name="nama" value="<?=$nama?>" class="form-control" required>
                                                        <br>
                                                        <input type="text" name="jabatan" value="<?=$jabatan?>" class="form-control" required>
                                                        <br>
                                                        <input type="file" name="Foto" class="form-control">
                                                        <br>
                                                        <label for="kategori" class="form-label">Kategori</label>
                                                        <select class="form-select" id="kategori" name="kategori" required>
                                                            <option value="Executive" <?= $kategori == 'Executive' ? 'selected' : '' ?>>Executive</option>
                                                            <option value="Intern" <?= $kategori == 'Intern' ? 'selected' : '' ?>>Intern</option>
                                                            <option value="Advisor" <?= $kategori == 'Advisor' ? 'selected' : '' ?>>Advisor</option>
                                                            <option value="Trustees" <?= $kategori == 'Trustees' ? 'selected' : '' ?>>Trustees</option>
                                                        </select>
                                                        <br>
                                                        <input type="text" name="periode" value="<?=$periode?>" class="form-control" placeholder="Periode contoh: 2020-2021" required>
                                                        <br>
                                                        <input type="text" name="linkedin" value="<?=$linkedin?>" class="form-control" placeholder="Link Linkedin contoh: https://www.linkedin.com/in/********" required>
                                                        <br>
                                                        <input type="text" name="cv" value="<?=$cv?>" class="form-control" placeholder="Link CV dalam drive dengan ketentuan semua dapat mengakses" required>
                                                        <br>
                                                        <input type="text" name="email" value="<?=$email?>" class="form-control" placeholder="email, contoh loremipsum@gmail.com" required>
                                                        <br>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" name="editteam" class="btn btn-primary">Simpan Perubahan</button>
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
                  window.location.href = "index.php?id_team=" + id;
              }
          }
        </script>

    </body>

<!-- Modal Tambah Team -->
    <div class="modal fade" id="myModal">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Tambah Team</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <!-- Modal body -->
          <form method ="post" enctype="multipart/form-data" >
            <div class="modal-body">
              <input type="text" name="nama" placeholder="Nama Lengkap" class="form-control">
              <br>
              <input type="text" name="jabatan" placeholder="Jabatan" class="form-control">
              <br>
              <input type="file" name="Foto" class="form-control">
              <br>
              <label for="kategori" class="form-label">Kategori</label>
              <select class="form-select" id="kategori" name="kategori" required>
                <option value="Executive">Executive</option>
                <option value="Intern">Intern</option>
                <option value="Advisor">Advisor</option>
                <option value="Trustees">Trustees</option>
              </select>
              <br>
                <input type="text" name="periode" placeholder="Periode masa jabatan contoh: 2020-2022" class="form-control">
              <br>
              <input type="text" name="linkedin" placeholder="Link Linkedin, contoh: https://www.linkedin.com/in/********" class="form-control">
              <br>
              <input type="text" name="cv" placeholder="Link CV (drive)" class="form-control">
              <br>
              <input type="text" name="email" placeholder="email, contoh loremipsum@gmail.com" class="form-control">
              <br>
              <button type="submit" class="btn btn-primary" name="tambahteam">Tambah Team</button>
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
