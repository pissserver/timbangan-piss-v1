<?php
	include "connection.php";
?>
<!-- jquery -->
<script src="dataTables/jquery.dataTables.js"></script>
<script src="dataTables/dataTables.tableTools.js"></script>
<script src="dataTables/dataTables.bootstrap.js"></script>
<script>
	$(document).ready(function() {
	//data table
	$('#pay_accView').dataTable({"aLengthMenu": [[5, 10, 50, 100, -1], [5, 10, 50, 100, "All"]]});
	});
</script>
<!--<div class="table-responsive">-->
<table id="pay_accView" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th style="width:5%;">ID</th>
			<th style="width:8%;">NOPOL</th>
			<th style="width:8%;">KODE</th>
			<th style="width:25%;">PEDAGANG</th>
			<th style="width:8%;">NETTO</th>
			<th style="width:10%;">TOTAL BAYAR</th>
			<th style="width:10%;">TGL TAGIHAN</th>
			<th style="width:8%;">AKSI</th>
		</tr>
	</thead>
	<tbody>
		<?php
			//$date_plus 	= strtotime('-8 day', strtotime($date_now));
			//$onemonth	= date('Y-m-j' , $date_plus);
			$query 		= mysql_query("	select 	weighing_id, 
												merchant_id, 
												nopol, 
												netto, 
												cost_tonase	,
												cost, 
												weighing_sts, 
												date_out
										from 	weighing 
										where 	weighing_sts = 'Keluar' and 
												weighing_sts3 = 'Pending' and 
												(date_in  between '2016-09-01' and '".$date_now."') 
										order by weighing_id desc");
			while($data	= mysql_fetch_array($query)) { 
			$merchant 	= executeScalar("select merchant_name from merchant where merchant_id = '".$data['merchant_id']."'");
		?>
		<tr>
			<td style="text-align:left;"><?php echo $data['weighing_id']; ?></td>
			<td><?php echo $data['nopol']; ?></td>
			<td><?php echo $data['merchant_id']; ?></td>
			<td><?php echo $merchant; ?></td>
			<td style="text-align:right;"><?php echo $data['netto']; ?> Kg</td>
			<td style="text-align:right;"><?php echo format_rupiah($data['cost_tonase']); ?></td>
			<td style="text-align:right;"><?php echo date("d-m-y", strtotime($data['date_out'])); ?></td>
			<td>
				<a href="pay_action.php?task=cancel&type=ko&id=<?php echo $data['weighing_id']; ?>">
					<button class="btn btn-outline btn-block btn-primary btn-xs">Batal</button>
				</a>
			</td>
		</tr>
		<?php } ?>
	</tbody>
</table>
<!--</div>-->