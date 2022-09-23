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
	$('#laborerView').dataTable({"aLengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]]});
	});
</script>
<!--<div class="table-responsive-->
<table id="laborerView" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th style="width:10%; text-align:center;">No</th>
			<th style="width:20%; text-align:center;">Kode Mitra</th>
			<th style="width:30%;">Nama Mitra</th>
			<th style="width:20%; text-align:center;">Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$sql 	= "select * from laborer order by laborer_id desc";
		$query 	= mysql_query($sql);
		$no		= 1;
			while($data=mysql_fetch_array($query)) { 
		?>
		<tr>
			<td style="text-align:center;"><?php echo $no; ?></td>
			<td style="text-align:center;"><?php echo $data['laborer_code']; ?></td>
			<td><?php echo $data['laborer_name']; ?></td>
			<td>
				<center><a href="laborer_edit.php?id=<?php echo $data['laborer_id']; ?>">
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