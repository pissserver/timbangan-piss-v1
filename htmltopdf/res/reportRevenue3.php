<?php
	include "../connection.php";
	//$date1	= $_POST['date1'];
	$date1		= '2016-10-01';
	$date2		= $_POST['date2'];
	$commodity	= $_POST['commodity'];
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
		LAPORAN TAGIHAN TONASE BELUM TERBAYAR<br>PASAR INDUK SURABAYA SIDOTOPO ( PISS )
	</div>
    <br/>
	<table style="margin-bottom: 5px;font-size:10pt; width:300px;" >
		<tr>
			<td style="width: 35%;">Jenis Pedagang</td>
			<td style="width: 65%;">: <?php echo $commodity; ?></td>
		</tr>
		<tr>
			<td style="width: 35%;">Tanggal</td>
			<td style="width: 65%;">: <?php echo date("d-m-Y", strtotime($date2)); ?></td>
		</tr>
	</table>
	<br />
	<table style="border: solid 1px black; border-collapse: collapse; margin-bottom: 5px;font-size:9pt; width:1000px; margin-right:0px;" id="tableNonkomoditi">
		<tr>
			<th style="text-align: center;width: 3%;height: 3%;border: solid 1px black;">NO</th>
			<th style="text-align: center;width: 8%;border: solid 1px black;">TGL TAGIHAN</th>
			<th style="text-align: center;width: 9%;border: solid 1px black;">NOTA TIMBANG</th>
			<th style="text-align: center;width: 9%;border: solid 1px black;">NOTA TAGIHAN</th>
			<th style="text-align: center;width: 18%;border: solid 1px black;">PEDAGANG</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">UMUR TAGIHAN</th>
			<th style="text-align: center;width: 8%;border: solid 1px black;">TONASE</th>
			<th style="text-align: center;width: 9%;border: solid 1px black;">TOTAL</th>
		</tr>
		<?php
			$sql = '';
			if($commodity=='Semua'){
				$sql = "select 	w.weighing_id, 
								m.merchant_id, 
								w.checker_id, 
								w.reffer, 
								w.date_out, 
								w.date_check, 
								w.date_pay, 
								w.nopol, 
								w.netto, 
								w.cost_tonase,
								w.cost, 
								m.merchant_name as name
						from 	weighing w, 
								merchant m 
						where 	w.merchant_id = m.merchant_id and 
								m.merchant_status = 'Aktif' and
								(w.date_check between '".$date1." 00:00:00' and '".$date2." 23:59:59') and
								(w.date_pay > '".$date2."' || w.date_pay is NULL) and
								w.weighing_sts != 'Batal' and
								(w.weighing_sts2 != 'Dipecah' || w.weighing_sts2 != 'Digabung')";
			}
			else{
				$sql = "select 	w.weighing_id, 
								m.merchant_id, 
								w.checker_id, 
								w.reffer, 
								w.date_out, 
								w.date_check, 
								w.date_pay, 
								w.nopol, 
								w.netto, 
								w.cost_tonase,
								w.cost, 
								m.merchant_name as name 
						from 	weighing w, 
								merchant m 
						where 	w.merchant_id = m.merchant_id and 
								m.merchant_status = 'Aktif' and
								m.merchant_type = '".$commodity."' and 
								(w.date_check between '".$date1." 00:00:00' and '".$date2." 23:59:59') and
								(w.date_pay > '".$date2."' || w.date_pay is NULL) and
								w.weighing_sts != 'Batal' and
								(w.weighing_sts2 != 'Dipecah' || w.weighing_sts2 != 'Digabung')";
								//untuk pedagang aktif saja atau semua? m.merchant_status = 'Aktif' and 
			}
			$query 	= mysql_query($sql);
			$no 		= 1;
			while($r= mysql_fetch_array($query)){
				//$wid 		= sprintf("%07d", $r['weighing_id']);
				//$rid 		= sprintf("%07d", $r['reffer']);
				//$year1 		= executeScalar("select date_format(date_out, '%y') from weighing where weighing_id = '".$r['weighing_id']."'");
				//$year2 		= executeScalar("select date_format(date_out, '%y') from weighing where weighing_id = '".$r['weighing_id']."'");
				
				//Hitung Umur Tagihan
				$date3 		= new DateTime(date("Y-m-d", strtotime($r['date_check'])));
				$date4 		= new DateTime(date("Y-m-d", strtotime($date2)));
				$diff 		= $date4->diff($date3)->format("%a");
		?>
		<tr>
			<td style="text-align: center;border: solid 1px black;"><?php echo $no; ?></td>
			<td style="text-align: center;border: solid 1px black;"><?php echo date("d-m-Y", strtotime($r['date_check'])); ?></td>
			<td style="text-align: center;border: solid 1px black;"><?php 
			if($r['reffer']=='null'||$r['reffer']==''){
				echo 'TB'.$r['weighing_id'];
			}else{
				echo 'TB'.$r['reffer'];
			} ?></td>
			<td style="text-align: center;border: solid 1px black;"><?php echo 'TG'.$r['weighing_id']; ?></td>
			<td style="text-align: left;border: solid 1px black;"><?php echo $r['name']; ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo $diff; ?> Hari</td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['netto']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['cost_tonase']); ?></td>
		</tr>
		<?php 
			$no++;
			}
			if($commodity=='Semua'){
				$cost = executeScalar("	select 	sum(w.cost_tonase) 
										from 	weighing w, 
												merchant m 
										where 	w.merchant_id = m.merchant_id and 
												(w.date_check between '".$date1." 00:00:00' and '".$date2." 23:59:59') and
												m.merchant_status = 'Aktif' and
												(w.date_pay > '".$date2."' || w.date_pay is NULL) and
												w.weighing_sts != 'Batal' and
												(w.weighing_sts2 != 'Dipecah' || w.weighing_sts2 != 'Digabung')");
			}
			else{
				$cost = executeScalar("	select 	sum(w.cost_tonase)
										from 	weighing w, 
												merchant m 
										where 	w.merchant_id = m.merchant_id and 
												m.merchant_status = 'Aktif' and
												m.merchant_type = '".$commodity."' and 
												(w.date_check between '".$date1." 00:00:00' and '".$date2." 23:59:59') and
												(w.date_pay > '".$date2."' || w.date_pay is NULL) and
												w.weighing_sts != 'Batal' and
												(w.weighing_sts2 != 'Dipecah' || w.weighing_sts2 != 'Digabung')");
			}
		?>
		<tr>
			<td style="text-align: right;border: solid 1px black;" colspan="7"><b>Total </b></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($cost); ?></td>
		</tr>
	</table>
	<br />Keterangan:
</page>