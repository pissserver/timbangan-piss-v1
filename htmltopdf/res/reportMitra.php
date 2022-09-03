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
		RINCIAN PENDAPATAN MITRA
	</div>
	<table style="margin-top: 10px; margin-bottom: 5px;font-size:10pt; width:500px;" >
		<tr>
			<td style="width: 30%;">Tanggal Kerja Mitra</td>
			<td style="width: 70%;">: <?php echo date("d-m-Y", strtotime($date)); ?></td>
		</tr>
	</table>
	<br />
	<div style="font-size: 12px; font-weight: bold; text-align: left; margin-bottom:10px;">
		Dibagikan:
	</div>
	<table style="border: solid 1px black; border-collapse: collapse; margin-bottom: 5px;font-size:9pt; width:1100px; margin-right:0px;" id="tableNonkomoditi">
		<tr>
			<th style="text-align: center;width: 3%;border: solid 1px black;">No</th>
			<th style="text-align: center;width: 7%;border: solid 1px black;">No Nota</th>
			<th style="text-align: center;width: 5%;border: solid 1px black;">T06</th>
			<th style="text-align: center;width: 5%;border: solid 1px black;">T14</th>
			<th style="text-align: center;width: 5%;border: solid 1px black;">T17</th>
			<th style="text-align: center;width: 5%;border: solid 1px black;">T24</th>
			<th style="text-align: center;width: 5%;border: solid 1px black;">T26</th>
			<th style="text-align: center;width: 5%;border: solid 1px black;">T29</th>
			<th style="text-align: center;width: 5%;border: solid 1px black;">T36</th>
			<th style="text-align: center;width: 5%;border: solid 1px black;">T40</th>
			<th style="text-align: center;width: 5%;border: solid 1px black;">Mandor</th>
			<th style="text-align: center;width: 5%;border: solid 1px black;">Pios</th>
		</tr>
		<?php
			//select data
			$query 	= mysql_query("select weighing_id, t06, t14, t17, t24, t26, t29, t36, t40, pios_fee, foreman from laborer_fee where laborer_fee_sts = 'Baru' and 
					date(laborer_fee_date) = '".$date."'");
			$no 	= 1;
			$total1	= 0;
			$t06 = 0; $t14 = 0; $t17 = 0; $t24 = 0; $t26 = 0; $t29 = 0; $t36 = 0; $t40 = 0; $foreman = 0; $pios = 0;
			while($r= mysql_fetch_array($query)){
		?>
		<tr>
			<td style="text-align: center;border: solid 1px black;"><?php echo $no; ?></td>
			<td style="text-align: center;border: solid 1px black;"><?php echo $r['weighing_id']; ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['t06']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['t14']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['t17']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['t24']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['t26']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['t29']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['t36']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['t40']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['foreman']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['pios_fee']); ?></td>
		</tr>
		<?php
				$no++;
				$t06 = $t06+$r['t06']; 
				$t14 = $t14+$r['t14']; 
				$t17 = $t17+$r['t17']; 
				$t24 = $t24+$r['t24']; 
				$t26 = $t26+$r['t26']; 
				$t29 = $t29+$r['t29']; 
				$t36 = $t36+$r['t36']; 
				$t40 = $t40+$r['t40']; 
				$foreman = $foreman+$r['foreman'];
				$pios = $pios+$r['pios_fee'];
			} 
			$total1 = $t06+$t14+$t17+$t24+$t26+$t29+$t36+$t40+$foreman+$pios;
		?>
		<tr>
			<td style="text-align: right;border: solid 1px black;" colspan="2"><b>Total </b></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($t06); ?></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($t14); ?></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($t17); ?></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($t24); ?></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($t26); ?></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($t29); ?></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($t36); ?></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($t40); ?></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($foreman); ?></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($pios); ?></td>
		</tr>
		<tr>
			<td style="text-align: right;border: solid 1px black;" colspan="11"><b>Total Dibagi </b></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($total1); ?></td>
		</tr>
	</table>
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