<?php
	include "../connection.php";
	$date1	= $_POST['date1'];
	$date2	= $_POST['date2'];
	$block	= $_POST['block'];
	$total3 = 0;
	$date 	= date("d-m-Y");
	$size 	= executeScalar("select sum(lapak_size) as size from lapak where block_id = '".$block."' ");
	
	//Hitung Selisih Antara Hari Awal & Akhir
	$date3 = new DateTime(date("Y-m-d", strtotime($date1)));
	$date4 = new DateTime(date("Y-m-d", strtotime($date2)));
	$diff = $date4->diff($date3)->format("%a");
	$diff = $diff+1;
?>
<page backtop="15mm" backbottom="10mm" backleft="10mm" backright="10mm">
	<page_header>
		<div style="font-size: 12px; font-weight: bold; text-align: center; margin-top:20px; margin-right:65px;">
			OMSET BLOK <?php echo $block; ?>
		</div>
    </page_header>
	<table style="margin-bottom: 5px;font-size:10pt; width:400px;" >
		<tr>
			<td style="width: 35%;">Tanggal</td>
			<td style="width: 65%;">: <?php echo date("d-m-Y", strtotime($date1)).' sd '.date("d-m-Y", strtotime($date2)); ?></td>
		</tr>
		<tr>
			<td style="width: 35%;">Disusun Berdasarkan</td>
			<td style="width: 65%;">: <?php echo $_POST['sortir']; ?></td>
		</tr>
	</table>
	<br />
	<table style="border: solid 1px black; border-collapse: collapse; margin-bottom: 5px;font-size:8pt; width:680px; margin-right:0px;" id="tableNonkomoditi">
		<tr>
			<th style="text-align: center;width: 5%; border: solid 1px black;">NO</th>
			<th style="text-align: left;width: 30%;border: solid 1px black;">PEDAGANG</th>
			<th style="text-align: left;width: 20%;border: solid 1px black;">LAPAK</th>
			<th style="text-align: center;width: 15%;border: solid 1px black;">TOTAL NOTA</th>
			<th style="text-align: center;width: 15%;border: solid 1px black;">RATA-RATA TONASE HARIAN</th>
			<th style="text-align: center;width: 15%;border: solid 1px black;">TONASE</th>
		</tr>
		<?php
			if($_POST['sortir']=='lapak'){
				$query 	= mysql_query("select r.merchant_id as id, m.merchant_name as name, 
				count(w.weighing_id) as tot, l.block_id, sum(w.netto) as total
				from merchant m, rent r, lapak l, weighing w
				where r.lapak_id = l.lapak_id and
				r.merchant_id = m.merchant_id and
				w.merchant_id = m.merchant_id and 
				(r.rent_sts2 != 'Pindah' && r.rent_sts2 != 'Batal') and
				l.block_id = '".$block."' and
				(w.date_check between '".$date1." 00:00:00' and '".$date2." 23:59:59') and
				w.weighing_sts != 'Batal' and
				(w.weighing_sts2 != 'Dipecah' || w.weighing_sts2 != 'Digabung')
				group by id order by l.lapak_name");
			}
			elseif($_POST['sortir']=='tonase'){
				$query 	= mysql_query("select r.merchant_id as id, m.merchant_name as name, 
				count(w.weighing_id) as tot, l.block_id, sum(w.netto) as total
				from merchant m, rent r, lapak l, weighing w
				where r.lapak_id = l.lapak_id and
				r.merchant_id = m.merchant_id and
				w.merchant_id = m.merchant_id and 
				(r.rent_sts2 != 'Pindah' && r.rent_sts2 != 'Batal') and
				l.block_id = '".$block."' and
				(w.date_check between '".$date1." 00:00:00' and '".$date2." 23:59:59') and
				w.weighing_sts != 'Batal' and
				(w.weighing_sts2 != 'Dipecah' || w.weighing_sts2 != 'Digabung')
				group by id order by total desc");
			}
			$no 	= 1;
			$netto2	= 0;
			while($r= mysql_fetch_array($query)){
			$sql2 	= mysql_query("select l.lapak_name from rent r, lapak l
					where r.lapak_id = l.lapak_id and 
					r.merchant_id = '".$r['id']."' and
					l.block_id = '".$block."' and
					(r.rent_sts2 != 'Pindah' && r.rent_sts2 != 'Batal')
					order by l.lapak_name desc");
			$string	= "";
			$counter= 0;
			while($row=mysql_fetch_array($sql2)){
				if($counter!=0){
					$string = ", ".$string;
				}
				$string = $row['lapak_name'].$string;
				$counter++;
			}
			$lapak 	= "".$string;
			$jml	= executeScalar("select count(l.lapak_id) as jml from rent r, lapak l
					where r.lapak_id = l.lapak_id and 
					r.merchant_id = '".$r['id']."' and
					l.block_id = '".$block."' and
					(r.rent_sts2 != 'Pindah' && r.rent_sts2 != 'Batal')
					order by l.lapak_name desc");
			$tot	= $r['tot']/$jml;
			$total	= $r['total']/$jml;
			$mean	= $total/$diff;
		?>
		<tr>
			<td style="text-align: center;border: solid 1px black;"><?php echo $no; ?></td>
			<td style="text-align: left;border: solid 1px black;"><?php echo $r['name']; ?></td>
			<td style="text-align: left;border: solid 1px black;"><?php echo $lapak; ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($tot); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($mean); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_no($total); ?></td>
		</tr>
		<?php 
			$no++;
			$netto2 = $netto2+$total;
			}
		?>
		<tr>
			<td style="text-align: right;border: solid 1px black;" colspan="5"><b>TOTAL </b></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($netto2); ?></td>
		</tr>
	</table>
	<br />
	<div style="font-size: 12px; font-weight: bold; text-align: center; margin-bottom:10px;margin-top:10px;">
			PEDAGANG YANG TIDAK MEMILIKI TONASE
		</div>
	<table style="border: solid 1px black; border-collapse: collapse; margin-bottom: 5px;font-size:8pt; width:680px; margin-right:0px;" id="tableNonkomoditi">
		<tr>
			<th style="text-align: center;width: 5%; border: solid 1px black;">NO</th>
			<th style="text-align: left;width: 15%;border: solid 1px black;">ID PEDAGANG</th>
			<th style="text-align: left;width: 30%;border: solid 1px black;">PEDAGANG</th>
			<th style="text-align: left;width: 30%;border: solid 1px black;">LAPAK</th>
			<th style="text-align: center;width: 20%;border: solid 1px black;">TONASE</th>
		</tr>
		<?php
			//Menentukan query yg akan dipakai berdasarkan jenis pedagang
			$query2 	= mysql_query("select m.merchant_id as id, m.merchant_name as name
			from merchant m, rent r, lapak l
			where m.merchant_id = r.merchant_id and
			r.lapak_id = l.lapak_id and
			m.merchant_status = 'Aktif' and 
			(r.rent_sts2 != 'Pindah' && r.rent_sts2 != 'Batal') and
			l.block_id = '".$block."'
			group by id order by name");
			$no 		= 1;
			while($r= mysql_fetch_array($query2)){
				$total	= executeScalar("select sum(netto) from weighing where merchant_id = '".$r['id']."' and
				weighing_sts != 'Batal' and (date_check between '".$date1."' and '".$date2."')");
				if($total==0||$total==''||$total==null){
					$sql2 	= mysql_query("select l.lapak_name from rent r, lapak l
							where r.lapak_id = l.lapak_id and r.merchant_id = '".$r['id']."'
							and (r.rent_sts2 != 'Pindah' && r.rent_sts2 != 'Batal') order by l.lapak_name desc");
					$string	= "";
					$counter= 0;
					while($row=mysql_fetch_array($sql2)){
						if($counter!=0){
							$string = ", ".$string;
						}
						$string = $row['lapak_name'].$string;
						$counter++;
					}
					$lapak 	= "".$string;
					echo '<tr>
						<td style="text-align: center;border: solid 1px black;">'.$no.'</td>
						<td style="text-align: left;border: solid 1px black;">'.$r['id'].'</td>
						<td style="text-align: left;border: solid 1px black;">'.$r['name'].'</td>
						<td style="text-align: left;width: 25%;border: solid 1px black;">'.$lapak.'</td>
						<td style="text-align: right;border: solid 1px black;">'.format_no($total).'</td>
					</tr>';
					$no++;
				}
			}
		?>
	</table>
	<br /><br />
	<table style="border: solid 1px black; border-collapse: collapse; margin-bottom: 5px;font-size:8pt; width:680px; margin-right:0px;" id="tableNonkomoditi">
		<tr>
			<th style="text-align: center;width: 35%; border: solid 1px black;">Luas Blok</th>
			<th style="text-align: center;width: 65%;border: solid 1px black;">Efisiensi Lapak /M<sup>2</sup></th>
		</tr>
		<tr>
			<td style="text-align: center;border: solid 1px black;"><?php echo $size; ?> M<sup>2</sup></td>
			<td style="text-align: center;border: solid 1px black;"><?php echo format_no($netto2); ?> Kg / <?php echo $size; ?> M<sup>2</sup> = 
			<?php $total3 = $netto2/$size; echo format_no($total3); ?> Kg/M<sup>2</sup></td>
		</tr>
	</table>
    <page_footer>
        <table style="width: 98%; border: 0px black; margin-top:10px; margin-left:5px; margin-right:5px; font-size:8pt;">
            <tr>
                <td style="text-align: left;width: 50%">Tgl Cetak: <?php echo $date; ?></td>
				<td style="text-align: center;width: 25%"></td>
                <td style="text-align: right;width: 25%">Halaman [[page_cu]]/[[page_nb]]</td>
            </tr>
        </table>
    </page_footer>
</page>