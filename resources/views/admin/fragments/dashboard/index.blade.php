<div class="row">
    <div class="col-md-6 col-lg-3">
        <div class="widget-small primary coloured-icon"><i class="icon bi bi-people fs-1"></i>
            <div class="info">
                <h6>Usuarios</h6>
                <p><b>{{ $user_count }}</b></p>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="widget-small info coloured-icon"><i class="icon bi bi-list fs-1"></i>
            <div class="info">
                <h6>Examen</h6>
                <p><b>{{ $survey_count }}</b></p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="widget-small warning coloured-icon"><i class="icon bi bi-folder2 fs-1"></i>
            <div class="info">
                <h6>Respuestas</h6>
                <p><b>{{ $survey_person_count }}</b></p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="widget-small danger coloured-icon"><i class="icon bi bi-star fs-1"></i>
            <div class="info">
                <h6>Logins</h6>
                <p><b>{{ $session_history_count }}</b></p>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="tile">
            <h3 class="tile-title">Weekly Sales - Last week</h3>
            <div class="ratio ratio-16x9">
                <div id="salesChart"></div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="tile">
            <h3 class="tile-title">Support Requests</h3>
            <div class="ratio ratio-16x9">
                <div id="supportRequestChart"></div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    const salesData = {
        xAxis: {
            type: 'category',
            data: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
        },
        yAxis: {
            type: 'value',
            axisLabel: {
                formatter: '${value}'
            }
        },
        series: [{
            data: [150, 230, 224, 218, 135, 147, 260],
            type: 'line',
            smooth: true
        }],
        tooltip: {
            trigger: 'axis',
            formatter: "<b>{b0}:</b> ${c0}"
        }
    }

    const supportRequests = {
        tooltip: {
            trigger: 'item'
        },
        legend: {
            orient: 'vertical',
            left: 'left'
        },
        series: [{
            name: 'Support Requests',
            type: 'pie',
            radius: '50%',
            data: [{
                    value: 300,
                    name: 'In Progress'
                },
                {
                    value: 50,
                    name: 'Delayed'
                },
                {
                    value: 100,
                    name: 'Complete'
                }
            ],
            emphasis: {
                itemStyle: {
                    shadowBlur: 10,
                    shadowOffsetX: 0,
                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                }
            }
        }]
    };

    const salesChartElement = document.getElementById('salesChart');
    const salesChart = echarts.init(salesChartElement, null, {
        renderer: 'svg'
    });
    salesChart.setOption(salesData);
    new ResizeObserver(() => salesChart.resize()).observe(salesChartElement);

    const supportChartElement = document.getElementById("supportRequestChart")
    const supportChart = echarts.init(supportChartElement, null, {
        renderer: 'svg'
    });
    supportChart.setOption(supportRequests);
    new ResizeObserver(() => supportChart.resize()).observe(supportChartElement);
</script>
