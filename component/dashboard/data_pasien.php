<?php
require '../database/koneksi.php';


if (isset($_SESSION['log'])) {
} else {
    header('location:index.php');
};
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>WH AESTHETIC CLINIC & APOTEK MEDIKA</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="../../css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Custom styles for this template-->
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">

</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php"><img src="../../images/logo.png" width="40" height="40">  Wh ACAM</a>
        <!-- Sidebar Toggle-->
        <!-- <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button> -->
        <!-- Navbar Search-->
        <div class="input-group">
        </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="../../logout/logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Menu</div>
                            <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Home
                        </a>
                        <a class="nav-link active" href="data_pasien.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Data Pasien
                        </a>
                        <a class="nav-link" href="data_jadwal.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Data Jadwal Dokter
                        </a>
                        <a class="nav-link" href="data_laporan_pendaftaran.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Laporan Pendafataran
                        </a>
                        <a class="nav-link" href="ganti_password.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Ganti Password
                        </a>                 
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged sebagai:</div>
                    <?php 
                    if ($_SESSION['admin'] == True) {
                        echo $_SESSION['name'];
                    }
                    else{
                        
                    }
                    ?>
                </div>
            </nav>
        </div>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">WH AESTHETIC CLINIC & APOTEK MEDIKA</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Data Pasien</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <!-- Button to Open the Modal -->
                            <?php 
                            if ($_SESSION['admin'] == True) {
                                echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                                Tambah Pasien</button>';
                            }
                            else{
                                
                            }
                            ?>
                            
                        </div>

                        <!-- TABEL GURU -->
                        <div class="card-body">
                            <?php 
                            if ($_SESSION['admin'] == True) {
                                ?>
                                <table class="table table-striped" id="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pasien</th>
                                        <th>NIK</th>
                                        <th>Tempat Lahir</th>
                                        <th>Alamat</th>
                                        <th>Tanggal Lahir</th>
                                        <th>No Telepon</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ambildatapasien = mysqli_query($koneksi, "SELECT * FROM pasien");
                                    $i = 1;
                                    while ($data = mysqli_fetch_array($ambildatapasien)) {
                                        $idp = $data['id_pasien'];
                                        $nama_pasien = $data['nama_pasien'];
                                        $nik = $data['NIK'];
                                        $tempat_lahir = $data['tempat_lahir'];
                                        $alamat = $data['alamat'];
                                        $tgl_lahir = $data['tgl_lahir'];
                                        $no_tlp = $data['no_tlp']; 
                                    ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $nama_pasien; ?></td>
                                            <td><?= $nik; ?></td>
                                            <td><?= $tempat_lahir; ?></td>
                                            <td><?= $alamat; ?></td>
                                            <td><?= $tgl_lahir; ?></td>
                                            <td><?= $no_tlp; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $idp; ?>">Edit</button>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?= $idp; ?>">Delete</button>
                                            </td>
                                        </tr>
                                        <!-- Edit Modal -->
                                        <div class="modal" id="edit<?= $idp; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Edit Pasien</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <form method="post">
                                                        <div class="modal-body">
                                                        <input type="text" name="nama_pasien" value="<?= $nama_pasien; ?>" class="form-control" required>
                                                        <br>
                                                        <input type="text" name="NIK" value="<?= $nik; ?>" class="form-control" required>
                                                        <br>
                                                        <input type="text" name="tempat_lahir" value="<?= $tempat_lahir; ?>" class="form-control" required>
                                                        <br>
                                                        <input type="text" name="alamat" value="<?= $alamat; ?>" class="form-control" required>
                                                        <br>
                                                        <input type="date" name="tgl_lahir" value="<?= $tgl_lahir; ?>" class="form-control" required>
                                                        <br>
                                                        <input type="text" name="no_tlp" value="<?= $no_tlp; ?>" class="form-control" required>
                                                        <br>  
                                                            <input type="hidden" name="idp" value="<?= $idp; ?>">
                                                            <button type="submit" class="btn btn-primary" name="updatepasien">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Hapus Modal -->
                                        <div class="modal" id="delete<?= $idp; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Hapus Data Pasien</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <form method="post">
                                                        <div class="modal-body">
                                                            Apakah Yakin Hapus Pasien <?= $nama_pasien; ?> ?
                                                            <br>
                                                            <input type="hidden" name="idp" value="<?= $idp; ?>">
                                                            <br>
                                                            <button type="submit" class="btn btn-danger" name="hapuspasien">Ya, Hapus</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }}
                                    ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; WH AESTHETIC CLINIC & APOTEK MEDIKA</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Pasien Baru</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <form method="post">
                    <div class="modal-body">
                        <input type="text" name="nama_pasien" placeholder="Nama pasien" class="form-control" required>
                        <br>
                        <input type="text" name="NIK" placeholder="NIK" class="form-control" required>
                        <br>
                        <input type="text" name="tempat_lahir" placeholder="Tempat Lahir" class="form-control" required>
                        <br>
                        <input type="text" name="alamat" placeholder="alamat" class="form-control" required>
                        <br>
                        <input type="date" name="tgl_lahir" placeholder="Tanggal Lahir" class="form-control" required>
                        <br>
                        <input type="text" name="no_tlp" placeholder="Nomor Telephon" class="form-control" required>
                        <br>         
                        <button type="submit" class="btn btn-primary" name="tambahpasien">Tambah</button>
                    </div>
                </form>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#table').DataTable();
        } );
    </script>
</body>



</html>