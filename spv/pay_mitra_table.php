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
			$query 	= mysql_query("	SELECT date(laborer_fee_date) as dt,
										sum(B001) as SB001, 
										sum(B002) as SB002, 
										sum(B003) as SB003,
										sum(B004) as SB004,
										sum(B005) as SB005, 
										sum(B006) as SB006,
										sum(B007) as SB007, 
										sum(B008) as SB008,
										sum(B009) as SB009,
										sum(B010) as SB010,
										sum(B011) as SB011,
										sum(B012) as SB012,
										sum(B013) as SB013,
										sum(B014) as SB014,
										sum(B015) as SB015,
										sum(S001) as SS001, 
										sum(S002) as SS002, 
										sum(S003) as SS003,
										sum(S004) as SS004,
										sum(S005) as SS005, 
										sum(S006) as SS006,
										sum(S007) as SS007, 
										sum(S008) as SS008,
										sum(S009) as SS009,
										sum(S010) as SS010,
										sum(S011) as SS011,
										sum(S012) as SS012,
										sum(S013) as SS013,
										sum(S014) as SS014,
										sum(S015) as SS015, 
										sum(M01) as SM01,
										sum(M02) as SM02,
										sum(M03) as SM03,
										sum(M04) as SM04,
										sum(B001_save) as SB001s, 
										sum(B002_save) as SB002s, 
										sum(B003_save) as SB003s,
										sum(B004_save) as SB004s,
										sum(B005_save) as SB005s, 
										sum(B006_save) as SB006s,
										sum(B007_save) as SB007s, 
										sum(B008_save) as SB008s,
										sum(B009_save) as SB009s,
										sum(B010_save) as SB010s,
										sum(B011_save) as SB011s,
										sum(B012_save) as SB012s,
										sum(B013_save) as SB013s,
										sum(B014_save) as SB014s,
										sum(B015_save) as SB015s,
										sum(S001_save) as SS001s, 
										sum(S002_save) as SS002s, 
										sum(S003_save) as SS003s,
										sum(S004_save) as SS004s,
										sum(S005_save) as SS005s, 
										sum(S006_save) as SS006s,
										sum(S007_save) as SS007s, 
										sum(S008_save) as SS008s,
										sum(S009_save) as SS009s,
										sum(S010_save) as SS010s,
										sum(S011_save) as SS011s,
										sum(S012_save) as SS012s,
										sum(S013_save) as SS013s,
										sum(S014_save) as SS014s,
										sum(S015_save) as SS015s,
										sum(M01_save) as SM01s,
										sum(M02_save) as SM02s,
										sum(M03_save) as SM03s,
										sum(M04_save) as SM04s
									FROM `laborer_fee` where laborer_fee_sts = 'Baru'
									group by date(laborer_fee_date) desc limit 90");
			while($r	= mysql_fetch_array($query)) { 
				$no++;
				$share	= executeScalar("	select (sum(fee_B001)+
													sum(fee_B002)+
													sum(fee_B003)+
													sum(fee_B004)+
													sum(fee_B005)+
													sum(fee_B006)+
													sum(fee_B007)+
													sum(fee_B008)+
													sum(fee_B009)+
													sum(fee_B010)+
													sum(fee_B011)+
													sum(fee_B012)+
													sum(fee_B013)+
													sum(fee_B014)+
													sum(fee_S015)+
													sum(fee_S001)+
													sum(fee_S002)+
													sum(fee_S003)+
													sum(fee_S004)+
													sum(fee_S005)+
													sum(fee_S006)+
													sum(fee_S007)+
													sum(fee_S008)+
													sum(fee_S009)+
													sum(fee_S010)+
													sum(fee_S011)+
													sum(fee_S012)+
													sum(fee_S013)+
													sum(fee_S014)+
													sum(fee_S015)+
													sum(fee_M01)+
													sum(fee_M02)+
													sum(fee_M03)+
													sum(fee_M04)) 
											from laborer_fee2 where fee_date = '".$r['dt']."'");
				$save	= executeScalar("	select (sum(save_B001)+
													sum(save_B002)+
													sum(save_B003)+
													sum(save_B004)+
													sum(save_B005)+
													sum(save_B006)+
													sum(save_B007)+
													sum(save_B008)+
													sum(save_B009)+
													sum(save_B010)+
													sum(save_B011)+
													sum(save_B012)+
													sum(save_B013)+
													sum(save_B014)+
													sum(save_B015)+
													sum(save_S001)+
													sum(save_S002)+
													sum(save_S003)+
													sum(save_S004)+
													sum(save_S005)+
													sum(save_S006)+
													sum(save_S007)+
													sum(save_S008)+
													sum(save_S009)+
													sum(save_S010)+
													sum(save_S011)+
													sum(save_S012)+
													sum(save_S013)+
													sum(save_S014)+
													sum(save_S015)+
													sum(save_M01)+
													sum(save_M02)+
													sum(save_M03)+
													sum(save_M04)) 
											from laborer_fee2 where fee_date = '".$r['dt']."'");
				$total1	= 	$r['SB001']+
							$r['SB002']+
							$r['SB003']+
							$r['SB004']+
							$r['SB005']+
							$r['SB006']+
							$r['SB007']+
							$r['SB008']+
							$r['SB009']+
							$r['SB010']+
							$r['SB011']+
							$r['SB012']+
							$r['SB013']+
							$r['SB014']+
							$r['SB015']+
							$r['SS001']+
							$r['SS002']+
							$r['SS003']+
							$r['SS004']+
							$r['SS005']+
							$r['SS006']+
							$r['SS007']+
							$r['SS008']+
							$r['SS009']+
							$r['SS010']+
							$r['SS011']+
							$r['SS012']+
							$r['SS013']+
							$r['SS014']+
							$r['SS015']+
							$r['SM01']+
							$r['SM02']+
							$r['SM03']+
							$r['SM04'];
				$total2	= 	$r['SB001s']+
							$r['SB002s']+
							$r['SB003s']+
							$r['SB004s']+
							$r['SB005s']+
							$r['SB006s']+
							$r['SB007s']+
							$r['SB008s']+
							$r['SB009s']+
							$r['SB010s']+
							$r['SB011s']+
							$r['SB012s']+
							$r['SB013s']+
							$r['SB014s']+
							$r['SB015s']+
							$r['SS001s']+
							$r['SS002s']+
							$r['SS003s']+
							$r['SS004s']+
							$r['SS005s']+
							$r['SS006s']+
							$r['SS007s']+
							$r['SS008s']+
							$r['SS009s']+
							$r['SS010s']+
							$r['SS011s']+
							$r['SS012s']+
							$r['SS013s']+
							$r['SS014s']+
							$r['SS015s']+
							$r['SM01s']+
							$r['SM02s']+
							$r['SM03s']+
							$r['SM04s'];
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