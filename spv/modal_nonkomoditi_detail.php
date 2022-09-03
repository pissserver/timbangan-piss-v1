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
	<form class="form-horizontal" id="formNoncommodity" name = "formNoncommodity" method="POST" action="weighing_action.php?task=detail&id=<?php echo $id; ?>">
	<fieldset>
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-8">
					<div class="form-group" style="padding:10px;">
						<label>NonKomoditi 1</label>
						<select class="form-control" id="weight1" name="weight1" disabled>
							<?php 
								$ada 	= executeScalar("select count(weighing_id) from weighing_detail where weighing_id = '".$id."'");
								if($ada>0){
									$data1 	= executeScalar("select noncommodity1 from weighing_detail where weighing_id = '".$id."'");
									$data2 	= executeScalar("select noncommodity_name from noncommodity where noncommodity_id = '".$data1."'");
									$data3 	= executeScalar("select noncommodity_weight from noncommodity where noncommodity_id = '".$data1."'");
									if($data1==0){
										echo '<option value="">Jenis Nonkomoditi 1 </option>';
									}
									else
									{
										echo '<option value="'.$data1.'">'.$data2.' ('.$data3.' Kg)</option>';
									}
								}
								else
								{
									echo '<option value="" readonly>Jenis Nonkomoditi 1 </option>';
								}
							 
								$sql1 		= mysql_query("select * from noncommodity order by noncommodity_name");
								while($r1 = mysql_fetch_array($sql1))
								{
									echo '<option value="'.$r1['noncommodity_id'].'">'.$r1['noncommodity_name'].' ('.$r1['noncommodity_weight'].' Kg)</option>';
								}
							?>
						</select>
						<label>NonKomoditi 2</label>
						<select class="form-control" id="weight2" name="weight2" disabled>
							<?php 
								if($ada>0){
									$data3 	= executeScalar("select noncommodity2 from weighing_detail where weighing_id = '".$id."'");
									$data4 	= executeScalar("select noncommodity_name from noncommodity where noncommodity_id = '".$data3."'");
									if($data3==0){
										echo '<option value="">Jenis Nonkomoditi 2 </option>';
									}
									else{
										echo '<option value="'.$data3.'">'.$data4.'</option>';
									}
								}
								else{
									echo '<option value="" >Jenis Nonkomoditi 2 </option>';
								}
								$sql2 		= mysql_query("select * from noncommodity order by noncommodity_name");
								while($r2 = mysql_fetch_array($sql2)){
								echo '<option value="'.$r2['noncommodity_id'].'">'.$r2['noncommodity_name'].' ('.$r2['noncommodity_weight'].' Kg)</option>';
								} ?>
						</select>
						<label>NonKomoditi 3</label>
						<select class="form-control" id="weight3" name="weight3" disabled>
							<?php 
								if($ada>0){
									$data5 	= executeScalar("select noncommodity3 from weighing_detail where weighing_id = '".$id."'");
									$data6 	= executeScalar("select noncommodity_name from noncommodity where noncommodity_id = '".$data5."'");
									if($data5==0){
										echo '<option value="">Jenis Nonkomoditi 3 </option>';
									}
									else{
										echo '<option value="'.$data5.'">'.$data6.'</option>';
									}
								}
								else{
									echo '<option value="" >Jenis Nonkomoditi 3 </option>';
								}
								$sql3 		= mysql_query("select * from noncommodity order by noncommodity_name");
								while($r3 = mysql_fetch_array($sql3)){
								echo '<option value="'.$r3['noncommodity_id'].'">'.$r3['noncommodity_name'].' ('.$r3['noncommodity_weight'].' Kg)</option>';
								} ?>
						</select>
						<label>NonKomoditi 4</label>
						<select class="form-control" id="weight4" name="weight4" disabled>
							<?php 
								if($ada>0){
									$data7 	= executeScalar("select noncommodity4 from weighing_detail where weighing_id = '".$id."'");
									$data8 	= executeScalar("select noncommodity_name from noncommodity where noncommodity_id = '".$data7."'");
									if($data7==0){
										echo '<option value="">Jenis Nonkomoditi 4</option>';
									}
									else{
										echo '<option value="'.$data7.'">'.$data8.'</option>';
									}
								}
								else{
									echo '<option value="" >Jenis Nonkomoditi 4 </option>';
								}
								$sql4 		= mysql_query("select * from noncommodity order by noncommodity_name");
								while($r4 = mysql_fetch_array($sql4)){
								echo '<option value="'.$r4['noncommodity_id'].'">'.$r4['noncommodity_name'].' ('.$r4['noncommodity_weight'].' Kg)</option>';
								} ?>
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group" style="padding:10px;">
						<label>Jumlah</label>
						<input type="number" class="form-control" id="count1" name="count1" <?php 
						if($ada>0)
						{
							$count1 = executeScalar("select count1 from weighing_detail where weighing_id = '".$id."'");
							echo 'value="'.$count1.'"';
						}
						else{
							echo 'placeholder="Jumlah Barang"';
						}?> readonly >
						<label>Jumlah</label>
						<input type="number" class="form-control" id="count2" name="count2" <?php 
						if($ada>0){
							$count2 = executeScalar("select count2 from weighing_detail where weighing_id = '".$id."'");
							echo 'value="'.$count2.'"';
						}
						else{
							echo 'placeholder="Jumlah Barang"';
						}?> readonly >
						<label>Jumlah</label>
						<input type="number" class="form-control" id="count3" name="count3" <?php 
						if($ada>0){
							$count3 = executeScalar("select count3 from weighing_detail where weighing_id = '".$id."'");
							echo 'value="'.$count3.'"';
						}
						else{
							echo 'placeholder="Jumlah Barang"';
						}?> readonly >
						<label>Jumlah</label>
						<input type="number" class="form-control" id="count4" name="count4" <?php 
						if($ada>0){
							$count4 = executeScalar("select count4 from weighing_detail where weighing_id = '".$id."'");
							echo 'value="'.$count4.'"';
						}
						else{
							echo 'placeholder="Jumlah Barang"';
						}?> readonly>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-8">
					<div class="form-group" style="padding:10px;">
						<label>NonKomoditi 5</label>
						<select class="form-control" id="weight5" name="weight5" disabled>
							<?php 
								if($ada>0){
									$data9 		= executeScalar("select noncommodity5 from weighing_detail where weighing_id = '".$id."'");
									$data10 	= executeScalar("select noncommodity_name from noncommodity where noncommodity_id = '".$data9."'");
									if($data9==0){
										echo '<option value="">Jenis Nonkomoditi 5</option>';
									}
									else{
										echo '<option value="'.$data9.'">'.$data10.'</option>';
									}
								}
								else{
									echo '<option value="">Jenis Nonkomoditi 5 </option>';
								}
								$sql5 		= mysql_query("select * from noncommodity order by noncommodity_name");
								while($r5 = mysql_fetch_array($sql5)){
									echo '<option value="'.$r5['noncommodity_id'].'">'.$r5['noncommodity_name'].' ('.$r5['noncommodity_weight'].' Kg)</option>';
								} ?>
						</select>
						<label>NonKomoditi 6</label>
						<select class="form-control" id="weight6" name="weight6" disabled>
							<?php 
								if($ada>0){
									$data11 	= executeScalar("select noncommodity6 from weighing_detail where weighing_id = '".$id."'");
									$data12 	= executeScalar("select noncommodity_name from noncommodity where noncommodity_id = '".$data11."'");
									if($data11==0){
										echo '<option value="">Jenis Nonkomoditi 6</option>';
									}
									else{
										echo '<option value="'.$data11.'">'.$data12.'</option>';
									}
								}
								else{
									echo '<option value="" >Jenis Nonkomoditi 6 </option>';
								}
								$sql6 	= mysql_query("select * from noncommodity order by noncommodity_name");
								while($r6 = mysql_fetch_array($sql6)){
									echo '<option value="'.$r6['noncommodity_id'].'">'.$r6['noncommodity_name'].' ('.$r6['noncommodity_weight'].' Kg)</option>';
								} ?>
						</select>
						<label>NonKomoditi 7</label>
						<select class="form-control" id="weight7" name="weight7" disabled>
							<?php 
								if($ada>0){
									$data13 	= executeScalar("select noncommodity7 from weighing_detail where weighing_id = '".$id."'");
									$data14 	= executeScalar("select noncommodity_name from noncommodity where noncommodity_id = '".$data13."'");
									if($data13==0){
										echo '<option value="">Jenis Nonkomoditi 7</option>';
									}
									else{
										echo '<option value="'.$data13.'">'.$data14.'</option>';
									}
								}
								else{
									echo '<option value="" >Jenis Nonkomoditi 7 </option>';
								}
								$sql7 		= mysql_query("select * from noncommodity order by noncommodity_name");
								while($r7 = mysql_fetch_array($sql7)){
									echo '<option value="'.$r7['noncommodity_id'].'">'.$r7['noncommodity_name'].' ('.$r7['noncommodity_weight'].' Kg)</option>';
								} ?>
						</select>
						<label>NonKomoditi 8</label>
						<select class="form-control" id="weight8" name="weight8" disabled>
							<?php 
								if($ada>0){
									$data15 	= executeScalar("select noncommodity8 from weighing_detail where weighing_id = '".$id."'");
									$data16 	= executeScalar("select noncommodity_name from noncommodity where noncommodity_id = '".$data15."'");
									if($data15==0){
										echo '<option value="">Jenis Nonkomoditi 8</option>';
									}
									else{
										echo '<option value="'.$data15.'">'.$data16.'</option>';
									}
								}
								else{
									echo '<option value="" >Jenis Nonkomoditi 8 </option>';
								}
								$sql8 	= mysql_query("select * from noncommodity order by noncommodity_name");
								while($r8 = mysql_fetch_array($sql8)){
									echo '<option value="'.$r8['noncommodity_id'].'">'.$r8['noncommodity_name'].' ('.$r8['noncommodity_weight'].' Kg)</option>';
								} ?>
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group" style="padding:10px;">
						<label>Jumlah</label>
						<input type="number" class="form-control" id="count5" name="count5" <?php 
						if($ada>0){
							$count5 = executeScalar("select count5 from weighing_detail where weighing_id = '".$id."'");
							echo 'value="'.$count5.'"';
						}
						else{
							echo 'placeholder="Jumlah Barang"';
						}?> readonly >
						<label>Jumlah</label>
						<input type="number" class="form-control" id="count6" name="count6" <?php 
						if($ada>0){
							$count6 = executeScalar("select count6 from weighing_detail where weighing_id = '".$id."'");
							echo 'value="'.$count6.'"';
						}
						else{
							echo 'placeholder="Jumlah Barang"';
						}?> readonly >
						<label>Jumlah</label>
						<input type="number" class="form-control" id="count7" name="count7" <?php 
						if($ada>0){
							$count7 = executeScalar("select count7 from weighing_detail where weighing_id = '".$id."'");
							echo 'value="'.$count7.'"';
						}
						else{
							echo 'placeholder="Jumlah Barang"';
						}?> readonly >
						<label>Jumlah</label>
						<input type="number" class="form-control" id="count8" name="count8" <?php 
						if($ada>0){
							$count8 = executeScalar("select count8 from weighing_detail where weighing_id = '".$id."'");
							echo 'value="'.$count8.'"';
						}
						else{
							echo 'placeholder="Jumlah Barang"';
						}?> readonly >
					</div>
				</div>
			</div>
		</div>
	</fieldset>
	</form>
</div>