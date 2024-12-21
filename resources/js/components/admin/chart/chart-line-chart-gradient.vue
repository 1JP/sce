<template>
    <div class="chart">
        <canvas ref="lineChartgradient" class="chart-canvas" height="300"></canvas>
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
                const ctx = this.$refs.lineChartgradient.getContext("2d");

                // Gradients for each dataset
                const gradient1 = ctx.createLinearGradient(0, 0, 0, 400);
                gradient1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
                gradient1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
                gradient1.addColorStop(0, 'rgba(94, 114, 228, 0)');

                const gradient2 = ctx.createLinearGradient(0, 0, 0, 400);
                gradient2.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
                gradient2.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
                gradient2.addColorStop(0, 'rgba(94, 114, 228, 0)');

                const chartData = {
                    labels: this.labels,
                    datasets: [
                        this.datasets[0],
                        this.datasets[1],
                    ],
                };

                const config = {
                    type: "line",
                    data: chartData,
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: true,
                                labels: {
                                    color: 'rgb(255, 99, 132)'
                                }
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
                            }
                        },
                    }
                };

                new Chart(ctx, config);
            }
        }
    }
</script>