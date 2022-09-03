<?php
	include "../connection.php";
	$date1		= $_POST['date1'];
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
		Tagihan Timbangan Batal PIOS
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
			<td style="width: 35%;">Komoditi</td>
			<td style="width: 65%;">: <?php echo $commodity; ?></td>
		</tr>
	</table>
	<br />
	<table style="border: solid 1px black; border-collapse: collapse; margin-bottom: 5px;font-size:8pt; width:1000px; margin-right:0px;" id="tableNonkomoditi">
		<tr>
			<th style="text-align: center;width: 3%; border: solid 1px black;">No</th>
			<th style="text-align: left;width: 7%; border: solid 1px black;">Tgl Trans</th>
			<th style="text-align: left;width: 8%;border: solid 1px black;">Nota Timbang</th>
			<th style="text-align: left;width: 8%;border: solid 1px black;">Nota Tagihan</th>
			<th style="text-align: center;width: 7%;border: solid 1px black;">Nopol</th>
			<th style="text-align: left;width: 15%;border: solid 1px black;">Pedagang</th>
			<th style="text-align: left;width: 10%;border: solid 1px black;">Komoditi</th>
			<th style="text-align: left;width: 6%;border: solid 1px black;">Mitra</th>
			<th style="text-align: right;width: 7%;border: solid 1px black;">Berat Masuk</th>
			<th style="text-align: right;width: 7%;border: solid 1px black;">Berat Keluar</th>
			<th style="text-align: left;width: 7%;border: solid 1px black;">NonKomoditi</th>
			<th style="text-align: center;width: 7%;border: solid 1px black;">Tonase</th>
			<th style="text-align: center;width: 7%;border: solid 1px black;">Status</th>
		</tr>
		<?php
			//select tonase berdasarkan tanggal masuk
			if($commodity=='Semua'){
				$sql = "select * from weighing where weighing_sts = 'Batal' and 
				(date_in between '".$date1."' and '".$date2."')";
			}
			else{
				$sql = "select * from weighing w, merchant m 
				where w.merchant_id = m.merchant_id and 
				weighing_sts = 'Batal' and 
				m.merchant_type = 'Sayur' and m.merchant_status = 'Aktif' and 
				(w.date_in between '".$date1."' and '".$date2."')";
			
			}
			$query 	= mysql_query($sql);
			$no 		= 1;
			while($r= mysql_fetch_array($query)){
			$name		= executeScalar("select merchant_name from merchant where merchant_id = '".$r['merchant_id']."'");
			$checker	= executeScalar("select checker_code from checker where checker_id = '".$r['checker_id']."'");
			$goods		= executeScalar("select goods_name from goods where goods_id = '".$r['goods_id']."'");
			//$wid 		= sprintf("%07d", $r['weighing_id']);
			//$rid 		= sprintf("%07d", $r['reffer']);
			//$year1 		= executeScalar("select date_format(date_in, '%y') from weighing where weighing_id = '".$r['weighing_id']."'");
			//$year2 		= executeScalar("select date_format(date_out, '%y') from weighing where weighing_id = '".$r['weighing_id']."'");
		?>
		<tr>
			<td style="text-align: center;border: solid 1px black;"><?php echo $no; ?></td>
			<td style="text-align: left;border: solid 1px black;"><?php echo date("d-m-Y", strtotime($r['date_in'])); ?></td>
			<td style="text-align: left;border: solid 1px black;"><?php 
			if($r['reffer']=='null'||$r['reffer']==''){
				echo 'TB'.$r['weighing_id'];
			}else{
				echo 'TB'.$r['reffer'];
			} ?></td>
			<td style="text-align: left;border: solid 1px black;"><?php echo 'TG'.$r['weighing_id']; ?></td>
			<td style="text-align: center;border: solid 1px black;"><?php echo $r['nopol']; ?></td>
			<td style="text-align: left;border: solid 1px black;"><?php echo $name; ?></td>
			<td style="text-align: left;border: solid 1px black;"><?php echo $goods; ?></td>
			<td style="text-align: left;border: solid 1px black;"><?php echo $r['laborer_sts']; ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo $r['weight_in']; ?> Kg</td>
			<td style="text-align: right;border: solid 1px black;"><?php echo $r['weight_out']; ?> Kg</td>
			<td style="text-align: right;border: solid 1px black;"><?php echo $r['noncommodity']; ?> Kg</td>
			<td style="text-align: right;border: solid 1px black;"><?php echo $r['netto']; ?> Kg</td>
			<td style="text-align: left;border: solid 1px black;"><?php echo $r['weighing_sts2']; ?></td>
		</tr>
		<?php 
			$no++;
			}
			if($commodity=='Semua'){
				$cost = executeScalar("select sum(cost) from weighing w, merchant m 
				where w.merchant_id = m.merchant_id and 
				weighing_sts = 'Batal' and 
				m.merchant_status = 'Aktif' and 
				(w.date_in between '".$date1."' and '".$date2."')");
			}else{
				$cost = executeScalar("select sum(cost) from weighing w, merchant m 
				where w.merchant_id = m.merchant_id and 
				weighing_sts = 'Batal' and 
				m.merchant_type = '".$commodity."' and m.merchant_status = 'Aktif' and 
				(w.date_in between '".$date1."' and '".$date2."')");
			
			}
		?>
	</table>
	<br />Keterangan:
</page>