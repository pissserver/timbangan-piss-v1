<?php
	session_start();
	include "connection.php";
?>
<!-- jquery -->
<script src="dataTables/jquery.dataTables.js"></script>
<script src="dataTables/dataTables.tableTools.js"></script>
<script src="dataTables/dataTables.bootstrap.js"></script>
<script>
	$(document).ready(function() {
	//data table
	$('#kmAccView').dataTable({"aLengthMenu": [[5, 10, 50, 100, -1], [5, 10, 50, 100, "All"]]});
	});
</script>
<!--<div class="table-responsive">-->
<table id="kmAccView" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th style="text-align:center; width:3%;">ID KO</th>
			<th style="text-align:center; width:3%;">TANGGAL</th>
			<th style="text-align:center; width:10%;">KASIR</th>
			<th style="text-align:center; width:10%;">TOTAL SETOR</th>
			<th style="text-align:center; width:3%;">STATUS</th>
			<th style="text-align:center; width:3%;">AKSI</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$cashier 	= executeScalar("select checker_id from checker where checker_code = '".$_SESSION['checker']."'");
			$query 		= mysql_query("select * from ko where cashier_id = '".$cashier."' and ko_status = 'Diterima' order by ko_id desc");
			while($data	= mysql_fetch_array($query)) { 
				$cashier 	= executeScalar("select checker_name from checker where checker_id = '".$data['cashier_id']."'");
		?>
		<tr>
			<td style="text-align:center;"><?php echo $data['ko_id']; ?></td>
			<td style="text-align:center;"><?php echo date("d-m-Y", strtotime($data['ko_date'])); ?></td>
			<td style="text-align:left;"><?php echo $cashier; ?></td>
			<td style="text-align:right;"><?php echo format_rupiah($data['ko_total']); ?></td>
			<td style="text-align:center;"><?php echo $data['ko_status']; ?></td>
			<td><a href="pay_action2.php?task=cancel&type=km&id=<?php echo $data['ko_id']; ?>">
					<button class="btn btn-outline btn-block btn-primary btn-xs">Batal</button>
				</a>
			</td>
		</tr>
		<?php } ?>
	</tbody>
</table>
<!--</div>-->