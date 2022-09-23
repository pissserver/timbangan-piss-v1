<?php
	include "../connection.php";
?>
<page backtop="-2mm" backbottom="0mm" backleft="7mm" backright="7mm">
    <?php
		$date 			= date("d-m-Y");
		$jam 			= date("H:i");
		$dt_now			= date("Y-m-d H:i:s");
		$id				= $_GET['id'];
		$uid			= $_GET['u'];
		$idq 			= sprintf("%07d", $id);
		$tarif			= 0;
		$sql 			= mysql_query("select * from weighing where weighing_id = '".$id."'");
		$biayatonase 	= 0;
		$biayamitra 	= 0;
		while($r= mysql_fetch_array($sql)){
			$prnt 		= mysql_query("update weighing set p2 = '2' where weighing_id = '".$id."'");
			$jenis		= mb_substr($r['merchant_id'], 0, 1, 'utf-8');
			$tarif		= 0;
			$name		= executeScalar("select merchant_name from merchant where merchant_id = '".$r['merchant_id']."'");
			$nick		= executeScalar("select merchant_nick from merchant where merchant_id = '".$r['merchant_id']."'");
			$checker	= executeScalar("select checker_code from checker where checker_id = '".$r['checker_id']."'");
			$lapak 		= executeScalar("select l.lapak_name from rent r, lapak l where r.lapak_id = l.lapak_id and 
			r.merchant_id = '".$r['merchant_id']."' and (r.rent_sts2 != 'Pindah' && r.rent_sts2 != 'Batal') limit 1");
			$goods		= executeScalar("select goods_name from goods where goods_id = '".$r['goods_id']."'");
			$nc			= executeScalar("select noncommodity_name from noncommodity where noncommodity_id = '".$r['noncommodity_id']."'");
			$time1		= executeScalar("select TIME_FORMAT(`time_in`, '%H:%i') from weighing where weighing_id = '".$r['weighing_id']."'");
			$time2		= executeScalar("select TIME_FORMAT(`time_out`, '%H:%i') from weighing where weighing_id = '".$r['weighing_id']."'");
			$date_in	= date("d-m-Y", strtotime($r['date_in']));
			$date_out	= date("d-m-Y", strtotime($r['date_out']));
			$date_cek	= date("d-m-Y H:i", strtotime($r['date_check']));
			$nc_weight	= $r['noncommodity'];
			if($nc_weight!=0||$nc_weight!=''){
				$nc_weight	= $nc_weight;
			}
			else{
				$nc_weight	= '-';
			}
			if($r['reffer']!=''){
				$reffer = $r['reffer'];
			}else{
				$reffer = '-';
			}
			if($nc!=''||$nc!=0){
				$nc = $nc;
			}else{
				$nc = '-';
			}
			
			if($jenis=='B'){
				if( $r['laborer_sts']=='Ya' ){
					$tarif1	 		= executeScalar("select pay_total from payment where pay_id = '9'");
					$tarif2	 		= executeScalar("select pay_total from payment where pay_id = '8'");
					$tarif			= intval($tarif1+$tarif2);
					$biayatonase 	= $r['netto'] * $tarif2;
					$biayamitra 	= $r['netto'] * $tarif1;
				}else{
					$tarif	 		= executeScalar("select pay_total from payment where pay_id = '8'");
					$biayamitra 	= 0;
				}
				// if($r['merchant_id']=='B0072'&&$r['goods_id']==2){
				// 	$tarif 	= executeScalar("select pay_total from payment where pay_id = '2'");
				// }
			}
			elseif($jenis=='S'&&$r['laborer_sts']=='Ya'){
				$tarif1	 	= executeScalar("select pay_total from payment where pay_id = '3'");
				$tarif2	 	= executeScalar("select pay_total from payment where pay_id = '2'");
				$tarif		= intval($tarif1+$tarif2);
				$biayatonase 	= $r['netto'] * $tarif2;
				$biayamitra 	= $r['netto'] * $tarif1;
			}
			elseif($jenis=='S'&&$r['laborer_sts']=='Tidak'){
				$tarif	 	= executeScalar("select pay_total from payment where pay_id = '2'");
				$biayamitra 	= 0;
			}
			elseif($jenis=='L'&&$r['laborer_sts']=='Ya'){
				$tarif1	 	= executeScalar("select pay_total from payment where pay_id = '3'");
				$tarif2	 	= executeScalar("select pay_total from payment where pay_id = '2'");
				$tarif		= intval($tarif1+$tarif2);
				$biayatonase 	= $r['netto'] * $tarif2;
				$biayamitra 	= $r['netto'] * $tarif1;
			} 
			elseif($jenis=='L'&&$r['laborer_sts']=='Tidak'){
				$tarif	 	= executeScalar("select pay_total from payment where pay_id = '2'");
				$biayamitra 	= 0;
			} 
		
	?>
	<page_header>
        
    </page_header>
	<table style="width:95%; border:0px; margin-top:10px; font-size:10pt;">
            <tr>
                <td style="text-align: left; width: 60%">No Nota: TG<?php echo $idq; ?></td>
                <td style="text-align: center; width: 5%"></td>
                <td style="text-align: right; width: 35%"><?php echo $date; ?></td>
            </tr>
        </table>
	<br />
    <div style="font-size: 12px; font-weight: bold; text-align: center; margin-top:0px;">
		NOTA TAGIHAN
	</div>
	<br/>
	<div style="font-size: 12px; font-weight: bold;">Data timbangan akhir adalah sebagai berikut:</div>
	<table style="margin-bottom: 5px;font-size:11px;" id="tableCheckout">
		<tr><td>Nama / Alias     	</td><td> : <?php echo $name.' / '.$nick; ?> </td></tr>
		<tr><td>Lapak 				</td><td> : <?php echo $lapak; ?></td></tr>
		<tr><td>Nopol      			</td><td> : <?php echo $r['nopol']; ?></td></tr>
		<tr><td>Tgl & Jam Masuk		</td><td> : <?php echo $date_in.' '.$time1; ?></td></tr>
		<tr><td>Tgl & Jam Keluar	</td><td> : <?php echo $date_out.' '.$time2; ?></td></tr>
		<tr><td>Tgl & Jam Check		</td><td> : <?php echo $date_cek; ?></td></tr>
		<tr><td>Barang 	 			</td><td> : <?php echo $goods; ?></td></tr>
		<tr><td>Status Mitra 	 	</td><td> : <?php echo $r['laborer_sts'];  ?></td></tr>
		<tr><td>Status Nota		 	</td><td> : <?php if($r['weighing_sts2']=='Pecahan'){
			$nett = executeScalar("select netto from weighing where weighing_id = '".$r['reffer']."'");
			echo $r['weighing_sts2'].' (Netto Awal '.$nett.')';
		}
		else{
			echo $r['weighing_sts2']; 
		} ?></td></tr>
		<tr><td>Berat Masuk			</td><td> : <?php echo format_no($r['weight_in']); ?></td></tr>
		<tr><td>Berat Keluar		</td><td> : <?php echo format_no($r['weight_out']); ?></td></tr>
		<tr><td>Berat NonKomoditi	</td><td> : <?php echo $nc_weight; ?></td></tr>
		<tr><td>Rafaksi (Potongan) 	</td><td> : <?php echo $r['rafaksi']; ?></td></tr>
		<tr><td>Berat Bersih		</td><td> : <b style="font-size: 14px; font-weight: bold;"><?php echo format_no($r['netto']); ?></b></td></tr>
		<tr><td>Tarif Tonase  		</td><td> : Rp. <?php echo intval($tarif2); ?> /kg   =  <b style="font-size: 14px; font-weight: bold;"><?php echo format_rupiah($biayatonase); ?></b></td></tr>
		<tr><td>Tarif Bongkar  		</td><td> : Rp. <?php echo intval($tarif1); ?> /kg   =  <b style="font-size: 14px; font-weight: bold;"><?php echo format_rupiah($biayamitra); ?></b></td></tr>
		<!-- <tr><td>Total Biaya Tonase 	</td><td> : <b style="font-size: 14px; font-weight: bold;"><?php echo format_rupiah($biayatonase); ?></b></td></tr>
		<tr><td>Total Biaya Mitra	</td><td> : <b style="font-size: 14px; font-weight: bold;"><?php echo format_rupiah($biayamitra); ?></b></td></tr> -->
		<!-- <tr><td>Total Biaya 	 	</td><td> : <b style="font-size: 14px; font-weight: bold;"><?php echo format_rupiah($r['cost']); ?></b></td></tr> -->
		<?php
			//jika ada mitra
			if($r['laborer_sts']=='Ya'){
				$x1 = executeScalar("select sum(B001) from laborer_fee where weighing_id = '".$id."' ");
				if($x1>0){
					$x1 = 'B001, ';
				}
				$x2 = executeScalar("select sum(B002) from laborer_fee where weighing_id = '".$id."' ");
				if($x2>0){
					$x2 = 'B002, ';
				}
				$x3 = executeScalar("select sum(B003) from laborer_fee where weighing_id = '".$id."' ");
				if($x3>0){
					$x3 = 'B003, ';
				}
				$x4 = executeScalar("select sum(B004) from laborer_fee where weighing_id = '".$id."' ");
				if($x4>0){
					$x4 = 'B004, ';
				}
				$x5 = executeScalar("select sum(B005) from laborer_fee where weighing_id = '".$id."' ");
				if($x5>0){
					$x5 = 'B005, ';
				}
				$x6 = executeScalar("select sum(B006) from laborer_fee where weighing_id = '".$id."' ");
				if($x6>0){
					$x6 = 'B006, ';
				}
				$x7 = executeScalar("select sum(B007) from laborer_fee where weighing_id = '".$id."' ");
				if($x7>0){
					$x7 = 'B007, ';
				}
				$x8 = executeScalar("select sum(B008) from laborer_fee where weighing_id = '".$id."' ");
				if($x8>0){
					$x8 = 'B008, ';
				}
				$x9 = executeScalar("select sum(B009) from laborer_fee where weighing_id = '".$id."' ");
				if($x9>0){
					$x9 = 'B009, ';
				}
				$x10 = executeScalar("select sum(B010) from laborer_fee where weighing_id = '".$id."' ");
				if($x10>0){
					$x10 = 'B010, ';
				}
				$x11 = executeScalar("select sum(S001) from laborer_fee where weighing_id = '".$id."' ");
				if($x11>0){
					$x11 = 'S001, ';
				}
				$x12 = executeScalar("select sum(S002) from laborer_fee where weighing_id = '".$id."' ");
				if($x12>0){
					$x12 = 'S002, ';
				}
				$x13 = executeScalar("select sum(S003) from laborer_fee where weighing_id = '".$id."' ");
				if($x13>0){
					$x13 = 'S003, ';
				}
				$x14 = executeScalar("select sum(S004) from laborer_fee where weighing_id = '".$id."' ");
				if($x14>0){
					$x14 = 'S004, ';
				}
				$x15 = executeScalar("select sum(S005) from laborer_fee where weighing_id = '".$id."' ");
				if($x15>0){
					$x15 = 'S005, ';
				}
				$x16 = executeScalar("select sum(S006) from laborer_fee where weighing_id = '".$id."' ");
				if($x16>0){
					$x16 = 'S006, ';
				}
				$x17 = executeScalar("select sum(S007) from laborer_fee where weighing_id = '".$id."' ");
				if($x17>0){
					$x17 = 'S007, ';
				}
				$x18 = executeScalar("select sum(S008) from laborer_fee where weighing_id = '".$id."' ");
				if($x18>0){
					$x18 = 'S008, ';
				}
				$x19 = executeScalar("select sum(S009) from laborer_fee where weighing_id = '".$id."' ");
				if($x19>0){
					$x19 = 'S009, ';
				}
				$x20 = executeScalar("select sum(S010) from laborer_fee where weighing_id = '".$id."' ");
				if($x20>0){
					$x20 = 'S010, ';
				}
				$x21 = executeScalar("select sum(M01) from laborer_fee where weighing_id = '".$id."' ");
				if($x21>0){
					$x21 = 'M01, ';
				}
				$x22 = executeScalar("select sum(M02) from laborer_fee where weighing_id = '".$id."' ");
				if($x22>0){
					$x22 = 'M02, ';
				}
				$x23 = executeScalar("select sum(M03) from laborer_fee where weighing_id = '".$id."' ");
				if($x23>0){
					$x23 = 'M03, ';
				}
				$x24 = executeScalar("select sum(M04) from laborer_fee where weighing_id = '".$id."' ");
				if($x24>0){
					$x24 = 'M04.';
				}
				echo '<tr><td>Kode Mitra	</td><td width="220"> : '.$x1.$x2.$x3.$x4.$x5.$x6.$x7.$x8.$x9.$x10.$x11.$x12.$x13.$x14.$x15.$x16.$x17.$x18.$x19.$x20.$x21.'<br>'.$x22.$x23.$x24.'</td></tr>';
			}
		?>
	</table><br/>
	<b>NB :</b> Nota tagihan ini harap disimpan sebagai bukti pembayaran. Mohon Dicek Kembali.
	<br/>
	<table style="width: 100%; high: 50px; border: 0px black; margin-top:5px; font-size:9pt;">
		<tr>
			<td style="text-align: center;width: 33%; border: 1px solid black;">Checker<br><br><?php echo $checker; ?></td>
			<td style="text-align: center;width: 34%; border: 1px solid black;">Pedagang<br><br>&nbsp;</td>
			<td style="text-align: center;width: 33%; border: 1px solid black;">Mandor<br><br>&nbsp;</td>
		</tr>
	</table>
	<div style="font-size: 12px; font-weight: bold; text-align: center; margin-top:5px;">
		== PASAR INDUK SURABAYA SIDOTOPO ==
	</div>
    <page_footer>
    </page_footer>
	<?php 
		//simpan data siapa yg ngeprint
		$insert = mysql_query("insert into weighing_print (print_id, weighing_id, print_user, print_date) 
		value ('', '".$id."', '".$uid."', '".$dt_now."')");
	} ?>
</page>