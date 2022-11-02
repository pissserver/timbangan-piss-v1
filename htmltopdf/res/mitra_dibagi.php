<?php
	include "../connection.php";
?>
<page backtop="5mm" backbottom="5mm" backleft="5mm" backright="5mm">
    <?php
		$year 		= date("y");
		$date 		= date("Y-m-d");
		$work_date	= $_GET['date'];
		//Ambis uppah mitra
		$B001 	= executeScalar("SELECT fee_B001 FROM laborer_fee2 where date(fee_date) = '".$work_date."'");
		$B002 	= executeScalar("SELECT fee_B002 FROM laborer_fee2 where date(fee_date) = '".$work_date."'");
		$B003 	= executeScalar("SELECT fee_B003 FROM laborer_fee2 where date(fee_date) = '".$work_date."'");
		$B004 	= executeScalar("SELECT fee_B004 FROM laborer_fee2 where date(fee_date) = '".$work_date."'");
		$B005 	= executeScalar("SELECT fee_B005 FROM laborer_fee2 where date(fee_date) = '".$work_date."'");
		$B006 	= executeScalar("SELECT fee_B006 FROM laborer_fee2 where date(fee_date) = '".$work_date."'");
		$B007 	= executeScalar("SELECT fee_B007 FROM laborer_fee2 where date(fee_date) = '".$work_date."'");
		$B008 	= executeScalar("SELECT fee_B008 FROM laborer_fee2 where date(fee_date) = '".$work_date."'");
		$B009 	= executeScalar("SELECT fee_B009 FROM laborer_fee2 where date(fee_date) = '".$work_date."'");
		$B010 	= executeScalar("SELECT fee_B010 FROM laborer_fee2 where date(fee_date) = '".$work_date."'");
		$B011 	= executeScalar("SELECT fee_B011 FROM laborer_fee2 where date(fee_date) = '".$work_date."'");
		$B012 	= executeScalar("SELECT fee_B012 FROM laborer_fee2 where date(fee_date) = '".$work_date."'");
		$B013 	= executeScalar("SELECT fee_B013 FROM laborer_fee2 where date(fee_date) = '".$work_date."'");
		$B014 	= executeScalar("SELECT fee_B014 FROM laborer_fee2 where date(fee_date) = '".$work_date."'");
		$B015 	= executeScalar("SELECT fee_B015 FROM laborer_fee2 where date(fee_date) = '".$work_date."'");
		$S001 	= executeScalar("SELECT fee_S001 FROM laborer_fee2 where date(fee_date) = '".$work_date."'");
		$S002 	= executeScalar("SELECT fee_S002 FROM laborer_fee2 where date(fee_date) = '".$work_date."'");
		$S003 	= executeScalar("SELECT fee_S003 FROM laborer_fee2 where date(fee_date) = '".$work_date."'");
		$S004 	= executeScalar("SELECT fee_S004 FROM laborer_fee2 where date(fee_date) = '".$work_date."'");
		$S005 	= executeScalar("SELECT fee_S005 FROM laborer_fee2 where date(fee_date) = '".$work_date."'");
		$S006 	= executeScalar("SELECT fee_S006 FROM laborer_fee2 where date(fee_date) = '".$work_date."'");
		$S007 	= executeScalar("SELECT fee_S007 FROM laborer_fee2 where date(fee_date) = '".$work_date."'");
		$S008 	= executeScalar("SELECT fee_S008 FROM laborer_fee2 where date(fee_date) = '".$work_date."'");
		$S009 	= executeScalar("SELECT fee_S009 FROM laborer_fee2 where date(fee_date) = '".$work_date."'");
		$S010 	= executeScalar("SELECT fee_S010 FROM laborer_fee2 where date(fee_date) = '".$work_date."'");
		$S011 	= executeScalar("SELECT fee_S011 FROM laborer_fee2 where date(fee_date) = '".$work_date."'");
		$S012 	= executeScalar("SELECT fee_S012 FROM laborer_fee2 where date(fee_date) = '".$work_date."'");
		$S013 	= executeScalar("SELECT fee_S013 FROM laborer_fee2 where date(fee_date) = '".$work_date."'");
		$S014 	= executeScalar("SELECT fee_S014 FROM laborer_fee2 where date(fee_date) = '".$work_date."'");
		$S015 	= executeScalar("SELECT fee_S015 FROM laborer_fee2 where date(fee_date) = '".$work_date."'");
		$M01 	= executeScalar("SELECT fee_M01 FROM laborer_fee2 where date(fee_date) = '".$work_date."'");
		$M02 	= executeScalar("SELECT fee_M02 FROM laborer_fee2 where date(fee_date) = '".$work_date."'");
		$M03 	= executeScalar("SELECT fee_M03 FROM laborer_fee2 where date(fee_date) = '".$work_date."'");
		$M04 	= executeScalar("SELECT fee_M04 FROM laborer_fee2 where date(fee_date) = '".$work_date."'");

		$total	= $B001
		+$B002
		+$B003
		+$B004
		+$B005
		+$B006
		+$B007
		+$B008
		+$B009
		+$B010
		+$B011
		+$B012
		+$B013
		+$B014
		+$B015
		+$S001
		+$S002
		+$S003
		+$S004
		+$S005
		+$S006
		+$S007
		+$S008
		+$S009
		+$S010
		+$S011
		+$S012
		+$S013
		+$S014
		+$S015
		+$M01
		+$M02
		+$M03
		+$M04;
	?>
	<page_header>
    </page_header>
	<table style="width:95%; border:0px; margin-top:0px; margin-left:5px; margin-right:5px; font-size:9pt;">
		<tr>
			<td style="text-align: left; width: 50%">PISS</td>
			<td style="text-align: center; width: 5%"></td>
			<td style="text-align: right; width: 45%"><?php echo date("d-m-Y", strtotime($date)); ?></td>
		</tr>
	</table><br/>
    <div style="font-size: 12px; font-weight: bold; text-align: center; margin-top:0px; margin-bottom:5px;">
		UPAH MITRA DIBAGIKAN
	</div>
	<table style="margin-bottom: 5px;font-size:10pt;" id="tableCheckout">
		<tr><td>Tanggal Kerja	</td><td> : <?php echo date("d-m-Y", strtotime($work_date)); ?> </td></tr>
		<tr><td>Total Uang		</td><td> : <?php echo format_rupiah($total); ?> </td></tr>
	</table>
    <br/>
	<table style="border: solid 1px black; border-collapse: collapse; margin-bottom: 5px;font-size:10pt; width:300px; margin-right:0px;" id="tableNonkomoditi">
		<tr>
			<th style="text-align: left;width: 10%; border: solid 1px black; text-align:center;">No</th>
			<th style="text-align: left;width: 45%;border: solid 1px black;">Nama (Kode)</th>
			<th style="text-align: center;width: 30%;border: solid 1px black;">Jumlah</th>
			<th style="text-align: left;width: 15%; border: solid 1px black; text-align:center;">TTD</th>
		</tr>
		<tr>
			<td style="border: solid 1px black; text-align:center;">1.</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;Lukman F (B001)</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;<?php echo format_rupiah($B001); ?></td>
			<td style="border: solid 1px black; text-align:center;"><p>&nbsp;</p></td>
		</tr>
		<tr>
			<td style="border: solid 1px black; text-align:center;">2.</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;Fandelli (B002)</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;<?php echo format_rupiah($B002); ?></td>
			<td style="border: solid 1px black; text-align:center;"><p>&nbsp;</p></td>
		</tr>
		<tr>
			<td style="border: solid 1px black; text-align:center;">3.</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;M. Syaifudin (B003)</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;<?php echo format_rupiah($B003); ?></td>
			<td style="border: solid 1px black; text-align:center;"><p>&nbsp;</p></td>
		</tr>
		<tr>
			<td style="border: solid 1px black; text-align:center;">4.</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;Duwi A (B004)</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;<?php echo format_rupiah($B004); ?></td>
			<td style="border: solid 1px black; text-align:center;"><p>&nbsp;</p></td>
		</tr>
		<tr>
			<td style="border: solid 1px black; text-align:center;">5.</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;Kairul M. S (B005)</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;<?php echo format_rupiah($B005); ?></td>
			<td style="border: solid 1px black; text-align:center;"><p>&nbsp;</p></td>
		</tr>
		<tr>
			<td style="border: solid 1px black; text-align:center;">6.</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;Nanang B (B006)</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;<?php echo format_rupiah($B006); ?></td>
			<td style="border: solid 1px black; text-align:center;"><p>&nbsp;</p></td>
		</tr>
		<tr>
			<td style="border: solid 1px black; text-align:center;">7.</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;Putut S (B007)</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;<?php echo format_rupiah($B007); ?></td>
			<td style="border: solid 1px black; text-align:center;"><p>&nbsp;</p></td>
		</tr>
		<tr>
			<td style="border: solid 1px black; text-align:center;">8.</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;Abd. Muid (B008)</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;<?php echo format_rupiah($B008); ?></td>
			<td style="border: solid 1px black; text-align:center;"><p>&nbsp;</p></td>
		</tr>
		<tr>
			<td style="border: solid 1px black; text-align:center;">9.</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;Moh. Muid F (B009)</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;<?php echo format_rupiah($B009); ?></td>
			<td style="border: solid 1px black; text-align:center;"><p>&nbsp;</p></td>
		</tr>
		<tr>
			<td style="border: solid 1px black; text-align:center;">10.</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;Didik S (B010)</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;<?php echo format_rupiah($B010); ?></td>
			<td style="border: solid 1px black; text-align:center;"><p>&nbsp;</p></td>
		</tr>
		<tr>
			<td style="border: solid 1px black; text-align:center;">11.</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;Ahmad T. K (B011)</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;<?php echo format_rupiah($B011); ?></td>
			<td style="border: solid 1px black; text-align:center;"><p>&nbsp;</p></td>
		</tr>
		<tr>
			<td style="border: solid 1px black; text-align:center;">12.</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;Fathur R (B012)</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;<?php echo format_rupiah($B012); ?></td>
			<td style="border: solid 1px black; text-align:center;"><p>&nbsp;</p></td>
		</tr>
		<tr>
			<td style="border: solid 1px black; text-align:center;">13.</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;Mat Rizal (B013)</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;<?php echo format_rupiah($B013); ?></td>
			<td style="border: solid 1px black; text-align:center;"><p>&nbsp;</p></td>
		</tr>
		<tr>
			<td style="border: solid 1px black; text-align:center;">14.</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;Slamet P (B014)</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;<?php echo format_rupiah($B014); ?></td>
			<td style="border: solid 1px black; text-align:center;"><p>&nbsp;</p></td>
		</tr>
		<tr>
			<td style="border: solid 1px black; text-align:center;">15.</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;Muktarom (B015)</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;<?php echo format_rupiah($B015); ?></td>
			<td style="border: solid 1px black; text-align:center;"><p>&nbsp;</p></td>
		</tr>
		<tr>
			<td style="border: solid 1px black; text-align:center;">16.</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;M. Ali M (S001)</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;<?php echo format_rupiah($S001); ?></td>
			<td style="border: solid 1px black; text-align:center;"><p>&nbsp;</p></td>
		</tr>
		<tr>
			<td style="border: solid 1px black; text-align:center;">17.</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;Ahmad F. H (S002)</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;<?php echo format_rupiah($S002); ?></td>
			<td style="border: solid 1px black; text-align:center;"><p>&nbsp;</p></td>
		</tr>
		<tr>
			<td style="border: solid 1px black; text-align:center;">18.</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;Amirul M (S003)</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;<?php echo format_rupiah($S003); ?></td>
			<td style="border: solid 1px black; text-align:center;"><p>&nbsp;</p></td>
		</tr>
		<tr>
			<td style="border: solid 1px black; text-align:center;">19.</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;Khoirul A (S004)</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;<?php echo format_rupiah($S004); ?></td>
			<td style="border: solid 1px black; text-align:center;"><p>&nbsp;</p></td>
		</tr>
		<tr>
			<td style="border: solid 1px black; text-align:center;">20.</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;Ragil S (S005)</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;<?php echo format_rupiah($S005); ?></td>
			<td style="border: solid 1px black; text-align:center;"><p>&nbsp;</p></td>
		</tr>
		<tr>
			<td style="border: solid 1px black; text-align:center;">21.</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;Nawawi (S006)</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;<?php echo format_rupiah($S006); ?></td>
			<td style="border: solid 1px black; text-align:center;"><p>&nbsp;</p></td>
		</tr>
		<tr>
			<td style="border: solid 1px black; text-align:center;">22.</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;Muis H (S007)</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;<?php echo format_rupiah($S007); ?></td>
			<td style="border: solid 1px black; text-align:center;"><p>&nbsp;</p></td>
		</tr>
		<tr>
			<td style="border: solid 1px black; text-align:center;">23.</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;M. Hasin (S008)</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;<?php echo format_rupiah($S008); ?></td>
			<td style="border: solid 1px black; text-align:center;"><p>&nbsp;</p></td>
		</tr>
		<tr>
			<td style="border: solid 1px black; text-align:center;">24.</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;Marsono (S009)</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;<?php echo format_rupiah($S009); ?></td>
			<td style="border: solid 1px black; text-align:center;"><p>&nbsp;</p></td>
		</tr>
		<tr>
			<td style="border: solid 1px black; text-align:center;">25.</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;Seukron (S010)</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;<?php echo format_rupiah($S010); ?></td>
			<td style="border: solid 1px black; text-align:center;"><p>&nbsp;</p></td>
		</tr>
		<tr>
			<td style="border: solid 1px black; text-align:center;">26.</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;Rifai (S011)</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;<?php echo format_rupiah($S011); ?></td>
			<td style="border: solid 1px black; text-align:center;"><p>&nbsp;</p></td>
		</tr>
		<tr>
			<td style="border: solid 1px black; text-align:center;">27.</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;Rofik (S012)</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;<?php echo format_rupiah($S012); ?></td>
			<td style="border: solid 1px black; text-align:center;"><p>&nbsp;</p></td>
		</tr>
		<tr>
			<td style="border: solid 1px black; text-align:center;">28.</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;Durasid (S013)</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;<?php echo format_rupiah($S013); ?></td>
			<td style="border: solid 1px black; text-align:center;"><p>&nbsp;</p></td>
		</tr>
		<tr>
			<td style="border: solid 1px black; text-align:center;">29.</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;Deni (S014)</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;<?php echo format_rupiah($S014); ?></td>
			<td style="border: solid 1px black; text-align:center;"><p>&nbsp;</p></td>
		</tr>
		<tr>
			<td style="border: solid 1px black; text-align:center;">30.</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;Mahmud (S015)</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;<?php echo format_rupiah($S015); ?></td>
			<td style="border: solid 1px black; text-align:center;"><p>&nbsp;</p></td>
		</tr>
		<tr>
			<td style="border: solid 1px black; text-align:center;">31.</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;Darwanto (M01)</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;<?php echo format_rupiah($M01); ?></td>
			<td style="border: solid 1px black; text-align:center;"><p>&nbsp;</p></td>
		</tr>
		<tr>
			<td style="border: solid 1px black; text-align:center;">32.</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;Tri W (M02)</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;<?php echo format_rupiah($M02); ?></td>
			<td style="border: solid 1px black; text-align:center;"><p>&nbsp;</p></td>
		</tr>
		<tr>
			<td style="border: solid 1px black; text-align:center;">33.</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;Abdul R (M03)</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;<?php echo format_rupiah($M03); ?></td>
			<td style="border: solid 1px black; text-align:center;"><p>&nbsp;</p></td>
		</tr>
		<tr>
			<td style="border: solid 1px black; text-align:center;">34.</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;M. Rois (M04)</td>
			<td style="border: solid 1px black; text-align:left;">&nbsp;<?php echo format_rupiah($M04); ?></td>
			<td style="border: solid 1px black; text-align:center;"><p>&nbsp;</p></td>
		</tr>
		<tr>
			<td style="border: solid 1px black; text-align:center;" colspan="2"><b> Total</b></td>
			<td colspan="2" style="border: solid 1px black; text-align:left"><b> <?php echo format_rupiah($total); ?></b></td>
		</tr>
	</table>
	<br /><br/><br/>
    <page_footer>
	<table style="width: 95%; border: 0px black; margin-top:10px; margin-left:25px; margin-right:25px; font-size:9pt;">
		<tr>
			<td style="text-align: left;width: 35%">Manajemen</td>
			<td style="text-align: center;width: 10%"></td>
			<td style="text-align: right;width: 35%">Security </td>
		</tr>
	</table>
    </page_footer>
</page>