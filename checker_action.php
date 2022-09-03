<?php
	session_start();
	include "connection.php";
	$task	= $_GET['task'];
	
	if($_SESSION['role']!='admin'||$_SESSION['role']!='super_admin'){
		echo "<script>window.alert('Anda Tidak Memiliki Hak Akses Untuk Mengubah Data');
		window.location=('goods.php')</script>";
	}else{
		// Input 
		if ($task == 'insert'){
			$exist 	= executeScalar("select count(checker_code) from checker where checker_code='".$_POST['code']."'");
			if($exist>0){
				echo "<script>window.alert('Kode Sudah Ada, Ganti Dengan yg Lain');
				window.location=('checker.php')</script>";
			}
			else{
				$insert = mysql_query("INSERT INTO `checker` (`checker_id`, `checker_code`, `checker_name`, `checker_pass`) 
				VALUES ('', '".$_POST['code']."', '".$_POST['name']."', '".$_POST['pass']."')");
				
				if($insert){
					echo "<script>window.location=('checker.php')</script>";
				}
				else{
					echo "<script>window.alert('Data Gagal');
					window.history.back()</script>";
				}
			}
		}
		// Update
		elseif ($task == 'update'){
			$id			= $_GET['id'];
			$kodetetap 	= executeScalar("select checker_code from checker where checker_code='".$_POST['code']."' and checker_id='".$id."'");
			//jika kode tetap
			if($kodetetap){
				$update = mysql_query("update checker set checker_code	= '".$_POST['code']."',
														checker_name 	= '".$_POST['name']."',
														checker_pass 	= '".$_POST['pass']."'
													where checker_id 	= '".$id."'");
				if($update){
					echo "<script>window.location=('checker.php')</script>";
				}
				else{
					echo "<script>window.alert('Data Gagal Diperbarui');
					window.history.back()</script>";
				}
			}
			else{
				$exist 	= executeScalar("select count(checker_code) from checker where checker_code='".$_POST['code']."'");
				if($exist>0){
					echo "<script>window.alert('Kode Sudah Ada, Ganti Dengan yg Lain');
					window.location=('checker.php')</script>";
				}
				else{
					$update = mysql_query("update checker set checker_code	= '".$_POST['code']."',
															checker_name 	= '".$_POST['name']."'
														where checker_id 	= '".$id."'");
					if($update){
						echo "<script>window.location=('checker.php')</script>";
					}
					else{
						echo "<script>window.alert('Data Gagal Diperbarui');
						window.history.back()</script>";
					}
				}
			}
		}
		elseif ($task == 'delete'){
			$delete = mysql_query("delete checker where checker_id = '".$id."'");
			if($delete){
				//Writes the photo to the server 
				echo "<script>window.alert('Delete Success');
				window.location=('checker.php')</script>";
			}
			else{
				echo "<script>window.alert('Delete Failled');
				window.location=('checker.php')</script>";
			}
		}
	}
?>