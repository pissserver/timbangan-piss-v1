<?php
	session_start();
	include "../connection.php";
	$km			= $_GET['km'];
	$date2 		= date("d-m-Y");
	$cashier_id	= executeScalar("select cashier_id from ko where km_id = '".$km."' limit 1");
	$cashier	= executeScalar("select checker_name from checker where checker_id = '".$cashier_id."'");
	$km_date	= executeScalar("select km_date from km where km_id = '".$km."'");
	$km_total	= executeScalar("select km_total from km where km_id = '".$km."'");
	$km_cash	= executeScalar("select km_cash from km where km_id = '".$km."'");
	//select tonase berdasarkan tanggal masuk
	$sql 	= "select * from ko where ko_status = 'Acc' and km_id = '".$km."'";
	$query 	= mysql_query($sql);
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
                <td style="text-align: left;width: 50%">Tgl Cetak: <?php echo $date2; ?></td>
				<td style="text-align: center;width: 25%"></td>
                <td style="text-align: right;width: 25%">Halaman [[page_cu]]/[[page_nb]]</td>
            </tr>
        </table>
    </page_footer>
    <div style="font-size: 14px; font-weight: bold; text-align: center; margin-top:0px; margin-right:65px;">
		SETORAN KO TONASE ke KM TONASE PISS
	</div>
    <br/>
	<table style="margin-bottom: 5px;font-size:11pt; width:400px;" >
		<tr>
			<td style="width: 40%;">ID KM</td>
			<td style="width: 60%;">: KM<?php echo $km; ?></td>
		</tr>
		<tr>
			<td>Nama Kasir</td>
			<td>: <?php echo $cashier; ?></td>
		</tr>
		<tr>
			<td>Tanggal Setoran KM</td>
			<td>: <?php echo date("d-m-Y", strtotime($km_date)); ?></td>
		</tr>
		<tr>
			<td>Uang Yang Diterima</td>
			<td>: <?php echo format_rupiah($km_cash); ?></td>
		</tr>
		<tr>
			<td style="width: 35%;">Selisih</td>
			<td style="width: 65%;">: <?php $selisih=$km_cash-$km_total;
			echo format_rupiah($selisih); ?></td>
		</tr>
	</table>
	<br />
	<table style="border: solid 1px black; border-collapse: collapse; margin-bottom: 5px;font-size:10pt; width:850px; margin-right:0px;" id="tableNonkomoditi">
		<tr>
			<th style="text-align: center;height: 2%; width: 5%; border: solid 1px black;">NO</th>
			<th style="text-align: center;width: 15%; border: solid 1px black;">KO ID</th>
			<th style="text-align: center;width: 15%;border: solid 1px black;">TANGGAL KO</th>
			<th style="text-align: center;width: 30%;border: solid 1px black;">NAMA PENYETOR</th>
			<th style="text-align: center;width: 15%;border: solid 1px black;">TOTAL KO (Rp)</th>
		</tr>
		<?php
			$no 	= 1;
			while($r= mysql_fetch_array($query)){
				$checker	= executeScalar("select checker_name from checker where checker_id = '".$r['receiver_id']."'");
		?>
		<tr>
			<td style="text-align: center;border: solid 1px black;"><?php echo $no; ?></td>
			<td style="text-align: center;border: solid 1px black;"><?php echo 'KO'.$r['ko_id']; ?></td>
			<td style="text-align: center;border: solid 1px black;"><?php echo date("d-m-Y", strtotime($r['ko_date'])); ?></td>
			<td style="text-align: left;border: solid 1px black;"><?php echo $checker; ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['ko_total']); ?></td>
		</tr>
		<?php 
			$no++;
			}
			$cost = executeScalar("select km_total from km where km_id = '".$km."'");
		?>
		<tr>
			<td style="text-align: right;border: solid 1px black;" colspan="4"><b>Total </b></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($cost); ?></td>
		</tr>
	</table>
	<br />Keterangan:
	<br/><br/><br/><br/><br/>
	<table style="width: 95%; border: 0px black; margin-top:10px; margin-left:5px; margin-right:5px; font-size:11pt;">
		<tr>
			<td style="text-align: center;width: 50%">(TTD Kasir Operasional)</td>
			<td style="text-align: center;width: 50%">(TTD Kasir Manajemen)</td>
		</tr>
	</table>
</page>