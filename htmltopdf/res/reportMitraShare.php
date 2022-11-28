<?php
	session_start();
	include "../connection.php";
	$date1	= $_POST['date1'];
	$date2	= $_POST['date2'];
	$query 	= mysql_query("	select 	fee_id, 
									sum(fee_B001) as B001, 
									sum(fee_B002) as B002, 
									sum(fee_B003) as B003, 
									sum(fee_B004) as B004, 
									sum(fee_B005) as B005, 
									sum(fee_B006) as B006, 
									sum(fee_B007) as B007, 
									sum(fee_B008) as B008, 
									sum(fee_B009) as B009,
									sum(fee_B010) as B010,
									sum(fee_B011) as B011,
									sum(fee_B012) as B012,
									sum(fee_B013) as B013,
									sum(fee_B014) as B014,
									sum(fee_B015) as B015,
									sum(fee_S001) as S001, 
									sum(fee_S002) as S002, 
									sum(fee_S003) as S003, 
									sum(fee_S004) as S004, 
									sum(fee_S005) as S005, 
									sum(fee_S006) as S006, 
									sum(fee_S007) as S007, 
									sum(fee_S008) as S008, 
									sum(fee_S009) as S009,
									sum(fee_S010) as S010,
									sum(fee_S011) as S011,
									sum(fee_S012) as S012,
									sum(fee_S013) as S013,
									sum(fee_S014) as S014,
									sum(fee_S015) as S015,
									sum(fee_M01) as M01,
									sum(fee_M02) as M02,
									sum(fee_M03) as M03,
									sum(fee_M04) as M04, 
									fee_date as date
							from 	laborer_fee2 
							where 	fee_date between '".$date1."' and '".$date2."'
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
		REKAP PENDAPATAN MITRA DIBAGIKAN
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
	<table style="border: solid 1px black; border-collapse: collapse; margin-bottom: 5px; margin-top: 0px; font-size:5.5pt; width:1000px; margin-right:0px;" id="tableNonkomoditi">
		<tr>
			<th style="text-align: center;height: 2%; width: 2%;border: solid 1px black;">No</th>
			<th style="text-align: center;width: 4%;border: solid 1px black;">Tanggal</th>
			<th style="text-align: center;width: 2%;border: solid 1px black;">B001</th>
			<th style="text-align: center;width: 2%;border: solid 1px black;">B002</th>
			<th style="text-align: center;width: 2%;border: solid 1px black;">B003</th>
			<th style="text-align: center;width: 2%;border: solid 1px black;">B004</th>
			<th style="text-align: center;width: 2%;border: solid 1px black;">B005</th>
			<th style="text-align: center;width: 2%;border: solid 1px black;">B006</th>
			<th style="text-align: center;width: 2%;border: solid 1px black;">B007</th>
			<th style="text-align: center;width: 2%;border: solid 1px black;">B008</th>
			<th style="text-align: center;width: 2%;border: solid 1px black;">B009</th>
			<th style="text-align: center;width: 2%;border: solid 1px black;">B010</th>
			<th style="text-align: center;width: 2%;border: solid 1px black;">B011</th>
			<th style="text-align: center;width: 2%;border: solid 1px black;">B012</th>
			<th style="text-align: center;width: 2%;border: solid 1px black;">B013</th>
			<th style="text-align: center;width: 2%;border: solid 1px black;">B014</th>
			<th style="text-align: center;width: 2%;border: solid 1px black;">B015</th>
			<th style="text-align: center;width: 2%;border: solid 1px black;">S001</th>
			<th style="text-align: center;width: 2%;border: solid 1px black;">S002</th>
			<th style="text-align: center;width: 2%;border: solid 1px black;">S003</th>
			<th style="text-align: center;width: 2%;border: solid 1px black;">S004</th>
			<th style="text-align: center;width: 2%;border: solid 1px black;">S005</th>
			<th style="text-align: center;width: 2%;border: solid 1px black;">S006</th>
			<th style="text-align: center;width: 2%;border: solid 1px black;">S007</th>
			<th style="text-align: center;width: 2%;border: solid 1px black;">S008</th>
			<th style="text-align: center;width: 2%;border: solid 1px black;">S009</th>
			<th style="text-align: center;width: 2%;border: solid 1px black;">S010</th>
			<th style="text-align: center;width: 2%;border: solid 1px black;">S011</th>
			<th style="text-align: center;width: 2%;border: solid 1px black;">S012</th>
			<th style="text-align: center;width: 2%;border: solid 1px black;">S013</th>
			<th style="text-align: center;width: 2%;border: solid 1px black;">S014</th>
			<th style="text-align: center;width: 2%;border: solid 1px black;">S015</th>
			<th style="text-align: center;width: 2%;border: solid 1px black;">M01</th>
			<th style="text-align: center;width: 2%;border: solid 1px black;">M02</th>
			<th style="text-align: center;width: 2%;border: solid 1px black;">M03</th>
			<th style="text-align: center;width: 2%;border: solid 1px black;">M04</th>
			<th style="text-align: center;width: 2%;border: solid 1px black;">Total</th>
		</tr>
		<?php
			$no			= 1;
			$grandtotal = 0;
			$B001		= 0;
			$B002		= 0;
			$B003		= 0;
			$B004		= 0;
			$B005		= 0;
			$B006		= 0;
			$B007		= 0;
			$B008		= 0;
			$B009		= 0;
			$B010		= 0;
			$B011		= 0;
			$B012		= 0;
			$B013		= 0;
			$B014		= 0;
			$B015		= 0;
			$S001		= 0;
			$S002		= 0;
			$S003		= 0;
			$S004		= 0;
			$S005		= 0;
			$S006		= 0;
			$S007		= 0;
			$S008		= 0;
			$S009		= 0;
			$S010		= 0;
			$S011		= 0;
			$S012		= 0;
			$S013		= 0;
			$S014		= 0;
			$S015		= 0;
			$M01		= 0;
			$M02		= 0;
			$M03		= 0;
			$M04		= 0;
			while($r= mysql_fetch_array($query)){
				$total = 0;
				$total = 	$r['B001']+
							$r['B002']+
							$r['B003']+
							$r['B004']+
							$r['B005']+
							$r['B006']+
							$r['B007']+
							$r['B008']+
							$r['B009']+
							$r['B010']+
							$r['B011']+
							$r['B012']+
							$r['B013']+
							$r['B014']+
							$r['B015']+
							$r['S001']+
							$r['S002']+
							$r['S003']+
							$r['S004']+
							$r['S005']+
							$r['S006']+
							$r['S007']+
							$r['S008']+
							$r['S009']+
							$r['S010']+
							$r['S011']+
							$r['S012']+
							$r['S013']+
							$r['S014']+
							$r['S015']+
							$r['M01']+
							$r['M02']+
							$r['M03']+
							$r['M04'];
		?>
		<tr>
			<td style="text-align: center;border: solid 1px black;"><?php echo $no; ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo date("d-m-Y", strtotime($r['date'])); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['B001']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['B002']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['B003']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['B004']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['B005']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['B006']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['B007']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['B008']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['B009']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['B010']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['B011']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['B012']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['B013']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['B014']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['B015']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['S001']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['S002']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['S003']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['S004']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['S005']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['S006']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['S007']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['S008']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['S009']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['S010']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['S011']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['S012']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['S013']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['S014']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['S015']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['M01']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['M02']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['M03']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['M04']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($total); ?></td>
		</tr>
		<?php 
				$no++;
				$B001 = $B001+$r['B001'];
				$B002 = $B002+$r['B002'];
				$B003 = $B003+$r['B003'];
				$B004 = $B004+$r['B004'];
				$B005 = $B005+$r['B005'];
				$B006 = $B006+$r['B006'];
				$B007 = $B007+$r['B007'];
				$B008 = $B008+$r['B008'];
				$B009 = $B009+$r['B009'];
				$B010 = $B010+$r['B010'];
				$B011 = $B011+$r['B011'];
				$B012 = $B012+$r['B012'];
				$B013 = $B013+$r['B013'];
				$B014 = $B014+$r['B014'];
				$B015 = $B015+$r['B015'];
				$S001 = $S001+$r['S001'];
				$S002 = $S002+$r['S002'];
				$S003 = $S003+$r['S003'];
				$S004 = $S004+$r['S004'];
				$S005 = $S005+$r['S005'];
				$S006 = $S006+$r['S006'];
				$S007 = $S007+$r['S007'];
				$S008 = $S008+$r['S008'];
				$S009 = $S009+$r['S009'];
				$S010 = $S010+$r['S010'];
				$S011 = $S011+$r['S011'];
				$S012 = $S012+$r['S012'];
				$S013 = $S013+$r['S013'];
				$S014 = $S014+$r['S014'];
				$S015 = $S015+$r['S015'];
				$M01  = $M01+$r['M01'];
				$M02  = $M02+$r['M02'];
				$M03  = $M03+$r['M03'];
				$M04  = $M04+$r['M04'];
				$grandtotal = $grandtotal+$total;
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
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($M01); ?></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($M02); ?></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($M03); ?></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($M04); ?></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($grandtotal); ?></td>
		</tr>
	</table>
	<br />Keterangan:
	<br /><br /><br /><br /><br />
</page>