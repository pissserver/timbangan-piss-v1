<?php
	include "../connection.php";
	$date1		= $_POST['date1'];
	$commodity	= $_POST['commodity'];
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
			LAPORAN OMZET TONASE HARIAN PISS
		</div>
    </page_header>
	<table style="margin-bottom: 5px;font-size:10pt; width:250px; margin-left:-25px;" >
		<tr>
			<td style="width: 40%;">Tanggal Omzet</td>
			<td style="width: 60%;">: <?php echo date("d-m-Y", strtotime($date1)); ?></td>
		</tr>
	</table>
	<br />
	<table style="border: solid 1px black; border-collapse: collapse; margin-bottom: 5px; margin-left:-25px; font-size:8pt; width:1000px; margin-right:0px;" id="tableOmzetHarian">
		<tr>
			<th style="text-align: center;width: 3%; border: solid 1px black;">NO</th>
			<th style="text-align: center;width: 6%; border: solid 1px black;">TGL TAGIHAN</th>
			<th style="text-align: center;width: 8%;border: solid 1px black;">NOTA TAGIHAN</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">NOPOL</th>
			<th style="text-align: center;width: 10%;border: solid 1px black;">PEDAGANG</th>
			<th style="text-align: center;width: 7%;border: solid 1px black;">JENIS</th>
			<th style="text-align: center;width: 5%;border: solid 1px black;">KOMODITI</th>
			<th style="text-align: center;width: 4%;border: solid 1px black;">STS</th>
			<th style="text-align: center;width: 5%;border: solid 1px black;">TONASE</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">TOTAL</th>
		</tr>
		<?php
			if($commodity=='Semua'){
				$query 	= mysql_query("	select 	w.weighing_id, 
												w.nopol, 
												w.goods_id, 
												w.checker_id, 
												w.merchant_id, 
												w.reffer, 
												w.date_check,
												w.weighing_sts, 
												w.netto, 
												w.cost_tonase,
												w.cost
										from 	weighing w, 
												merchant m 
										where 	w.merchant_id = m.merchant_id and 
												W.weighing_sts != 'Batal' and 
												(w.date_check between '".$date1." 00:00:00' and '".$date1." 23:59:59')");
				
			}else{
				$query 	= mysql_query("	select 	w.weighing_id, 
												w.nopol, 
												w.goods_id, 
												w.checker_id, 
												w.merchant_id, 
												w.reffer, 
												w.date_check,
												w.weighing_sts, 
												w.netto,
												w.cost_tonase, 
												w.cost
										from 	weighing w, 
												merchant m 
										where 	w.merchant_id = m.merchant_id and 
												W.weighing_sts != 'Batal' and 
												m.merchant_type = '".$commodity."' and 
												(w.date_check between '".$date1." 00:00:00' and '".$date1." 23:59:59')");
			}
			
			$no 	= 1;
			while($r= mysql_fetch_array($query)){
				$name			= executeScalar("select merchant_name from merchant where merchant_id = '".$r['merchant_id']."'");
				$kat_merchant	= executeScalar("select kat_merchant from merchant where merchant_id = '".$r['merchant_id']."'");
				$goods			= executeScalar("select goods_name from goods where goods_id = '".$r['goods_id']."'");
				//$wid 			= sprintf("%07d", $r['weighing_id']);
				//$year1 		= executeScalar("select date_format(date_in, '%y') from weighing where weighing_id = '".$r['weighing_id']."'");
		?>
		<tr>
			<td style="text-align: center;border: solid 1px black;"> <?php echo $no; ?></td>
			<td style="text-align: center;border: solid 1px black;"> <?php echo date("d-m-Y", strtotime($r['date_check'])); ?></td>
			<td style="text-align: center;border: solid 1px black;"> <?php echo 'TG'.$r['weighing_id']; ?></td>
			<td style="text-align: center;border: solid 1px black;"> <?php echo $r['nopol']; ?></td>
			<td style="text-align: left;border: solid 1px black;"> <?php echo $name; ?></td>
			<td style="text-align: left;border: solid 1px black;"> <?php echo $kat_merchant; ?></td>
			<td style="text-align: left;border: solid 1px black;"> <?php echo $goods; ?></td>
			<td style="text-align: center;border: solid 1px black;"> <?php echo $r['weighing_sts']; ?></td>
			<td style="text-align: right;border: solid 1px black;"> <?php echo format_no($r['netto']); ?></td>
			<td style="text-align: right;border: solid 1px black;"> <?php echo format_no($r['cost_tonase']); ?></td>
		</tr>
		<?php 
			$no++;
			if($r['weighing_sts']!='Batal'||$r['weighing_sts']!='Dipecah'||$r['weighing_sts']!='Digabung')
			$netto 	= $netto+$r['netto'];
			$cost 	= $cost+$r['cost_tonase'];
			} 
		?>
		<tr>
			<td style="text-align: center;border: solid 1px black;" colspan="8"><b>TOTAL </b></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($netto); ?></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($cost); ?></td>
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