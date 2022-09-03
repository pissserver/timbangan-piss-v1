<?php
	include "../connection.php";
	$date1		= $_POST['date1'];
	$date2		= $_POST['date2'];
	$commodity	= $_POST['type'];
	$sort		= $_POST['sortir'];
	$date 		= date("d-m-Y");
	$x 			= 0;
	$total		= 0;
	
	//Menentukan query yg akan dipakai berdasarkan jenis pedagang
	if($commodity=='Semua'){
		$sql = "select m.merchant_id as id, m.merchant_name as name, m.merchant_type as type, 
		count(w.weighing_id) as tot, sum(w.netto) as total
		from merchant m, weighing w
		where w.merchant_id = m.merchant_id and
		w.weighing_sts != 'Batal' and
		(w.date_check between '".$date1." 00:00:00' and '".$date2." 23:59:59')
		group by id order by ".$sort."";
	}else{
		$sql = "select m.merchant_id as id, m.merchant_name as name, m.merchant_type as type,
		count(w.weighing_id) as tot, sum(w.netto) as total
		from merchant m, weighing w
		where w.merchant_id = m.merchant_id and
		m.merchant_type = '".$_POST['type']."' and
		w.weighing_sts != 'Batal' and
		(w.date_check between '".$date1." 00:00:00' and '".$date2." 23:59:59')
		group by id order by ".$sort."";
	}
	//Hitung Selisih Antara Hari Awal & Akhir
	$date3 = new DateTime(date("Y-m-d", strtotime($date1)));
	$date4 = new DateTime(date("Y-m-d", strtotime($date2)));

	$diff = $date4->diff($date3)->format("%a");
	$diff = $diff+1;
?>
<page backtop="15mm" backbottom="10mm" backleft="5mm" backright="5mm">
	<page_header>
		<div style="font-size: 12px; font-weight: bold; text-align: center; margin-top:20px;">
			LAPORAN TONASE SELURUH PEDAGANG PIOS
		</div>
    </page_header>
	<table style="margin-bottom: 5px;font-size:10pt; width:300px;" >
		<tr>
			<td style="width: 35%;">Tanggal Omzet</td>
			<td style="width: 65%;">: <?php 
			if($date1==$date2){
				echo date("d-m-Y", strtotime($date1));
			}else{
				echo date("d-m-Y", strtotime($date1)).' sd '.date("d-m-Y", strtotime($date2));
			} ?></td>
		</tr>
		<tr>
			<td style="width: 35%;">Jenis Pedagang</td>
			<td style="width: 65%;">: <?php echo $commodity; ?></td>
		</tr>
	</table>
	<br />
	<table style="border: solid 1px black; border-collapse: collapse; margin-bottom: 5px;font-size:8pt; width:800px; margin-right:0px;" id="tableNonkomoditi">
		<tr>
			<th valign="top" style="text-align: center;width: 5%; border: solid 1px black;">NO</th>
			<th valign="top" style="text-align: left;width: 10%;border: solid 1px black;">ID PEDAGANG</th>
			<th valign="top" style="text-align: left;width: 20%;border: solid 1px black;">NAMA PEDAGANG</th>
			<th valign="top" style="text-align: left;width: 10%;border: solid 1px black;">JENIS JUALAN</th>
			<th valign="top" style="text-align: left;width: 15%;border: solid 1px black;">LAPAK</th>
			<th valign="top" style="text-align: center;width: 10%;border: solid 1px black;">JUMLAH TIMBANG</th>
			<th valign="top" style="text-align: center;width: 10%;border: solid 1px black;">RATA-RATA TONASE HARIAN</th>
			<th valign="top" style="text-align: center;width: 10%;border: solid 1px black;">TONASE</th>
		</tr>
		<?php
			$query 		= mysql_query($sql);
			$no 		= 1;
			while($r= mysql_fetch_array($query)){
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
				$mean	= $r['total']/$diff;
		?>
		<tr>
			<td valign="top" style="text-align: center;border: solid 1px black;"><?php echo $no; ?></td>
			<td valign="top" style="text-align: left;border: solid 1px black;"><?php echo $r['id']; ?></td>
			<td valign="top" style="text-align: left;border: solid 1px black;"><?php echo $r['name']; ?></td>
			<td valign="top" style="text-align: left;border: solid 1px black;"><?php echo $r['type']; ?></td>
			<td valign="top" style="text-align: left;width: 15%;border: solid 1px black;"><?php echo $lapak; ?></td>
			<td valign="top" style="text-align: right;border: solid 1px black;"><?php echo format_no($r['tot']); ?></td>
			<td valign="top" style="text-align: right;border: solid 1px black;"><?php echo format_no($mean); ?></td>
			<td valign="top" style="text-align: right;border: solid 1px black;"><?php echo format_no($r['total']); ?></td>
		</tr>
		<?php
				$no++;
				$total	= $total+$r['total'];
				$x		= $x+$r['tot'];
			}
		?>
		<tr>
			<td style="text-align: right;border: solid 1px black;" colspan="7"><b>TOTAL </b></td>
			<td style="text-align: right;border: solid 1px black;font-weight:bold;"><?php echo format_no($total); ?></td>
		</tr>
	</table>
	<br />
	<div style="font-size: 12px; font-weight: bold; text-align: center; margin-bottom:10px;margin-top:10px;">
			PEDAGANG YANG TIDAK MEMILIKI TONASE
		</div>
	<table style="border: solid 1px black; border-collapse: collapse; margin-bottom: 5px;font-size:8pt; width:800px; margin-right:0px;" id="tableNonkomoditi">
		<tr>
			<th style="text-align: center;width: 5%; border: solid 1px black;">NO</th>
			<th style="text-align: left;width: 10%;border: solid 1px black;">ID PEDAGANG</th>
			<th style="text-align: left;width: 25%;border: solid 1px black;">NAMA PEDAGANG</th>
			<th style="text-align: left;width: 10%;border: solid 1px black;">JENIS JUALAN</th>
			<th style="text-align: left;width: 27%;border: solid 1px black;">LAPAK</th>
			<th style="text-align: center;width: 13%;border: solid 1px black;">TONASE</th>
		</tr>
		<?php
			//Menentukan query yg akan dipakai berdasarkan jenis pedagang
			if($commodity=='Semua'){
				$sql2 = "select merchant_id as id, merchant_name as name, merchant_type as type
				from merchant where merchant_status = 'Aktif' and merchant_type != 'Lainnya'
				order by name";
			}else{
				$sql2 = "select merchant_id as id, merchant_name as name, merchant_type as type
				from merchant where merchant_type = '".$_POST['type']."' 
				and merchant_status = 'Aktif' order by name";
			}
			$query2 = mysql_query($sql2);
			$no 	= 1;
			while($r= mysql_fetch_array($query2)){
				$total	= executeScalar("select sum(netto) from weighing where merchant_id = '".$r['id']."' and
				weighing_sts != 'Batal' and (date_check between '".$date1." 00:00:01' and '".$date2." 23:59:59')");
				if($total==0||$total==''|$total==null){
					$sql2 	= mysql_query("select l.lapak_name from rent r, lapak l
							where r.lapak_id = l.lapak_id and r.merchant_id = '".$r['id']."' 
							and (r.rent_sts2 != 'Pindah' && r.rent_sts2 != 'Batal') order by l.lapak_name");
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
						<td style="text-align: left;border: solid 1px black;">'.$r['type'].'</td>
						<td style="text-align: left;width: 25%;border: solid 1px black;">'.$lapak.'</td>
						<td style="text-align: right;border: solid 1px black;">'.format_no($total).'</td>
					</tr>';
					$no++;
				}
			}
		?>
	</table>
    <page_footer>
        <table style="width: 95%; border: 0px black; margin-top:10px; margin-left:15px; margin-right:5px; font-size:8pt;">
            <tr>
                <td style="text-align: left;width: 50%">Tgl Cetak: <?php echo $date; ?></td>
				<td style="text-align: center;width: 25%"></td>
                <td style="text-align: right;width: 25%">Halaman [[page_cu]]/[[page_nb]]</td>
            </tr>
        </table>
    </page_footer>
</page>