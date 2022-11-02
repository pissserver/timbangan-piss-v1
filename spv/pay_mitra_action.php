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
	//Pembayaran
	if ($task=='pay'){
		//Ambil tgl pembayaran Upah Mitra
		$date	= $_GET['date'];
		
		//Ambil Total upah mitra yg akan dibagikan
		$B001 	= executeScalar("SELECT sum(B001) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$B002 	= executeScalar("SELECT sum(B002) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$B003 	= executeScalar("SELECT sum(B003) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$B004 	= executeScalar("SELECT sum(B004) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$B005 	= executeScalar("SELECT sum(B005) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$B006 	= executeScalar("SELECT sum(B006) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$B007 	= executeScalar("SELECT sum(B007) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$B008 	= executeScalar("SELECT sum(B008) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$B009 	= executeScalar("SELECT sum(B009) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$B010 	= executeScalar("SELECT sum(B010) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$B011 	= executeScalar("SELECT sum(B011) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$B012 	= executeScalar("SELECT sum(B012) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$B013 	= executeScalar("SELECT sum(B013) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$B014 	= executeScalar("SELECT sum(B014) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$B015 	= executeScalar("SELECT sum(B015) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$S001 	= executeScalar("SELECT sum(S001) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$S002 	= executeScalar("SELECT sum(S002) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$S003 	= executeScalar("SELECT sum(S003) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$S004 	= executeScalar("SELECT sum(S004) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$S005 	= executeScalar("SELECT sum(S005) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$S006 	= executeScalar("SELECT sum(S006) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$S007 	= executeScalar("SELECT sum(S007) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$S008 	= executeScalar("SELECT sum(S008) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$S009 	= executeScalar("SELECT sum(S009) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$S010 	= executeScalar("SELECT sum(S010) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$S011 	= executeScalar("SELECT sum(S011) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$S012 	= executeScalar("SELECT sum(S012) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$S013 	= executeScalar("SELECT sum(S013) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$S014 	= executeScalar("SELECT sum(S014) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$S015 	= executeScalar("SELECT sum(S015) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$M01 	= executeScalar("SELECT sum(M01) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$M02 	= executeScalar("SELECT sum(M02) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$M03 	= executeScalar("SELECT sum(M03) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$M04 	= executeScalar("SELECT sum(M04) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		//Ambil Total upah mitra yg akan disimpan
		// $st06 	= executeScalar("SELECT sum(t06_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");

		$SB001 	= executeScalar("SELECT sum(B001_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$SB002 	= executeScalar("SELECT sum(B002_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$SB003 	= executeScalar("SELECT sum(B003_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$SB004 	= executeScalar("SELECT sum(B004_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$SB005 	= executeScalar("SELECT sum(B005_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$SB006 	= executeScalar("SELECT sum(B006_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$SB007 	= executeScalar("SELECT sum(B007_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$SB008 	= executeScalar("SELECT sum(B008_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$SB009 	= executeScalar("SELECT sum(B009_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$SB010 	= executeScalar("SELECT sum(B010_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$SB011 	= executeScalar("SELECT sum(B011_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$SB012 	= executeScalar("SELECT sum(B012_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$SB013 	= executeScalar("SELECT sum(B013_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$SB014 	= executeScalar("SELECT sum(B014_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$SB015 	= executeScalar("SELECT sum(B015_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$SS001 	= executeScalar("SELECT sum(S001_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$SS002 	= executeScalar("SELECT sum(S002_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$SS003 	= executeScalar("SELECT sum(S003_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$SS004 	= executeScalar("SELECT sum(S004_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$SS005 	= executeScalar("SELECT sum(S005_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$SS006 	= executeScalar("SELECT sum(S006_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$SS007 	= executeScalar("SELECT sum(S007_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$SS008 	= executeScalar("SELECT sum(S008_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$SS009 	= executeScalar("SELECT sum(S009_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$SS010 	= executeScalar("SELECT sum(S010_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$SS011 	= executeScalar("SELECT sum(S011_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$SS012 	= executeScalar("SELECT sum(S012_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$SS013 	= executeScalar("SELECT sum(S013_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$SS014 	= executeScalar("SELECT sum(S014_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$SS015 	= executeScalar("SELECT sum(S015_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$SM01 	= executeScalar("SELECT sum(M01_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$SM02 	= executeScalar("SELECT sum(M02_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$SM03 	= executeScalar("SELECT sum(M03_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$SM04 	= executeScalar("SELECT sum(M04_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		
		// //diff= Untuk mencari selisish -+ 1000 dr total upah yg akan dibagikan
		// $diff1	= $t06-$_POST['t06']; //duit krg 
		// $diff2	= $_POST['t06']-$t06; //duit lebih
		// $diff3	= $t14-$_POST['t14']; //duit krg 
		// $diff4	= $_POST['t14']-$t14; //duit lebih
		// $diff5	= $t17-$_POST['t17']; //duit krg 
		// $diff6	= $_POST['t17']-$t17; //duit lebih
		// $diff7	= $t24-$_POST['t24']; //duit krg 
		// $diff8	= $_POST['t24']-$t24; //duit lebih
		// $diff9	= $t26-$_POST['t26']; //duit krg 
		// $diff10	= $_POST['t26']-$t26; //duit lebih
		// $diff11	= $t29-$_POST['t29']; //duit krg 
		// $diff12	= $_POST['t29']-$t29; //duit lebih
		// $diff13	= $t36-$_POST['t36']; //duit krg 
		// $diff14	= $_POST['t36']-$t36; //duit lebih
		// $diff15	= $t40-$_POST['t40']; //duit krg 
		// $diff16	= $_POST['t40']-$t40; //duit lebih
		// $diff17	= $_POST['m03']-$m03; //duit krg
		// $diff18	= $m03-$_POST['m03']; //duit lebih
		// //diff= Untuk mencari selisish -+ 1000 dr total upah yg akan disimpan
		// $sdiff1	= $st06-$_POST['st06']; //duit krg 
		// $sdiff2	= $_POST['st06']-$st06; //duit lebih
		// $sdiff3	= $st14-$_POST['st14']; //duit krg 
		// $sdiff4	= $_POST['st14']-$st14; //duit lebih
		// $sdiff5	= $st17-$_POST['st17']; //duit krg 
		// $sdiff6	= $_POST['st17']-$st17; //duit lebih
		// $sdiff7	= $st24-$_POST['st24']; //duit krg 
		// $sdiff8	= $_POST['st24']-$st24; //duit lebih
		// $sdiff9	= $st26-$_POST['st26']; //duit krg 
		// $sdiff10	= $_POST['st26']-$st26; //duit lebih
		// $sdiff11	= $st29-$_POST['st29']; //duit krg 
		// $sdiff12	= $_POST['st29']-$st29; //duit lebih
		// $sdiff13	= $st36-$_POST['st36']; //duit krg 
		// $sdiff14	= $_POST['st36']-$st36; //duit lebih
		// $sdiff15	= $st40-$_POST['st40']; //duit krg 
		// $sdiff16	= $_POST['st40']-$st40; //duit lebih 
		// $sdiff18	= $sm03-$_POST['sm03']; //duit lebih
		// $sdiff17	= $_POST['sm03']-$sm03; //duit krg
		
		//cek jika selisih uang diterima -+ 1000
		/*if((($diff1>=0&&$diff1<=1000)||($diff2>=0&&$diff2<=1000))&&
		(($diff3>=0&&$diff3<=1000)||($diff4>=0&&$diff4<=1000))&&
		(($diff5>=0&&$diff5<=1000)||($diff6>=0&&$diff6<=1000))&&
		(($diff7>=0&&$diff7<=1000)||($diff8>=0&&$diff8<=1000))&&
		(($diff9>=0&&$diff9<=1000)||($diff10>=0&&$diff10<=1000))&&
		(($diff11>=0&&$diff11<=1000)||($diff12>=0&&$diff12<=1000))&&
		(($diff13>=0&&$diff13<=1000)||($diff14>=0&&$diff14<=1000))&&
		(($diff15>=0&&$diff15<=1000)||($diff16>=0&&$diff16<=1000))&&
		(($diff17>=0&&$diff17<=1000)||($diff18>=0&&$diff18<=1000))&&
		(($sdiff1>=0&&$sdiff1<=1000)||($sdiff2>=0&&$sdiff2<=1000))&&
		(($sdiff3>=0&&$sdiff3<=1000)||($sdiff4>=0&&$sdiff4<=1000))&&
		(($sdiff5>=0&&$sdiff5<=1000)||($sdiff6>=0&&$sdiff6<=1000))&&
		(($sdiff7>=0&&$sdiff7<=1000)||($sdiff8>=0&&$sdiff8<=1000))&&
		(($sdiff9>=0&&$sdiff9<=1000)||($sdiff10>=0&&$sdiff10<=1000))&&
		(($sdiff11>=0&&$sdiff11<=1000)||($sdiff12>=0&&$sdiff12<=1000))&&
		(($sdiff13>=0&&$sdiff13<=1000)||($sdiff14>=0&&$sdiff14<=1000))&&
		(($sdiff15>=0&&$sdiff15<=1000)||($sdiff16>=0&&$sdiff16<=1000))&&
		(($sdiff17>=0&&$sdiff17<=1000)||($sdiff18>=0&&$sdiff18<=1000))){*/
			//Cek apakah tgl pembayaran sdh ada di DB
			$ada	= executeScalar("SELECT count(fee_id) FROM laborer_fee2 where fee_date = '".$date."'");
			if($ada>0){
				//update pembayaran mitra
				$update = mysql_query("	update laborer_fee2 
										set `fee_user` = '".$admin."',
											`fee_B001` = '".$_POST['B001']."',
											`fee_B002` = '".$_POST['B002']."',
											`fee_B003` = '".$_POST['B003']."',
											`fee_B004` = '".$_POST['B004']."',
											`fee_B005` = '".$_POST['B005']."',
											`fee_B006` = '".$_POST['B006']."',
											`fee_B007` = '".$_POST['B007']."',
											`fee_B008` = '".$_POST['B008']."',
											`fee_B009` = '".$_POST['B009']."',
											`fee_B010` = '".$_POST['B010']."',
											`fee_B011` = '".$_POST['B011']."',
											`fee_B012` = '".$_POST['B012']."',
											`fee_B013` = '".$_POST['B013']."',
											`fee_B014` = '".$_POST['B014']."',
											`fee_B015` = '".$_POST['B015']."',
											`fee_S001` = '".$_POST['S001']."',
											`fee_S002` = '".$_POST['S002']."',
											`fee_S003` = '".$_POST['S003']."',
											`fee_S004` = '".$_POST['S004']."',
											`fee_S005` = '".$_POST['S005']."',
											`fee_S006` = '".$_POST['S006']."',
											`fee_S007` = '".$_POST['S007']."',
											`fee_S008` = '".$_POST['S008']."',
											`fee_S009` = '".$_POST['S009']."',
											`fee_S010` = '".$_POST['S010']."',
											`fee_S011` = '".$_POST['S011']."',
											`fee_S012` = '".$_POST['S012']."',
											`fee_S013` = '".$_POST['S013']."',
											`fee_S014` = '".$_POST['S014']."',
											`fee_S015` = '".$_POST['S015']."',
											`fee_M01` = '".$_POST['M01']."',
											`fee_M02` = '".$_POST['M02']."',
											`fee_M03` = '".$_POST['M03']."',
											`fee_M04` = '".$_POST['M04']."',
											`save_B001` = '".$_POST['SB001']."',
											`save_B002` = '".$_POST['SB002']."',
											`save_B003` = '".$_POST['SB003']."',
											`save_B004` = '".$_POST['SB004']."',
											`save_B005` = '".$_POST['SB005']."',
											`save_B006` = '".$_POST['SB006']."',
											`save_B007` = '".$_POST['SB007']."',
											`save_B008` = '".$_POST['SB008']."',
											`save_B009` = '".$_POST['SB009']."',
											`save_B010` = '".$_POST['SB010']."',
											`save_B011` = '".$_POST['SB011']."',
											`save_B012` = '".$_POST['SB012']."',
											`save_B013` = '".$_POST['SB013']."',
											`save_B014` = '".$_POST['SB014']."',
											`save_B015` = '".$_POST['SB015']."',
											`save_S001` = '".$_POST['SS001']."',
											`save_S002` = '".$_POST['SS002']."',
											`save_S003` = '".$_POST['SS003']."',
											`save_S004` = '".$_POST['SS004']."',
											`save_S005` = '".$_POST['SS005']."',
											`save_S006` = '".$_POST['SS006']."',
											`save_S007` = '".$_POST['SS007']."',
											`save_S008` = '".$_POST['SS008']."',
											`save_S009` = '".$_POST['SS009']."',
											`save_S010` = '".$_POST['SS010']."',
											`save_S011` = '".$_POST['SS011']."',
											`save_S012` = '".$_POST['SS012']."',
											`save_S013` = '".$_POST['SS013']."',
											`save_S014` = '".$_POST['SS014']."',
											`save_S015` = '".$_POST['SS015']."',
											`save_M01` = '".$_POST['SM01']."',
											`save_M02` = '".$_POST['SM02']."',
											`save_M03` = '".$_POST['SM03']."',
											`save_M04` = '".$_POST['SM04']."'
										where `fee_date` = '".$date."' ");
				if($update){
					echo "<script>window.location=('pay_mitra.php')</script>";
					exit();
				}
				else{
					echo "<script>window.alert('Update Pembayaran Gagal');
					window.history.back()</script>";
					exit();
				}
			}else{
				//Insert pembayaran mitra
				$insert = mysql_query("	insert into laborer_fee2(	`fee_id`, 
																	`fee_date`, 
																	`fee_user`, 
																	`fee_B001`, 
																	`fee_B002`, 
																	`fee_B003`, 
																	`fee_B004`, 
																	`fee_B005`, 
																	`fee_B006`, 
																	`fee_B007`, 
																	`fee_B008`, 
																	`fee_B009`, 
																	`fee_B010`, 
																	`fee_B011`, 
																	`fee_B012`, 
																	`fee_B013`, 
																	`fee_B014`, 
																	`fee_B015`, 
																	`fee_S001`, 
																	`fee_S002`, 
																	`fee_S003`, 
																	`fee_S004`, 
																	`fee_S005`, 
																	`fee_S006`, 
																	`fee_S007`, 
																	`fee_S008`, 
																	`fee_S009`, 
																	`fee_S010`, 
																	`fee_S011`, 
																	`fee_S012`, 
																	`fee_S013`, 
																	`fee_S014`, 
																	`fee_S015`, 
																	`fee_M01`, 
																	`fee_M02`, 
																	`fee_M03`, 
																	`fee_M04`, 
																	`save_B001`, 
																	`save_B002`, 
																	`save_B003`, 
																	`save_B004`, 
																	`save_B005`, 
																	`save_B006`, 
																	`save_B007`, 
																	`save_B008`, 
																	`save_B009`, 
																	`save_B010`, 
																	`save_B011`, 
																	`save_B012`, 
																	`save_B013`, 
																	`save_B014`, 
																	`save_B015`, 
																	`save_S001`, 
																	`save_S002`, 
																	`save_S003`, 
																	`save_S004`, 
																	`save_S005`, 
																	`save_S006`, 
																	`save_S007`, 
																	`save_S008`, 
																	`save_S009`, 
																	`save_S010`, 
																	`save_S011`, 
																	`save_S012`, 
																	`save_S013`, 
																	`save_S014`, 
																	`save_S015`, 
																	`save_M01`, 
																	`save_M02`, 
																	`save_M03`, 
																	`save_M04`) 
										values(	'', 
												'".$date."', 
												'".$admin."', 
												'".$_POST['B001']."',
												'".$_POST['B002']."',
												'".$_POST['B003']."',
												'".$_POST['B004']."',
												'".$_POST['B005']."',
												'".$_POST['B006']."',
												'".$_POST['B007']."',
												'".$_POST['B008']."',
												'".$_POST['B009']."',
												'".$_POST['B010']."',
												'".$_POST['B011']."',
												'".$_POST['B012']."',
												'".$_POST['B013']."',
												'".$_POST['B014']."',
												'".$_POST['B015']."',
												'".$_POST['S001']."',
												'".$_POST['S002']."',
												'".$_POST['S003']."',
												'".$_POST['S004']."',
												'".$_POST['S005']."',
												'".$_POST['S006']."',
												'".$_POST['S007']."',
												'".$_POST['S008']."',
												'".$_POST['S009']."',
												'".$_POST['S010']."',
												'".$_POST['S011']."',
												'".$_POST['S012']."',
												'".$_POST['S013']."',
												'".$_POST['S014']."',
												'".$_POST['S015']."',
												'".$_POST['M01']."',
												'".$_POST['M02']."',
												'".$_POST['M03']."',
												'".$_POST['M04']."',
												'".$_POST['SB001']."',
												'".$_POST['SB002']."',
												'".$_POST['SB003']."',
												'".$_POST['SB004']."',
												'".$_POST['SB005']."',
												'".$_POST['SB006']."',
												'".$_POST['SB007']."',
												'".$_POST['SB008']."',
												'".$_POST['SB009']."',
												'".$_POST['SB010']."',
												'".$_POST['SB011']."',
												'".$_POST['SB012']."',
												'".$_POST['SB013']."',
												'".$_POST['SB014']."',
												'".$_POST['SB015']."',
												'".$_POST['SS001']."',
												'".$_POST['SS002']."',
												'".$_POST['SS003']."',
												'".$_POST['SS004']."',
												'".$_POST['SS005']."',
												'".$_POST['SS006']."',
												'".$_POST['SS007']."',
												'".$_POST['SS008']."',
												'".$_POST['SS009']."',
												'".$_POST['SS010']."',
												'".$_POST['SS011']."',
												'".$_POST['SS012']."',
												'".$_POST['SS013']."',
												'".$_POST['SS014']."',
												'".$_POST['SS015']."',
												'".$_POST['SM01']."',
												'".$_POST['SM02']."',
												'".$_POST['SM03']."',
												'".$_POST['SM04']."')");
				if($insert){
					echo "<script>window.location=('pay_mitra.php')</script>";
					exit();
				}
				else{
					echo "<script>window.alert('Insert Pembayaran Gagal');
					window.history.back()</script>";
					exit();
				}
			}
		/*}
		else{
			echo "<script>window.alert('Batas Max Selisih Uang Rp 1.000');
			window.history.back()</script>";
			exit();
		}*/
	}
	/*//Cancel Pembayaran
	elseif ($task=='cancel'){
		$id	= $_GET['id'];
		//update status pembayaran
		$pay = mysql_query("update ko set ko_status = 'Diajukan' where ko_id = '".$id."'");
		if($pay){
			echo "<script>window.location=('pay.php')</script>";
			exit();
		}
		else{
			echo "<script>window.alert('Pembayaran Gagal');
			window.history.back()</script>";
				exit();
		}
	}
	elseif ($task=='cancelAll'){
		//update status pembayaran
		$cancel = mysql_query("update ko set ko_status = 'Diajukan' where ko_status = 'Diterima'");
		if($cancel){
			echo "<script>window.location=('pay.php')</script>";
			exit();
		}
		else{
			echo "<script>window.alert('Pembayaran Gagal');
			window.history.back()</script>";
			exit();
		}
	}*/
?>