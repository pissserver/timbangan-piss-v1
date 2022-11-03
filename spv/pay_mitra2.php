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
	
	$date		= $_GET['date'];
	$B001 		= executeScalar("SELECT sum(B001) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$B002 		= executeScalar("SELECT sum(B002) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$B003 		= executeScalar("SELECT sum(B003) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$B004 		= executeScalar("SELECT sum(B004) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$B005 		= executeScalar("SELECT sum(B005) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$B006 		= executeScalar("SELECT sum(B006) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$B007 		= executeScalar("SELECT sum(B007) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$B008 		= executeScalar("SELECT sum(B008) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$B009 		= executeScalar("SELECT sum(B009) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$B010 		= executeScalar("SELECT sum(B010) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$B011 		= executeScalar("SELECT sum(B011) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$B012 		= executeScalar("SELECT sum(B012) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$B013 		= executeScalar("SELECT sum(B013) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$B014 		= executeScalar("SELECT sum(B014) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$B015 		= executeScalar("SELECT sum(B015) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$S001 		= executeScalar("SELECT sum(S001) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$S002 		= executeScalar("SELECT sum(S002) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$S003 		= executeScalar("SELECT sum(S003) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$S004 		= executeScalar("SELECT sum(S004) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$S005 		= executeScalar("SELECT sum(S005) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$S006 		= executeScalar("SELECT sum(S006) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$S007 		= executeScalar("SELECT sum(S007) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$S008 		= executeScalar("SELECT sum(S008) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$S009 		= executeScalar("SELECT sum(S009) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$S010 		= executeScalar("SELECT sum(S010) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$S011 		= executeScalar("SELECT sum(S011) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$S012 		= executeScalar("SELECT sum(S012) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$S013 		= executeScalar("SELECT sum(S013) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$S014 		= executeScalar("SELECT sum(S014) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$S015 		= executeScalar("SELECT sum(S015) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$M01 		= executeScalar("SELECT sum(M01) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$M02 		= executeScalar("SELECT sum(M02) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$M03 		= executeScalar("SELECT sum(M03) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$M04 		= executeScalar("SELECT sum(M04) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	//$pios	 	= executeScalar("SELECT sum(pios_fee) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$SB001 		= executeScalar("SELECT sum(B001_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$SB002 		= executeScalar("SELECT sum(B002_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$SB003 		= executeScalar("SELECT sum(B003_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$SB004 		= executeScalar("SELECT sum(B004_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$SB005 		= executeScalar("SELECT sum(B005_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$SB006 		= executeScalar("SELECT sum(B006_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$SB007 		= executeScalar("SELECT sum(B007_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$SB008 		= executeScalar("SELECT sum(B008_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$SB009 		= executeScalar("SELECT sum(B009_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$SB010 		= executeScalar("SELECT sum(B010_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$SB011 		= executeScalar("SELECT sum(B011_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$SB012 		= executeScalar("SELECT sum(B012_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$SB013 		= executeScalar("SELECT sum(B013_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$SB014 		= executeScalar("SELECT sum(B014_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$SB015 		= executeScalar("SELECT sum(B015_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$SS001 		= executeScalar("SELECT sum(S001_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$SS002 		= executeScalar("SELECT sum(S002_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$SS003 		= executeScalar("SELECT sum(S003_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$SS004 		= executeScalar("SELECT sum(S004_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$SS005 		= executeScalar("SELECT sum(S005_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$SS006 		= executeScalar("SELECT sum(S006_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$SS007 		= executeScalar("SELECT sum(S007_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$SS008 		= executeScalar("SELECT sum(S008_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$SS009 		= executeScalar("SELECT sum(S009_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$SS010 		= executeScalar("SELECT sum(S010_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$SS011 		= executeScalar("SELECT sum(S011_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$SS012 		= executeScalar("SELECT sum(S012_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$SS013 		= executeScalar("SELECT sum(S013_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$SS014 		= executeScalar("SELECT sum(S014_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$SS015 		= executeScalar("SELECT sum(S015_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$SM01 		= executeScalar("SELECT sum(M01_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$SM02 		= executeScalar("SELECT sum(M02_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$SM03 		= executeScalar("SELECT sum(M03_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$SM04 		= executeScalar("SELECT sum(M04_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	
	$share	 	= $B001
				+$B002
				+$B003
				+$B004
				+$B005
				+$B006
				+$B007
				+$B008
				+$B009
				+$B010
				+$B011
				+$B012
				+$B013
				+$B014
				+$B015
				+$S001
				+$S002
				+$S003
				+$S004
				+$S005
				+$S006
				+$S007
				+$S008
				+$S009
				+$S010
				+$S011
				+$S012
				+$S013
				+$S014
				+$S015
				+$M01
				+$M02
				+$M03
				+$M04;
	$share2		= executeScalar("select sum(fee_B001)+
										sum(fee_B002)+
										sum(fee_B003)+
										sum(fee_B004)+
										sum(fee_B005)+
										sum(fee_B006)+
										sum(fee_B007)+
										sum(fee_B008)+
										sum(fee_B009)+
										sum(fee_B010)+
										sum(fee_B011)+
										sum(fee_B012)+
										sum(fee_B013)+
										sum(fee_B014)+
										sum(fee_B015)+
										sum(fee_S001)+
										sum(fee_S002)+
										sum(fee_S003)+
										sum(fee_S004)+
										sum(fee_S005)+
										sum(fee_S006)+
										sum(fee_S007)+
										sum(fee_S008)+
										sum(fee_S009)+
										sum(fee_S010)+
										sum(fee_S011)+
										sum(fee_S012)+
										sum(fee_S013)+
										sum(fee_S014)+
										sum(fee_S015)+
										sum(fee_M01)+
										sum(fee_M02)+
										sum(fee_M03)+
										sum(fee_M04) 
								from laborer_fee2 
								where fee_date = '".$date."'");
	$save 		= $SB001
				+$SB002
				+$SB003
				+$SB004
				+$SB005
				+$SB006
				+$SB007
				+$SB008
				+$SB009
				+$SB010
				+$SB011
				+$SB012
				+$SB013
				+$SB014
				+$SB015
				+$SS001
				+$SS002
				+$SS003
				+$SS004
				+$SS005
				+$SS006
				+$SS007
				+$SS008
				+$SS009
				+$SS010
				+$SS011
				+$SS012
				+$SS013
				+$SS014
				+$SS015
				+$SM01
				+$SM02
				+$SM03
				+$SM04;
	$save2		= executeScalar("select sum(save_B001)+
										sum(save_B002)+
										sum(save_B003)+
										sum(save_B004)+
										sum(save_B005)+
										sum(save_B006)+
										sum(save_B007)+
										sum(save_B008)+
										sum(save_B009)+
										sum(save_B010)+
										sum(save_B011)+
										sum(save_B012)+
										sum(save_B013)+
										sum(save_B014)+
										sum(save_B015)+
										sum(save_S001)+
										sum(save_S002)+
										sum(save_S003)+
										sum(save_S004)+
										sum(save_S005)+
										sum(save_S006)+
										sum(save_S007)+
										sum(save_S008)+
										sum(save_S009)+
										sum(save_S010)+
										sum(save_S011)+
										sum(save_S012)+
										sum(save_S013)+
										sum(save_S014)+
										sum(save_S015)+
										sum(save_M01)+
										sum(save_M02)+
										sum(save_M03)+
										sum(save_M04) 
								from laborer_fee2 where fee_date = '".$date."'");
	$check_pay 	= executeScalar("SELECT count(fee_id) FROM `laborer_fee2` where fee_date = '".$date."'");
	
	//Initialisasi
	$xB001 	= 0;	$yB001 	= 0;
	$xB002 	= 0;	$yB002 	= 0;
	$xB003 	= 0;	$yB003 	= 0;
	$xB004 	= 0;	$yB004 	= 0;
	$xB005 	= 0;	$yB005 	= 0;
	$xB006 	= 0;	$yB006 	= 0;
	$xB006 	= 0;	$yB006 	= 0;
	$xB007 	= 0;	$yB007 	= 0;
	$xB008 	= 0;	$yB008 	= 0;
	$xB009 	= 0;	$yB009 	= 0;
	$xB010 	= 0;	$yB010 	= 0;
	$xB011 	= 0;	$yB011 	= 0;
	$xB012 	= 0;	$yB012 	= 0;
	$xB013 	= 0;	$yB013 	= 0;
	$xB014 	= 0;	$yB014 	= 0;
	$xB015 	= 0;	$yB015 	= 0;
	$xS001 	= 0;	$yS001 	= 0;
	$xS002 	= 0;	$yS002 	= 0;
	$xS003 	= 0;	$yS003 	= 0;
	$xS004 	= 0;	$yS004 	= 0;
	$xS005 	= 0;	$yS005 	= 0;
	$xS006 	= 0;	$yS006 	= 0;
	$xS006 	= 0;	$yS006 	= 0;
	$xS007 	= 0;	$yS007 	= 0;
	$xS008 	= 0;	$yS008 	= 0;
	$xS009 	= 0;	$yS009 	= 0;
	$xS010 	= 0;	$yS010 	= 0;
	$xS011 	= 0;	$yS011 	= 0;
	$xS012 	= 0;	$yS012 	= 0;
	$xS013 	= 0;	$yS013 	= 0;
	$xS014 	= 0;	$yS014 	= 0;
	$xS015 	= 0;	$yS015 	= 0;
	$xM01 	= 0;	$yM01 	= 0;
	$xM02 	= 0;	$yM02 	= 0;
	$xM03 	= 0;	$yM03 	= 0;
	$xM04 	= 0;	$yM04 	= 0;
	
	if($share2>0){
		$xB001 	= executeScalar("SELECT sum(fee_B001) FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$xB002 	= executeScalar("SELECT sum(fee_B002) FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$xB003 	= executeScalar("SELECT sum(fee_B003) FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$xB004 	= executeScalar("SELECT sum(fee_B004) FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$xB005 	= executeScalar("SELECT sum(fee_B005) FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$xB006 	= executeScalar("SELECT sum(fee_B006) FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$xB007 	= executeScalar("SELECT sum(fee_B007) FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$xB008 	= executeScalar("SELECT sum(fee_B008) FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$xB009 	= executeScalar("SELECT sum(fee_B009) FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$xB010 	= executeScalar("SELECT sum(fee_B010) FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$xB011 	= executeScalar("SELECT sum(fee_B011) FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$xB012 	= executeScalar("SELECT sum(fee_B012) FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$xB013 	= executeScalar("SELECT sum(fee_B013) FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$xB014 	= executeScalar("SELECT sum(fee_B014) FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$xB015 	= executeScalar("SELECT sum(fee_B015) FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$xS001 	= executeScalar("SELECT sum(fee_S001) FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$xS002 	= executeScalar("SELECT sum(fee_S002) FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$xS003 	= executeScalar("SELECT sum(fee_S003) FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$xS004 	= executeScalar("SELECT sum(fee_S004) FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$xS005 	= executeScalar("SELECT sum(fee_S005) FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$xS006 	= executeScalar("SELECT sum(fee_S006) FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$xS007 	= executeScalar("SELECT sum(fee_S007) FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$xS008 	= executeScalar("SELECT sum(fee_S008) FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$xS009 	= executeScalar("SELECT sum(fee_S009) FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$xS010 	= executeScalar("SELECT sum(fee_S010) FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$xS011 	= executeScalar("SELECT sum(fee_S011) FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$xS012 	= executeScalar("SELECT sum(fee_S012) FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$xS013 	= executeScalar("SELECT sum(fee_S013) FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$xS014 	= executeScalar("SELECT sum(fee_S014) FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$xS015 	= executeScalar("SELECT sum(fee_S015) FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$xM01 	= executeScalar("SELECT sum(fee_M01) FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$xM02 	= executeScalar("SELECT sum(fee_M02) FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$xM03 	= executeScalar("SELECT sum(fee_M03) FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$xM04 	= executeScalar("SELECT sum(fee_M04) FROM laborer_fee2 where date(fee_date) = '".$date."'");
	}
	if($save2>0){
		$yB001 	= executeScalar("SELECT save_B001 FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$yB002 	= executeScalar("SELECT save_B002 FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$yB003 	= executeScalar("SELECT save_B003 FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$yB004 	= executeScalar("SELECT save_B004 FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$yB005 	= executeScalar("SELECT save_B005 FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$yB006 	= executeScalar("SELECT save_B006 FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$yB007 	= executeScalar("SELECT save_B007 FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$yB008 	= executeScalar("SELECT save_B008 FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$yB009 	= executeScalar("SELECT save_B009 FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$yB010 	= executeScalar("SELECT save_B010 FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$yB011 	= executeScalar("SELECT save_B011 FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$yB012 	= executeScalar("SELECT save_B012 FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$yB013 	= executeScalar("SELECT save_B013 FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$yB014 	= executeScalar("SELECT save_B014 FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$yB015 	= executeScalar("SELECT save_B015 FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$yS001 	= executeScalar("SELECT save_S001 FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$yS002 	= executeScalar("SELECT save_S002 FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$yS003 	= executeScalar("SELECT save_S003 FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$yS004 	= executeScalar("SELECT save_S004 FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$yS005 	= executeScalar("SELECT save_S005 FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$yS006 	= executeScalar("SELECT save_S006 FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$yS007 	= executeScalar("SELECT save_S007 FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$yS008 	= executeScalar("SELECT save_S008 FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$yS009 	= executeScalar("SELECT save_S009 FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$yS010 	= executeScalar("SELECT save_S010 FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$yS011 	= executeScalar("SELECT save_S011 FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$yS012 	= executeScalar("SELECT save_S012 FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$yS013 	= executeScalar("SELECT save_S013 FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$yS014 	= executeScalar("SELECT save_S014 FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$yS015 	= executeScalar("SELECT save_S015 FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$yM01 	= executeScalar("SELECT save_M01 FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$yM02 	= executeScalar("SELECT save_M02 FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$yM03 	= executeScalar("SELECT save_M03 FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$yM04 	= executeScalar("SELECT save_M04 FROM laborer_fee2 where date(fee_date) = '".$date."'");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<link rel="icon" href="../../images/icon.png">
    <link rel="shortcut icon" href="../../images/icon.png" />
    <title>Pembayaran Upah Mitra | PISS</title>
	<!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="../css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
    <!-- Timeline CSS -->
    <link href="../css/plugins/timeline.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../css/sb-admin-2.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="../font-awesome-4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script src="../js/jquery.min.js"></script>
	<script>
		/* hide all elements & show preloader*/
		document.documentElement.className += 'js';

		/* display variabel */
		var alertLoadProcess = "<span class='alert alert-danger' onclick='clearNotif()'><i class='fa fa-spinner fa-spin'></i> Loading...</span>";
    </script>
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><i class="fa fa-balance-scale fa-fw"></i> Admin PIOS</a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="fa fa-user fa-fw"></i><?php echo $admin;?><i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
						<li><a data-toggle="modal" data-target="#modalPassword" href="#"><i class="fa fa-lock fa-fw"></i> Ganti Password</a></li>
                        <li><a href="#"><i class="fa fa-question-circle fa-fw"></i> Bantuan</a></li>
                        <li class="divider"></li>
                        <li><a href="../logout.php"><i class="fa fa-sign-out fa-fw"></i> Keluar</a></li>
                    </ul>
                </li>
            </ul>
           
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
						<li> 
							<a href="#"><i class="fa fa-balance-scale fa-fw"></i> Timbangan<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li><a href="index.php"><i class="fa fa-truck fa-fw"></i> Masuk / Keluar</a></li>
								<li><a href="check.php"><i class="fa fa-check-square-o fa-fw"></i> Pengecekan / Edit</a></li>
								<li><a href="index5.php"><i class="fa fa-search fa-fw"></i> Listing Nota</a></li>
							</ul>
						</li>
						<li> 
							<a href="#"><i class="fa fa-close fa-fw"></i> Pembatalan<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li><a href="cancel1.php"><i class="fa fa-truck fa-fw"></i> Pembatalan Kendaraan Masuk</a></li>
								<li><a href="cancel2.php"><i class="fa fa-truck fa-fw"></i> Pembatalan Kendaraan Keluar</a></li>
								<li><a href="cancel3.php"><i class="fa fa-money fa-fw"></i> Pembatalan Pembayaran</a></li>
							</ul>
						</li>
						<li> 
							<a href="#"><i class="fa fa-edit fa-fw"></i> Edit<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li><a href="edit1.php"><i class="fa fa-edit fa-fw"></i> Edit Berat Masuk</a></li>
								<li><a href="edit2.php"><i class="fa fa-edit fa-fw"></i> Edit Berat Keluar</a></li>
								<li><a href="edit3.php"><i class="fa fa-edit fa-fw"></i> Edit Berat Bersih</a></li>
								<li><a href="edit4.php"><i class="fa fa-edit fa-fw"></i> Edit Status Nota</a></li>
							</ul>
						</li>
						<li class="active">
							<a href="#"><i class="fa fa-money fa-fw"></i> Acc Pembayaran<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li><a href="pay.php"><i class="fa fa-money fa-fw"></i> Pembayaran KM</a></li>
								<li><a class="active" href="pay_mitra.php"><i class="fa fa-money fa-fw"></i> Pembayaran Mitra</a></li>
							</ul>
						</li>
						<li>
							<a href="#"><i class="fa fa-book fa-fw"></i> Log Historis<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li><a href="log_spv.php"><i class="fa fa-desktop fa-fw"></i> Historis Superviser</a></li>
								<li><a href="log_print.php"><i class="fa fa-desktop fa-fw"></i> Historis Print</a></li>
							</ul>
						</li>
						<li>
							<a href="#"><i class="fa fa-database fa-fw"></i> Master<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li><a href="checker.php"><i class="fa fa-user-md fa-fw"></i> Kasir & Checker</a></li>
								<li><a href="laborer.php"><i class="fa fa-group fa-fw"></i> Mitra</a></li>
								<li><a href="transportation.php"><i class="fa fa-truck fa-fw"></i> Kendaraan</a></li>
								<li><a href="goods.php"><i class="fa fa-archive fa-fw"></i> Barang</a></li>
								<li><a href="noncommodity.php"><i class="fa fa-archive fa-fw"></i> Non Komoditi</a></li>
								<li><a href="payment.php"><i class="fa fa-money fa-fw"></i> Tarif</a></li>
							</ul>
						</li>
						<li><a href="#"><i class="fa fa-clipboard fa-fw"></i> Laporan<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li><a href="#"><i class="fa fa-line-chart fa-fw"></i> Transaksi Timbang<span class="fa arrow"></span></a>
									<ul class="nav nav-third-level">
										<li><a href="report_transaction.php"><i class="fa fa-line-chart fa-fw"></i> Transaksi Timbang</a></li>
										<li><a href="report_outstanding.php"><i class="fa fa-clock-o fa-fw"></i> Transaksi Outstanding</a></li>
										<li><a href="report_cancel.php"><i class="fa fa-close fa-fw"></i> Transaksi Batal</a></li>
									</ul>
								</li>
								<li><a href="#"><i class="fa fa-line-chart fa-fw"></i> Tonase<span class="fa arrow"></span></a>
									<ul class="nav nav-third-level">
										<li><a href="report_tonase.php"><i class="fa fa-line-chart fa-fw"></i> Tonase Harian</a></li>
										<li><a href="report_tonase_merchant.php"><i class="fa fa-group fa-fw"></i> Tonase Pedagang</a></li>
										<li><a href="report_tonase_block.php"><i class="fa fa-line-chart fa-fw"></i> Tonase Blok</a></li>
										<li><a href="report_tonase_comodity.php"><i class="fa fa-archive fa-fw"></i> Tonase Komoditi</a></li>
										<li><a href="report_merchant_comodity.php"><i class="fa fa-truck fa-fw"></i> Pedagang & Komoditi</a></li>
									</ul>
								</li>
								<li><a href="#"><i class="fa fa-line-chart fa-fw"></i> Pendapatan<span class="fa arrow"></span></a>
									<ul class="nav nav-third-level">
										<li><a href="report_revenue.php"><i class="fa fa-money fa-fw"></i> Terbayar</a></li> 
										<li><a href="report_revenue_merchant.php"><i class="fa fa-money fa-fw"></i> Terbayar Per Pedagang</a></li>
										<li><a href="report_revenue_unpaid.php"><i class="fa fa-clock-o fa-fw"></i> Belum Terbayar</a></li>
										<li><a href="report_revenue_unpaid_merchant.php"><i class="fa fa-clock-o fa-fw"></i> Belum Terbayar Per Pedagang</a></li>
									</ul>
								</li>
								<li><a href="#"><i class="fa fa-line-chart fa-fw"></i> KO & KM <span class="fa arrow"></span></a>
									<ul class="nav nav-third-level">
										<li><a href="report_kokm.php"><i class="fa fa-sticky-note-o fa-fw"></i> Laporan KO & KM</a></li>
										<li><a href="report_outstanding_ko.php"><i class="fa fa-clock-o fa-fw"></i> Outstanding KO & KM</a></li>
									</ul>
								</li>
								<li><a href="#"><i class="fa fa-line-chart fa-fw"></i> Mitra <span class="fa arrow"></span></a>
									<ul class="nav nav-third-level">
										<li><a href="report_mitra.php"><i class="fa fa-line-chart fa-fw"></i> Mitra Harian <span class="fa arrow"></span></a></li>
										<li><a href="report_mitra_year.php"><i class="fa fa-line-chart fa-fw"></i> Mitra Tahunan <span class="fa arrow"></span></a></li>
									</ul>
								</li>
							</ul>
						</li>
                    </ul>
                </div>
            </div>
        </nav>

        <div id="page-wrapper">
			<div class="row">
                <div class="col-lg-12">
					<br />
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-truck fa-fw"></i> Pembayaran Upah Mitra (Tanggal <?php echo date("d-m-Y", strtotime($date));?>)
                        </div>
                        <div class="panel-body">
							<div class="row">
								<div class="col-md-3">
									<div class="form-group" style="padding:10px; margin-top:-10px; margin-left:10px; margin-right:10px;">
										<label>Total Upah Mitra</label>
										<input type="text" class="form-control" id="" name="" value="<?php echo format_rupiah($share); ?>" disabled />
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group" style="padding:10px; margin-top:-10px; margin-left:10px; margin-right:10px;">
										<label>Total Dibagi</label>
										<input type="text" class="form-control" id="" name="" value="<?php echo format_rupiah($share2); ?>" disabled />
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group" style="padding:10px; margin-top:-10px; margin-left:10px; margin-right:10px;">
										<label>Total Simpanan Mitra</label>
										<input type="text" class="form-control" id="" name="" value="<?php echo format_rupiah($save); ?>" disabled />
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group" style="padding:10px; margin-top:-10px; margin-left:10px; margin-right:10px;">
										<label>Total Disimpan</label>
										<input type="text" class="form-control" id="" name="" value="<?php echo format_rupiah($save2); ?>" disabled />
									</div>
								</div>
							</div>
							<div class="row">
								<form action="pay_mitra_action.php?task=pay&date=<?php echo $date; ?>" class="form-horizontal" id="formTransOut" name = "formTransOut" method="POST" >
									<fieldset>
										<div class="col-md-3">
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Upah Lukman F (B001)</label>
												<input id="" name="" value="<?php echo format_rupiah($B001); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Upah Fandelli (B002)</label>
												<input id="" name="" value="<?php echo format_rupiah($B002); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Upah M. Syaifudin (B003)</label>
												<input id="" name="" value="<?php echo format_rupiah($B003); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Upah Duwi A. (B004)</label>
												<input id="" name="" value="<?php echo format_rupiah($B004); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Upah Kairul M. S (B005)</label>
												<input id="" name="" value="<?php echo format_rupiah($B005); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Upah Nanang B (B006)</label>
												<input id="" name="" value="<?php echo format_rupiah($B006); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Upah Putut S (B007)</label>
												<input id="" name="" value="<?php echo format_rupiah($B007); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Upah Abd. Muid (B008)</label>
												<input id="" name="" value="<?php echo format_rupiah($B008); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Upah Moh. Muid (B009)</label>
												<input id="" name="" value="<?php echo format_rupiah($B009); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Upah Didik S (B010)</label>
												<input id="" name="" value="<?php echo format_rupiah($B010); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Upah Ahmad T. K (B011)</label>
												<input id="" name="" value="<?php echo format_rupiah($B011); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Upah Fathur R (B012)</label>
												<input id="" name="" value="<?php echo format_rupiah($B012); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Upah Mat Rizal (B013)</label>
												<input id="" name="" value="<?php echo format_rupiah($B013); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Upah Slamet P (B014)</label>
												<input id="" name="" value="<?php echo format_rupiah($B014); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Upah Muktarom (B015)</label>
												<input id="" name="" value="<?php echo format_rupiah($B015); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Upah M. Ali M (S001)</label>
												<input id="" name="" value="<?php echo format_rupiah($S001); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Upah Ahmad F H (S002)</label>
												<input id="" name="" value="<?php echo format_rupiah($S002); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Upah Amirul M (S003)</label>
												<input id="" name="" value="<?php echo format_rupiah($S003); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Upah Khoirul A (S004)</label>
												<input id="" name="" value="<?php echo format_rupiah($S004); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Upah Ragil S (S005)</label>
												<input id="" name="" value="<?php echo format_rupiah($S005); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Upah Nawawi (S006)</label>
												<input id="" name="" value="<?php echo format_rupiah($S006); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Upah Muis H (S007)</label>
												<input id="" name="" value="<?php echo format_rupiah($S007); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Upah M. Hasin (S008)</label>
												<input id="" name="" value="<?php echo format_rupiah($S008); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Upah Marsono (S009)</label>
												<input id="" name="" value="<?php echo format_rupiah($S009); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Upah Seukron (S010)</label>
												<input id="" name="" value="<?php echo format_rupiah($S010); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Upah Rifai (S011)</label>
												<input id="" name="" value="<?php echo format_rupiah($S011); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Upah Rofik (S012)</label>
												<input id="" name="" value="<?php echo format_rupiah($S012); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Upah Durasid (S013)</label>
												<input id="" name="" value="<?php echo format_rupiah($S013); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Upah Deni (S014)</label>
												<input id="" name="" value="<?php echo format_rupiah($S014); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Upah Mahmud (S015)</label>
												<input id="" name="" value="<?php echo format_rupiah($S015); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Upah Darwanto (M01)</label>
												<input id="" name="" value="<?php echo format_rupiah($M01); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Upah Tri W (M02)</label>
												<input id="" name="" value="<?php echo format_rupiah($M02); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Upah Abdul R (M03)</label>
												<input id="" name="" value="<?php echo format_rupiah($M03); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Upah M. Rois (M04)</label>
												<input id="" name="" value="<?php echo format_rupiah($M04); ?>" type="text" class="form-control"  disabled />
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Dibagikan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $xB001; ?>" id="B001" name="B001">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Dibagikan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $xB002; ?>" id="B002" name="B002">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Dibagikan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $xB003; ?>" id="B003" name="B003">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Dibagikan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $xB004; ?>" id="B004" name="B004">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Dibagikan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $xB005; ?>" id="B005" name="B005">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Dibagikan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $xB006; ?>" id="B006" name="B006">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Dibagikan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $xB007; ?>" id="B007" name="B007">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Dibagikan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $xB008; ?>" id="B008" name="B008">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Dibagikan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $xB009; ?>" id="B009" name="B009">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Dibagikan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $xB010; ?>" id="B010" name="B010">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Dibagikan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $xB011; ?>" id="B011" name="B011">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Dibagikan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $xB012; ?>" id="B012" name="B012">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Dibagikan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $xB013; ?>" id="B013" name="B013">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Dibagikan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $xB014; ?>" id="B014" name="B014">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Dibagikan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $xB015; ?>" id="B015" name="B015">
											</div>

											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Dibagikan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $xS001; ?>" id="S001" name="S001">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Dibagikan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $xS002; ?>" id="S002" name="S002">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Dibagikan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $xS003; ?>" id="S003" name="S003">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Dibagikan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $xS004; ?>" id="S004" name="S004">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Dibagikan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $xS005; ?>" id="S005" name="S005">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Dibagikan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $xS006; ?>" id="S006" name="S006">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Dibagikan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $xS007; ?>" id="S007" name="S007">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Dibagikan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $xS008; ?>" id="S008" name="S008">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Dibagikan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $xS009; ?>" id="S009" name="S009">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Dibagikan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $xS010; ?>" id="S010" name="S010">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Dibagikan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $xS011; ?>" id="S011" name="S011">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Dibagikan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $xS012; ?>" id="S012" name="S012">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Dibagikan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $xS013; ?>" id="S013" name="S013">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Dibagikan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $xS014; ?>" id="S014" name="S014">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Dibagikan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $xS015; ?>" id="S015" name="S015">
											</div>

											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Dibagikan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $xM01; ?>" id="M01" name="M01">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Dibagikan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $xM02; ?>" id="M02" name="M02">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Dibagikan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $xM03; ?>" id="M03" name="M03">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Dibagikan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $xM04; ?>" id="M04" name="M04">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Simpanan Lukman F (B001)</label>
												<input id="" name="" value="<?php echo format_rupiah($SB001); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Simpanan Fandelli (B002)</label>
												<input id="" name="" value="<?php echo format_rupiah($SB002); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Simpanan Syaifudin (B003)</label>
												<input id="" name="" value="<?php echo format_rupiah($SB003); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Simpanan Duwi A. (B004)</label>
												<input id="" name="" value="<?php echo format_rupiah($SB004); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Simpanan Kairul M. S (B005)</label>
												<input id="" name="" value="<?php echo format_rupiah($SB005); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Simpanan Nanang B (B006)</label>
												<input id="" name="" value="<?php echo format_rupiah($SB006); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Simpanan Putut S (B007)</label>
												<input id="" name="" value="<?php echo format_rupiah($SB007); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Simpanan Abd. Muid (B008)</label>
												<input id="" name="" value="<?php echo format_rupiah($SB008); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Simpanan Moh. Muid (B009)</label>
												<input id="" name="" value="<?php echo format_rupiah($SB009); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Simpanan Didik S (B010)</label>
												<input id="" name="" value="<?php echo format_rupiah($SB010); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Simpanan Ahmad T. K (B011)</label>
												<input id="" name="" value="<?php echo format_rupiah($SB011); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Simpanan Fathur R (B012)</label>
												<input id="" name="" value="<?php echo format_rupiah($SB012); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Simpanan Mat Rizal (B013)</label>
												<input id="" name="" value="<?php echo format_rupiah($SB013); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Simpanan Slamet P (B014)</label>
												<input id="" name="" value="<?php echo format_rupiah($SB014); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Simpanan Muktarom (B015)</label>
												<input id="" name="" value="<?php echo format_rupiah($SB015); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Simpanan M. Ali M (S001)</label>
												<input id="" name="" value="<?php echo format_rupiah($SS001); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Simpanan Ahmad F H (S002)</label>
												<input id="" name="" value="<?php echo format_rupiah($SS002); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Simpanan Amirul M (S003)</label>
												<input id="" name="" value="<?php echo format_rupiah($SS003); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Simpanan Khoirul A (S004)</label>
												<input id="" name="" value="<?php echo format_rupiah($SS004); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Simpanan Ragil S (S005)</label>
												<input id="" name="" value="<?php echo format_rupiah($SS005); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Simpanan Nawawi (S006)</label>
												<input id="" name="" value="<?php echo format_rupiah($SS006); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Simpanan Muis H (S007)</label>
												<input id="" name="" value="<?php echo format_rupiah($SS007); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Simpanan M. Hasin (S008)</label>
												<input id="" name="" value="<?php echo format_rupiah($SS008); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Simpanan Marsono (S009)</label>
												<input id="" name="" value="<?php echo format_rupiah($SS009); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Simpanan Seukron (S010)</label>
												<input id="" name="" value="<?php echo format_rupiah($SS010); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Simpanan Rifai (S011)</label>
												<input id="" name="" value="<?php echo format_rupiah($SS011); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Simpanan Rofik (S012)</label>
												<input id="" name="" value="<?php echo format_rupiah($SS012); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Simpanan Durasid (S013)</label>
												<input id="" name="" value="<?php echo format_rupiah($SS013); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Simpanan Deni (S014)</label>
												<input id="" name="" value="<?php echo format_rupiah($SS014); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Simpanan Mahmud (S015)</label>
												<input id="" name="" value="<?php echo format_rupiah($SS015); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Simpanan Darwanto (M01)</label>
												<input id="" name="" value="<?php echo format_rupiah($SM01); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Simpanan Tri W (M02)</label>
												<input id="" name="" value="<?php echo format_rupiah($SM02); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Simpanan Abdul R (M03)</label>
												<input id="" name="" value="<?php echo format_rupiah($SM03); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Simpanan M. Rois (M04)</label>
												<input id="" name="" value="<?php echo format_rupiah($SM04); ?>" type="text" class="form-control"  disabled />
											</div>

										</div>
										<div class="col-md-3">
											<!-- <div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Disimpan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $yt14; ?>" id="st14" name="st14">
											</div> -->
											
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Disimpan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $yB001; ?>" id="SB001" name="SB001">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Disimpan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $yB002; ?>" id="SB002" name="SB002">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Disimpan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $yB003; ?>" id="SB003" name="SB003">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Disimpan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $yB004; ?>" id="SB004" name="SB004">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Disimpan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $yB005; ?>" id="SB005" name="SB005">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Disimpan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $yB006; ?>" id="SB006" name="SB006">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Disimpan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $yB007; ?>" id="SB007" name="SB007">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Disimpan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $yB008; ?>" id="SB008" name="SB008">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Disimpan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $yB009; ?>" id="SB009" name="SB009">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Disimpan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $yB010; ?>" id="SB010" name="SB010">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Disimpan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $yB011; ?>" id="SB011" name="SB011">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Disimpan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $yB012; ?>" id="SB012" name="SB012">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Disimpan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $yB013; ?>" id="SB013" name="SB013">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Disimpan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $yB014; ?>" id="SB014" name="SB014">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Disimpan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $yB015; ?>" id="SB015" name="SB015">
											</div>

											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Disimpan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $yS001; ?>" id="SS001" name="SS001">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Disimpan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $yS002; ?>" id="SS002" name="SS002">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Disimpan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $yS003; ?>" id="SS003" name="SS003">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Disimpan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $yS004; ?>" id="SS004" name="SS004">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Disimpan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $yS005; ?>" id="SS005" name="SS005">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Disimpan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $yS006; ?>" id="SS006" name="SS006">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Disimpan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $yS007; ?>" id="SS007" name="SS007">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Disimpan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $yS008; ?>" id="SS008" name="SS008">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Disimpan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $yS009; ?>" id="SS009" name="SS009">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Disimpan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $yS010; ?>" id="SS010" name="SS010">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Disimpan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $yS011; ?>" id="SS011" name="SS011">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Disimpan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $yS012; ?>" id="SS012" name="SS012">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Disimpan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $yS013; ?>" id="SS013" name="SS013">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Disimpan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $yS014; ?>" id="SS014" name="SS014">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Disimpan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $yS015; ?>" id="SS015" name="SS015">
											</div>

											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Disimpan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $yM01; ?>" id="SM01" name="SM01">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Disimpan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $yM02; ?>" id="SM02" name="SM02">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Disimpan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $yM03; ?>" id="SM03" name="SM03">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Disimpan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $yM04; ?>" id="SM04" name="SM04">
											</div>

										</div>
										<div class="form-group" style="padding:10px; margin-left:20px; margin-right:20px; margin-top:-10px; margin-bottom:0px;">
											<button type="submit" class="btn btn-block btn-outline btn-primary">Simpan</button>
										</div>
									</fieldset>
								</form>
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
	
	<!-- Modal Password -->
	<div class="modal fade" id="modalPassword" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><img src='../assets/image/Delete.png' width='25' height='25'/></button>
					<h4 id="header_password">Ganti Password</h4>
				</div>
				<div class="modal-body">
					<div id="data_password" style="margin-bottom: 0px;">
						<div class="alert alert-info" onclick="clearNotif()"><h3><i class="fa fa-spinner fa-spin"></i> Loading...</h3></div>
					</div>
					<input type="hidden" id="value_id" />
				</div>
				<div class="modal-footer">
				</div>
			</div>
		</div>
	</div>
	
	<script>
		$(document).ready(function(){
			// Auto Refresh Page
			$("#notifArea").html(alertLoadProcess);
			$('#Area1').load("check_table.php",function(){clearNotif();});
			setTimeout('$("html").removeClass("js")',100); 
			
			//Modal Mitra
			$('#modalMitra').on('shown.bs.modal', function (e) {
				$("#notifArea").html(alertLoadProcess);
				$("#data_mitra").load("mitra.php?id=<?php echo $id; ?>",function(){clearNotif();});
			})
			//Modal Nonkomoditi
			$('#modalNonkomoditi').on('shown.bs.modal', function (e) {
				$("#notifArea").html(alertLoadProcess);
				$("#data_nonkomoditi").load("modal_nonkomoditi.php?id=<?php echo $id; ?>",function(){clearNotif();});
			})
			//Modal Pecah Nota
			$('#modalPecahNota').on('shown.bs.modal', function (e) {
				$("#notifArea").html(alertLoadProcess);
				$("#data_breakdown").load("modal_breakdown.php?id=<?php echo $id; ?>",function(){clearNotif();});
			})
			//Modal Password
			$('#modalPassword').on('shown.bs.modal', function (e) {
				$("#notifArea").html(alertLoadProcess);
				$("#data_password").load("password.php",function(){clearNotif();});
			})
		});
		function clearNotif(){$("#notifArea").html("");}
		
		//Memanggil modal nonkomoditi
		function nonkomoditi(){
			$('#modalNonkomoditi').modal('show');
		}
		function pecahNota(){
			$('#modalPecahNota').modal('show');
		}
		//Memanggil fungsi gabung nota
		function merge(){
			window.location=('weighing_action.php?task=merge&wid=<?php echo $id; ?>&mid=<?php echo $r['merchant_id']; ?>');
		}
		//Memanggil fungsi pecah nota
		function breakdown(){
			window.location=('weighing_action.php?task=breakdown&id=<?php echo $id; ?>');
		}
		function clearNotif(){$("#notifArea").html("");}
    </script>
    <!-- jQuery -->
    <script src="../js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="../js/plugins/metisMenu/metisMenu.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="../js/sb-admin-2.js"></script>
</body>
</html>