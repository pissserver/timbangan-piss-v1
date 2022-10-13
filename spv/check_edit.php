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
	
	$id			= $_GET['id'];
	$edit		= mysql_query("select * from weighing where weighing_id = '".$id."'");
	while ($r 	= mysql_fetch_array($edit)){
		$merchant 	= executeScalar("select merchant_name from merchant where merchant_id = '".$r['merchant_id']."'");
		$nick	 	= executeScalar("select merchant_nick from merchant where merchant_id = '".$r['merchant_id']."'");
		$lid 		= executeScalar("select lapak_id from rent where merchant_id = '".$r['merchant_id']."'");
		$lpk 		= executeScalar("select lapak_name from lapak where lapak_id = '".$lid."'");
		$goods 		= executeScalar("select goods_name from goods where goods_id='".$r['goods_id']."'");
		$status 	= executeScalar("select weighing_sts from weighing where weighing_id = '".$id."'");
		$status2	= executeScalar("select weighing_sts2 from weighing where weighing_id = '".$id."'");
		$laborer_sts	= executeScalar("select laborer_sts from weighing where weighing_id = '".$id."'");
		if($r['noncommodity_id']!=0||$r['noncommodity_id']!=''){
			$nc1	= $r['noncommodity_id'];
			$nc2	= executeScalar("select noncommodity_name from noncommodity where noncommodity_id='".$nc1."'");
		}else{
			$nc1	= '';
			$nc2	= '- Pilih Jenis NonKomoditi -';
		}
		//cek tgl check
		$c 	= executeScalar("select date_check from weighing where weighing_id = '".$id."'");
		if($c!=''||$c!=null){ //Jika tgl check Tidak Kosong / Ada
			$c = 'C';
		}else{
			$c = '';
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
    <title>Detail Data Timbangan | PISS</title>
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
                        <li><a href="../logout.php"><i class="fa fa-sign-out fa-fw"></i> Keluar</a></li>
                    </ul>
                </li>
            </ul>
           
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
						<li class="active"> 
							<a href="#"><i class="fa fa-balance-scale fa-fw"></i> Timbangan<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li><a href="index.php"><i class="fa fa-truck fa-fw"></i> Masuk / Keluar</a></li>
								<li><a class="active" href="check.php"><i class="fa fa-check-square-o fa-fw"></i> Pengecekan / Edit</a></li>
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
						<li>
							<a href="#"><i class="fa fa-money fa-fw"></i> Acc Pembayaran<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li><a href="pay.php"><i class="fa fa-money fa-fw"></i> Pembayaran KM</a></li>
								<li><a href="pay_mitra.php"><i class="fa fa-money fa-fw"></i> Pembayaran Mitra</a></li>
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
                            <i class="fa fa-truck fa-fw"></i> Pengecekan Data Timbangan
							(<?php 
								$wid = sprintf("%07d", $id);
								
								if($status=='Keluar'||$status=='Lunas'){
									$year = executeScalar("select date_format(date_out, '%y') from weighing where weighing_id = '".$r['weighing_id']."'");
									// echo 'TG'.$year.$wid;
									echo 'TG'.$wid;
								}else{
									$year = executeScalar("select date_format(date_in, '%y') from weighing where weighing_id = '".$r['weighing_id']."'");
									// echo 'TB'.$year.$wid;
									echo 'TB'.$wid;
								} 
							?>)
                        </div>
                        <div class="panel-body">
							<div class="row">
								<form action="weighing_action.php?task=update&id=<?php echo $id; ?>" class="form-horizontal" id="formTransOut" name = "formTransOut" method="POST" >
								<fieldset>
									<div class="row">
										<div class="col-md-3">
											<div class="form-group" style="padding:10px; margin-top:-10px; margin-left:5px;">
												<label>Nopol</label>
												<input type="text" class="form-control" id="nopol" name="nopol" value="<?php echo $r['nopol']; ?>" required>                  
											</div>
											<div class="form-group" style="padding:10px; margin-top:-10px; margin-left:5px;">
												<label>Pedagang</label>
												<select class="form-control" name="merchant" id="merchant">
													<option value="<?php echo $r['merchant_id']; ?>" required><?php echo $merchant.' / '.$nick.' / '.$lpk; ?></option>
													<?php 
													$sql = mysql_query("select merchant_id, merchant_name, merchant_nick from merchant where merchant_status = 'Aktif' order by merchant_nick, merchant_name");
													while($d1 = mysql_fetch_array($sql)){
														$lpk2 	= executeScalar("select l.lapak_name from rent r, lapak l 
														where r.lapak_id = l.lapak_id and r.merchant_id = '".$d1['merchant_id']."' limit 1");
														$nick2	= $d1['merchant_nick'];
														if($nick2!=''){
															$nick2 = $nick2.' / ';
														}else{
															$nick2 = '';
														}
													?>
													<option value="<?php echo $d1['merchant_id'];?>"><?php echo $nick2.$d1['merchant_name'].' / '.$d1['merchant_id'].' / '.$lpk2;?></option>
												<?php } ?>
												</select>
											</div>
											<div class="form-group" style="padding:10px; margin-top:-10px; margin-left:5px;">
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
											<div class="form-group" style="padding:10px; margin-top:-10px; margin-left:5px;">
												<?php
													if($status=='Lunas'||$status=='Batal'||$status=='Masuk'||$status2=='Digabung'||$status2=='Dipecah'){
														echo '';
														//pecah nota
													}
													else{
														echo '<button onclick="pecahNota()" type="button" class="btn btn-block btn-outline btn-success">Pecah Nota</button>';
													}
													
													$out		= executeScalar("select count(weighing_id) from weighing where merchant_id = '".$r['merchant_id']."' and 
													weighing_sts = 'Keluar' and date_in = '$date_now'");
													$exist		= executeScalar("select count(weighing_id) from weighing where merchant_id = '".$r['merchant_id']."' and
													weighing_sts = 'Keluar' and date_in = '$date_now'");
													if($status=='Lunas'||$status=='Batal'||$status=='Masuk'){
														echo '';
													}
													elseif($exist>1&&$out>1){
														echo '<br /><button onclick="merge()" type="button" class="btn btn-block btn-outline btn-success">Gabung Nota</button>';
													}
													else{
														echo '';
														//gabung nota
													}
												?>
											</div>
											<div class="form-group" style="padding:10px; margin-top:-10px; margin-left:5px;">
												<?php
													if ($laborer_sts == 'Ya' ) {
														if($status=='Lunas'||$status=='Masuk'||$status2=='Digabung'||$status2=='Dipecah'||$c==NULL){
															echo '';//Print Nota Tagihan Jasa Bongkar
														}
														else{
															echo '<a href="../htmltopdf/nota_tagihan_mitra.php?id='.$id.'&u='.$admin.'" target="_blank">
																<button type="button" class="btn btn-block btn-outline btn-info">
																	Print Nota Tagihan Jasa Bongkar
																</button>
															</a>';
														}
													}else {
														echo '';
													}
												?>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group" style="padding:10px; margin-top:-10px;">
												<label>Berat Kendaraan Masuk</label>
												<input type="text" class="form-control" id="weight_in" name="weight_in" value="<?php echo $r['weight_in'].' Kg'; ?>" disabled>
											</div>
											<div class="form-group" style="padding:10px; margin-top:-10px;">
												<label>Berat Kendaraan Keluar</label>
												<input type="text" class="form-control" id="weight_out" name="weight_out" value="<?php echo $r['weight_out'].' Kg'; ?>" disabled >
											</div>
											<div class="form-group" style="padding:10px; margin-top:-10px;">
												<label>Berat NonKomoditi</label>
												<input type="text" class="form-control" id="noncommodity" name="noncommodity" value="<?php echo $r['noncommodity'].' Kg'; ?>" disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-10px;">
												<a href="../htmltopdf/nota_timbangan.php?id=<?php echo $id;?>" target="_blank">
													<button type="button" class="btn btn-block btn-outline btn-info">
														Print Nota Timbangan
													</button>
												</a>
											</div>
											<div class="form-group" style="padding:10px; margin-top:-10px;">
												<?php 
													if($status=='Lunas'||$status=='Masuk'||$status2=='Digabung'||$status2=='Dipecah'||$c==NULL){
														echo '';//Print Nota Tagihan
													}
													else{
														echo '<a href="../htmltopdf/nota_tagihan.php?id='.$id.'&u='.$admin.'" target="_blank">
															<button type="button" class="btn btn-block btn-outline btn-info">
																Print Nota Tagihan Tonase
															</button>
														</a>';
													}
												?>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group" style="padding:10px; margin-top:-10px;">
												<label>Status Mitra</label>
												<input id="laborer" name="laborer" value="<?php echo $r['laborer_sts']; ?>" type="text" class="form-control" disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-10px;">
												<label>Berat Bersih (Netto)</label>
												<input type="text" class="form-control" id="netto" name="netto" value="<?php echo $r['netto']; ?> Kg" disabled />
											</div>
											<div class="form-group" style="padding:10px; margin-top:-10px;">
												<label>Total Tagihan Tonase</label>
												<input type="text" class="form-control" id="trans_total" name="trans_total" value="<?php echo format_rupiah($r['cost']); ?>" disabled>       
											</div>
											<div class="form-group" style="padding:10px; margin-top:-10px;">
												<a href="mitra.php?id=<?php echo $id; ?>" data-toggle="modal" data-target="#modalMitra">
													<button type="button" class="btn btn-block btn-outline btn-info">
														Input Mitra
													</button>
												</a>
											</div>
											<div class="form-group" style="padding:10px; margin-top:-10px;">
												<?php 
													if($status=='Lunas'||$status=='Masuk'||$status2=='Digabung'||$status2=='Dipecah'){
														echo '';//Print Nota Tagihan
													}
													else{
														echo '<a href="../htmltopdf/weighing_result.php?id='.$id.'" target="_blank">
															<button type="button" class="btn btn-block btn-outline btn-info">
																Print Hasil Timbang
															</button>
														</a>';
													}
												?>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group" style="padding:10px; margin-top:-10px; margin-right:5px;">
												<div class="row">
													<div class="col-md-6">
														<label>Kendaraan</label>
														<input type="text" class="form-control" value="<?php echo $r['weighing_sts']; ?>" disabled>  
													</div>
													<div class="col-md-6" >
														<label>Status Nota</label>
														<input type="text" class="form-control" value="<?php echo $r['weighing_sts2']; ?>" disabled>  
														</select>
													</div>
												</div>
											</div>
											<div class="form-group" style="padding:10px; margin-right:5px; margin-top:-10px;">
												<label>Nota Refrensi</label>
												<input type="text" class="form-control" id="reff" name="reff" value="<?php 
												if($r['reffer']!=NULL){
													$wid = sprintf("%07d", $r['reffer']);
													$year = executeScalar("select date_format(date_out, '%y') from weighing where weighing_id = '".$r['weighing_id']."'");
													echo 'TG'.$year.$wid;
												} ?>" disabled>
											</div>
											<div class="form-group" style="padding:10px; margin-right:5px; margin-top:-10px;">
												<label>Status Print & Pengecekan</label>
												<input type="text" class="form-control" value="<?php echo $r['p1'].' '.$r['p2'].' '.$c; ?>" disabled>  
											</div>
											<div class="form-group" style="padding:10px; margin-right:5px; margin-top:-10px;">
												<select class="form-control" name="rafa" id="rafa" required>
													<?php 
														if($r['rafaksi']==''||$r['rafaksi']==0){
															echo '<option value="Tidak">Tanpa Rafaksi</option>';
															echo '<option value="Ya">Beri Rafaksi</option>';
														}
														elseif($r['rafaksi']!=''||$r['rafaksi']!=0){
															echo '<option value="'.$r['rafaksi'].'">Rafaksi '.$r['rafaksi'].' Kg </option>';
															echo '<option value="Tidak">Tanpa Rafaksi</option>';
														}
													?>
												</select>
											</div>
											<div class="form-group" style="padding:10px; margin-right:5px; margin-top:-10px;">
												<?php 
													if($status=='Lunas'||$status=='Batal'||$status2=='Digabung'||$status2=='Dipecah'){
														echo '';//Input Berat NonKomoditi
													}
													else{
														echo '<button onclick="nonkomoditi()" type="button" class="btn btn-block btn-outline btn-info">
															Input Berat NonKomoditi
														</button>';
													}
												?>
											</div>
										</div>
										<div class="form-group" style="padding:10px; margin-left:20px; margin-right:20px; margin-top:-10px; margin-bottom:0px;">
											<?php 
												if($status=='Lunas'||$status=='Batal'||$status2=='Digabung'||$status2=='Dipecah'||$status=='Masuk'){
													echo '';//Simpan
												}
												else{
													echo '<button type="submit" class="btn btn-block btn-outline btn-primary">
														Simpan
													</button> ';
												}
											?> 
										</div>
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
	
	<!-- Modal Mitra -->
	<div id="modalMitra" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><img src='../assets/image/Delete.png' width='25' height='25'/></button>
					<h4 id="header_password">Input Mitra</h4>
				</div>
				<div class="modal-body">
					<div id="data_mitra" style="margin-bottom: 0px;">
						<div class="alert alert-info" onclick="clearNotif()"><h3><i class="fa fa-spinner fa-spin"></i> Loading...</h3></div>
					</div>
					<input type="hidden" id="value_id" />
				</div>
				<div class="modal-footer">
				</div>
            </div>
        </div>
    </div>
	
	<!-- Modal nonkomoditi -->
	<div class="modal fade" id="modalNonkomoditi" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 id="header_nonkomoditi">Data Barang Non Komoditi</h4>
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
	
	<!-- Modal Pecah Nota -->
	<div class="modal fade" id="modalPecahNota" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 id="header_PecahNota">Pecah Nota</h4>
				</div>
				<div class="modal-body">
					<div id="data_breakdown" style="margin-bottom: 0px;">
						<div class="alert alert-info" onclick="clearNotif()"><h3><i class="fa fa-spinner fa-spin"></i> Loading...</h3></div>
					</div>
					<input type="hidden" id="value_id" />
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
<?php } ?>