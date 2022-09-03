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
	$('#checkerView').dataTable({"aLengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]]});
	});
</script>
<!--<div class="table-responsive">-->
<table id="checkerView" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th style="width:10%;">No</th>
			<th style="width:50%;">Nopol Kendaraan</th>
			<th style="width:20%;">Berat Standar</th>
			<th style="width:20%;">Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$sql 	= "select * from transportation order by transportation_id desc";
		$query 	= mysql_query($sql);
		$no		= 1;
			while($data=mysql_fetch_array($query)) { 
		?>
		<tr>
			<td style="text-align:center;"><?php echo $no; ?></td>
			<td><?php echo $data['transportation_nopol']; ?></td>
			<td style="text-align:right;"><?php echo $data['transportation_weight']; ?> Kg</td>
			<td>
				<center><a href="transportation_edit.php?id=<?php echo $data[0]; ?>">
				<button class="btn btn-outline btn-block btn-primary btn-xs">Ubah Data</button>
				</a></center>
			</td>
		</tr>
		<?php
			$no++;
			}
		?>
	</tbody>
</table>
<!--</div>-->