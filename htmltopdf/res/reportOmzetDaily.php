<?php
	include "../connection.php";
	$date1		= $_POST['date1'];
	$date2		= $_POST['date2'];
	$date 		= date("d-m-Y");
	$wi			= 0;
	$wo			= 0;
	$nc			= 0;
	$netto		= 0;
	$cost		= 0;
?>
<page backtop="15mm" backbottom="10mm" backleft="10mm" backright="10mm">
	<page_header>
		<div style="font-size: 12px; font-weight: bold; text-align: center; margin-top:20px; margin-right:65px;">
			LAPORAN TRANSAKSI TIMBANG HARIAN PIOS
		</div>
    </page_header>
	<table style="margin-bottom: 5px;font-size:10pt; width:250px; margin-left:-5px;" >
		<tr>
			<td style="width: 30%;">Tanggal</td>
			<td style="width: 70%;">: <?php echo date("d-m-Y", strtotime($date1)).' sd '.date("d-m-Y", strtotime($date2)); ?></td>
		</tr>
	</table>
	<br />
	<table style="border: solid 1px black; border-collapse: collapse; margin-bottom: 5px; margin-left:-5px; font-size:8pt; width:1000px; margin-right:0px;" id="tableNonkomoditi">
		<tr>
			<th style="text-align: center;width: 3%; border: solid 1px black;">NO</th>
			<th style="text-align: center;width: 7%; border: solid 1px black;">TGL MASUK</th>
			<th style="text-align: center;width: 8%;border: solid 1px black;">NOTA TIMBANG</th>
			<th style="text-align: center;width: 8%;border: solid 1px black;">NOTA TAGIHAN</th>
			<th style="text-align: center;width: 7%;border: solid 1px black;">NOPOL</th>
			<th style="text-align: center;width: 14%;border: solid 1px black;">PEDAGANG</th>
			<th style="text-align: center;width: 7%;border: solid 1px black;">KOMODITI</th>
			<th style="text-align: center;width: 4%;border: solid 1px black;">MITRA</th>
			<th style="text-align: center;width: 7%;border: solid 1px black;">STATUS KENDARAAN</th>
			<th style="text-align: center;width: 5%;border: solid 1px black;">STATUS NOTA</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">B. MASUK</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">B. KELUAR</th>
			<th style="text-align: center;width: 5%;border: solid 1px black;">NK</th>
			<th style="text-align: center;width: 5%;border: solid 1px black;">RAFAKSI</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">TONASE</th>
		</tr>
		<?php
			$query 	= mysql_query("select * from weighing w, merchant m 
					where w.merchant_id = m.merchant_id and m.merchant_status = 'Aktif' 
					and (w.date_in between '".$date1."' and '".$date2."')");
			$no 	= 1;
			while($r= mysql_fetch_array($query)){
				$name		= executeScalar("select merchant_name from merchant where merchant_id = '".$r['merchant_id']."'");
				$checker	= executeScalar("select checker_code from checker where checker_id = '".$r['checker_id']."'");
				$goods		= executeScalar("select goods_name from goods where goods_id = '".$r['goods_id']."'");
				//$wid 		= sprintf("%07d", $r['weighing_id']);
				//$rid 		= sprintf("%07d", $r['reffer']);
				$year1 		= executeScalar("select date_format(date_in, '%y') from weighing where weighing_id = '".$r['weighing_id']."'");
		?>
		<tr>
			<td style="text-align: center;border: solid 1px black;"><?php echo $no; ?></td>
			<td style="text-align: center;border: solid 1px black;"><?php echo date("d-m-Y", strtotime($r['date_in'])); ?></td>
			<td style="text-align: center;border: solid 1px black;"><?php 
			if($r['reffer']=='null'||$r['reffer']==''){
				echo 'TB'.$r['weighing_id'];
			}else{
				echo 'TB'.$r['reffer'];
			} ?></td>
			<td style="text-align: center;border: solid 1px black;"><?php echo 'TG'.$r['weighing_id']; ?></td>
			<td style="text-align: center;border: solid 1px black;"><?php echo $r['nopol']; ?></td>
			<td style="text-align: left;border: solid 1px black;"><?php echo $name; ?></td>
			<td style="text-align: left;border: solid 1px black;"><?php echo $goods; ?></td>
			<td style="text-align: center;border: solid 1px black;"><?php echo $r['laborer_sts']; ?></td>
			<td style="text-align: left;border: solid 1px black;"><?php echo $r['weighing_sts']; ?></td>
			<td style="text-align: left;border: solid 1px black;"><?php echo $r['weighing_sts2']; ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['weight_in']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['weight_out']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['noncommodity']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['rafaksi']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['netto']); ?></td>
		</tr>
		<?php 
			$no++;
			if($r['weighing_sts']!='Batal'||$r['weighing_sts']!='Dipecah'||$r['weighing_sts']!='Digabung')
			$netto 	= $netto+$r['netto'];
			//$cost 	= $cost+$r['cost'];
			} 
		?>
		<tr>
			<td style="text-align: right;border: solid 1px black;" colspan="14"><b>TOTAL </b></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($netto); ?></td>
		</tr>
	</table>
    <page_footer>
        <table style="width: 98%; border: 0px black; margin-top:10px; margin-left:5px; margin-right:5px; font-size:8pt;">
            <tr>
                <td style="text-align: left;width: 50%">Tgl Cetak: <?php echo $date; ?></td>
				<td style="text-align: center;width: 25%"></td>
                <td style="text-align: right;width: 25%">Halaman [[page_cu]]/[[page_nb]]</td>
            </tr>
        </table>
    </page_footer>
</page>