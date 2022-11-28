<?php
	include "../connection.php";
	$date	= $_POST['date'];
	$date2 	= date("d-m-Y");
?>
<page backtop="15mm" backbottom="10mm" backleft="5mm" backright="5mm">
	<page_header>
        <table style="width:95%; border:0px; margin-top:10px; margin-bottom:0px; margin-left:5px; margin-right:5px; font-size:8pt;">
            <tr>
                <td style="text-align: left; width: 40%"></td>
                <td style="text-align: center; width: 25%"></td>
                <td style="text-align: right; width: 30%">Dicetak: <?php echo $date2; ?></td>
            </tr>
        </table>
    </page_header>
	<div style="font-size: 14px; font-weight: bold; text-align: center; margin-top:0px;">
		RINCIAN SIMPANAN PENDAPATAN MITRA PISS
	</div>
	<table style="margin-top: 10px; margin-bottom: 5px;font-size:10pt; width:500px;" >
		<tr>
			<td style="width: 30%;">Tanggal Kerja Mitra</td>
			<td style="width: 70%;">: <?php echo date("d-m-Y", strtotime($date)); ?></td>
		</tr>
	</table>
	<br />
	<div style="font-size: 12px; font-weight: bold; text-align: left; margin-bottom:10px;">
		Disimpan:
	</div>
	<table style="border: solid 1px black; border-collapse: collapse; margin-bottom: 5px;font-size:7pt; width:1100px; margin-right:0px;" id="tableNonkomoditi">
		<tr>
			<th style="text-align: center;width: 2%;border: solid 1px black;">No</th>
			<th style="text-align: center;width: 5%;border: solid 1px black;">No Nota</th>
			<th style="text-align: center;width: 3%;border: solid 1px black;">B001</th>
			<th style="text-align: center;width: 3%;border: solid 1px black;">B002</th>
			<th style="text-align: center;width: 3%;border: solid 1px black;">B003</th>
			<th style="text-align: center;width: 3%;border: solid 1px black;">B004</th>
			<th style="text-align: center;width: 3%;border: solid 1px black;">B005</th>
			<th style="text-align: center;width: 3%;border: solid 1px black;">B006</th>
			<th style="text-align: center;width: 3%;border: solid 1px black;">B007</th>
			<th style="text-align: center;width: 3%;border: solid 1px black;">B008</th>
			<th style="text-align: center;width: 3%;border: solid 1px black;">B009</th>
			<th style="text-align: center;width: 3%;border: solid 1px black;">B010</th>
			<th style="text-align: center;width: 3%;border: solid 1px black;">B011</th>
			<th style="text-align: center;width: 3%;border: solid 1px black;">B012</th>
			<th style="text-align: center;width: 3%;border: solid 1px black;">B013</th>
			<th style="text-align: center;width: 3%;border: solid 1px black;">B014</th>
			<th style="text-align: center;width: 3%;border: solid 1px black;">B015</th>
			<th style="text-align: center;width: 3%;border: solid 1px black;">S001</th>
			<th style="text-align: center;width: 3%;border: solid 1px black;">S002</th>
			<th style="text-align: center;width: 3%;border: solid 1px black;">S003</th>
			<th style="text-align: center;width: 3%;border: solid 1px black;">S004</th>
			<th style="text-align: center;width: 3%;border: solid 1px black;">S005</th>
			<th style="text-align: center;width: 3%;border: solid 1px black;">S006</th>
			<th style="text-align: center;width: 3%;border: solid 1px black;">S007</th>
			<th style="text-align: center;width: 3%;border: solid 1px black;">S008</th>
			<th style="text-align: center;width: 3%;border: solid 1px black;">S009</th>
			<th style="text-align: center;width: 3%;border: solid 1px black;">S010</th>
			<th style="text-align: center;width: 3%;border: solid 1px black;">S011</th>
			<th style="text-align: center;width: 3%;border: solid 1px black;">S012</th>
			<th style="text-align: center;width: 3%;border: solid 1px black;">S013</th>
			<th style="text-align: center;width: 3%;border: solid 1px black;">S014</th>
			<th style="text-align: center;width: 3%;border: solid 1px black;">S015</th>
			<!-- <th style="text-align: center;width: 5%;border: solid 1px black;">Mandor</th> -->
		</tr>
		<?php
			//select data
			$query 	= mysql_query("	select 	weighing_id, 
											B001_save,
											B002_save,
											B003_save,
											B004_save,
											B005_save,
											B006_save,
											B007_save,
											B008_save,
											B009_save,
											B010_save,
											B011_save,
											B012_save,
											B013_save,
											B014_save,
											B015_save,
											S001_save,
											S002_save,
											S003_save,
											S004_save,
											S005_save,
											S006_save,
											S007_save,
											S008_save,
											S009_save,
											S010_save,
											S011_save,
											S012_save,
											S013_save,
											S014_save,
											S015_save, 						
											M01_save, 
											M02_save, 
											M03_save,
											M04_save 
									from 	laborer_fee 
									where 	laborer_fee_sts = 'Baru' and 
											date(laborer_fee_date) = '".$date."' ");
			$no 	= 1;
			$total2	= 0;
			$B001	= 0;
			$B002	= 0;
			$B003	= 0;
			$B004	= 0;
			$B005	= 0;
			$B006	= 0;
			$B007	= 0;
			$B008	= 0;
			$B009	= 0;
			$B010	= 0;
			$B011	= 0;
			$B012	= 0;
			$B013	= 0;
			$B014	= 0;
			$B015	= 0;
			$S001	= 0;
			$S002	= 0;
			$S003	= 0;
			$S004	= 0;
			$S005	= 0;
			$S006	= 0;
			$S007	= 0;
			$S008	= 0;
			$S009	= 0;
			$S010	= 0;
			$S011	= 0;
			$S012	= 0;
			$S013	= 0;
			$S014	= 0;
			$S015	= 0;
			while($r= mysql_fetch_array($query)){
		?>
		<tr>
			<td style="text-align: center;border: solid 1px black;"><?php echo $no; ?></td>
			<td style="text-align: center;border: solid 1px black;"><?php echo $r['weighing_id']; ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['B001_save']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['B002_save']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['B003_save']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['B004_save']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['B005_save']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['B006_save']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['B007_save']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['B008_save']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['B009_save']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['B010_save']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['B011_save']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['B012_save']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['B013_save']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['B014_save']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['B015_save']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['S001_save']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['S002_save']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['S003_save']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['S004_save']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['S005_save']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['S006_save']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['S007_save']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['S008_save']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['S009_save']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['S010_save']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['S011_save']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['S012_save']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['S013_save']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['S014_save']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['S015_save']); ?></td>
			<!-- <td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['foreman_save']); ?></td> -->
		</tr>
		<?php
				$no++;
				$B001 = $B001+$r['B001_save']; 
				$B002 = $B002+$r['B002_save']; 
				$B003 = $B003+$r['B003_save']; 
				$B004 = $B004+$r['B004_save']; 
				$B005 = $B005+$r['B005_save']; 
				$B006 = $B006+$r['B006_save']; 
				$B007 = $B007+$r['B007_save']; 
				$B008 = $B008+$r['B008_save']; 
				$B009 = $B009+$r['B009_save'];
				$B010 = $B010+$r['B010_save'];
				$B011 = $B011+$r['B011_save'];
				$B012 = $B012+$r['B012_save'];
				$B013 = $B013+$r['B013_save'];
				$B014 = $B014+$r['B014_save'];
				$B015 = $B015+$r['B015_save'];
				$S001 = $S001+$r['S001_save']; 
				$S002 = $S002+$r['S002_save']; 
				$S003 = $S003+$r['S003_save']; 
				$S004 = $S004+$r['S004_save']; 
				$S005 = $S005+$r['S005_save']; 
				$S006 = $S006+$r['S006_save']; 
				$S007 = $S007+$r['S007_save']; 
				$S008 = $S008+$r['S008_save']; 
				$S009 = $S009+$r['S009_save'];
				$S010 = $S010+$r['S010_save'];
				$S011 = $S011+$r['S011_save'];
				$S012 = $S012+$r['S012_save'];
				$S013 = $S013+$r['S013_save'];
				$S014 = $S014+$r['S014_save'];
				$S015 = $S015+$r['S015_save'];
			}
			$total2 = 	$B001+
						$B002+
						$B003+
						$B004+
						$B005+
						$B006+
						$B007+
						$B008+
						$B009+
						$B010+
						$B011+
						$B012+
						$B013+
						$B014+
						$B015+
						$S001+
						$S002+
						$S003+
						$S004+
						$S005+
						$S006+
						$S007+
						$S008+
						$S009+
						$S010+
						$S011+
						$S012+
						$S013+
						$S014+
						$S015;
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
		</tr>
		<tr>
			<td style="text-align: right;border: solid 1px black;" colspan="30"><b>Total Disimpan </b></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;" colspan="2"><?php echo format_no($total2); ?></td>
		</tr>
	</table>
	<br />
    <page_footer>
        <table style="width: 95%; border: 0px black; margin-top:10px; margin-left:5px; margin-right:5px; font-size:8pt;">
            <tr>
                <td style="text-align: left;width: 50%"></td>
				<td style="text-align: center;width: 25%"></td>
                <td style="text-align: right;width: 25%">Halaman [[page_cu]]/[[page_nb]]</td>
            </tr>
        </table>
    </page_footer>
</page>