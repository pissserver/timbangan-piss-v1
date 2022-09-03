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
		Data Kir Kendaraan PIOS
	</div>
    <br	/>
	<br />
	<table style="border: solid 1px black; border-collapse: collapse; margin-bottom: 5px;font-size:9pt; width:850px; margin-right:0px;" id="tableNonkomoditi">
		<tr>
			<th style="text-align: left;width: 5%; border: solid 1px black;">No</th>
			<th style="text-align: left;width: 35%; border: solid 1px black;">Plat No</th>
			<th style="text-align: left;width: 5%; border: solid 1px black;">No</th>
			<th style="text-align: left;width: 35%; border: solid 1px black;">Plat No</th>
		</tr>
		<?php
			$sql 	= "select distinct(transportation_nopol) from transportation order by transportation_nopol ";
			$data 	= mysql_query($sql);
			$no 	= 1;
			$counter = 0;
			$string	= '';
			while($r=mysql_fetch_array($data)){
				if(($counter%2)==0){
					$string = $string.'<tr><td style="text-align: left;border: solid 1px black;">'.$no.'</td>
					<td style="text-align: left;border: solid 1px black;">'.$r['transportation_nopol'].'</td>';
				}else{
					$string = $string.'<td style="text-align: left;border: solid 1px black;">'.$no.'</td>
					<td style="text-align: left;border: solid 1px black;">'.$r['transportation_nopol'].'</td></tr>';
				}
				$no++;
				$counter++;
			}
			echo $string;
			
		?>
		
	</table>
</page>