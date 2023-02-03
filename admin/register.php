<?php
require '../component/database/koneksi.php';
require '../component/login/Header.php';

//Cek login
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama_admin = $_POST['nama_admin'];
    $alamat = $_POST['alamat'];
    $no_telp = $_POST['no_telp'];

    //Mencocokan data
    $query = mysqli_query($koneksi, "INSERT INTO admin values('','$username', '$password', '$nama_admin', '$alamat', '$no_telp')");
            header('location:login.php');
  
};

if (!isset($_SESSION['log'])) {
} else {
    header('location:../index.php');
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
                                            <input class="form-control" name="username" id="inputusername" type="text" placeholder="username" />
                                            <label for="inputusername">Username</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="nama" id="inputnama" type="nama" placeholder="Admin" />
                                            <label for="inputnama">Nama Admin</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="alamat" id="inputalamat" type="text" placeholder="alamat" />
                                            <label for="inputalamat">Alamat</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="no_telp" id="inputnotelp" type="text" placeholder="nomor telepon" />
                                            <label for="inputnotelp">Nomor Telephon</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="password" id="inputPassword" type="password" placeholder="Password" />
                                            <label for="inputPassword">Password</label>
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