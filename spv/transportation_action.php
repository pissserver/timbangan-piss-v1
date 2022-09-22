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
		//$prcen	= $_POST['weight']*2/100;
		$weight = $_POST['weight'];
		$insert = mysql_query("INSERT INTO `transportation` (`transportation_id`, `transportation_nopol`, `transportation_weight`) 
		VALUES ('', '".$_POST['trans']."', '".$weight."')");
		
		if($insert){
			echo "<script>window.location=('transportation.php')</script>";
		}
		else{
			echo "<script>window.alert('Data Gagal');
			window.location=('transportation.php')</script>";
		}
	}

	// Update
	elseif($task=='update'){
		$id		= $_GET['id'];
		$update = mysql_query("update transportation set transportation_nopol 	= '".$_POST['trans']."',
													transportation_weight		= '".$_POST['weight']."'
													where transportation_id 	= '".$id."'");
		if($update){
			echo "<script>window.location=('transportation.php')</script>";
		}
		else{
			echo "<script>window.alert('Data Gagal Diperbarui');
			window.history.back()</script>";
		}
	}
	
	elseif($task=='delete'){
		//$delete = mysql_query("delete checker where checker_id = '".$id."'");
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
?>