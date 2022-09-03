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
			<th style="width:4%;">No</th>
			<th style="width:5%;">ID Timbang</th>
			<th style="width:5%;">Nopol</th>
			<th style="width:15%;">Pedagang</th>
			<th style="width:8%;">Barang</th>
			<th style="width:7%;">Masuk</th>
			<th style="width:7%;">Keluar</th>
			<th style="width:7%;">Netto</th>
			<th style="width:6%;">Status</th>
			<th style="width:6%;">Jam</th>
			<th style="width:7%;">Tanggal</th>
			<th style="width:5%;">Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$no			= 1;
			$date_plus 	= strtotime('-30 day', strtotime($date_now));
			$yesterday	= date('Y-m-j', $date_plus);
			$query 		= mysql_query("select * from weighing where (date_in  between '$yesterday' and '$date_now') and 
						weighing_sts = 'Keluar' order by weighing_id desc");
			while($data = mysql_fetch_array($query)){
				$merchant 	= executeScalar("select merchant_name from merchant where merchant_id = '".$data['merchant_id']."'");
				$goods 		= executeScalar("select goods_name from goods where goods_id = '".$data['goods_id']."'");
				$sama 		= executeScalar("select count(transportation_id) from transportation where transportation_nopol = '".$data['nopol']."'");
		?>
		<tr>
			<td style="text-align:right;"><?php echo $no; ?></td>
			<td style="text-align:center;"><?php echo $data['weighing_id']; ?></td>
			<td><?php echo $data['nopol']; ?></td>
			<td><?php echo $merchant; ?></td>
			<td><?php echo $goods; ?></td>
			<td style="text-align:right;"><?php echo $data['weight_in']; ?> Kg</td>
			<td style="text-align:right;"><?php echo $data['weight_out']; ?> Kg</td>
			<td style="text-align:right;"><?php echo $data['netto']; ?> Kg</td>
			<td style="text-align:center;"><?php echo $data['weighing_sts']; ?></td>
			<td style="text-align:center;"><?php echo date("H:i", strtotime($data['time_in'])); ?></td>
			<td style="text-align:right;"><?php echo date("d-m-Y", strtotime($data['date_in'])); ?></td>
			<td>
				<!-- Button HTML (to Trigger Modal) -->
				<a href="edit_modal2.php?id=<?php echo $data['weighing_id']; ?>" class="btn btn-xs btn-outline btn-primary btn-block" data-toggle="modal" data-target="#modalEdit">Edit</a>
			</td>
		</tr>
		<?php 
			$no++;
		} ?>
	</tbody>
</table>
<!--</div>-->