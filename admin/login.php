<?php
require '../component/database/koneksi.php';
require '../component/login/Header.php';

$_SESSION['admin'] = "";

//Cek login
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    //Mencocokan data
    $cekdatabase = mysqli_query($koneksi, "SELECT * FROM admin where username='$username' and password='$password'");
    //Hitung jumlah data
    $hitung = mysqli_num_rows($cekdatabase);
    $data = mysqli_fetch_array($cekdatabase);
    if ($hitung > 0) {
        $_SESSION['log'] = True;
        $_SESSION['name'] = "$username";
        $_SESSION['admin'] = True;
        $_SESSION['id_admin'] = $data['id_admin'];
        $_SESSION['page'] = "";
        header('location:../component/dashboard/index.php');
    } else {
        header('location:login.php');
    };
};

if (isset($_POST['register'])) {
    header('location:register.php');
};

if (!isset($_SESSION['log'])) {
} else {
    header('location:../component/dashboard/index.php');
};

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
                                    <h6 class="text-center font-weight-light my-4">LOGIN ADMIN</h6>
                                </div>
                                <div class="card-body">
                                    <form method="post">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="username" id="inputusername" type="text" placeholder="admin" />
                                            <label for="inputusername">Username</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="password" id="inputPassword" type="password" placeholder="Password" />
                                            <label for="inputPassword">Password</label>
                                        </div>
                                        <div class="center-block align-items-center mt-4 mb-0">
                                            <button class="btn btn-primary" name="login">Login</button>
                                            <!-- <button class="btn btn-primary" name="register">Registrasi</button>    -->
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