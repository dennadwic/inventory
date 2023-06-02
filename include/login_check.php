<?php
  session_destroy();
  session_start();

  include "koneksi.php";

  // menangkap data yang dikirim dari form login
$id_user = $_POST['id_user'];
$password = md5($_POST['password']);


// menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($koneksi,"SELECT * FROM tb_user WHERE id_user='$id_user' and password='$password'");
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);

// cek apakah username dan password di temukan pada database
if($cek > 0){

	$data = mysqli_fetch_assoc($login);

	// cek jika user login sebagai admin
	if($data['level']=="Admin"){

		// buat session login dan username
		$_SESSION['id_user'] = $id_user;
		$_SESSION['level'] = "Admin";
		// alihkan ke halaman dashboard admin
		header("location:../index.php?");

	// cek jika user login sebagai karyawan
	}else if($data['id_level']=="User"){
		// buat session login dan username
		$_SESSION['id_user'] = $id_user;
		$_SESSION['level'] = "User";
		// alihkan ke halaman dashboard form
		header("location:../index.php");
	
	}else{
		echo "id_user Atau Password Salah";
		// alihkan ke halaman login kembali
		header("location:../index.php?pesan=gagal");
	}	
}else{
	echo "id_user Atau Password Salah";
	header("location:../index.php?pesan=gagal");
}

  
?>