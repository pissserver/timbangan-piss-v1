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
	$('#checkerView').dataTable({"aLengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]]});
	});
</script>
<!--<div class="table-responsive">-->
<table id="checkerView" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th style="width:10%;">No</th>
			<th style="width:15%;">Kode</th>
			<th style="width:30%;">Nama</th>
			<th style="width:15%;">Bagian</th>
			<th style="width:20%;">Status</th>
			<th style="width:20%;">Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$sql 	= "select * from checker order by checker_id desc";
		$query 	= mysql_query($sql);
		$no		= 1;
			while($data=mysql_fetch_array($query)) { 
		?>
		<tr>
			<td style="text-align:center;"><?php echo $no; ?></td>
			<td><?php echo $data[1]; ?></td>
			<td><?php echo $data[2]; ?></td>
			<td><?php echo $data[4]; ?></td>
			<td><?php echo $data[5]; ?></td>
			<td>
				<center><a href="checker_edit.php?id=<?php echo $data[0]; ?>">
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