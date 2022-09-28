<?php
	session_start();
	include "connection.php";
	$id 	= $_GET['id'];
	$ada 	= executeScalar("select count(weighing_id) from laborer_fee where weighing_id = '".$id."' ");
?>
<div class="panel panel-info">
	<div class="panel-heading">
		<i class="fa fa-group fa-fw"></i> Data Mitra
	</div>
	<div class="panel-body">
		<div class="row">
			<form method="POST" action="weighing_action.php?task=Mitra&id=<?php echo $id; ?>" class="form-horizontal" id="formMitra" name="formMitra">
			<fieldset>
				<div class="col-md-4">
					<div class="form-group" style="padding:10px; margin-top:-10px;">
						<input type="checkbox" id="mitra[]" name="mitra[]" value="B001"  <?php if($ada>=1){
							$x 	= executeScalar("select sum(B001) from laborer_fee where weighing_id = '".$id."' ");
							if($x>0){echo 'checked';}} ?>><label class="light">Lukman F (B001)</label><br>
						<input type="checkbox" id="mitra[]" name="mitra[]" value="B002" <?php if($ada>=1){
							$x 	= executeScalar("select sum(B002) from laborer_fee where weighing_id = '".$id."' ");
							if($x>0){echo 'checked';}} ?>><label class="light">Fandeli (B002)</label><br>
						<input type="checkbox" id="mitra[]" name="mitra[]" value="B003" <?php if($ada>=1){
							$x 	= executeScalar("select sum(B003) from laborer_fee where weighing_id = '".$id."' ");
							if($x>0){echo 'checked';}} ?>><label class="light">M.Syaifudin (B003)</label><br>
						<input type="checkbox" id="mitra[]" name="mitra[]" value="B004" <?php if($ada>=1){
							$x 	= executeScalar("select sum(B004) from laborer_fee where weighing_id = '".$id."' ");
							if($x>0){echo 'checked';}} ?>><label class="light">Duwi Aditiya (B004)</label><br>
						<input type="checkbox" id="mitra[]" name="mitra[]" value="B005" <?php if($ada>=1){
							$x 	= executeScalar("select sum(B005) from laborer_fee where weighing_id = '".$id."' ");
							if($x>0){echo 'checked';}} ?>><label class="light">Kairul Min Sahri (B005)</label><br>
						<input type="checkbox" id="mitra[]" name="mitra[]" value="B006" <?php if($ada>=1){
							$x 	= executeScalar("select sum(B006) from laborer_fee where weighing_id = '".$id."' ");
							if($x>0){echo 'checked';}} ?>><label class="light">Nanang Budiono (B006)</label><br>
						<input type="checkbox" id="mitra[]" name="mitra[]" value="B007" <?php if($ada>=1){
							$x 	= executeScalar("select sum(B007) from laborer_fee where weighing_id = '".$id."' ");
							if($x>0){echo 'checked';}} ?>><label class="light">Putut Sugiyarto (B007)</label><br>
						<input type="checkbox" id="mitra[]" name="mitra[]" value="B008" <?php if($ada>=1){
							$x 	= executeScalar("select sum(B008) from laborer_fee where weighing_id = '".$id."' ");
							if($x>0){echo 'checked';}} ?>><label class="light">Abd. Mu'id (B008)</label><br>
						<input type="checkbox" id="mitra[]" name="mitra[]" value="B009" <?php if($ada>=1){
							$x 	= executeScalar("select sum(B009) from laborer_fee where weighing_id = '".$id."' ");
							if($x>0){echo 'checked';}} ?>><label class="light">Moh. Muid Faruq (B009)</label><br>
						<input type="checkbox" id="mitra[]" name="mitra[]" value="B010" <?php if($ada>=1){
							$x 	= executeScalar("select sum(B010) from laborer_fee where weighing_id = '".$id."' ");
							if($x>0){echo 'checked';}} ?>><label class="light">Didik Santoso (B010)</label><br>
						<input type="checkbox" id="mitra[]" name="mitra[]" value="B011"  <?php if($ada>=1){
							$x 	= executeScalar("select sum(B011) from laborer_fee where weighing_id = '".$id."' ");
							if($x>0){echo 'checked';}} ?>><label class="light">Ahmad Taufikul K. (B011)</label><br>
						<input type="checkbox" id="mitra[]" name="mitra[]" value="B012" <?php if($ada>=1){
							$x 	= executeScalar("select sum(B012) from laborer_fee where weighing_id = '".$id."' ");
							if($x>0){echo 'checked';}} ?>><label class="light">Fathur Rosi (B012)</label><br>
						<input type="checkbox" id="mitra[]" name="mitra[]" value="B013" <?php if($ada>=1){
							$x 	= executeScalar("select sum(B013) from laborer_fee where weighing_id = '".$id."' ");
							if($x>0){echo 'checked';}} ?>><label class="light">Mat Rizal (B013)</label><br>
						<input type="checkbox" id="mitra[]" name="mitra[]" value="B014" <?php if($ada>=1){
							$x 	= executeScalar("select sum(B014) from laborer_fee where weighing_id = '".$id."' ");
							if($x>0){echo 'checked';}} ?>><label class="light">Slamet Pujianto (B014)</label><br>
						<input type="checkbox" id="mitra[]" name="mitra[]" value="B015" <?php if($ada>=1){
							$x 	= executeScalar("select sum(B015) from laborer_fee where weighing_id = '".$id."' ");
							if($x>0){echo 'checked';}} ?>><label class="light">Muktarom (B015)</label>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group" style="padding:10px; margin-top:-10px;">
						<input type="checkbox" id="mitra[]" name="mitra[]" value="S001" <?php if($ada>=1){
							$x 	= executeScalar("select sum(S001) from laborer_fee where weighing_id = '".$id."' ");
							if($x>0){echo 'checked';}} ?>><label class="light">M. Ali Murtadlo (S001)</label><br>
						<input type="checkbox" id="mitra[]" name="mitra[]" value="S002" <?php if($ada>=1){
							$x 	= executeScalar("select sum(S002) from laborer_fee where weighing_id = '".$id."' ");
							if($x>0){echo 'checked';}} ?>><label class="light">Ahmad Ferry H. (S002)</label><br>
						<input type="checkbox" id="mitra[]" name="mitra[]" value="S003" <?php if($ada>=1){
							$x 	= executeScalar("select sum(S003) from laborer_fee where weighing_id = '".$id."' ");
							if($x>0){echo 'checked';}} ?>><label class="light">Amirul Mukminin (S003)</label><br>
						<input type="checkbox" id="mitra[]" name="mitra[]" value="S004" <?php if($ada>=1){
							$x 	= executeScalar("select sum(S004) from laborer_fee where weighing_id = '".$id."' ");
							if($x>0){echo 'checked';}} ?>><label class="light">Khoirul Anam (S004)</label><br>
						<input type="checkbox" id="mitra[]" name="mitra[]" value="S005" <?php if($ada>=1){
							$x 	= executeScalar("select sum(S005) from laborer_fee where weighing_id = '".$id."' ");
							if($x>0){echo 'checked';}} ?>><label class="light">Ragil Saputro (S005)</label><br>
						<input type="checkbox" id="mitra[]" name="mitra[]" value="S006" <?php if($ada>=1){
							$x 	= executeScalar("select sum(S006) from laborer_fee where weighing_id = '".$id."' ");
							if($x>0){echo 'checked';}} ?>><label class="light">Rolly Mulia (S006)</label><br>
						<input type="checkbox" id="mitra[]" name="mitra[]" value="S007" <?php if($ada>=1){
							$x 	= executeScalar("select sum(S007) from laborer_fee where weighing_id = '".$id."' ");
							if($x>0){echo 'checked';}} ?>><label class="light">Muis Hariyanto (S007)</label><br>
						<input type="checkbox" id="mitra[]" name="mitra[]" value="S008" <?php if($ada>=1){
							$x 	= executeScalar("select sum(S008) from laborer_fee where weighing_id = '".$id."' ");
							if($x>0){echo 'checked';}} ?>><label class="light">M. Hasin (S008)</label><br>
						<input type="checkbox" id="mitra[]" name="mitra[]" value="S009" <?php if($ada>=1){
							$x 	= executeScalar("select sum(S009) from laborer_fee where weighing_id = '".$id."' ");
							if($x>0){echo 'checked';}} ?>><label class="light">Marsono (S009)</label><br>
						<input type="checkbox" id="mitra[]" name="mitra[]" value="S010" <?php if($ada>=1){
							$x 	= executeScalar("select sum(S010) from laborer_fee where weighing_id = '".$id."' ");
							if($x>0){echo 'checked';}} ?>><label class="light">Seukron (S010)</label><br>
						<input type="checkbox" id="mitra[]" name="mitra[]" value="S011" <?php if($ada>=1){
							$x 	= executeScalar("select sum(S011) from laborer_fee where weighing_id = '".$id."' ");
							if($x>0){echo 'checked';}} ?>><label class="light">Rifai (S011)</label><br>
						<input type="checkbox" id="mitra[]" name="mitra[]" value="S012" <?php if($ada>=1){
							$x 	= executeScalar("select sum(S012) from laborer_fee where weighing_id = '".$id."' ");
							if($x>0){echo 'checked';}} ?>><label class="light">Rofik (S012)</label><br>
						<input type="checkbox" id="mitra[]" name="mitra[]" value="S013" <?php if($ada>=1){
							$x 	= executeScalar("select sum(S013) from laborer_fee where weighing_id = '".$id."' ");
							if($x>0){echo 'checked';}} ?>><label class="light">Durasid (S013)</label><br>
						<input type="checkbox" id="mitra[]" name="mitra[]" value="S014" <?php if($ada>=1){
							$x 	= executeScalar("select sum(S014) from laborer_fee where weighing_id = '".$id."' ");
							if($x>0){echo 'checked';}} ?>><label class="light">Deni (S014)</label><br>
						<input type="checkbox" id="mitra[]" name="mitra[]" value="S015" <?php if($ada>=1){
							$x 	= executeScalar("select sum(S015) from laborer_fee where weighing_id = '".$id."' ");
							if($x>0){echo 'checked';}} ?>><label class="light">Mahmud (S015)</label>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group" style="padding:10px; margin-top:-10px;">
						<input type="checkbox" id="mandor[]" name="mandor[]" value="M01"  <?php if($ada>=1){
							$x 	= executeScalar("select sum(M01) from laborer_fee where weighing_id = '".$id."' ");
							if($x>0){echo 'checked';}} ?>><label class="light">Darwanto (M01)</label><br>
						<input type="checkbox" id="mandor[]" name="mandor[]" value="M02"  <?php if($ada>=1){
							$x 	= executeScalar("select sum(M02) from laborer_fee where weighing_id = '".$id."' ");
							if($x>0){echo 'checked';}} ?>><label class="light">Tri Wibowo (M02)</label><br>
						<input type="checkbox" id="mandor[]" name="mandor[]" value="M03"  <?php if($ada>=1){
							$x 	= executeScalar("select sum(M03) from laborer_fee where weighing_id = '".$id."' ");
							if($x>0){echo 'checked';}} ?>><label class="light">Abdul Roud (M03)</label><br>
						<input type="checkbox" id="mandor[]" name="mandor[]" value="M04"  <?php if($ada>=1){
							$x 	= executeScalar("select sum(M04) from laborer_fee where weighing_id = '".$id."' ");
							if($x>0){echo 'checked';}} ?>><label class="light">Mohammad Rois (M04)</label><br>
					</div>
				</div>
				<div class="form-group" style="padding:10px; margin-top:30px; margin-bottom:-10px; margin-left:0px; margin-right:0px;">
					<?php
						$c 	= executeScalar("select date_check from weighing where weighing_id = '".$id."'");
						$p2 = executeScalar("select p2 from weighing where weighing_id = '".$id."'");
						if($c!=''||$c!=null||$p2!=null){
							echo '';
						}else{
							echo '<button type="submit" class="btn btn-primary btn-block">Simpan <i class="fa fa-angle-double-right fa-lg"></i></button>';
						}
					?>
				</div>
				<!-- Fitur Check Box All--> 
				<!--<div>
				<input type="checkbox" id="checkAll"> Check All
				</div>-->
			</fieldset>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	/*$('#checkAll').click(function ()
	{    
    	$('input:checkbox').prop('checked', this.checked);*/
 	}); // UPDATE DISINI
</script>