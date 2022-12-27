<?php
	session_start();
	include "connection.php";

	function antiInjection($data){
		$filter_sql = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
		return $filter_sql;
	}

	$login	= mysql_query("select checker_name, checker_code, checker_role from checker
			where checker_code = '".antiinjection($_POST["user"])."' and 
			checker_pass = '".antiinjection($_POST["pass"])."' and checker_sts = 'Aktif'");
	$ketemu	= mysql_num_rows($login);
	$r		= mysql_fetch_array($login);
	
	$_SESSION['checker'] 	= $r['checker_code'];
	$_SESSION['role'] 		= $r['checker_role'];
	
	//Jika User & Pass sebagai checker ada
	if($ketemu==1){
		echo "<script>window.location=('index.php')</script>";
		exit();
	}
	//Jika user & pass checker tidak ada, lakukan query pencarian user sbg admin
	else{
		$login2	= mysql_query("select id_admin, username, password, role from admin
				where username = '".antiinjection($_POST["user"])."' and 
				password = '".antiinjection($_POST["pass"])."' and 
				timbangan = 'Yes'");
		$ada	= mysql_num_rows($login2);
		$role	= mysql_fetch_array($login2);
		
		
		if($ada==1){
			//Jika user adl pp
			if($role['role']=='pp'){
				$_SESSION['id_admin'] 	= $role['id_admin'];
				$_SESSION['username'] 	= $role['username'];
				$_SESSION['role'] 		= $role['role'];
				echo "<script>window.location=('pp/index.php')</script>";
				exit();
			}
			//Jika user adl kas kecil
			if($role['role']=='kk'){
				$_SESSION['id_admin'] 	= $role['id_admin'];
				$_SESSION['username'] 	= $role['username'];
				$_SESSION['role'] 		= $role['role'];
				echo "<script>window.location=('kk/index.php')</script>";
				exit();
			}
			//jika user adl admin / super admin
			if($role['role']=='admin'||$role['role']=='super_admin'){
				$_SESSION['id_admin'] 	= $role['id_admin'];
				$_SESSION['username'] 	= $role['username'];
				$_SESSION['role'] 		= $role['role'];
				echo "<script>window.location=('spv/index.php')</script>";
				exit();
			}
			else{
				echo "<script>window.alert('Anda Tidak Memiliki Hak Untuk Masuk! 1');
					window.location=('login.html')</script>";
				exit();
			}
		}
		//Jika user bukan checker, pp, admin, super admin
		else{
			echo "<script>window.alert('Anda Tidak Memiliki Hak Untuk Masuk! 2');
				window.location=('login.html')</script>";
			exit();
		}
	}
?>