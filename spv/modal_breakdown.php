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
	
	$id = $_GET['id'];
?>
<div class="row">
	<form action="weighing_action.php?task=breakdown&id=<?php echo $id; ?>" method="POST" class="form-horizontal" id="formPecahNota" name="formPecahNota">
		<fieldset>
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-8">
						<label>Pedagang 1</label>
						<select class="form-control" name="mc1" id="mc1">
							<option value="">Pilih Pedagang</option>
							<?php 
								$sql 		= mysql_query("select merchant_id, merchant_name, merchant_nick from merchant order by merchant_nick, merchant_name");
								while($d1 	= mysql_fetch_array($sql)){
									$lid 	= executeScalar("select lapak_id from rent where merchant_id = '".$d1['merchant_id']."'");
									$lpk 	= executeScalar("select lapak_name from lapak where lapak_id = '".$lid."'");
									$nick2	= executeScalar("select merchant_nick from merchant where merchant_id = '".$d1['merchant_id']."'");
									if($nick2!=''){
										$nick2 = $nick2.' /  ';
									}
									else{
										$nick2 = '';
									}
								?>
								<option value="<?php echo $d1['merchant_id'];?>"><?php echo $nick2.$d1['merchant_name'].' / '.$d1['merchant_id'].' / '.$lpk;?></option>
							<?php } ?>
						</select>
						<label>Pedagang 2</label>
						<select class="form-control" name="mc2" id="mc2">
							<option value="">Pilih Pedagang</option>
							<?php 
								$sql 	= mysql_query("select merchant_id, merchant_name, merchant_nick from merchant order by merchant_nick, merchant_name");
								while($d1 = mysql_fetch_array($sql)){
								$lid 	= executeScalar("select lapak_id from rent where merchant_id = '".$d1['merchant_id']."'");
								$lpk 	= executeScalar("select lapak_name from lapak where lapak_id = '".$lid."'");
								$nick2	= executeScalar("select merchant_nick from merchant where merchant_id = '".$d1['merchant_id']."'");
									if($nick2!=''){
										$nick2 = $nick2.' /  ';
									}
									else{
										$nick2 = '';
									}
								?>
								<option value="<?php echo $d1['merchant_id'];?>"><?php echo $nick2.$d1['merchant_name'].' / '.$d1['merchant_id'].' / '.$lpk;?></option>
							<?php } ?>
						</select>
						<label>Pedagang 3</label>
						<select class="form-control" name="mc3" id="mc3">
							<option value="">Pilih Pedagang</option>
							<?php 
								$sql 	= mysql_query("select merchant_id, merchant_name, merchant_nick from merchant order by merchant_nick, merchant_name");
								while($d1 = mysql_fetch_array($sql)){
								$lid 	= executeScalar("select lapak_id from rent where merchant_id = '".$d1['merchant_id']."'");
								$lpk 	= executeScalar("select lapak_name from lapak where lapak_id = '".$lid."'");
								$nick2	= executeScalar("select merchant_nick from merchant where merchant_id = '".$d1['merchant_id']."'");
									if($nick2!=''){
										$nick2 = $nick2.' /  ';
									}
									else{
										$nick2 = '';
									}
								?>
								<option value="<?php echo $d1['merchant_id'];?>"><?php echo $nick2.$d1['merchant_name'].' / '.$d1['merchant_id'].' / '.$lpk;?></option>
							<?php } ?>
						</select>
						<label>Pedagang 4</label>
						<select class="form-control" name="mc4" id="mc4">
							<option value="">Pilih Pedagang</option>
							<?php 
								$sql 	= mysql_query("select merchant_id, merchant_name, merchant_nick from merchant order by merchant_nick, merchant_name");
								while($d1 = mysql_fetch_array($sql)){
								$lid 	= executeScalar("select lapak_id from rent where merchant_id = '".$d1['merchant_id']."'");
								$lpk 	= executeScalar("select lapak_name from lapak where lapak_id = '".$lid."'");
								$nick2	= executeScalar("select merchant_nick from merchant where merchant_id = '".$d1['merchant_id']."'");
									if($nick2!=''){
										$nick2 = $nick2.' /  ';
									}
									else{
										$nick2 = '';
									}
								?>
								<option value="<?php echo $d1['merchant_id'];?>"><?php echo $nick2.$d1['merchant_name'].' / '.$d1['merchant_id'].' / '.$lpk;?></option>
							<?php } ?>
						</select>
						<label>Pedagang 5</label>
						<select class="form-control" name="mc5" id="mc5">
							<option value="">Pilih Pedagang</option>
							<?php 
								$sql 	= mysql_query("select merchant_id, merchant_name, merchant_nick from merchant order by merchant_nick, merchant_name");
								while($d1 = mysql_fetch_array($sql)){
								$lid 	= executeScalar("select lapak_id from rent where merchant_id = '".$d1['merchant_id']."'");
								$lpk 	= executeScalar("select lapak_name from lapak where lapak_id = '".$lid."'");
								$nick2	= executeScalar("select merchant_nick from merchant where merchant_id = '".$d1['merchant_id']."'");
									if($nick2!=''){
										$nick2 = $nick2.' /  ';
									}
									else{
										$nick2 = '';
									}
								?>
								<option value="<?php echo $d1['merchant_id'];?>"><?php echo $nick2.$d1['merchant_name'].' / '.$d1['merchant_id'].' / '.$lpk;?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-md-4" style="margin-left:-20px;margin-right:-20px;">
						<label>Netto(Kg)</label>
						<input type="number" value="0" id="n1" name="n1" class="form-control" placeholder="Netto">
						<label>Netto(Kg)</label>
						<input type="number" value="0" id="n2" name="n2" class="form-control" placeholder="Netto">
						<label>Netto(Kg)</label>
						<input type="number" value="0" id="n3" name="n3" class="form-control" placeholder="Netto">
						<label>Netto(Kg)</label>
						<input type="number" value="0" id="n4" name="n4" class="form-control" placeholder="Netto">
						<label>Netto(Kg)</label>
						<input type="number" value="0" id="n5" name="n5" class="form-control" placeholder="Netto">
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-8" style="margin-left:-20px;">
						<label>Pedagang 6</label>
						<select class="form-control" name="mc6" id="mc6">
							<option value="">Pilih Pedagang</option>
							<?php 
								$sql 	= mysql_query("select merchant_id, merchant_name, merchant_nick from merchant order by merchant_nick, merchant_name");
								while($d1 = mysql_fetch_array($sql)){
								$lid 	= executeScalar("select lapak_id from rent where merchant_id = '".$d1['merchant_id']."'");
								$lpk 	= executeScalar("select lapak_name from lapak where lapak_id = '".$lid."'");
								$nick2	= executeScalar("select merchant_nick from merchant where merchant_id = '".$d1['merchant_id']."'");
									if($nick2!=''){
										$nick2 = $nick2.' /  ';
									}
									else{
										$nick2 = '';
									}
								?>
								<option value="<?php echo $d1['merchant_id'];?>"><?php echo $nick2.$d1['merchant_name'].' / '.$d1['merchant_id'].' / '.$lpk;?></option>
							<?php } ?>
						</select>
						<label>Pedagang 7</label>
						<select class="form-control" name="mc7" id="mc7">
							<option value="">Pilih Pedagang</option>
							<?php 
								$sql 	= mysql_query("select merchant_id, merchant_name, merchant_nick from merchant order by merchant_nick, merchant_name");
								while($d1 = mysql_fetch_array($sql)){
								$lid 	= executeScalar("select lapak_id from rent where merchant_id = '".$d1['merchant_id']."'");
								$lpk 	= executeScalar("select lapak_name from lapak where lapak_id = '".$lid."'");
								$nick2	= executeScalar("select merchant_nick from merchant where merchant_id = '".$d1['merchant_id']."'");
									if($nick2!=''){
										$nick2 = $nick2.' /  ';
									}
									else{
										$nick2 = '';
									}
								?>
								<option value="<?php echo $d1['merchant_id'];?>"><?php echo $nick2.$d1['merchant_name'].' / '.$d1['merchant_id'].' / '.$lpk;?></option>
							<?php } ?>
						</select>
						<label>Pedagang 8</label>
						<select class="form-control" name="mc8" id="mc8">
							<option value="">Pilih Pedagang</option>
							<?php 
								$sql 	= mysql_query("select merchant_id, merchant_name, merchant_nick from merchant order by merchant_nick, merchant_name");
								while($d1 = mysql_fetch_array($sql)){
								$lid 	= executeScalar("select lapak_id from rent where merchant_id = '".$d1['merchant_id']."'");
								$lpk 	= executeScalar("select lapak_name from lapak where lapak_id = '".$lid."'");
								$nick2	= executeScalar("select merchant_nick from merchant where merchant_id = '".$d1['merchant_id']."'");
									if($nick2!=''){
										$nick2 = $nick2.' /  ';
									}
									else{
										$nick2 = '';
									}
								?>
								<option value="<?php echo $d1['merchant_id'];?>"><?php echo $nick2.$d1['merchant_name'].' / '.$d1['merchant_id'].' / '.$lpk;?></option>
							<?php } ?>
						</select>
						<label>Pedagang 9</label>
						<select class="form-control" name="mc9" id="mc9">
							<option value="">Pilih Pedagang</option>
							<?php 
								$sql 	= mysql_query("select merchant_id, merchant_name, merchant_nick from merchant order by merchant_nick, merchant_name");
								while($d1 = mysql_fetch_array($sql)){
								$lid 	= executeScalar("select lapak_id from rent where merchant_id = '".$d1['merchant_id']."'");
								$lpk 	= executeScalar("select lapak_name from lapak where lapak_id = '".$lid."'");
								$nick2	= executeScalar("select merchant_nick from merchant where merchant_id = '".$d1['merchant_id']."'");
									if($nick2!=''){
										$nick2 = $nick2.' /  ';
									}
									else{
										$nick2 = '';
									}
								?>
								<option value="<?php echo $d1['merchant_id'];?>"><?php echo $nick2.$d1['merchant_name'].' / '.$d1['merchant_id'].' / '.$lpk;?></option>
							<?php } ?>
						</select>
						<label>Pedagang 10</label>
						<select class="form-control" name="mc10" id="mc10">
							<option value="">Pilih Pedagang</option>
							<?php 
								$sql 	= mysql_query("select merchant_id, merchant_name, merchant_nick from merchant order by merchant_nick, merchant_name");
								while($d1 = mysql_fetch_array($sql)){
								$lid 	= executeScalar("select lapak_id from rent where merchant_id = '".$d1['merchant_id']."'");
								$lpk 	= executeScalar("select lapak_name from lapak where lapak_id = '".$lid."'");
								$nick2	= executeScalar("select merchant_nick from merchant where merchant_id = '".$d1['merchant_id']."'");
									if($nick2!=''){
										$nick2 = $nick2.' /  ';
									}
									else{
										$nick2 = '';
									}
								?>
								<option value="<?php echo $d1['merchant_id'];?>"><?php echo $nick2.$d1['merchant_name'].' / '.$d1['merchant_id'].' / '.$lpk;?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-md-4" style="margin-left:-20px;margin-right:-20px;">
						<label>Netto(Kg)</label>
						<input type="number" value="0" id="n6" name="n6" class="form-control" placeholder="Netto">
						<label>Netto(Kg)</label>
						<input type="number" value="0" id="n7" name="n7" class="form-control" placeholder="Netto">
						<label>Netto(Kg)</label>
						<input type="number" value="0" id="n8" name="n8" class="form-control" placeholder="Netto">
						<label>Netto(Kg)</label>
						<input type="number" value="0" id="n9" name="n9" class="form-control" placeholder="Netto">
						<label>Netto(Kg)</label>
						<input type="number" value="0" id="n10" name="n10" class="form-control" placeholder="Netto">
					</div>
				</div>
			</div>
		</fieldset>
		<div class="col-md-12">
			<button style="" type="submit" class="btn btn-block btn-outline btn-primary">Simpan</button>
		</div>
	</form>
</div>