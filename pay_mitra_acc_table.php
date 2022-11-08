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
			<th style="width:5%;">ID NOTA</th>
			<th style="width:8%;">TGL TAGIHAN</th>
			<th style="width:8%;">KODE</th>
			<th style="width:20%;">PEDAGANG</th>
			<th style="width:10%;">NETTO</th>
			<th style="width:10%;">BAGI MITRA</th>
			<!-- <th style="width:10%;">SIMPAN MITRA</th>
			<th style="width:10%;">BAGI MANDOR</th>
			<th style="width:10%;">SIMPAN MANDOR</th> -->
			<th style="width:10%;">TOTAL BAYAR</th>
			<!-- <th style="width:10%;">TOTAL</th> -->
			<th style="width:7%;">AKSI</th>
		</tr>
	</thead>
	<tbody>
		<?php
			//$date_plus 	= strtotime('-8 day', strtotime($date_now));
			//$onemonth	= date('Y-m-j' , $date_plus);
			$query 		= mysql_query("select 	weighing_id, 
												merchant_id,
												netto, 
												cost_bagi_mitra,
												cost_simpan_mitra,
												cost_bagi_mandor,
												cost_simpan_mandor,
												cost_bayar,
												cost, 
												weighing_sts, 
												date_out
										from weighing_mitra
										where 	weighing_sts = 'Keluar' and 
												weighing_sts3 = 'Pending' and 
												(date_in  between '2016-09-01' and '".$date_now."') 
										order by weighing_id desc");
			while($data	= mysql_fetch_array($query)) { 
				$merchant 	= executeScalar("select merchant_name from merchant where merchant_id = '".$data['merchant_id']."'");
		?>
		<tr>
			<td style="text-align:center;"><?php echo $data['weighing_id']; ?></td>
			<td style="text-align:center;"><?php echo date("d-m-y", strtotime($data['date_out'])); ?></td>
			<td style="text-align:left;"><?php echo $data['merchant_id']; ?></td>
			<td><?php echo $merchant; ?></td>
			<td style="text-align:right;"><?php echo $data['netto']; ?> Kg</td>
			<td style="text-align:right;"><?php echo format_rupiah($data['cost_bagi_mitra']); ?></td>
			<!-- <td style="text-align:right;"><?php echo format_rupiah($data['cost_simpan_mitra']); ?></td>
			<td style="text-align:right;"><?php echo format_rupiah($data['cost_bagi_mandor']); ?></td>
			<td style="text-align:right;"><?php echo format_rupiah($data['cost_simpan_mandor']); ?></td> -->
			<td style="text-align:right;"><?php echo format_rupiah($data['cost_bayar']); ?></td>
			<!-- <td style="text-align:right;"><?php echo format_rupiah($data['cost']); ?></td> -->
			<td>
				<a href="pay_action.php?task=cancel_mitra&type=ko&id=<?php echo $data['weighing_id']; ?>">
					<button class="btn btn-outline btn-block btn-primary btn-xs">Batal</button>
				</a>
			</td>
		</tr>
		<?php } ?>
	</tbody>
</table>
<!--</div>-->