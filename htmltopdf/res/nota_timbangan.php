<?php
	include "../connection.php";
?>
<page backtop="0mm" backbottom="5mm" backleft="5mm" backright="5mm">
    <?php
		$date 		= date("d/m/y");
		$id			= $_GET['id'];
		$idq 		= sprintf("%07d", $id);
		$sql 		= mysql_query("select * from weighing where weighing_id = '".$id."'");
		
		while($r= mysql_fetch_array($sql)){
			$prnt = mysql_query("UPDATE `weighing` SET p1	= '1' where weighing_id 	= '".$id."'");
				$name		= executeScalar("select merchant_name from merchant where merchant_id = '".$r['merchant_id']."'");
				$nick		= executeScalar("select merchant_nick from merchant where merchant_id = '".$r['merchant_id']."'");
				$checker	= executeScalar("select checker_code from checker where checker_id = '".$r['checker_id']."'");
				$lapak 		= executeScalar("select l.lapak_name from rent r, lapak l 
				where r.lapak_id = l.lapak_id and r.merchant_id = '".$r['merchant_id']."' 
				and (r.rent_sts2 != 'Pindah' && r.rent_sts2 != 'Batal') limit 1");
				$goods		= executeScalar("select goods_name from goods where goods_id = '".$r['goods_id']."'");
				$time1		= executeScalar("select TIME_FORMAT(`time_in`, '%H:%i') from weighing where weighing_id = '".$r['weighing_id']."'");
				//$time1	= $r['date_in'].' '.$r['time_in'];
				//$time		= time_format($r['time_in'], '%H:%i');
	?>
	<page_header>
    </page_header>
	<table style="width:95%; border:0px; margin-top:0px; margin-left:5px; margin-right:5px; font-size:10pt;">
		<tr>
			<td style="text-align: left; width: 50%">No Nota: TB<?php echo $idq; ?></td>
			<td style="text-align: center; width: 5%"></td>
			<td style="text-align: right; width: 45%"><?php echo $time1.' '.date("d-m-Y", strtotime($r['date_in'])); ?></td>
		</tr>
	</table>
	<br />
    <div style="font-size: 14px; font-weight: bold; text-align: center; margin-top:-5px; margin-bottom:5px;">
		NOTA TIMBANG
	</div>
	<table style="margin-bottom: 5px;font-size:10pt;" id="tableCheckout">
		<tr><td>Nama / Alias	</td><td> : <?php echo $name.' / '.$nick; ?> </td></tr>
		<tr><td>Lapak			</td><td> : <?php echo $lapak; ?> </td></tr>
		<tr><td>Nopol      		</td><td> : <?php echo $r['nopol']; ?></td></tr>
		<tr><td>Berat Masuk		</td><td> : <?php echo format_no($r['weight_in']); ?> Kg</td></tr>
		<tr><td>Barang 	 		</td><td> : <?php echo $goods; ?></td></tr>
	</table>
    <br/>
	<table style="border: solid 1px black; border-collapse: collapse; margin-bottom: 5px;font-size:10pt;width:300px;margin-right:0px;" id="tableNonkomoditi">
		<tr>
			<th style="text-align: left;width: 7%; border: solid 1px black; text-align:center;">No</th>
			<th style="text-align: left;width: 40%;border: solid 1px black;">NonKomoditi</th>
			<th style="text-align: left;width: 33%;border: solid 1px black;">Jenis / Berat</th>
			<th style="text-align: center;width: 20%;border: solid 1px black;">Jumlah</th>
		</tr>
		<tr>
			<td style="border: solid 1px black; text-align:center;">1.</td>
			<td style="border: solid 1px black;">Peti</td>
			<td style="border: solid 1px black;"> </td>
			<td style="border: solid 1px black;"> </td>
		</tr>
		<tr>
			<td style="border: solid 1px black; text-align:center;">2.</td>
			<td style="border: solid 1px black;">Krat / Keranjang</td>
			<td style="border: solid 1px black;"> </td>
			<td style="border: solid 1px black;"> </td>
		</tr>
		<tr>
			<td style="border: solid 1px black; text-align:center;">3.</td>
			<td style="border: solid 1px black;">Kardus</td>
			<td style="border: solid 1px black;"> </td>
			<td style="border: solid 1px black;"> </td>
		</tr>
		<tr>
			<td style="border: solid 1px black; text-align:center;">4.</td>
			<td style="border: solid 1px black;">Damen</td>
			<td style="border: solid 1px black;"> </td>
			<td style="border: solid 1px black;"> </td>
		</tr>
		<tr>
			<td style="border: solid 1px black; text-align:center;">5.</td>
			<td style="border: solid 1px black;">Orang</td>
			<td style="border: solid 1px black;"> </td>
			<td style="border: solid 1px black;"> </td>
		</tr>
	</table>
	<br />
	<table style="border: solid 1px black; border-collapse: collapse; margin-bottom: 5px;font-size:10pt;width:300px;margin-right:0px;" id="tablePedagang">
		<tr style="border: 1px black;">
			<th style="text-align: left;width: 7%; border: solid 1px black; text-align:center;">No</th>
			<th style="text-align: left;width: 48%;border: solid 1px black;">Pedagang Lain</th>
			<th style="text-align: center;width: 25%;border: solid 1px black;">Netto</th>
			<th style="text-align: center;width: 20%;border: solid 1px black;">TTD</th>
		</tr>
		<?php
			$i=0;
			while ($i<5) {
			$i++;
		?>
		<tr>
			<td style="border: solid 1px black;"><?php echo $i; ?>.</td>
			<td style="border: solid 1px black;"></td>
			<td style="border: solid 1px black;"></td>
			<td style="border: solid 1px black;"></td>
		</tr>
		<?php } ?>
	</table>
	<?php } ?>
	<br/><br/><br/>
	<table style="width: 95%; border: 0px black; margin-top:10px; margin-left:5px; margin-right:5px; font-size:9pt;">
		<tr>
			<td style="text-align: left;width: 35%">www.paskomnas.com</td>
			<td style="text-align: center;width: 40%">(Pedagang)</td>
			<td style="text-align: right;width: 25%"><?php echo $checker.' '.$date; ?> </td>
		</tr>
	</table>
    <page_footer>
    </page_footer>
</page>