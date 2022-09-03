<?php
	include "../connection.php";
?>
<page backtop="5mm" backbottom="5mm" backleft="5mm" backright="5mm">
    <?php
		$year 		= date("y");
		$date 		= date("Y-m-d");
		$work_date	= $_GET['date'];
		//Ambis uppah mitra
		$t06 	= executeScalar("SELECT fee_t06 FROM laborer_fee2 where date(fee_date) = '".$work_date."'");
		$t14 	= executeScalar("SELECT fee_t14 FROM laborer_fee2 where date(fee_date) = '".$work_date."'");
		$t17 	= executeScalar("SELECT fee_t17 FROM laborer_fee2 where date(fee_date) = '".$work_date."'");
		$t24 	= executeScalar("SELECT fee_t24 FROM laborer_fee2 where date(fee_date) = '".$work_date."'");
		$t26 	= executeScalar("SELECT fee_t26 FROM laborer_fee2 where date(fee_date) = '".$work_date."'");
		$t29 	= executeScalar("SELECT fee_t29 FROM laborer_fee2 where date(fee_date) = '".$work_date."'");
		$t36 	= executeScalar("SELECT fee_t36 FROM laborer_fee2 where date(fee_date) = '".$work_date."'");
		$t40 	= executeScalar("SELECT fee_t40 FROM laborer_fee2 where date(fee_date) = '".$work_date."'");
		$m03	= executeScalar("SELECT fee_m03 FROM laborer_fee2 where date(fee_date) = '".$work_date."'");
		$total	= $t06+$t14+$t17+$t24+$t26+$t29+$t36+$t40+$m03;
	?>
	<page_header>
    </page_header>
	<table style="width:95%; border:0px; margin-top:0px; margin-left:5px; margin-right:5px; font-size:9pt;">
		<tr>
			<td style="text-align: left; width: 50%">PIOS</td>
			<td style="text-align: center; width: 5%"></td>
			<td style="text-align: right; width: 45%"><?php echo date("d-m-Y", strtotime($date)); ?></td>
		</tr>
	</table><br/>
    <div style="font-size: 12px; font-weight: bold; text-align: center; margin-top:0px; margin-bottom:5px;">
		UPAH MITRA DIBAGIKAN
	</div>
	<table style="margin-bottom: 5px;font-size:10pt;" id="tableCheckout">
		<tr><td>Tanggal Kerja	</td><td> : <?php echo date("d-m-Y", strtotime($work_date)); ?> </td></tr>
		<tr><td>Total Uang		</td><td> : <?php echo format_rupiah($total); ?> </td></tr>
	</table>
    <br/>
	<table style="border: solid 1px black; border-collapse: collapse; margin-bottom: 5px;font-size:10pt; width:300px; margin-right:0px;" id="tableNonkomoditi">
		<tr>
			<th style="text-align: left;width: 10%; border: solid 1px black; text-align:center;">No</th>
			<th style="text-align: left;width: 35%;border: solid 1px black;">Nama (Kode)</th>
			<th style="text-align: center;width: 30%;border: solid 1px black;">Jumlah Uang</th>
			<th style="text-align: left;width: 25%; border: solid 1px black; text-align:center;">TTD</th>
		</tr>
		<tr>
			<td style="border: solid 1px black; text-align:center;">1.</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;Soari (T06)</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;<?php echo format_rupiah($t06); ?></td>
			<td style="border: solid 1px black; text-align:center;"><p>&nbsp;</p></td>
		</tr>
		<tr>
			<td style="border: solid 1px black; text-align:center;">2.</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;Musodik (T14)</td>
			<td style="border: solid 1px black; text-align:left">&nbsp;<?php echo format_rupiah($t14); ?></td>
			<td style="border: solid 1px black; text-align:center;"><p>&nbsp;</p></td>
		</tr>
		<tr>
			<td style="border: solid 1px black; text-align:center;">3.</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;Hafid (T17)</td>
			<td style="border: solid 1px black; text-align:left">&nbsp;<?php echo format_rupiah($t17); ?></td>
			<td style="border: solid 1px black; text-align:center;"><p>&nbsp;</p></td>
		</tr>
		<tr>
			<td style="border: solid 1px black; text-align:center;">4.</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;Adenan (T24)</td>
			<td style="border: solid 1px black; text-align:left">&nbsp;<?php echo format_rupiah($t24); ?></td>
			<td style="border: solid 1px black; text-align:center;"><p>&nbsp;</p></td>
		</tr>
		<tr>
			<td style="border: solid 1px black; text-align:center;">5.</td>
			<td style="border: solid 1px black; text-align:left;"><p>&nbsp;Zaenal (T26)</p></td>
			<td style="border: solid 1px black; text-align:left"><p>&nbsp;<?php echo format_rupiah($t26); ?></p></td>
			<td style="border: solid 1px black; text-align:center;"><p>&nbsp;</p></td>
		</tr>
		<tr>
			<td style="border: solid 1px black; text-align:center;">6.</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;Mustofa (T29)</td>
			<td style="border: solid 1px black; text-align:left">&nbsp;<?php echo format_rupiah($t29); ?></td>
			<td style="border: solid 1px black; text-align:center;"><p>&nbsp;</p></td>
		</tr>
		<tr>
			<td style="border: solid 1px black; text-align:center;">7.</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;Rochman (T36)</td>
			<td style="border: solid 1px black; text-align:left">&nbsp;<?php echo format_rupiah($t36); ?></td>
			<td style="border: solid 1px black; text-align:center;"><p>&nbsp;</p></td>
		</tr>
		<tr>
			<td style="border: solid 1px black; text-align:center;">8.</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;Maksum (T40)</td>
			<td style="border: solid 1px black; text-align:left">&nbsp;<?php echo format_rupiah($t40); ?></td>
			<td style="border: solid 1px black; text-align:center;"><p>&nbsp;</p></td>
		</tr>
		<tr>
			<td style="border: solid 1px black; text-align:center;">9.</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;Zaini (M03)</td>
			<td style="border: solid 1px black; text-align:left">&nbsp;<?php echo format_rupiah($m03); ?></td>
			<td style="border: solid 1px black; text-align:center;"><p>&nbsp;</p></td>
		</tr>
		<tr>
			<td style="border: solid 1px black; text-align:center;" colspan="2"><b> Total</b></td>
			<td colspan="2" style="border: solid 1px black; text-align:left"><b> <?php echo format_rupiah($total); ?></b></td>
		</tr>
	</table>
	<br /><br/><br/>
    <page_footer>
	<table style="width: 95%; border: 0px black; margin-top:10px; margin-left:25px; margin-right:25px; font-size:9pt;">
		<tr>
			<td style="text-align: left;width: 35%">Manajemen</td>
			<td style="text-align: center;width: 10%"></td>
			<td style="text-align: right;width: 35%">Security </td>
		</tr>
	</table>
    </page_footer>
</page>