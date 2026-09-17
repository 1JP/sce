<template>
    <div class="chart">
        <canvas ref="chartLine" class="chart-canvas" height="300"></canvas>
    </div>
</template>

<script>
    import { Chart, LineController, LineElement, PointElement, LinearScale, Title, CategoryScale } from "chart.js";
    Chart.register(LineController, LineElement, PointElement, LinearScale, Title, CategoryScale);

    export default {
        props: {
            labels: {
                type: Array,
                required: true,
                default: () => [],
            },
            datasets: {
                type: Array,
                required: true,
                default: () => [],
            },
        },
        data() {
            return {
                chart: null,
            };
        },
        mounted() {
            this.createChart();
        },
        watch: {
            labels: {
                deep: true,
                handler() {
                    this.refreshChart();
                }
            },
            datasets: {
                deep: true,
                handler() {
                    this.refreshChart();
                }
            }
        },
        methods: {
            refreshChart() {
                if (this.chart) {
                    this.chart.destroy();
                    this.chart = null;
                }

                this.createChart();
            },
            normalizeDatasets(datasetSource, gradientStroke1) {
                if (!Array.isArray(datasetSource) || datasetSource.length === 0) {
                    return [];
                }

                if (datasetSource.every((item) => typeof item === 'number')) {
                    return [{
                        label: 'Comments',
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: '#5e72e4',
                        backgroundColor: gradientStroke1,
                        borderWidth: 3,
                        fill: true,
                        data: datasetSource,
                        maxBarThickness: 6,
                    }];
                }

                if (datasetSource.every((item) => item && typeof item === 'object' && !Array.isArray(item))) {
                    return datasetSource.map((dataset) => {
                        const color = dataset.borderColor || '#5e72e4';

                        return {
                            label: dataset.label || 'Dataset',
                            data: Array.isArray(dataset.data) ? dataset.data : [],
                            borderColor: color,
                            backgroundColor: dataset.backgroundColor || gradientStroke1,
                            tension: dataset.tension ?? 0.4,
                            borderWidth: dataset.borderWidth ?? 3,
                            pointRadius: dataset.pointRadius ?? 0,
                            fill: dataset.fill ?? true,
                            maxBarThickness: dataset.maxBarThickness ?? 6,
                        };
                    });
                }

                return [];
            },
            createChart() {
                if (!this.$refs.chartLine || !Array.isArray(this.labels) || !Array.isArray(this.datasets)) {
                    return;
                }

                const canvas = this.$refs.chartLine;
                const ctx = canvas.getContext('2d');
                if (!ctx) {
                    return;
                }

                const gradientStroke1 = ctx.createLinearGradient(0, 230, 0, 50);
                gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
                gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
                gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');

                const datasets = this.normalizeDatasets(this.datasets, gradientStroke1);
                if (!datasets.length) {
                    return;
                }

                const config = {
                    type: 'line',
                    data: {
                        labels: this.labels,
                        datasets,
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false,
                            }
                        },
                        interaction: {
                            intersect: false,
                            mode: 'index',
                        },
                        scales: {
                            y: {
                                grid: {
                                    drawBorder: false,
                                    display: true,
                                    drawOnChartArea: true,
                                    drawTicks: false,
                                    borderDash: [5, 5]
                                },
                                ticks: {
                                    display: true,
                                    padding: 10,
                                    color: '#fbfbfb',
                                    font: {
                                        size: 11,
                                        family: 'Open Sans',
                                        style: 'normal',
                                        lineHeight: 2
                                    },
                                }
                            },
                            x: {
                                grid: {
                                    drawBorder: false,
                                    display: false,
                                    drawOnChartArea: false,
                                    drawTicks: false,
                                    borderDash: [5, 5]
                                },
                                ticks: {
                                    display: true,
                                    color: '#ccc',
                                    padding: 20,
                                    font: {
                                        size: 11,
                                        family: 'Open Sans',
                                        style: 'normal',
                                        lineHeight: 2
                                    },
                                }
                            },
                        },
                    }
                }

                this.chart = new Chart(ctx, config);
            }
        }
    }
</script>
