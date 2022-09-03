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
						<input type="checkbox" id="mitra[]" name="mitra[]" value="t06"  <?php if($ada>=1){
							$x 	= executeScalar("select sum(t06) from laborer_fee where weighing_id = '".$id."' ");
							if($x>0){echo 'checked';}} ?>><label class="light">Soari (T06)</label><br>
						<input type="checkbox" id="mitra[]" name="mitra[]" value="t14" <?php if($ada>=1){
							$x 	= executeScalar("select sum(t14) from laborer_fee where weighing_id = '".$id."' ");
							if($x>0){echo 'checked';}} ?>><label class="light">Musodik (T14)</label><br>
						<input <?php if($ada>=1){
							$x 	= executeScalar("select sum(t17) from laborer_fee where weighing_id = '".$id."' ");
							if($x>0){echo 'checked';}} ?> type="checkbox" id="mitra[]" name="mitra[]" value="t17"><label class="light">Hafid (T17)</label>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group" style="padding:10px; margin-top:-10px;">
						<input type="checkbox" id="mitra[]" name="mitra[]" value="t24" <?php if($ada>=1){
							$x 	= executeScalar("select sum(t24) from laborer_fee where weighing_id = '".$id."' ");
							if($x>0){echo 'checked';}} ?>><label class="light">Adenan (T24)</label><br>
						<input type="checkbox" id="mitra[]" name="mitra[]" value="t26" <?php if($ada>=1){
							$x 	= executeScalar("select sum(t26) from laborer_fee where weighing_id = '".$id."' ");
							if($x>0){echo 'checked';}} ?>><label class="light">Zaenal (T26)</label><br>
						<input type="checkbox" id="mitra[]" name="mitra[]" value="t29" <?php if($ada>=1){
							$x 	= executeScalar("select sum(t29) from laborer_fee where weighing_id = '".$id."' ");
							if($x>0){echo 'checked';}} ?>><label class="light">Mustofa (T29)</label>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group" style="padding:10px; margin-top:-10px;">
						<input type="checkbox" id="mitra[]" name="mitra[]" value="t36" <?php if($ada>=1){
							$x 	= executeScalar("select sum(t36) from laborer_fee where weighing_id = '".$id."' ");
							if($x>0){echo 'checked';}} ?>><label class="light">Rochman (T36)</label><br>
						<input type="checkbox" id="mitra[]" name="mitra[]" value="t40"  <?php if($ada>=1){
							$x 	= executeScalar("select sum(t40) from laborer_fee where weighing_id = '".$id."' ");
							if($x>0){echo 'checked';}} ?>><label class="light">Maksum (T40)</label><br>
						<input type="checkbox" id="mandor[]" name="mandor[]" value="m03"  <?php if($ada>=1){
							$x 	= executeScalar("select sum(foreman) from laborer_fee where weighing_id = '".$id."' ");
							if($x>0){echo 'checked';}} ?>><label class="light">Zaini (M03)</label>
					</div>
				</div>
				<div class="form-group" style="padding:10px; margin-top:30px; margin-bottom:-10px; margin-left:0px; margin-right:0px;">
					<button type="submit" class="btn btn-primary btn-block">Simpan <i class="fa fa-angle-double-right fa-lg"></i></button>
				</div>
			</fieldset>
			</form>
		</div>
	</div>
</div>