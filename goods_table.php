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
	$('#goodsView').dataTable({"aLengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]]});
	});
</script>
<!--<div class="table-responsive">-->
<table id="goodsView" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th style="width:10%;">No</th>
			<th style="width:40%;">Nama Barang</th>
			<th style="width:20%;">Jenis Barang</th>
			<th style="width:20%;">Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$sql 	= "select * from goods order by goods_name";
		$query 	= mysql_query($sql);
		$no		= 1;
			while($data=mysql_fetch_array($query)) { 
		?>
		<tr>
			<td style="text-align:center;"><?php echo $no; ?></td>
			<td><?php echo $data[1]; ?></td>
			<td><?php echo $data[2]; ?></td>
			<td>
				<center>
					<a href="goods_edit.php?id=<?php echo $data[0]; ?>">
						<button class="btn btn-outline btn-block btn-primary btn-xs">Ubah Data</button>
					</a>
				</center>
			</td>
		</tr>
		<?php
			$no++;
			}
		?>
	</tbody>
</table>
<!--</div>-->