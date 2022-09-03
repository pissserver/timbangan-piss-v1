<?php
	include "connection.php";
	
	//cek Tgl
	if(!isset($_GET['day'])){
		$value = $_GET['day'];
	}
	else{
		$value = $_GET['day'];
	}
?>
<script>
	$(document).ready(function() {
		//data table
		$('#tableTonase').dataTable( {
			dom: "<'row'<'col-sm-8'l><'col-sm-4'f>>" +  
			"<'row'<'col-sm-12'tr>>" +
			"<'row'<'col-sm-6'i><'col-sm-6'p>>",
			renderer: 'bootstrap',
			/*/*"tableTools": {
				"sSwfPath": "dataTables/tableTools/swf/copy_csv_xls_pdf.swf",
				"aButtons": ["xls", "pdf", "print"]
			},*/
			"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
		} );
	});
</script>

<!-- jquery -->
<script src="dataTables/jquery.dataTables.js"></script>
<script src="dataTables/dataTables.tableTools.js"></script>
<script src="dataTables/dataTables.bootstrap.js"></script>

<table id="tableTonase" class="table table-striped table-bordered table-hover display" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th style="width:7%;text-align: center;"><small>No</small></th>
			<th style="width:15%;text-align: center;"><small>Nopol</small></th>
			<th style="width:38%;text-align: center;"><small>Pedagang</small></th>
			<th style="width:20%;text-align: center;"><small>Komoditi</small></th>
			<th style="width:20%;text-align: center;"><small>Tonase</small></th>
		</tr>
	</thead>
	<tbody>
		<?php
			$no		= 0;
			$cari	= mysql_query("select w.weighing_id, w.nopol, m.merchant_name, g.goods_name, w.netto
			from weighing w, merchant m, goods g
			where w.merchant_id = m.merchant_id and
			w.goods_id = g.goods_id and
			(weighing_sts = 'Keluar' || weighing_sts = 'Lunas') and
			date_format(date_out, '%d-%m-%Y') = '".$value."'
			group by w.weighing_id order by w.netto desc");
			while($r=mysql_fetch_array($cari)){
		?>
		<tr>
			<td>
				<small><?php $no++; echo $no; ?></small>
			</td>
			<td>
				<small><?php echo $r['nopol']; ?></small>
			</td>
			<td>
				<small><?php echo $r['merchant_name']; ?></small>
			</td>
			<td>
				<small><?php echo $r['goods_name']; ?></small>
			</td>
			<td style="text-align: right;">
				<small><?php echo number_format($r['netto'], 0 , '' , '.' ); ?> Kg</small>
			</td>
		</tr>
		<?php }
		?>
	</tbody>
</table>