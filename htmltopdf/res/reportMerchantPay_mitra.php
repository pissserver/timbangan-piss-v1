<?php
	include "../connection.php";
	$date1	= $_POST['date1'];
	$date2	= $_POST['date2'];
	$mid	= $_POST['merchant'];
	$date 	= date("d-m-Y");
	$name	= executeScalar("select merchant_name from merchant where merchant_id = '".$mid."'");
	$sql2 	= mysql_query("select l.lapak_name from rent r, lapak l
				where r.lapak_id = l.lapak_id and 
				r.merchant_id = '".$mid."' and
				(r.rent_sts2 != 'Pindah' && r.rent_sts2 != 'Batal')
				order by l.lapak_name");
	$string	= "";
	$counter= 0;
	while($row=mysql_fetch_array($sql2)){
		if($counter!=0){
			$string = ", ".$string;
		}
		$string = $row['lapak_name'].$string;
		$counter++;
	}
	$lapak 	= "".$string;
?>
<page backtop="15mm" backbottom="10mm" backleft="5mm" backright="5mm">
	<page_header>
		<div style="font-size: 12px; font-weight: bold; text-align: center; margin-top:20px;">
			Pembayaran Mitra Per Pedagang
		</div>
    </page_header>
	<table style="margin-bottom: 5px;font-size:10pt; width:450px;" >
		<tr>
			<td style="width: 25%;">Nama Pedagang</td>
			<td style="width: 75%;">: <?php echo $name.' ('.$mid.')'; ?></td>
		</tr>
		<tr>
			<td style="width: 25%;">Lapak</td>
			<td style="width: 75%;">: <?php echo $lapak; ?></td>
		</tr>
		<tr>
			<td style="width: 25%;">Tanggal</td>
			<td style="width: 75%;">: <?php 
			if($date1==$date2){
				echo date("d-m-Y", strtotime($date1));
			}
			else{
				echo date("d-m-Y", strtotime($date1)).' sd '.date("d-m-Y", strtotime($date2));
			} ?></td>
		</tr>
	</table>
	<br />
	<table style="border: solid 1px black; border-collapse: collapse; margin-bottom: 5px;font-size:8pt; width:850px; margin-right:0px;" id="tableNonkomoditi">
		<tr>
			<th style="text-align: center;height: 2%;width: 5%; border: solid 1px black;">NO</th>
			<th style="text-align: center;width: 10%; border: solid 1px black;">TGL BAYAR</th>
			<th style="text-align: center;width: 12%;border: solid 1px black;">NOTA TIMBANG</th>
			<th style="text-align: center;width: 12%;border: solid 1px black;">NOTA TAGIHAN</th>
			<th style="text-align: center;width: 8%;border: solid 1px black;">NOPOL</th>
			<th style="text-align: center;width: 10%;border: solid 1px black;">KOMODITI</th>
			<th style="text-align: center;width: 8%;border: solid 1px black;">TONASE</th>
			<th style="text-align: center;width: 15%;border: solid 1px black;">TOTAL BAYAR (Rp)</th>
		</tr>
		<?php
			$query 	= mysql_query("select 	weighing_id, 
											goods_id, 
											reffer, 
											date_out, 
											nopol, 
											weighing_sts2, 
											weight_in, 
											weight_out, 
											noncommodity,
											netto,
											cost_bayar, 
											cost 
									from 	weighing_mitra 
									where 	weighing_sts = 'Lunas' and 
											merchant_id = '".$mid."' and 
											(date_pay between '".$date1."' and '".$date2."')");
			$no 	= 1;
			$netto 	= 0;
			$cost 	= 0;
			while($r= mysql_fetch_array($query)){
				$goods	= executeScalar("select goods_name from goods where goods_id = '".$r['goods_id']."'");
				//$wid 	= sprintf("%07d", $r['weighing_id']);
				//$rid 	= sprintf("%07d", $r['reffer']);
				//$year1 	= executeScalar("select date_format(date_in, '%y') from weighing where weighing_id = '".$r['weighing_id']."'");
				//$year2 	= executeScalar("select date_format(date_out, '%y') from weighing where weighing_id = '".$r['weighing_id']."'");
		?>
		<tr>
			<td style="text-align: center;border: solid 1px black;"><?php echo $no; ?></td>
			<td style="text-align: center;border: solid 1px black;"><?php echo date("d-m-Y", strtotime($r['date_out'])); ?></td>
			<td style="text-align: center;border: solid 1px black;"><?php 
			if($r['reffer']=='null'||$r['reffer']==''||$r['reffer']=='0'){
				echo 'TB'.$r['weighing_id'];
			}else{
				echo 'TB'.$r['reffer'];
			} ?></td>
			<td style="text-align: center;border: solid 1px black;"><?php echo 'TG'.$r['weighing_id']; ?></td>
			<td style="text-align: center;border: solid 1px black;"><?php echo $r['nopol']; ?></td>
			<td style="text-align: left;border: solid 1px black;"><?php echo $goods; ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['netto']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['cost_bayar']); ?></td>
		</tr>
		<?php 
				$no++;
				$netto 	= $netto+$r['netto'];
				$cost 	= $cost+$r['cost_bayar'];
			} 
		?>
		<tr>
			<td style="text-align: right;border: solid 1px black;" colspan="6"><b>TOTAL </b></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($netto); ?></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($cost); ?></td>
		</tr>
	</table>
    <page_footer>
        <table style="width: 95%; border: 0px black; margin-top:10px; margin-left:5px; margin-right:5px; font-size:8pt;">
            <tr>
                <td style="text-align: left;width: 50%">Tgl Cetak: <?php echo $date; ?></td>
				<td style="text-align: center;width: 25%"></td>
                <td style="text-align: right;width: 25%">Halaman [[page_cu]]/[[page_nb]]</td>
            </tr>
        </table>
    </page_footer>
</page>