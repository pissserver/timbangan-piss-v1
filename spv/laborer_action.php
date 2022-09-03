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
	if ($task == 'insert'&&$_SESSION['checker']!=''){
		$exist 	= executeScalar("select count(laborers_code) from laborers where laborers_code='".$_POST['code']."'");
		if($exist>0){
			echo "<script>window.alert('Kode Sudah Ada, Ganti Dengan yg Lain');
			window.location=('laborer.php')</script>";
		}
		else{
			$insert = mysql_query("INSERT INTO `laborers` (`laborers_id`, `laborers_code`, `laborers_name`) 
			VALUES ('', '".$_POST['code']."', '".$_POST['name']."')");
			
			if($insert){
				echo "window.location=('laborer.php')</script>";
			}
			else{
				echo "<script>window.alert('Data Gagal');
				window.history.back()</script>";
			}
		}
	}

	// Update
	elseif ($task == 'update'&&$_SESSION['checker']!=''){
		$id		= $_GET['id'];
		$kodetetap = executeScalar("select laborers_code from laborers where laborers_code='".$_POST['code']."' and laborers_id='".$id."'");
		//jika kode tetap
		if($kodetetap){
			$update1 = mysql_query("update laborers set laborers_code= '".$_POST['code']."',
													laborers_name 	= '".$_POST['name']."'
												where laborers_id 	= '".$id."'");
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
			$exist 	= executeScalar("select count(laborers_code) from laborers where laborers_code='".$_POST['code']."'");
			if($exist>0){
				echo "<script>window.alert('Kode Sudah Ada, Ganti Dengan yg Lain');
				window.location=('laborer.php')</script>";
			}
			else{
				$update2 = mysql_query("update laborers set laborers_code= '".$_POST['code']."',
														laborers_name 	= '".$_POST['name']."'
													where laborers_id 	= '".$id."'");
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
		$delete = mysql_query("delete laborers where laborers_id = '".$id."'");
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