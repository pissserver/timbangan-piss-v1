<?php
	include "../connection.php";
	$date_1 	= date("d/m/Y");
	$date 		= date("2016-03-14");
	$commodity	= $_POST['commodity'];
	$date2		= $_POST['date2'];
?>
<page backtop="15mm" backbottom="10mm" backleft="10mm" backright="10mm">
	<page_header>
        <!--<table style="width:95%; border:0px; margin-top:10px; margin-left:5px; margin-right:5px; font-size:8pt;">
            <tr>
                <td style="text-align: left; width: 50%"></td>
                <td style="text-align: center; width: 25%"></td>
                <td style="text-align: right; width: 25%"></td>
            </tr>
        </table>-->
		<div style="font-size: 12px; font-weight: bold; text-align: center; margin-top:20px;">
			RINCIAN OUTSTANDING TIMBANGAN PIOS
		</div>
    </page_header>
	<div style="font-size: 10px; text-align: left; margin-top:0px;">
		Komoditi: <?php echo $commodity; ?>
	</div>
	<br />
	<page_footer>
        <table style="width: 95%; border: 0px black; margin-top:10px; margin-left:5px; margin-right:5px; font-size:9pt;">
            <tr>
                <td style="text-align: left;width: 45%">Tgl Cetak: <?php echo $date_1; ?></td>
				<td style="text-align: center;width: 35%"></td>
                <td style="text-align: right;width: 20%">Halaman [[page_cu]]/[[page_nb]]</td>
            </tr>
        </table>
    </page_footer>
	<table style="border: solid 1px black; border-collapse: collapse; margin-bottom: 5px;font-size:9pt; width:680px; margin-right:0px;" id="tableNonkomoditi">
		<tr>
			<th style="text-align: left;width: 4%; border: solid 1px black;">NO</th>
			<th style="text-align: left;width: 13%; border: solid 1px black;">TGL MASUK</th>
			<th style="text-align: left;width: 7%; border: solid 1px black;">JAM</th>
			<th style="text-align: left;width: 15%;border: solid 1px black;">NOTA TIMBANG</th>
			<th style="text-align: left;width: 25%;border: solid 1px black;">PEDAGANG</th>
			<th style="text-align: left;width: 12%;border: solid 1px black;">NOPOL</th>
			<!--<th style="text-align: left;width: 20%;border: solid 1px black;">Komoditi</th>-->
			<th style="text-align: left;width: 9%;border: solid 1px black;">LAPAK</th>
			<th style="text-align: center;width: 15%;border: solid 1px black;">BERAT MASUK</th>
		</tr>
		<?php
			if($commodity=='Semua'){
				$sql = "select w.weighing_id, w.date_in, w.time_in, w.merchant_id, m.merchant_name, w.nopol, w.weight_in 
				from weighing w, merchant m 
				where w.merchant_id = m.merchant_id and 
				(w.date_in between '".$date."' and '".$date2."') and 
				(w.date_out > '".$date2."' || w.date_out is NULL) and
				m.merchant_status = 'Aktif'";
			}else{
				$sql = "select w.weighing_id, w.date_in, w.time_in, w.merchant_id, m.merchant_name, w.nopol, w.weight_in 
				from weighing w, merchant m 
				where w.merchant_id = m.merchant_id and 
				(w.date_in between '".$date."' and '".$date2."') and 
				(w.date_out > '".$date2."' || w.date_out is NULL) and
				m.merchant_type = '".$commodity."' and 
				m.merchant_status = 'Aktif'";
			}
			$query 	= mysql_query($sql);
			//$sql1 	= mysql_query("select * from weighing where weighing_sts = 'Masuk' ");
			$no			= 1;
			$total		= 0;
			while($r2= mysql_fetch_array($query)){
				$name	= executeScalar("select merchant_name from merchant where merchant_id = '".$r2['merchant_id']."'");
				$lpk 	= executeScalar("select l.lapak_name from rent r, lapak l 
						where r.lapak_id = l.lapak_id and r.merchant_id = '".$r2['merchant_id']."' 
						and (r.rent_sts2 != 'Pindah' && r.rent_sts2 != 'Batal') limit 1");
				//$wid 	= sprintf("%07d", $r2['weighing_id']);
				//$year 	= executeScalar("select date_format(date_in, '%y') from weighing where weighing_id = '".$r2['weighing_id']."'");
		?>
		<tr>
			<td style="text-align: left;border: solid 1px black;"><?php echo $no;  ?></td>
			<td style="text-align: left;border: solid 1px black;"><?php echo date("d-m-Y", strtotime($r2['date_in'])); ?></td>
			<td style="text-align: left;border: solid 1px black;"><?php echo date("H:i", strtotime($r2['time_in'])); ?></td>
			<td style="text-align: left;border: solid 1px black;">TB<?php echo $r2['weighing_id']; ?></td>
			<td style="text-align: left;border: solid 1px black;"><?php echo $r2['merchant_name']; ?></td>
			<td style="text-align: left;border: solid 1px black;"><?php echo $r2['nopol']; ?></td>
			<!--<td style="text-align: left;border: solid 1px black;"><?php //echo $goods; ?></td>-->
			<td style="text-align: left;border: solid 1px black;"><?php echo $lpk; ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r2['weight_in']); ?></td>
		</tr>
		<?php 
				$no++;
				$total = $total+$r2['weight_in'];
			}
		?>
		<tr>
			<td style="text-align: right;border: solid 1px black;" colspan="7"><b>TOTAL </b></td>
			<td style="text-align: right;border: solid 1px black;"><b><?php echo format_no($total); ?></b></td>
		</tr>
	</table>
</page>