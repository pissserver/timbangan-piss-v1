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
		Outstanding Kasir Manajemen PIOS
	</div>
    <br	/>
	<br />
	<table style="border: solid 1px black; border-collapse: collapse; margin-bottom: 5px;font-size:9pt; width:850px; margin-right:0px;" id="tableNonkomoditi">
		<tr>
			<th style="text-align: center;width: 5%; border: solid 1px black;">NO</th>
			<th style="text-align: left;width: 15%; border: solid 1px black;">KM ID</th>
			<th style="text-align: left;width: 25%;border: solid 1px black;">Nama Kasir</th>
			<th style="text-align: center;width: 15%;border: solid 1px black;">Tanggal KM</th>
			<th style="text-align: center;width: 15%;border: solid 1px black;">Total KM (Rp)</th>
		</tr>
		<?php
			$cashier= $_POST['cashier'];
			if($cashier=='Semua'){
				$sql = "select * from km where km_status != 'Acc' order by km_id";
			}else{
				$sql = "select distinct(m.km_id), m.km_date, m.km_status, m.km_total from km m, ko o 
				where o.km_id = m.km_id and o.cashier_id = '".$cashier."' and
				m.km_status != 'Acc' order by m.km_id ";
			}
			$query 	= mysql_query($sql);
			$no 	= 1;
			while($r= mysql_fetch_array($query)){
				$cashier_id	= executeScalar("select cashier_id from ko where km_id = '".$r['km_id']."'");
				$cashier	= executeScalar("select checker_name from checker where checker_id = '".$cashier_id."'");
		?>
		<tr>
			<td style="text-align: center;border: solid 1px black;"><?php echo $no; ?></td>
			<td style="text-align: left;border: solid 1px black;"><?php echo 'KM'.$r['km_id']; ?></td>
			<td style="text-align: left;border: solid 1px black;"><?php echo $cashier; ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo date("d-m-Y", strtotime($r['km_date'])); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['km_total']); ?></td>
		</tr>
		<?php 
			$no++;
			}
			$cost = executeScalar("select sum(km_total) from km where km_status != 'Acc'");
		?>
		<tr>
			<td style="text-align: right;border: solid 1px black;" colspan="4"><b>Total </b></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($cost); ?></td>
		</tr>
	</table>
	<br />Keterangan:
</page>