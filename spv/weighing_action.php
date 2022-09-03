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
	//Set Datetime setting area
	date_default_timezone_set('Asia/Jakarta');
	$dt_now	= date("Y-m-d H:i:s");
	
	//Cek session role user yg masuk
	if($_SESSION['role']==''){//jika role kosong
		echo "<script>window.alert('ANda Tidak Mempunyai Hak Akses');
		window.history.back()</script>";
		exit();
	}
	$task	= $_GET['task'];

	//Spv Masuk
	if($task=='in'){
		$reason = $_POST['reason'];
		//Jika nama pedagang, barang atau tanggal masuk kendaraan kosong
		if($_POST['merchant']==''||$_POST['goods']==''||$_POST['date_in']==''){
			echo "<script>window.alert('Data pedagang, jenis barang & Tanggal Masuk belum diisi')</script>;
			<script>window.history.back()</script>";
			exit();
		}//Jika berat masuk kosong / timbangan belum stabil
		if($_POST['weight_in']==0){
			echo "<script>window.alert('Berat Masuk 0 Atau Belum Stabil, Tolong Diinputkan lagi')</script>;
			<script>window.history.back()</script>";
			exit();
		}
		$last_id	= 0;
		
		//cara mendapatkan data 1 menit yg lalu
		$currentDate= strtotime($time_now);
		$pastdate 	= $currentDate-(60*1);
		$past 		= date("H:i:s", $pastdate);
		
		//Menghindari kemasukan data double
		$double 	= mysql_query("select nopol from weighing where nopol = '".$_POST['nopol']."' and date_in = '".$date_now."' and (time_in between '".$past."' and '".$time_now."')");
		$triple 	= mysql_query("select nopol from weighing where nopol = '".$_POST['nopol']."' and weighing_sts = 'Masuk'");
		$ketemu		= mysql_num_rows($double);
		$ketemu2	= mysql_num_rows($triple);
		if($ketemu>=1||$ketemu2>=1){
			echo "<script>window.alert('Data Double Atau Mobil Masih Berada Di Dalam Area');
			window.location=('index.php')</script>";
			exit();
		}
		else{
			//Cek Apakah Pedagang Mempunyai Tagihan yg Belum Terbayar
			//Cek berdasarkan tgl keluar
			$date1		= '2016-10-01';
			$date2 		= date('Y-m-d', strtotime($_POST['date_in'] . "-3 days")); 
			//tahun 2018
			$year 	= date("y");
			$year2 	= date("Y");
			
			$count_id 	= executeScalar("select count(weighing_id) from weighing where YEAR(date_in) = '".$year2."'");
			$total_id	= $count_id+1;
			$idx 		= sprintf("%07d", $total_id);
			$id			= $year.''.$idx+4;//+3 Krn ada nota 2018 dipecah ke 2019
			
			//Simpan data ke tabel timbangan
			$insert2 	= mysql_query("INSERT INTO `weighing` (`weighing_id`, `nopol`, `weight_in`, `checker_id`, `merchant_id`, `goods_id`, 
			`date_in`, `time_in`, `laborer_sts`, `weighing_sts`, `weighing_sts2`) 
			VALUES ('".$id."', '".$_POST['nopol']."', '".$_POST['weight_in']."', '".$_POST['checker']."', '".$_POST['merchant']."', 
			'".$_POST['goods']."', '".$_POST['date_in']."', '".$_POST['time_in']."', 'Tidak', 'Masuk', 'Normal')");
			
			//Ambil Id terakhir data yg diinput mysql_query
			$last_id	= mysql_insert_id();
			if($insert2){//Jika simpan data berhasil masuk
				$bm 	= $_POST['weight_in'];
				//insert ke log spv
				$insert3= mysql_query("insert into spv_log (spv_log_id, spv_user, spv_action, spv_target, spv_reason, action_time) 
				value ('".$id."', '".$_SESSION['username']."', 'Memasukkan Kendaraan Dengan Berat Masuk -> $bm', '".$last_id."', 
				'".$reason."', '".$dt_now."')");
				if($insert3){//jika insert ke log spv berhasil
					echo "<script>window.alert('Kendaraan Masuk Berhasil')</script>;
					<script>window.location=('index.php')</script>";
					exit();
				}else{
					echo "<script>window.alert('Data log spv gagal Masuk, Silahkan dicoba lagi')</script>;
					<script>window.history.back()</script>";
					exit();
				}
			}
			else{//jika data gagal masuk ke database
				echo 'Data Gagal Masuk';
				HEADER("location: index.php");
				exit();
			}
		}
	}
	
	//Spv Masuk & Keluar
	if($task=='out'){
		$reason = $_POST['reason'];
		//jika pedagang & barang kosong Blm dibikin handlernya
		if($_POST['merchant']==''||$_POST['goods']==''||$_POST['date_in']==''){
			echo "<script>window.alert('Data pedagang, jenis barang & Tanggal Masuk belum diisi')</script>;
			<script>window.history.back()</script>";
			exit();
		}//Jika berat masuk kosong / timbangan belum stabil
		if($_POST['weight_in']==0||$_POST['weight_out']==0){
			echo "<script>window.alert('Berat Masuk / Keluar Salah, Tolong Diinputkan lagi')</script>;
			<script>window.history.back()</script>";
			exit();
		}
		
		//Menghindari kemasukan data double (cek jika ada nopol yg sama masuk dalam jangka waktu yg dekat)
		$double = mysql_query("select nopol from weighing where nopol 	= '".$_POST['nopol']."' and 
															weight_in 	= '".$_POST['weight_in']."' and 
															weight_out 	= '".$_POST['weight_out']."' and 
															date_in 	= '".$date_now."' and 
															time_in 	= '".$_POST['time_in']."' and 
															weighing_sts = 'Keluar'");
		//Jika Data nopol, tgl, jam, sts sama / double
		$ketemu	= mysql_num_rows($double);
		if($ketemu>=1){
			echo "<script>window.location=('index.php')</script>";
			exit();
		}else{
			//tahun 2018
			$year 		= date("y");
			$year2 		= date("Y");
			$count_id 	= executeScalar("select count(weighing_id) from weighing where YEAR(date_in) = '".$year2."'");
			$total_id	= $count_id+1;
			$idx 		= sprintf("%07d", $total_id);
			$id			= $year.''.$idx+4;//+3 Krn ada nota 2018 dipecah ke 2019
			
			$last_id	= 0;
			$in 		= $_POST['weight_in'];
			$out 		= $_POST['weight_out'];
			$do 		= $_POST['date_out'];
			//Jika brt Keluar !=0 / ada berat keluar
			if($out!=0||$out!='0'||$out!=''||$out!=null||$_POST['date_out']!='0000-00-00'){
				$netto		= 0;
				$total1		= 0;
				$total2		= 0;
				$tonase1 	= 0;
				$tonase3 	= 0;
				
				//Jika Jenis pedangang sayur / buar harga berbeda
				$jenis	= mb_substr($_POST['merchant'], 0, 1, 'utf-8');
				if($jenis=='B'){
					$tonase1 	= executeScalar("select pay_total from payment where pay_id = '8'");
					if($_POST['merchant']=='B0072'&&$_POST['goods']==2){
						$tonase1 = executeScalar("select pay_total from payment where pay_id = '2'");
					}
				}
				elseif($jenis=='S'){
					$tonase1 	= executeScalar("select pay_total from payment where pay_id = '2'");
				}
				elseif($jenis=='L'){
					$tonase1 	= executeScalar("select pay_total from payment where pay_id = '2'");
				}//ambil tarif miniman timbangan
				$tarifmin 	= executeScalar("select pay_total from payment where pay_id = '1'");
				
				//jika berat masuk & keluar tidak valid bm <= 0 
				if($in==0||$in=='0'||$out==0||$out=='0'){
					echo "<script>window.alert('Anda Salah Memasukkan Berat Masuk / Keluar $do')</script>;
					<script>window.history.back()</script>";
					exit();
				}
				
				//berat bersih pertama
				$netto = $in-$out;
				
				//jika mitra status tidak
				$total1	= $netto*$tonase1;
				$total2	= $netto*$tonase1;
				
				//Jika total bayar dibawah 10.000, maka akan dikenakan tarin min (Rp 10.000)
				if($total1>$tarifmin){
					$total1 = $total1;
				}
				else{
					$total1 = $tarifmin;
				}
				
				//jika keluar=0 / kluar > masuk
				if($out==0||$out>$in){
					echo "<script>window.alert('Berat Keluar Salah, Tolong Diinputkan lagi')</script>;
						<script>window.history.back()</script>";
						exit();
				}
				//update status = batal
				elseif($in==$out){
					
					$batal = mysql_query("INSERT INTO `weighing` (`weighing_id`, `nopol`, `weight_in`, `weight_out`,  
					`netto`, `checker_id`, `merchant_id`, `goods_id`, `date_in`, `date_out`, `time_in`, `time_out`, 
					`laborer_sts`, `cost`, `cost2`, `weighing_sts`, `weighing_sts2`) 
					VALUES ('".$id."', '".$_POST['nopol']."', '".$in."', '".$out."', '0', '".$_POST['checker']."', 
					'".$_POST['merchant']."', '".$_POST['goods']."', '".$_POST['date_in']."', '".$_POST['date_out']."', 
					'".$_POST['time_in']."', '".$time_now."', 'Tidak', '0', '0', 'Batal', 'Normal')");
					if($batal){
						HEADER("location: index.php");
						exit();
					}
					else{
						trigger_error("Data gagal Masuk, Silahkan dicoba lagi", E_USER_ERROR);
						HEADER("location: index.php");
						exit();
					}
				}
				elseif($in>$out){//Jika berat masuk lebih besar drpd berat keluar
					$insert1 = mysql_query("INSERT INTO `weighing` (`weighing_id`, `nopol`, `weight_in`, `weight_out`, 
					`netto`, `checker_id`, `merchant_id`, `goods_id`, `date_in`, `date_out`, `time_in`, `time_out`, 
					`laborer_sts`, `cost`, `cost2`, `weighing_sts`, `weighing_sts2`) 
					VALUES ('".$id."', '".$_POST['nopol']."', '".$in."', '".$out."', '".$netto."', '".$_POST['checker']."', 
					'".$_POST['merchant']."', '".$_POST['goods']."', '".$_POST['date_in']."', '".$_POST['date_out']."', 
					'".$_POST['time_in']."', '".$time_now."', 'Tidak', '".$total1."', '".$total2."', 'Keluar', 'Normal')");
					$last_id	= mysql_insert_id();
					if($insert1){//jika input data timbangan berhasil
						$insert2 = mysql_query("insert into spv_log (spv_log_id, spv_user, spv_action, spv_target, spv_reason, action_time) 
						value ('', '".$_SESSION['username']."', 'Memasukkan & Mengeluarkan Kendaraan Dengan BM -> $in, BK -> $out', '".$last_id."', 
						'".$reason."', '".$dt_now."')");
						if($insert2){//jika input data ke log spv
							echo "<script>window.alert('Kendaraan Masuk & Keluar Berhasil')</script>;
							<script>window.location=('index.php')</script>";
							exit();
						}else{
							echo "<script>window.alert('Data log spv gagal Masuk, Silahkan dicoba lagi')</script>;
							<script>window.history.back()</script>";
							exit();
						}
					}
					else{
						echo "<script>window.alert('Data Gagal Masuk')</script>;
						<script>window.history.back()</script>";
						exit();
					}
				}
			}
			//jika tidak ada berat keluar (Status Masuk)
			else{
				//Simpan data ke tabel timbangan
				$insert2 = mysql_query("INSERT INTO `weighing` (`weighing_id`, `nopol`, `weight_in`, `checker_id`, `merchant_id`, `goods_id`, 
					`date_in`, `time_in`, `laborer_sts`, `weighing_sts`, `weighing_sts2`) 
					VALUES ('".$id."', '".$_POST['nopol']."', '".$in."', '".$checker."', '".$_POST['merchant']."', '".$_POST['goods']."', 
					'".$_POST['date_in']."', '".$_POST['time_in']."', 'Tidak', 'Masuk', 'Normal')");
				if($insert2){//jika simpan data berhasil
					echo 'Data Telah Masuk';
					HEADER("location: index.php");
					exit();
				}
				else{//jika simpan data gagal
					echo 'Data Gagal Masuk';
					HEADER("location: index.php");
					exit();
				}
			}
		}
	}

	//Kendaraan Keluar
	elseif($task=='keluar'){
		$id		= $_GET['id'];
		$reason = $_POST['reason'];
		$netto	= 0;
		$total1	= 0;
		$total2	= 0;
		//memanggil tarif tonase
		$tonase3 	= 0;
		$tonase1 	= 0;
		$noncommodity = executeScalar("select noncommodity from weighing where weighing_id = '".$id."'");
		
		//Jika Jenis pedangang sayur / buar harga berbeda
		$jenis	= mb_substr($_POST['merchant'], 0, 1, 'utf-8');
		if($jenis=='B'){
			$tonase1 	= executeScalar("select pay_total from payment where pay_id = '8'");
			if($_POST['merchant']=='B0072'&&$commodity==2){
				$tonase1 = executeScalar("select pay_total from payment where pay_id = '2'");
			}
		}
		elseif($jenis=='S'){
			$tonase1 	= executeScalar("select pay_total from payment where pay_id = '2'");
		}
		elseif($jenis=='L'){
			$tonase1 	= executeScalar("select pay_total from payment where pay_id = '2'");
		}
		
		$tonase2 	= executeScalar("select pay_total from payment where pay_id = '3'");
		$tarifmin 	= executeScalar("select pay_total from payment where pay_id = '1'");
		$tonase3 	= $tonase1+$tonase2;
		$weight_in 	= executeScalar("select weight_in from weighing where weighing_id = '".$id."'");
		$weightout 	= $_POST['weight_out'];
		
		//Jika berat keluar = 0
		if($weightout==0||$weightout=='0'){
			echo "<script>window.alert('Berat Keluar 0 Atau Belum Stabil, Tolong Diinputkan lagi')</script>;
			<script>window.history.back()</script>";
			exit();
		}
		
		//berat bersih pertama
		$netto = $weight_in-$weightout;
		
		//jika mitra status tidak
		$total1	= $netto*$tonase1;
		$total2	= $netto*$tonase1;
		
		//Jika total bayar dibawah 10.000, maka akan dikenakan tarin min (Rp 10.000)
		if($total1>$tarifmin){
			$total1 = $total1;
		}else{
			$total1 = $tarifmin;
		}
		
		//ambil berat masuk kendaraan
		$cekweight	= executeScalar("select weight_in from weighing where weighing_id = '".$id."'");
		
		//jika berat masuk < drpd berat keluar
		if($cekweight<$weightout){
			echo "<script>window.alert('Berat Keluar Salah, Tolong Diinputkan lagi')</script>;
			<script>window.history.back()</script>";
			exit();
		}//jika berat masuk = berat keluar & selisih sekitar 10-20kg
		elseif($cekweight==$weightout||$netto==10||$netto==-10){
			//update status = batal
			$batal = mysql_query("update weighing set weight_out = '".$weightout."', weighing_sts = 'Batal' 
			where weighing_id = '".$id."'");
			if($batal){//jika berhasil update status batal
				$update = mysql_query("update weighing set nopol = '".$_POST['nopol']."',
											weight_out		= '".$weightout."',
											netto			= '0',
											merchant_id		= '".$_POST['merchant']."',
											goods_id		= '".$_POST['goods']."',
											date_out		= '".$date_now."',
											time_out		= '".$time_now."',
											laborer_sts		= 'Tidak',
											cost			= '0',
											cost2			= '0',
											weighing_sts	= 'Batal'
										where weighing_id 	= '".$id."'");
				if($update){//jika update berhasil
					$insert2 = mysql_query("insert into spv_log (spv_log_id, spv_user, spv_action, spv_target, spv_reason, action_time) 
					value ('', '".$_SESSION['username']."', 'Mengeluarkan Kendaraan Dengan Berat Keluar -> $weightout', '".$last_id."', 
					'".$reason."', '".$dt_now."')");
					if($insert2){//jika insert data berhasil
						echo "<script>window.alert('Proses Mengeluarkan Kendaraan Berhasil')</script>;
						<script>window.location=('index.php')</script>";
						exit();
					}else{//jika insert data gagal
						echo "<script>window.alert('Data log spv gagal Masuk, Silahkan dicoba lagi')</script>;
						<script>window.history.back()</script>";
						exit();
					}
				}
				else{
					echo "<script>window.alert('Data gagal Masuk, Silahkan dicoba lagi')</script>;
					<script>window.history.back()</script>";
					exit();
				}
			}
		}
		//update weighing
		$update1 = mysql_query("update weighing set nopol 	= '".$_POST['nopol']."',
											weight_out		= '".$weightout."',
											netto			= '".$netto."',
											merchant_id		= '".$_POST['merchant']."',
											goods_id		= '".$_POST['goods']."',
											date_out		= '".$date_now."',
											time_out		= '".$time_now."',
											laborer_sts		= 'Tidak',
											cost			= '".$total1."',
											cost2			= '".$total2."',
											weighing_sts	= 'Keluar'
										where weighing_id 	= '".$id."'");
		if($update1){
			HEADER("location: index.php");
			exit();
		}
		else{
			echo "<script>window.alert('Data gagal Masuk, Silahkan dicoba lagi')</script>;
			<script>window.history.back()</script>";
			exit();
		}
	}
	
	//Kendaraan Keluar dengan kir
	elseif($task=='kir'){
		$id		= $_GET['id'];
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
			$tonase1 	= executeScalar("select pay_total from payment where pay_id = '8'");
			if($_POST['merchant']=='B0072'&&$commodity==2){
				$tonase1 = executeScalar("select pay_total from payment where pay_id = '2'");
			}
		}
		elseif($jenis=='S'){
			$tonase1 	= executeScalar("select pay_total from payment where pay_id = '2'");
		}
		elseif($jenis=='L'){
			$tonase1 	= executeScalar("select pay_total from payment where pay_id = '2'");
		}
		$tonase2 	= executeScalar("select pay_total from payment where pay_id = '3'");
		$tarifmin 	= executeScalar("select pay_total from payment where pay_id = '1'");
		$tonase3 	= $tonase1+$tonase2;
		
		if($noncommodity!=0||$noncommodity!=''){
			$noncommodity = $noncommodity;
		}
		else{
			$noncommodity = 0;
		}
		$weight_in 	= executeScalar("select weight_in from weighing where weighing_id = '".$id."'");
		$nopol 		= executeScalar("select nopol from weighing where weighing_id = '".$id."'");
		$kir 		= executeScalar("select transportation_weight from transportation where transportation_nopol = '".$nopol."'");
		
		//berat bersih pertama
		$netto = $weight_in-$kir-$noncommodity;
		
		//jika mitra status tidak pake mitra
		$total1	= $netto*$tonase1;
		$total2	= $netto*$tonase1;
	
		//Jika total bayar dibawah 10.000, maka akan dikenakan tarin min (Rp 10.000)
		//set total bayar
		if($total1>$tarifmin){
			$total1 = $total1;
		}
		else{
			$total1 = $tarifmin;
		}
		//Cek Berat Keluar
		$cekweight	= executeScalar("select weight_in from weighing where weighing_id = '".$id."'");
		if($cekweight<$kir){
			echo "<script>window.alert('Anda Salah Memasukkan Berat Keluar');
			window.history.back()</script>";
			exit();
		}
		elseif($cekweight==$kir){
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

	//Edit Berat Kendaraan Masuk
	if($task=='edit1'){
		$id		= $_GET['id'];
		$bm		= $_POST['weight_in'];
		$reason = $_POST['reason'];
		$in 	= executeScalar("select weight_in from weighing where weighing_id = '".$id."'");
		$sts 	= executeScalar("select weighing_sts from weighing where weighing_id = '".$id."'");
		$merchant = executeScalar("select merchant_id from weighing where weighing_id = '".$id."'");
		$laborer = executeScalar("select laborer_sts from weighing where weighing_id = '".$id."'");
		
		//cari cara agar ketika update jika sts = kluar maka lsg hitung netto
		if($sts=='Masuk'){
			//update weight in
			$update1 = mysql_query("update weighing set weight_in = '".$bm."' where weighing_id = '".$id."'");
			if($update1){
				$insert = mysql_query("insert into spv_log (spv_log_id, spv_user, spv_action, spv_target, spv_reason, action_time) 
				value ('', '".$_SESSION['username']."', 'Edit Berat Kendaraan Masuk $in -> $bm', '".$id."', 
				'".$reason."', '".$dt_now."')");
				if($insert){
					echo "<script>window.alert('Proses Pengeditan Berat Masuk Berhasil')</script>;
					<script>window.location=('edit1.php')</script>";
					exit();
				}else{
					echo "<script>window.alert('Data log spv gagal Masuk, Silahkan dicoba lagi')</script>;
					<script>window.history.back()</script>";
					exit();
				}
			}else{
				echo "<script>window.alert('Proses Perubahan gagal, Silahkan dicoba lagi')</script>;
				<script>window.history.back()</script>";
				exit();
			}
		}
		elseif($sts=='Keluar'){
			//memanggil tarif tonase
			$tonase3 = 0;
			$tonase1 = 0;
			$netto	= 0;
			$total1	= 0;
			$total2	= 0;
			
			$bk	= executeScalar("select weight_out from weighing where weighing_id = '".$id."'");
			//Jika Jenis pedangang sayur / buar harga berbeda 
			$jenis			= mb_substr($merchant, 0, 1, 'utf-8');
			if($jenis=='B'){
				$tonase1 	= executeScalar("select pay_total from payment where pay_id = '8'");
				if($_POST['merchant']=='B0072'&&$commodity==2){
					$tonase1 = executeScalar("select pay_total from payment where pay_id = '2'");
				}
			}
			elseif($jenis=='S'){
				$tonase1 	= executeScalar("select pay_total from payment where pay_id = '2'");
			}
			elseif($jenis=='L'){
				$tonase1 	= executeScalar("select pay_total from payment where pay_id = '2'");
			}
			$tonase2 	= executeScalar("select pay_total from payment where pay_id = '3'");
			$tarifmin 	= executeScalar("select pay_total from payment where pay_id = '1'");
			$tonase3 	= $tonase1+$tonase2;
			//Jika Diberi Rafaksi / nonkomoditi
			$rafa		= executeScalar("select rafaksi from weighing where weighing_id = '".$id."'");
			$nc 		= executeScalar("select noncommodity from weighing where weighing_id = '".$id."'");
			
			if($nc==0||$nc==''){
				//cek sts timbangan kedua
				$sts2	= executeScalar("select weighing_sts2 from weighing where weighing_id = '".$id."'");
				//Jika Nota Pecahan & Ada Rafaksi
				if($sts2=='Pecahan'){
					$netto 	= executeScalar("select netto from weighing where weighing_id = '".$id."'");
				}else{
					$netto 	= $bm-$bk-$rafa;
				}
			}
			//Perhitungan NC dengan Peti, Krat dan Kardus (persentase)
			elseif($nc!=0||$nc!=''){
				//Jika Nota Pecahan & Ada Rafaksi
				if($sts2=='Pecahan'){
					$netto 	= executeScalar("select netto from weighing where weighing_id = '".$id."'");
				}else{
					$netto 	= $bm-$bk-$nc-$rafa;
				}
			}
			
			//jika mitra status tidak
			if($laborer=='Tidak'){
				$total1	= $netto*$tonase1;
				$total2	= $total1;
			}else{
				$total1	= $netto*$tonase3;
				$total2	= $total1;
			}
			//Jika total bayar dibawah 10.000, maka akan dikenakan tarin min (Rp 10.000)
			if($total1>$tarifmin){
				$total1 = $total1;
			}else{
				$total1 = $tarifmin;
			}
			
			$update2 = mysql_query("update weighing set rafaksi	= '".$rafa."',
												weight_in		= '".$bm."',
												weight_out		= '".$bk."',
												netto			= '".$netto."',
												cost			= '".$total1."',
												cost2			= '".$total2."'
											where weighing_id 	= '".$id."'");
			if($update2){
				$insert = mysql_query("insert into spv_log (spv_log_id, spv_user, spv_action, spv_target, spv_reason, action_time) 
				value ('','".$_SESSION['username']."', 'Edit Berat Kendaraan Masuk $in -> $bm', '".$id."', '".$reason."', '".$dt_now."')");
				if($insert){
					echo "<script>window.alert('Proses Pengeditan Berat Masuk Berhasil')</script>;
					<script>window.location=('edit1.php')</script>";
					exit();
				}else{
					echo "<script>window.alert('Data log spv gagal Masuk, Silahkan dicoba lagi')</script>;
					<script>window.history.back()</script>";
					exit();
				}
			}else{
				echo "<script>window.alert('Proses Perubahan gagal, Silahkan dicoba lagi')</script>;
				<script>window.history.back()</script>";
				exit();
			}
		}
	}
	
	//Edit Berat Kendaraan Keluar
	if($task=='edit2'){
		$id		= $_GET['id'];
		$bk		= $_POST['weight_out'];
		$reason = $_POST['reason'];
		$bm		= executeScalar("select weight_in from weighing where weighing_id = '".$id."'");
		$out 	= executeScalar("select weight_out from weighing where weighing_id = '".$id."'");
		$merchant = executeScalar("select merchant_id from weighing where weighing_id = '".$id."'");
		$laborer = executeScalar("select laborer_sts from weighing where weighing_id = '".$id."'");
		
		//memanggil tarif tonase
		$tonase3 = 0;
		$tonase1 = 0;
		$netto	= 0;
		$total1	= 0;
		$total2	= 0;
		
		//Jika Jenis pedangang sayur / buar harga berbeda 
		$jenis	= mb_substr($merchant, 0, 1, 'utf-8');
		if($jenis=='B'){
			$tonase1 	= executeScalar("select pay_total from payment where pay_id = '8'");
			if($merchant=='B0072'&&$commodity==2){
				$tonase1 = executeScalar("select pay_total from payment where pay_id = '2'");
			}
		}
		elseif($jenis=='S'){
			$tonase1 	= executeScalar("select pay_total from payment where pay_id = '2'");
		}
		elseif($jenis=='L'){
			$tonase1 	= executeScalar("select pay_total from payment where pay_id = '2'");
		}
		$tonase2 	= executeScalar("select pay_total from payment where pay_id = '3'");
		$tarifmin 	= executeScalar("select pay_total from payment where pay_id = '1'");
		$tonase3 	= $tonase1+$tonase2;
		//Jika Diberi Rafaksi / nonkomoditi
		$rafa		= executeScalar("select rafaksi from weighing where weighing_id = '".$id."'");
		$nc 		= executeScalar("select noncommodity from weighing where weighing_id = '".$id."'");
		
		if($nc==0||$nc==''){
			//cek sts timbangan kedua
			$sts2	= executeScalar("select weighing_sts2 from weighing where weighing_id = '".$id."'");
			//Jika Nota Pecahan & Ada Rafaksi
			if($sts2=='Pecahan'){
				$netto 	= executeScalar("select netto from weighing where weighing_id = '".$id."'");
			}else{
				$netto 	= $bm-$bk-$rafa;
			}
		}
		//Perhitungan NC dengan Peti, Krat dan Kardus (persentase)
		elseif($nc!=0||$nc!=''){
			//Jika Nota Pecahan & Ada Rafaksi
			if($sts2=='Pecahan'){
				$netto 	= executeScalar("select netto from weighing where weighing_id = '".$id."'");
			}else{
				$netto 	= $bm-$bk-$nc-$rafa;
			}
		}
		
		//jika mitra status tidak
		if($laborer=='Tidak'){
			$total1	= $netto*$tonase1;
			$total2	= $total1;
		}else{
			$total1	= $netto*$tonase3;
			$total2	= $total1;
		}
		//Jika total bayar dibawah 10.000, maka akan dikenakan tarin min (Rp 10.000)
		if($total1>$tarifmin){
			$total1 = $total1;
		}else{
			$total1 = $tarifmin;
		}
		if($netto==0){
			$update = mysql_query("update weighing set rafaksi	= '".$rafa."',
												weight_out		= '".$bk."',
												netto			= '".$netto."',
												cost			= '".$total1."',
												cost2			= '".$total2."',
												weighing_sts	= 'Batal'
											where weighing_id 	= '".$id."'");
		}else{
			$update = mysql_query("update weighing set rafaksi	= '".$rafa."',
												weight_out		= '".$bk."',
												netto			= '".$netto."',
												cost			= '".$total1."',
												cost2			= '".$total2."'
											where weighing_id 	= '".$id."'");
		}
		
		if($update){
			$insert = mysql_query("insert into spv_log (spv_log_id, spv_user, spv_action, spv_target, spv_reason, action_time) 
			value ('','".$_SESSION['username']."', 'Edit Berat Kendaraan Keluar $out -> $bk', '".$id."', '".$reason."', '".$dt_now."')");
			if($insert){
				echo "<script>window.alert('Proses Pengeditan Berat Keluar Berhasil')</script>;
				<script>window.location=('edit2.php')</script>";
				exit();
			}else{
				echo "<script>window.alert('Data log spv gagal Masuk, Silahkan dicoba lagi')</script>;
				<script>window.history.back()</script>";
				exit();
			}
		}else{
			echo "<script>window.alert('Proses Perubahan gagal, Silahkan dicoba lagi')</script>;
			<script>window.history.back()</script>";
			exit();
		}
	}
	
	//Edit Berat Kendaraan Netto
	if($task=='edit3'){
		$id		= $_GET['id'];
		$bb		= $_POST['netto'];
		$reason = $_POST['reason'];
		$net 	= executeScalar("select netto from weighing where weighing_id = '".$id."'");
		$merchant = executeScalar("select merchant_id from weighing where weighing_id = '".$id."'");
		$laborer = executeScalar("select laborer_sts from weighing where weighing_id = '".$id."'");
		
		//memanggil tarif tonase
		$tonase3 = 0;
		$tonase1 = 0;
		$netto	= 0;
		$total1	= 0;
		$total2	= 0;
		
		//Jika Jenis pedangang sayur / buar harga berbeda 
		$jenis			= mb_substr($merchant, 0, 1, 'utf-8');
		if($jenis=='B'){
			$tonase1 	= executeScalar("select pay_total from payment where pay_id = '8'");
			if($merchant=='B0072'&&$commodity==2){
				$tonase1 = executeScalar("select pay_total from payment where pay_id = '2'");
			}
		}
		elseif($jenis=='S'){
			$tonase1 	= executeScalar("select pay_total from payment where pay_id = '2'");
		}
		elseif($jenis=='L'){
			$tonase1 	= executeScalar("select pay_total from payment where pay_id = '2'");
		}
		$tonase2 	= executeScalar("select pay_total from payment where pay_id = '3'");
		$tarifmin 	= executeScalar("select pay_total from payment where pay_id = '1'");
		$tonase3 	= $tonase1+$tonase2;
		$netto 		= $bb;
		
		//jika mitra status tidak
		if($laborer=='Tidak'){
			$total1	= $netto*$tonase1;
			$total2	= $total1;
		}else{
			$total1	= $netto*$tonase3;
			$total2	= $total1;
		}
		//Jika total bayar dibawah 10.000, maka akan dikenakan tarin min (Rp 10.000)
		if($total1>$tarifmin){
			$total1 = $total1;
		}else{
			$total1 = $tarifmin;
		}
		
		$update = mysql_query("update weighing set netto	= '".$netto."',
											cost			= '".$total1."',
											cost2			= '".$total2."'
										where weighing_id 	= '".$id."'");
		if($update){
			$insert = mysql_query("insert into spv_log (spv_log_id, spv_user, spv_action, spv_target, spv_reason, action_time) 
			value ('','".$_SESSION['username']."', 'Edit Berat Bersih Kendaraan $net -> $bb', '".$id."', '".$reason."', '".$dt_now."')");
			if($insert){
				echo "<script>window.alert('Proses Pengeditan Berat Bersih Berhasil')</script>;
				<script>window.location=('edit3.php')</script>";
				exit();
			}else{
				echo "<script>window.alert('Data log spv gagal Masuk, Silahkan dicoba lagi')</script>;
				<script>window.history.back()</script>";
				exit();
			}
		}else{
			echo "<script>window.alert('Proses Perubahan gagal, Silahkan dicoba lagi')</script>;
			<script>window.history.back()</script>";
			exit();
		}
	}
	
	//Edit Status Kendaraan Netto
	if($task=='edit4'){
		$id		= $_GET['id'];
		$sts1	= $_POST['status1'];
		$sts2	= $_POST['status2'];
		$reason = $_POST['reason'];
		$status1 = executeScalar("select weighing_sts from weighing where weighing_id = '".$id."'");
		$status2 = executeScalar("select weighing_sts2 from weighing where weighing_id = '".$id."'");
		$merchant = executeScalar("select merchant_id from weighing where weighing_id = '".$id."'");
		
		if($sts1=='Lunas'){
			$update = mysql_query("update weighing set weighing_sts	= '".$sts1."',
													weighing_sts2	= '".$sts2."', 
													date_pay		= '".$date_now."',
													time_pay		= '".$time_now."'
												where weighing_id 	= '".$id."'");
		}else{
			$update = mysql_query("update weighing set weighing_sts	= '".$sts1."',
													weighing_sts2	= '".$sts2."'
												where weighing_id 	= '".$id."'");
		}
		if($update){
			$insert = mysql_query("insert into spv_log (spv_log_id, spv_user, spv_action, spv_target, spv_reason, action_time) 
			value ('','".$_SESSION['username']."', 'Edit Status Nota $status1 -> $sts1 & $status2 -> $sts2 ', '".$id."', '".$reason."', '".$dt_now."')");
			if($insert){
				echo "<script>window.alert('Proses Pengeditan Status Nota Berhasil')</script>;
				<script>window.location=('edit4.php')</script>";
				exit();
			}else{
				echo "<script>window.alert('Data log spv gagal Masuk, Silahkan dicoba lagi')</script>;
				<script>window.history.back()</script>";
				exit();
			}
		}else{
			echo "<script>window.alert('Proses Perubahan gagal, Silahkan dicoba lagi')</script>;
			<script>window.history.back()</script>";
			exit();
		}
	}
	
	//Kendaraan Batal Masuk
	if($task=='Batal1'){
		$id		= $_GET['id'];
		$reason = $_POST['reason'];
		$out 	= executeScalar("select weight_in from weighing where weighing_id = '".$id."'");
		$batal 	= mysql_query("update weighing set weight_out	= '".$out."',
												netto			= '0',
												date_out		= '".$date_now."',
												cost			= '0',
												cost2			= '0',
												weighing_sts	= 'Batal'
											where weighing_id 	= '".$id."'");
		if($batal){
			$insert = mysql_query("insert into spv_log (spv_log_id, spv_user, spv_action, spv_target, spv_reason, action_time) 
			value ('', '".$_SESSION['username']."', 'Membatalkan Kendaraan Masuk', '".$id."', 
			'".$reason."', '".$dt_now."')");
			if($insert){
				echo "<script>window.location=('cancel1.php')</script>";
				exit();
			}else{
				echo "<script>window.alert('Data log spv gagal Masuk, Silahkan dicoba lagi')</script>;
				<script>window.history.back()</script>";
				exit();
			}
		}
		else{
			echo "<script>window.alert('Proses Pembatalan gagal, Silahkan dicoba lagi')</script>;
			<script>window.history.back()</script>";
			exit();
		}
	}
	
	//Kendaraan Batal Keluar Menjadi Masuk
	if($task=='Batal2'){
		$id		= $_GET['id'];
		$reason = $_POST['reason'];
		$batal 	= mysql_query("update weighing set cost	= '0',
										cost2			= '0',
										weighing_sts	= 'Masuk'
									where weighing_id 	= '".$id."'");
		if($batal){
			$insert = mysql_query("insert into spv_log (spv_log_id, spv_user, spv_action, spv_target, spv_reason, action_time) 
			value ('', '".$_SESSION['username']."', 'Membatalkan Kendaraan Keluar Menjadi Masuk', '".$id."', 
			'".$reason."', '".$dt_now."')");
			if($insert){
				echo "<script>window.location=('cancel2.php')</script>";
				exit();
			}else{
				echo "<script>window.alert('Data log spv gagal Masuk, Silahkan dicoba lagi')</script>;
				<script>window.history.back()</script>";
				exit();
			}
		}
		else{
			echo "<script>window.alert('Proses Pembatalan gagal, Silahkan dicoba lagi')</script>;
			<script>window.history.back()</script>";
			exit();
		}
	}
	
	//Kendaraan Batal Keluar
	if($task=='Batal3'){
		$id		= $_GET['id'];
		$reason = $_POST['reason'];
		$out 	= executeScalar("select weight_in from weighing where weighing_id = '".$id."'");
		$batal 	= mysql_query("update weighing set weight_out	= '".$out."',
												netto			= '0',
												cost			= '0',
												cost2			= '0',
												weighing_sts	= 'Batal'
											where weighing_id 	= '".$id."'");
		
		if($batal){
			$insert = mysql_query("insert into spv_log (spv_log_id, spv_user, spv_action, spv_target, spv_reason, action_time) 
			value ('', '".$_SESSION['username']."', 'Membatalkan Kendaraan Yang Sudah Keluar', '".$id."', 
			'".$reason."', '".$dt_now."')");
			if($insert){
				echo "<script>window.location=('cancel2.php')</script>";
				exit();
			}else{
				echo "<script>window.alert('Data log spv gagal Masuk, Silahkan dicoba lagi')</script>;
				<script>window.history.back()</script>";
				exit();
			}
		}else{
			echo "<script>window.alert('Proses Pembatalan gagal, Silahkan dicoba lagi')</script>;
			<script>window.history.back()</script>";
			exit();
		}
	}
	
	//Kendaraan Batal Bayar
	if($task=='Batal4'){
		$id		= $_GET['id'];
		$reason = $_POST['reason'];
		$batal 	= mysql_query("update weighing set weighing_sts = 'Keluar', weighing_sts3 = null where weighing_id = '".$id."'");
		
		if($batal){
			$cost 	= executeScalar("select cost from weighing where weighing_id = '".$id."'");
			//cari cara agar mengupdate ko & km nya jg
			$ko_id 	= executeScalar("select ko_id from weighing where weighing_id = '".$id."'");
			if($ko_id==null){
				
			}else{//update ko
				$ko_total 	= executeScalar("select ko_total from ko where ko_id = '".$ko_id."'");
				$total_new	= $ko_total-$cost;
				mysql_query("update ko set ko_total = '".$total_new."' where ko_id = '".$ko_id."'");
				mysql_query("update weighing set ko_id is null where weighing_id = '".$id."'");
			}
			$km_id 	= executeScalar("select km_id from weighing where weighing_id = '".$id."'");
			if(empty($km_id)){
				
			}else{//update km
				$km_total 	= executeScalar("select km_total from km where km_id = '".$km_id."'");
				$km_cash 	= executeScalar("select km_cash from km where km_id = '".$km_id."'");
				$total_new	= $km_total-$cost;
				$cash_new	= $km_cash-$cost;
				mysql_query("update km set km_total = '".$total_new."', km_cash = '".$cash_new."' where km_id = '".$km_id."'");
			}
			$update = mysql_query("update weighing set ko_id = '".$ko_id."', 
														km_id = '".$km_id."'
												where weighing_id	= '".$id."'");
			if($update){
				$insert = mysql_query("insert into spv_log (spv_log_id, spv_user, spv_action, spv_target, spv_reason, action_time) 
				value ('', '".$_SESSION['username']."', 'Membatalkan Pembayaran Tagihan', '".$id."', 
				'".$reason."', '".$dt_now."')");
				if($insert){
					echo "<script>window.location=('cancel3.php')</script>";
					exit();
				}else{
					echo "<script>window.alert('Data log spv gagal Masuk, Silahkan dicoba lagi')</script>;
					<script>window.history.back()</script>";
					exit();
				}
			}else{
				echo "<script>window.alert('Data log spv gagal Masuk, Silahkan dicoba lagi')</script>;
				<script>window.history.back()</script>";
				exit();
			}
		}else{
			echo "<script>window.alert('Proses Pembatalan gagal, Silahkan dicoba lagi')</script>;
			<script>window.history.back()</script>";
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
		
		//memanggil tarif tonase
		//Jika Jenis pedangang sayur / buar harga berbeda 
		$jenis		= mb_substr($_POST['merchant'], 0, 1, 'utf-8');
		if($jenis=='B'){
			$tonase1 	= executeScalar("select pay_total from payment where pay_id = '8'");
			if($_POST['merchant']=='B0072'&&$_POST['goods']==2){
				$tonase1 = executeScalar("select pay_total from payment where pay_id = '2'");
			}
		}
		elseif($jenis=='S'){
			$tonase1 	= executeScalar("select pay_total from payment where pay_id = '2'");
		}
		elseif($jenis=='L'){
			$tonase1 	= executeScalar("select pay_total from payment where pay_id = '2'");
		}
		$tonase2 	= executeScalar("select pay_total from payment where pay_id = '3'");
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
		//Jika total bayar dibawah 10.000, maka akan dikenakan tarin min (Rp 10.000)
		if($total1>$tarifmin){
			$total1 = $total1;
		}
		else{
			$total1 = $tarifmin;
		}
		//jika status pembayaran berubah
		$ceksts 	= executeScalar("select weighing_sts from weighing where weighing_id = '".$id."'");
		$cekweight	= executeScalar("select weight_in from weighing where weighing_id = '".$id."'");
		
		$update1 = mysql_query("update weighing set nopol 	= '".$_POST['nopol']."',
											noncommodity	= '".$nc."',
											rafaksi			= '".$rafa."',
											netto			= '".$netto."',
											merchant_id		= '".$_POST['merchant']."',
											goods_id		= '".$_POST['goods']."',
											cost			= '".$total1."',
											cost2			= '".$total2."'
										where weighing_id 	= '".$id."'");
		if($update1){
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
	elseif($task=='detail'){
		$id		= $_GET['id'];
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
			if($merchant=='B0072'&&$commodity==2){
				$tonase1 = executeScalar("select pay_total from payment where pay_id = '2'");
			}
		}
		elseif($jenis=='S'){
			$tonase1 	= executeScalar("select pay_total from payment where pay_id = '2'");
		}
		elseif($jenis=='L'){
			$tonase1 	= executeScalar("select pay_total from payment where pay_id = '2'");
		}
		
		$tonase2 		= executeScalar("select pay_total from payment where pay_id = '3'");
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
		if($noncommodity>=$netto){
			echo "<script>window.alert('Berat Nonkomoditi lebih besar dari netto, Tolong Dicek lagi')</script>;
			<script>window.history.back()</script>";
			exit();
		}
		
		//cari tau apakah id nonkomoditi sudah ada d database
		$ada	= executeScalar("select count(weighing_id) from weighing_detail where weighing_id='".$id."'");
		//Jika data nonkomoditi sudah Ada d database (update data)
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
			
			if($insert){
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
				if($update){
					echo "<script>window.location=('check_edit.php?id=$id')</script>";
					exit();
				}
				else{
					echo "<script>window.alert('Data Gagal 3');
					window.history.back()</script>";
					exit();
				}
			}
			else{
				echo "<script>window.alert('Data Gagal 4');
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
		$name	 	= executeScalar("select merchant_name from merchant where merchant_id = '".$merchant."'");
		$weight_in	= executeScalar("select sum(weight_in) from weighing where merchant_id = '".$merchant."' and weighing_sts = 'Keluar' and date_in = '".$date_now."'");
		$weight_out = executeScalar("select sum(weight_out) from weighing where merchant_id = '".$merchant."' and weighing_sts = 'Keluar' and date_in = '".$date_now."'");
		$noncommodity = executeScalar("select sum(noncommodity) from weighing where merchant_id = '".$merchant."' and weighing_sts = 'Keluar' and date_in = '".$date_now."'");
		$netto		= executeScalar("select sum(netto) from weighing where merchant_id = '".$merchant."' and weighing_sts = 'Keluar' and date_in = '".$date_now."'");
		$goods 		= executeScalar("select goods_id from weighing where merchant_id = '".$merchant."' and weighing_sts = 'Keluar' and date_in = '".$date_now."' limit 1");
		$time_in 	= executeScalar("select time_in from weighing where merchant_id = '".$merchant."' and weighing_sts = 'Keluar' and date_in = '".$date_now."' limit 1");
		$laborer 	= executeScalar("select laborer_sts from weighing where merchant_id = '".$merchant."' and weighing_sts = 'Keluar' and date_in = '".$date_now."' limit 1");
		$total 		= executeScalar("select sum(cost2) from weighing where merchant_id = '".$merchant."' and weighing_sts = 'Keluar' and date_in = '".$date_now."'");
		$commodity 	= executeScalar("select goods_id from weighing where weighing_id = '".$id."'");
		
		//Jika Jenis pedangang sayur / buar harga berbeda
		$jenis		= mb_substr($merchant, 0, 1, 'utf-8');
		if($jenis=='B'){
			$tonase1 	= executeScalar("select pay_total from payment where pay_id = '8'");
			if($merchant=='B0072'&&$commodity==2){
				$tonase1 = executeScalar("select pay_total from payment where pay_id = '2'");
			}
		}
		elseif($jenis=='S'){
			$tonase1 	= executeScalar("select pay_total from payment where pay_id = '2'");
		}
		elseif($jenis=='L'){
			$tonase1 	= executeScalar("select pay_total from payment where pay_id = '2'");
		}
		$tonase2 	= executeScalar("select pay_total from payment where pay_id = '3'");
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
		$reffer	= executeScalar("select weighing_id from weighing where 
								merchant_id = '".$merchant."' and
								date_in = '".$date_now."' and 
								weighing_sts 	= 'Keluar'");
		//Membuat data transaksi timbangan baru
		$insert = mysql_query("INSERT INTO `weighing` (`weighing_id`, `nopol`, `weight_in`, `weight_out`, 
			`noncommodity`, `netto`, `merchant_id`, `goods_id`, `date_in`, `date_out`, `date_check`, `time_in`, 
			`laborer_sts`, `cost`, `cost2`, `weighing_sts`, `weighing_sts2`, `reffer`) 
			VALUES ('', '".$nopol."', '".$weight_in."', '".$weight_out."', '".$noncommodity."', '".$netto."', 
			'".$merchant."', '".$goods."', '".$date_now."', '".$date_now."', '".$dt_now."', '".$time_now."', 
			'".$laborer."', '".$cost1."', '".$cost2."', 'Keluar', 'Gabungan', '".$reffer."')");
		if($insert){
			//Ambil weighing_id dr query yg dilakukan sebelumnya
			$wid	= mysql_insert_id();
			//update status transaksi yg telah digabung
			$update = mysql_query("update weighing set weighing_sts 	= 'Batal',
														weighing_sts2 	= 'Digabung',
														reffer			= '".$wid."'
													where merchant_id	= '".$merchant."' and
														weighing_sts 	= 'Keluar' and
														date_in 		= '".$date_now."' and
														weighing_id		!= '".$wid."'");
			//Ubah laborer_fee_weighing_id nota yg digabung menjadi id nota yg gabungan/terbaru
			$update2 = mysql_query("update laborer_fee l, weighing w set l.weighing_id 	= '".$wid."'
																	where l.weighing_id = w.weighing_id and
																		w.merchant_id	= '".$merchant."' and
																		weighing_sts2 	= 'Digabung' and
																		date_in 		= '".$date_now."'");
			if($update&&$update2){
				echo "<script>window.location=('check_edit.php?id=$wid')</script>";
				exit();
			}
			else{
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
				$toleran 	= intval($netto*0.5/100);
				$netto		= executeScalar("select netto from weighing where weighing_id = '".$id."'");
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
						if($merchant=='B0072'&&$commodity==2){
							$tonase1 = executeScalar("select pay_total from payment where pay_id = '2'");
						}
					}
					elseif($jenis=='S'){
						$tonase1 	= executeScalar("select pay_total from payment where pay_id = '2'");
					}
					elseif($jenis=='L'){
						$tonase1 	= executeScalar("select pay_total from payment where pay_id = '2'");
					}
					$tonase2 	= executeScalar("select pay_total from payment where pay_id = '3'");
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
						//Insert data ke tale weighing
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
					echo "<script>window.alert('Jumlah Netto yang dimasukkan tidak cocok, Toleransi selisih hanya 1%');
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
		if($jenis=='B'){
			$tarif1 	= executeScalar("select pay_total from payment where pay_id = '8'");
			if($merchant=='B0072'&&$commodity==2){
				$tarif1 = executeScalar("select pay_total from payment where pay_id = '2'");
			}
		}
		elseif($jenis=='S'){
			$tarif1 = executeScalar("select pay_total from payment where pay_id = '2'");
		}
		elseif($jenis=='L'){
			$tarif1 = executeScalar("select pay_total from payment where pay_id = '2'");
		}
		//Tarif 2 adlh tarif mitra sdgkan tarif1 adalah tarif normal tanpa mitra
		$tarif2 	= executeScalar("select pay_total from payment where pay_id = '3'"); //Tarif Menggunakan Mitra
		//tarifmin adlh tarif minimal timbangan (Saat Ini 10.000)
		$tarifmin 	= executeScalar("select pay_total from payment where pay_id = '1'");
		//tarif3 adlh tarif normal + mitra
		$tarif3 	= $tarif1+$tarif2;
		$netto 		= executeScalar("select netto from weighing where weighing_id = '".$id."'");
		
		//Jika total bayar dibawah 10.000, maka akan dikenakan tarin min (Rp 10.000)
		if(empty($_POST['mitra'])&&empty($_POST['mandor'])){
			$laborer 	= 'Tidak';
			$total1		= $netto*$tarif1; //set lsg dgn tarik tanpa mitra
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
			if($update1&&$update2){
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
			//Ambil tarif mitra & mandor
			$mitrabagi 	= executeScalar("select pay_total from payment where pay_id = '4'"); //Tarif Mitra Dibagi
			$mitrasmpn 	= executeScalar("select pay_total from payment where pay_id = '5'"); //Tarif Mitra Disimpan
			$mandorbagi = executeScalar("select pay_total from payment where pay_id = '6'"); //Tarif Mandor DiBagi
			$mandorsmpn	= executeScalar("select pay_total from payment where pay_id = '7'"); //Tarif Mandor Disimpan
			$total1		= $netto*$tarif3;
			$total2		= $total1;
			//Ambil tarif mitra
			$total4 	= $netto*$tarif2; //Total4 (Biaya Angkut) = Brt Bersih (Netto) x Tarif Mitra
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
			elseif(empty($_POST['mitra'])){//jika ada Mandor & tidak ada Mitra
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
						mysql_query("insert into laborer_fee (weighing_id, foreman, foreman_save, pios_fee, laborer_fee_sts, laborer_fee_date) 
						value ('".$id."', '".$m_dibagi."', '".$m_disimpan."', '".$pios."', 'Baru', '".$date_out.' '.$time_out."' )");
					}elseif($i>0){
						mysql_query("update laborer_fee set foreman 	= '".$m_dibagi."',
														foreman_save	= '".$m_disimpan."'
													where weighing_id 	= '".$id."'");
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
			
			//BUat proses pengecekan apakah id sdh atau atau blm == NULL
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
						mysql_query("insert into laborer_fee (weighing_id, $mitra[$i], $mitra[$i]_save, foreman, foreman_save, laborer_fee_sts, laborer_fee_date) 
						value ('".$id."', '".$k_dibagi."', '".$k_disimpan."', '".$m_dibagi."', '".$m_disimpan."', 'Baru', '".$date_out.' '.$time_out."' )");
					}
				}elseif($i>0){//query db untuk data yg kedua dst
					mysql_query("update laborer_fee set $mitra[$i] 	= '".$k_dibagi."',
													$mitra[$i]_save	= '".$k_disimpan."'
												where weighing_id 	= '".$id."'");
				}
			}
		}
		
		//Jika total bayar dibawah 10.000, maka akan dikenakan tarin min (Rp 10.000)
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