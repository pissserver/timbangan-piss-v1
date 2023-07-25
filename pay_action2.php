<?php
	session_start();
	include "connection.php";
	if($_SESSION['checker']==''){
		echo "<script>window.alert('Anda Tidak Mempunyai Hak Akses');
		window.history.back()</script>";
		exit();
	}
	$task		= $_GET['task'];
	$type		= $_GET['type'];
	//Mengambil Id Checker
	$checker = executeScalar("select checker_id from checker where checker_code = '".$_SESSION['checker']."'");
	//Pembayaran Tonase
	if($task=='receive'&&$type='km'){
		$id	= $_GET['id'];
		//update status pembayaran
		$pay = mysql_query("update ko set ko_status = 'Diterima' where ko_id = '".$id."'");
		if($pay){
			echo "<script>window.location=('pay_acc.php')</script>";
			exit();
		}
		else{
			echo "<script>window.alert('Pembayaran Gagal');
			window.history.back()</script>";
			exit();
		}
		//cek jumlah nota pd ko apa sdh 10?
		/*$jml 	= executeScalar("select count(ko_id) from ko 
		where cashier_id = '".$checker."' and ko_status = 'Diterima'");
		if($jml<10){
			
		}*/
	}
	
	//Pembayaran Tonase
	elseif($task=='receive_mitra'&&$type='km'){
		$id	= $_GET['id'];
		//update status pembayaran
		$pay = mysql_query("update ko_mitra set ko_status = 'Diterima' where ko_id = '".$id."'");
		if($pay){
			echo "<script>window.location=('pay_acc_mitra.php')</script>";
			exit();
		}
		else{
			echo "<script>window.alert('Pembayaran Gagal');
			window.history.back()</script>";
			exit();
		}
		//cek jumlah nota pd ko apa sdh 10?
		/*$jml 	= executeScalar("select count(ko_id) from ko 
		where cashier_id = '".$checker."' and ko_status = 'Diterima'");
		if($jml<10){
			
		}*/
	}

	//ACC Pembayaran KO Tonase
	elseif ($task=='acc'&&$type=='km'){
		//Generate KM ID
		$km_id 		= 0;
		$year		= date('Y');
		$km_id 		= executeScalar("select count(km_id) from km where km_year = '".$year."'");
		$km_id 		= $km_id + 1;
		$km_id 		= sprintf("%06d", $km_id);
		$km_id  	= $year.$km_id;
		$cash		= $_POST['cash'];
		$cashier 	= executeScalar("select checker_id from checker where checker_code = '".$_SESSION['checker']."'");
		$total		= executeScalar("select sum(ko_total) from ko where cashier_id = '".$cashier."' and ko_status = 'Diterima'");
		
		$diff1=$total-$cash; //duit krg 
		$diff2=$cash-$total; //duit lebih
		
		//cek jika selisih uang diterima -+ 1000
		if(($diff1>=0&&$diff1<=1000)||($diff2>=0&&$diff2<=1000)){
			//update status pembayaran
			// if($total==0){
			// 	echo "<script>window.alert('Data Tampungan KO Sedang Kosong');
			// 	window.history.back()</script>";
			// 	exit();
			// }
			$update = mysql_query("update ko set ko_status = 'Acc', km_id = '".$km_id."' where cashier_id = '".$cashier."' and ko_status = 'Diterima'");
			if($update){
				$insert = mysql_query("	insert into km (km_id, 
														km_year, 
														km_total, 
														km_cash, 
														km_status, 
														km_date)
										value (	'".$km_id."', 
												'".$year."', 
												'".$total."', 
												'".$cash."', 
												'Diajukan', 
												'".$date_now."')");
				if($insert){
					$update2 = mysql_query("update 	weighing w, ko o, km m 
											set 	w.km_id = '".$km_id."'
											where 	w.ko_id = o.ko_id and 
													o.km_id = m.km_id and 
													m.km_id	= '".$km_id."'");
					if($update2){	
						echo "<script>window.location=('htmltopdf/reportKM2.php?km=$km_id')</script>";
						exit();
					}else{
						echo "<script>window.alert('ACC Gagal');
						window.history.back()</script>";
						exit();
					}
				}else{
					echo "<script>window.alert('ACC Gagal');
					window.history.back()</script>";
					exit();
				}
			}
			else{
				echo "<script>window.alert('ACC Gagal');
				window.history.back()</script>";
				exit();
			}
		}
		else{
			echo "<script>window.alert('Toleransi Uang kurang / lebih adalah Rp 1.000');
			window.history.back()</script>";
			exit();
		}
	}
	
	//ACC Pembayaran KO Mitra
	elseif ($task=='acc_mitra'&&$type=='km'){
		//Generate KM ID
		$km_id 		= 0;
		$year		= date('Y');
		$km_id 		= executeScalar("select count(km_id) from km_mitra where km_year = '".$year."'");
		$km_id 		= $km_id + 1;
		$km_id 		= sprintf("%06d", $km_id);
		$km_id  	= $year.$km_id;
		$cash		= $_POST['cash'];
		$cashier 	= executeScalar("select checker_id from checker where checker_code = '".$_SESSION['checker']."'");
		$total		= executeScalar("select sum(ko_total) from ko_mitra where cashier_id = '".$cashier."' and ko_status = 'Diterima'");
		
		$diff1=$total-$cash; //duit krg 
		$diff2=$cash-$total; //duit lebih
		
		//cek jika selisih uang diterima -+ 1000
		if(($diff1>=0&&$diff1<=1000)||($diff2>=0&&$diff2<=1000)){
			//update status pembayaran
			if($total==0){
				echo "<script>window.alert('Data Tampungan KO Sedang Kosong');
				window.history.back()</script>";
				exit();
			}
			$update = mysql_query("update ko_mitra set ko_status = 'Acc', km_id = '".$km_id."' where cashier_id = '".$cashier."' and ko_status = 'Diterima'");
			if($update){
				$insert = mysql_query("	insert into km_mitra (	km_id, 
																km_year, 
																km_total, 
																km_cash, 
																km_status, 
																km_date)
										value (	'".$km_id."', 
												'".$year."', 
												'".$total."', 
												'".$cash."', 
												'Diajukan', 
												'".$date_now."')");
				if($insert){
					$update2 = mysql_query("update 	weighing_mitra w, ko_mitra o, km_mitra m 
											set 	w.km_id = '".$km_id."'
											where 	w.ko_id = o.ko_id and 
													o.km_id = m.km_id and 
													m.km_id	= '".$km_id."'");
					if($update2){	
						echo "<script>window.location=('htmltopdf/reportKM2_mitra.php?km=$km_id')</script>";
						exit();
					}else{
						echo "<script>window.alert('ACC Gagal');
						window.history.back()</script>";
						exit();
					}
				}else{
					echo "<script>window.alert('ACC Gagal');
					window.history.back()</script>";
					exit();
				}
			}
			else{
				echo "<script>window.alert('ACC Gagal');
				window.history.back()</script>";
				exit();
			}
		}
		else{
			echo "<script>window.alert('Toleransi Uang kurang / lebih adalah Rp 1.000');
			window.history.back()</script>";
			exit();
		}
	}

	//Cancel Pembayaran KO Tonase
	elseif ($task=='cancel'&&$type=='km'){
		$id	= $_GET['id'];
		//update status pembayaran
		$pay = mysql_query("update 	ko 
							set 	ko_status = 'Diajukan' 
							where 	ko_id = '".$id."' and 
									ko_status = 'Diterima'");
		if($pay){
			echo "<script>window.location=('pay_acc.php')</script>";
			exit();
		}
		else{
			echo "<script>window.alert('Pembayaran Gagal' $task $type $id)</script>;
			<script>window.history.back()</script>";
				exit();
		}
	}

	//Cancel Pembayaran KO Mitra
	elseif ($task=='cancel_mitra'&&$type=='km'){
		$id	= $_GET['id'];
		//update status pembayaran
		$pay = mysql_query("update 	ko_mitra 
							set 	ko_status = 'Diajukan' 
							where 	ko_id = '".$id."' and 
									ko_status = 'Diterima'");
		if($pay){
			echo "<script>window.location=('pay_acc_mitra.php')</script>";
			exit();
		}
		else{
			echo "<script>window.alert('Pembayaran Gagal' $task $type $id)</script>;
			<script>window.history.back()</script>";
				exit();
		}
	}
	
	//Cancel Semua Pembayaran KO Tonase
	elseif ($task=='cancelAll'&&$type=='km'){
		//update status pembayaran
		$cancel = mysql_query("	update 	ko 
								set 	ko_status = 'Diajukan' 
								where 	ko_status = 'Diterima'");
		if($cancel){
			echo "<script>window.location=('pay_acc.php')</script>";
			exit();
		}
		else{
			echo "<script>window.alert('Pembayaran Gagal');
			window.history.back()</script>";
			exit();
		}
	}

	//Cancel Semua Pembayaran KO Mitra
	elseif ($task=='cancelAll_mitra'&&$type=='km'){
		//update status pembayaran
		$cancel = mysql_query("	update 	ko_mitra 
								set 	ko_status = 'Diajukan' 
								where 	ko_status = 'Diterima'");
		if($cancel){
			echo "<script>window.location=('pay_acc_mitra.php')</script>";
			exit();
		}
		else{
			echo "<script>window.alert('Pembayaran Gagal');
			window.history.back()</script>";
			exit();
		}
	}
?>