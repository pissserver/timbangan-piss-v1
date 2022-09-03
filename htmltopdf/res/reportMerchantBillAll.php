<?php
	include "../connection.php";
	$date1		= '2016-10-01';
	$date2		= $_POST['date2'];
	$commodity	= $_POST['commodity'];
	$sort		= $_POST['sortir'];
	$date 		= date("d-m-Y");
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
		Rekap Tagihan Timbangan Seluruh Pedagang PIOS
	</div>
    <br/>
	<table style="margin-bottom: 5px;font-size:10pt; width:300px;" >
		<tr>
			<td style="width: 35%;">Tanggal</td>
			<td style="width: 65%;">: <?php echo date("d-m-Y", strtotime($date2)); ?></td>
		</tr>
		<tr>
			<td style="width: 35%;">Jenis Pedagang</td>
			<td style="width: 65%;">: <?php echo $commodity; ?></td>
		</tr>
	</table>
	<br />
	<table style="border: solid 1px black; border-collapse: collapse; margin-bottom: 5px;font-size:8pt; width:800px; margin-right:0px;" id="tableNonkomoditi">
		<tr>
			<th style="text-align: center;width: 5%; border: solid 1px black;">NO</th>
			<th style="text-align: left;width: 20%;border: solid 1px black;">PEDAGANG</th>
			<th style="text-align: left;width: 15%;border: solid 1px black;">LAPAK</th>
			<th style="text-align: center;width: 10%;border: solid 1px black;">UMUR TAGIHAN</th>
			<th style="text-align: center;width: 10%;border: solid 1px black;">TOTAL NOTA</th>
			<th style="text-align: center;width: 15%;border: solid 1px black;">TOTAL (Rp)</th>
		</tr>
		<?php
			$sql 	= '';
			$jml2 	= 0;
			$total 	= 0;
			if($sort==''){}
			if($commodity=='Semua'){
				$sql = "select m.merchant_id as id, m.merchant_name as name, m.merchant_type as type, SUM(cost) as total
				from merchant m, weighing w, rent r, lapak l
				where m.merchant_id = w.merchant_id and 
				r.merchant_id = m.merchant_id and
				r.lapak_id = l.lapak_id and
				m.merchant_status = 'Aktif' and
				(w.date_check between '".$date1." 00:00:00' and '".$date2." 23:59:59') and
				(w.date_pay > '".$date2."' || w.date_pay is NULL) and
				w.weighing_sts != 'Batal' and
				(w.weighing_sts2 != 'Dipecah' || w.weighing_sts2 != 'Digabung')
				group by id order by ".$sort."";
			}else{
				$sql = "select m.merchant_id as id, m.merchant_name as name, m.merchant_type as type, SUM(cost) as total
				from merchant m, weighing w, rent r, lapak l
				where m.merchant_id = w.merchant_id and 
				m.merchant_id = r.merchant_id and
				r.lapak_id = l.lapak_id and
				m.merchant_type = '".$commodity."' and 
				m.merchant_status = 'Aktif' and
				(w.date_check between '".$date1." 00:00:00' and '".$date2." 23:59:59') and
				(w.date_pay > '".$date2."' || w.date_pay is NULL) and
				w.weighing_sts != 'Batal' and
				(w.weighing_sts2 != 'Dipecah' || w.weighing_sts2 != 'Digabung')
				group by id order by ".$sort."";
			}
			$query 	= mysql_query($sql);
			$no 	= 1;
			while($r= mysql_fetch_array($query)){
				$sql2 	= mysql_query("select l.lapak_name from rent r, lapak l
						where r.lapak_id = l.lapak_id and 
						r.merchant_id = '".$r['id']."' and
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
				$total1	= executeScalar("select sum(cost) as total from weighing
				where merchant_id = '".$r['id']."' and
				(date_check between '".$date1." 00:00:00' and '".$date2." 23:59:59') and
				(date_pay > '".$date2."' || date_pay is NULL) and
				weighing_sts != 'Batal' and
				(weighing_sts2 != 'Dipecah' || weighing_sts2 != 'Digabung')");
				
				//Hitung Jumlah Nota
				$jml	= executeScalar("select count(weighing_id) from weighing
				where merchant_id = '".$r['id']."' and
				(date_check between '".$date1." 00:00:00' and '".$date2." 23:59:59') and
				(date_pay > '".$date2."' || date_pay is NULL) and
				weighing_sts != 'Batal' and
				(weighing_sts2 != 'Dipecah' || weighing_sts2 != 'Digabung')");
				
				//Hitung Umur Tagihan
				$last_date	= executeScalar("select date_check from weighing
				where merchant_id = '".$r['id']."' and
				(date_check between '".$date1." 00:00:00' and '".$date2." 23:59:59') and
				(date_pay > '".$date2."' || date_pay is NULL) and
				weighing_sts != 'Batal' and
				(weighing_sts2 != 'Dipecah' || weighing_sts2 != 'Digabung') order by weighing_id limit 1");
				
				$date3 	= new DateTime(date("Y-m-d", strtotime($last_date)));
				$date4 	= new DateTime(date("Y-m-d", strtotime($date2)));
				$diff 	= $date4->diff($date3)->format("%a");
		?>
		<tr>
			<td style="text-align: center;border: solid 1px black;"><?php echo $no; ?></td>
			<td style="text-align: left;border: solid 1px black;"><?php echo $r['name']; ?></td>
			<td style="text-align: left;border: solid 1px black;"><?php echo $lapak; ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo $diff.' Hari'; ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($jml); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($total1); ?></td>
		</tr>
		<?php 
				$no++;
				$jml2	= $jml2+$jml;
				$total 	= $total+$total1;
			}
		?>
		<tr>
			<td style="text-align: right;border: solid 1px black;" colspan="4"><b>Total </b></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($jml2); ?></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($total); ?></td>
		</tr>
	</table>
	<br />Keterangan:
</page>