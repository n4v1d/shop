<?php
$id = $_POST['id'];
require 'autoload.php';
$graph = new graph();
require 'lib/jdf.php';
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<style>
		body, html {
			font-size: 100%;
			padding: 0;
			margin: 0;
		}
		.highcharts-tooltip{
		direction:rtl;
		}
		body{
			font-family: Tahoma, Calibri, Arial, sans-serif;
			background:#333;
		}

		.alimir-top {
			background: #566472;
			background: rgba(255, 255, 255, 0.2);
			text-transform: uppercase;
			width: 100%;
			font-size: 0.69em;
			line-height: 2.2;
		}

		.alimir-top a {
			padding: 0 1em;
			letter-spacing: 0.1em;
			color: #fff;
			display: inline-block;
		}

		.alimir-top a:hover {
			background: rgba(255,255,255,0.8);
			color: #2c3e50;
		}

		.alimir-top span.right {
			float: right;
		}

		.alimir-top span.right a {
			float: left;
			display: block;
		}
		</style>
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript">
		$(function () {
				Highcharts.setOptions({
					chart: {
						style: {
							fontSize: '12px',
							fontFamily: 'Tahoma',
							textAlign:'right'
						}
					}
				});
				$('#container').highcharts({
					credits: {
						enabled: true
					},
					title: {
						text: 'نمودار تغییر قیمت محصول',
						x: -20,
						style: {
							fontWeight: 'bold'
						}
					},
					subtitle: {
						text: 'سیستم مدیریت خرید نوید',
						x: -20
					},
					xAxis: {
						categories: [<?php echo $graph->getProductfactorId($id); ?>]
					},
					yAxis: {
						title: {
							text: 'قیمت به تومان'
						},
						plotLines: [{
							value: 0,
							width: 1,
							color: '#898080'
						}]
					},
					legend: {
						rtl: true
					},
					tooltip: {
					valueSuffix: ' تومان ',
					crosshairs: true,
					shared: true,
					useHTML: true
					},
                    series: [{
                        data: [<?php echo $graph->getProductGraphData($id); ?> ],
                        name: 'قیمت حرید کالا'
                    },{
                        data: [<?php echo $graph->getProductForoshGraphData($id); ?> ],
                        name: 'قیمت فروش کالا'
                    }
                    ,
            {
                data: [<?php echo $graph->getProductMasrafGraphData($id); ?> ],
                    name: 'قیمت مصرف کالا'
            }]
        ,
				});
			});
		</script>
</head>
	<body>
		<div class="alimir-top ">
		</div>

		<script src="js/highcharts.js"></script>
		<script src="js/exporting.js"></script>

		<div id="container" style="max-width: 860px; height: 400px; margin: 50px auto"></div>
	</body>
</html>