<?php
include "../public/header.php";
//phpinfo();
?>

<?php 
	$url = 'http://api.k780.com:88/?app=weather.today&weaid=101110101&&appkey=10003&sign=b59bc3ef6191eb9f747dd4e83c99f2a4&format=json';
    $result = file_get_contents($url);
    $jsonArray = json_decode($result);
    $nowtemp  = $jsonArray->result->temperature_curr;
    
	$url = 'http://api.k780.com:88/?app=weather.future&weaid=101110101&&appkey=10003&sign=b59bc3ef6191eb9f747dd4e83c99f2a4&format=json';
	$result = file_get_contents($url);
	$jsonArray = json_decode($result);
?>
<!DOCTYPE html>
<html>
<body>
<div style="padding:0% 8% 0%">
	<style>
	.chart {
		height: 200px;
		margin: 0px;
		/*padding: 0px;*/
		/*margin-left: 20%;
		margin-right: 20%;*/
		width: 70%;
	}
	h5 {
		margin-top: 30px;
		font-weight: bold;
	}
	h5:first-child {
		margin-top: 15px;
	}
</style>


		<!--<header class="mui-bar mui-bar-nav">-->
			<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
		
		<h2 class="mui-title">未来一周温度趋势！</h2>
        <h3 class="mui-title"><?php echo '西安当前温度：'.$nowtemp;?></h3>
        <br />
		
		<!--</header>-->
		<div class="mui-content">
			
			<div class="mui-content-padded">
				<div class="chart" id="lineChart"></div>
			</div>
		</div>
		<script src="../js/echarts-all.js"></script>
		
		<script>
			var getOption = function(chartType) {
				var chartOption = chartType == 'pie' ? {}:{
					legend: {
						data: ['最高温度', '最低温度']
					},
					grid: {
						x: 35,
						x2: 10,
						y: 30,
						y2: 25
					},
					toolbox: {
						show: true,
						feature: {
							mark: {
								show: true
							},
							dataView: {
								show: true,
								readOnly: false
							},
							magicType: {
								show: true,
								type: ['line', 'bar']
							},
							restore: {
								show: true
							},
							saveAsImage: {
								show: true
							}
						}
					},
					calculable: false,
					xAxis: [{
						type: 'category',
						data: [<?php for($i=0;$i<6;$i++){echo "'";echo $jsonArray->result[$i]->week;echo "',";} ?>]
					}],
					yAxis: [{
						type: 'value',
						splitArea: {
							show: true
						}
					}],
					series: [{
						itemStyle:{ 
                            normal:{ 
                                label:{ 
                                   show: true, 
                                   formatter: '{c}' 
                                }, 
                                labelLine :{show:true}
                            } 
                        } ,
						name: '最高温度',
						type: chartType,
						data: [<?php for($i=0;$i<6;$i++){echo $jsonArray->result[$i]->temp_high;echo ',';} ?>]
					}, {
						itemStyle:{ 
                            normal:{ 
                                label:{ 
                                   show: true, 
                                   formatter: '{c}' 
                                }, 
                                labelLine :{show:true}
                            } 
                        } ,
						name: '最低温度',
						type: chartType,
						data: [<?php for($i=0;$i<6;$i++){echo $jsonArray->result[$i]->temp_low;echo ',';} ?>]
					}]
				};
				return chartOption;
			};
			var byId = function(id) {
				return document.getElementById(id);
			};
			
			var lineChart = echarts.init(byId('lineChart'));
			lineChart.setOption(getOption('line'));
			
			byId("echarts").addEventListener('tap',function(){
				var url = this.getAttribute('data-url');
				plus.runtime.openURL(url);
			},false);
		</script>
    <h3>
        <?php 
            $url = 'http://api.k780.com:88/?app=weather.future&weaid=101110101&&appkey=10003&sign=b59bc3ef6191eb9f747dd4e83c99f2a4&format=json';
            $result = file_get_contents($url);
            $jsonArray = json_decode($result);

            for ($i=0;$i<6;$i++)
            {
                echo $jsonArray->result[$i]->days;
                echo '</br></br>';
                echo $jsonArray->result[$i]->week;
                echo '</br></br>';
                echo '预计温度：' . $jsonArray->result[$i]->temperature;
                echo '</br></br>';
                echo '天气情况：' . $jsonArray->result[$i]->weather;
                echo '</br></br>';
                echo '<img src="'.($jsonArray->result[$i]->weather_icon).'" width="50" height="50"/>';
            }
        ?>
        <!--<img src="" width="200" height="200"/>-->
    </h3>
</div>
</body>
</html>
<?php include '../public/footer.php';?>
