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
	$('#payView').dataTable({"aLengthMenu": [[5, 10, 50, 100, -1], [5, 10, 50, 100, "All"]]});
	});
</script>
<!--<div class="table-responsive">-->
<table id="payView" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th style="width:5%;">Id Nota</th>
			<th style="width:7%;">Nopol</th>
			<th style="width:20%;">Pedagang</th>
			<th style="width:8%;">Netto</th>
			<th style="width:10%;">Total Bayar</th>
			<th style="width:7%;">Status</th>
			<th style="width:10%;">Tgl Tagihan</th>
			<th style="width:7%;">Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php
			//$date_plus 	= strtotime('-8 day', strtotime($date_now));
			//$onemonth	= date('Y-m-j' , $date_plus); date_check != null
			$query 		= mysql_query("select w.weighing_id, w.merchant_id, w.nopol, 
			w.netto, w.cost, w.weighing_sts, w.weighing_sts3, w.date_out, w.date_check 
			from weighing w, merchant m	
			where w.merchant_id = m.merchant_id and 
			m.merchant_status = 'Aktif' and
			w.weighing_sts = 'Keluar' and 
			w.weighing_sts3 is null and
			(w.date_in  between '2016-09-01' and '".$date_now."')  and 
			w.date_check is not null
			order by weighing_id desc");
			while($data	= mysql_fetch_array($query)) { 
				$merchant = executeScalar("select merchant_name from merchant where merchant_id = '".$data['merchant_id']."'");
		?>
		<tr>
			<td style="text-align:left;"><?php echo $data['weighing_id']; ?></td>
			<td><?php echo $data['nopol']; ?></td>
			<td><?php echo $merchant; ?></td>
			<td style="text-align:right;"><?php echo $data['netto']; ?> Kg</td>
			<td style="text-align:right;"><?php echo format_rupiah($data['cost']); ?></td>
			<td style="text-align:center;"><?php echo $data['weighing_sts']; ?></td>
			<td style="text-align:right;"><?php echo date("d-m-Y", strtotime($data['date_check'])); ?></td>
			<td>
				<?php 
					if($data['weighing_sts']!='Lunas'||$data['weighing_sts3']!='Pending'){
						echo '<a href="pay_action.php?task=pay&type=ko&id='.$data['weighing_id'].'">
							<button class="btn btn-outline btn-block btn-primary btn-xs">Bayar</button>
						</a>';
					}
				?>
			</td>
		</tr>
		<?php } ?>
	</tbody>
</table>
<!--</div>-->