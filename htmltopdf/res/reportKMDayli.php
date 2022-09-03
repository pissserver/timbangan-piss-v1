<?php
	session_start();
	include "../connection.php";
	$date1		= $_POST['date1'];
	$date2		= $_POST['date2'];
	$date_now 	= date("d-m-Y");
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
                <td style="text-align: left;width: 50%">Tgl Cetak: <?php echo $date_now; ?></td>
				<td style="text-align: center;width: 25%"></td>
                <td style="text-align: right;width: 25%">Halaman [[page_cu]]/[[page_nb]]</td>
            </tr>
        </table>
    </page_footer>
    <div style="font-size: 14px; font-weight: bold; text-align: center; margin-top:0px; margin-right:65px;">
		REKAP SETORAN KM HARIAN PIOS
	</div>
    <br/>
	<table style="margin-bottom: 5px;font-size:11pt; width:400px;" >
		<tr>
			<td style="width: 40%;">Tanggal Setoran KM</td>
			<td style="width: 60%;">: <?php 
			if($date1==$date2){
				echo date("d-m-Y", strtotime($date1));
			}else{
				echo date("d-m-Y", strtotime($date1)).' sd '.date("d-m-Y", strtotime($date2));
			} ?></td>
		</tr>
	</table>
    <br/>
	<table style="border: solid 1px black; border-collapse: collapse; margin-bottom: 5px;font-size:9pt; width:800px; margin-right:0px;" id="tableNonkomoditi">
		<tr>
			<th style="text-align: center;width: 5%; border: solid 1px black;">NO</th>
			<th style="text-align: left;width: 15%; border: solid 1px black;">Tanggal KM</th>
			<th style="text-align: left;width: 20%;border: solid 1px black;">KM Awal</th>
			<th style="text-align: left;width: 20%;border: solid 1px black;">KM Akhir</th>
			<th style="text-align: center;width: 15%;border: solid 1px black;">Total KM (Rp)</th>
		</tr>
		<?php
			//select tonase berdasarkan tanggal masuk
			$no 	= 1;
			$grand_total = 0;
			$query 	= mysql_query("select DISTINCT(km_date) as kmdt from km where km_date between '".$date1."' and '".$date2."'");
			while($r= mysql_fetch_array($query)){
				$first_km 		= executeScalar("select km_id from km where km_date = '".$r['kmdt']."' order by km_id asc limit 1");
				$last_km 		= executeScalar("select km_id from km where km_date = '".$r['kmdt']."' order by km_id desc limit 1");
				$total_dayli 	= executeScalar("select sum(km_total) from km where km_date = '".$r['kmdt']."'");
		?>
		<tr>
			<td style="text-align: center;border: solid 1px black;"><?php echo $no; ?></td>
			<td style="text-align: left;border: solid 1px black;"><?php echo $r['kmdt']; ?></td>
			<td style="text-align: left;border: solid 1px black;"><?php echo $first_km; ?></td>
			<td style="text-align: left;border: solid 1px black;"><?php echo $last_km; ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($total_dayli); ?></td>
		</tr>
		<?php 
			$grand_total = $grand_total+$total_dayli;
			$no++;
			}
		?>
		<tr>
			<td style="text-align: right;border: solid 1px black;" colspan="4"><b>Total </b></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;">Rp <?php echo format_no($grand_total); ?></td>
		</tr>
	</table>
</page>