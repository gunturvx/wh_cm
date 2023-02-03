<?php
require '../component/database/koneksi.php';
require '../component/login/Header.php';

$_SESSION['pasien'] = "";

//Cek login
if (isset($_POST['login'])) {
    $nik = $_POST['nik'];
    $tgl_lahir = $_POST['tgl_lahir'];

    //Mencocokan data
    $cekdatabase = mysqli_query($koneksi, "SELECT * FROM pasien where NIK='$nik' and tgl_lahir='$tgl_lahir'") or die ("Error in query: $cekdatabase. ".mysqli_error($koneksi));
    //Hitung jumlah data
    $data = mysqli_fetch_array($cekdatabase);
    $hitung = mysqli_num_rows($cekdatabase);
    echo $hitung;
    if ($hitung > 0) {
        $_SESSION['log'] = 'True';
        $_SESSION['pasien'] = True;
        $_SESSION['id_pasien'] = $data['id_pasien'];
        header('location:home.php');
    } else {
        header('location:login.php');
    };
};

if (isset($_POST['register'])) {
    header('location:register.php');
};

if (isset($_SESSION['log'])) {
} else {
    header('location:home.php');
}

$id_pasien = $_SESSION['id_pasien'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>WH AESTHETIC CLINIC & APOTEK MEDIKA - Cetak Kartu</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <style> 
        body{
            background-image: url(../images/bg01.jpg);
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            height: 100%;
        }
        .modal-content {
            padding: 16px;
        }

        @media print {
            #layoutAuthentication, #cetakkartu {
                display: none;
            }
            #print-area {
                display: block;
            }
        }
    </style>
</head>
<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                <center>
        <table border="0" style="margin-top: 20px;">
            <tr>
                <td width="80%">
                    <font class="edoc-logo" style="color: black;">Wh ACAM</font>
                    <font class="edoc-logo-sub" style="color: black;">| WEBSITE PENDAFTARAN PASIEN ONLINE</font>
                </td>
                <td width="10%" style="color: black;"><a class="dropdown-item"  href="cetak_kartu.php">Cetak Kartu</a></li>
                </td>
                <td width="10%" style="color: black;"><a class="dropdown-item"  href="../logout/logout.php">Logout</a></li>
                </td>
            </tr>
    </table>
    </center>
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Cetak Kartu Pasien</h3>
                                </div>
                                <div class="card-body">
                                    <form method="post">
                                        <?php 
                                        $ambildatapasien = mysqli_query($koneksi, "SELECT * FROM pasien where id_pasien='$id_pasien'");
                                        $i = 1;
                                        $data = mysqli_fetch_array($ambildatapasien);
                                        $nama_pasien = $data['nama_pasien'];
                                        $idp = $data['id_pasien'];
                                        ?>
                                        <!-- <div class="form-floating mb-3">
                                            <input class="form-control" name="nik" id="nik" type="text" placeholder="*******" />
                                            <label for="nik">Nomor Induk Kependudukan</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="tgl_lahir" id="inputttl" type="date" placeholder="Tanggal Lahir" />
                                            <label for="inputtl">Tanggal Lahir</label>
                                        </div>
                                        <br> -->
                                        <div class="d-flex align-items-center justify-content-center mt-4 mb-0">
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#cetak<?= $idp; ?>">Cetak Kartu</button>
                                        </div>
                                        <?php  ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; WH AESTHETIC CLINIC & APOTEK MEDIKA</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!-- cetak Modal -->
    <div class="modal" id="cetak<?= $idp; ?>">
        <div class="modal-dialog">
            <div class="modal-content" id="print-area">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">WH AESTHETIC CLINIC & APOTEK MEDIKA</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <!-- Modal body -->
                    <form method="post">
                        <h3>Kartu Pasien</h3>
                        <p>Nama Pasien : <?= $nama_pasien ?></p>
                        <p>Nomor ID Pasien : <?= $idp ?></p>
                        
                        <input type="text" name="nama_pasien" value="<?= $nama_pasien ?>" hidden>
                        <br>
                        <input type="hidden" name="idp" value="<?= $idp; ?>">
                        <br>
                        <button type="submit" class="btn btn-warning" name="cetakkartu" id="cetakkartu">Cetak kartu</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal-body">
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script>
        let btnCetak = document.getElementById('cetakkartu');
        btnCetak.addEventListener('click', function () {
            window.print();
        });
    </script>
</body>

</html>