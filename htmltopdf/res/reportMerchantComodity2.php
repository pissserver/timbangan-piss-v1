<?php
	include "../connection.php";
	$date1		= $_POST['date1'];
	$date2		= $_POST['date2'];
	//$commodity	= $_POST['commodity'];
	$date 		= date("d-m-Y");
	$mid		= $_POST['merchant'];
	$goods		= $_POST['goods'];
	$name		= executeScalar("select merchant_name from merchant where merchant_id = '".$mid."'");
	$goods_name	= executeScalar("select goods_name from goods where goods_id = '".$goods."'");
	$sql2 		= mysql_query("select l.lapak_name from rent r, lapak l
				where r.lapak_id = l.lapak_id and r.merchant_id = '".$mid."' 
				and (r.rent_sts2 != 'Pindah' && r.rent_sts2 != 'Batal') order by l.lapak_name");
	$string		= "";
	$counter	= 0;
	while($row=mysql_fetch_array($sql2)){
		if($counter!=0){
			$string = ", ".$string;
		}
		$string = $row['lapak_name'].$string;
		$counter++;
	}
	$lapak 	= "".$string;
?>
<page backtop="15mm" backbottom="10mm" backleft="10mm" backright="10mm">
	<page_header>
		<div style="font-size: 14px; font-weight: bold; text-align: center; margin-top:20px;">
			REKAP TONASE PER PEDAGANG & KOMODITI PIOS
		</div>
    </page_header>
	<table style="margin-bottom: 5px;font-size:11pt; width:300px;" >
		<tr>
			<td style="width: 30%;">Nama</td>
			<td style="width: 70%;">: <?php echo $name.' ('.$mid.')'; ?></td>
		</tr>
		<tr>
			<td style="width: 30%;">Lapak</td>
			<td style="width: 70%;">: <?php echo $lapak; ?></td>
		</tr>
		<tr>
			<td style="width: 30%;">Komoditi</td>
			<td style="width: 70%;">: <?php echo $goods_name; ?></td>
		</tr>
		<tr>
			<td style="width: 30%;">Tanggal</td>
			<td style="width: 70%;">: <?php 
			if($date1==$date2){
				echo date("d-m-Y", strtotime($date1));
			}else{
				echo date("d-m-Y", strtotime($date1)).' sd '.date("d-m-Y", strtotime($date2));
			} ?></td>
		</tr>
	</table>
	<br />
	<table style="border: solid 1px black; border-collapse: collapse; margin-bottom: 5px;font-size:10pt; width:700px; margin-right:0px;" id="tableNonkomoditi">
		<tr>
			<th style="text-align: center;width: 10%; border: solid 1px black;">NO</th>
			<th style="text-align: left;width: 35%; border: solid 1px black;">TANGGAL</th>
			<th style="text-align: center;width:35%;border: solid 1px black;">TOTAL</th>
		</tr>
		<?php
			//select tonase berdasarkan komoditi
			$sql = "select distinct(date(date_check)) as do from weighing 
			where merchant_id = '".$mid."' and 
			goods_id = '".$goods."' and 
			weighing_sts != 'Batal' and 
			(date_check between '".$date1." 00:00:00' and '".$date2." 23:59:59')";
			
			$query 		= mysql_query($sql);
			$no 		= 1;
			$total		= 0;
			while($r	= mysql_fetch_array($query)){
				$tonase = executeScalar("select sum(netto) from weighing 
				where merchant_id = '".$mid."' and 
				goods_id = '".$goods."' and
				weighing_sts != 'Batal' and 
				(date_check between '".$r['do']." 00:00:00' and '".$r['do']." 23:59:59')");
		?>
		<tr>
			<td style="text-align: center;border: solid 1px black;"><?php echo $no; ?></td>
			<td style="text-align: left;border: solid 1px black;"><?php echo date("d-m-Y", strtotime($r['do'])); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($tonase); ?></td>
		</tr>
		<?php 
				$no++;
				$total = $total+$tonase;
			} 
		?>
		<tr>
			<td style="text-align: right;border: solid 1px black;" colspan="2"><b>TOTAL </b></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($total); ?></td>
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