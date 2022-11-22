<?php
	include "connection.php";
	
	function getDay(){
		$query 	= "select DATE(laborer_fee_date) as date
		from laborer_fee
		group by date order by date desc limit 7";
		$data=mysql_query($query);
		$string="'";
		$counter=0;
		while($row=mysql_fetch_array($data)){
			if($counter!=0){
				$string="','".$string;
			}
			$string=$row['date'].$string;
			$counter++;
		}
		return "'".$string;
	}
	function gett06(){
		$query 	= "select sum(t06+t06_save) as total, DATE(laborer_fee_date) as date
		from laborer_fee
		group by date order by date desc limit 7";
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
	function gett14(){
		$query 	= "select sum(IFNULL(t14, 0)+IFNULL(t14_save, 0)) as total, DATE(laborer_fee_date) as date
		from laborer_fee where t14 != null and t14_save != null
		group by date order by date desc limit 7";
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
	function getmandor(){
		$query 	= "select sum(foreman+foreman_save) as total, DATE(laborer_fee_date) as date
		from laborer_fee
		group by date order by date desc limit 7";
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
					text: 'Pendapatan Mitra PISS',
					x: -20 //center
				},
				xAxis: {
					categories: [<?php echo getDay(); ?>]
				},
				yAxis: {
					min: 0,
					labels: {
						formatter: function() {
							return (Math.abs(this.value) / 1000) + ' Ribu';
						},
						style: {
							color: 'rgba(119, 119, 119, 1)'
						}
					},
					title: {
						text: ' Rupiah'
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
					valueSuffix: ' '
				},
				credits: {
					enabled: false
				},
				series: [{
					name: 'T06',
					marker: {
						symbol: 'circle'
					},
					data: [<?php echo gett06(); ?>]

				}, {
					name: 'T14',
					marker: {
						symbol: 'circle'
					},
					color: '#5cb85c',
					data: [<?php echo gett14(); ?>]
				}, {
					name: 'Mandor',
					marker: {
						symbol: 'circle'
					},
					color: '#5cb85c',
					data: [<?php echo getmandor(); ?>]
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