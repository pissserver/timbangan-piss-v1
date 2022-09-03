<?php
	session_start();
	include "connection.php";
	//Validasi role
	if($_SESSION['checker']=='')
	{
		header("Location:login.html");
	}
	function headScript(){
		$headScript=file_get_contents("headScript.html");
		return $headScript;
	}
	$admin 		= executeScalar("select checker_name from checker where checker_code = '".$_SESSION['checker']."'");
	
	$id			= $_POST['id_nota'];
	$edit		= mysql_query("select * from weighing where weighing_id = '".$id."'");
	while ($r 	= mysql_fetch_array($edit)){
		$kasir 		= executeScalar("select checker_name from checker where checker_id = '".$r['checker_id']."'");
		$merchant 	= executeScalar("select merchant_name from merchant where merchant_id = '".$r['merchant_id']."'");
		$nick	 	= executeScalar("select merchant_nick from merchant where merchant_id = '".$r['merchant_id']."'");
		$checker_id = executeScalar("select receiver_id from ko where ko_id = '".$r['ko_id']."'");
		$checker	= executeScalar("select checker_name from checker where checker_id = '".$checker_id."'");
		$cashier_id = executeScalar("select cashier_id from ko where ko_id = '".$r['ko_id']."'");
		$cashier	= executeScalar("select checker_name from checker where checker_id = '".$cashier_id."'");
		$lid 		= executeScalar("select lapak_id from rent where merchant_id = '".$r['merchant_id']."'");
		$lpk 		= executeScalar("select lapak_name from lapak where lapak_id = '".$lid."'");
		$goods 		= executeScalar("select goods_name from goods where goods_id='".$r['goods_id']."'");
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
								<li><a href="check.php"><i class="fa fa-check-square-o fa-fw"></i> Pengecekan / Edit</a></li>
								<li><a class="active" href="index5.php"><i class="fa fa-search fa-fw"></i> Listing Nota</a></li>
							</ul>
						</li>
						<li><a href="#"><i class="fa fa-money fa-fw"></i> Pembayaran<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li><a href="pay.php"><i class="fa fa-money fa-fw"></i> Pembayaran</a></li>
								<li><a href="pay_acc.php"><i class="fa fa-money fa-fw"></i> Setoran KO</a></li>
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
                            <i class="fa fa-truck fa-fw"></i> Detail Data Timbangan
							(<?php 
								$wid = sprintf("%07d", $id);
								
								if($r['weighing_sts']=='Keluar'||$r['weighing_sts']=='Lunas'){
									$year = executeScalar("select date_format(date_out, '%y') from weighing where weighing_id = '".$r['weighing_id']."'");
									echo 'TG'.$year.$wid;
								}else{
									$year = executeScalar("select date_format(date_in, '%y') from weighing where weighing_id = '".$r['weighing_id']."'");
									echo 'TB'.$year.$wid;
								} ?>)
                        </div>
                        <div class="panel-body">
							<div class="row">
								<div class="col-md-3">
									<div class="form-group" style="margin-bottom:20px;">
										<label>Nopol</label>
										<input type="text" class="form-control" id="nopol" name="nopol" value="<?php echo $r['nopol']; ?>" disabled>                  
									</div>
									<div class="form-group" style="margin-bottom:20px;">
										<label>Pedagang</label>
										<select class="form-control" name="merchant" id="merchant" disabled>
											<option value="<?php echo $r['merchant_id']; ?>"><?php echo $nick.' / '.$merchant.' / '.$lpk; ?></option>
										</select>
									</div>
									<div class="form-group" style="margin-bottom:20px;">
										<label>Barang</label>
										<select class="form-control" name="goods" id="goods" disabled>
											<option value="<?php echo $r['goods_id']; ?>" required><?php echo $goods; ?></option>
										</select>
									</div>
									<div class="form-group" style="margin-bottom:20px;">
										<label>Tanggal & Jam Masuk</label>
										<input type="text" class="form-control" id="date_in" name="date_in" value="<?php echo date("d-m-Y", strtotime($r['date_in'])).' | '.date("H:s", strtotime($r['time_in'])); ?>" disabled>                  
									</div>
									<div class="form-group" style="margin-bottom:20px;">
										<label>Tanggal & Jam Keluar</label>
										<input type="text" class="form-control" id="date_out" name="date_out" value="<?php echo date("d-m-Y", strtotime($r['date_out'])).' | '.date("H:s", strtotime($r['time_out'])); ?>" disabled>                  
									</div>
									<div class="form-group" style="margin-bottom:20px;">
										<label>Tanggal Pembuatan Nota</label>
										<input type="text" class="form-control" id="date_check" name="date_check" value="<?php 
										if($r['date_check']!=null){
											echo date("d-m-Y", strtotime($r['date_check'])).' | '.date("H:s", strtotime($r['date_check']));
										}?>" disabled >                  
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group" style="margin-bottom:20px;">
										<label>Berat Kendaraan Masuk</label>
										<input type="text" class="form-control" id="weight_in" name="weight_in" value="<?php echo number_format($r['weight_in']).' Kg'; ?>" disabled>
									</div>
									<div class="form-group" style="margin-bottom:20px;">
										<label>Berat Kendaraan Keluar</label>
										<input type="text" class="form-control" id="weight_out" name="weight_out" value="<?php echo number_format($r['weight_out']).' Kg'; ?>" disabled >
									</div>
									<div class="form-group" style="margin-bottom:20px;">
										<label>Berat NonKomoditi</label>
										<input type="text" class="form-control" id="noncommodity" name="noncommodity" value="<?php echo number_format($r['noncommodity']).' Kg'; ?>" disabled />
									</div>
									<div class="form-group" style="margin-bottom:20px;">
										<label>Rafaksi</label>
										<input type="text" class="form-control" id="rafaksi" name="rafaksi" value="<?php echo number_format($r['rafaksi']).' Kg'; ?>" disabled >                  
									</div>
									<div class="form-group" style="margin-bottom:20px;">
										<label>Berat Bersih (Netto)</label>
										<input type="text" class="form-control" id="netto" name="netto" value="<?php echo number_format($r['netto']); ?> Kg" disabled />
									</div>
									<div class="form-group" style="margin-bottom:20px;">
										<label>Total Biaya</label>
										<input type="text" class="form-control" id="trans_total" name="trans_total" value="<?php echo format_rupiah($r['cost']); ?>" disabled>       
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group" style="margin-bottom:20px;">
										<label>Status Mitra</label>
										<select class="form-control" name="laborer" id="laborer" disabled>
											<option value="<?php echo $r['laborer_sts']; ?>">
												<?php echo $r['laborer_sts']; ?>
											</option>
										</select>
									</div>
									<div class="form-group" style="margin-bottom:20px;">
										<label>Status Kendaraan</label>
										<input type="text" class="form-control" value="<?php echo $r['weighing_sts']; ?>" disabled>  
									</div>
									<div class="form-group" style="margin-bottom:20px;">
										<label>Status Nota</label>
										<input type="text" class="form-control" value="<?php echo $r['weighing_sts2']; ?>" disabled>  
										</select>
									</div>
									<div class="form-group" style="margin-bottom:20px;">
										<label>Nota Refrensi</label>
										<input type="text" class="form-control" id="reff" name="reff" value="<?php 
										if($r['reffer']!=null){
											$wid = sprintf("%07d", $r['reffer']);
											$year = executeScalar("select date_format(date_out, '%y') from weighing where weighing_id = '".$r['weighing_id']."'");
											echo 'TG'.$year.$wid;
										}else{
											echo 'Tidak Ada';
										} ?>" disabled>
									</div>
									<div class="form-group" style="margin-bottom:20px;">
										<label>Status Print</label>
										<input type="text" class="form-control" value="<?php echo $r['p1'].' '.$r['p2']; ?>" disabled>  
										</select>
									</div>
									<div class="form-group" style="margin-bottom:20px;">
										<label>Tanggal Bayar</label>
										<input type="text" class="form-control" id="date_out" name="date_out" value="<?php 
										if($r['date_pay']!=null){
											echo date("d-m-Y", strtotime($r['date_pay'])).' | '.date("H:s", strtotime($r['time_pay']));
										}?>" disabled >
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group" style="margin-bottom:20px;">
										<label>Kasir</label>
										<input type="text" class="form-control" value="<?php echo $kasir; ?>" disabled>  
									</div>
									<div class="form-group" style="margin-bottom:20px;">
										<label>Penyetor Uang</label>
										<input type="text" class="form-control" value="<?php echo $checker; ?>" disabled>  
									</div>
									<div class="form-group" style="margin-bottom:20px;">
										<label>Penerima Uang</label>
										<input type="text" class="form-control" value="<?php echo $cashier; ?>" disabled>  
									</div>
									<div class="form-group" style="margin-bottom:20px;">
										<label>KO ID</label>
										<input type="text" class="form-control" value="<?php echo $r['ko_id']; ?>" disabled>  
									</div>
									<div class="form-group" style="margin-bottom:20px;">
										<label>KM ID</label>
										<input type="text" class="form-control" value="<?php echo $r['km_id']; ?>" disabled>  
									</div>
									<div>
										<label>Detail NonKomoditi </label>
										<button onclick="nonkomoditi()" type="button" class="btn btn-block btn-outline btn-info">
											Detail NonKomoditi
										</button>
									</div>
								</div>
								<div class="form-group" style="padding:10px; margin-left:15px; margin-right:15px; margin-top:-10px;">
									<a href="javascript:history.back()"><button type="button"  class="btn btn-block btn-outline btn-primary">
										Kembali
									</button></a>
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
						<div class="alert alert-info" onclick="clearNotif()"><h3><i class="fa fa-spinner fa-spin"></i> Loading...</h3></div>
					</div>
					<input type="hidden" id="value_id" />
				</div>
				<div class="modal-footer">
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal fade" id="modalNonkomoditi" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 id="header_nonkomoditi">Detail Data Barang Non Komoditi</h4>
				</div>
				<div class="modal-body">
					<div id="data_nonkomoditi" style="margin-bottom: 0px;">
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
			
			//Modal Password
			$('#modalPassword').on('shown.bs.modal', function (e) {
				$("#notifArea").html(alertLoadProcess);
				$("#data_password").load("password.php",function(){clearNotif();});
			});
			
			$('#modalNonkomoditi').on('shown.bs.modal', function (e)
			{
				$("#notifArea").html(alertLoadProcess);
				$("#data_nonkomoditi").load("modal_nonkomoditi_detail.php?id=<?php echo $id; ?>",function(){clearNotif();});
			});
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
	<script type="text/javascript">
    	function nonkomoditi()
    	{
			$('#modalNonkomoditi').modal('show');
		}
    </script>
</body>
</html>
<?php } ?>