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
										sum(fee_S015)+
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
    <title>Admin</title>
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
                    <div class="panel panel-info">
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
												<label>Upah Soari (T06)</label>
												<input id="" name="" value="<?php echo format_rupiah($t06); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Upah Musodik (T14)</label>
												<input id="" name="" value="<?php echo format_rupiah($t14); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Upah Hafid (T17)</label>
												<input id="" name="" value="<?php echo format_rupiah($t17); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Upah Adenan (T24)</label>
												<input id="" name="" value="<?php echo format_rupiah($t24); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Upah Zaenal (T26)</label>
												<input id="" name="" value="<?php echo format_rupiah($t26); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Upah Mustofa (T29)</label>
												<input id="" name="" value="<?php echo format_rupiah($t29); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Upah Rochman (T36)</label>
												<input id="" name="" value="<?php echo format_rupiah($t36); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Upah Maksum (T40)</label>
												<input id="" name="" value="<?php echo format_rupiah($t40); ?>" type="text" class="form-control"  disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Upah Zaini (M03)</label>
												<input id="" name="" value="<?php echo format_rupiah($m03); ?>" type="text" class="form-control"  disabled />
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Dibagikan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $xt06; ?>" id="t06" name="t06">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Dibagikan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $xt14; ?>" id="t14" name="t14">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Dibagikan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $xt17; ?>" id="t17" name="t17">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Dibagikan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $xt24; ?>" id="t24" name="t24">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Dibagikan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $xt26; ?>" id="t26" name="t26">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Dibagikan</label>
												<input type="number" class="form-control" value="<?php echo $xt29; ?>" id="t29" name="t29">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Dibagikan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $xt36; ?>" id="t36" name="t36">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Dibagikan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $xt40; ?>" id="t40" name="t40">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Dibagikan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $xm03; ?>" id="m03" name="m03">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Simpanan Soari (T06)</label>
												<input id="" name="" value="<?php echo format_rupiah($st06); ?>" type="text" class="form-control" disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Simpanan Musodik (T14)</label>
												<input id="" name="" value="<?php echo format_rupiah($st14); ?>" type="text" class="form-control" disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Simpanan Hafid (T17)</label>
												<input id="" name="" value="<?php echo format_rupiah($st17); ?>" type="text" class="form-control" disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Simpanan Adenan (T24)</label>
												<input id="" name="" value="<?php echo format_rupiah($st24); ?>" type="text" class="form-control" disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Simpanan Zaenal (T26)</label>
												<input id="" name="" value="<?php echo format_rupiah($st26); ?>" type="text" class="form-control" disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Simpanan Mustofa (T29)</label>
												<input id="" name="" value="<?php echo format_rupiah($st29); ?>" type="text" class="form-control" disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Simpanan Rochman (T36)</label>
												<input id="" name="" value="<?php echo format_rupiah($st36); ?>" type="text" class="form-control" disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Simpanan Maksum (T40)</label>
												<input id="" name="" value="<?php echo format_rupiah($st40); ?>" type="text" class="form-control" disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:10px; margin-right:5px;">
												<label>Simpanan Zaini (M03)</label>
												<input id="" name="" value="<?php echo format_rupiah($sm03); ?>" type="text" class="form-control" disabled />
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Disimpan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $yt06; ?>" id="st06" name="st06">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Disimpan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $yt14; ?>" id="st14" name="st14">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Disimpan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $yt17; ?>" id="st17" name="st17">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Disimpan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $yt24; ?>" id="st24" name="st24">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Disimpan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $yt26; ?>" id="st26" name="st26">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Disimpan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $yt29; ?>" id="st29" name="st29">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Disimpan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $yt36; ?>" id="st36" name="st36">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Disimpan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $yt40; ?>" id="st40" name="st40">
											</div>
											<div class="form-group" style="padding:10px; margin-top:-15px; margin-left:5px; margin-right:10px;">
												<label>Total Disimpan</label>
												<input type="number" min="0" class="form-control" value="<?php echo $ym03; ?>" id="sm03" name="sm03">
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