<?php
	session_start();
	include "../connection.php";
	$ko			= $_GET['ko'];
	$date2 		= date("d-m-Y");
	$cashier_id	= executeScalar("select cashier_id from ko where ko_id = '".$ko."'");
	$cashier	= executeScalar("select checker_name from checker where checker_id = '".$cashier_id."'");
	$checker_id	= executeScalar("select receiver_id from ko where ko_id = '".$ko."'");
	$checker	= executeScalar("select checker_name from checker where checker_id = '".$checker_id."'");
	$ko_date	= executeScalar("select ko_date from ko where ko_id = '".$ko."'");
	$ko_total	= executeScalar("select ko_total from ko where ko_id = '".$ko."'");
	//select tonase berdasarkan tanggal masuk
	$sql = "select 	weighing_id, 
					date_check, 
					merchant_id, 
					checker_id, 
					reffer, 
					date_check, 
					nopol, 
					netto,
					cost_tonase, 
					cost
			from 	weighing 
			where 	weighing_sts = 'Lunas' and 
					ko_id = '".$ko."'";
	
	$no 	= 1;
?>
<page backtop="8mm" backbottom="10mm" backleft="5mm" backright="5mm">
	<page_header>
        <table style="width:95%; border:0px; margin-top:10px; margin-left:5px; margin-right:5px; font-size:8pt;">
            <tr>
                <td style="text-align: left; width: 50%"></td>
                <td style="text-align: center; width: 25%"></td>
                <td style="text-align: right; width: 25%">Tgl Cetak: <?php echo $date2; ?></td>
            </tr>
        </table>
    </page_header>
    <page_footer>
        <table style="width: 95%; border: 0px black; margin-top:10px; margin-left:5px; margin-right:5px; font-size:8pt;">
            <tr>
                <td style="text-align: left;width: 50%"></td>
				<td style="text-align: center;width: 25%"></td>
                <td style="text-align: right;width: 25%"></td>
            </tr>
        </table>
    </page_footer>
    <div style="font-size: 14px; font-weight: bold; text-align: center; margin-top:0px; margin-right:65px;">
		SETORAN TONASE KASIR OPERASIONAL PISS
	</div>
    <br/>
	<table style="margin-bottom: 5px;font-size:11pt; width:400px;" >
		<tr>
			<td style="width: 40%;">No KO</td>
			<td style="width: 60%;">: KO<?php echo $ko; ?></td>
		</tr>
		<tr>
			<td>Kasir Operasional</td>
			<td>: <?php echo $cashier; ?></td>
		</tr>
		<tr>
			<td>Penyetor</td>
			<td>: <?php echo $checker; ?></td>
		</tr>
		<tr>
			<td>Total Setoran</td>
			<td>: <?php echo format_rupiah($ko_total); ?></td>
		</tr>
		<tr>
			<td>Tanggal Bayar</td>
			<td>: <?php echo date("d-m-Y", strtotime($ko_date)); ?></td>
		</tr>
	</table>
	<br />
	<table style="border: solid 1px black; border-collapse: collapse; margin-bottom: 5px;font-size:9pt; width:850px; margin-right:0px;" id="tableNonkomoditi">
		<tr>
			<th style="text-align: center;width: 4%; border: solid 1px black;">NO</th>
			<th style="text-align: center;width: 9%; border: solid 1px black;">TGL TAGIHAN</th>
			<th style="text-align: center;width: 10%;border: solid 1px black;">NOTA TIMBANG</th>
			<th style="text-align: center;width: 10%;border: solid 1px black;">NOTA TAGIHAN</th>
			<th style="text-align: center;width: 7%;border: solid 1px black;">NOPOL</th>
			<th style="text-align: center;width: 23%;border: solid 1px black;">PEDAGANG</th>
			<th style="text-align: center;width: 8%;border: solid 1px black;">TONASE</th>
			<th style="text-align: center;width: 10%;border: solid 1px black;">TOTAL (Rp)</th>
		</tr>
		<?php
			$query 	= mysql_query($sql);
			while($r= mysql_fetch_array($query)){
				$name		= executeScalar("select merchant_name from merchant where merchant_id = '".$r['merchant_id']."'");
				//$wid 		= sprintf("%07d", $r['weighing_id']);
				//$rid 		= sprintf("%07d", $r['reffer']);
				//$year1 		= executeScalar("select date_format(date_in, '%y') from weighing where weighing_id = '".$r['weighing_id']."'");
				//$year2 		= executeScalar("select date_format(date_out, '%y') from weighing where weighing_id = '".$r['weighing_id']."'");
		?>
		<tr>
			<td style="text-align: center;border: solid 1px black;"><?php echo $no; ?></td>
			<td style="text-align: center;border: solid 1px black;"><?php echo date("d-m-Y", strtotime($r['date_check'])); ?></td>
			<td style="text-align: center;border: solid 1px black;"><?php 
			if($r['reffer']=='null'||$r['reffer']==''){
				echo 'TB'.$r['weighing_id'];
			}else{
				echo 'TB'.$r['reffer'];
			} ?></td>
			<td style="text-align: center;border: solid 1px black;"><?php echo 'TG'.$r['weighing_id']; ?></td>
			<td style="text-align: center;border: solid 1px black;"><?php echo $r['nopol']; ?></td>
			<td style="text-align: left;border: solid 1px black;"><?php echo $name; ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['netto']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['cost_tonase']); ?></td>
		</tr>
		<?php 
			$no++;
			}
			$cost_tonase = executeScalar("select sum(cost_tonase) from weighing where weighing_sts = 'Lunas' and ko_id = '".$ko."'");
		?>
		<tr>
			<td style="text-align: right;border: solid 1px black;" colspan="7"><b>Total </b></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($cost_tonase); ?></td>
		</tr>
	</table>
	<br />Keterangan:
	<br/><br/><br/><br/><br/>
	<table style="width: 95%; border: 0px black; margin-top:9px; margin-left:5px; margin-right:5px; font-size:11pt;">
		<tr>
			<td style="text-align: center;width: 50%">(TTD Kasir Operasional)</td>
			<td style="text-align: center;width: 50%">(TTD Penyetor/Checker)</td>
		</tr>
	</table>
</page>