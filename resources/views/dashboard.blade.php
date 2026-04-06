<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>

    <div>
        {{-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex justify-between items-center">
            <div class="p-6 border-b border-gray-200">
                {{ __('You are logged in!') }}
            </div>

            <div class="flex justify-between items-center mx-8">
                <div class="flex items-center gap-2">
                    <select name="filter" id="allFilter" class="form-control">
                        <option value="">Select One</option>
                        <option value="today" {{ request('filter') == 'today' ? 'selected' : '' }}>today</option>
                        <option value="this_week" {{ request('filter') == 'this_week' ? 'selected' : '' }}>this week
                        </option>
                        <option value="this_month" {{ request('filter') == 'this_month' ? 'selected' : '' }}>this
                            month
                        </option>
                        <option value="this_year" {{ request('filter') == 'this_year' ? 'selected' : '' }}>this year
                        </option>
                        <option value="last_year" {{ request('filter') == 'last_year' ? 'selected' : '' }}>last year
                        </option>
                    </select>
                </div>
            </div>
        </div> --}}

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center p-6 border-b border-gray-200">
                <div class="text-base sm:text-lg lg:text-xl">
                    {{ __('You are logged in!') }}
                </div>
                <div class="mt-4 sm:mt-0">
                    <div class="flex items-center gap-2">
                        <select name="filter" id="allFilter"
                            class="form-select w-full sm:w-auto mt-1 sm:mt-0 py-2 px-3 border border-gray-900 rounded-md shadow-sm">
                            <option value="">Select One</option>
                            <option value="today" {{ request('filter') == 'today' ? 'selected' : '' }}>today</option>
                            <option value="this_week" {{ request('filter') == 'this_week' ? 'selected' : '' }}>this week
                            </option>
                            <option value="this_month" {{ request('filter') == 'this_month' ? 'selected' : '' }}>this
                                month</option>
                            <option value="this_year" {{ request('filter') == 'this_year' ? 'selected' : '' }}>this year
                            </option>
                            <option value="last_year" {{ request('filter') == 'last_year' ? 'selected' : '' }}>last year
                            </option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-6 mt-6 capitalize">
            <div class="bg-white overflow-hidden shadow-lg rounded-xl">
                <div class="my-4">
                    <div class="flex items-center justify-between mb-4">
                        <div class="ms-6">
                            <h3 class="text-xl font-semibold text-gray-800">Total Projects</h3>
                        </div>
                        <div>
                            <div class="flex justify-between items-center mx-8">
                                <div class="flex items-center gap-2">
                                    <select id="projectFilterSelect" class="form-control">
                                        <option value="">Select One</option>
                                        <option value="today">Today</option>
                                        <option value="this_week">This Week</option>
                                        <option value="this_month">This Month</option>
                                        <option value="this_year">This Year</option>
                                        <option value="last_year">Last Year</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="ms-6">
                        <p class="text-5xl font-bold text-indigo-700 leading-tight" id="projectCount">
                            {{ $projectCount }}</p>
                        <p class="text-sm text-gray-500 mt-2">List of number of projects.</p>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-lg rounded-xl">
                <div class="my-4">
                    <div class="flex items-center justify-between mb-4">
                        <div class="ms-6">
                            <h3 class="text-xl font-semibold text-gray-800">Total Clients</h3>
                        </div>
                        <div>
                            <div class="flex justify-between items-center mx-8">
                                <div class="flex items-center gap-2">
                                    <select id="clientFilterSelect" class="form-control">
                                        <option value="">Select One</option>
                                        <option value="today">Today</option>
                                        <option value="this_week">This Week</option>
                                        <option value="this_month">This Month</option>
                                        <option value="this_year">This Year</option>
                                        <option value="last_year">Last Year</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ms-6">
                        <p class="text-5xl font-bold text-indigo-700 leading-tight" id="clientCount">{{ $clientCount }}
                        </p>
                        <p class="text-sm text-gray-500 mt-2">List of number of Clients.</p>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-lg rounded-xl">
                <div class="my-4">
                    <div class="flex items-center justify-between mb-4">
                        <div class="ms-6">
                            <h3 class="text-xl font-semibold text-gray-800">Total Users</h3>
                        </div>
                        <div>
                            <div class="flex justify-between items-center mx-8">
                                <select id="UserFilterSelect" class="form-control">
                                    <option value="">Select One</option>
                                    <option value="today">Today</option>
                                    <option value="this_week">This Week</option>
                                    <option value="this_month">This Month</option>
                                    <option value="this_year">This Year</option>
                                    <option value="last_year">Last Year</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="ms-6">
                        <p class="text-5xl font-bold text-indigo-700 leading-tight" id="userCount">{{ $userCount }}
                        </p>
                        <p class="text-sm text-gray-500 mt-2">List of number of Users.</p>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-lg rounded-xl">
                <div class="my-4">
                    <div class="flex items-center justify-between mb-4">
                        <div class="ms-6">
                            <h3 class="text-xl font-semibold text-gray-800 capitalize">total amount</h3>
                        </div>
                        <div>
                            <div class="flex justify-between items-center mx-8">
                                <div class="flex items-center gap-2">
                                    <select id="ExpenseFilterSelect" class="form-control">
                                        <option value="">Select One</option>
                                        <option value="today">Today</option>
                                        <option value="this_week">This Week</option>
                                        <option value="this_month">This Month</option>
                                        <option value="this_year">This Year</option>
                                        <option value="last_year">Last Year</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ms-6">
                        <p class="text-5xl font-bold text-indigo-700 leading-tight" id="expenseCount">
                            {{ round($expenses) }}</p>
                        <p class="text-sm text-gray-500 mt-2">List of total amounts.</p>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-lg rounded-xl">
                <div class="my-4">
                    <div class="flex items-center justify-between mb-4">
                        <div class="ms-6">
                            <h3 class="text-xl font-semibold text-gray-800 capitalize">Total Salary</h3>
                        </div>
                        <div>
                            <div class="flex justify-between items-center mx-8">
                                <div class="flex items-center gap-2">
                                    <select id="SalaryFilterSelect" class="form-control">
                                        <option value="">Select One</option>
                                        <option value="today">Today</option>
                                        <option value="this_week">This Week</option>
                                        <option value="this_month">This Month</option>
                                        <option value="this_year">This Year</option>
                                        <option value="last_year">Last Year</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ms-6">
                        <p class="text-5xl font-bold text-indigo-700 leading-tight" id="salaryCount">
                            {{ round($salary) }}
                        </p>
                        <p class="text-sm text-gray-500 mt-2">Total salary expenses.</p>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-lg rounded-xl">
                <div class="my-4">
                    <div class="flex items-center justify-between mb-4">
                        <div class="ms-6">
                            <h3 class="text-xl font-semibold text-gray-800 capitalize">Remain Amount</h3>
                        </div>
                        <div>
                            <div class="flex justify-between items-center mx-8">
                                <select id="RemainFilterSelect" class="form-control">
                                    <option value="">Select One</option>
                                    <option value="today">Today</option>
                                    <option value="this_week">This Week</option>
                                    <option value="this_month">This Month</option>
                                    <option value="this_year">This Year</option>
                                    <option value="last_year">Last Year</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="ms-6">
                        <p class="text-5xl font-bold text-indigo-700 leading-tight" id="remainAmount">
                            {{ $amount }}
                        </p>
                        <p class="text-sm text-gray-500 mt-2">Remaining amount (Expenses - Salary).</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid sm:grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <div class="bg-white rounded-xl shadow-md border border-gray-200 overflow-x-auto">
                <div class="flex justify-between items-center mx-8 mt-4">
                    <div class="capitalize">
                        <span>payment overview</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <select id="barChart" class="form-control">
                            <option value="">Select One</option>
                            <option value="today" {{ request('payment') == 'today' ? 'selected' : '' }}>today
                            </option>
                            <option value="this_week" {{ request('payment') == 'this_week' ? 'selected' : '' }}>
                                this
                                week</option>
                            <option value="this_month" {{ request('payment') == 'this_month' ? 'selected' : '' }}>
                                this
                                month</option>
                            <option value="this_year" {{ request('payment') == 'this_year' ? 'selected' : '' }}>
                                this
                                year</option>
                            <option value="last_year" {{ request('payment') == 'last_year' ? 'selected' : '' }}>
                                last
                                year</option>
                        </select>
                    </div>
                </div>
                <div class="p-2 sm:p-4">
                    <canvas id="myBarChart" class="w-full"></canvas>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md border border-gray-200 overflow-x-auto">
                <div class="flex justify-between items-center mx-8 mt-4">
                    <div class="capitalize">
                        <span>status overview</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <select name="option" id="statusOverview" class="form-control">
                            <option value="">Select One</option>
                            <option value="today" {{ request('option') == 'today' ? 'selected' : '' }}>today
                            </option>
                            <option value="this_week" {{ request('option') == 'this_week' ? 'selected' : '' }}>
                                this
                                week</option>
                            <option value="this_month" {{ request('option') == 'this_month' ? 'selected' : '' }}>
                                this
                                month</option>
                            <option value="this_year" {{ request('option') == 'this_year' ? 'selected' : '' }}>
                                this
                                year</option>
                            <option value="last_year" {{ request('option') == 'last_year' ? 'selected' : '' }}>
                                last
                                year</option>
                        </select>
                    </div>
                </div>
                <div class="p-2 sm:p-4" style="height:400px;">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>

        <div class="mt-6">
            <div class="bg-white rounded-xl shadow-md border border-gray-200 overflow-x-auto">
                <div class="flex justify-between items-center mx-8 mt-4">
                    <div class="capitalize">
                        <span>Project overview</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <select name="option" id="lineChartFilter" class="form-control">
                            <option value="">Select One</option>
                            <option value="today" {{ request('option') == 'today' ? 'selected' : '' }}>today</option>
                            <option value="this_week" {{ request('option') == 'this_week' ? 'selected' : '' }}>this
                                week</option>
                            <option value="this_month" {{ request('option') == 'this_month' ? 'selected' : '' }}>this
                                month</option>
                            <option value="this_year" {{ request('option') == 'this_year' ? 'selected' : '' }}>this
                                year</option>
                            <option value="last_year" {{ request('option') == 'last_year' ? 'selected' : '' }}>last
                                year</option>
                        </select>
                    </div>
                </div>
                <div class="p-2 sm:p-4">
                    <canvas id="myLineChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
        let myStatusChart, myBarChart, myLineChart;

        document.addEventListener("DOMContentLoaded", function() {
            const canvas = document.getElementById('myChart');
            if (!canvas || typeof Chart === 'undefined' || typeof ChartDataLabels === 'undefined') {
                console.error('Chart.js or plugin missing');
                return;
            }

            const statusCounts = @json($statusCounts);
            const labels = Object.keys(statusCounts);
            const dataValues = Object.values(statusCounts);
            const colors = ["#00aba9", "#2b5797", "#b91d47", "#5cb85c"];

            const ctx = canvas.getContext('2d');
            myStatusChart = new Chart(ctx, {
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
                        tooltip: {
                            callbacks: {
                                label: function(ctx) {
                                    const value = ctx.parsed;
                                    return `${labels[ctx.dataIndex]}: ${value}`;
                                }
                            }
                        },
                        datalabels: {
                            formatter: (value) => value > 0 ? value : '',
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

            $('#statusOverview').on('change', function() {
                var selectedValue = $(this).val();
                if (selectedValue) {
                    $.ajax({
                        url: '{{ route('dashboard.status-data') }}',
                        type: "GET",
                        data: {
                            filter: selectedValue
                        },
                        success: function(response) {
                            if (myStatusChart) {
                                myStatusChart.data.labels = response.labels;
                                myStatusChart.data.datasets[0].data = response.data;
                                myStatusChart.update();
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("Error filtering status chart:", error);
                        }
                    });
                }
            });
        });

        $(document).ready(function() {
            const bar = document.getElementById('myBarChart').getContext('2d');
            const labels = @json($labels);
            const expensesData = @json($expensesData);
            const paymentsData = @json($paymentsData);

            myBarChart = new Chart(bar, {
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
                    },
                    plugins: {
                        legend: {
                            align: 'start'
                        }
                    }
                }
            });

            $('#barChart').on('change', function() {
                var selectedValue = $(this).val();
                if (selectedValue) {
                    $.ajax({
                        url: '{{ route('dashboard.chart-data') }}',
                        type: 'GET',
                        data: {
                            filter: selectedValue
                        },
                        success: function(response) {
                            if (myBarChart) {
                                myBarChart.data.labels = response.labels;
                                myBarChart.data.datasets[0].data = response.expensesData;
                                myBarChart.data.datasets[1].data = response.paymentsData;
                                myBarChart.update();
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("Error filtering bar chart:", error);
                        }
                    });
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const labels = @json($projectlabels);
            const data = @json($projectdata);
            const line = document.getElementById('myLineChart').getContext('2d');

            myLineChart = new Chart(line, {
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
                    },
                    plugins: {
                        legend: {
                            align: 'start'
                        }
                    }
                }
            });

            $('#lineChartFilter').on('change', function() {
                const selectedValue = $(this).val();
                if (selectedValue) {
                    $.ajax({
                        url: '{{ route('dashboard.project-chart-data') }}',
                        type: 'GET',
                        data: {
                            filter: selectedValue
                        },
                        success: function(response) {
                            if (myLineChart) {
                                myLineChart.data.labels = response.labels;
                                myLineChart.data.datasets[0].data = response.data;
                                myLineChart.update();
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("Error filtering line chart:", error);
                        }
                    });
                }
            });
        });

        $(document).ready(function() {
            $('#projectFilterSelect').on('change', function() {
                var selectedValue = $(this).val();
                console.log("Project filter value: " + selectedValue);

                if (selectedValue) {
                    $.ajax({
                        url: '/dashboard/filter/' + selectedValue + '/projects',
                        type: 'GET',
                        success: function(data) {
                            $('#projectCount').text(data.count);
                        },
                        error: function(xhr, status, error) {
                            console.error("Error filtering projects:", error);
                        }
                    });
                }
            });

            $('#clientFilterSelect').on('change', function() {
                var selectedValue = $(this).val();
                console.log("Client filter value: " + selectedValue);

                if (selectedValue) {
                    $.ajax({
                        url: '/dashboard/filter/' + selectedValue + '/clients',
                        type: 'GET',
                        success: function(data) {
                            $('#clientCount').text(data.count);
                        },
                        error: function(xhr, status, error) {
                            console.error("Error filtering clients:", error);
                        }
                    });
                }
            });

            $('#UserFilterSelect').on('change', function() {
                var selectedValue = $(this).val();
                console.log("User filter value: " + selectedValue);

                if (selectedValue) {
                    $.ajax({
                        url: '/dashboard/filter/' + selectedValue + '/users',
                        type: 'GET',
                        success: function(data) {
                            $('#userCount').text(data.count);
                        },
                        error: function(xhr, status, error) {
                            console.error("Error filtering clients:", error);
                        }
                    });
                }
            });

            $('#ExpenseFilterSelect').on('change', function() {
                var selectedValue = $(this).val();
                console.log("Expense filter value: " + selectedValue);
                if (selectedValue) {
                    $.ajax({
                        url: '/dashboard/filter/' + selectedValue + '/expenses',
                        type: 'GET',
                        success: function(data) {
                            $('#expenseCount').text(data.total);
                        },

                        error: function(xhr, status, error) {
                            console.error("Error filtering expenses:", error);
                        }
                    });
                }
            });
            $('#SalaryFilterSelect').on('change', function() {
                var selectedValue = $(this).val();
                console.log("Salary filter value: " + selectedValue);

                if (selectedValue) {
                    $.ajax({
                        url: '/dashboard/filter/' + selectedValue + '/salary',
                        type: 'GET',
                        success: function(data) {
                            $('#salaryCount').text(data.total);
                        },
                        error: function(xhr, status, error) {
                            console.error("Error filtering salary:", error);
                        }
                    });
                }
            });
            $('#RemainFilterSelect').on('change', function() {
                var selectedValue = $(this).val();
                console.log("Remain filter value: " + selectedValue);

                if (selectedValue) {
                    $.ajax({
                        url: '/dashboard/filter/' + selectedValue + '/remain',
                        type: 'GET',
                        success: function(data) {
                            $('#remainAmount').text(data.total);
                        },
                        error: function(xhr, status, error) {
                            console.error("Error filtering remain:", error);
                        }
                    });
                }
            });
        });

        $(document).ready(function() {
            $('#allFilter').on('change', function() {
                var selectedValue = $(this).val();
                if (selectedValue) {
                    $.ajax({
                        url: '{{ route('dashboard.filter') }}',
                        type: "GET",
                        data: {
                            filter: selectedValue
                        },
                        success: function(response) {
                            $('#projectCount').text(response.projectCount);
                            $('#clientCount').text(response.clientCount);
                            $('#userCount').text(response.userCount);
                            $('#expenseCount').text(response.expenseTotal);
                            $('#salaryCount').text(response.salaryTotal);
                            $('#remainAmount').text(response.remainAmount);
                        },
                        error: function(xhr, status, error) {
                            console.error("Error filtering summary data:", error);
                        }
                    });

                    $.ajax({
                        url: '{{ route('dashboard.status-data') }}',
                        type: "GET",
                        data: {
                            filter: selectedValue
                        },
                        success: function(response) {
                            if (myStatusChart) {
                                myStatusChart.data.labels = response.labels;
                                myStatusChart.data.datasets[0].data = response.data;
                                myStatusChart.update();
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("Error filtering status chart:", error);
                        }
                    });

                    $.ajax({
                        url: '{{ route('dashboard.chart-data') }}',
                        type: 'GET',
                        data: {
                            filter: selectedValue
                        },
                        success: function(response) {
                            if (myBarChart) {
                                myBarChart.data.labels = response.labels;
                                myBarChart.data.datasets[0].data = response.expensesData;
                                myBarChart.data.datasets[1].data = response.paymentsData;
                                myBarChart.update();
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("Error filtering bar chart:", error);
                        }
                    });

                    $.ajax({
                        url: '{{ route('dashboard.project-chart-data') }}',
                        type: 'GET',
                        data: {
                            filter: selectedValue
                        },
                        success: function(response) {
                            if (myLineChart) {
                                myLineChart.data.labels = response.labels;
                                myLineChart.data.datasets[0].data = response.data;
                                myLineChart.update();
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("Error filtering line chart:", error);
                        }
                    });
                }
            });
        });
    </script>
</x-app-layout>
