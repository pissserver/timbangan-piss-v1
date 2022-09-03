<?php
	include "../connection.php";
	
	function getDay(){
		$query 	= "select sum(netto) as total, 
		date_format(date_out,'%d-%m-%Y') as day_out, 
		date_format(date_out,'%Y-%m-%d') as day_out_sort 
		from weighing
		where (weighing_sts = 'Keluar' || weighing_sts = 'Lunas') and
		date_out is not null
		group by day_out order by day_out_sort desc limit 7";
		$data=mysql_query($query);
		$string="'";
		$counter=0;
		while($row=mysql_fetch_array($data)){
			if($counter!=0){
				$string="','".$string;
			}
			$string=$row['day_out'].$string;
			$counter++;
		}
		return "'".$string;
	}
	function getTotal(){
		$query 	= "select sum(netto) as total, DATE(date_out) as date
					from weighing where  
					(weighing_sts = 'Keluar' || weighing_sts = 'Lunas') and
					date_out is not null
					group by date desc limit 7";
		$data=mysql_query($query);
		$string="";
		$counter=0;
		while($row=mysql_fetch_array($data)){
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
		$(function(){
			$('#revenue').highcharts({
				chart: {
					type: 'spline'
				},
				title: {
					text: 'Tonase TImbangan PIOS',
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
					valueSuffix: ' Kg'
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
<div class="panel panel-info">
	<div class="panel-body">
		<div id="revenue" style="max-width: 1000px; height: 300px; margin: 0 auto"></div>
	</div>
</div>