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
	$('#payView').dataTable({"aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]]});
	});
</script>
<!--<div class="table-responsive">-->
<table id="payView" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th style="width:5%; text-align:center;">No</th>
			<th style="width:10%; text-align:center;">Tanggal Kerja</th>
			<th style="width:20%; text-align:center;">Upah Mitra Yg Dibagi</th>
			<th style="width:20%; text-align:center;">Upah Mitra Yg Disimpan</th>
			<th style="width:10%; text-align:center;">Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$no		= 0;
			$total	= 0;
			$query 	= mysql_query("SELECT date(laborer_fee_date) as dt,
					sum(t06) as st06, sum(t14) as st14, sum(t17) as st17,
					sum(t24) as st24,sum(t26) as st26, sum(t29) as st29,
					sum(t36) as st36, sum(t40) as st40, sum(foreman) as sm03,
					sum(t06_save) as st06s, sum(t14_save) as st14s, sum(t17_save) as st17s,
					sum(t24_save) as st24s,sum(t26_save) as st26s, sum(t29_save) as st29s,
					sum(t36_save) as st36s, sum(t40_save) as st40s, sum(foreman_save) as sm03s
					FROM `laborer_fee` where laborer_fee_sts = 'Baru'
					group by date(laborer_fee_date) desc limit 90");
			while($r	= mysql_fetch_array($query)) { 
				$no++;
				$share	= executeScalar("select (sum(fee_t06)+sum(fee_t14)+sum(fee_t17)+sum(fee_t24)+sum(fee_t26)+sum(fee_t29)+sum(fee_t36)+sum(fee_t40)+sum(fee_m03)) from laborer_fee2 where fee_date = '".$r['dt']."'");
				$save	= executeScalar("select (sum(save_t06)+sum(save_t14)+sum(save_t17)+sum(save_t24)+sum(save_t26)+sum(save_t29)+sum(save_t36)+sum(save_t40)+sum(save_m03)) from laborer_fee2 where fee_date = '".$r['dt']."'");
				$total1	= $r['st06']+$r['st14']+$r['st17']+$r['st24']+$r['st26']+$r['st29']+$r['st36']+$r['st40']+$r['sm03'];
				$total2	= $r['st06s']+$r['st14s']+$r['st17s']+$r['st24s']+$r['st26s']+$r['st29s']+$r['st36s']+$r['st40s']+$r['sm03s'];
		?>
		<tr>
			<td style="text-align:right;"><?php echo $no; ?>.</td>
			<td style="text-align:center;"><?php echo date("d-m-Y", strtotime($r['dt'])); ?></td>
			<td style="text-align:right;"><?php echo format_rupiah($total1).' --> '.format_rupiah($share); ?></td>
			<td style="text-align:right;"><?php echo format_rupiah($total2).' --> '.format_rupiah($save); ?></td>
			<td>
				<?php
					if($share==null){
						echo "<a href='pay_mitra2.php?date=".$r['dt']."' class='btn btn-xs btn-outline btn-primary btn-block'>Bayar</a>";
					}else{
						echo "<a href='pay_mitra2.php?date=".$r['dt']."' class='btn btn-xs btn-outline btn-primary btn-block'>Revisi</a>";
						echo "<a href='../htmltopdf/mitra_dibagi.php?date=".$r['dt']."' target='_blank' class='btn btn-xs btn-outline btn-success btn-block'>Cetak</a>";
					}
				?>
			</td>
		</tr>
		<?php } ?>
	</tbody>
</table>
<!--</div>-->