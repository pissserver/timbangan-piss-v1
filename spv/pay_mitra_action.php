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
		$t06 	= executeScalar("SELECT sum(t06) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$t14 	= executeScalar("SELECT sum(t14) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$t17 	= executeScalar("SELECT sum(t17) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$t24 	= executeScalar("SELECT sum(t24) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$t26 	= executeScalar("SELECT sum(t26) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$t29 	= executeScalar("SELECT sum(t29) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$t36 	= executeScalar("SELECT sum(t36) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$t40 	= executeScalar("SELECT sum(t40) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$m03 	= executeScalar("SELECT sum(foreman) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		//Ambil Total upah mitra yg akan disimpan
		$st06 	= executeScalar("SELECT sum(t06_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$st14 	= executeScalar("SELECT sum(t14_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$st17 	= executeScalar("SELECT sum(t17_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$st24 	= executeScalar("SELECT sum(t24_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$st26 	= executeScalar("SELECT sum(t26_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$st29 	= executeScalar("SELECT sum(t29_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$st36 	= executeScalar("SELECT sum(t36_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$st40 	= executeScalar("SELECT sum(t40_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		$sm03 	= executeScalar("SELECT sum(foreman_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
		
		//diff= Untuk mencari selisish -+ 1000 dr total upah yg akan dibagikan
		$diff1	= $t06-$_POST['t06']; //duit krg 
		$diff2	= $_POST['t06']-$t06; //duit lebih
		$diff3	= $t14-$_POST['t14']; //duit krg 
		$diff4	= $_POST['t14']-$t14; //duit lebih
		$diff5	= $t17-$_POST['t17']; //duit krg 
		$diff6	= $_POST['t17']-$t17; //duit lebih
		$diff7	= $t24-$_POST['t24']; //duit krg 
		$diff8	= $_POST['t24']-$t24; //duit lebih
		$diff9	= $t26-$_POST['t26']; //duit krg 
		$diff10	= $_POST['t26']-$t26; //duit lebih
		$diff11	= $t29-$_POST['t29']; //duit krg 
		$diff12	= $_POST['t29']-$t29; //duit lebih
		$diff13	= $t36-$_POST['t36']; //duit krg 
		$diff14	= $_POST['t36']-$t36; //duit lebih
		$diff15	= $t40-$_POST['t40']; //duit krg 
		$diff16	= $_POST['t40']-$t40; //duit lebih
		$diff17	= $_POST['m03']-$m03; //duit krg
		$diff18	= $m03-$_POST['m03']; //duit lebih
		//diff= Untuk mencari selisish -+ 1000 dr total upah yg akan disimpan
		$sdiff1	= $st06-$_POST['st06']; //duit krg 
		$sdiff2	= $_POST['st06']-$st06; //duit lebih
		$sdiff3	= $st14-$_POST['st14']; //duit krg 
		$sdiff4	= $_POST['st14']-$st14; //duit lebih
		$sdiff5	= $st17-$_POST['st17']; //duit krg 
		$sdiff6	= $_POST['st17']-$st17; //duit lebih
		$sdiff7	= $st24-$_POST['st24']; //duit krg 
		$sdiff8	= $_POST['st24']-$st24; //duit lebih
		$sdiff9	= $st26-$_POST['st26']; //duit krg 
		$sdiff10	= $_POST['st26']-$st26; //duit lebih
		$sdiff11	= $st29-$_POST['st29']; //duit krg 
		$sdiff12	= $_POST['st29']-$st29; //duit lebih
		$sdiff13	= $st36-$_POST['st36']; //duit krg 
		$sdiff14	= $_POST['st36']-$st36; //duit lebih
		$sdiff15	= $st40-$_POST['st40']; //duit krg 
		$sdiff16	= $_POST['st40']-$st40; //duit lebih 
		$sdiff18	= $sm03-$_POST['sm03']; //duit lebih
		$sdiff17	= $_POST['sm03']-$sm03; //duit krg
		
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
				$update = mysql_query("update laborer_fee2 set `fee_user` = '".$admin."',
																`fee_t06` = '".$_POST['t06']."',
																`fee_t14` = '".$_POST['t14']."',
																`fee_t17` = '".$_POST['t17']."',
																`fee_t24` = '".$_POST['t24']."',
																`fee_t26` = '".$_POST['t26']."',
																`fee_t29` = '".$_POST['t29']."',
																`fee_t36` = '".$_POST['t36']."',
																`fee_t40` = '".$_POST['t40']."',
																`fee_m03` = '".$_POST['m03']."',
																`save_t06` = '".$_POST['st06']."',
																`save_t14` = '".$_POST['st14']."',
																`save_t17` = '".$_POST['st17']."',
																`save_t24` = '".$_POST['st24']."',
																`save_t26` = '".$_POST['st26']."',
																`save_t29` = '".$_POST['st29']."',
																`save_t36` = '".$_POST['st36']."',
																`save_t40` = '".$_POST['st40']."',
																`save_m03` = '".$_POST['sm03']."'
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
				$insert = mysql_query("insert into laborer_fee2(`fee_id`, `fee_date`, `fee_user`, `fee_t06`, `fee_t14`, 
				`fee_t17`, `fee_t24`, `fee_t26`, `fee_t29`, `fee_t36`, `fee_t40`, `fee_m03`, 
				`save_t06`, `save_t14`, `save_t17`, `save_t24`, `save_t26`, `save_t29`, `save_t36`, `save_t40`, `save_m03`) 
				values('', '".$date."', '".$admin."', '".$_POST['t06']."', '".$_POST['t14']."', '".$_POST['t17']."', 
				'".$_POST['t24']."', '".$_POST['t26']."', '".$_POST['t29']."', '".$_POST['t36']."', '".$_POST['t40']."', 
				'".$_POST['m03']."', '".$_POST['st06']."', '".$_POST['st14']."', '".$_POST['st17']."', '".$_POST['st24']."', 
				'".$_POST['st26']."', '".$_POST['st29']."', '".$_POST['st36']."', '".$_POST['st40']."', '".$_POST['sm03']."')");
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