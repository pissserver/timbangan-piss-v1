<?php
	session_start();
	include "../connection.php";
	//Validasi role
	if($_SESSION['role']='admin'||$_SESSION['role']='super_admin'){
		if($_SESSION['username']!=''){
			$admin = $_SESSION['username'];
		}else{
			header("Location:../login.html");
		}
	}else{
		header("Location:../login.html");
	}
	
	$task	= $_GET['task'];
	//Pembayaran
	if ($task=='receive'){
		$id	= $_GET['id'];
		//update status pembayaran
		$pay = mysql_query("update ko set ko_status = 'Diterima' where ko_id = '".$id."'");
		if($pay){
			echo "<script>window.location=('pay.php')</script>";
			exit();
		}
		else{
			echo "<script>window.alert('Pembayaran Gagal');
			window.history.back()</script>";
			exit();
		}
	}
	//ACC Pembayaran Tonase
	elseif ($task=='acc'){
		$km		= $_GET['id'];
		//update status pembayaran
		$update = mysql_query("update km set km_status = 'Acc', km_date_acc = '".$date_now."' where km_id = '".$km."'");
		if($update){
			echo "<script>window.location=('pay.php')</script>";
			exit();
		}
		else{
			echo "<script>window.alert('ACC Gagal');
			window.history.back()</script>";
			exit();
		}
	}
	//ACC Pembayaran Mitra
	elseif ($task=='acc_mitra'){
		$km		= $_GET['id'];
		//update status pembayaran
		$update = mysql_query("update km_mitra set km_status = 'Acc', km_date_acc = '".$date_now."' where km_id = '".$km."'");
		if($update){
			echo "<script>window.location=('pay_km_mitra.php')</script>";
			exit();
		}
		else{
			echo "<script>window.alert('ACC Gagal');
			window.history.back()</script>";
			exit();
		}
	}
	//Cancel Pembayaran
	elseif ($task=='cancel'){
		$id	= $_GET['id'];
		//update status pembayaran
		$pay = mysql_query("update ko set ko_status = 'Diajukan' where ko_id = '".$id."'");
		if($pay){
			echo "<script>window.location=('pay.php')</script>";
			exit();
		}
		else{
			echo "<script>window.alert('Pembayaran Gagal');
			window.history.back()</script>";
				exit();
		}
	}
	elseif ($task=='cancelAll'){
		//update status pembayaran
		$cancel = mysql_query("update ko set ko_status = 'Diajukan' where ko_status = 'Diterima'");
		if($cancel){
			echo "<script>window.location=('pay.php')</script>";
			exit();
		}
		else{
			echo "<script>window.alert('Pembayaran Gagal');
			window.history.back()</script>";
			exit();
		}
	}
?>