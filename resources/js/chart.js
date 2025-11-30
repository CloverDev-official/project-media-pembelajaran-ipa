import * as echarts from 'echarts';

let chart;

document.addEventListener('livewire:init', () => {
    Livewire.on('renderChart', ({ chartData }) => {
        const chartDom = document.getElementById('echart');
        if (!chartDom) return;

        const labels = chartData.map((item) => item.label);
        const values = chartData.map((item) => item.value);

        if (chart) {
            chart.dispose();
        }
        chart = echarts.init(chartDom);

        const option = {
            tooltip: {
                trigger: 'axis',
                axisPointer: {
                    type: 'shadow',
                },
            },
            grid: {
                left: '3%',
                right: '4%',
                bottom: '3%',
                containLabel: true,
            },
            xAxis: [
                {
                    type: 'category',
                    data: labels,
                    axisTick: {
                        alignWithLabel: true,
                    },
                },
            ],
            yAxis: [
                {
                    type: 'value',
                    min: 0,
                    max: 100,
                },
            ],
            series: [
                {
                    name: 'rata - rata',
                    type: 'bar',
                    barWidth: '60%',
                    itemStyle: {
                        color: '#3b82f6',
                        borderRadius: [6, 6, 0, 0],
                    },
                    data: values,
                },
            ],
            animationDuration: 600,
        };

        chart.setOption(option);
    });

    window.addEventListener('resize', () => {
        if (chart) chart.resize();
    });
});
