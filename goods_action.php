<?php
	session_start();
	include "connection.php";
	//include "fungsi_thumb.php";
	
	$task	= $_GET['task'];
	if($_SESSION['role']!='admin'||$_SESSION['role']!='super_admin'){
		echo "<script>window.alert('Anda Tidak Memiliki Hak Akses Untuk Mengubah Data');
		window.location=('goods.php')</script>";
	}else{
		if ($task == 'insert'){
			$exist 	= executeScalar("select count(goods_name) from goods where goods_name='".$_POST['name']."'");
			if($exist>0){
				echo "<script>window.alert('Barang Sudah Ada, Beri Tambahan Kata');
				window.location=('goods.php')</script>";
			}
			else{
				$insert = mysql_query("INSERT INTO `goods` (`goods_id`, `goods_name`, `goods_type`) 
				VALUES ('', '".$_POST['name']."', '".$_POST['type']."')");
				
				if($insert){
					echo "<script>window.location=('goods.php')</script>";
				}
				else{
					echo "<script>window.alert('Data Gagal');
					window.history.back()</script>";
				}
			}
		}

		// Update
		elseif ($task == 'update'){
			$id		= $_GET['id'];
			$exist 	= executeScalar("select count(goods_name) from goods where goods_name='".$_POST['name']."'");
			if($exist>1){
				echo "<script>window.alert('Nama Barang Sudah Ada, Beri Tambahan Kata');
				window.location=('goods.php')</script>";
			}
			else{
				$update = mysql_query("update goods set goods_name	= '".$_POST['name']."',
														goods_type 	= '".$_POST['type']."'
													where goods_id 	= '".$id."'");
				
				if($update){
					echo "<script>window.location=('goods.php')</script>";
				}
				else{
					echo "<script>window.alert('Data Gagal');
					window.history.back()</script>";
				}
			}
		}
		
		elseif ($task == 'delete'){
			$delete = mysql_query("delete goods where goods_id = '".$id."'");
			if($delete){
				//Writes the photo to the server 
				echo "<script>window.alert('Berhasil Dihapus');
				window.location=('goods.php')</script>";
			}
			else{
				echo "<script>window.alert('Gagal Dihapus');
				window.location=('goods.php')</script>";
			}
		}
	}
	
?>