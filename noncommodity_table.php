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
	$('#commodityView').dataTable({"aLengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]]});
	});
</script>
<!--<div class="table-responsive">-->
<table id="commodityView" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th style="width:10%;">No</th>
			<th style="width:50%;">Non Komoditi</th>
			<th style="width:20%;">Potongan</th>
			<th style="width:20%; text-align:center;">Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$sql 	= "select * from noncommodity order by noncommodity_id";
		$query 	= mysql_query($sql);
		$no		= 1;
			while($data=mysql_fetch_array($query)) { 
		?>
		<tr>
			<td style="text-align:center;"><?php echo $no; ?></td>
			<td><?php echo $data['noncommodity_name']; ?></td>
			<td style="text-align:right;"><?php echo $data['noncommodity_weight']; ?> Kg</td>
			<td>
				<center><a href="noncommodity_edit.php?id=<?php echo $data['noncommodity_id']; ?>">
				<button class="btn btn-outline btn-block btn-primary btn-xs">Ubah Data</button>
				</a></center>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>
<!--</div>-->