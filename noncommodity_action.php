<?php
	session_start();
	include "connection.php";
	//include "fungsi_thumb.php";
	
	$task	= $_GET['task'];
	//$id	= $_POST['id'];
	if($_SESSION['role']!='admin'||$_SESSION['role']!='super_admin'){
		echo "<script>window.alert('Anda Tidak Memiliki Hak Akses Untuk Mengubah Data');
		window.location=('transportation.php')</script>";
	}
	
	// Input 
	if ($task == 'insert'){
		$insert = mysql_query("INSERT INTO `noncommodity` (`noncommodity_id`, `noncommodity_name`, 
		`noncommodity_weight`) VALUES ('', '".$_POST['name']."', '".$_POST['weight']."')");
		
		if($insert){
			echo "<script>window.location=('noncommodity.php')</script>";
		}
		else{
			echo "<script>window.alert('Data Gagal');
			window.history.back()";
		}
	}

	// Update
	elseif ($task == 'update'){
		$id		= $_GET['id'];
		$update = mysql_query("update noncommodity set noncommodity_name 	= '".$_POST['name']."',
													noncommodity_weight		= '".$_POST['weight']."'
													where noncommodity_id 	= '".$id."'");
		if($update){
			echo "<script>window.location=('noncommodity.php')</script>";
		}
		else{
			echo "<script>window.alert('Data Gagal Diperbarui');
			window.history.back()</script>";
		}
	}
	
	elseif ($task == 'delete'){
		//$delete = mysql_query("delete noncommodity where noncommodity_id = '".$id."'");
		if($delete){
			//Writes the photo to the server 
			echo "<script>window.alert('Delete Success');
			window.location=('commodity.php')</script>";
		}
		else{
			echo "<script>window.alert('Delete Failled');
			window.location=('commodity.php')</script>";
		}
	}
?>