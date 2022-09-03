<?php
	include "../connection.php";
	$date1		= $_POST['date1'];
	$date2		= $_POST['date2'];
	$commodity	= $_POST['commodity'];
	$date 		= date("d-m-Y");
	$wi			= 0;
	$wo			= 0;
	$nc			= 0;
	$netto		= 0;
	$rbuah		= 0;
	$rsayur		= 0;
	$rlain		= 0;
	$rafa		= 0;
?>
<page backtop="15mm" backbottom="10mm" backleft="5mm" backright="5mm">
	<page_header>
        <!--<table style="width:95%; border:0px; margin-top:10px; margin-left:5px; margin-right:5px; font-size:8pt;">
            <tr>
                <td style="text-align: left; width: 50%"></td>
                <td style="text-align: center; width: 25%"></td>
                <td style="text-align: right; width: 25%"></td>
            </tr>
        </table>-->
		<div style="font-size: 12px; font-weight: bold; text-align: center; margin-top:20px;">
			RINCIAN TONASE HARIAN PER TRANSAKSI
		</div>
    </page_header>
	<table style="margin-bottom: 5px;font-size:10pt; width:300px;" >
		<tr>
			<td style="width: 35%;">Tanggal Keluar</td>
			<td style="width: 65%;">: <?php 
			if($date1==$date2){
				echo date("d-m-Y", strtotime($date1));
			}else{
				echo date("d-m-Y", strtotime($date1)).' sd '.date("d-m-Y", strtotime($date2));
			} ?></td>
		</tr>
		<tr>
			<td style="width: 35%;">Komoditi</td>
			<td style="width: 65%;">: <?php echo $commodity; ?></td>
		</tr>
	</table>
	<br />
	<table style="border: solid 1px black; border-collapse: collapse; margin-bottom: 5px;font-size:8pt; width:1050px; margin-right:0px;" id="tableNonkomoditi">
		<tr>
			<th style="text-align: center;width: 3%; border: solid 1px black;">NO</th>
			<th style="text-align: left;width: 7%; border: solid 1px black;">TGL MASUK</th>
			<th style="text-align: left;width: 7%;border: solid 1px black;">NOTA TIMBANG</th>
			<th style="text-align: left;width: 7%;border: solid 1px black;">NOTA TAGIHAN</th>
			<th style="text-align: left;width: 7%;border: solid 1px black;">NOPOL</th>
			<th style="text-align: left;width: 13%;border: solid 1px black;">PEDAGANG</th>
			<th style="text-align: left;width: 7%;border: solid 1px black;">KOMODITI</th>
			<th style="text-align: left;width: 5%;border: solid 1px black;">LAPAK</th>
			<th style="text-align: center;width: 5%;border: solid 1px black;">STATUS MITRA</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">STATUS NOTA</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">BERAT MASUK</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">BERAT KELUAR</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">NON KOMODITI</th>
			<th style="text-align: center;width: 5%;border: solid 1px black;">RAFAKSI</th>
			<th style="text-align: center;width: 6%;border: solid 1px black;">TONASE</th>
		</tr>
		<?php
			//select tonase berdasarkan komoditi
			if($commodity=='Semua'){
				$sql = "select weighing_id, merchant_id, checker_id, goods_id, date_in, laborer_sts, weighing_sts, 
				weighing_sts2, weight_in, weight_out, noncommodity, rafaksi, netto, reffer, nopol, date_check	
				from weighing where weighing_sts != 'Batal' and 
				(date_check between '".$date1." 00:00:00' and '".$date2." 23:59:59')";
			}else{
				$sql = "select w.weighing_id, w.merchant_id, w.checker_id, w.goods_id, w.date_in, w.laborer_sts, w.weighing_sts, 
				w.weighing_sts2, w.weight_in, w.weight_out, w.noncommodity, w.rafaksi, w.netto, W.reffer, W.nopol, w.date_check
				from weighing w, merchant m 
				where w.merchant_id = m.merchant_id and 
				weighing_sts != 'Batal' and 
				m.merchant_type = '".$commodity."' and 
				(w.date_check between '".$date1." 00:00:00' and '".$date2." 23:59:59')";
			}
			$query 		= mysql_query($sql);
			$no 		= 1;
			while($r= mysql_fetch_array($query)){
				$name		= executeScalar("select merchant_name from merchant where merchant_id = '".$r['merchant_id']."'");
				$lapak 		= executeScalar("select l.lapak_name from rent r, lapak l 
							where r.lapak_id = l.lapak_id and r.merchant_id = '".$r['merchant_id']."' 
							and (r.rent_sts2 != 'Pindah' && r.rent_sts2 != 'Batal') limit 1");
				$goods		= executeScalar("select goods_name from goods where goods_id = '".$r['goods_id']."'");
				//$wid 		= sprintf("%07d", $r['weighing_id']);
				//$rid 		= sprintf("%07d", $r['reffer']);
				//$year1 		= executeScalar("select date_format(date_in, '%y') from weighing where weighing_id = '".$r['weighing_id']."'");
				//$year2 		= executeScalar("select date_format(date_out, '%y') from weighing where weighing_id = '".$r['weighing_id']."'");
		?>
		<tr>
			<td style="text-align: center;border: solid 1px black;"><?php echo $no; ?></td>
			<td style="text-align: left;border: solid 1px black;"><?php echo date("d-m-Y", strtotime($r['date_check'])); ?></td>
			<td style="text-align: left;border: solid 1px black;"><?php 
			if($r['reffer']=='null'||$r['reffer']==''){
				echo 'TB'.$r['weighing_id'];
			}else{
				echo 'TB'.$r['reffer'];
			} ?></td>
			<td style="text-align: left;border: solid 1px black;"><?php echo 'TG'.$r['weighing_id']; ?></td>
			<td style="text-align: left;border: solid 1px black;"><?php echo $r['nopol']; ?></td>
			<td style="text-align: left;border: solid 1px black;"><?php echo $name; ?></td>
			<td style="text-align: left;border: solid 1px black;"><?php echo $goods; ?></td>
			<td style="text-align: left;border: solid 1px black;"><?php echo $lapak; ?></td>
			<td style="text-align: center;border: solid 1px black;"><?php echo $r['laborer_sts']; ?></td>
			<td style="text-align: center;border: solid 1px black;"><?php echo $r['weighing_sts2']; ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['weight_in']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['weight_out']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['noncommodity']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo $r['rafaksi']; ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($r['netto']); ?></td>
		</tr>
		<?php
				$no++;
				$netto 	= $netto+$r['netto'];
				//rekap perkomoditi jika ditampilkan semua jenis
				if($commodity=='Semua'){
					$mtype = executeScalar("select merchant_type from merchant where merchant_id = '".$r['merchant_id']."'");
					if($mtype=='Buah'){
						$rbuah = $rbuah+$r['netto'];
					}elseif($mtype=='Sayur'){
						$rsayur = $rsayur+$r['netto'];
					}elseif($mtype=='Lainnya'){
						$rlain = $rlain+$r['netto'];
					}
				}
			} 
		?>
		<tr>
			<td style="text-align: right;border: solid 1px black;" colspan="14"><b>TOTAL </b></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($netto); ?></td>
		</tr>
	</table>
	<?php
		if($commodity=='Semua'){
			echo '<br /><br />
			<table style="border: solid 1px black; border-collapse: collapse; margin-bottom: 5px;font-size:8pt; width:500px; margin-right:0px;" id="tableNonkomoditi">
				<tr>
					<th style="text-align: left;border: solid 1px black;" width:500px; colspan="2"><b>Rekap Total Tonase</b></th>
				</tr>
				<tr>
					<td style="text-align: left;border: width:200px; solid 1px black;font-weight:bold;">Buah</td>
					<td style="text-align: right;border: width:300px; solid 1px black;font-weight:bold;">'.format_no($rbuah).' Kg</td>
				</tr>
				<tr>
					<td style="text-align: left;border: solid 1px black;font-weight:bold;">Sayur</td>
					<td style="text-align: right;border: solid 1px black;font-weight:bold;">'.format_no($rsayur).' Kg</td>
				</tr>
				<tr>
					<td style="text-align: left;border: solid 1px black;font-weight:bold;">Lainnya</td>
					<td style="text-align: right;border: solid 1px black;font-weight:bold;">'.format_no($rlain).' Kg</td>
				</tr>
				<tr>
					<td style="text-align: left;border: solid 1px black;font-weight:bold;">Total</td>
					<td style="text-align: right;border: solid 1px black;font-weight:bold;">'.format_no($netto).' Kg</td>
				</tr>
			</table>';
		}
	?>
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