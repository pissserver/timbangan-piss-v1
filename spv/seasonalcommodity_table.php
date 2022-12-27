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
	$('#goodsView').dataTable({"aLengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]]});
	});
</script>
<!--<div class="table-responsive">-->
<table id="goodsView" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th style="width:10%;">No</th>
			<th style="width:40%;">Nama Komoditi</th>
			<th style="width:20%;">Kategori</th>
			<th style="width:20%;">Status</th>
			<th style="width:20%;">Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$sql 	= "	select sc.id_sc, g.goods_name, g.goods_type, sc.status_aktif  
					from seasonalcommodity sc
					join goods g on g.goods_id = sc.goods_id 
					order by g.goods_name";
		$query 	= mysql_query($sql);
		$no		= 1;
			while($data=mysql_fetch_array($query)) { 
		?>
		<tr>
			<td style="text-align:center;"><?php echo $no; ?></td>
			<td><?php echo $data[1]; ?></td>
			<td><?php echo $data[2]; ?></td>
			<td><?php if ($data[3] == 1) { echo "Aktif";
						}else{ echo "Tidak Aktif"; }  ?></td>
			<td>
				<center>
					<?php 
						if ($data[3] == 1) { ?>
							<a href="seasonalcommodity_action.php?task=nonaktifkan&id=<?php echo $data[0]; ?>">
								<button class="btn btn-outline btn-block btn-primary btn-xs">Nonaktifkan</button>
							</a>
						<?php } else{?>
							<a href="seasonalcommodity_action.php?task=aktifkan&id=<?php echo $data[0]; ?>">
								<button class="btn btn-outline btn-block btn-primary btn-xs">Aktifkan</button>
							</a>
						<?php } ?>
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