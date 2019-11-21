<div>
	<canvas id="BrowserChart" width="400" height="400"></canvas>
	<select id="BrowserPeriod">
		<option value="/api/analytics/browsers/7">7 天</option>
		<option value="/api/analytics/browsers/30">1 個月</option>
		<option value="/api/analytics/browsers/365">1 年</option>
	</select>
</div>
<script>
	$(function () {
        var config = {
            type: 'pie',
            data: {
                datasets: [{
                    data: [],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }],
                labels: []
            }
        }
        var pieChart = new GAapi('BrowserChart', config);
        pieChart.run('/api/analytics/browsers');

        $('#BrowserPeriod').change(function(){
            pieChart.run($(this).val());
        });
    });
</script>