<?php
	session_start();
	include "connection.php";
	//Validasi role
	if($_SESSION['checker']==''){
		header("Location:login.html");
	}
	function headScript(){
		$headScript=file_get_contents("headScript.html");
		return $headScript;
	}
	$admin 	= executeScalar("select checker_name from checker where checker_code = '".$_SESSION['checker']."'");
	$id		= $_GET['id'];
	$edit	= mysql_query("select weighing_id, nopol, merchant_id, goods_id, weight_in, weight_out, noncommodity, 
	laborer_sts, netto, cost, date_in, date_out, time_in, time_out, receiver_id from weighing where weighing_id = '".$id."'");
	while ($r = mysql_fetch_array($edit)){
		$merchant = executeScalar("select merchant_name from merchant where merchant_id = '".$r['merchant_id']."'");
		$receiver = executeScalar("select checker_name from checker where checker_id = '".$r['receiver_id']."'");
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
    <title>Setoran KO Tonase | PISS</title>
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
						<i class="fa fa-user fa-fw"></i><?php echo $admin;?><i class="fa fa-caret-down"></i>
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
						<li><a href="#"><i class="fa fa-balance-scale fa-fw"></i> Timbangan<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li><a href="index.php"><i class="fa fa-truck fa-fw"></i> Masuk / Keluar</a></li>
								<li><a href="index4.php"><i class="fa fa-truck fa-fw"></i> Retail</a></li>	
								<li><a href="check2.php"><i class="fa fa-square-o fa-fw"></i> Nota Yg Belum Dicek</a></li>
								<li><a href="check.php"><i class="fa fa-check-square-o fa-fw"></i> Pengecekan / Edit</a></li>
								<li><a href="index5.php"><i class="fa fa-search fa-fw"></i> Listing Nota</a></li>
							</ul>
						</li>
						<li class="active"><a href="#"><i class="fa fa-money fa-fw"></i> Pembayaran<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li><a href="pay.php"><i class="fa fa-money fa-fw"></i> Pembayaran Tonase</a></li>
								<li><a href="pay_mitra.php"><i class="fa fa-money fa-fw"></i> Pembayaran Jasa Bongkar</a></li>
								<li><a class="active" href="pay_acc.php"><i class="fa fa-money fa-fw"></i> Setoran KO Tonase</a></li>
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

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <i class="fa fa-money fa-fw"></i> Pembayaran Tagihan (<?php 
								$wid = sprintf("%07d", $id);
								$year = executeScalar("select date_format(date_out, '%y') from weighing where weighing_id = '".$r['weighing_id']."'");
								echo 'TG'.$year.$wid; ?>)
                        </div>
                        <div class="panel-body">
							<div class="row">
								<form action="weighing_action.php?task=pay&id=<?php echo $id; ?>" class="form-horizontal" id="formTransOut" name="formTransOut" method="POST">
									<div class="col-md-3">
										<div class="form-group" style="padding:10px; margin-top:0px;">
											<label>Nopol</label>
											<input type="text" class="form-control" id="nopol" name="nopol" value="<?php echo $r['nopol']; ?>" disabled >                  
										</div>
										<div class="form-group" style="padding:10px; margin-top:10px;">
											<label>Pedagang</label>
											<select class="form-control" name="merchant" id="merchant" disabled >
												<option value="<?php echo $r['merchant_id']; ?>" ><?php echo $merchant; ?></option>
												<?php 
													$sql 		= mysql_query("select merchant_id, merchant_name from merchant order by merchant_name");
													while($data = mysql_fetch_array($sql))
												{?>
													<option value="<?php echo $data['merchant_id'];?>"><?php echo $data['merchant_name'];?></option>
												<?php } ?>
											</select>
										</div>
										<div class="form-group" style="padding:10px; margin-top:10px;">
											<label>Barang</label>
											<select class="form-control" name="goods" id="goods" disabled >
												<option value="<?php echo $r[8]; ?>" >
													<?php 
														$goods = executeScalar("select goods_name from goods where goods_id = '".$r['goods_id']."'");
														echo $goods;
													?>
												</option>
												<?php
													$sql 		= mysql_query("select goods_id, goods_name from goods order by goods_name");
													while($data = mysql_fetch_array($sql))
												{?>
													<option value="<?php echo $data['goods_id'];?>"><?php echo $data['goods_name'];?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group" style="padding:10px; margin-top:0px;">
											<label>Berat Kendaraan Masuk</label>
											<input type="text" class="form-control" id="weight_in" name="weight_in" value="<?php echo $r['weight_in']; ?>" disabled>
											<script>
												$("input[name='weight_in']").TouchSpin({
												  verticalbuttons: true,
												  verticalupclass: 'glyphicon glyphicon-plus',
												  verticaldownclass: 'glyphicon glyphicon-minus'
												});
											</script>
										</div>
										<div class="form-group" style="padding:10px; margin-top:10px;">
											<label>Berat Kendaraan Keluar</label>
											<input type="text" class="form-control" id="weight_out" name="weight_out" value="<?php echo $r['weight_out']; ?>" disabled >
											<script>
												$("input[name='weight_out']").TouchSpin({
												  verticalbuttons: true,
												  verticalupclass: 'glyphicon glyphicon-plus',
												  verticaldownclass: 'glyphicon glyphicon-minus'
												});
											</script>
										</div>
										<div class="form-group" style="padding:10px; margin-top:10px;">
											<label>Berat NonKomoditi</label>
											<input type="text" class="form-control" id="noncommodity" name="noncommodity" value="<?php echo $r['noncommodity']; ?> Kg" disabled />
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group" style="padding:10px; margin-top:0px;">
											<label>Status Mitra</label>
											<select class="form-control" name="laborer" id="laborer" disabled >
												<option value="<?php echo $r['laborer_sts']; ?>">
													<?php echo $r['laborer_sts']; ?>
												</option>
												<option value="Tidak">Tidak</option>
												<option value="Ya">Ya</option>
											</select>
										</div>
										<div class="form-group" style="padding:10px; margin-top:10px;">
											<label>Berat Bersih (Netto)</label>
											<input type="text" class="form-control" id="netto" name="netto" value="<?php echo $r['netto']; ?> Kg" disabled />
										</div>
										<div class="form-group" style="padding:10px; margin-top:10px;">
											<label>Total Biaya</label>
											<input type="text" class="form-control" id="trans_total" name="trans_total" value="<?php echo format_rupiah($r['cost']); ?>" disabled>       
										</div>
										<div class="form-group" style="padding:10px; margin-top:10px;">
									</div>
									</div>
									<div class="col-md-3">
										<div class="form-group" style="padding:10px; margin-top:0px; ">
											<label>Jam & Tgl Masuk</label>
											<input type="text" class="form-control" value="<?php echo date("G:i", strtotime($r['time_in'])).' & '.date("d-m-Y", strtotime($r['date_in'])); ?>" disabled />
										</div>
										<div class="form-group" style="padding:10px;">
											<label>Jam & Tanggal Keluar</label>
											<input type="text" class="form-control" value="<?php echo date("G:i", strtotime($r['time_out'])).' & '.date("d-m-Y", strtotime($r['date_out'])); ?>" disabled />
										</div>
										<div class="form-group" style="padding:10px;">
											<label>Penerima Uang</label>
											<select class="form-control" name="receiver" id="receiver" required>
												<option value="<?php echo $data['receiver_id'];?>"><?php echo $receiver;?></option>
												<?php 
													$sql 		= mysql_query("select checker_id, checker_name from checker order by checker_name");
													while($data = mysql_fetch_array($sql))
												{?>
													<option value="<?php echo $data['checker_id'];?>"><?php echo $data['checker_name'];?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group" style="margin-right:0px; margin-left:0px; margin-top:-30px;">
											<button type="submit" class="btn btn-block btn-outline btn-primary">
												Bayar
											</button>
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
			$('#Area1').load("pay_table.php",function(){clearNotif();});
			setTimeout('$("html").removeClass("js")',1000); 
			
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
			window.location=('weighing_action.php?task=merge&id=<?php echo $r['merchant_id']; ?>');
		}
		function breakdown(){
			window.location=('weighing_action.php?task=breakdown&id=<?php echo $id; ?>');
		}
		function clearNotif(){$("#notifArea").html("");}
    </script>
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/plugins/metisMenu/metisMenu.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="js/sb-admin-2.js"></script>
</body>
</html>
<?php } ?>