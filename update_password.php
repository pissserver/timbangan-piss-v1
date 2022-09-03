<?php
	session_start();
	include "connection.php";
	if($_SESSION['checker']==''){
		header("Location:login.html");
	}
	
	$id		= $_GET['id'];
	$pass	= $_POST['pass'];
	$pass1	= $_POST['pass1'];
	$pass2	= $_POST['pass2'];
	
	$check	= mysql_query("select checker_pass from checker where checker_id = ".$id."");
	$sama 	= mysql_fetch_row($check);
	
	if($pass==$sama[0]){
		if($pass1==$pass2){
		// Update pass
			$update = mysql_query("update checker set checker_pass = '".$pass2."' where checker_id = '".$id."'");
			if($update) {
				echo "<script>window.alert('Ganti Password Berhasil');
				window.location=('logout.php')</script>";
				exit();
			}
			else {
				echo "<script>window.alert('Ganti Password Gagal');
				window.history.back()</script>";
				exit();
			}
		}
		else{
			echo "<script>window.alert('Password Baru Anda Tidak Sama');
			window.history.back()</script>";
			exit();
		}
	}
	else{
		echo "<script>window.alert('Password Lama Anda Salah');
		window.history.back()</script>";
		exit();
	}
	
?>
