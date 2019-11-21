<div>
	<canvas id="CountriesChart" width="400" height="400"></canvas>
	<select id="CountriesPeriod">
		<option value="/api/analytics/countries/7">7 天</option>
		<option value="/api/analytics/countries/30">1 個月</option>
		<option value="/api/analytics/countries/365">1 年</option>
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
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(153, 102, 255, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }],
                labels: []
            }
        }
        var pieChart = new GAapi('CountriesChart', config);
        pieChart.run('/api/analytics/countries');

        $('#CountriesPeriod').change(function(){
            pieChart.run($(this).val());
        });
    });
</script>