<?php
	include "../connection.php";
	$date		= '2016-10-01';
	$date1		= $_POST['date1'];
	$date2		= $_POST['date2'];
	//$commodity	= $_POST['commodity'];
	//$date 		= date("d-m-Y");
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
		REKAP TAGIHAN TONASE TERBAYAR PERTANGGAL PIOS (CUT OFF)
	</div>
    <br/>
	<table style="margin-bottom: 5px;font-size:10pt; width:300px;" >
		<tr>
			<td style="width: 35%;">Tanggal Awal</td>
			<td style="width: 65%;">: <?php echo date("d-m-Y", strtotime($date1)); ?></td>
		</tr>
		<tr>
			<td style="width: 35%;">Tanggal Akhir</td>
			<td style="width: 65%;">: <?php echo date("d-m-Y", strtotime($date2)); ?></td>
		</tr>
	</table>
	<br />
	<table style="border: solid 1px black; border-collapse: collapse; margin-bottom: 5px;font-size:9pt; width:1000px; margin-right:0px;" id="tableNonkomoditi">
		<tr>
			<th style="text-align: center;width: 5%; border: solid 1px black;">NO</th>
			<th style="text-align: left;width: 15%; border: solid 1px black;">TGL TAGIHAN</th>
			<th style="text-align: center;width: 10%;border: solid 1px black;">LAINNYA</th>
			<th style="text-align: center;width: 10%;border: solid 1px black;">SAYUR</th>
			<th style="text-align: center;width: 10%;border: solid 1px black;">BUAH</th>
			<th style="text-align: center;width: 10%;border: solid 1px black;">TOTAL</th>
		</tr>
		<?php
			$sql = "select DATE(date_pay) dateonly
			from weighing w
			where (date_pay between '".$date1."' and '".$date2."') and
			w.weighing_sts = 'Lunas' 
			group by dateonly";

			$query 	= mysql_query($sql);
			$no 	= 1;
			while($r= mysql_fetch_array($query)){
				$date3 		= date("Y-m-d", strtotime($r['dateonly']));
				/*$other	= executeScalar("select sum(w.cost)
					from weighing w, merchant m 
					where DATE(w.date_check) = '".$r['dateonly']."' and
					w.merchant_id = m.merchant_id and 
					m.merchant_status = 'Aktif' and
					m.merchant_type = 'Lainnya' and
					(w.date_check between '".$date." 00:00:00' and '".$r['dateonly']." 23:59:59') and
					(w.date_pay > '".$r['dateonly']."' || w.date_pay is NULL) and
					w.weighing_sts != 'Batal' and
					(w.weighing_sts2 != 'Dipecah' || w.weighing_sts2 != 'Digabung')");
				$vegie	= executeScalar("select sum(w.cost)
					from weighing w, merchant m 
					where DATE(w.date_check) = '".$r['dateonly']."' and
					w.merchant_id = m.merchant_id and 
					m.merchant_status = 'Aktif' and
					m.merchant_type = 'Sayur' and
					(w.date_check between '".$date." 00:00:00' and '".$r['dateonly']." 23:59:59') and
					(w.date_pay > '".$r['dateonly']."' || w.date_pay is NULL) and
					w.weighing_sts != 'Batal' and
					(w.weighing_sts2 != 'Dipecah' || w.weighing_sts2 != 'Digabung')");
				$fruit	= executeScalar("select sum(w.cost)
					from weighing w, merchant m 
					where DATE(w.date_check) = '".$r['dateonly']."' and
					w.merchant_id = m.merchant_id and 
					m.merchant_status = 'Aktif' and
					m.merchant_type = 'Buah' and
					(w.date_check between '".$date." 00:00:00' and '".$r['dateonly']." 23:59:59') and
					(w.date_pay > '".$r['dateonly']."' || w.date_pay is NULL) and
					w.weighing_sts != 'Batal' and
					(w.weighing_sts2 != 'Dipecah' || w.weighing_sts2 != 'Digabung')");
				$cost	= executeScalar("select sum(w.cost)
					from weighing w, merchant m 
					where DATE(w.date_check) = '".$r['dateonly']."' and
					w.merchant_id = m.merchant_id and 
					m.merchant_status = 'Aktif' and
					(w.date_check between '".$date." 00:00:00' and '".$r['dateonly']." 23:59:59') and
					(w.date_pay > '".$r['dateonly']."' || w.date_pay is NULL) and
					w.weighing_sts != 'Batal' and
					(w.weighing_sts2 != 'Dipecah' || w.weighing_sts2 != 'Digabung')");*/
				$other = executeScalar("select sum(w.cost) 
				from weighing w, merchant m 
				where w.merchant_id = m.merchant_id and 
				m.merchant_type = 'Lainnya' and 
				date_pay = '".$r['dateonly']."' and
				w.weighing_sts = 'Lunas' ");
				
				$vegie = executeScalar("select sum(w.cost) 
				from weighing w, merchant m 
				where w.merchant_id = m.merchant_id and 
				m.merchant_type = 'Sayur' and 
				date_pay = '".$r['dateonly']."' and
				w.weighing_sts = 'Lunas'");
				
				$fruit = executeScalar("select sum(w.cost) 
				from weighing w, merchant m 
				where w.merchant_id = m.merchant_id and 
				m.merchant_type = 'Buah' and 
				date_pay = '".$r['dateonly']."' and
				w.weighing_sts = 'Lunas'");
				
				$cost = executeScalar("select sum(w.cost) 
				from weighing w, merchant m 
				where w.merchant_id = m.merchant_id and 
				date_pay = '".$r['dateonly']."' and
				w.weighing_sts = 'Lunas'")
		?>
		<tr>
			<td style="text-align: center;border: solid 1px black;"><?php echo $no; ?></td>
			<td style="text-align: left;border: solid 1px black;"><?php echo date("d-m-Y", strtotime($r['dateonly'])); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($other); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($vegie); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($fruit); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($cost); ?></td>
		</tr>
		<?php 
			$no++;
			
			$other = 0;
			$vegie = 0;
			$fruit = 0;
			$cost 	= 0;
			}
		?>
		
	</table>
	<br />Keterangan:
</page>