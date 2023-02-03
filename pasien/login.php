<?php
require '../component/database/koneksi.php';
require '../component/login/Header.php';

$_SESSION['pasien'] = "";

//Cek login
if (isset($_POST['login'])) {
    $nik = $_POST['nik'];
    $tgl_lahir = $_POST['tgl_lahir'];

    // var_dump(strlen($nik));
    // die();

    if(strlen($nik) != 16) {
        echo '<script>alert("Inputan nik harus memiliki 16 digit nomor"); window.location ="./login.php"</script>';
        die();
    }

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
        echo '<script>alert("NIK atau tanggal lahir salah"); window.location ="./login.php"</script>';
        die();
    };
};

if (isset($_POST['register'])) {
    header('location:register.php');
};

if (!isset($_SESSION['log'])) {
} else {
    header('location:home.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>WH AESTHETIC CLINIC & APOTEK MEDIKA - Login</title>
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
    </style>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Pendafataran Pasien</h3>
                                    <h3 class="text-center font-weight-light my-4">Online</h3>
                                    <h3 class="text-center font-weight-light my-4">WH AESTHETIC CLINIC & APOTEK MEDIKA</h3>
                                </div>
                                <div class="card-body">
                                    <form method="post">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="nik" id="nik" type="number" placeholder="*******" />
                                            <label for="nik">Nomor Induk Kependudukan</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="tgl_lahir" id="inputttl" type="date" placeholder="Tanggal Lahir" />
                                            <label for="inputtl">Tanggal Lahir</label>
                                        </div>
                                        <br>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <button class="btn btn-warning" name="register">Pasien Baru</button>
                                            <button class="btn btn-primary" name="login">Lanjut</button>
                                        </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>

</html>