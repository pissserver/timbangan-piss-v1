<?php
	include "../connection.php";
	$date1	= $_POST['date1'];
	$date2	= $_POST['date2'];
	$date 	= date("d-m-Y");
	$total1	= 0;
	$total2	= 0;
	$total3	= 0;
?>
<page backtop="15mm" backbottom="10mm" backleft="10mm" backright="10mm">
	<page_header>
		<div style="font-size: 12px; font-weight: bold; text-align: center; margin-top:20px;">
			REKAP TONASE SEMUA KOMODITI
		</div>
    </page_header>
	<table style="margin-bottom: 5px;font-size:10pt; width:300px;">
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
	<table style="border: solid 1px black; border-collapse: collapse; margin-bottom: 5px;font-size:8pt; width:670px; margin-right:0px;" id="tableNonkomoditi">
		<tr>
			<th style="text-align: center;width: 7%; border: solid 1px black;">NO</th>
			<th style="text-align: left;width: 75%;border: solid 1px black;">NAMA KOMODITI (BUAH)</th>
			<th style="text-align: center;width: 18%;border: solid 1px black;">JUMLAH TONASE</th>
		</tr>
		<?php
			//select tonase berdasarkan komoditi
			$query 		= mysql_query("select * from goods where goods_type = 'Buah' order by goods_name");
			$no 		= 1;
			$total		= 0;
			while($r= mysql_fetch_array($query)){
			$tonase		= executeScalar("select sum(netto) from weighing 
			where goods_id = '".$r['goods_id']."' and 
			weighing_sts != 'Batal' and 
			(date_check between '".$date1." 00:00:00' and '".$date2." 23:59:59')");
		?>
		<tr>
			<td style="text-align: center;border: solid 1px black;"><?php echo $no; ?></td>
			<td style="text-align: left;border: solid 1px black;"><?php echo $r['goods_name']; ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($tonase); ?></td>
		</tr>
		<?php 
				$no++;
				$total1	= $total1+$tonase;
			}
		?>
		<tr>
			<td style="text-align: right;border: solid 1px black;" colspan="2"><b>SUB TOTAL BUAH </b></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($total1); ?></td>
		</tr>
	</table>
	
	<table style="border: solid 1px black; border-collapse: collapse; margin-bottom: 5px;font-size:8pt; width:670px; margin-right:0px;" id="tableNonkomoditi">
		<tr>
			<th style="text-align: center;width: 7%; border: solid 1px black;">NO</th>
			<th style="text-align: left;width: 75%;border: solid 1px black;">NAMA KOMODITI (SAYUR)</th>
			<th style="text-align: center;width: 18%;border: solid 1px black;">JUMLAH TONASE</th>
		</tr>
		<?php
			//select tonase berdasarkan komoditi
			$query 		= mysql_query("select * from goods where goods_type = 'Sayur' order by goods_name");
			$no 		= 1;
			$total		= 0;
			while($r= mysql_fetch_array($query)){
			$tonase		= executeScalar("select sum(netto) from weighing 
			where goods_id = '".$r['goods_id']."' and 
			weighing_sts != 'Batal' and 
			(date_check between '".$date1." 00:00:00' and '".$date2." 23:59:59')");
		?>
		<tr>
			<td style="text-align: center;border: solid 1px black;"><?php echo $no; ?></td>
			<td style="text-align: left;border: solid 1px black;"><?php echo $r['goods_name']; ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($tonase); ?></td>
		</tr>
		<?php 
			$no++;
			$total2	= $total2+$tonase;
			}
		?>
		<tr>
			<td style="text-align: right;border: solid 1px black;" colspan="2"><b>SUB TOTAL SAYUR </b></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($total2); ?></td>
		</tr>
	</table>
	<table style="border: solid 1px black; border-collapse: collapse; margin-bottom: 5px;font-size:8pt; width:670px; margin-right:0px;" id="tableNonkomoditi">
		<tr>
			<th style="text-align: center;width: 7%; border: solid 1px black;">NO</th>
			<th style="text-align: left;width: 75%;border: solid 1px black;">NAMA KOMODITI (PELENGKAP)</th>
			<th style="text-align: center;width: 18%;border: solid 1px black;">JUMLAH TONASE</th>
		</tr>
		<?php
			//select tonase berdasarkan komoditi
			$query 		= mysql_query("select * from goods where goods_type = 'Pelengkap' order by goods_name");
			$no 		= 1;
			$total		= 0;
			while($r= mysql_fetch_array($query)){
			$tonase		= executeScalar("select sum(netto) from weighing 
			where goods_id = '".$r['goods_id']."' and 
			weighing_sts != 'Batal' and 
			(date_check between '".$date1." 00:00:00' and '".$date2." 23:59:59')");
		?>
		<tr>
			<td style="text-align: center;border: solid 1px black;"><?php echo $no; ?></td>
			<td style="text-align: left;border: solid 1px black;"><?php echo $r['goods_name']; ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($tonase); ?></td>
		</tr>
		<?php 
			$no++;
			$total3	= $total3+$tonase;
			}
		?>
		<tr>
			<td style="text-align: right;border: solid 1px black;" colspan="2"><b>SUB TOTAL PELENGKAP </b></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($total3); ?></td>
		</tr>
		<tr>
			<td style="text-align: right;border: solid 1px black;" colspan="2"><b>TOTAL SEMUA KOMODITI </b></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php $total4=$total1+$total2+$total3; echo format_no($total4); ?></td>
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