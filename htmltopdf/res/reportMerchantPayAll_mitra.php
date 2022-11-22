<?php
	include "../connection.php";
	$date1		= $_POST['date1'];
	//$date1		= '2016-08-20';
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
		Rekap Pembayaran Mitra Seluruh Pedagang
	</div>
    <br/>
	<table style="margin-bottom: 5px;font-size:10pt; width:300px;" >
		<tr>
			<td style="width: 35%;">Tanggal</td>
			<td style="width: 65%;">: <?php
			if($date1==$date2){
				echo date("d-m-Y", strtotime($date1));
			}
			else{
				echo date("d-m-Y", strtotime($date1)).' sd '.date("d-m-Y", strtotime($date2));
			} ?></td>
		</tr>
		<tr>
			<td style="width: 35%;">Jenis Pedagang</td>
			<td style="width: 65%;">: <?php echo $commodity; ?></td>
		</tr>
	</table>
	<br />
	<table style="border: solid 1px black; border-collapse: collapse; margin-bottom: 5px;font-size:8pt; width:800px; margin-right:0px;" id="tableNonkomoditi">
		<tr>
			<th style="text-align: center;height: 2%; width: 5%; border: solid 1px black;">No</th>
			<th style="text-align: center;width: 45%;border: solid 1px black;">Nama Pedagang</th>
			<th style="text-align: center;width: 10%;border: solid 1px black;">Blok Aktif</th>
			<th style="text-align: center;width: 10%;border: solid 1px black;">Total Nota</th>
			<th style="text-align: center;width: 15%;border: solid 1px black;">Total Rupiah (Rp)</th>
		</tr>
		<?php
			$sql 	= '';
			$jml 	= 0;
			$total 	= 0;
			if($commodity=='Semua'){
				$sql = "select 	m.merchant_id as id, 
								m.merchant_name as name, 
								m.active_block, 
								m.merchant_type as type, 
								count(w.weighing_id) as tot, 
								count(weighing_id) as tot, 
								sum(w.cost_bayar) as total
						from 	merchant m, weighing_mitra w
						where 	w.merchant_id = m.merchant_id and
								w.weighing_sts = 'Lunas' and
								(w.date_pay between '".$date1."' and '".$date2."') and
								m.merchant_status = 'Aktif' and 
								m.merchant_type != 'Lainnya'
						group by id 
						order by ".$sort."";
			}else{
				$sql = "select 	m.merchant_id as id, 
								m.merchant_name as name, 
								m.active_block, 
								m.merchant_type as type,
								count(w.weighing_id) as tot, 
								count(weighing_id) as tot, 
								sum(w.cost_bayar) as total
						from 	merchant m, weighing_mitra w
						where 	w.merchant_id = m.merchant_id and
								m.merchant_type = '".$commodity."' and 
								w.weighing_sts = 'Lunas' and
								(w.date_pay between '".$date1."' and '".$date2."') and
								m.merchant_status = 'Aktif' and 
								m.merchant_type != 'Lainnya'
						group by id 
						order by ".$sort."";
			}
			$query 	= mysql_query($sql);
			$no 	= 1;
			while($r= mysql_fetch_array($query)){
		?>
		<tr>
			<td style="text-align: center;border: solid 1px black;"><?php echo $no; ?></td>
			<td style="text-align: left;border: solid 1px black;"><?php echo $r['name']; ?></td>
			<td style="text-align: center;border: solid 1px black;"><?php echo $r['active_block']; ?></td>
			<td style="text-align: center;border: solid 1px black;"><?php echo format_no($r['tot']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['total']); ?></td>
		</tr>
		<?php 
				$no++;
				$jml	= $jml+$r['tot'];
				$total 	= $total+$r['total'];
			}
		?>
		<tr>
			<td style="text-align: right;border: solid 1px black;" colspan="3"><b>Total </b></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($jml); ?></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($total); ?></td>
		</tr>
	</table>
	<br />Keterangan:
</page>