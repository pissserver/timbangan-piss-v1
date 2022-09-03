<?php
	include "../connection.php";
?>
<page backtop="0mm" backbottom="0mm" backleft="7mm" backright="7mm">
    <?php
		$date 			= date("d-m-Y");
		$jam 			= date("H:i");
		$dt_now			= date("Y-m-d H:i:s");
		$id				= $_GET['id'];
		$uid			= $_GET['u'];
		$idq 			= sprintf("%07d", $id);
		$tarif			= 0;
		$sql 			= mysql_query("select * from weighing where weighing_id = '".$id."'");
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
				$tarif	 	= executeScalar("select pay_total from payment where pay_id = '8'");
				if($r['merchant_id']=='B0072'&&$r['goods_id']==2){
					$tarif 	= executeScalar("select pay_total from payment where pay_id = '2'");
				}
			}
			elseif($jenis=='S'&&$r['laborer_sts']=='Ya'){
				$tarif1	 	= executeScalar("select pay_total from payment where pay_id = '3'");
				$tarif2	 	= executeScalar("select pay_total from payment where pay_id = '2'");
				$tarif		= intval($tarif1+$tarif2);
			}
			elseif($jenis=='S'&&$r['laborer_sts']=='Tidak'){
				$tarif	 	= executeScalar("select pay_total from payment where pay_id = '2'");
			}
			elseif($jenis=='L'&&$r['laborer_sts']=='Ya'){
				$tarif1	 	= executeScalar("select pay_total from payment where pay_id = '3'");
				$tarif2	 	= executeScalar("select pay_total from payment where pay_id = '2'");
				$tarif		= intval($tarif1+$tarif2);
			} 
			elseif($jenis=='L'&&$r['laborer_sts']=='Tidak'){
				$tarif	 	= executeScalar("select pay_total from payment where pay_id = '2'");
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
		<tr><td>Tarif	 			</td><td> : <?php echo intval($tarif); ?></td></tr>
		<tr><td>Total Biaya 	 	</td><td> : <b style="font-size: 14px; font-weight: bold;"><?php echo format_rupiah($r['cost']); ?></b></td></tr>
		<?php
			//jika ada mitra
			if($r['laborer_sts']=='Ya'){
				$x1 = executeScalar("select sum(t06) from laborer_fee where weighing_id = '".$id."' ");
				if($x1>0){
					$x1 = 't06, ';
				}
				$x2 = executeScalar("select sum(t14) from laborer_fee where weighing_id = '".$id."' ");
				if($x2>0){
					$x2 = 't14, ';
				}
				$x3 = executeScalar("select sum(t17) from laborer_fee where weighing_id = '".$id."' ");
				if($x3>0){
					$x3 = 't17, ';
				}
				$x4 = executeScalar("select sum(t24) from laborer_fee where weighing_id = '".$id."' ");
				if($x4>0){
					$x4 = 't24, ';
				}
				$x5 = executeScalar("select sum(t26) from laborer_fee where weighing_id = '".$id."' ");
				if($x5>0){
					$x5 = 't26, ';
				}
				$x6 = executeScalar("select sum(t29) from laborer_fee where weighing_id = '".$id."' ");
				if($x6>0){
					$x6 = 't29, ';
				}
				$x7 = executeScalar("select sum(t36) from laborer_fee where weighing_id = '".$id."' ");
				if($x7>0){
					$x7 = 't36, ';
				}
				$x8 = executeScalar("select sum(t40) from laborer_fee where weighing_id = '".$id."' ");
				if($x8>0){
					$x8 = 't40, ';
				}
				$x9 = executeScalar("select sum(foreman) from laborer_fee where weighing_id = '".$id."' ");
				if($x9>0){
					$x9 = 'm03';
				}
				echo '<tr><td>Kode Mitra	</td><td> : '.$x1.$x2.$x3.$x4.$x5.$x6.$x7.$x8.$x9.'</td></tr>';
			}
		?>
	</table><br/>
	<b>NB :</b> Nota tagihan ini harap disimpan sebagai bukti pembayaran. Mohon Dicek Kembali.
	<br/><br/>
	<table style="width: 95%; border: 0px black; margin-top:10px; font-size:9pt;">
		<tr>
			<td style="text-align: left;width: 35%">www.paskomnas.com</td>
			<td style="text-align: center;width: 40%">(Checker)</td>
			<td style="text-align: right;width: 25%"><?php echo $checker; ?></td>
		</tr>
	</table>
    <page_footer>
    </page_footer>
	<?php 
		//simpan data siapa yg ngeprint
		$insert = mysql_query("insert into weighing_print (print_id, weighing_id, print_user, print_date) 
		value ('', '".$id."', '".$uid."', '".$dt_now."')");
	} ?>
</page>