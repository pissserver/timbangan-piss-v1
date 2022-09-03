<?php
	include "../connection.php";
	
	function getDay(){
		$query 	= mysql_query("select sum(w.netto) as total, l.block_id as block
					from weighing w, rent r, lapak l
					where w.merchant_id = r.merchant_id and
					r.lapak_id = l.lapak_id and
					(w.weighing_sts = 'Keluar' || w.weighing_sts = 'Lunas')
					group by block order by block desc");
					//w.date_out = '".$date_now."'
		$string="'";
		$counter=0;
		while($row=mysql_fetch_array($query)){
			if($counter!=0){
				$string="','".$string;
			}
			$string=$row['block'].$string;
			$counter++;
		}
		return "'".$string;
	}
	function getTotal(){
		$query 	= mysql_query("select sum(w.netto) as total, l.block_id as block
					from weighing w, rent r, lapak l
					where w.merchant_id = r.merchant_id and
					r.lapak_id = l.lapak_id and
					(w.weighing_sts = 'Keluar' || w.weighing_sts = 'Lunas')
					group by block order by block desc");
					//w.date_out = '".$date_now."'
		$string="";
		$counter=0;
		while($row=mysql_fetch_array($query)){
			if($counter!=0){
				$string=",".$string;
			}
			$string=$row['total'].$string;
			$counter++;
		}
		return "".$string;
	}
?>
<script type="text/javascript">
	(function($){ // encapsulate jQuery
		$(function () {
			$('#omzetBlock').highcharts({
				chart: {
					type: 'spline'
				},
				title: {
					text: 'Tonase Per Blok PIOS',
					x: -20 //center
				},
				xAxis: {
					categories: [<?php echo getDay(); ?>]
				},
				yAxis: {
					min: 0,
					labels: {
						formatter: function() {
							return (Math.abs(this.value) / 1000) + ' Ton';
						},
						style: {
							color: 'rgba(119, 119, 119, 1)'
						}
					},
					title: {
						text: ' Ton'
						//enabled : false
					}
				},
				plotOptions: {
					line: {
						dataLabels: {
							enabled: false
						},
						enableMouseTracking: true
					},
					column: {
						dataLabels: {
							enabled: false
						},
						enableMouseTracking: true,
						pointWidth: 20
					},
					series: {
						allowPointSelect: true,
						point: {
							events: {
								click: function() {
									//alert(this.category+' / '+ this.x +' was last selected');
									callTonase(this.category);
									/*var str = this.category;
									//nres = (this.category).substring(2, 2);
									var x = str.substring(1,3);
									callDetailDay(x);
									//alert(x);*/
									
									/*var str = this.category;
									var day = str.substring(1,11);
									callDaySales(this.category);*/
								}
							}
						}
					}
				},
				legend: {
					layout: 'vertical',
					align: 'right',
					verticalAlign: 'top',
					x: -3,
					y: 15,
					floating: true,
					borderWidth: 1,
					backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
					shadow: true
				},
				tooltip: {
					crosshairs: true,
					shared: true,
					valueSuffix: ' Ton'
				},
				credits: {
					enabled: false
				},
				series: [{
					name: 'Total Tonase',
					marker: {
						symbol: 'circle'
					},
					data: [<?php echo getTotal(); ?>]

				}]
			});
		});
	})(jQuery);
</script>
<div class="panel panel-primary">
	<div class="panel-body">
		<div id="omzetBlock" style="max-width: 1000px; height: 300px; margin: 0 auto"></div>
	</div>
</div>