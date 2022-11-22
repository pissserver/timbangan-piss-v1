<?php
	include "../connection.php";
	$date1	= '2016-10-01';
	$date2	= $_POST['date2'];
	$mid	= $_POST['merchant'];
	$date 	= date("d-m-Y");
	$name	= executeScalar("select merchant_name from merchant where merchant_id = '".$mid."'");
	$sql2 	= mysql_query("select l.lapak_name from rent r, lapak l
			where r.lapak_id = l.lapak_id and r.merchant_id = '".$mid."'
			and (r.rent_sts2 != 'Pindah' && r.rent_sts2 != 'Batal') order by l.lapak_name");
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
        <!--<table style="width:95%; border:0px; margin-top:10px; margin-left:5px; margin-right:5px; font-size:8pt;">
            <tr>
                <td style="text-align: left; width: 50%"></td>
                <td style="text-align: center; width: 25%"></td>
                <td style="text-align: right; width: 25%"></td>
            </tr>
        </table>-->
		<div style="font-size: 12px; font-weight: bold; text-align: center; margin-top:20px;">
			Tagihan Mitra Per Pedagang
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
			<td style="width: 75%;">: <?php echo date("d-m-Y", strtotime($date2)); ?></td>
		</tr>
	</table>
	<br />
	<table style="border: solid 1px black; border-collapse: collapse; margin-bottom: 5px;font-size:8pt; width:800px; margin-right:0px;" id="tableNonkomoditi">
		<tr>
			<th style="text-align: center; height: 2%; width: 5%; border: solid 1px black;">NO</th>
			<th style="text-align: center;width: 10%; border: solid 1px black;">TGL TAGIHAN</th>
			<th style="text-align: center;width: 12%;border: solid 1px black;">NOTA TIMBANG</th>
			<th style="text-align: center;width: 12%;border: solid 1px black;">NOTA TAGIHAN</th>
			<th style="text-align: center;width: 9%;border: solid 1px black;">UMUR TAGIHAN</th>
			<th style="text-align: center;width: 9%;border: solid 1px black;">NOPOL</th>
			<th style="text-align: center;width: 10%;border: solid 1px black;">KOMODITI</th>
			<th style="text-align: center;width: 8%;border: solid 1px black;">TONASE</th>
			<th style="text-align: center;width: 13%;border: solid 1px black;">TOTAL (Rp)</th>
		</tr>
		<?php
			$query 	= mysql_query("select 	w.weighing_id, 
											m.merchant_id, 
											w.checker_id, 
											w.date_out, 
											w.date_check, 
											w.date_pay, 
											w.nopol, 
											w.netto, 
											w.cost_bayar, 
											w.goods_id, 
											w.reffer, 
											m.merchant_name as name
									from 	weighing_mitra w, merchant m 
									where 	w.merchant_id = m.merchant_id and 
											m.merchant_id = '".$mid."' and
											(w.date_check between '".$date1." 00:00:00' and '".$date2." 23:59:59') and
											(w.date_pay > '".$date2."' || w.date_pay is NULL) and
											w.weighing_sts != 'Batal' and
											(w.weighing_sts2 != 'Dipecah' || w.weighing_sts2 != 'Digabung')");
			$no 	= 1;
			$netto 	= 0;
			$cost 	= 0;
			while($r= mysql_fetch_array($query)){
				$goods	= executeScalar("select goods_name from goods where goods_id = '".$r['goods_id']."'");
				//$wid 	= sprintf("%07d", $r['weighing_id']);
				//$rid 	= sprintf("%07d", $r['reffer']);
				//$year1 	= executeScalar("select date_format(date_in, '%y') from weighing where weighing_id = '".$r['weighing_id']."'");
				//$year2 	= executeScalar("select date_format(date_check, '%y') from weighing where weighing_id = '".$r['weighing_id']."'");
				//Hitung Umur Tagihan
				$date3 	= new DateTime(date("Y-m-d", strtotime($r['date_check'])));
				$date4 	= new DateTime(date("Y-m-d", strtotime($date2)));
				$diff 	= $date4->diff($date3)->format("%a");
		?>
		<tr>
			<td style="text-align: center;border: solid 1px black;"><?php echo $no; ?></td>
			<td style="text-align: center;border: solid 1px black;"><?php echo date("d-m-Y", strtotime($r['date_check'])); ?></td>
			<td style="text-align: center;border: solid 1px black;"><?php 
			if($r['reffer']=='null'||$r['reffer']==''||$r['reffer']=='0'){
				echo 'TB'.$r['weighing_id'];
			}else{
				echo 'TB'.$r['reffer'];
			} ?></td>
			<td style="text-align: center;border: solid 1px black;"><?php echo 'TG'.$r['weighing_id']; ?></td>
			<td style="text-align: center;border: solid 1px black;"><?php echo $diff.' Hari'; ?></td>
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
			<td style="text-align: right;border: solid 1px black;" colspan="7"><b>TOTAL </b></td>
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