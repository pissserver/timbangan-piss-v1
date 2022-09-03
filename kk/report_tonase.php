<?php
	session_start();
	include "connection.php";
	//Validasi role
	if($_SESSION['role']==''){
		header("Location:../login.html");
	}
	$admin 	= $_SESSION['username'];
	function headScript(){
		$headScript=file_get_contents("headScript.html");
		return $headScript;
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
	<link rel="icon" href="../images/icon.png">
    <link rel="shortcut icon" href="../images/icon.png" />
    <title>Admin</title>
	<?php echo headScript(); ?>
	<script src="../dataTables/dataTables.tableTools.css"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
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
                        <li><a href="../logout.php"><i class="fa fa-sign-out fa-fw"></i> Keluar</a></li>
                    </ul>
                </li>
            </ul>
           
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
						<li><a href="index.php"><i class="fa fa-balance-scale fa-fw"></i> Timbangan</a></li>
						<li class="active"><a href="#"><i class="fa fa-clipboard fa-fw"></i> Laporan<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li class="active"><a href="#"><i class="fa fa-line-chart fa-fw"></i> Tonase<span class="fa arrow"></span></a>
									<ul class="nav nav-third-level">
										<li><a class="active" href="report_tonase.php"><i class="fa fa-line-chart fa-fw"></i> Tonase Harian</a></li>
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
							</ul>
						</li>
                    </ul>
                </div>
            </div>
        </nav>

        <div id="page-wrapper">
			<br />
            <div class="row">
				<div class="col-lg-12">
					<div id="Area1">
						<div class="alert alert-info" onclick="clearNotif()">
							<center><h3><i class="fa fa-spinner fa-spin"></i> Loading...</h3></center>
						</div>
					</div>
					<input type="hidden" id="value_day1" />
				</div>
                <div class="col-lg-6">
					<div class="panel panel-info">
                        <div class="panel-heading">
                            <i class="fa fa-line-chart fa-fw"></i> Laporan Tonase Timbangan
                        </div>
                        <div class="panel-body">
							<form class="form-horizontal" action="../htmltopdf/reportTonase.php" id="reportTonase" name="reportTonase" method="POST" target="_blank">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group" style="padding:10px; margin-top:-10px;">
											<label>Tanggal Awal</label>
											<input name="date1" max="<?php echo $date_now;?>" type="date" class="form-control" placeholder="DD/MM/YYYY" required
											data-fv-notempty-message="Tanggal Belum Diisi"/>
										</div>
										<div class="form-group" style="padding:10px; margin-top:-10px;">
											<label>Tanggal Akhir</label>
											<input name="date2" max="<?php echo $date_now;?>" type="date" class="form-control" placeholder="DD/MM/YYYY" required
											data-fv-notempty-message="Tanggal Belum Diisi"/>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group" style="padding:10px; margin-top:-10px;">
											<label>Jenis Komoditi</label>
											<select class="form-control" name="commodity" id="commodity" required>
												<option value="">- Pilih Jenis Komoditi -</option>
												<option value="Semua">Semua</option>
												<?php 
													$sql2 = mysql_query("select distinct(merchant_type) from merchant");
													while($d2 = mysql_fetch_array($sql2))
												{?>
													<option value="<?php echo $d2['merchant_type'];?>"><?php echo $d2['merchant_type'];?></option>
												<?php } ?>
											</select>
										</div>
										<div class="form-group" style="padding:10px; margin-top:30px;">
											<center><button type="submit" class="btn btn-outline btn-primary btn-block">Lihat <i class="fa fa-angle-double-right fa-lg"></i></button></center>
										</div>
									</div>
								</div>
							</form>
                        </div>
                    </div>
					<div class="panel panel-info">
                        <div class="panel-heading">
                            <i class="fa fa-line-chart fa-fw"></i> Laporan Omzet Timbangan Harian
                        </div>
                        <div class="panel-body">
							<form class="form-horizontal" action="../htmltopdf/reportOmzet1.php" id="reportTonase" name="reportTonase" method="POST" target="_blank">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group" style="padding:10px; margin-top:-10px;">
											<label>Tanggal</label>
											<input name="date1" max="<?php echo $date_now;?>" type="date" class="form-control" placeholder="DD/MM/YYYY" required
											data-fv-notempty-message="Tanggal Belum Diisi"/>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group" style="padding:10px; margin-top:-10px;">
											<label>Jenis Komoditi</label>
											<select class="form-control" name="commodity" id="commodity" required>
												<option value="">- Pilih Jenis Komoditi -</option>
												<option value="Semua">Semua</option>
												<?php 
													$sql2 = mysql_query("select distinct(merchant_type) from merchant");
													while($d2 = mysql_fetch_array($sql2))
												{?>
													<option value="<?php echo $d2['merchant_type'];?>"><?php echo $d2['merchant_type'];?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="form-group" style="padding:10px; margin-left:0px; margin-right:0px; margin-top:30px;">
										<center><button type="submit" class="btn btn-outline btn-primary btn-block">Lihat <i class="fa fa-angle-double-right fa-lg"></i></button></center>
									</div>
								</div>
							</form>
                        </div>
                    </div>
				</div>
				<div class="col-lg-6">
					<div class="panel panel-info">
                        <div class="panel-heading">
                            <i class="fa fa-line-chart fa-fw"></i> Rekap Tonase Timbangan
                        </div>
                        <div class="panel-body">
							<form class="form-horizontal" action="../htmltopdf/reportTonase4.php" id="reportTonase4" name = "reportTonase4" method="POST" target="_blank">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group" style="padding:10px; margin-top:-10px;">
											<label>Tanggal Awal</label>
											<input name="date1" max="<?php echo $date_now;?>" type="date" class="form-control" placeholder="DD/MM/YYYY" required
											data-fv-notempty-message="Tanggal Belum Diisi"/>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group" style="padding:10px; margin-top:-10px;">
											<label>Tanggal Akhir</label>
											<input name="date2" max="<?php echo $date_now;?>" type="date" class="form-control" placeholder="DD/MM/YYYY" required
											data-fv-notempty-message="Tanggal Belum Diisi"/>
										</div>
									</div>
									<div class="form-group" style="padding:10px; margin-left:0px; margin-right:0px; margin-top:30px;">
										<center><button type="submit" class="btn btn-outline btn-primary btn-block">Lihat <i class="fa fa-angle-double-right fa-lg"></i></button></center>
									</div>
								</div>
							</form>
                        </div>
                    </div>
					<div class="panel panel-info">
						<div class="panel-heading">
							<i class="fa fa-line-chart fa-fw"></i> Rekap Omzet Timbangan
						</div>
						<div class="panel-body">
							<form class="form-horizontal" action="../htmltopdf/reportOmzet2.php" id="reportTonase" name="reportTonase" method="POST" target="_blank">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group" style="padding:10px; margin-top:-10px;">
											<label>Tanggal Awal</label>
											<input name="date1" max="<?php echo $date_now;?>" type="date" class="form-control" placeholder="DD/MM/YYYY" required
											data-fv-notempty-message="Tanggal Belum Diisi"/>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group" style="padding:10px; margin-top:-10px;">
											<label>Tanggal Akhir</label>
											<input name="date2" max="<?php echo $date_now;?>" type="date" class="form-control" placeholder="DD/MM/YYYY" required
											data-fv-notempty-message="Tanggal Belum Diisi"/>
										</div>
									</div>
									<div class="form-group" style="padding:10px; margin-left:0px; margin-right:0px; margin-top:30px;">
										<center><button type="submit" class="btn btn-outline btn-primary btn-block">Lihat <i class="fa fa-angle-double-right fa-lg"></i></button></center>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
            </div>
        </div>
    </div>
	<!-- Modal Tonase-->
	<div class="modal fade bs-example-modal-lg" id="modalTonase" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><img src='img/Delete.png' width='25' height='25'/></button>
					<h4 id="header_tonase">Tonase Timbangan PIOS </h4>
				</div>
				<div class="modal-body">
					<div id="body_tonase" style="margin-bottom: 0px;">
						<div class="alert alert-info" onclick="clearNotif()"><h3><i class="fa fa-spinner fa-spin"></i> Loading...</h3></div>
					</div>
				</div>
				<div class="modal-footer">
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
    
	<!-- jQuery -->
    <script src="../js/jquery.js"></script>
	<script src="../dataTables/jquery.dataTables.js"></script>
	<script src="../dataTables/dataTables.tableTools.js"></script>
	<script src="../dataTables/dataTables.bootstrap.js"></script>
	<!-- highcharts -->
	<script src="../highcharts/js/highcharts.js"></script>
	<script src="../highcharts/js/highcharts-more.js"></script>
	
    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="../js/plugins/metisMenu/metisMenu.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="../js/sb-admin-2.js"></script>
	<script>
		$(document).ready(function(){
			$("#notifArea").html(alertLoadProcess);
			$('#Area1').load("../line_tonase.php",function(){clearNotif();});
			setTimeout('$("html").removeClass("js")',1000); 
			
			//Modal Password
			$('#modalPassword').on('shown.bs.modal', function (e) {
				$("#notifArea").html(alertLoadProcess);
				$("#data_password").load("password.php",function(){clearNotif();});
			})
			//data table Tonase
			$('#tableTonase').dataTable();
		});
		//Memanggil Modal Tonase
		function callTonase(getDay){
			$("#value_day2").val(getDay);
			$("#body_tonase").load("../detail_tonase.php?day="+$("#value_day2").val(),function(){clearNotif();});
			$('#modalTonase').modal('show');
		}
		function clearNotif(){$("#notifArea").html("");}
    </script>
</body>
</html>