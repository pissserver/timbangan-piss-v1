<?php
	session_start();
	include "connection.php";
	//Validasi role
	if($_SESSION['checker']==''){
		header("Location:login.html");
	}
	$admin 		= executeScalar("select checker_name from checker where checker_code = '".$_SESSION['checker']."'");
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
    <title>Nota Sudah Dicek | PISS</title>
	<?php echo headScript(); ?>
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
                <a class="navbar-brand" href="index.php"><i class="fa fa-balance-scale fa-fw"></i> Admin PISS</a>
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
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Keluar</a></li>
                    </ul>
                </li>
            </ul>
           
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
						<li class="active"><a href="#"><i class="fa fa-balance-scale fa-fw"></i> Timbangan<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li><a href="index.php"><i class="fa fa-truck fa-fw"></i> Masuk / Keluar</a></li>
								<li><a href="index4.php"><i class="fa fa-truck fa-fw"></i> Retail</a></li>
								<li><a href="check2.php"><i class="fa fa-square-o fa-fw"></i> Nota Yg Belum Dicek</a></li>
								<li><a class="active" href="check.php"><i class="fa fa-check-square-o fa-fw"></i> Pengecekan / Edit</a></li>
								<li><a href="index5.php"><i class="fa fa-search fa-fw"></i> Listing Nota</a></li>
							</ul>
						</li>
						<li><a href="#"><i class="fa fa-money fa-fw"></i> Pembayaran<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li><a href="pay.php"><i class="fa fa-money fa-fw"></i> Pembayaran Tonase</a></li>
								<li><a href="pay_mitra.php"><i class="fa fa-money fa-fw"></i> Pembayaran Jasa Bongkar</a></li>
								<li><a href="pay_acc.php"><i class="fa fa-money fa-fw"></i> Setoran KO Tonase</a></li>
								<li><a href="pay_acc_mitra.php"><i class="fa fa-money fa-fw"></i> Setoran KO Jasa Bongkar</a></li>
							</ul>
						</li>
						<li><a href="#"><i class="fa fa-database fa-fw"></i> Master<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li><a href="laborer.php"><i class="fa fa-group fa-fw"></i> Mitra</a></li>
								<li><a href="transportation.php"><i class="fa fa-truck fa-fw"></i> Kendaraan</a></li>
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
									</ul>
								</li>
								<li><a href="#"><i class="fa fa-line-chart fa-fw"></i> Pendapatan Tonase<span class="fa arrow"></span></a>
									<ul class="nav nav-third-level">
										<li><a href="report_revenue.php"><i class="fa fa-money fa-fw"></i> Terbayar</a></li> 
										<li><a href="report_revenue_merchant.php"><i class="fa fa-money fa-fw"></i> Terbayar Per Pedagang</a></li>
										<li><a href="report_revenue_unpaid.php"><i class="fa fa-clock-o fa-fw"></i> Belum Terbayar</a></li>
										<li><a href="report_revenue_unpaid_merchant.php"><i class="fa fa-clock-o fa-fw"></i> Belum Terbayar Per Pedagang</a></li>
									</ul>
								</li>
								<li><a href="#"><i class="fa fa-line-chart fa-fw"></i> Pendapatan Mitra<span class="fa arrow"></span></a>
									<ul class="nav nav-third-level">
										<li><a href="report_revenue_mitra.php"><i class="fa fa-money fa-fw"></i> Terbayar</a></li> 
										<li><a href="report_revenue_merchant_mitra.php"><i class="fa fa-money fa-fw"></i> Terbayar Per Pedagang</a></li>
										<li><a href="report_revenue_unpaid_mitra.php"><i class="fa fa-clock-o fa-fw"></i> Belum Terbayar</a></li>
										<li><a href="report_revenue_unpaid_merchant_mitra.php"><i class="fa fa-clock-o fa-fw"></i> Belum Terbayar Per Pedagang</a></li>
									</ul>
								</li>
								<li><a href="#"><i class="fa fa-line-chart fa-fw"></i> KO & KM <span class="fa arrow"></span></a>
									<ul class="nav nav-third-level">
										<li><a href="report_kokm.php"><i class="fa fa-sticky-note-o fa-fw"></i> KO & KM Tonase</a></li>
										<li><a href="report_kokm_mitra.php"><i class="fa fa-sticky-note-o fa-fw"></i> KO & KM Mitra</a></li>
										<li><a href="report_outstanding_ko.php"><i class="fa fa-clock-o fa-fw"></i> Outstanding Tonase</a></li>
										<li><a href="report_outstanding_ko_mitra.php"><i class="fa fa-clock-o fa-fw"></i> Outstanding Mitra</a></li>
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
		
		<!--<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
					<br />
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <i class="fa fa-truck fa-fw"></i> Pengecekan Data Timbangan
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
                </div>
            </div>
        </div>-->

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
					<br />
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-truck fa-fw"></i> Pengecekan Data Timbangan
                        </div>
                        <div class="panel-body">
							<div class="row">
								<div class="col-md-12">
									<div id="Area">
										<!--<div class="alert alert-info">
											<center><h3><i class="fa fa-spinner fa-spin"></i> Loading...</h3></center>
										</div>-->
										<table id="transactionView" class="table table-striped table-bordered table-hover">
											<thead>
												<tr>
													<th rowspan="2">NO</th>
													<th rowspan="2">Nopol</th>
													<th rowspan="2">Pedagang</th>
													<th rowspan="2">Masuk</th>
													<th rowspan="2">Keluar</th>
													<th rowspan="2">Non Komoditi</th>
													<th rowspan="2">Rafaksi</th>
													<th rowspan="2">Netto</th>
													<th rowspan="2">Status</th>
													<th rowspan="2">Jam & Tgl Masuk</th>
													<th style="text-align: center;" colspan="3">Status Print</th>
													<th rowspan="2">Aksi</th>
												</tr>
												<tr>
													<th class="text-center">P1</th>
													<th class="text-center">Cek</th>
													<th class="text-center">P2</th>
												</tr>
											</thead>
											<tbody>	
											</tbody>
										</table>
									</div>
								</div>
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
						<div class="alert alert-info" onclick="clearNotif()">
							<h3><i class="fa fa-spinner fa-spin"></i> Loading...</h3>
						</div>
					</div>
					<input type="hidden" id="value_id" />
				</div>
				<div class="modal-footer"></div>
			</div>
		</div>
	</div>
	<!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/plugins/metisMenu/metisMenu.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="js/sb-admin-2.js"></script>
    <script src="dataTables/jquery.dataTables.js"></script>
	<script src="dataTables/dataTables.tableTools.js"></script>
	<script src="dataTables/dataTables.bootstrap.js"></script>
	<script>

		$(document).ready(function()
		{
			// Auto Refresh Page
			//$("#notifArea").html(alertLoadProcess);
			/*$('#Area1').load("check_table.php",function(){clearNotif();});
			setTimeout('$("html").removeClass("js")',100);*/ 
			//Modal Password
			$('#modalPassword').on('shown.bs.modal', function (e) {
				//$("#notifArea").html(alertLoadProcess);
				$("#data_password").load("password.php",function(){clearNotif();});
			});
			dataTable();
		});
		function dataTable()
  		{
			var tabel = $('#transactionView').DataTable({
				//"deferRender": true,
				//"destroy" : true,
				"processing": true,
				"serverSide" : true,
				"ajax": "improve_check.php",
				"createdRow": function ( row, data, index )
				{
					$('td', row).eq(0).addClass('text-center'),
					$('td', row).eq(1).addClass('text-center'),
					$('td', row).eq(2).addClass('text-center'),
					$('td', row).eq(3).addClass('text-center'),
					$('td', row).eq(4).addClass('text-center'),
					$('td', row).eq(5).addClass('text-center'),
					$('td', row).eq(6).addClass('text-center'),
					$('td', row).eq(7).addClass('text-center'),
					$('td', row).eq(8).addClass('text-center'),
					$('td', row).eq(9).addClass('text-center'),
					$('td', row).eq(10).addClass('text-center'),
					$('td', row).eq(12).addClass('text-center'),
					$('td', row).eq(13).addClass('text-center')
				},
				"order": [[ 0, "desc"]],
				});
		}
		function clearNotif(){$("#notifArea").html("");}

		function edit($d)
		{
			window.location.href = 'check_edit.php?id='+$d;
		}
    </script>
</body>
</html>