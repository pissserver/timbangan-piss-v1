<?php
	include "connection.php";
	
	function getDay(){
		$query 	= "select sum(weight_in) as total, 
		date_format(date_in,'%d-%m-%Y') as day_in, 
		date_format(date_in,'%Y-%m-%d') as day_in_sort 
		from weighing
		where date_in != date_out and 
		(weighing_sts != 'Batal' || weighing_sts != 'dipecah' || weighing_sts != 'Digabung')
		group by day_in order by day_in_sort desc limit 7";
		$data=mysql_query($query);
		$string="'";
		$counter=0;
		while($row=mysql_fetch_array($data)){
			if($counter!=0){
				$string="','".$string;
			}
			$string=$row['day_in'].$string;
			$counter++;
		}
		return "'".$string;
	}
	function getTotal(){
		$query 	= "select sum(weight_in) as total, 
		date_format(date_in,'%d-%m-%Y') as day_in, 
		date_format(date_in,'%Y-%m-%d') as day_in_sort 
		from weighing
		where date_in != date_out and 
		(weighing_sts != 'Batal' || weighing_sts != 'dipecah' || weighing_sts != 'Digabung')
		group by day_in order by day_in_sort desc limit 7";
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
		$(function () {
			$('#outstanding').highcharts({
				chart: {
					type: 'spline'
				},
				title: {
					text: 'Outstanding Timbangan PISS',
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
									callOutstanding(this.category);
								
									//
									/*alert(this.category+' / '+ this.x +' was last selected');
									var str = this.category;
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
					name: 'Total Outstanding',
					marker: {
						symbol: 'circle'
					},
					color: '#d9534f',
					data: [<?php echo getTotal(); ?>]

				}]
			});
		});
	})(jQuery);
</script>
<div class="panel panel-info">
	<div class="panel-body">
		<div id="outstanding" style="min-width: 400px; max-width: 900px; height: 300px; margin: 0 auto"></div>
	</div>
</div>