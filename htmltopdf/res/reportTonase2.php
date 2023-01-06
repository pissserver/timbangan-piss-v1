<?php
	include "../connection.php";
	$date1		= $_POST['date1'];
	$date2		= $_POST['date2'];
	$commodity	= $_POST['goods'];
	$goods		= executeScalar("select goods_name from goods where goods_id = '".$commodity."'");
	$date 		= date("d-m-Y");
?>
<page backtop="15mm" backbottom="10mm" backleft="5mm" backright="5mm">
	<page_header>
        <table style="width:95%; border:0px; margin-top:10px; margin-left:5px; margin-right:5px; font-size:8pt;">
            <tr>
                <td style="text-align: left; width: 50%"></td>
                <td style="text-align: center; width: 25%"></td>
                <td style="text-align: right; width: 25%"></td>
            </tr>
        </table>
		<div style="font-size: 12px; font-weight: bold; text-align: center; margin-top:20px;">
			RINCIAN TONASE PER KOMODITI
		</div>
    </page_header>
	<table style="margin-bottom: 5px;font-size:10pt; width:300px;" >
		<tr>
			<td style="width: 35%;">Komoditi</td>
			<td style="width: 65%;">: <?php echo $goods; ?></td>
		</tr>
		<tr>
			<td style="width: 35%;">Tanggal</td>
			<td style="width: 65%;">: <?php 
			if($date1==$date2){
				echo date("d-m-Y", strtotime($date1));
			}else{
				echo date("d-m-Y", strtotime($date1)).' sd '.date("d-m-Y", strtotime($date2));
			} ?></td>
		</tr>
	</table>
	<br />
	<table style="border: solid 1px black; border-collapse: collapse; margin-bottom: 5px;font-size:8pt; width:820px; margin-right:0px;" id="tableNonkomoditi">
		<tr>
			<th style="text-align: center;width: 3%; border: solid 1px black;">NO</th>
			<th style="text-align: center;width: 7%; border: solid 1px black;">TGL KELUAR</th>
			<th style="text-align: center;width: 10%;border: solid 1px black;">NOTA TIMBANG</th>
			<th style="text-align: center;width: 10%;border: solid 1px black;">NOTA TAGIHAN</th>
			<th style="text-align: center;width: 15%;border: solid 1px black;">PEDAGANG</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">LAPAK</th>
			<th style="text-align: center;width: 7%;border: solid 1px black;">BERAT MASUK</th>
			<th style="text-align: center;width: 7%;border: solid 1px black;">BERAT KELUAR</th>
			<th style="text-align: center;width: 7%;border: solid 1px black;">NON KOMODITI</th>
			<th style="text-align: center;width: 7%;border: solid 1px black;">RAFAKSI</th>
			<th style="text-align: center;width: 8%;border: solid 1px black;">TONASE</th>
		</tr>
		<?php
			//select tonase berdasarkan komoditi
			$query 	= mysql_query("select distinct(w.weighing_id), w.weight_in, w.weight_out, w.noncommodity, w.rafaksi,
			w.netto, w.date_in, w.date_out, w.reffer, w.merchant_id, w.goods_id
			from weighing w
			where w.weighing_sts != 'Batal' and
			w.goods_id = '".$commodity."' and
			(w.date_check between '".$date1." 00:00:00' and '".$date2." 23:59:59')");
			$no			= 0;
			$netto		= 0;
			while($r= mysql_fetch_array($query)){
				$name	= executeScalar("select merchant_name from merchant where merchant_id = '".$r['merchant_id']."'");
				$lapak 	= executeScalar("select l.lapak_name from rent r, lapak l 
						where r.lapak_id = l.lapak_id and r.merchant_id = '".$r['merchant_id']."' 
						and (r.rent_sts2 != 'Pindah' && r.rent_sts2 != 'Batal') limit 1");
				$goods	= executeScalar("select goods_name from goods where goods_id = '".$r['goods_id']."'");
				//$wid 	= sprintf("%07d", $r['weighing_id']);
				//$rid 	= sprintf("%07d", $r['reffer']);
				//$year1 	= date("y", strtotime($r['date_in']));
				//$year2 	= date("y", strtotime($r['date_out']));
		?>
		<tr>
			<td style="text-align: center;border: solid 1px black;"><?php echo $no; ?></td>
			<td style="text-align: center;border: solid 1px black;"><?php echo date("d-m-Y", strtotime($r['date_out'])); ?></td>
			<td style="text-align: center;border: solid 1px black;"><?php 
			if($r['reffer']=='null'||$r['reffer']==''){
				echo 'TB'.$r['weighing_id'];
			}else{
				echo 'TB'.$r['reffer'];
			} ?></td>
			<td style="text-align: center;border: solid 1px black;"><?php echo 'TG'.$r['weighing_id']; ?></td>
			<td style="text-align: left;border: solid 1px black;"><?php echo $name; ?></td>
			<td style="text-align: left;border: solid 1px black;"><?php echo $lapak; ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['weight_in']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['weight_out']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['noncommodity']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['rafaksi']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['netto']); ?></td>
		</tr>
		<?php 
				$no++;
				$netto 	= $netto+$r['netto'];
			}
		?>
		<tr>
			<td style="text-align: right;border: solid 1px black;" colspan="10"><b>TOTAL </b></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($netto); ?></td>
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