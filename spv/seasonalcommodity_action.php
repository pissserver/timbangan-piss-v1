<?php
	session_start();
	include "../connection.php";
	//Validasi role
	$admin="";
	if($_SESSION['role']='admin'||$_SESSION['role']='super_admin'){
		if($_SESSION['username']!=''){
			$admin = $_SESSION['id_admin'];
		}else{
			header("Location:../login.html");
		}
	}else{
		header("Location:../login.html");
	}
	
	date_default_timezone_set('Asia/Jakarta');
	$dt_now	= date("Y-m-d H:i:s");

	$task	= $_GET['task'];
	if ($task == 'insert'){
		//cek apakah komodity sdah pernah diinputkan sebelumnya
		$exist 	= executeScalar("select count(goods_id) from seasonalcommodity where goods_id = '".$_POST['type']."'");
		if($exist>0){
			echo "<script>window.alert('Komoditi pernah ditambahkan, silahkan cari dan pilih aktifkan');
			window.location=('seasonalcommodity.php')</script>";
		}
		else{
			$insert = mysql_query("INSERT INTO `seasonalcommodity` (`id_sc`, 
																	`goods_id`, 
																	`status_aktif`, 
																	`dibuat_oleh`, 
																	`dibuat_pada`, 
																	`diubah_oleh`,
																	`diubah_pada`,
																	`dihapus_oleh`,
																	`dihapus_pada`) 
			VALUES ('', '".$_POST['type']."', '1', '".$admin."','".$dt_now."', '', '', '', '')");
			
			if($insert){
				echo "<script>window.location=('seasonalcommodity.php')</script>";
			}
			else{
				echo "<script>window.alert('Data Gagal diinput');
				window.history.back()</script>";
			}
		}
	}

	// NonAktifkan Komoditi musiman
	elseif ($task == 'nonaktifkan'){
		$id		= $_GET['id'];
		$exist 	= executeScalar("select count(id_sc) from seasonalcommodity where id_sc='".$id."'");
		if($exist < 1){
			echo "<script>window.alert('Komoditi tidak ditemukan, silahkan cek kembali');
			window.location=('seasonalcommodity.php')</script>";
		}
		else{
			$update = mysql_query("	update seasonalcommodity 
									set status_aktif	= '0',
										dihapus_oleh 	= '".$admin."',
										dihapus_pada 	= '".$dt_now."'
									where id_sc 		= '".$id."'");
			
			if($update){
				echo "<script>window.location=('seasonalcommodity.php')</script>";
			}
			else{
				echo "<script>window.alert('Data Gagal Dinonaktifkan');
				window.history.back()</script>";
			}
		}
	}
	
	elseif ($task == 'aktifkan'){
		$id		= $_GET['id'];
		$exist 	= executeScalar("select count(id_sc) from seasonalcommodity where id_sc='".$id."'");
		if($exist < 1){
			echo "<script>window.alert('Komoditi tidak ditemukan, silahkan cek kembali');
			window.location=('seasonalcommodity.php')</script>";
		}
		else{
			$update = mysql_query("	update seasonalcommodity 
									set status_aktif	= '1',
										diubah_oleh 	= '".$admin."',
										diubah_pada 	= '".$dt_now."'
									where id_sc 		= '".$id."'");
			
			if($update){
				echo "<script>window.location=('seasonalcommodity.php')</script>";
			}
			else{
				echo "<script>window.alert('Data Gagal Dinonaktifkan');
				window.history.back()</script>";
			}
		}
	}
?>