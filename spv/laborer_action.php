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
	// Input 
	if ($task == 'insert'){
		$exist 	= executeScalar("select count(laborer_code) from laborer where laborer_code='".$_POST['code']."'");
		if($exist>0){
			echo "<script>window.alert('Kode Sudah Ada, Ganti Dengan yg Lain');
			window.location=('laborer.php')</script>";
		}
		else{
			$insert = mysql_query("INSERT INTO `laborer` (`laborer_code`, `laborer_name`) 
			VALUES ('".$_POST['code']."', '".$_POST['name']."')");
			
			if($insert){
				echo "<script>window.location=('laborer.php')</script>";
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
		$kodetetap 	= executeScalar("select laborer_code from laborer where laborer_code='".$_POST['code']."' and laborer_id='".$id."'");
		//jika kode tetap
		if($kodetetap){
			$update1 = mysql_query("update laborer set laborer_code= '".$_POST['code']."',
													laborer_name 	= '".$_POST['name']."'
												where laborer_id 	= '".$id."'");
			if($update1){
				echo "<script>window.location=('laborer.php')</script>";
			}
			else{
				echo "<script>window.alert('Data Gagal Diperbarui');
				window.history.back()</script>";
			}
		}
		else{
			//jika kode berubah
			$exist 	= executeScalar("select count(laborer_code) from laborer where laborer_code='".$_POST['code']."'");
			if($exist>0){
				echo "<script>window.alert('Kode Sudah Ada, Ganti Dengan yg Lain');
				window.location=('laborer.php')</script>";
			}
			else{
				$update2 = mysql_query("update laborer set laborer_code= '".$_POST['code']."',
														laborer_name 	= '".$_POST['name']."'
													where laborer_id 	= '".$id."'");
				if($update2){
					echo "<script>window.location=('laborer.php')</script>";
				}
				else{
					echo "<script>window.alert('Data Gagal Diperbarui');
					window.history.back()</script>";
				}
			}
		}
	}
	
	elseif ($task == 'delete'){
		$delete = mysql_query("delete laborer where laborer_id = '".$id."'");
		if($delete){
			//Writes the photo to the server 
			echo "<script>window.alert('Delete Success');
			window.location=('laborer.php')</script>";
		}
		else{
			echo "<script>window.alert('Delete Failled');
			window.history.back()</script>";
		}
	}
?>