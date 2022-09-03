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
	$bm = executeScalar("select weight_in from weighing where weighing_id = '".$id."'");
?>
<div class="row" style="margin-top:20px;margin-bottom:10px;">
	<div class="col-md-8 col-md-offset-2">
		<form action="weighing_action.php?task=Batal1&id=<?php echo $id; ?>"  id="form_edit1" name="form_edit1" method="POST" class="form-horizontal">
			<div class="form-group" style="padding:10px; margin-top:10px; margin-right:0px;">
				<label>Alasan Pembatalan</label>
				<input id="reason" name="reason" placeholder="Alasan Mengapa Diedit" type="text" class="form-control" required>                  
			</div>
			<div class="form-group" style="padding:10px; margin-top:-10px; margin-right:0px;">
				<button type="submit" class="btn btn-outline btn-primary btn-block btn-sm">Batal</button>               
			</div>
		</form>
	</div>
</div>