<?php
require '../component/database/koneksi.php';
require '../component/login/Header.php';

//Cek login
if (isset($_POST['register'])) {
    $nama_pasien = $_POST['nama_pasien'];
    $nik = $_POST['nik'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $alamat = $_POST['alamat'];
    $tanggal_lahir = $_POST['tgl_lahir'];
    $no_telp = $_POST['no_telp'];

    //Mencocokan data
    $query = mysqli_query($koneksi, "INSERT INTO pasien values('','$nama_pasien', '$nik', '$tempat_lahir', '$alamat', '$tanggal_lahir' , '$no_telp')");
     header('location:login.php');
  
};

if (!isset($_SESSION['log'])) {
} else {
    header('location:home.php');
}

?>
<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h5 class="text-center font-weight-light my-4">Pendafataran Pasien</h5>
                                    <h5 class="text-center font-weight-light my-4">Online</h5>
                                    <h5 class="text-center font-weight-light my-4">WH AESTHETIC CLINIC & APOTEK MEDIKA</h5>
                                    <h6 class="text-center font-weight-light my-4">REGISTRASI ADMIN</h6>
                                </div>
                                <div class="card-body">
                                    <form method="post">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="nama_pasien" id="inputnamapasien" type="text" placeholder="nama_pasien" />
                                            <label for="inputnama_pasien">Nama Pasien</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="nik" id="inputnik" type="nik" placeholder="Masukan NIK" />
                                            <label for="inputnik">Masukan NIK</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="tempat_lahir" id="tempatlahir" type="text" placeholder="Tempat Lahir" />
                                            <label for="tempatlahir">Tempat Lahir</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="tgl_lahir" id="inputtgl_lahir" type="date" placeholder="tanggal lahir" />
                                            <label for="inputtgl_lahir">Tanggal Lahir</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="alamat" id="inputalamat" type="text" placeholder="alamat" />
                                            <label for="inputalamat">Alamat</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="no_telp" id="inputnotelp" type="text" placeholder="nomor telepon" />
                                            <label for="inputnotelp">Nomor Telephon</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <button class="btn btn-primary" name="register">Registrasi
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>

<?php 
require '../component/login/footer.php';
?>