<div>
	<canvas id="NewOrReturnUserChart" width="400" height="400"></canvas>
	<select id="NewOrReturnUserPeriod">
		<option value="/api/analytics/user/7">7 天</option>
		<option value="/api/analytics/user/30">1 個月</option>
		<option value="/api/analytics/user/365">1 年</option>
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
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    borderWidth: 1
                }],
                labels: []
            }
        }
        var pieChart = new GAapi('NewOrReturnUserChart', config);
        pieChart.run('/api/analytics/user');

        $('#NewOrReturnUserPeriod').change(function(){
            pieChart.run($(this).val());
        });
    });
</script>