<div>
	<canvas id="VistorsChart" width="400" height="400"></canvas>
	<select id="VistorsPeriod">
		<option value="/api/analytics/visitors/7">7 天</option>
		<option value="/api/analytics/visitors/30">1 個月</option>
		<option value="/api/analytics/visitors/365">1 年</option>
	</select>
</div>
<script>
	$(function () {
        var config = {
            type: 'line',
            data: {
                datasets: [{
                    label: '期間人數',
                    data: [],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }],
                labels: []
            },
            options: {
                responsive: true,
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Day'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Value'
                        }
                    }]
                }
            }
        }
        var lineChart = new GAapi('VistorsChart', config);
        lineChart.run('/api/analytics/visitors');

        $('#VistorsPeriod').change(function(){
            lineChart.run($(this).val());
        });
    });

</script>