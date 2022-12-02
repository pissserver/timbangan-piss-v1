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
	$('#payView').dataTable({"aLengthMenu": [[5, 10, 50, 100, -1], [5, 10, 50, 100, "All"]]});
	});
</script>
<!--<div class="table-responsive">-->
<table id="payView" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th style="width:5%;">No</th>
			<th style="width:10%;">ID KM</th>
			<th style="width:10%;">Nama Kasir</th>
			<th style="width:10%;">Total Setoran</th>
			<th style="width:10%;">Tanggal</th>
			<th style="width:10%;">Status</th>
			<th style="width:10%;">Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$no			= 0;
			$query 		= mysql_query("select * from km where km_status = 'Diajukan' order by km_id");
			while($data	= mysql_fetch_array($query)) { 
				$cashier_id	= executeScalar("select cashier_id from ko where km_id = '".$data['km_id']."'");
				$cashier	= executeScalar("select checker_name from checker where checker_id = '".$cashier_id."'");
				$no++;
		?>
		<tr>
			<td style="text-align:center;"><?php echo $no; ?></td>
			<td style="text-align:center;"><?php echo $data['km_id']; ?></td>
			<td style="text-align:left;"><?php echo $cashier; ?></td>
			<td style="text-align:right;"><?php echo format_rupiah($data['km_total']); ?></td>
			<td style="text-align:center;"><?php echo date("d-m-Y", strtotime($data['km_date'])); ?></td>
			<td style="text-align:center;"><?php echo $data['km_status']; ?></td>
			<td><a href="pay_action.php?task=acc&id=<?php echo $data['km_id']; ?>">
					<button class="btn btn-outline btn-block btn-primary btn-xs">Acc</button>
				</a>
			</td>
		</tr>
		<?php } ?>
	</tbody>
</table>
<!--</div>-->