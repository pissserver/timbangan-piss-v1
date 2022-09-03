<?php
	include "../connection.php";
	$date1		= $_POST['date1'];
	$date2		= $_POST['date2'];
	$commodity	= $_POST['commodity'];
	$date 		= date("d-m-Y");
	$grandtot	= 0;
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
                <td style="text-align: left;width: 50%">Tgl Cetak: <?php echo $date; ?></td>
				<td style="text-align: center;width: 25%"></td>
                <td style="text-align: right;width: 25%">Halaman [[page_cu]]/[[page_nb]]</td>
            </tr>
        </table>
    </page_footer>
    <div style="font-size: 12px; font-weight: bold; text-align: center; margin-top:0px; margin-right:65px;">
		LAPORAN PEMBAYARAN TONASE PIOS
	</div>
    <br/>
	<table style="margin-bottom: 5px;font-size:10pt; width:300px;" >
		<tr>
			<td style="width: 35%;">Tanggal</td>
			<td style="width: 65%;">: <?php 
			if($date1==$date2){
				echo date("d-m-Y", strtotime($date1));
			}else{
				echo date("d-m-Y", strtotime($date1)).' sd '.date("d-m-Y", strtotime($date2));
			} ?></td>
		</tr>
		<tr>
			<td style="width: 35%;">Jenis Pedagang</td>
			<td style="width: 65%;">: <?php echo $commodity; ?></td>
		</tr>
	</table>
	<br />
	<table style="border: solid 1px black; border-collapse: collapse; margin-bottom: 5px;font-size:8pt; width:850px; margin-right:0px;" id="tableNonkomoditi">
		<tr>
			<th style="text-align: center;width: 5%; border: solid 1px black;">NO</th>
			<th style="text-align: left;width: 9%; border: solid 1px black;">TGL TAGIHAN</th>
			<th style="text-align: left;width: 9%; border: solid 1px black;">TGL BAYAR</th>
			<th style="text-align: left;width: 11%;border: solid 1px black;">NOTA TIMBANG</th>
			<th style="text-align: left;width: 11%;border: solid 1px black;">NOTA TAGIHAN</th>
			<th style="text-align: left;width: 22%;border: solid 1px black;">PEDAGANG</th>
			<th style="text-align: center;width: 8%;border: solid 1px black;">TONASE</th>
			<th style="text-align: center;width: 9%;border: solid 1px black;">TOTAL</th>
		</tr>
		<?php
			//select tonase berdasarkan tanggal masuk
			if($commodity=='Semua'){
				$sql = "select weighing_id, merchant_id, checker_id, reffer, date_in, date_pay, nopol, netto, cost
				from weighing where weighing_sts = 'Lunas' and 
				(date_pay between '".$date1."' and '".$date2."')";
			}else{
				$sql = "select w.weighing_id, w.merchant_id, w.checker_id, w.reffer, w.date_in, w.date_pay, w.nopol, w.netto, w.cost 
				from weighing w, merchant m 
				where w.merchant_id = m.merchant_id and 
				weighing_sts = 'Lunas' and 
				m.merchant_type = '".$commodity."' and
				(w.date_pay between '".$date1."' and '".$date2."')";
			}
			$query 		= mysql_query($sql);
			$no 		= 1;
			while($r= mysql_fetch_array($query)){
				$name		= executeScalar("select merchant_name from merchant where merchant_id = '".$r['merchant_id']."'");
				//$wid 		= sprintf("%07d", $r['weighing_id']);
				//$rid 		= sprintf("%07d", $r['reffer']);
				//$year1 		= executeScalar("select date_format(date_in, '%y') from weighing where weighing_id = '".$r['weighing_id']."'");
				//$year2 		= executeScalar("select date_format(date_out, '%y') from weighing where weighing_id = '".$r['weighing_id']."'");
		?>
		<tr>
			<td style="text-align: center;border: solid 1px black;"><?php echo $no; ?></td>
			<td style="text-align: left;border: solid 1px black;"><?php echo date("d-m-Y", strtotime($r['date_in'])); ?></td>
			<td style="text-align: left;border: solid 1px black;"><?php echo date("d-m-Y", strtotime($r['date_pay'])); ?></td>
			<td style="text-align: left;border: solid 1px black;"><?php 
			if($r['reffer']=='null'||$r['reffer']==''){
				echo 'TB'.$r['weighing_id'];
			}else{
				echo 'TB'.$r['reffer'];
			} ?></td>
			<td style="text-align: left;border: solid 1px black;"><?php echo 'TG'.$r['weighing_id']; ?></td>
			<td style="text-align: left;border: solid 1px black;"><?php echo $name; ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['netto']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['cost']); ?></td>
		</tr>
		<?php 
			$grandtot	= $grandtot+$r['cost'];
			$no++;
			}
		?>
		<tr>
			<td style="text-align: right;border: solid 1px black;" colspan="7"><b>Total </b></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($grandtot); ?></td>
		</tr>
	</table>
	<br />Keterangan:
</page>