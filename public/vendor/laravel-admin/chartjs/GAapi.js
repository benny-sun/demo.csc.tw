class GAapi {
    constructor(id, config) {
        this.id = id;
        this.ctx = document.getElementById(this.id).getContext("2d");
        this.config = config;
        this.chart = new Chart(this.ctx, this.config);
        this.loading = '<div class="mask-chart"><i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i></div>';
        this.refresh = data => {
            this.config.data.labels = data[0];
            this.config.data.datasets[0].data = data[1];
            this.chart.update();
            this.fadeRemove(this.id);
        }
        this.beforeSend = () => {
            $(this.loading).insertBefore('#'+this.id);
        }
    }
    fadeRemove(id) {
        $('#'+id).prev().fadeOut(300, function() {
            $(this).remove();
        });
    }
    run(url) {
        $.ajax({
            method: 'GET',
            url: url,
            beforeSend: this.beforeSend,
            success: this.refresh
        });
    }
}