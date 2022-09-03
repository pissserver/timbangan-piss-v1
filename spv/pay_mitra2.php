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
	$t06 		= executeScalar("SELECT sum(t06) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$t14 		= executeScalar("SELECT sum(t14) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$t17 		= executeScalar("SELECT sum(t17) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$t24 		= executeScalar("SELECT sum(t24) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$t26 		= executeScalar("SELECT sum(t26) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$t29 		= executeScalar("SELECT sum(t29) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$t36 		= executeScalar("SELECT sum(t36) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$t40 		= executeScalar("SELECT sum(t40) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$m03 		= executeScalar("SELECT sum(foreman) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	//$pios	 	= executeScalar("SELECT sum(pios_fee) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$st06 		= executeScalar("SELECT sum(t06_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$st14 		= executeScalar("SELECT sum(t14_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$st17 		= executeScalar("SELECT sum(t17_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$st24 		= executeScalar("SELECT sum(t24_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$st26 		= executeScalar("SELECT sum(t26_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$st29 		= executeScalar("SELECT sum(t29_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$st36 		= executeScalar("SELECT sum(t36_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$st40 		= executeScalar("SELECT sum(t40_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$sm03 		= executeScalar("SELECT sum(foreman_save) FROM laborer_fee where date(laborer_fee_date) = '".$date."' and laborer_fee_sts = 'Baru'");
	$share	 	= $t06+$t14+$t17+$t24+$t26+$t29+$t36+$t40+$m03;
	$share2		= executeScalar("select sum(fee_t06)+sum(fee_t14)+sum(fee_t17)+sum(fee_t24)+sum(fee_t26)+sum(fee_t29)+
				sum(fee_t36)+sum(fee_t40)+sum(fee_m03) 
				from laborer_fee2 where fee_date = '".$date."'");
	$save 		= $st06+$st14+$st17+$st24+$st26+$st29+$st36+$st40+$sm03;
	$save2		= executeScalar("select sum(save_t06)+sum(save_t14)+sum(save_t17)+sum(save_t24)+sum(save_t26)+sum(save_t29)+
				sum(save_t36)+sum(save_t40)+sum(save_m03) 
				from laborer_fee2 where fee_date = '".$date."'");
	$check_pay 	= executeScalar("SELECT count(fee_id) FROM `laborer_fee2` where fee_date = '".$date."'");
	
	//Initialisasi
	$xt06 	= 0;	$yt06 	= 0;
	$xt14 	= 0;	$yt14 	= 0;
	$xt17 	= 0;	$yt17 	= 0;
	$xt24 	= 0;	$yt24 	= 0;
	$xt26 	= 0;	$yt26 	= 0;
	$xt29 	= 0;	$yt29 	= 0;
	$xt36 	= 0;	$yt36 	= 0;
	$xt40 	= 0;	$yt40 	= 0;
	$xm03 	= 0;	$ym03 	= 0;
	if($share2>0){
		$xt06 	= executeScalar("SELECT sum(fee_t06) FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$xt14 	= executeScalar("SELECT sum(fee_t14) FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$xt17 	= executeScalar("SELECT sum(fee_t17) FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$xt24 	= executeScalar("SELECT sum(fee_t24) FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$xt26 	= executeScalar("SELECT sum(fee_t26) FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$xt29 	= executeScalar("SELECT sum(fee_t29) FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$xt36 	= executeScalar("SELECT sum(fee_t36) FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$xt40 	= executeScalar("SELECT sum(fee_t40) FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$xm03 	= executeScalar("SELECT sum(fee_m03) FROM laborer_fee2 where date(fee_date) = '".$date."'");
	}
	if($save2>0){
		$yt06 	= executeScalar("SELECT save_t06 FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$yt14 	= executeScalar("SELECT save_t14 FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$yt17 	= executeScalar("SELECT save_t17 FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$yt24 	= executeScalar("SELECT save_t24 FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$yt26 	= executeScalar("SELECT save_t26 FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$yt29 	= executeScalar("SELECT save_t29 FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$yt36 	= executeScalar("SELECT save_t36 FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$yt40 	= executeScalar("SELECT save_t40 FROM laborer_fee2 where date(fee_date) = '".$date."'");
		$ym03 	= executeScalar("SELECT save_m03 FROM laborer_fee2 where date(fee_date) = '".$date."'");
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