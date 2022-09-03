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
<h3 style="margin-top:-20px; text-align:center;" >Log Historis Print Nota Tagihan Tonase PIOS</h3>
<table id="transactionView" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th style="width:5%;">No</th>
			<th style="width:10%;">No Nota</th>
			<th style="width:30%;">Nama</th>
			<th style="width:15%;">Jam & Tanggal</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$no		= 1;
			$date_plus 	= strtotime('-15 day', strtotime($date_now));
			$yesterday	= date('Y-m-j' , $date_plus);
			$query 	= mysql_query("select * from weighing_print where print_date between '".$yesterday."' and '".$date_now."' order by print_date desc");
			while($data=mysql_fetch_array($query)){
		?>
		<tr>
			<td style="text-align:right;"><?php echo $no; ?></td>
			<td style="text-align:right;"><?php echo $data['weighing_id']; ?></td>
			<td><?php echo $data['print_user']; ?></td>
			<td style="text-align:right;"><?php echo date("H:i | d M Y", strtotime($data['print_date'])); ?></td>
		</tr>
		<?php 
			$no++;
			} ?>
	</tbody>
</table>
<!--</div>-->