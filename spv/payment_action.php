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
		$insert = mysql_query("INSERT INTO `payment` (`pay_id`, `pay_name`, `pay_total`) 
		VALUES ('', '".$_POST['name']."', '".$_POST['pay']."')");
		
		if($insert){
			echo "<script>window.location=('payment.php')</script>";
		}
		else{
			echo "<script>window.alert('Data Gagal');
			window.history.back()</script>";
		}
	}

	// Update
	elseif ($task == 'update'&&$_SESSION['checker']!=''){
		$id		= $_GET['id'];
		$update = mysql_query("update payment set pay_name 	= '".$_POST['name']."',
												pay_total	= '".$_POST['pay']."'
											where pay_id 	= '".$id."'");
		if($update){
			echo "<script>window.location=('payment.php')</script>";
		}
		else{
			echo "<script>window.alert('Data Gagal Diperbarui');
			window.history.back()</script>";
		}
	}
	
	elseif ($task == 'delete'){
		//$delete = mysql_query("delete payment where pay_id = '".$id."'");
		if($delete){
			//Writes the photo to the server 
			echo "<script>window.alert('Delete Success');
			window.location=('payment.php')</script>";
		}
		else{
			echo "<script>window.alert('Delete Failled');
			window.location=('payment.php')</script>";
		}
	}
?>