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
	
	$date 		= $_GET['date'];
	/*$db_shared 	= executeScalar("SELECT (sum(t06)+sum(t14)+sum(t17)+sum(t24)+sum(t26)+sum(t29)+sum(t36)+sum(t40)+sum(foreman)) as total_bagi
				FROM `laborer_fee` where date(laborer_fee_date) = '".$date."'");
	$db_save 	= executeScalar("SELECT (sum(t06_save)+sum(t14_save)+sum(t17_save)+sum(t24_save)+sum(t26_save)+sum(t29_save)+sum(t36_save)+sum(t40_save)+sum(foreman_save)) as total_simpan
				FROM `laborer_fee` where date(laborer_fee_date) = '".$date."'");*/
?>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><img src='../img/Delete.png' width='25' height='25'/></button>
	<h4 id="header_password">Upah Mitra <?php echo $date; ?></h4>
</div>
<div class="row" style="margin-top:0px;margin-bottom:10px;">
	<div class="col-md-8 col-md-offset-2">
		<form action="pay_mitra_action.php?task=pay&date=<?php echo $date; ?>"  id="form_edit1" name="form_edit1" method="POST" class="form-horizontal">
			<div class="form-group" style="padding:10px; margin-top:10px; margin-right:0px;">
				<label>Uang Dibagi</label>
				<input id="dibagi" name="dibagi" type="number" class="form-control" required>  
			</div>
			<div class="form-group" style="padding:10px; margin-top:10px; margin-right:0px;">
				<label>Uang Disimpan</label>
				<input id="dibagi" name="dibagi" type="number" class="form-control" required>                   
			</div>
			<div class="form-group" style="padding:10px; margin-top:-10px; margin-right:0px;">
				<button type="submit" class="btn btn-outline btn-primary btn-block btn-sm">Edit</button>               
			</div>
		</form>
	</div>
</div>