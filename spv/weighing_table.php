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
			<th style="width:5%;">ID</th>
			<th style="width:6%;">Nopol</th>
			<th style="width:16%;">Pedagang</th>
			<th style="width:10%;">Barang</th>
			<th style="width:8%;">Masuk</th>
			<th style="width:8%;">Status</th>
			<th style="width:6%;">Jam</th>
			<th style="width:8%;">Tanggal</th>
			<th style="width:6%;">Print</th>
			<th style="width:5%;">Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$no		= 1;
			$date_plus 	= strtotime('-1 day', strtotime($date_now));
			$yesterday	= date('Y-m-j' , $date_plus);
			$query 	= mysql_query("select * from weighing where (date_in  between '2016-03-15' and '$date_now') and weighing_sts = 'Masuk' order by weighing_id desc");
			while($data=mysql_fetch_array($query)){
			$merchant = executeScalar("select merchant_name from merchant where merchant_id = '".$data['merchant_id']."'");
			$goods 	= executeScalar("select goods_name from goods where goods_id = '".$data['goods_id']."'");
			$sama 	= executeScalar("select count(transportation_id) from transportation where transportation_nopol = '".$data['nopol']."'");
		?>
		<tr>
			<td style="text-align:right;"><?php echo $no; ?></td>
			<td><?php echo $data['nopol']; ?></td>
			<td><?php echo $merchant; ?></td>
			<td><?php echo $goods; ?></td>
			<td style="text-align:right;"><?php echo $data['weight_in']; ?> Kg</td>
			<td style="text-align:center;"><?php echo $data['weighing_sts']; ?></td>
			<td style="text-align:center;"><?php echo date("H:i", strtotime($data['time_in'])); ?></td>
			<td style="text-align:right;"><?php echo date("d-m-Y", strtotime($data['date_in'])); ?></td>
			<td style="text-align:center;"><?php echo $data['p1']; ?></td>
			<td>
				<?php 
					if($data['weighing_sts']=='Masuk'){
						echo '<a href="index2.php?id='.$data['weighing_id'].'">
							<button class="btn btn-outline btn-block btn-primary btn-xs">Keluar</button>
						</a>';
					}
					if($sama==1&&$data['weighing_sts']=='Masuk'){
						echo '
						<a href="index3.php?id='.$data['weighing_id'].'">
							<button class="btn btn-outline btn-block btn-primary btn-xs">Kurangi Kir</button>
						</a>';
					}
				?>
			</td>
		</tr>
		<?php 
			$no++;
			} ?>
	</tbody>
</table>
<!--</div>-->