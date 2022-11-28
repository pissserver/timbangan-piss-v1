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
		REKAP SETORAN TONASE KO Per Checker
	</div>
    <br/>
	<table style="margin-bottom: 5px;font-size:11pt; width:400px;" >
		<tr>
			<td style="width: 40%;">Tanggal Setoran KO</td>
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
			<th style="text-align: center;height: 2%; width: 5%; border: solid 1px black;">NO</th>
			<th style="text-align: center;width: 35%;border: solid 1px black;">Nama Penyetor</th>
			<th style="text-align: center;width: 20%;border: solid 1px black;">Total Tagihan</th>
			<th style="text-align: center;width: 20%;border: solid 1px black;">Total Setoran KO (Rp)</th>
		</tr>
		<?php
			//select tonase berdasarkan tanggal masuk
			$no 	= 1;
			$inv 	= 0;
			$sql 	= "select sum(ko_total) as total, receiver_id from ko where ko_date between '".$date1."' and '".$date2."' group by receiver_id";
			$query 	= mysql_query($sql);
			while($r= mysql_fetch_array($query)){
				$checker = executeScalar("select checker_name from checker where checker_id = '".$r['receiver_id']."'");
				$invoice = executeScalar("select count(w.weighing_id) as tot from weighing w, ko k 
				where k.ko_id = w.ko_id and
				(k.ko_date between '".$date1."' and '".$date2."') and
				k.receiver_id = '".$r['receiver_id']."'");
		?>
		<tr>
			<td style="text-align: center;border: solid 1px black;"><?php echo $no; ?></td>
			<td style="text-align: left;border: solid 1px black;"><?php echo $checker; ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($invoice); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['total']); ?></td>
		</tr>
		<?php
			$no++;
			$inv = $inv+$invoice;
			}
			$cost = executeScalar("select sum(ko_total) from ko where ko_date between '".$date1."' and '".$date2."'");
		?>
		<tr>
			<td style="text-align: right;border: solid 1px black;" colspan="2"><b>Total </b></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($inv); ?></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($cost); ?></td>
		</tr>
	</table>
</page>