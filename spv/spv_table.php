<?php
	include "../connection.php";
?>
<!-- jquery -->
<script src="../dataTables/jquery.dataTables.js"></script>
<script src="../dataTables/dataTables.tableTools.js"></script>
<script src="../dataTables/dataTables.bootstrap.js"></script>
<script>
	$(document).ready(function() {
	//data table
	$('#transactionView').dataTable({"aLengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]]});
	});
</script>
<!--<div class="table-responsive">-->
<table id="transactionView" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th style="width:3%;">ID</th>
			<th style="width:10%;">Nama SPV</th>
			<th style="width:20%;">Aksi</th>
			<th style="width:10%;">Nota Target</th>
			<th style="width:15%;">Keterangan</th>
			<th style="width:10%;">Jam & Tanggal</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$no		= 1;
			$date_plus 	= strtotime('-15 day', strtotime($date_now));
			$yesterday	= date('Y-m-j' , $date_plus);
			$query 	= mysql_query("select * from spv_log where date(action_time) >= '".$yesterday."' order by action_time desc");
			while($data=mysql_fetch_array($query)){
		?>
		<tr>
			<td style="text-align:right;"><?php echo $no; ?></td>
			<td><?php echo $data['spv_user']; ?></td>
			<td><?php echo $data['spv_action']; ?></td>
			<td style="text-align:right;"><?php 
				$wid 	= sprintf("%07d", $data['spv_target']);
				$status = executeScalar("select weighing_sts from weighing where weighing_id = '".$data['spv_target']."'");
				if($status=='Masuk'||$status=='Batal'){
					//$year = executeScalar("select date_format(date_in, '%y') from weighing where weighing_id = '".$data['spv_target']."'");
					echo 'TB'.$wid;
				}
				elseif($status=='Keluar'||$status=='Lunas'){
					//$year = executeScalar("select date_format(date_in, '%y') from weighing where weighing_id = '".$data['spv_target']."'");
					echo 'TG'.$wid;
				} ?></td>
			<td><?php echo $data['spv_reason']; ?></td>
			<td style="text-align:right;"><?php echo date("H:i d M Y", strtotime($data['action_time'])); ?></td>
		</tr>
		<?php 
			$no++;
			} ?>
	</tbody>
</table>
<!--</div>-->