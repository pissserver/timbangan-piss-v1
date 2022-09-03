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
	$('#transactionView').dataTable({"aLengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]]});
	});
</script>
<!--<div class="table-responsive">-->
<table id="transactionView" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th style="width:5%;">ID</th>
			<th style="width:7%;">Nopol</th>
			<th style="width:13%;">Pedagang</th>
			<th style="width:10%;">Masuk</th>
			<th style="width:10%;">Keluar</th>
			<th style="width:10%;">Netto</th>
			<th style="width:10%;">Total Bayar</th>
			<th style="width:10%;">Penerima</th>
			<th style="width:10%;">Status</th>
			<th style="width:7%;">Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$date_plus 	= strtotime('-30 day', strtotime($date_now));
			$onemonth	= date('Y-m-j' , $date_plus);
			$date_plus2	= strtotime('-60 day', strtotime($date_now));
			$twomonth	= date('Y-m-j' , $date_plus2);
			$query 		= mysql_query("select * from weighing where (weighing_sts = 'Keluar' || weighing_sts = 'Lunas') and
						(date_in  between '".$twomonth."' and '".$onemonth."') order by weighing_id desc");
			while($data = mysql_fetch_array($query)) { 
			$merchant 	= executeScalar("select merchant_name from merchant where merchant_id = '".$data['merchant_id']."'");
			$receiver 	= executeScalar("select checker_name from checker where checker_id = '".$data['receiver_id']."'");
		?>
		<tr>
			<td style="text-align:right;"><?php echo $data[0]; ?></td>
			<td><?php echo $data['nopol']; ?></td>
			<td><?php echo $merchant; ?></td>
			<td style="text-align:right;"><?php echo $data['weight_in']; ?> Kg</td>
			<td style="text-align:right;"><?php echo $data['weight_out']; ?> Kg</td>
			<td style="text-align:right;"><?php echo $data['netto']; ?> Kg</td>
			<td style="text-align:right;"><?php echo format_rupiah($data['cost']); ?></td>
			<td style="text-align:center;"><?php if($receiver!=0||$receiver!=''){ echo $receiver;}else{ echo '';} ?></td>
			<td style="text-align:center;"><?php echo $data['weighing_sts']; ?></td>
			<td>
				<?php 
					if($data['weighing_sts']!='Lunas'){
						echo '<a href="pay_edit.php?id='.$data['weighing_id'].'">
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