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
	$('#weighingView').dataTable({
		dom: "<'row'<'col-sm-8'l><'col-sm-4'f>>" +  
			"<'row'<'col-sm-12'tr>>" +
			"<'row'<'col-sm-7'i><'col-sm-5'p>>",
		"aLengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]]});
	});
</script>
<!--<div class="table-responsive">-->
<table id="weighingView" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th style="width:5%;">ID</th>
			<th style="width:7%;">Nopol</th>
			<th style="width:15%;">Pedagang</th>
			<th style="width:9%;">Masuk</th>
			<th style="width:8%;">Keluar</th>
			<th style="width:7%;">Non Komoditi</th>
			<th style="width:7%;">Rafaksi</th>
			<th style="width:8%;">Netto</th>
			<th style="width:8%;">Status</th>
			<th style="width:10%;">Jam & Tgl Masuk</th>
			<th style="width:6%;">Print</th>
			<th style="width:5%;">Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$date_plus 	= strtotime('-10 day', strtotime($date_now));
			$week		= date('Y-m-j' , $date_plus);
			$query 		= mysql_query("select weighing_id, nopol, merchant_id, weight_in, weight_out, 
			noncommodity, rafaksi, netto, cost, weighing_sts, time_in, date_in, p1, p2 from weighing  
			where (date_in  between '".$week."' and '".$date_now."') and 
			(weighing_sts = 'Keluar' || weighing_sts = 'Batal' || weighing_sts = 'Lunas') 
			order by weighing_id desc");
			$no			= 0;
			while($data=mysql_fetch_array($query)) { 
				$merchant 	= executeScalar("select merchant_name from merchant where merchant_id = '".$data['merchant_id']."'");
				$c 	= executeScalar("select date_check from weighing where weighing_id = '".$data['weighing_id']."'");
				if($c!=''||$c!=null){ //Jika tgl check Tidak Kosong / Ada
					$c = 'C';
				}else{
					$c = '';
				}
		?>
		<tr>
			<td style="text-align:right;"><?php $no++; echo $no; ?></td>
			<td><?php echo $data['nopol']; ?></td>
			<td><?php echo $merchant; ?></td>
			<td style="text-align:right;"><?php echo $data['weight_in']; ?> Kg</td>
			<td style="text-align:right;"><?php echo $data['weight_out']; ?> Kg</td>
			<td style="text-align:right;"><?php echo $data['noncommodity']; ?> Kg</td>
			<td style="text-align:right;"><?php echo $data['rafaksi']; ?> Kg</td>
			<td style="text-align:right;"><?php echo $data['netto']; ?> Kg</td>
			<td style="text-align:center;"><?php echo $data['weighing_sts']; ?></td>
			<td style="text-align:center;"><?php echo date("H:s", strtotime($data['time_in'])); ?> <br /><?php echo date("d-m-Y", strtotime($data['date_in'])); ?></td>
			<td style="text-align:center;"><?php echo $data['p1'].' '.$data['p2'].' '.$c; ?></td>
			<td>
				<a href="check_edit.php?id=<?php echo $data['weighing_id']; ?>">
					<button class="btn btn-outline btn-block btn-primary btn-xs"><i class="fa fa-check-square-o fa-fw"></i> Check</button>
				</a>
			</td>
		</tr>
		<?php } ?>
	</tbody>
</table>
<!--</div>-->