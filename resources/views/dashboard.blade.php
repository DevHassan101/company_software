<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 border-b border-gray-200">
            {{ __('You are logged in!') }}
        </div>
    </div>

    <div class="grid sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-6 mt-6 capitalize">
        <div class="bg-white overflow-hidden shadow-lg rounded-xl">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-semibold text-gray-800">Total Projects</h3>
                </div>
                <p class="text-5xl font-bold text-indigo-700 leading-tight">{{ $projectCount }}</p>
                <p class="text-sm text-gray-500 mt-2">List of number of projects.</p>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-lg rounded-xl">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-semibold text-gray-800">Total Clients</h3>
                </div>
                <p class="text-5xl font-bold text-indigo-700 leading-tight">{{ $clientCount }}</p>
                <p class="text-sm text-gray-500 mt-2">List of number of Clients.</p>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-lg rounded-xl">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-semibold text-gray-800">Total Users</h3>
                </div>
                <p class="text-5xl font-bold text-indigo-700 leading-tight">{{ $userCount }}</p>
                <p class="text-sm text-gray-500 mt-2">List of number of Users.</p>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-lg rounded-xl">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-semibold text-gray-800">expenses</h3>
                </div>
                <p class="text-5xl font-bold text-indigo-700 leading-tight">{{ round($expenses) }}</p>
                <p class="text-sm text-gray-500 mt-2">List of number of expenses.</p>
            </div>
        </div>
        <div class="bg-white overflow-hidden shadow-lg rounded-xl">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-semibold text-gray-800">Salaries</h3>
                </div>
                <p class="text-5xl font-bold text-indigo-700 leading-tight">{{ round($salary) }}</p>
                <p class="text-sm text-gray-500 mt-2">List of number of incomes.</p>
            </div>
        </div>
        <div class="bg-white overflow-hidden shadow-lg rounded-xl">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-semibold text-gray-800">amounts</h3>
                </div>
                <p class="text-5xl font-bold text-indigo-700 leading-tight">{{ round($amount) }}</p>
                <p class="text-sm text-gray-500 mt-2">List of number of amounts.</p>
            </div>
        </div>
    </div>

    <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6 mt-6">
        <div class="bg-white rounded-xl shadow-md border border-gray-200">
            <canvas id="myBarChart"></canvas>
        </div>

        <div class="bg-white rounded-xl shadow-md border border-gray-200">
            <div style="position: relative; height: 400px; width: 100%; padding:12px;">
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>

    <div class="grid sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-6 mt-6">
        <div class="bg-white rounded-xl shadow-md border border-gray-200">
            <div style="position: relative;  width: 100%; padding:12px;">
                <canvas id="myLineChart"></canvas>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const canvas = document.getElementById('myChart');
            if (!canvas || typeof Chart === 'undefined' || typeof ChartDataLabels === 'undefined') {
                console.error('Chart or canvas or plugin missing');
                return;
            }
            const actualData = {
                pending: {{ $pending ?? 0 }},
                ongoing: {{ $ongoing ?? 0 }},
                delivered: {{ $delivered ?? 0 }},
                continued: {{ $continued ?? 0 }}
            };

            const labels = Object.keys(actualData);
            const dataValues = Object.values(actualData);
            const colors = ["#00aba9", "#2b5797", "#b91d47", "#5cb85c"];

            const ctx = canvas.getContext('2d');
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{
                        data: dataValues,
                        backgroundColor: colors,
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '70%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                generateLabels: (chart) => {
                                    const data = chart.data.datasets[0].data;
                                    return labels.map((label, i) => ({
                                        text: `${label}: ${data[i]}`,
                                        fillStyle: colors[i],
                                        hidden: false
                                    }));
                                }
                            }
                        },
                        title: {
                            display: true,
                            text: 'Status Overview',
                            font: {
                                size: 16
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(ctx) {
                                    const value = ctx.parsed;
                                    return `${labels[ctx.dataIndex]}: ${value}`;
                                }
                            }
                        },
                        datalabels: {
                            formatter: (value, ctx) => {
                                return value > 0 ? value : '';
                            },
                            color: '#fff',
                            font: {
                                weight: 'bold',
                                size: 14
                            }
                        }
                    }
                },
                plugins: [ChartDataLabels]
            });
        });

        const bar = document.getElementById('myBarChart').getContext('2d');
        const labels = @json($labels);
        const expensesData = @json($expensesData);
        const paymentsData = @json($paymentsData);

        new Chart(bar, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                        label: 'Monthly Expenses',
                        data: expensesData,
                        backgroundColor: 'rgba(255, 99, 132, 0.5)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Monthly Payments',
                        data: paymentsData,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const labels = @json($projectlabels);
            const data = @json($projectdata);

            const line = document.getElementById('myLineChart').getContext('2d');
            new Chart(line, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Number of Projects',
                        data: data,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderWidth: 1,
                        tension: 0.1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>

</x-app-layout>
