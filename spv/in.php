<?php
	include "../connection.php";
?>
<div class="panel panel-primary">
	<div class="panel-heading">
		<i class="fa fa-truck fa-fw"></i> Data Kendaraan Masuk
	</div>
	<div class="panel-body">
		<div class="row">
			<form class="form-horizontal" id="formWeighingIn" name="formWeighingIn" method="POST" action="weighing_action.php?task=in">
				<fieldset>
					<div class="col-md-4">
						<div class="form-group" style="padding:10px; margin-top:-10px;">
							<label>Nopol</label>
							<input type="text" class="form-control" id="nopol" name="nopol" placeholder="Nopol Kendaraan" autofocus="autofocus" required>                  
						</div>
						<div class="form-group" style="padding:10px; margin-top:-10px;">
							<label>Pedagang</label>
							<select class="form-control" name="merchant" id="merchant" required>
								<option value="">- Pilih Pedagang -</option>
								<?php 
									$sql 	= mysql_query("	select merchant_id, merchant_name, merchant_nick from merchant 
									where merchant_status = 'Aktif' order by merchant_nick, merchant_name");
									while($d1 = mysql_fetch_array($sql)){
										$lpk 	= executeScalar("select l.lapak_name from rent r, lapak l 
										where r.lapak_id = l.lapak_id and r.merchant_id = '".$d1['merchant_id']."'
										and r.rent_sts != 'Batal' and r.rent_sts2 != 'Pindah' limit 1");
										$nick	= executeScalar("select merchant_nick from merchant where merchant_id = '".$d1['merchant_id']."'");
										if($nick!=''){
											$nick = $nick.' / ';
										}
										else{
											$nick = '';
										}
								?>
									<option value="<?php echo $d1['merchant_id'];?>"><?php echo $nick.$d1['merchant_name'].' / '.$d1['merchant_id'].' / '.$lpk;?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group" style="padding:10px; margin-top:-10px;">
							<label>Barang</label>
							<select class="form-control" name="goods" id="goods" required>
								<option value="">- Pilih Barang -</option>
								<?php 
									$sql2 		= mysql_query("select goods_id, goods_name from goods order by goods_name");
									while($d2 = mysql_fetch_array($sql2))
								{?>
									<option value="<?php echo $d2['goods_id'];?>"><?php echo $d2['goods_name'];?></option>
								<?php } ?>
							</select>                 
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group" style="padding:10px; margin-top:-10px;">
							<label>Berat Kendaraan Masuk</label>
							<input id="weight_in" name="weight_in" placeholder="Berat Masuk (Kg)" type="number" class="form-control" required>                  
						</div>
						<div class="form-group" style="padding:10px; margin-top:-10px;">
							<label>Tanggal Masuk</label>
							<input id="date_in" name="date_in" type="date" class="form-control" required> 
						</div>
						<div class="form-group" style="padding:10px; margin-top:-10px;">
							<label>Jam Masuk</label>
							<input id="time_in" name="time_in" type="time" class="form-control" required>                  
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group" style="padding:10px; margin-top:-10px;">
							<label>Kasir / Checker</label>
							<select class="form-control" name="checker" id="checker" required>
								<option value="" >- Pilih Kasir / Checker -</option>
								<?php 
									$sql 		= mysql_query("select checker_id, checker_name from checker 
									where checker_sts = 'Aktif' order by checker_name");
									while($data = mysql_fetch_array($sql))
								{?>
									<option value="<?php echo $data['checker_id'];?>"><?php echo $data['checker_name'];?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group" style="padding:10px; margin-top:-10px;">
							<label>Alasan Edit</label>
							<input id="reason" name="reason" placeholder="Alasan Mengapa Diedit" type="text" class="form-control" required>                  
						</div>
						<div class="form-group" style="padding:10px; margin-top:30px;">
							<center><button type="submit" class="btn btn-primary btn-block">Masuk <i class="fa fa-angle-double-right fa-lg"></i></button></center>
						</div>
					</div>
				</fieldset>
			</form>
		</div>
	</div>
</div>