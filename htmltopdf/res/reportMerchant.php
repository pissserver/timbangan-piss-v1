<?php
	include "../connection.php";
	$month1		= $_POST['month1'];
	$month2		= $_POST['month2'];
	$year1		= $_POST['year1'];
	$year2		= $_POST['year2'];
	$type		= $_POST['type'];
	$month3 	= 0; 
	$month3 	= intval($month2-$month1+1);
	$year3		= intval($year2-$year1);
	$year		= 0;
	$monthPlus	= 0;
	
	if($year3>=1){
		$year	= intval(12*$year3);
		$month3 = $month3+$year;
	}
	
	/*
	if($month3==0){
		$monthPlus	= 1;
	}elseif($monthPlus>=1){
		$monthPlus	= intval($month3+1);
	}elseif($monthPlus<0){
		$monthPlus	= intval($month3+1);
	}$type		= $_POST['type'];
	$date1		= $_POST['date1'];
	$date2		= $_POST['date2'];*/
	//$interval 	= date_diff($date2, $date1);
?>
<page backtop="15mm" backbottom="10mm" backleft="10mm" backright="10mm">
	<page_header>
		<div style="font-size: 12px; font-weight: bold; text-align: center; margin-top:20px;">
			REKAP TONASE PEDAGANG BULANAN PIOS
		</div>
    </page_header>
	<table style="margin-bottom: 5px;font-size:10pt; width:500px;" >
		<tr>
			<td style="width: 30%;">Tanggal</td>
			<td style="width: 70%;">: <?php 
			if($month1==$month2&&$year1==$year2){
				$monthName = date('F', mktime(0, 0, 0, $month1, 10));
				echo $monthName.' '.$year1;
			}else{
				$monthName1 = date('F', mktime(0, 0, 0, $month1, 10));
				$monthName2 = date('F', mktime(0, 0, 0, $month2, 10));
				echo $monthName1.' '.$year1.' sd '.$monthName2.' '.$year2;
			}
			/*echo date("d-m-Y", strtotime($date1)).' sd '.date("d-m-Y", strtotime($date2));*/ 
			//echo $interval->format('%m months');
			?></td>
		</tr>
		<tr>
			<td>Jenis Pedagang</td>
			<td>: <?php echo $type; ?></td>
		</tr>
		<tr>
			<td>Jumlah Bulan</td>
			<td>: <?php echo $month3; ?> Bulan</td>
		</tr>
	</table>
	<br />
	<table style="border: solid 1px black; border-collapse: collapse; margin-bottom: 5px;font-size:8pt; width:700px; margin-right:0px;" id="tableNonkomoditi">
		<tr>
			<th style="text-align: center;width: 5%; border: solid 1px black;">NO</th>
			<th style="text-align: left;width: 15%; border: solid 1px black;">Nama Pedagang</th>
			<th style="text-align: left;width: 10%; border: solid 1px black;">Lapak</th>
			<?php
				$no			= 1;
				$monthTH 	= $month1;
				$yearTH		= $year1;
				$monthName	= date('M', mktime(0, 0, 0, $monthTH, 10));
				echo '<th style="text-align: center;width:9%;border: solid 1px black;">'.$monthName.' '.$yearTH.'</th>';
				while($no<$month3){
					$monthTH = $monthTH+1;
					if($monthTH>12){
						$monthTH = $monthTH-12;
						$yearTH  = $yearTH+1;
					}
					$monthName = date('M', mktime(0, 0, 0, $monthTH, 10));
					echo '<th style="text-align: center;width:9%;border: solid 1px black;">'.$monthName.' '.$yearTH.'</th>';
					$no++;
				}
			?>
			<th style="text-align: center;width: 10%; border: solid 1px black;">Total</th>
		</tr>
		<?php
			//Query tonase berdasarkan Jenis Merchant
			if($type=='Semua'){
				$sql 	= mysql_query("select merchant_id, merchant_name from merchant order by merchant_name");
			}else{
				$sql 	= mysql_query("select merchant_id, merchant_name from merchant where merchant_type = '".$type."' order by merchant_name");
			}
			$no 		= 1;
			$total1		= 0;
			$total2		= 0;
			$total3		= 0;
			$total4		= 0;
			$total		= 0;
			$totalx		= 0;
			$tonasex	= 0;
			while($r	= mysql_fetch_array($sql)){
				$count	= 1;
				$lapak	= executeScalar("select l.lapak_name from rent r, lapak l
				where r.lapak_id = l.lapak_id and r.merchant_id = '".$r['merchant_id']."'
				and (r.rent_sts2 != 'Pindah' && r.rent_sts2 != 'Batal') order by l.lapak_name limit 1");
				if($lapak==null){
					$lapak = 'Tidak Aktif';
				}
		?>
		<tr>
			<td style="text-align: center;border: solid 1px black;"><?php echo $no; ?></td>
			<td style="text-align: left;border: solid 1px black;"><?php echo $r['merchant_name']; ?></td>
			<td style="text-align: left;border: solid 1px black;"><?php echo $lapak; ?></td>
			<?php
				$month7	= $month1;
				$year7  = $year1;
				$tonase	= executeScalar("select sum(netto) from weighing 
				where merchant_id = '".$r['merchant_id']."' and 
				weighing_sts != 'Batal' and 
				month(date_check) = '".$month7."' and 
				year(date_check) = '".$year1."'");
				$total	= $tonase;
				echo '<td style="text-align: right;border: solid 1px black;">'.format_no($tonase).'</td>';
				while($count<$month3){
					$month7 = $month7+1;
					if($month7>12){
						$month7 = $month7-12;
						$year7  = $year7+1;
					}
					$tonase	= executeScalar("select sum(netto) from weighing 
					where merchant_id = '".$r['merchant_id']."' and 
					weighing_sts != 'Batal' and 
					month(date_check) = '".$month7."' and 
					year(date_check) = '".$year7."'");
					$total	= $total+$tonase;
					echo '<td style="text-align: right;border: solid 1px black;">'.format_no($tonase).'</td>';
					$count++;
				}
				echo '<td style="text-align: right;border: solid 1px black;">'.format_no($total).'</td>';
				$totalx		= $totalx+$total;
				//$tonasex	= $tonasex+$tonase;
			?>
		</tr>
		<?php 
			$no++;
			}
		?>
		<tr>
			<td style="text-align: center;border: solid 1px black;" colspan="3"><b>Total</b></td>
			<?php
				$countx	= 1;
				$month8	= $month1;
				$year8  = $year1;
				//Query tonase berdasarkan Jenis Merchant
				if($type=='Semua'){
					$tonase	= executeScalar("select sum(netto) 
					from weighing
					where weighing_sts != 'Batal' and 
					month(date_check) = '".$month8."' and 
					year(date_check) = '".$year1."'");
				}else{
					$tonase	= executeScalar("select sum(w.netto) 
					from merchant m, weighing w
					where m.merchant_id = w.merchant_id and
					m.merchant_type = '".$type."' and
					w.weighing_sts != 'Batal' and 
					month(w.date_check) = '".$month8."' and 
					year(w.date_check) = '".$year1."'");
				}
				echo '<td style="text-align: right;border: solid 1px black;"><b>'.format_no($tonase).'</b></td>';
				while($countx<$month3){
					$month8 = $month8+1;
					if($month8>12){
						$month8 = $month8-12;
						$year8  = $year8+1;
					}
					//Query tonase berdasarkan Jenis Merchant
					if($type=='Semua'){
						$tonase2 = executeScalar("select sum(netto) 
						from weighing
						where weighing_sts != 'Batal' and 
						month(date_check) = '".$month8."' and 
						year(date_check) = '".$year1."'");
					}else{
						$tonase2 = executeScalar("select sum(w.netto) 
						from merchant m, weighing w
						where m.merchant_id = w.merchant_id and
						m.merchant_type = '".$type."' and
						w.weighing_sts != 'Batal' and 
						month(w.date_check) = '".$month8."' and 
						year(w.date_check) = '".$year1."'");
					}
					echo '<td style="text-align: right;border: solid 1px black;"><b>'.format_no($tonase2).'</b></td>';
					$countx++;
				}
				echo '<td style="text-align: right;border: solid 1px black;"><b>'.format_no($totalx).'</b></td>';
			?>
		</tr>
	</table>
    <page_footer>
        <table style="width: 95%; border: 0px black; margin-top:10px; margin-left:5px; margin-right:5px; font-size:8pt;">
            <tr>
                <td style="text-align: left;width: 50%">Tgl Cetak: <?php echo $date_now; ?></td>
				<td style="text-align: center;width: 25%"></td>
                <td style="text-align: right;width: 25%">Halaman [[page_cu]]/[[page_nb]]</td>
            </tr>
        </table>
    </page_footer>
</page>