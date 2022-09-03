<?php
	include "../connection.php";
	$date1	= '2016-10-01';
	$date2	= $_POST['date2'];
	$block	= $_POST['block'];
	$total3 = 0;
	$date 	= date("d-m-Y");
?>
<page backtop="15mm" backbottom="10mm" backleft="10mm" backright="10mm">
	<page_header>
		<div style="font-size: 12px; font-weight: bold; text-align: center; margin-top:20px; margin-right:65px;">
			LAPORAN TAGIHAN TONASE BLOK <?php echo $block; ?>
		</div>
    </page_header>
	<table style="margin-bottom: 5px;font-size:10pt; width:450px;" >
		<tr>
			<td style="width: 35%;">Tanggal Akhir Tagihan</td>
			<td style="width: 65%;">: <?php echo date("d-m-Y", strtotime($date2)); ?></td>
		</tr>
	</table>
	<br />
	<table style="border: solid 1px black; border-collapse: collapse; margin-bottom: 5px;font-size:8pt; width:680px; margin-right:0px;" id="tableNonkomoditi">
		<tr>
			<th style="text-align: center;width: 5%; border: solid 1px black;">NO</th>
			<th style="text-align: left;width: 25%;border: solid 1px black;">PEDAGANG</th>
			<th style="text-align: left;width: 25%;border: solid 1px black;">LAPAK</th>
			<th style="text-align: center;width: 10%;border: solid 1px black;">TOTAL NOTA</th>
			<th style="text-align: center;width: 10%;border: solid 1px black;">UMUR TAGIHAN</th>
			<th style="text-align: center;width: 20%;border: solid 1px black;">TOTAL (Rp)</th>
		</tr>
		<?php
			$query = mysql_query("select m.merchant_id as id, m.merchant_name as name
			from merchant m, rent r, lapak l
			where m.merchant_id = r.merchant_id and
			r.lapak_id = l.lapak_id and
			(r.rent_sts2 != 'Pindah' && r.rent_sts2 != 'Batal') and 
			l.block_id = '".$block."'
			group by id order by name");
			//r.rent_sts2 != 'Pindah'
			$no 	= 1;
			$netto2	= 0;
			while($r= mysql_fetch_array($query)){
				$sql2 	= mysql_query("select l.lapak_name from rent r, lapak l
						where r.lapak_id = l.lapak_id and 
						r.merchant_id = '".$r['id']."' and
						l.block_id = '".$block."' and
						(r.rent_sts2 != 'Pindah' && r.rent_sts2 != 'Batal')
						order by l.lapak_name desc");
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
				/*$jml	= executeScalar("select count(l.lapak_id) as jml from rent r, lapak l
						where r.lapak_id = l.lapak_id and 
						r.merchant_id = '".$r['id']."' and
						l.block_id = '".$block."' and
						(r.rent_sts2 != 'Pindah' && r.rent_sts2 != 'Batal')
						order by l.lapak_name desc");*/
						
				$jml	= executeScalar("select count(weighing_id) from weighing
					where merchant_id = '".$r['id']."' and
					(date_check between '".$date1." 00:00:00' and '".$date2." 23:59:59') and
					(date_pay > '".$date2."' || date_pay is NULL) and
					weighing_sts != 'Batal' and
					(weighing_sts2 != 'Dipecah' || weighing_sts2 != 'Digabung')");
					
				$total	= executeScalar("select sum(cost) from weighing
					where merchant_id = '".$r['id']."' and
					(date_check between '".$date1." 00:00:00' and '".$date2." 23:59:59') and
					(date_pay > '".$date2."' || date_pay is NULL) and
					weighing_sts != 'Batal' and
					(weighing_sts2 != 'Dipecah' || weighing_sts2 != 'Digabung')");
					
				if($jml>0){
					$last_date	= executeScalar("select date_check from weighing
					where merchant_id = '".$r['id']."' and
					(date_check between '".$date1." 00:00:00' and '".$date2." 23:59:59') and
					(date_pay > '".$date2."' || date_pay is NULL) and
					weighing_sts != 'Batal' and
					(weighing_sts2 != 'Dipecah' || weighing_sts2 != 'Digabung') order by weighing_id limit 1");
					//Hitung Umur Tagihan
					$date3 	= new DateTime(date("Y-m-d", strtotime($last_date)));
					$date4 	= new DateTime(date("Y-m-d", strtotime($date2)));
					$diff 	= $date4->diff($date3)->format("%a");
				}
				
		?>
		<tr>
			<td style="text-align: center;border: solid 1px black;"><?php echo $no; ?></td>
			<td style="text-align: left;border: solid 1px black;"><?php echo $r['name']; ?></td>
			<td style="text-align: left;border: solid 1px black;"><?php echo $lapak; ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($jml); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php if($jml>0){ echo $diff.' Hari'; } ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($total); ?></td>
		</tr>
		<?php 
				$no++;
				$netto2 = $netto2+$total;
			}
		?>
		<tr>
			<td style="text-align: right;border: solid 1px black;" colspan="5"><b>TOTAL </b></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($netto2); ?></td>
		</tr>
	</table>
	<br />
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