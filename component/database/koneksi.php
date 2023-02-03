<?php
session_start();

//Membuat Koneksi ke Database
$koneksi = mysqli_connect("localhost", "root", "", "wh_acam");

//Cek Koneksi Database
if (mysqli_connect_error()) {
	echo "koneksi database gagal :" . mysqli_connect_error();
}

//Menambah Data pasien
if (isset($_POST['tambahpasien'])) {
	$nama_pasien = $_POST['nama_pasien'];
	$NIK = $_POST['NIK'];
	$tempat_lahir = $_POST['tempat_lahir'];
	$alamat = $_POST['alamat'];
	$tgl_lahir = $_POST['tgl_lahir'];
	$no_tlp = $_POST['no_tlp'];

	$addtotable = mysqli_query($koneksi, "INSERT INTO pasien VALUES('', '$nama_pasien','$NIK', '$tempat_lahir', '$alamat', '$tgl_lahir', '$no_tlp')");
	if ($addtotable) {
		header("location:data_pasien.php");
	} else {
		header("location:data_pasien.php");
	}
}

//Menambah Data 
if (isset($_POST['tambahjadwaldokter'])) {
	$nama_dokter = $_POST['nama_dokter'];
	$tanggal_jadwal = $_POST['tanggal_jadwal'];
	$jam_jadwal = $_POST['jam_jadwal'];

	$addtotable = mysqli_query($koneksi, "INSERT INTO data_jadwal_dokter VALUES('', '$nama_dokter', '$tanggal_jadwal', '$jam_jadwal')") or die ("Error in query: $addtotable. ".mysqli_error($koneksi));
	if ($addtotable) {
		header("location:data_jadwal.php");
	} else {

		header("location:data_jadwal.php");
	}
}

//Menambah Data 
if (isset($_POST['daftarsesi'])) {
	$id_jadwal = $_POST['id_jadwal'];
	$id_pasien = $_POST['id_pasien'];
	$id_admin = $_POST['id_admin'];

	$addtotable = mysqli_query($koneksi, "INSERT INTO pendaftaran VALUES('', '$id_admin', '$id_pasien', '$id_jadwal', CURDATE())") or die ("Error in query: $addtotable. ".mysqli_error($koneksi));

	$sql = mysqli_query($koneksi, "SELECT * from pendaftaran ORDER BY id_pendaftaran DESC LIMIT 1");
	$data = mysqli_fetch_assoc($sql);
	$id_pendaftaran = $data['id_pendaftaran'];
	
	$query = mysqli_query($koneksi, "SELECT * FROM pendaftaran WHERE id_jadwal_dokter='$id_jadwal'");
    $datantrian = mysqli_num_rows($query);
    
	$insertantrian = mysqli_query($koneksi, "INSERT INTO antrian values('', '$id_pendaftaran', '$datantrian', 1)")or die ("Error in query: $insertantrian. ".mysqli_error($koneksi));
	if ($insertantrian) {
		header("location:home.php");
	} else {
		header("location:home.php");
	}
}

// Sudah proses
if (isset($_POST['ubahproses'])) {
	$id_antrian = $_POST['id_antrian'];
    
	$updateantrian = mysqli_query($koneksi, "UPDATE antrian SET status = 2 WHERE id_antrian='$id_antrian'")or die ("Error in query: $updateantrian. ".mysqli_error($koneksi));
	if ($updateantrian) {
		header("location:data_laporan_pendaftaran.php");
	} else {
		header("location:data_laporan_pendaftaran.php");
	}
}

//Jadwal
if(isset($_POST['daftarjadwal'])){
	$id_pasien = $_SESSION['id_pasien'];
	$id_jadwal = $_POST['id_jadwal'];
	$insert = mysqli_query($koneksi, "INSERT INTO pendaftaran VALUES('', '1', '$id_pasien', '$id_jadwal', CURDATE())");
	
	$sql = mysqli_query($koneksi, "SELECT * from pendaftaran where id_jadwal_dokter='$id_jadwal'");
	while($data = mysqli_fetch_array($sql)){
		$id_pendaftaran = $data['id_pendaftaran'];
	}
	$no_antri = $id_pendaftaran;
	$insertantrian = mysqli_query($koneksi, "INSERT INTO antrian values('', '$id_pendaftaran', '$no_antri')");
	if ($insertantrian) {
		header("location:home.php");
	} else {
		header("location:home.php");
	}
}

// UPDATE DATA

//Update Guru
if (isset($_POST['updatepasien'])) {
	$idp = $_POST['idp'];
	$nama_pasien = $_POST['nama_pasien'];
	$NIK = $_POST['NIK'];
	$tempat_lahir = $_POST['tempat_lahir'];
	$alamat = $_POST['alamat'];
	$tgl_lahir = $_POST['tgl_lahir'];
	$no_tlp = $_POST['no_tlp'];

	$update = mysqli_query($koneksi, "UPDATE pasien set nama_pasien='$nama_pasien', NIK='$NIK', tempat_lahir='$tempat_lahir', alamat='$alamat', tgl_lahir='$tgl_lahir', no_tlp='$no_tlp' where id_pasien='$idp'");
	if ($update) {
		header("location:data_pasien.php");
	} else {
		header("location:data_pasien.php");
	}
}

if(isset($_POST['updatejadwal'])) {
	$ijd = $_POST['ijd'];
	$nama_dokter = $_POST['nama_dokter'];
	$tanggal_jadwal = $_POST['tanggal_jadwal'];
	$jam_jadwal = $_POST['jam_jadwal'];

	$update = mysqli_query($koneksi, "UPDATE data_jadwal_dokter SET nama_dokter='$nama_dokter', tanggal_jadwal='$tanggal_jadwal', jam_jadwal='$jam_jadwal' WHERE id_jadwal_dokter='$ijd'");

	if ($update) {
		header("location:data_jadwal.php");
	}else{
		header("location:data_jadwal.php");
	}
}

if (isset($_POST['updatepassword'])) {
	$id_admin = $_POST['id_admin'];
	$password = $_POST['password'];

	$update = mysqli_query($koneksi, "UPDATE admin SET password='$password' WHERE id_admin='$id_admin'");
	if ($update) {
		header("location:ganti_password	.php");
	}else{
		header("location:ganti_password	.php");
	}
}



// HAPUS DATA



//Hapus
if (isset($_POST['hapuspasien'])) {
	$idp = $_POST['idp'];

	$hapus = mysqli_query($koneksi, "delete from pasien where id_pasien='$idp'");

	if ($hapus) {
		header("location:data_pasien.php");
	} else {
		header("location:data_pasien.php");
	}
}

if (isset($_POST['hapuslaporan'])) {
	$ida = $_POST['ida'];

	$hapus = mysqli_query($koneksi, "DELETE FROM antrian where id_antrian='$ida'") or die ("Error in query: $hapus. ".mysqli_error($koneksi));;

	if ($hapus) {
		header("location:data_laporan_pendaftaran.php");
	} else {
		header("location:data_laporan_pendaftaran.php");
	}
}



?>