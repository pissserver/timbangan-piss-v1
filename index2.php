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
	$edit	= mysql_query("select * from weighing where weighing_id = '".$id."'");
	while ($r = mysql_fetch_array($edit)){
		$merchant = executeScalar("select merchant_name from merchant where merchant_id = '".$r['merchant_id']."'");
		$nick	= executeScalar("select merchant_nick from merchant where merchant_id = '".$r['merchant_id']."'");
		$lpk 	= executeScalar("select l.lapak_name from rent r, lapak l 
		where r.lapak_id = l.lapak_id and r.merchant_id = '".$r['merchant_id']."'
		and r.rent_sts != 'Batal' and r.rent_sts2 != 'Pindah' limit 1");
		$goods 	= executeScalar("select goods_name from goods where goods_id='".$r['goods_id']."'");
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
    <title>Timbangan Keluar | PISS</title>
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
						<li class="active"><a href="#"><i class="fa fa-balance-scale fa-fw"></i> Timbangan<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li><a class="active" href="index.php"><i class="fa fa-truck fa-fw"></i> Masuk / Keluar</a></li>
								<li><a href="index4.php"><i class="fa fa-truck fa-fw"></i> Retail</a></li>
								<li><a href="check2.php"><i class="fa fa-square-o fa-fw"></i> Nota Yg Belum Dicek</a></li>
								<li><a href="check.php"><i class="fa fa-check-square-o fa-fw"></i> Pengecekan / Edit</a></li>
								<li><a href="index5.php"><i class="fa fa-search fa-fw"></i> Listing Nota</a></li>
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
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-truck fa-fw"></i> Kendaraan Keluar
                        </div>
                        <div class="panel-body">
							<div class="row">
								<form action="weighing_action.php?task=keluar&id=<?php echo $id; ?>" class="form-horizontal" id="formTransOut" name = "formTransOut" method="POST" >
									<div class="row">
										<div class="col-md-4">
											<form action="weighing_action.php?task=edit&id=<?php echo $id; ?>" class="form-horizontal" id="formTransOut" name = "formTransOut" method="POST" >
											<div class="form-group" style="padding:10px; margin-top:-10px; margin-left:10px;">
												<label>Nopol</label>
												<input type="text" class="form-control" id="nopol" name="nopol" value="<?php echo $r['nopol']; ?>" autofocus="autofocus" required>                  
											</div>
											<div class="form-group" style="padding:10px; margin-top:-10px; margin-left:10px;">
												<label>Pedagang</label>
												<select class="form-control" name="merchant" id="merchant">
													<option value="<?php echo $r['merchant_id']; ?>" required><?php echo $nick.' / '.$merchant.' / '.$lpk; ?></option>
													<?php 
													$sql = mysql_query("select merchant_id, merchant_name, merchant_nick from merchant where merchant_status = 'Aktif' order by merchant_nick, merchant_name");
													while($d1 = mysql_fetch_array($sql)){
													$lpk 	= executeScalar("select l.lapak_name from rent r, lapak l 
													where r.lapak_id = l.lapak_id and r.merchant_id = '".$d1['merchant_id']."'
													and r.rent_sts != 'Batal' and r.rent_sts2 != 'Pindah' limit 1");
													$nick2	= executeScalar("select merchant_nick from merchant where merchant_id = '".$d1['merchant_id']."'");
														if($nick2!=''){
															$nick2 = $nick2.' /  ';
														}
														else{
															$nick2 = '';
														}
													?>
													<option value="<?php echo $d1['merchant_id'];?>"><?php echo $nick.$d1['merchant_name'].' / '.$d1['merchant_id'].' / '.$lpk;?></option>
												<?php } ?>
												</select>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group" style="padding:10px; margin-top:-10px;">
												<label>Barang</label>
												<select class="form-control" name="goods" id="goods" required>
													<option value="<?php echo $r['goods_id']; ?>" required><?php echo $goods; ?></option>
													<?php
														$sql 		= mysql_query("select goods_id, goods_name from goods order by goods_name");
														while($data = mysql_fetch_array($sql))
													{?>
														<option value="<?php echo $data['goods_id'];?>"><?php echo $data['goods_name'];?></option>
													<?php } ?>
												</select>
											</div>
											<div class="form-group" style="padding:10px; margin-top:-10px;">
												<label>Berat Kendaraan Masuk</label>
												<input id="weight_in" name="weight_in" value="<?php echo $r['weight_in']; ?> Kg" type="text" style="text-align: right;" class="form-control"  disabled>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group" style="padding:10px; margin-right:10px; margin-top:15px;">
												<a href="htmltopdf/nota_timbangan.php?id=<?php echo $id;?>" target="_blank">
													<button type="button" class="btn btn-block btn-outline btn-info">
														<i class="fa fa-print fa-lg"></i> Print Nota Timbangan
													</button>
												</a>
											</div>
											<div class="form-group" style="padding:10px; margin-right:10px; margin-top:30px;">
													<button onclick="ubah()" type="button" class="btn btn-block btn-outline btn-info">
														<i class="fa fa-edit fa-lg"></i> Ubah 
													</button>
												</form>
											</div>
										</div>
										<div class="form-group" style="padding:10px; margin-left:20px; margin-right:20px; margin-top:30px;">
											<button type="submit" class="btn btn-block  btn-primary">
												Keluar <i class="fa fa-angle-double-right fa-lg"></i>
											</button>
										</div>
									</div>
								</form>
							</div>
							<br />
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
        </div>
    </div>
	
	<!-- Modal Ubah -->
	<div class="modal fade" id="modalUbah" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header modal-primary">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 id="header_ubah">Data Kendaraan (<?php 
					$wid = sprintf("%07d", $id);
					$year = executeScalar("select date_format(date_in, '%y') from weighing where weighing_id = '".$r['weighing_id']."'");
					echo 'TB'.$year.$wid; ?>)</h4>
				</div>
				<div class="modal-body">
					<div class="row" style=" margin-right:5px; margin-left:5px;">
						<form class="form-horizontal" id="formUbah" name="formUbah" method="POST" action="weighing_action.php?task=edit&id=<?php echo $id; ?>">
							<div class="col-md-6">
								<div class="form-group" style="padding:10px;">
									<label>Nopol</label>
									<input type="text" class="form-control" id="nopol" name="nopol" value="<?php echo $r['nopol']; ?>" autofocus="autofocus" required>
									<br /><label>Pedagang</label>
									<select class="form-control" name="merchant" id="merchant">
										<option value="<?php echo $r['merchant_id']; ?>" required><?php echo $nick.' / '.$merchant.' / '.$lpk; ?></option>
										<?php 
										$sql = mysql_query("select merchant_id, merchant_name, merchant_nick from merchant where merchant_status = 'Aktif' order by merchant_nick, merchant_name");
										while($d1 = mysql_fetch_array($sql)){
											$lpk 	= executeScalar("select l.lapak_name from rent r, lapak l 
											where r.lapak_id = l.lapak_id and r.merchant_id = '".$d1['merchant_id']."' limit 1");
											$nick	= $d1['merchant_nick'];
											if($nick!=''){
												$nick = $nick.' / ';
											}else{
												$nick = '';
											}
										?>
										<option value="<?php echo $d1['merchant_id'];?>"><?php echo $nick.$d1['merchant_name'].' / '.$d1['merchant_id'].' / '.$lpk;?></option>
									<?php } ?>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group" style="padding:10px;">
									<label>Barang</label>
									<select class="form-control" name="goods" id="goods" required>
										<option value="<?php echo $r['goods_id']; ?>" required><?php echo $goods; ?></option>
										<?php
											$sql = mysql_query("select goods_id, goods_name from goods where goods_id != '1' 
											and goods_id != '7' and goods_id != '96' and goods_id != '94' and goods_id != '95' 
											order by goods_name");
											while($data = mysql_fetch_array($sql))
										{?>
											<option value="<?php echo $data['goods_id'];?>"><?php echo $data['goods_name'];?></option>
										<?php } ?>
									</select>
								</div>
								<div class="form-group" style="padding:10px;">
									<button style="margin-right:10px; margin-top:10px; margin-left:0px;" type="submit" class="btn btn-block btn-primary">Simpan <i class="fa fa-angle-double-right fa-lg"></i></button>
								</div>
							</div>
						</form>
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
	<script>
		$(document).ready(function(){
			// Auto Refresh Page
			$("#notifArea").html(alertLoadProcess);
			$('#Area1').load("weighing_table.php",function(){clearNotif();});
			setTimeout('$("html").removeClass("js")',100); 
			
			// Auto Refresh Page
			/*$.ajaxSetup({ cache: false }); // This part addresses an IE bug.  without it, IE will only load the first number and will never refresh
			setInterval(function() {
				$('#weight_out').load('random.php');
			}, 1000);*/
			
			//Modal Password
			$('#modalPassword').on('shown.bs.modal', function (e) {
				$("#notifArea").html(alertLoadProcess);
				$("#data_password").load("password.php",function(){clearNotif();});
			})
		});
		function clearNotif(){$("#notifArea").html("");}
		//Memanggil modal nonkomoditi
		function ubah(){
			$('#modalUbah').modal('show');
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