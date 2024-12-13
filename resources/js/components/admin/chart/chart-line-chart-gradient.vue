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
                gradient1.addColorStop(0, "rgba(255, 99, 132, 0.5)");
                gradient1.addColorStop(1, "rgba(255, 99, 132, 0)");

                const gradient2 = ctx.createLinearGradient(0, 0, 0, 400);
                gradient2.addColorStop(0, "rgba(54, 162, 235, 0.5)");
                gradient2.addColorStop(1, "rgba(54, 162, 235, 0)");

                const chartData = {
                    labels: this.labels,
                    datasets: [
                        {
                            label: "Dataset 1",
                            data: this.datasets[0],
                            borderColor: "rgba(255, 99, 132, 1)",
                            backgroundColor: gradient1,
                            fill: true,
                        },
                        {
                            label: "Dataset 2",
                            data: this.datasets[1],
                            borderColor: "rgba(54, 162, 235, 1)",
                            backgroundColor: gradient2,
                            fill: true,
                        },
                    ],
                };

                const config = {
                    type: "line",
                    data: chartData,
                    options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: "top",
                        },
                        title: {
                            display: true,
                            text: "Line Chart with Gradients",
                        },
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                    },
                    },
                };

                new Chart(ctx, config);
            }
        }
    }
</script>