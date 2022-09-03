<?php
	session_start();
	include "../connection.php";
	$date1	= $_POST['date1'];
	$date2	= $_POST['date2'];
	$query 	= mysql_query("select fee_id, sum(fee_t06) as a, sum(fee_t14) as b, sum(fee_t17) as c, sum(fee_t24) as d, 
			sum(fee_t26) as e, sum(fee_t29) as f, sum(fee_t36) as g, sum(fee_t40) as h, sum(fee_m03) as i, fee_date as date
			from laborer_fee2 where 
			fee_date between '".$date1."' and '".$date2."'
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
	<table style="border: solid 1px black; border-collapse: collapse; margin-bottom: 5px; margin-top: 0px; font-size:9pt; width:1000px; margin-right:0px;" id="tableNonkomoditi">
		<tr>
			<th style="text-align: center;width: 4%;border: solid 1px black;">No</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">Tanggal</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">T06</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">T14</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">T17</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">T24</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">T26</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">T29</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">T36</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">T40</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">Mandor</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">Total</th>
		</tr>
		<?php
			$no			= 1;
			$grandtotal = 0;
			$t06 = 0; $t14 = 0; $t17 = 0; $t24 = 0; $t26 = 0; $t29 = 0; $t36 = 0; $t40 = 0; $foreman = 0;
			while($r= mysql_fetch_array($query)){
				$total = 0;
				$total = $r['a']+$r['b']+$r['c']+$r['d']+$r['e']+$r['f']+$r['g']+$r['h']+$r['i'];
		?>
		<tr>
			<td style="text-align: center;border: solid 1px black;"><?php echo $no; ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo date("d-m-Y", strtotime($r['date'])); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['a']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['b']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['c']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['d']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['e']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['f']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['g']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['h']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['i']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($total); ?></td>
		</tr>
		<?php 
				$no++;
				$t06 = $t06+$r['a'];
				$t14 = $t14+$r['b'];
				$t17 = $t17+$r['c'];
				$t24 = $t24+$r['d'];
				$t26 = $t26+$r['e'];
				$t29 = $t29+$r['f'];
				$t36 = $t36+$r['g'];
				$t40 = $t40+$r['h'];
				$foreman 	= $foreman+$r['i'];
				$grandtotal = $grandtotal+$total;
			}
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
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($grandtotal); ?></td>
		</tr>
	</table>
	<br />Keterangan:
	<br /><br /><br /><br /><br />
</page>