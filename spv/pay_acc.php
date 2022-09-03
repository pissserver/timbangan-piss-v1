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
	
	/*$ko_id 	= 0;*/
	$km_id 	= executeScalar("select count(km_id) from km");
	$km_id 	= $km_id+1;
	$check 	= executeScalar("select count(ko_id) from ko where ko_status = 'DiTerima'");
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
						<i class="fa fa-user fa-fw"></i>
						<?php echo $admin; ?>
						<i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
						<li><a data-toggle="modal" data-target="#modalPassword" href="#"><i class="fa fa-lock fa-fw"></i> Ganti Password</a></li>
                        <li><a href="#"><i class="fa fa-question-circle fa-fw"></i> Bantuan</a></li>
                        <li class="divider"></li>
                        <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Keluar</a></li>
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
						<li class="active"><a href="#"><i class="fa fa-money fa-fw"></i> Pembayaran<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li><a class="active" href="pay.php"><i class="fa fa-money fa-fw"></i> Acc Pembayaran</a></li>
							</ul>
						</li>
						<li><a href="log_spv.php"><i class="fa fa-desktop fa-fw"></i> Log Superviser</a></li>
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
										<li><a href="report_revenue_cashier.php"><i class="fa fa-money fa-fw"></i> Terbayar Per Kasir</a></li>
										<li><a href="report_revenue_merchant.php"><i class="fa fa-money fa-fw"></i> Terbayar Per Pedagang</a></li>
										<li><a href="report_revenue_unpaid.php"><i class="fa fa-clock-o fa-fw"></i> Belum Terbayar</a></li>
										<li><a href="report_revenue_unpaid_merchant.php"><i class="fa fa-clock-o fa-fw"></i> Belum Terbayar Per Pedagang</a></li>
									</ul>
								</li>
								<li><a href="#"><i class="fa fa-line-chart fa-fw"></i> KO & KM <span class="fa arrow"></span></a>
									<ul class="nav nav-third-level">
										<li><a href="report_outstanding_ko.php"><i class="fa fa-clock-o fa-fw"></i> Outstanding KO & KM</a></li>
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
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <i class="fa fa-truck fa-fw"></i> Data Pembayaran
                        </div>
                        <div class="panel-body">
							<div class="row">
								<div class="col-md-12">
									<div id="Area1">
										<div class="alert alert-info" onclick="clearNotif()">
											<center><h3><i class="fa fa-spinner fa-spin"></i> Loading...</h3></center>
										</div>
									</div>
								</div>
							</div>
                        </div>
                    </div>
					<div class="panel panel-info">
                        <div class="panel-heading">
                            <i class="fa fa-line-chart fa-fw"></i> Acc Data Pembayaran
                        </div>
                        <div class="panel-body">
							<div class="row">
								<form class="form-horizontal" action="pay_action.php?task=acc&km=<?php echo $km_id; ?>" id="acckm" name="acckm" method="POST" target="_blank">
									<div class="col-md-3" style="margin-top:10px;margin-bottom:-10px;">
										<div class="form-group" style="padding:10px; text-align:center; margin-top:0px;">
											<label>ID KM: <?php echo $km_id; ?></label>
										</div>
									</div>
									<div class="col-md-9" style="margin-top:0px;margin-bottom:-10px;">
										<div class="form-group" style="padding:10px;">
											<?php 
												if($check>=1){
													echo'<center><button type="submit" class="btn btn-outline btn-primary btn-block">ACC <i class="fa fa-angle-double-right fa-lg"></i></button></center>';
												}
											?>
										</div>
									</div>
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
			$('#Area1').load("pay_acc_table.php",function(){clearNotif();});
			setTimeout('$("html").removeClass("js")',1000); 
			
			//Modal Password
			$('#modalPassword').on('shown.bs.modal', function (e) {
				$("#notifArea").html(alertLoadProcess);
				$("#data_password").load("password.php",function(){clearNotif();});
			})
		});
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