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
        mounted() {
            this.createChart();
        },
        methods: {
            createChart() {
                const canvas = this.$refs.chartLine;
                const ctx = canvas.getContext("2d");
                const gradientStroke1 = ctx.createLinearGradient(0, 230, 0, 50);

                gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
                gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
                gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');

                const chartData = {
                    labels: this.labels,
                    datasets: [{
                        label: "Mobile apps",
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: "#5e72e4",
                        backgroundColor: gradientStroke1,
                        borderWidth: 3,
                        fill: true,
                        data: this.datasets,
                        maxBarThickness: 6
                    }],
                }

                const config = {
                    type: "line",
                    data: chartData,
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
                                        family: "Open Sans",
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
                                        family: "Open Sans",
                                        style: 'normal',
                                        lineHeight: 2
                                    },
                                }
                            },
                        },
                    }
                }

                new Chart(ctx, config);
            }
        }
    }
</script>
