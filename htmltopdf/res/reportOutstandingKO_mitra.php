<?php
	session_start();
	include "../connection.php";
	$date2 		= date("d-m-Y");
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
		Outstanding Kasir Operasional Mitra PISS
	</div>
    <br	/>
	<br />
	<table style="border: solid 1px black; border-collapse: collapse; margin-bottom: 5px;font-size:9pt; width:850px; margin-right:0px;" id="tableNonkomoditi">
		<tr>
			<th style="text-align: center;height: 2%; width: 5%; border: solid 1px black;">NO</th>
			<th style="text-align: center;width: 12%; border: solid 1px black;">KO ID</th>
			<th style="text-align: center;width: 15%;border: solid 1px black;">Nama Kasir</th>
			<th style="text-align: center;width: 15%;border: solid 1px black;">Nama Penyetor</th>
			<th style="text-align: center;width: 15%;border: solid 1px black;">Tanggal KO</th>
			<th style="text-align: center;width: 15%;border: solid 1px black;">Total KO (Rp)</th>
		</tr>
		<?php
			$cashier= $_POST['cashier'];
			$date	= $_POST['date2'];
			if($cashier=='Semua'){
				$sql = "select * from ko_mitra where ko_status != 'Acc' and ko_date <= '".$date."' order by ko_id";
				$cost = executeScalar("select sum(ko_total) from ko_mitra where ko_status != 'Acc'");
			}else{
				$sql = "select * from ko_mitra where ko_status != 'Acc' and cashier_id = '".$cashier."' and ko_date <= '".$date."' order by ko_id";
				$cost = executeScalar("select sum(ko_total) from ko_mitra where ko_status != 'Acc' and cashier_id = '".$cashier."'");
			}
			$query 	= mysql_query($sql);
			$no 	= 1;
			while($r= mysql_fetch_array($query)){
				$cashier	= executeScalar("select checker_name from checker where checker_id = '".$r['cashier_id']."'");
				$checker	= executeScalar("select checker_name from checker where checker_id = '".$r['receiver_id']."'");
		?>
		<tr>
			<td style="text-align: center;border: solid 1px black;"><?php echo $no; ?></td>
			<td style="text-align: center;border: solid 1px black;"><?php echo 'KOM'.$r['ko_id']; ?></td>
			<td style="text-align: left;border: solid 1px black;"><?php echo $cashier; ?></td>
			<td style="text-align: left;border: solid 1px black;"><?php echo $checker; ?></td>
			<td style="text-align: center;border: solid 1px black;"><?php echo date("d-m-Y", strtotime($r['ko_date'])); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['ko_total']); ?></td>
		</tr>
		<?php 
			$no++;
			}
		?>
		<tr>
			<td style="text-align: right;height: 2%; border: solid 1px black;" colspan="5"><b>Total </b></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($cost); ?></td>
		</tr>
	</table>
	<br />Keterangan:
</page>