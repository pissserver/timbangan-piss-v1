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
	$('#payAccView').dataTable({"aLengthMenu": [[5, 10, 50, 100, -1], [5, 10, 50, 100, "All"]]});
	});
</script>
<!--<div class="table-responsive">-->
<table id="payAccView" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th style="width:5%;">ID KO</th>
			<th style="width:10%;">Nama Kasir</th>
			<th style="width:10%;">Total Setoran</th>
			<th style="width:10%;">Tanggal</th>
			<th style="width:10%;">Status</th>
			<th style="width:10%;">Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$query 		= mysql_query("select * from ko where ko_status = 'Diterima' order by ko_id desc");
			while($data	= mysql_fetch_array($query)) { 
				$cashier 	= executeScalar("select checker_name from checker where checker_id = '".$data['cashier_id']."'");
		?>
		<tr>
			<td style="text-align:left;"><?php echo $data['ko_id']; ?></td>
			<td style="text-align:left;"><?php echo $cashier; ?></td>
			<td style="text-align:right;"><?php echo format_rupiah($data['ko_total']); ?></td>
			<td style="text-align:right;"><?php echo date("d-m-Y", strtotime($data['ko_date'])); ?></td>
			<td style="text-align:center;"><?php echo $data['ko_status']; ?></td>
			<td><a href="pay_action.php?task=cancel&id=<?php echo $data['ko_id']; ?>">
					<button class="btn btn-outline btn-block btn-primary btn-xs">Batal</button>
				</a>
			</td>
		</tr>
		<?php } ?>
	</tbody>
</table>
<!--</div>-->