<?php
	include "../connection.php";
?>
<page backtop="0mm" backbottom="0mm" backleft="5mm" backright="5mm">
    <?php
		$date 			= date("d/m/y");
		$jam 			= date("H:i");
		$id				= $_GET['id'];
		$idq 			= sprintf("%07d", $id);
		$tarif			= 0;
		$sql 			= mysql_query("select * from weighing where weighing_id = '".$id."'");
		while($r= mysql_fetch_array($sql)){
			$name		= executeScalar("select merchant_name from merchant where merchant_id = '".$r['merchant_id']."'");
			$nick		= executeScalar("select merchant_nick from merchant where merchant_id = '".$r['merchant_id']."'");
			$checker	= executeScalar("select checker_code from checker where checker_id = '".$r['checker_id']."'");
			$goods		= executeScalar("select goods_name from goods where goods_id = '".$r['goods_id']."'");
			$nc			= executeScalar("select noncommodity_name from noncommodity where noncommodity_id = '".$r['noncommodity_id']."'");
			$time1		= executeScalar("select TIME_FORMAT(`time_in`, '%H:%i') from weighing where weighing_id = '".$r['weighing_id']."'");
			$time2		= executeScalar("select TIME_FORMAT(`time_out`, '%H:%i') from weighing where weighing_id = '".$r['weighing_id']."'");
			$date_in	= date("d-m-Y", strtotime($r['date_in']));
			$date_out	= date("d-m-Y", strtotime($r['date_out']));
	?>
	<page_header>
        
    </page_header>
	<table style="width:95%; border:0px; margin-top:10px; margin-left:5px; margin-right:5px; font-size:10pt;">
            <tr>
                <td style="text-align: left; width: 50%">No Timbang: <?php echo $idq; ?></td>
                <td style="text-align: center; width: 5%"></td>
                <td style="text-align: right; width: 45%"><?php echo date("d-m-Y", strtotime($date_now)); ?></td>
            </tr>
        </table>
	<br />
    <div style="font-size: 12px; font-weight: bold; text-align: center; margin-top:0px;">
		HASIL TIMBANG KENDARAAN DI PIOS
	</div>
	<br/><br/>
	<div style="font-size: 12px; font-weight: bold;">Data timbangan akhir adalah sebagai berikut:</div>
	<br/>
	<table style="margin-bottom: 5px;font-size:11px;" id="tableCheckout">
		<tr><td>Nama        		</td><td> : <?php echo $name.' / '.$nick; ?> </td></tr>
		<tr><td>Nopol      			</td><td> : <?php echo $r['nopol']; ?></td></tr>
		<tr><td>Tgl & Jam masuk		</td><td> : <?php echo $date_in.' '.$time1; ?></td></tr>
		<tr><td>Tgl & Jam Keluar	</td><td> : <?php echo $date_out.' '.$time2; ?></td></tr>
		<tr><td>Barang 	 			</td><td> : <?php echo $goods; ?></td></tr>
		<tr><td>Berat Masuk			</td><td> : <?php echo format_no($r['weight_in']); ?></td></tr>
		<tr><td>Berat Keluar		</td><td> : <?php echo format_no($r['weight_out']); ?></td></tr>
		<tr><td>Berat NonKomoditi	</td><td> : 0</td></tr>
		<tr><td>Berat Bersih		</td><td> : <b style="font-size: 14px; font-weight: bold;"><?php echo format_no($r['netto']); ?></b></td></tr>
	</table><br/>
	<br/><br/><br/><br/>
	
    <page_footer>
	<table style="width: 95%; border: 0px black; margin-top:10px; margin-left:5px; margin-right:5px; font-size:8pt;">
		<tr>
			<td style="text-align: left;width: 35%">www.paskomnas.com</td>
			<td style="text-align: center;width: 40%"></td>
			<td style="text-align: right;width: 25%"><?php echo $checker; ?></td>
		</tr>
	</table>
    </page_footer>
	<?php } ?>
</page>