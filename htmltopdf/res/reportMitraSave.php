<?php
	session_start();
	include "../connection.php";
	$date1	= $_POST['date1'];
	$date2	= $_POST['date2'];
	$querybuah 	= mysql_query("	select 	fee_id, 
										sum(save_B001) as SB001,
										sum(save_B002) as SB002,
										sum(save_B003) as SB003,
										sum(save_B004) as SB004,
										sum(save_B005) as SB005,
										sum(save_B006) as SB006,
										sum(save_B007) as SB007,
										sum(save_B008) as SB008,
										sum(save_B009) as SB009,
										sum(save_B010) as SB010,
										sum(save_B011) as SB011,
										sum(save_B012) as SB012,
										sum(save_B013) as SB013,
										sum(save_B014) as SB014,
										sum(save_B015) as SB015,
										fee_date as date
								from laborer_fee2 
								where fee_date between '".$date1."' and '".$date2."'
								group by date");

	$querysayur 	= mysql_query("	select 	fee_id, 
											sum(save_S001) as SS001,
											sum(save_S002) as SS002,
											sum(save_S003) as SS003,
											sum(save_S004) as SS004,
											sum(save_S005) as SS005,
											sum(save_S006) as SS006,
											sum(save_S007) as SS007,
											sum(save_S008) as SS008,
											sum(save_S009) as SS009,
											sum(save_S010) as SS010,
											sum(save_S011) as SS011,
											sum(save_S012) as SS012,
											sum(save_S013) as SS013,
											sum(save_S014) as SS014,
											sum(save_S015) as SS015,
											fee_date as date
									from laborer_fee2 
									where fee_date between '".$date1."' and '".$date2."'
									group by date");

	$querymandor 	= mysql_query("	select 	fee_id,
											sum(save_M01) as SM01,
											sum(save_M02) as SM02,
											sum(save_M03) as SM03,
											sum(save_M04) as SM04, 
											fee_date as date
								from laborer_fee2 
								where fee_date between '".$date1."' and '".$date2."'
								group by date");
?>
<page backtop="8mm" backbottom="10mm" backleft="5mm" backright="5mm">
	<page_header>
        <table style="width:95%; border:0px; margin-top:10px; margin-left:5px; margin-right:5px; font-size:8pt;">
            <tr>
                <td style="text-align: left; width: 50%"></td>
                <td style="text-align: center; width: 25%"></td>
                <td style="text-align: right; width: 25%"></td>
            </tr>
        </table>
    </page_header>
    <page_footer>
        <table style="width: 95%; border: 0px black; margin-top:10px; margin-left:5px; margin-right:5px; font-size:8pt;">
            <tr>
                <td style="text-align: left;width: 50%">Tgl Cetak: <?php echo $date2; ?></td>
				<td style="text-align: center;width: 25%"></td>
                <td style="text-align: right;width: 25%">Halaman [[page_cu]]/[[page_nb]]</td>
            </tr>
        </table>
    </page_footer>
    <div style="font-size: 14px; font-weight: bold; text-align: center; margin-top:0px; margin-right:65px;">
		REKAP PENDAPATAN MITRA DISIMPAN
	</div>
	<br />
	<br />
	<table style="margin-bottom: 5px;font-size:11pt; width:400px;" >
		<tr>
			<td style="width: 30%;">Tanggal</td>
			<td style="width: 70%;">: <?php echo date("d-m-Y", strtotime($date1)); ?> sd <?php echo date("d-m-Y", strtotime($date2)); ?></td>
		</tr>
	</table>
	<br />
	<table style="border: solid 1px black; border-collapse: collapse; margin-bottom: 5px; margin-top: 0px; font-size:9pt; width:990px; margin-right:0px;" id="tableNonkomoditi">
		<tr style="height: 15px">
			<th style="text-align: center;width: 3%;border: solid 1px black;">No</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">Tanggal</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">B001</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">B002</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">B003</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">B004</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">B005</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">B006</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">B007</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">B008</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">B009</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">B010</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">B011</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">B012</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">B013</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">B014</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">B015</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">Total</th>
		</tr>
		<?php
			$no 				= 1;
			$total 				= 0; 
			$grandtotalbuah 	= 0;
			$grandtotalsayur 	= 0;
			$grandtotal 		= 0;
			$B001	= 0;
			$B002 	= 0;
			$B003 	= 0;
			$B004 	= 0;
			$B005 	= 0;
			$B006 	= 0;
			$B007 	= 0;
			$B008 	= 0;
			$B009 	= 0;
			$B010 	= 0;
			$B011 	= 0;
			$B012 	= 0;
			$B013 	= 0;
			$B014 	= 0;
			$B015 	= 0;
			while($r= mysql_fetch_array($querybuah)){
				$totalbuah = 	
								$r['SB001']+
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
								$r['SB015']
		?>
		<tr>
			<td style="text-align: center;border: solid 1px black;"><?php echo $no; ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo date("d-m-Y", strtotime($r['date'])); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['SB001']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['SB002']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['SB003']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['SB004']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['SB005']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['SB006']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['SB007']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['SB008']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['SB009']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['SB010']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['SB011']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['SB012']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['SB013']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['SB014']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['SB015']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($totalbuah); ?></td>
		</tr>
		<?php 
				$no++;
				$B001 	= $B001 + $r['SB001'];
				$B002 	= $B002 + $r['SB002'];
				$B003 	= $B003 + $r['SB003'];
				$B004 	= $B004 + $r['SB004'];
				$B005 	= $B005 + $r['SB005'];
				$B006 	= $B006 + $r['SB006'];
				$B007 	= $B007 + $r['SB007'];
				$B008 	= $B008 + $r['SB008'];
				$B009 	= $B009 + $r['SB009'];
				$B010 	= $B010 + $r['SB010'];
				$B011 	= $B011 + $r['SB011'];
				$B012 	= $B012 + $r['SB012'];
				$B013 	= $B013 + $r['SB013'];
				$B014 	= $B014 + $r['SB014'];
				$B015 	= $B015 + $r['SB015'];
				$grandtotalbuah = $grandtotalbuah + $totalbuah;
			}
		?>
		<tr>
			<td style="text-align: right;border: solid 1px black;" colspan="2"><b>Total </b></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($B001); ?></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($B002); ?></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($B003); ?></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($B004); ?></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($B005); ?></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($B006); ?></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($B007); ?></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($B008); ?></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($B009); ?></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($B010); ?></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($B011); ?></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($B012); ?></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($B013); ?></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($B014); ?></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($B015); ?></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($grandtotalbuah); ?></td>
		</tr>
	</table>
	<br><br>
	<!-- Data Simpan Mitra Sayur -->
	<table style="border: solid 1px black; border-collapse: collapse; margin-bottom: 5px; margin-top: 0px; font-size:9pt; width:990px; margin-right:0px;" id="tableNonkomoditi">
		<tr>
			<th style="text-align: center;width: 3%;border: solid 1px black;">No</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">Tanggal</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">S001</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">S002</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">S003</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">S004</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">S005</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">S006</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">S007</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">S008</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">S009</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">S010</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">S011</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">S012</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">S013</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">S014</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">S015</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">Total</th>
		</tr>
		<?php
			$no 				= 1;
			$totalsayur 		= 0;
			$grandtotalsayur 	= 0;
			$S001	= 0;
			$S002 	= 0;
			$S003 	= 0;
			$S004 	= 0;
			$S005 	= 0;
			$S006 	= 0;
			$S007 	= 0;
			$S008 	= 0;
			$S009 	= 0;
			$S010 	= 0;
			$S011 	= 0;
			$S012 	= 0;
			$S013 	= 0;
			$S014 	= 0;
			$S015 	= 0;
			while($r2 = mysql_fetch_array($querysayur)){
				$totalsayur = 	$r2['SS001']+
								$r2['SS002']+
								$r2['SS003']+
								$r2['SS004']+
								$r2['SS005']+
								$r2['SS006']+
								$r2['SS007']+
								$r2['SS008']+
								$r2['SS009']+
								$r2['SS010']+
								$r2['SS011']+
								$r2['SS012']+
								$r2['SS013']+
								$r2['SS014']+
								$r2['SS015']
		?>
		<tr>
			<td style="text-align: center;border: solid 1px black;"><?php echo $no; ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo date("d-m-Y", strtotime($r2['date'])); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r2['SS001']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r2['SS002']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r2['SS003']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r2['SS004']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r2['SS005']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r2['SS006']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r2['SS007']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r2['SS008']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r2['SS009']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r2['SS010']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r2['SS011']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r2['SS012']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r2['SS013']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r2['SS014']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r2['SS015']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($totalsayur); ?></td>
		</tr>
		<?php 
				$no++;
				$S001 	= $S001 + $r2['SS001'];
				$S002 	= $S002 + $r2['SS002'];
				$S003 	= $S003 + $r2['SS003'];
				$S004 	= $S004 + $r2['SS004'];
				$S005 	= $S005 + $r2['SS005'];
				$S006 	= $S006 + $r2['SS006'];
				$S007 	= $S007 + $r2['SS007'];
				$S008 	= $S008 + $r2['SS008'];
				$S009 	= $S009 + $r2['SS009'];
				$S010 	= $S010 + $r2['SS010'];
				$S011 	= $S011 + $r2['SS011'];
				$S012 	= $S012 + $r2['SS012'];
				$S013 	= $S013 + $r2['SS013'];
				$S014 	= $S014 + $r2['SS014'];
				$S015 	= $S015 + $r2['SS015'];
				$grandtotalsayur = $grandtotalsayur + $totalsayur;
			}
		?>
		<tr>
			<td style="text-align: right;border: solid 1px black;" colspan="2"><b>Total </b></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($S001); ?></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($S002); ?></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($S003); ?></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($S004); ?></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($S005); ?></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($S006); ?></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($S007); ?></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($S008); ?></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($S009); ?></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($S010); ?></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($S011); ?></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($S012); ?></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($S013); ?></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($S014); ?></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($S015); ?></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($grandtotalsayur); ?></td>
		</tr>
	</table>
	<br><br>
	<!-- Data Simpan Mandor -->
	<table style="border: solid 1px black; border-collapse: collapse; margin-bottom: 5px; margin-top: 0px; font-size:9pt; width:990px; margin-right:0px;" id="tableNonkomoditi">
		<tr>
			<th style="text-align: center;width: 3%;border: solid 1px black;">No</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">Tanggal</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">M01</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">M02</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">M03</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">M04</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">Total</th>
		</tr>
		<?php
			$no 				= 1;
			$totalmandor 		= 0;
			$grandtotalmandor 	= 0;
			$M01				= 0;
			$M02 				= 0;
			$M03 				= 0;
			$M04 				= 0;
			while($r3 = mysql_fetch_array($querymandor)){
				$totalmandor = 	$r3['SM01']+
								$r3['SM02']+
								$r3['SM03']+
								$r3['SM04']
		?>
		<tr>
			<td style="text-align: center;border: solid 1px black;"><?php echo $no; ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo date("d-m-Y", strtotime($r3['date'])); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r3['SM01']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r3['SM02']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r3['SM03']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r3['SM04']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($totalmandor); ?></td>
		</tr>
		<?php 
				$no++;
				$M01 	= $M01 + $r3['SM01'];
				$M02 	= $M02 + $r3['SM02'];
				$M03 	= $M03 + $r3['SM03'];
				$M04 	= $M04 + $r3['SM04'];
				$grandtotalmandor = $grandtotalmandor + $totalmandor;
			}
		?>
		<tr>
			<td style="text-align: right;border: solid 1px black;" colspan="2"><b>Total </b></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($M01); ?></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($M02); ?></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($M03); ?></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($M04); ?></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($grandtotalmandor); ?></td>
		</tr>
	</table>

	<br />Keterangan:
	<br /><br /><br /><br /><br />
</page>