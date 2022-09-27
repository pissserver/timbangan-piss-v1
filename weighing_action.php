<?php
	session_start();
	include "connection.php";
	date_default_timezone_set('Asia/Jakarta');
	$date_now	= date("Y-m-d H:i:s");
	$dt_now		= date("Y-m-d H:i:s");
	include "dio.php";
	
	if($_SESSION['checker']==''){
		echo "<script>window.alert('Anda Tidak Mempunyai Hak Akses');
		window.history.back()</script>";
		exit();
	}
	$task	= $_GET['task'];
	//Mengambil Id Checker
	$checker= executeScalar("select checker_id from checker where checker_code='".$_SESSION['checker']."'");
	
	//Kendaraan Masuk 
	if($task=='masuk'){
		if($_POST['merchant']==''|| $_POST['goods']==''){
			trigger_error("Data pedagang atau jenis barang belum diisi", E_USER_ERROR);
			exit();
		}
		//Validasi Nopol Jika tidak menggunakan huruf di akhir
		$nopol = substr($_POST['nopol'], -1);
		if(is_numeric($nopol)){
			echo "<script>window.alert('Nopol Belum Lengkap');
			window.history.back()</script>";
			exit();
		}
		//Mengambil Id Checker
		$block	= executeScalar("select active_block from merchant where merchant_id = '".$_POST['merchant']."'");
		//Cek Apakah Pedagang Mempunyai Tagihan yg Belum Terbayar (Cek berdasarkan tgl Pembuatan Nota)
		//$last_date adl tgl nota tagihan paling lama
		$last_date	= executeScalar("select date_check from weighing
					where merchant_id = '".$_POST['merchant']."' and
					(date_check between '2016-10-01 00:00:00' and '".$date_now." 23:59:59') and
					(date_pay > '".$date_now."' || date_pay is NULL) and
					weighing_sts != 'Batal' and
					(weighing_sts2 != 'Dipecah' || weighing_sts2 != 'Digabung') 
					order by date_check asc limit 1");
		//Jika Blok B / E Makan Akan Melakukan Pengecekan Tagihan
		//Blok yg blh diuji coba H, C, C6, GB
		if($_POST['merchant'] !='' && $_POST['goods'] !=''){
			//$date2 	= date('Y-m-d', strtotime($date_now . "-3 days")); 
			//Hitung Umur Tagihan
			$date3 	= new DateTime(date("Y-m-d", strtotime($last_date)));
			$date4 	= new DateTime(date("Y-m-d", strtotime($date_now)));
			$diff 	= $date4->diff($date3)->format("%a");
			if($diff<3||($last_date==0)){
				//cara mendapatkan data 1 menit yg lalu
				$currentDate = strtotime($time_now);
				$pastdate 	= $currentDate-(60*1);
				$past 		= date("H:i:s", $pastdate);
				//Menghindari kemasukan data double
				$double 	= mysql_query("select nopol from weighing where nopol = '".$_POST['nopol']."'
				and date_in = '".$date_now."' and (time_in between '".$past."' and '".$time_now."')");
				//$triple 	= mysql_query("select nopol from weighing where nopol = '".$_POST['nopol']."'
				//and weighing_sts = 'Masuk'");
				$ketemu		= mysql_num_rows($double);
				//$ketemu2	= mysql_num_rows($triple);
				
				if($ketemu>=1){
					echo "<script>window.alert('Data Double Atau Mobil Masih Berada Di Dalam Area');
					window.location=('index.php')</script>";
					exit();
				}else{
					$x 		= getWeight();
					//$x 	= 1000;
					//$x	= $_POST['weight_in'];
					if($x!=0||$x!='0'){
						//tahun 2018
						$year 		= date("y");
						$year2 		= date("Y");
						
						$count_id 	= executeScalar("select count(weighing_id) from weighing where YEAR(date_in) = '".$year2."'");
						$total_id	= $count_id+1;
						$idx 		= sprintf("%07d", $total_id);
						$id			= $year.''.$idx+4;//+4 Krn ada nota 2018 dipecah ke 2019
						
						//Simpan data ke tabel timbangan
						$insert = mysql_query("INSERT INTO `weighing` (`weighing_id`, `nopol`, `weight_in`, `weight_out`,  `noncommodity`, 
						`checker_id`, `merchant_id`, `goods_id`, `date_in`, `time_in`, `laborer_sts`, `weighing_sts`, `weighing_sts2`) 
						VALUES ('".$id."', '".$_POST['nopol']."', '".$x."', '0', '0', '".$checker."', '".$_POST['merchant']."', 
						'".$_POST['goods']."', '".$date_now."', '".$time_now."', 'Tidak', 'Masuk', 'Normal')");
					
						if($insert){
							echo 'Berat Masuk '.$x;
							HEADER("location: index.php");
							exit();
						}
						else{
							//echo 'Data Gagal Masuk';
							trigger_error("Data gagal Masuk, Silahkan dicoba lagi".$id." brt ".$x, E_USER_ERROR);
							HEADER("location: index.php");
							exit();
						}
					}
					else{
						echo "<script>window.alert('Berat Masuk 0 - 100 Atau Belum Stabil, Tolong Diinputkan lagi')</script>;
						<script>window.history.back()</script>";
						exit();
					}
				}
			}
			else{
				echo "<script>window.alert('Pedagang Masih Mempunyai Tagihan $diff Hari Yg Belum Terbayar. Tanggal Tagihan Terlama: ".$last_date."');
				window.location=('index.php')</script>";
				exit();
			}
		}
		else{
			// $tagihan	= executeScalar("select count(weighing_id)from weighing where 
			// 	merchant_id = 'B0091' and
			// 	(date_check between '2016-10-01 00:00:00' and '".$date_now." 23:59:59') and
			// 	(date_pay > '".$date_now."' || date_pay is NULL) and
			// 	weighing_sts != 'Batal' and
			// 	(weighing_sts2 != 'Dipecah' || weighing_sts2 != 'Digabung')");
			// if($tagihan<5){
			// 	//cara mendapatkan data 1 menit yg lalu
			// 	$currentDate = strtotime($time_now);
			// 	$pastdate 	= $currentDate-(60*1);
			// 	$past 		= date("H:i:s", $pastdate);
			// 	//Menghindari kemasukan data double
			// 	$double 	= mysql_query("select nopol from weighing where nopol = '".$_POST['nopol']."'
			// 	and date_in = '".$date_now."' and (time_in between '".$past."' and '".$time_now."')");
			// 	//$triple 	= mysql_query("select nopol from weighing where nopol = '".$_POST['nopol']."'
			// 	//and weighing_sts = 'Masuk'");
			// 	$ketemu		= mysql_num_rows($double);
			// 	//$ketemu2	= mysql_num_rows($triple);
				
			// 	if($ketemu>=1){
			// 		echo "<script>window.alert('Data Double Atau Mobil Masih Berada Di Dalam Area');
			// 		window.location=('index.php')</script>";
			// 		exit();
			// 	}else{
			// 		$x 		= getWeight();
			// 		//$x 	= 1000;
			// 		//$x	= $_POST['weight_in'];
			// 		if($x!=0||$x!='0'){
			// 			//tahun 2018
			// 			$year 		= date("y");
			// 			$year2 		= date("Y");
						
			// 			$count_id 	= executeScalar("select count(weighing_id) from weighing where YEAR(date_in) = '".$year2."'");
			// 			$total_id	= $count_id+1;
			// 			$idx 		= sprintf("%07d", $total_id);
			// 			$id			= $year.''.$idx+4;//+3 Krn ada nota 2018 dipecah ke 2019
						
			// 			//Simpan data ke tabel timbangan
			// 			$insert = mysql_query("INSERT INTO `weighing` (`weighing_id`, `nopol`, `weight_in`, `weight_out`,  `noncommodity`, 
			// 			`checker_id`, `merchant_id`, `goods_id`, `date_in`, `time_in`, `laborer_sts`, `weighing_sts`, `weighing_sts2`) 
			// 			VALUES ('".$id."', '".$_POST['nopol']."', '".$x."', '0', '0', '".$checker."', '".$_POST['merchant']."', 
			// 			'".$_POST['goods']."', '".$date_now."', '".$time_now."', 'Tidak', 'Masuk', 'Normal')");
						
			// 			if($insert){
			// 				echo 'Berat Masuk '.$x;
			// 				HEADER("location: index.php");
			// 				exit();
			// 			}
			// 			else{
			// 				//echo 'Data Gagal Masuk';
			// 				trigger_error("Data gagal Masuk, Silahkan dicoba lagi", E_USER_ERROR);
			// 				HEADER("location: index.php");
			// 				exit();
			// 			}
			// 		}
			// 		else{
			// 			echo "<script>window.alert('Berat Masuk 0 - 100 Atau Belum Stabil, Tolong Diinputkan lagi')</script>;
			// 			<script>window.history.back()</script>";
			// 			exit();
			// 		}
			// 	}
			// }else{
			// 	echo "<script>window.alert('Pedagang Masih Mempunyai Tagihan 5 Nota Yg Belum Terbayar.');
			// 	window.location=('index.php')</script>";
			// 	exit();
			// }
			trigger_error("Data pedagang atau jenis barang belum diisi", E_USER_ERROR);
			exit();
		}
	}
	
	//Retail Masuk 
	if($task=='masuk2'){
		if($_POST['merchant']==''||$_POST['goods']==''){
			trigger_error("Data pedagang & jenis barang belum diisi", E_USER_ERROR);
			exit();
		}
		//cara mendapatkan data 1 menit yg lalu
		$currentDate = strtotime($time_now);
		$pastdate 	= $currentDate-(60*1);
		$past 		= date("H:i:s", $pastdate);
		
		//Menghindari kemasukan data double
		$double 	= mysql_query("select nopol from weighing where nopol = '".$_POST['nopol']."'
		and date_in = '".$date_now."' and merchant_id = '".$_POST['merchant']."' and
		(time_in between '".$past."' and '".$time_now."')");
		
		$ketemu		= mysql_num_rows($double);
		if($ketemu>=1){
			echo "<script>window.alert('Data Double');
			window.location=('index.php')</script>";
			exit();
		}else{
			$nopol 	= 'XXXXX';
			//tahun 2018
			$year 	= date("y");
			$year2 	= date("Y");
			
			$count_id 	= executeScalar("select count(weighing_id) from weighing where YEAR(date_in) = '".$year2."'");
			$total_id	= $count_id+1;
			$idx 	= sprintf("%07d", $total_id);
			$id		= $year.''.$idx+4;//+3 Krn nota 2018 dipecah ke 2019
			
			//ambil tarif retail dari db
			$tarifretail 	= executeScalar("select pay_total from payment where pay_id = '1'");
			
			//Simpan data ke tabel timbangan
			$insert = mysql_query("INSERT INTO `weighing` (`weighing_id`, `nopol`, `weight_in`, `weight_out`,  
			`noncommodity`, `netto`, `checker_id`, `merchant_id`, `goods_id`, `date_in`, `date_out`, `time_in`, 
			`time_out`, `laborer_sts`, `cost`, `cost2`, `weighing_sts`, `weighing_sts2`) 
			VALUES ('".$id."', '".$nopol."', '0', '0', '0', '0', '".$checker."', 
			'".$_POST['merchant']."', '".$_POST['goods']."', '".$date_now."', '".$date_now."', '".$time_now."', 
			'".$time_now."', 'Tidak', '".$tarifretail."', '".$tarifretail."', 'Keluar', 'Tanpa Timbang')");
			if($insert){
				echo 'Pembuatan Retail Berhasil';
				HEADER("location: check.php");
				exit();
			}
			else{
				//echo 'Data Gagal Masuk';
				trigger_error("Data gagal Masuk, Silahkan dicoba lagi", E_USER_ERROR);
				HEADER("location: index.php");
				exit();
			}
		}
	}

	//Edit Kendaraan Masuk
	elseif($task=='edit'){
		$id		= $_GET['id'];
		$update1 = mysql_query("update weighing set nopol = '".$_POST['nopol']."',
										merchant_id		= '".$_POST['merchant']."',
										goods_id		= '".$_POST['goods']."'
									where weighing_id 	= '".$id."'");
		if($update1){
			echo "<script>window.location=('index2.php?id=$id')</script>";
			exit();
		}
		else{
			echo "<script>window.alert('Data Gagal Diperbarui');
			window.history.back()</script>";
			exit();
		}
	}
	
	//Kendaraan Keluar
	elseif($task=='keluar'){
		$id		= $_GET['id'];
		$sts 	= executeScalar("select weighing_sts from weighing where weighing_id = '".$id."'");
		if($sts=='Masuk'){
			$netto	= 0;
			$total1	= 0;
			$total2	= 0;
			$noncommodity = executeScalar("select noncommodity from weighing where weighing_id = '".$id."'");
			
			//memanggil tarif tonase
			$tonase3 	= 0;
			$tonase1 	= 0;
			//Jika Jenis pedangang sayur / buar harga berbeda
			$jenis		= mb_substr($_POST['merchant'], 0, 1, 'utf-8');
			if($jenis=='B'){
				$tonase1 = executeScalar("select pay_total from payment where pay_id = '8'");
				$tonase2 = executeScalar("select pay_total from payment where pay_id = '9'");
				// if($_POST['merchant']=='B0072'&&$_POST['goods']==2){
				// 	$tonase1 = executeScalar("select pay_total from payment where pay_id = '2'");
				// }
			}
			elseif($jenis=='S'){
				$tonase1 	= executeScalar("select pay_total from payment where pay_id = '2'");
				$tonase2 	= executeScalar("select pay_total from payment where pay_id = '3'");
			}
			elseif($jenis=='L'){
				$tonase1 	= executeScalar("select pay_total from payment where pay_id = '2'");
				$tonase2 	= executeScalar("select pay_total from payment where pay_id = '3'");
			}
			
			$tarifmin 		= executeScalar("select pay_total from payment where pay_id = '1'");
			$tonase3 		= $tonase1 + $tonase2;
			
			$weight_in 	= executeScalar("select weight_in from weighing where weighing_id = '".$id."'");
			
			$x 			= getWeight();
			//$x 			= 700;
			if($x==0||$x=='0'){
				echo "<script>window.alert('Berat Keluar 0 Atau Belum Stabil, Tolong Diinputkan lagi')</script>;
				<script>window.history.back()</script>";
				exit();
			}
			$weight_out = $x;
			//berat bersih pertama
			$netto 		= $weight_in-$weight_out;
			
			//jika mitra status default tidak
			$total1	= $netto*$tonase1;
			$total2	= $netto*$tonase1;
			
			//Jika total bayar dibawah 10.000, maka akan dikenakan tarin min (Rp 10.000)
			if($total1>$tarifmin){
				$total1 = $total1;
			}
			else{
				$total1 = $tarifmin;
			}
			
			//Jika Berat Keluar = 0
			if($weight_out==0){
				echo "<script>window.alert('Berat Keluar 0, Tolong Diinputkan lagi')</script>;
				<script>window.history.back()</script>";
				exit();
			}
			//Jika Berat Keluar > Berat Masuk
			if($weight_out>$weight_in){
				//Cek Berat Keluar
				$selisih 	= 0;
				$selisih 	= $weight_out-$weight_in;
				if($selisih<=20){
					//update status = batal
					$batal 	= mysql_query("update weighing set weight_out = '".$weightout."', weighing_sts = 'Batal' where weighing_id = '".$id."'");
					if($batal){
						$update = mysql_query("update weighing set nopol = '".$_POST['nopol']."',
														weight_out		= '".$weight_out."',
														netto			= '0',
														checker_id		= '".$checker."',
														merchant_id		= '".$_POST['merchant']."',
														goods_id		= '".$_POST['goods']."',
														time_out		= '".$time_now."', 
														date_out		= '".$date_now."',
														laborer_sts		= 'Tidak',
														cost			= '0',
														cost2			= '0',
														weighing_sts	= 'Batal'
													where weighing_id 	= '".$id."'");
						if($update){
							HEADER("location: index.php");
							exit();
						}
						else{
							//echo 'Data Gagal Diperbarui';
							trigger_error("Data gagal Masuk, Silahkan dicoba lagi", E_USER_ERROR);
							HEADER("location: index.php");
							exit();
						}
					}
				}else{
					echo "<script>window.alert('Berat Keluar Lebih Besar, Mungkin Salah Kendaraan')</script>;
					<script>window.history.back()</script>";
					exit();
				}
			}
			//update status = batal
			if($netto==0||$netto==10||$netto==20){
				$batal = mysql_query("update weighing set weight_out = '".$weightout."', weighing_sts = 'Batal' 
				where weighing_id = '".$id."'");
				if($batal){
					$update = mysql_query("update weighing set nopol = '".$_POST['nopol']."',
													weight_out		= '".$weight_out."',
													netto			= '0',
													checker_id		= '".$checker."',
													merchant_id		= '".$_POST['merchant']."',
													goods_id		= '".$_POST['goods']."',
													time_out		= '".$time_now."', 
													date_out		= '".$date_now."',
													laborer_sts		= 'Tidak',
													cost			= '0',
													cost2			= '0',
													weighing_sts	= 'Batal'
												where weighing_id 	= '".$id."'");
					if($update){
						HEADER("location: index.php");
						exit();
					}
					else{
						//echo 'Data Gagal Diperbarui';
						trigger_error("Data gagal Masuk, Silahkan dicoba lagi", E_USER_ERROR);
							HEADER("location: index.php");
						exit();
					}
				}
			}
			$update1 = mysql_query("update weighing set nopol = '".$_POST['nopol']."',
											weight_out		= '".$weight_out."',
											netto			= '".$netto."',
											checker_id		= '".$checker."',
											merchant_id		= '".$_POST['merchant']."',
											goods_id		= '".$_POST['goods']."',
											time_out		= '".$time_now."', 
											date_out		= '".$date_now."',
											laborer_sts		= 'Tidak',
											cost			= '".$total1."',
											cost2			= '".$total2."',
											weighing_sts	= 'Keluar'
										where weighing_id 	= '".$id."'");
			if($update1){
				HEADER("location: check.php");
				exit();
			}else{
				//echo 'Data Gagal Masuk';
					trigger_error("Data gagal Masuk, Silahkan dicoba lagi", E_USER_ERROR);
				HEADER("location: index.php");
				exit();
			}
		}
		else{
			echo "<script>window.alert('Kendaraan Ini Sudah Keluar');
			window.location=('index.php')</script>";
			exit();
		}
	}
	
	//Kendaraan Keluar dengan kir
	elseif($task =='kir'){
		$id		= $_GET['id'];
		$sts 	= executeScalar("select weighing_sts from weighing where weighing_id = '".$id."'");
		if($sts == 'Masuk'){
			$netto	= 0;
			$total1	= 0;
			$total2	= 0;
			$noncommodity 	= executeScalar("select noncommodity from weighing where weighing_id = '".$id."'");
			$commodity 		= executeScalar("select goods_id from weighing where weighing_id = '".$id."'");
			
			//memanggil tarif tonase
			$tonase3 	= 0;
			$tonase1 	= 0;
			//Jika Jenis pedangang sayur / buar harga berbeda
			$jenis		= mb_substr($_POST['merchant'], 0, 1, 'utf-8');
			if($jenis=='B'){
				$tonase1 	= executeScalar("select pay_total from payment where pay_id = '8'");
				$tonase2 	= executeScalar("select pay_total from payment where pay_id = '9'");
				// if($_POST['merchant']=='B0072'&&$commodity==2){
				// 	$tonase1 = executeScalar("select pay_total from payment where pay_id = '2'");
				// }
			}
			elseif($jenis=='S'){
				$tonase1 	= executeScalar("select pay_total from payment where pay_id = '2'");
				$tonase2 	= executeScalar("select pay_total from payment where pay_id = '3'");
			}
			elseif($jenis=='L'){
				$tonase1 	= executeScalar("select pay_total from payment where pay_id = '2'");
				$tonase2 	= executeScalar("select pay_total from payment where pay_id = '3'");
			}
			
			$tarifmin 	= executeScalar("select pay_total from payment where pay_id = '1'");
			$tonase3 	= $tonase1 + $tonase2;
			
			if($noncommodity!=0 || $noncommodity!=''){
				$noncommodity = $noncommodity;
			}
			else{
				$noncommodity = 0;
			}
			$weight_in 	= executeScalar("select weight_in from weighing where weighing_id = '".$id."'");
			$nopol 		= executeScalar("select nopol from weighing where weighing_id = '".$id."'");
			$kir 		= executeScalar("select transportation_weight from transportation where transportation_nopol = '".$nopol."'");
			
			//berat bersih pertama
			$netto 		= $weight_in-$kir-$noncommodity;
			
			//jika mitra status tidak pake mitra (Default)
			$total1		= $netto*$tonase1;
			$total2		= $netto*$tonase1;
			
			//Jika total bayar dibawah 10.000, maka akan dikenakan tarin min (Rp 10.000)
			//set total bayar
			if($total1>$tarifmin){
				$total1 = $total1;
			}
			else{
				$total1 = $tarifmin;
			}
			//Cek Berat Keluar
			if($weight_in<$kir){
				echo "<script>window.alert('Anda Salah Memasukkan Berat Keluar');
				window.history.back()</script>";
				exit();
			}
			elseif($weight_in==$kir){
				//update status = batal
				$batal = mysql_query("update weighing set weight_out = '".$kir."', weighing_sts = 'Batal' 
				where weighing_id = '".$id."'");
				if($batal){
					echo "<script>window.alert('Kendaraan Ini Batal Bongkar');
					window.location=('index.php')</script>";
					exit();
				}
				else{
					echo "<script>window.alert('Data Gagal Diperbarui');
					window.history.back()</script>";
					exit();
				}
			}
			$update1 = mysql_query("update weighing set nopol 	= '".$_POST['nopol']."',
												weight_out		= '".$kir."',
												netto			= '".$netto."',
												checker_id		= '".$checker."',
												merchant_id		= '".$_POST['merchant']."',
												goods_id		= '".$_POST['goods']."',
												date_out		= '".$date_now."',
												time_out		= '".$time_now."',
												laborer_sts		= 'Tidak',
												cost			= '".$total1."',
												cost2			= '".$total2."',
												weighing_sts	= 'Keluar',
												weighing_sts2	= 'Kir'
											where weighing_id 	= '".$id."'");
			if($update1){
				echo "<script>window.location=('index.php')</script>";
				exit();
			}
			else{
				echo "<script>window.alert('Data Tidak Tersimpan');
				window.history.back()</script>";
				exit();
			}
		}
		else{
			echo "<script>window.alert('Kendaraan Ini Sudah Keluar');
			window.location=('index.php')</script>";
			exit();
		}
	}
	
	//Update Data Timbangan, rafaksi, dll
	elseif($task=='update'){
		$id		= $_GET['id'];
		$netto	= 0;
		$total1	= 0;
		$total2	= 0;
		$tonase1 = 0;
		$tonase3 = 0;
		
		//Cek apabila tagihan sdh d print
		$p2 	= executeScalar("select p2 from weighing where weighing_id = '".$id."'");
		if($p2==2){
			echo "<script>window.alert('Data Gagal Diperbarui');
			window.location=('check_edit.php?id=$id')</script>";
			exit();
		}
		
		//memanggil tarif tonase
		//Jika Jenis pedangang sayur / buar harga berbeda 
		$jenis		= mb_substr($_POST['merchant'], 0, 1, 'utf-8');
		if($jenis=='B'){
			$tonase1 	= executeScalar("select pay_total from payment where pay_id = '8'");
			$tonase2 	= executeScalar("select pay_total from payment where pay_id = '9'");
			// if($_POST['merchant']=='B0072'&&$_POST['goods']==2){
			// 	$tonase1 = executeScalar("select pay_total from payment where pay_id = '2'");
			// }
		}
		elseif($jenis=='S'){
			$tonase1 	= executeScalar("select pay_total from payment where pay_id = '2'");
			$tonase2 	= executeScalar("select pay_total from payment where pay_id = '3'");
		}
		elseif($jenis=='L'){
			$tonase1 	= executeScalar("select pay_total from payment where pay_id = '2'");
			$tonase2 	= executeScalar("select pay_total from payment where pay_id = '3'");
		}
		
		$tarifmin 	= executeScalar("select pay_total from payment where pay_id = '1'");
		$tonase3 	= $tonase1+$tonase2;
		
		$weight_in 	= executeScalar("select weight_in from weighing where weighing_id = '".$id."'");
		$weight_out = executeScalar("select weight_out from weighing where weighing_id = '".$id."'");
		$nc 		= executeScalar("select noncommodity from weighing where weighing_id = '".$id."'");
		
		//Jika Diberi Rafaksi
		$rafa		= $_POST['rafa'];
		$disc		= 0;
		
		//Perhitungan noncommodity
		if($nc==0||$nc==''){
			$sts	= executeScalar("select weighing_sts2 from weighing where weighing_id = '".$id."'");
			//Jika Nota Pecahan & Ada Rafaksi
			if($sts=='Pecahan'){
				$netto 	= executeScalar("select netto from weighing where weighing_id = '".$id."'");
			}
			else{
				$netto 	= $weight_in-$weight_out;
			}
			
			if($rafa=='Tidak'){
				//update rafaksi = 0
				$update = mysql_query("update weighing set rafaksi == NULL where weighing_id = '".$id."'");
			}
			
			elseif($rafa=='Ya'||$rafa!='Tidak'){
				if($netto>=1000&&$netto<=1999){
					$disc 	= intval($netto*1/100);
					$netto 	= intval($netto-$disc);
					$rafa	= $disc;
				}
				elseif($netto>=2000&&$netto<=5999){
					$disc 	= intval($netto*2/100);
					$netto 	= intval($netto-$disc);
					$rafa	= $disc;
				}
				elseif($netto>=6000){
					$disc 	= intval($netto*3/100);
					$netto 	= intval($netto-$disc);
					$rafa	= $disc;
				}
			}
		}
		
		//Perhitungan NC dengan Peti, Krat dan Kardus (persentase)
		elseif($nc!=0||$nc!=''){//||$_POST['nc']!=4
			$sts	= executeScalar("select weighing_sts2 from weighing where weighing_id = '".$id."'");
			//Jika Nota Pecahan & Ada Rafaksi
			if($sts=='Pecahan'){
				$netto 	= executeScalar("select netto from weighing where weighing_id = '".$id."'");
			}
			else{
				$netto 	= $weight_in-$weight_out-$nc;
			}
			
			if($rafa=='Tidak'){
				//update rafaksi = 0
				$update = mysql_query("update weighing set rafaksi == NULL where weighing_id = '".$id."'");
			}
			elseif($rafa=='Ya'||$rafa!='Tidak'){
				if($netto>=1000&&$netto<=1999){
					$disc 	= intval($netto*1/100);
					$netto 	= intval($netto-$disc);
					$rafa	= $disc;
				}
				elseif($netto>=2000&&$netto<=5999){
					$disc 	= intval($netto*2/100);
					$netto 	= intval($netto-$disc);
					$rafa	= $disc;
				}
				elseif($netto>=6000){
					$disc 	= intval($netto*3/100);
					$netto 	= intval($netto-$disc);
					$rafa	= $disc;
				}
			}
		}
		else{
			echo "<script>window.alert('Data Gagal Diperbarui');
			window.history.back()</script>";
			exit();
		}
		
		//cek jika status mitra ya/tidak
		$laborer 	= executeScalar("select laborer_sts from weighing where weighing_id = '".$id."'");
		if($laborer=='Tidak'){
			$total1	= $netto*$tonase1;
			$total2	= $total1;
		}
		else{
			$total1	= $netto*$tonase3;
			$total2	= $total1;
		}
		//Jika total bayar dibawah 15.000, maka akan dikenakan tarin min (Rp 15.000)
		if($total1>$tarifmin){
			$total1 = $total1;
		}
		else{
			$total1 = $tarifmin;
		}
		//jika status pembayaran berubah
		$ceksts 	= executeScalar("select weighing_sts from weighing where weighing_id = '".$id."'");
		$cekweight	= executeScalar("select weight_in from weighing where weighing_id = '".$id."'");
		
		//update Table weighing
		$update1 = mysql_query("update weighing set nopol 	= '".$_POST['nopol']."',
											noncommodity	= '".$nc."',
											rafaksi			= '".$rafa."',
											netto			= '".$netto."',
											checker_id		= '".$checker."',
											date_check		= '".$dt_now."',
											merchant_id		= '".$_POST['merchant']."',
											goods_id		= '".$_POST['goods']."',
											cost			= '".$total1."',
											cost2			= '".$total2."'
										where weighing_id 	= '".$id."'");
		if($update1){//Jika berhasil update
			echo "<script>window.location=('check_edit.php?id=$id')</script>";
			exit();
		}
		else{
			echo "<script>window.alert('Data Gagal Diperbarui');
			window.history.back()</script>";
			exit();
		}
	}
	
	//Input Detail Nonkomodity
	elseif($task == 'detail'){
		$id	= $_GET['id'];
		//Ambil Harga Tonase
		$tonase1 	= 0;
		$tonase2 	= 0;
		$tonase3 	= 0;
		
		//mencari berat barang nonkomoditi berdasarkan id nonkomoditi
		$nc1	= executeScalar("select noncommodity_weight from noncommodity where noncommodity_id = '".$_POST['weight1']."'");
		$nc2	= executeScalar("select noncommodity_weight from noncommodity where noncommodity_id = '".$_POST['weight2']."'");
		$nc3	= executeScalar("select noncommodity_weight from noncommodity where noncommodity_id = '".$_POST['weight3']."'");
		$nc4	= executeScalar("select noncommodity_weight from noncommodity where noncommodity_id = '".$_POST['weight4']."'");
		$nc5	= executeScalar("select noncommodity_weight from noncommodity where noncommodity_id = '".$_POST['weight5']."'");
		$nc6	= executeScalar("select noncommodity_weight from noncommodity where noncommodity_id = '".$_POST['weight6']."'");
		$nc7	= executeScalar("select noncommodity_weight from noncommodity where noncommodity_id = '".$_POST['weight7']."'");
		$nc8	= executeScalar("select noncommodity_weight from noncommodity where noncommodity_id = '".$_POST['weight8']."'");
		
		//Jika Jenis pedangang sayur / buar harga berbeda
		$merchant	= executeScalar("select merchant_id from weighing where weighing_id = '".$id."'");
		$commodity 	= executeScalar("select goods_id from weighing where weighing_id = '".$id."'");
		$jenis		= mb_substr($merchant, 0, 1, 'utf-8');
		if($jenis=='B'){
			$tonase1 	= executeScalar("select pay_total from payment where pay_id = '8'");
			$tonase2 	= executeScalar("select pay_total from payment where pay_id = '9'");
			// if($merchant=='B0072'&&$commodity==2){
			// 	$tonase1 = executeScalar("select pay_total from payment where pay_id = '2'");
			// }
		}
		elseif($jenis=='S'){
			$tonase1 	= executeScalar("select pay_total from payment where pay_id = '2'");
			$tonase2 	= executeScalar("select pay_total from payment where pay_id = '3'");
		}
		elseif($jenis=='L'){
			$tonase1 	= executeScalar("select pay_total from payment where pay_id = '2'");
			$tonase2 	= executeScalar("select pay_total from payment where pay_id = '3'");
		}
		
		//ambil date tarif tonase yg ada di db
		
		$tarifmin 		= executeScalar("select pay_total from payment where pay_id = '1'");
		$tonase3 		= $tonase1+$tonase2;

		$weight_in		= executeScalar("select weight_in from weighing where weighing_id = '".$id."'");
		$weight_out		= executeScalar("select weight_out from weighing where weighing_id = '".$id."'");
		$rafaksi		= executeScalar("select rafaksi from weighing where weighing_id = '".$id."'");
		$laborer		= executeScalar("select laborer_sts from weighing where weighing_id = '".$id."'");
		
		//update table weighing
		$noncommodity 	= 0;
		$netto			= 0;
		$price			= 0;
		
		//Hitung total nonkomoditi
		$noncommodity 	= ($nc1*$_POST['count1'])+($nc2*$_POST['count2'])+($nc3*$_POST['count3'])+($nc4*$_POST['count4'])
		+($nc5*$_POST['count5'])+($nc6*$_POST['count6'])+($nc7*$_POST['count7'])+($nc8*$_POST['count8']);
		$noncommodity 	= intval($noncommodity);
		
		if($_POST['weight1']==8||$_POST['weight2']==8||$_POST['weight3']==8||$_POST['weight4']==8||$_POST['weight5']==8||$_POST['weight6']==8||$_POST['weight7']==8||$_POST['weight8']==8){
			
		}
		
		//cek jika berat nonkomodity >= berat netto
		$netto		= executeScalar("select netto from weighing where weighing_id = '".$id."'");
		if($noncommodity >= $netto){
			echo "<script>window.alert('Berat Nonkomoditi lebih besar dari netto, Tolong Dicek lagi')</script>;
			<script>window.history.back()</script>";
			exit();
		}
		
		//cari tau apakah id nonkomoditi sudah ada d database
		$ada	= executeScalar("select count(weighing_id) from weighing_detail where weighing_id='".$id."'");
		//Jika data nonkomoditi sudah Ada d database (maka update data)
		if($ada>0){
			$update = mysql_query("update weighing_detail set noncommodity1 = '".$_POST['weight1']."',
															count1			= '".$_POST['count1']."',
															noncommodity2	= '".$_POST['weight2']."',
															count2			= '".$_POST['count2']."',
															noncommodity3	= '".$_POST['weight3']."',
															count3			= '".$_POST['count3']."',
															noncommodity4	= '".$_POST['weight4']."',
															count4			= '".$_POST['count4']."',
															noncommodity5	= '".$_POST['weight5']."',
															count5			= '".$_POST['count5']."',
															noncommodity6	= '".$_POST['weight6']."',
															count6			= '".$_POST['count6']."',
															noncommodity7	= '".$_POST['weight7']."',
															count7			= '".$_POST['count7']."',
															noncommodity8	= '".$_POST['weight8']."',
															count8			= '".$_POST['count8']."'
														where weighing_id 	= '".$id."'");
			if($update){
				//Jika nota telah dipecah
				$sts = executeScalar("select weighing_sts2 from weighing where weighing_id = '".$id."'");
				if($sts=='Pecahan'||$sts=='Gabungan'){
					//Jika ada rafaksi atau tidak
					if($rafaksi!=0||$rafaksi!=''){
						$netto 	= $netto-$noncommodity-$rafaksi;
					}
					else{
						$netto 	= $netto-$noncommodity;
					}
				}
				else{
					//Jika ada rafaksi atau tidak
					if($rafaksi!=0||$rafaksi!=''){
						$netto 	= $weight_in-$weight_out-$noncommodity-$rafaksi;
					}
					else{
						$netto 	= $weight_in-$weight_out-$noncommodity;
					}
				}
				
				//jika mitra status tidak
				if($laborer=='Tidak'){
					$total1	= $netto*$tonase1;
					$total2	= $netto*$tonase1;
				}
				else{
					$total1	= $netto*$tonase3;
					$total2	= $netto*$tonase3;
				}
				
				//menghitung netto & total bayar
				//Jika total bayar dibawah 15.000, maka akan dikenakan tarin min (Rp 15.000)
				if($total1>$tarifmin){
					$total1 = $total1;
				}
				else{
					$total1 = $tarifmin;
				}
				$update2 = mysql_query("update weighing set noncommodity = '".$noncommodity."',
															netto		= '".$netto."',
															cost		= '".$total1."',
															cost2		= '".$total2."'
														where weighing_id = '".$id."'");
				if($update2){
					echo "<script>window.location=('check_edit.php?id=$id')</script>";
					exit();
				}
				else{
					echo "<script>window.alert('Data Gagal 1');
					window.history.back()</script>";
					exit();
				}
			}
			else{
				echo "<script>window.alert('Data Gagal 2');
				window.history.back()</script>";
				exit();
			}
		}
		//Jika data nonkomoditi belum Ada d database (insert data)
		else{
			//simpan detail nonkomodity
			$insert = mysql_query("INSERT INTO `weighing_detail` (`weighing_id`, `noncommodity1`, 
			`count1`, `noncommodity2`, `count2`, `noncommodity3`, `count3`, `noncommodity4`, `count4`, 
			`noncommodity5`, `count5`, `noncommodity6`, `count6`, `noncommodity7`, `count7`, 
			`noncommodity8`, `count8`) 
			VALUES ('".$id."', '".$_POST['weight1']."', '".$_POST['count1']."', '".$_POST['weight2']."', 
			'".$_POST['count2']."', '".$_POST['weight3']."', '".$_POST['count3']."', '".$_POST['weight4']."', 
			'".$_POST['count4']."', '".$_POST['weight5']."', '".$_POST['count5']."', '".$_POST['weight6']."', 
			'".$_POST['count6']."', '".$_POST['weight7']."', '".$_POST['count7']."', '".$_POST['weight8']."', 
			'".$_POST['count8']."')");
			
			if($insert){//jika berhasil menyimpan detail nonkomodity
				//Jika nota telah dipecah
				$sts	= executeScalar("select weighing_sts2 from weighing where weighing_id = '".$id."'");
				if($sts=='Pecahan'||$sts=='Gabungan'){
					$netto		= executeScalar("select netto from weighing where weighing_id = '".$id."'");
					//Jika ada rafaksi atau tidak
					if($rafaksi!=0||$rafaksi!=''){
						$netto 	= $netto-$noncommodity-$rafaksi;
					}
					else{
						$netto 	= $netto-$noncommodity;
					}
				}
				else{
					//Jika ada rafaksi atau tidak
					if($rafaksi!=0||$rafaksi!=''){
						$netto 	= $weight_in-$weight_out-$noncommodity-$rafaksi;
					}
					else{
						$netto 	= $weight_in-$weight_out-$noncommodity;
					}
				}
				
				
				$laborer 	= executeScalar("select laborer_sts from weighing where weighing_id = '".$id."'");
				//jika mitra status tidak
				if($laborer=='Tidak'){
					$total1	= $netto*$tonase1;
					$total2	= $netto*$tonase1;
				}
				else{
					$total1	= $netto*$tonase3;
					$total2	= $netto*$tonase3;
				}
				
				//menghitung netto & total bayar
				//Jika total bayar dibawah 10.000, maka akan dikenakan tarin min (Rp 10.000)
				if($total1>$tarifmin){
					$total1 = $total1;
				}
				else{
					$total1 = $tarifmin;
				}
				
				//Update Tabel detail timbangan
				$update = mysql_query("update weighing set noncommodity = '".$noncommodity."',
															netto		= '".$netto."',
															cost		= '".$total1."',
															cost2		= '".$total2."'
													where weighing_id 	= '".$id."'");
				if($update){//jika berhasil update
					echo "<script>window.location=('check_edit.php?id=$id')</script>";
					exit();
				}
				else{//jika gagal update
					echo "<script>window.alert('Data Gagal 3');
					window.history.back()</script>";
					exit();
				}
			}
			else{//jika Gagal menyimpan detail nonkomodity
				echo "<script>window.alert('Gagal Menyimpan Detil Nonkomodity');
				window.history.back()</script>";
				exit();
			}
		}
	}
	
	//Gabung Nota
	elseif($task=='merge'){
		$id			= $_GET['wid'];
		$merchant	= $_GET['mid'];
		$tonase1 	= 0;
		$tonase2 	= 0;
		$tonase3 	= 0;
		$cost1 		= 0;
		$cost2 		= 0;
		
		//memanggil semua data nota pedagang (yg dipilih) pada hari ini
		$nopol 		= executeScalar("select nopol from weighing where weighing_id = '".$id."'");
		$date_check = executeScalar("select date_check from weighing where weighing_id = '".$id."'");
		$s 			= $date_check;
		$dt			= new DateTime($s);
		$daten 		= $dt->format('Y-m-d');
		$date_in 	= executeScalar("select date_in from weighing where weighing_id = '".$id."'");
		$date_out 	= executeScalar("select date_out from weighing where weighing_id = '".$id."'");
		$time_in 	= executeScalar("select time_in from weighing where weighing_id = '".$id."'");
		$time_out 	= executeScalar("select time_out from weighing where weighing_id = '".$id."'");
		$goods 		= executeScalar("select goods_id from weighing where merchant_id = '".$merchant."' and weighing_id = '".$id."'");
		$laborer 	= executeScalar("select laborer_sts from weighing where merchant_id = '".$merchant."' and weighing_id = '".$id."'");
		$name	 	= executeScalar("select merchant_name from merchant where merchant_id = '".$merchant."'");
		$weight_in	= executeScalar("select sum(weight_in) from weighing where merchant_id = '".$merchant."' and weighing_sts = 'Keluar' and DATE(date_check) = '".$daten."'");
		$weight_out = executeScalar("select sum(weight_out) from weighing where merchant_id = '".$merchant."' and weighing_sts = 'Keluar' and DATE(date_check) = '".$daten."'");
		$noncommodity = executeScalar("select sum(noncommodity) from weighing where merchant_id = '".$merchant."' and weighing_sts = 'Keluar' and DATE(date_check) = '".$daten."'");
		$netto		= executeScalar("select sum(netto) from weighing where merchant_id = '".$merchant."' and weighing_sts = 'Keluar' and DATE(date_check) = '".$daten."'");
		$total 		= executeScalar("select sum(cost2) from weighing where merchant_id = '".$merchant."' and weighing_sts = 'Keluar' and DATE(date_check) = '".$daten."'");
		
		//Jika Jenis pedangang sayur / buar harga berbeda
		$jenis		= mb_substr($merchant, 0, 1, 'utf-8');
		if($jenis=='B'){
			$tonase1 	= executeScalar("select pay_total from payment where pay_id = '8'");
			$tonase2 	= executeScalar("select pay_total from payment where pay_id = '9'");
			// if($merchant=='B0072'&&$goods==2){
			// 	$tonase1 = executeScalar("select pay_total from payment where pay_id = '2'");
			// }
		}
		elseif($jenis=='S'){
			$tonase1 	= executeScalar("select pay_total from payment where pay_id = '2'");
			$tonase2 	= executeScalar("select pay_total from payment where pay_id = '3'");
		}
		elseif($jenis=='L'){
			$tonase1 	= executeScalar("select pay_total from payment where pay_id = '2'");
			$tonase2 	= executeScalar("select pay_total from payment where pay_id = '3'");
		}
		$tarifmin 	= executeScalar("select pay_total from payment where pay_id = '1'");
		$tonase3 	= $tonase1+$tonase2;
		
		//Jika Total Dibawah Tarif Min
		if($total<$tarifmin){
			$cost1 = $tarifmin;
			$cost2 = $total;
		}else{
			$cost1 = $total;
			$cost2 = $total;
		}
		
		//ambil id nota yg digabung
		$reffer	= executeScalar("select weighing_id from weighing where weighing_id = '".$id."'");
		
		//Membuat data transaksi timbangan baru
		$insert = mysql_query("INSERT INTO `weighing` (`weighing_id`, `nopol`, `weight_in`, `weight_out`, 
			`noncommodity`, `netto`, `merchant_id`, `goods_id`, `date_in`, `date_out`, `date_check`, `time_in`, `time_out`, 
			`checker_id`, `laborer_sts`, `cost`, `cost2`, `weighing_sts`, `weighing_sts2`, `reffer`) 
			VALUES ('', '".$nopol."', '".$weight_in."', '".$weight_out."', '".$noncommodity."', '".$netto."', 
			'".$merchant."', '".$goods."', '".$date_in."', '".$date_out."', '".$date_check."', '".$time_in."', '".$time_out."', 
			'".$checker."', '".$laborer."', '".$cost1."', '".$cost2."', 'Keluar', 'Gabungan', '".$reffer."')");
		if($insert){
			//Ambil weighing_id dr query yg dilakukan sebelumnya
			$wid	= mysql_insert_id();
			//update status transaksi yg telah digabung
			$update = mysql_query("update weighing set weighing_sts 	= 'Batal',
														weighing_sts2 	= 'Digabung',
														reffer			= '".$wid."'
													where merchant_id	= '".$merchant."' and
														weighing_sts 	= 'Keluar' and
														DATE(date_check)= '".$daten."' and
														weighing_id		!= '".$wid."'");
			//update laborer_fee_weighing_id nota yg digabung menjadi id nota yg gabungan/terbaru
			$update2 = mysql_query("update laborer_fee l, weighing w set l.weighing_id 	= '".$wid."'
																	where l.weighing_id = w.weighing_id and
																		w.merchant_id	= '".$merchant."' and
																		weighing_sts2 	= 'Digabung' and
																		DATE(date_check)= '".$daten."'");
			if($update&&$update2){//jika update sts transaksi & mitra berhasil
				echo "<script>window.location=('check_edit.php?id=$wid')</script>";
				exit();
			}
			else{//Jika update gagal
				echo "<script>window.alert('Data Gagal'); 
				window.history.back()</script>";
				exit();
			}
		}
		else{
			echo "<script>window.alert('Data Gagal');
			window.history.back()</script>";
			exit();
		}
	}
	
	//Pecah Nota
	elseif($task=='breakdown'){
		$id			= $_GET['id'];
		$sts		= executeScalar("select weighing_sts2 from weighing where weighing_id = '".$id."'");
		if($sts!='Dipecah'){
			$mc1		= $_POST['mc1'];
			$mc2		= $_POST['mc2'];
			$mc3		= $_POST['mc3'];
			$mc4		= $_POST['mc4'];
			$mc5		= $_POST['mc5'];
			$mc6		= $_POST['mc6'];
			$mc7		= $_POST['mc7'];
			$mc8		= $_POST['mc8'];
			$mc9		= $_POST['mc9'];
			$mc10		= $_POST['mc10'];
			$n1			= $_POST['n1'];
			$n2			= $_POST['n2'];
			$n3			= $_POST['n3'];
			$n4			= $_POST['n4'];
			$n5			= $_POST['n5'];
			$n6			= $_POST['n6'];
			$n7			= $_POST['n7'];
			$n8			= $_POST['n8'];
			$n9			= $_POST['n9'];
			$n10		= $_POST['n10'];
			$merchant	= executeScalar("select merchant_id from weighing where weighing_id = '".$id."'");
			
			//Cek Jika ada berat barang yg tidak ada mana pedagangnnya
			if($n1!=0&&$mc1==''||$n2!=0&&$mc2==''||$n3!=0&&$mc3==''||$n4!=0&&$mc4==''||$n5!=0&&$mc5==''||
			$n6!=0&&$mc6==''||$n7!=0&&$mc7==''||$n8!=0&&$mc8==''||$n9!=0&&$mc9==''||$n10!=0&&$mc10==''){
				echo "<script>window.alert('Nama pedagang di dalam pecah nota kurang, mohon di cek lagi');
				window.history.back()</script>";
				exit();
			}
			
			//Cek jika pedagang awal tidak ada namanya di dalam pecah nota
			if($mc1==$merchant||$mc2==$merchant||$mc3==$merchant||$mc4==$merchant||$mc5==$merchant||
			$mc6==$merchant||$mc7==$merchant||$mc8==$merchant||$mc9==$merchant||$mc10==$merchant){
				//Netto toleransi 0,5% dr netto awal
				$nettotal 	= 0;
				$netto2 	= 0;
				$toleran 	= 0;
				$netto		= executeScalar("select netto from weighing where weighing_id = '".$id."'");
				$toleran 	= intval($netto*0.5/100);
				$netto2		= $netto-$toleran;
				$nettotal 	= $n1+$n2+$n3+$n4+$n5+$n6+$n7+$n8+$n9+$n10;
				
				//Jika total berat yg dipecah sesuai dgn batas toleransi
				if($nettotal>=$netto2&&$nettotal<=$netto){
					//update status transaksi yg lama
					$update = mysql_query("update weighing set weighing_sts = 'Batal',
															weighing_sts2 	= 'Dipecah'
														where weighing_id	= '".$id."'");
					//update status mitra nota yg dipecah menjadi batal
					$update2 = mysql_query("update laborer_fee set laborer_fee_sts = 'Batal' where weighing_id = '".$id."'");
					
					//memanggil tarif tonase
					$cost 			= 0;
					$cost1 			= 0;
					$cost2 			= 0;
					$tonase1 		= 0;
					$tonase2 		= 0;
					$tonase3 		= 0;
					$commodity 		= executeScalar("select goods_id from weighing where weighing_id = '".$id."'");
					$nopol			= executeScalar("select nopol from weighing where weighing_id = '".$id."'");
					$weight_in		= executeScalar("select weight_in from weighing where weighing_id = '".$id."'");
					$weight_out		= executeScalar("select weight_out from weighing where weighing_id = '".$id."'");
					$nid 			= executeScalar("select noncommodity_id from weighing where weighing_id = '".$id."'");
					$noncommodity 	= executeScalar("select noncommodity from weighing where weighing_id = '".$id."'");
					$goods			= executeScalar("select goods_id from weighing where weighing_id = '".$id."'");
					$date_in		= executeScalar("select date_in from weighing where weighing_id = '".$id."'");
					$time_out		= executeScalar("select time_out from weighing where weighing_id = '".$id."'");
					$date_out		= executeScalar("select date_out from weighing where weighing_id = '".$id."'");
					$time_in		= executeScalar("select time_in from weighing where weighing_id = '".$id."'");
					$laborer 		= executeScalar("select laborer_sts from weighing where weighing_id = '".$id."'");
					$rafa	 		= executeScalar("select rafaksi from weighing where weighing_id = '".$id."'");
					
					//Jika Jenis pedangang sayur / buar harga berbeda
					$jenis			= mb_substr($merchant, 0, 1, 'utf-8');
					if($jenis=='B'){
						$tonase1 	= executeScalar("select pay_total from payment where pay_id = '8'");
						$tonase2 	= executeScalar("select pay_total from payment where pay_id = '9'");
						// if($merchant=='B0072'&&$commodity==2){
						// 	$tonase1 = executeScalar("select pay_total from payment where pay_id = '2'");
						// }
					}
					elseif($jenis=='S'){
						$tonase1 	= executeScalar("select pay_total from payment where pay_id = '2'");
						$tonase2 	= executeScalar("select pay_total from payment where pay_id = '3'");
					}
					elseif($jenis=='L'){
						$tonase1 	= executeScalar("select pay_total from payment where pay_id = '2'");
						$tonase2 	= executeScalar("select pay_total from payment where pay_id = '3'");
					}
					
					$tarifmin 	= executeScalar("select pay_total from payment where pay_id = '1'");
					$tonase3 	= $tonase1+$tonase2;
					
					if($mc1!=''&&$n1!=''){
						if($laborer=="Ya"){
							$cost = $n1*$tonase3;
						}
						else{
							$cost = $n1*$tonase1;
						}
						//jika total harga krg dari tarif min
						if($cost<$tarifmin){
							$cost1 = $tarifmin;
							$cost2 = $cost;
						}
						else{
							$cost1 = $cost;
							$cost2 = $cost;
						}
						$insert1 = mysql_query("INSERT INTO `weighing` (`weighing_id`, `nopol`, 
						`weight_in`, `weight_out`, `noncommodity_id`, `noncommodity`, `rafaksi`, `netto`, 
						`checker_id`, `merchant_id`, `goods_id`, `date_in`, `date_out`, `time_in`, `time_out`, 
						`laborer_sts`, `cost`, `cost2`, `weighing_sts`, `weighing_sts2`, `reffer`) 
						VALUES ('', '".$nopol."', '".$weight_in."', '".$weight_out."', '".$nid."', 
						'".$noncommodity."', '".$rafa."', '".$n1."', '".$checker."', '".$mc1."', '".$goods."', 
						'".$date_in."', '".$date_out."', '".$time_in."', '".$time_out."', '".$laborer."', 
						'".$cost1."', '".$cost2."', 'Keluar', 'Pecahan', '".$id."')");
					}
					if($mc2!=''&&$n2!=''){
						if($laborer=="Ya"){
							$cost = $n2*$tonase3;
						}
						else{
							$cost = $n2*$tonase1;
						}
						if($cost<$tarifmin){
							$cost1 = $tarifmin;
							$cost2 = $cost;
						}
						else{
							$cost1 = $cost;
							$cost2 = $cost;
						}
						$insert2 = mysql_query("INSERT INTO `weighing` (`weighing_id`, `nopol`, `noncommodity_id`,`netto`, 
						`checker_id`, `merchant_id`, `goods_id`, `date_in`, `date_out`, `time_in`, `time_out`, 
						`laborer_sts`, `cost`, `cost2`, `weighing_sts`, `weighing_sts2`, `reffer`) 
						VALUES ('', '".$nopol."', '".$nid."', '".$n2."', '".$checker."', '".$mc2."', '".$goods."', 
						'".$date_in."', '".$date_out."', '".$time_in."', '".$time_out."', '".$laborer."', 
						'".$cost1."', '".$cost2."', 'Keluar', 'Pecahan', '".$id."')");
					}
					if($mc3!=''&&$n3!=''){
						if($laborer=="Ya"){
							$cost = $n3*$tonase3;
						}
						else{
							$cost = $n3*$tonase1;
						}
						if($cost<$tarifmin){
							$cost1 = $tarifmin;
							$cost2 = $cost;
						}
						else{
							$cost1 = $cost;
							$cost2 = $cost;
						}
						$insert3 = mysql_query("INSERT INTO `weighing` (`weighing_id`, `nopol`, `noncommodity_id`, `netto`, 
						`checker_id`, `merchant_id`, `goods_id`, `date_in`, `date_out`, `time_in`, `time_out`, 
						`laborer_sts`, `cost`, `cost2`, `weighing_sts`, `weighing_sts2`, `reffer`) 
						VALUES ('', '".$nopol."', '".$nid."', '".$n3."', '".$checker."', '".$mc3."', '".$goods."', 
						'".$date_in."', '".$date_out."', '".$time_in."', '".$time_out."', '".$laborer."', 
						'".$cost1."', '".$cost2."', 'Keluar', 'Pecahan', '".$id."')");
					}
					if($mc4!=''&&$n4!=''){
						if($laborer=="Ya"){
							$cost = $n4*$tonase3;
						}
						else{
							$cost = $n4*$tonase1;
						}
						if($cost<$tarifmin){
							$cost1 = $tarifmin;
							$cost2 = $cost;
						}
						else{
							$cost1 = $cost;
							$cost2 = $cost;
						}
						$insert4 = mysql_query("INSERT INTO `weighing` (`weighing_id`, `nopol`, `noncommodity_id`,`netto`, 
						`checker_id`, `merchant_id`, `goods_id`, `date_in`, `date_out`, `time_in`, `time_out`, 
						`laborer_sts`, `cost`, `cost2`, `weighing_sts`, `weighing_sts2`, `reffer`) 
						VALUES ('', '".$nopol."', '".$nid."', '".$n4."', '".$checker."', '".$mc4."', '".$goods."', 
						'".$date_in."', '".$date_out."', '".$time_in."', '".$time_out."', '".$laborer."', 
						'".$cost1."', '".$cost2."', 'Keluar', 'Pecahan', '".$id."')");
					}
					if($mc5!=''&&$n5!=''){
						if($laborer=="Ya"){
							$cost = $n5*$tonase3;
						}
						else{
							$cost = $n5*$tonase1;
						}
						if($cost<$tarifmin){
							$cost1 = $tarifmin;
							$cost2 = $cost;
						}
						else{
							$cost1 = $cost;
							$cost2 = $cost;
						}
						$insert5 = mysql_query("INSERT INTO `weighing` (`weighing_id`, `nopol`, `noncommodity_id`, `netto`, 
						`checker_id`, `merchant_id`, `goods_id`, `date_in`, `date_out`, `time_in`, `time_out`, 
						`laborer_sts`, `cost`, `cost2`, `weighing_sts`, `weighing_sts2`, `reffer`) 
						VALUES ('', '".$nopol."', '".$nid."', '".$n5."', '".$checker."', '".$mc5."', '".$goods."', 
						'".$date_in."', '".$date_out."', '".$time_in."', '".$time_out."', '".$laborer."', 
						'".$cost1."', '".$cost2."', 'Keluar', 'Pecahan', '".$id."')");
					}
					if($mc6!=''&&$n6!=''){
						if($laborer=="Ya"){
							$cost = $n6*$tonase3;
						}
						else{
							$cost = $n6*$tonase1;
						}
						if($cost<$tarifmin){
							$cost1 = $tarifmin;
							$cost2 = $cost;
						}
						else{
							$cost1 = $cost;
							$cost2 = $cost;
						}
						$insert6 = mysql_query("INSERT INTO `weighing` (`weighing_id`, `nopol`, `noncommodity_id`,  `netto`, 
						`checker_id`, `merchant_id`, `goods_id`, `date_in`, `date_out`, `time_in`, `time_out`, 
						`laborer_sts`, `cost`, `cost2`, `weighing_sts`, `weighing_sts2`, `reffer`) 
						VALUES ('', '".$nopol."', '".$nid."', '".$n6."', '".$checker."', '".$mc6."', '".$goods."', 
						'".$date_in."', '".$date_out."', '".$time_in."', '".$time_out."', '".$laborer."', 
						'".$cost1."', '".$cost2."', 'Keluar', 'Pecahan', '".$id."')");
					}
					if($mc7!=''&&$n7!=''){
						if($laborer=="Ya"){
							$cost = $n7*$tonase3;
						}
						else{
							$cost = $n7*$tonase1;
						}
						if($cost<$tarifmin){
							$cost1 = $tarifmin;
							$cost2 = $cost;
						}
						else{
							$cost1 = $cost;
							$cost2 = $cost;
						}
						$insert7 = mysql_query("INSERT INTO `weighing` (`weighing_id`, `nopol`, `noncommodity_id`, `netto`, 
						`checker_id`, `merchant_id`, `goods_id`, `date_in`, `date_out`, `time_in`, `time_out`, 
						`laborer_sts`, `cost`, `cost2`, `weighing_sts`, `weighing_sts2`, `reffer`) 
						VALUES ('', '".$nopol."', '".$nid."', '".$n7."', '".$checker."', '".$mc7."', '".$goods."', 
						'".$date_in."', '".$date_out."', '".$time_in."', '".$time_out."', '".$laborer."', 
						'".$cost1."', '".$cost2."', 'Keluar', 'Pecahan', '".$id."')");
					}
					if($mc8!=''&&$n8!=''){
						if($laborer=="Ya"){
							$cost = $n8*$tonase3;
						}
						else{
							$cost = $n8*$tonase1;
						}
						if($cost<$tarifmin){
							$cost1 = $tarifmin;
							$cost2 = $cost;
						}
						else{
							$cost1 = $cost;
							$cost2 = $cost;
						}
						$insert8 = mysql_query("INSERT INTO `weighing` (`weighing_id`, `nopol`, `noncommodity_id`, `netto`, 
						`checker_id`, `merchant_id`, `goods_id`, `date_in`, `date_out`, `time_in`, `time_out`, 
						`laborer_sts`, `cost`, `cost2`, `weighing_sts`, `weighing_sts2`, `reffer`) 
						VALUES ('', '".$nopol."', '".$nid."', '".$n8."', '".$checker."', '".$mc8."', '".$goods."', 
						'".$date_in."', '".$date_out."', '".$time_in."', '".$time_out."', '".$laborer."', 
						'".$cost1."', '".$cost2."', 'Keluar', 'Pecahan', '".$id."')");
					}
					if($mc9!=''&&$n9!=''){
						if($laborer=="Ya"){
							$cost = $n9*$tonase3;
						}
						else{
							$cost = $n9*$tonase1;
						}
						if($cost<$tarifmin){
							$cost1 = $tarifmin;
							$cost2 = $cost;
						}
						else{
							$cost1 = $cost;
							$cost2 = $cost;
						}
						$insert9 = mysql_query("INSERT INTO `weighing` (`weighing_id`, `nopol`, `noncommodity_id`, `netto`, 
						`checker_id`, `merchant_id`, `goods_id`, `date_in`, `date_out`, `time_in`, `time_out`, 
						`laborer_sts`, `cost`, `cost2`, `weighing_sts`, `weighing_sts2`, `reffer`) 
						VALUES ('', '".$nopol."', '".$nid."', '".$n9."', '".$checker."', '".$mc9."', '".$goods."', 
						'".$date_in."', '".$date_out."', '".$time_in."', '".$time_out."', '".$laborer."', 
						'".$cost1."', '".$cost2."', 'Keluar', 'Pecahan', '".$id."')");
					}
					if($mc10!=''&&$n10!=''){
						if($laborer=="Ya"){
							$cost = $n10*$tonase3;
						}
						else{
							$cost = $n10*$tonase1;
						}
						if($cost<$tarifmin){
							$cost1 = $tarifmin;
							$cost2 = $cost;
						}
						else{
							$cost1 = $cost;
							$cost2 = $cost;
						}
						$insert10 = mysql_query("INSERT INTO `weighing` (`weighing_id`, `nopol`, `noncommodity_id`, `netto`, 
						`checker_id`, `merchant_id`, `goods_id`, `date_in`, `date_out`, `time_in`, `time_out`, 
						`laborer_sts`, `cost`, `cost2`, `weighing_sts`, `weighing_sts2`, `reffer`) 
						VALUES ('', '".$nopol."', '".$weight_in."', '".$weight_out."', '".$nid."', 
						'".$noncommodity."', '".$n10."', '".$checker."', '".$mc10."', '".$goods."', 
						'".$date_in."', '".$date_out."', '".$time_in."', '".$time_out."', '".$laborer."', 
						'".$cost1."', '".$cost2."', 'Keluar', 'Pecahan', '".$id."')");
					}
					if($insert1||$insert2||$insert3||$insert4||$insert5||$insert6||$insert7||$insert8||$insert9||$insert10){
						if($update){
							echo "<script>window.location=('check.php')</script>";
							exit();
						}else{
							echo "<script>window.alert('Data Gagal');
							window.history.back()</script>";
							exit();
						}
					}else{
						echo "<script>window.alert('Pecah Nota Tidak berhasil ".$insert1." ');
						window.history.back()</script>";
						exit();
					}
				}else{
					echo "<script>window.alert('Jumlah Netto yang dimasukkan tidak cocok, Toleransi selisih hanya 0,5%');
					window.history.back()</script>";
					exit();
				}
			}else{
				echo "<script>window.alert('Nama pedagang tidak ada di dalam pecah nota, mohon di cek lagi');
				window.history.back()</script>";
				exit();
			}
		}else{
			echo "<script>window.alert('Nota telah dipecah, tidak bisa dipecah lagi');
			window.history.back()</script>";
			exit();
		}
	}
	
	//Pembagian Upah Mitra
	elseif($task=='Mitra'){
		$id			= $_GET['id'];
		$total1		= 0;
		$total2		= 0;
		$tarif1 	= 0;
		$laborer 	= '';
		$N			= 0;	
		$N2			= 0;
		
		//Set tarif harga jika Jenis pedangang berbeda 
		$merchant 	= executeScalar("select merchant_id from weighing where weighing_id = '".$id."'");
		$jenis		= mb_substr($merchant, 0, 1, 'utf-8');
		$commodity 	= executeScalar("select goods_id from weighing where weighing_id = '".$id."'");
		
		//Tarif 2 adlh tarif mitra sdgkan tarif1 adalah tarif normal tanpa mitra
		if($jenis=='B'){
			$tarif1 = executeScalar("select pay_total from payment where pay_id = '8'");
			$tarif2 = executeScalar("select pay_total from payment where pay_id = '9'");
			// if($merchant=='B0072'&&$commodity==2){
			// 	$tarif1 = executeScalar("select pay_total from payment where pay_id = '2'");
			// }
		}
		elseif($jenis=='S'){
			$tarif1 = executeScalar("select pay_total from payment where pay_id = '2'");
			$tarif2 = executeScalar("select pay_total from payment where pay_id = '3'"); //Tarif Menggunakan Mitra Sayur
		}
		elseif($jenis=='L'){
			$tarif1 = executeScalar("select pay_total from payment where pay_id = '2'");
			$tarif2 = executeScalar("select pay_total from payment where pay_id = '3'");
		}

		//tarifmin adlh tarif minimal timbangan (Saat Ini 15.000)
		$tarifmin 	= executeScalar("select pay_total from payment where pay_id = '1'");
		
		//tarif3 adlh tarif normal + mitra
		$tarif3 	= $tarif1 + $tarif2;
		$netto 		= executeScalar("select netto from weighing where weighing_id = '".$id."'");
		
		//Jika total bayar dibawah 15.000, maka akan dikenakan tarin min (Rp 15.000)
		if(empty($_POST['mitra']) && empty($_POST['mandor'])){
			$laborer 	= 'Tidak';
			$total1		= $netto * $tarif1; //set lsg dgn tarik tanpa mitra
			$total2		= $total1;
			if($total1<$tarifmin){
				$total1 = $tarifmin;
			}
			$update1 = mysql_query("update laborer_fee set laborer_fee_sts = 'Batal' where weighing_id = '".$id."'");
			//Update Status Mitra = Tidak & Total Biaya tanpa mitra
			$update2 = mysql_query("update weighing set laborer_sts = 'Tidak',
														cost		= '".$total1."',
														cost2		= '".$total2."' 
												where weighing_id 	= '".$id."'");
			if($update1 && $update2){
				echo "<script>window.alert('Mitra Tidak Ada');
				window.location=('check_edit.php?id=$id')</script>";
				exit();
			}
			else{
				echo "<script>window.alert('Mitra Error');
				window.location=('check_edit.php?id=$id')</script>";
				exit();
			}
		}
		else{
			$laborer = 'Ya';
			// Pengecekan pemilihan tarif berdasarkan jenis merchant
			if($jenis=='B'){
				$mitrabagi 	= executeScalar("select pay_total from payment where pay_id = '10'"); //Tarif Mitra Dibagi Buah
				$mitrasmpn 	= executeScalar("select pay_total from payment where pay_id = '11'"); //Tarif Mitra Disimpan Buah
				$mandorbagi = executeScalar("select pay_total from payment where pay_id = '12'"); //Tarif Mandor DiBagi Buah
				$mandorsmpn	= executeScalar("select pay_total from payment where pay_id = '13'"); //Tarif Mandor Disimpan Buah
				$total1		= $netto*$tarif3;
			}
			elseif($jenis=='S'){
				$mitrabagi 	= executeScalar("select pay_total from payment where pay_id = '4'"); //Tarif Mitra Dibagi Sayur
				$mitrasmpn 	= executeScalar("select pay_total from payment where pay_id = '5'"); //Tarif Mitra Disimpan Sayur
				$mandorbagi = executeScalar("select pay_total from payment where pay_id = '6'"); //Tarif Mandor DiBagi Sayur
				$mandorsmpn	= executeScalar("select pay_total from payment where pay_id = '7'"); //Tarif Mandor Disimpan Sayur
				$total1		= $netto*$tarif3;
			}
			elseif($jenis=='L'){
				$mitrabagi 	= executeScalar("select pay_total from payment where pay_id = '4'"); //Tarif Mitra Dibagi Sayur
				$mitrasmpn 	= executeScalar("select pay_total from payment where pay_id = '5'"); //Tarif Mitra Disimpan Sayur
				$mandorbagi = executeScalar("select pay_total from payment where pay_id = '6'"); //Tarif Mandor DiBagi Sayur
				$mandorsmpn	= executeScalar("select pay_total from payment where pay_id = '7'"); //Tarif Mandor Disimpan Sayur
				$total1		= $netto*$tarif3;
			}
						
			$total2		= $total1;
			//Ambil tarif mitra
			$total4 	= $netto * $tarif2; //Total4 (Biaya Angkut) = Brt Bersih (Netto) x Tarif Mitra
			$kuli 		= 0;
			$k_dibagi 	= 0;
			$k_disimpan = 0;
			$mandor 	= 0;
			$m_dibagi 	= 0;
			$m_disimpan = 0;
			$pios 		= 0;
			
			//Tgl & Waktu Pembayaran Mitra = tgl keluar
			$date_out 	= executeScalar("select date_out from weighing where weighing_id = '".$id."'");
			$time_out 	= executeScalar("select time_out from weighing where weighing_id = '".$id."'");
			
			//hitung Tarif permitra
			if(empty($_POST['mandor'])){//jika tidak ada mandor
				$N 			= count($_POST['mitra']); //N = Jml Mitra Yg Kerja
				$N2			= 0;
				$kuli 		= $netto/$N; 
				$k_dibagi 	= $kuli*$mitrabagi;
				$k_disimpan = $kuli*$mitrasmpn;
				$pios		= $netto*($mandorbagi+$mandorsmpn);
			}
			elseif(empty($_POST['mitra'])){//jika tidak ada Kuli
				$N2 		= count($_POST['mandor']); //N2 = Jml Mandor Yg Kerja
				$N			= 0;
				$mandor 	= $netto/$N2;
				$m_dibagi 	= $mandor*$mandorbagi;
				$m_disimpan = $mandor*$mandorsmpn;
				$pios		= $netto*($mitrabagi+$mitrasmpn);
				
				for($i=0; $i < $N2; $i++){
					$mandor	= $_POST['mandor'];
					if($i==0){
						$ada	= executeScalar("select count(weighing_id) from laborer_fee where weighing_id = '".$id."'");
						//$ketemu	= mysql_num_rows($ada);
						if($ada>0){
							mysql_query("delete from laborer_fee where weighing_id = '".$id."'");
						}
						mysql_query("insert into laborer_fee (weighing_id, $mandor[$i], $mandor[$i]_save, pios_fee, laborer_fee_sts, laborer_fee_date) 
						value ('".$id."', '".$m_dibagi."', '".$m_disimpan."', '".$pios."', 'Baru', '".$date_out.' '.$time_out."' )");
					}elseif($i>0){
						mysql_query("update laborer_fee set $mandor[$i] 		= '".$m_dibagi."',
															$mandor[$i]_save	= '".$m_disimpan."'
													where weighing_id 			= '".$id."'");
					}
				}
			}
			else{//jika ada mitra & mandor
				$N 			= count($_POST['mitra']); //N = Jml Mitra Yg Kerja
				$N2 		= count($_POST['mandor']); //N2 = Jml Mandor Yg Kerja
				$kuli 		= $netto/$N; //Biaya Kuli = Tarif mitra(Rp. 12) / Jml Kuli yg Kerja 
				$k_dibagi 	= $kuli*$mitrabagi;
				$k_disimpan = $kuli*$mitrasmpn;
				$mandor 	= $netto/$N2;
				$m_dibagi 	= $mandor*$mandorbagi;
				$m_disimpan = $mandor*$mandorsmpn;
			}
			
			//Buat proses pengecekan apakah id sdh atau atau blm == NULL
			for($i=0; $i < $N; $i++){	
				$mitra	= $_POST['mitra'];
				if($i==0){//query db untuk data yg pertama
					$ada		= executeScalar("select count(weighing_id) from laborer_fee where weighing_id = '".$id."'");
					//$ketemu	= mysql_num_rows($ada);
					//jika data sudah ada
					if($ada>0){
						mysql_query("delete from laborer_fee where weighing_id = '".$id."'");
					}
					//jika tidak ada mandor
					if(empty($_POST['mandor'])){
						mysql_query("insert into laborer_fee (weighing_id, $mitra[$i], $mitra[$i]_save, pios_fee, laborer_fee_sts, laborer_fee_date) 
						value ('".$id."', '".$k_dibagi."', '".$k_disimpan."', '".$pios."', 'Baru', '".$date_out.' '.$time_out."' )");
					}else{//jika ada mandor
						mysql_query("insert into laborer_fee (weighing_id, $mitra[$i], $mitra[$i]_save, laborer_fee_sts, laborer_fee_date) 
						value ('".$id."', '".$k_dibagi."', '".$k_disimpan."', 'Baru', '".$date_out.' '.$time_out."' )");
					}
				}elseif($i>0){//query db untuk data yg kedua dst
					mysql_query("update laborer_fee set $mitra[$i] 	= '".$k_dibagi."',
													$mitra[$i]_save	= '".$k_disimpan."'
												where weighing_id 	= '".$id."'");
				}
			}

			// Input data mandor ke laborer_fee
			// Cek apakah mandor ada atau tidak
			if ($N2 > 0) {
				for($i = 0; $i < $N2; $i++){	
					$mandor	= $_POST['mandor'];
					mysql_query("update laborer_fee set $mandor[$i] 	= '".$m_dibagi."',
													$mandor[$i]_save 	= '".$m_disimpan."'
													where weighing_id 	= '".$id."'");
				}
			}else{
				echo "<script>window.alert('Mandor Tidak Ditemukan');
					window.location=('check_edit.php?id=$id')</script>";
					exit();
			}
		}
		
		//Jika total bayar dibawah 15.000, maka akan dikenakan tarin min (Rp 15.000)
		if($total1<$tarifmin){
			$total1 = $tarifmin;
		}
		
		//update status dan nilai rupiah pada nota
		$update = mysql_query("update weighing set laborer_sts	= '".$laborer."',
													cost		= '".$total1."',
													cost2		= '".$total2."'
											where weighing_id 	= '".$id."'");
		if($update){
			
			echo "<script>window.location=('check_edit.php?id=$id')</script>";
			exit();
		}
		else{
			echo "<script>window.alert('Data Mitra Gagal Dimasukkan');
			window.history.back()</script>";
			exit();
		}
	}

?>