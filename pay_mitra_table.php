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
			<th style="width:5%;">ID NOTA</th>
			<th style="width:10%;">TGL TAGIHAN</th>
			<th style="width:8%;">KODE</th>
			<th style="width:20%;">PEDAGANG</th>
			<th style="width:10%;">NETTO</th>
			<th style="width:10%;">BAGI MITRA</th>
			<!-- <th style="width:10%;">SIMPAN MITRA</th>
			<th style="width:10%;">BAGI MANDOR</th>
			<th style="width:10%;">SIMPAN MANDOR</th> -->
			<th style="width:10%;">TOTAL BAYAR</th>
			<!-- <th style="width:10%;">TOTAL</th> -->
			<th style="width:7%;">STATUS</th>
			<th style="width:7%;">AKSI</th>
		</tr>
	</thead>
	<tbody>
		<?php
			//$date_plus 	= strtotime('-8 day', strtotime($date_now));
			//$onemonth	= date('Y-m-j' , $date_plus); date_check != null
			$query2 		= mysql_query("	select 	w.weighing_id, 
													w.merchant_id, 
													w.netto, 
													w.cost_bagi_mitra,
													w.cost_simpan_mitra,
													w.cost_bagi_mandor,
													w.cost_simpan_mandor,
													w.cost_bayar,
													w.cost, 
													w.weighing_sts, 
													w.weighing_sts3, 
													w.date_out,
													(w.cost_bagi_mitra + w.cost_simpan_mitra) AS pendapatan_mitra,
													w.date_check 
										from weighing_mitra w, merchant m	
										where 	w.merchant_id = m.merchant_id and 
												m.merchant_status = 'Aktif' and
												w.weighing_sts = 'Keluar' and 
												w.weighing_sts3 is null and
												(w.date_in  between '2016-09-01' and '".$date_now."')  and 
												w.date_check is not null
										order by weighing_id desc");
			while($data2 = mysql_fetch_array($query2)) { 
				$merchant = executeScalar("select merchant_name from merchant where merchant_id = '".$data2['merchant_id']."'");
		?>
		<tr>
			<td style="text-align:left;"><?php echo $data2['weighing_id']; ?></td>
			<td style="text-align:right;"><?php echo date("d-m-Y", strtotime($data2['date_check'])); ?></td>
			<td style="text-align:left;"><?php echo $data2['merchant_id']; ?></td>
			<td><?php echo $merchant; ?></td>
			<td style="text-align:right;"><?php echo $data2['netto']; ?> Kg</td>
			<td style="text-align:right;"><?php echo format_rupiah($data2['pendapatan_mitra']); ?></td>
			<!-- <td style="text-align:right;"><?php echo format_rupiah($data2['cost_simpan_mitra']); ?></td>
			<td style="text-align:right;"><?php echo format_rupiah($data2['cost_bagi_mandor']); ?></td>
			<td style="text-align:right;"><?php echo format_rupiah($data2['cost_simpan_mandor']); ?></td> -->
			<td style="text-align:right;"><?php echo format_rupiah($data2['cost_bayar']); ?></td>
			<!-- <td style="text-align:right;"><?php echo format_rupiah($data2['cost']); ?></td> -->
			<td style="text-align:center;"><?php echo $data2['weighing_sts']; ?></td>
			<td>
				<?php 
					if($data2['weighing_sts']!='Lunas'||$data2['weighing_sts3']!='Pending'){
						echo '<a href="pay_action.php?task=pay_mitra&type=ko&id='.$data2['weighing_id'].'">
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