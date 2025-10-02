<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>
    <div>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex justify-between items-center">
            <div class="p-6 border-b border-gray-200">
                {{ __('You are logged in!') }}
            </div>

            <form action="{{ route('dashboard') }}" method="get" id="allData">
                <div class="flex justify-between items-center mx-8">
                    <div class="flex items-center gap-2">
                        <select name="filter" onchange="document.getElementById('allData').submit();"
                           class="block py-2.5 px-4 w-full sm:w-40 md:w-48 text-sm text-gray-500 bg-transparent border-b">
                            <option value="">Select Option</option>
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
            </form>
        </div>

        <div class="grid sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-6 mt-6 capitalize">
            <div class="bg-white overflow-hidden shadow-lg rounded-xl">
                <div class="my-4">
                  <div class="flex items-center justify-between mb-4">
                        <div class="ms-6">
                            <h3 class="text-xl font-semibold text-gray-800">Total Projects</h3>
                        </div>
                        <div>
                            <form action="{{ route('dashboard') }}" method="get" id="getProject">
                                <div class="flex justify-between items-center mx-8">
                                    <div class="flex items-center gap-2">
                                        <select name="totalProject"
                                            onchange="document.getElementById('getProject').submit();"
                                           class="block py-2.5 px-4 w-35 text-sm text-gray-500 bg-transparent border-b">
                                            <option value="">Select Option</option>
                                            <option value="today"
                                                {{ request('totalProject') == 'today' ? 'selected' : '' }}>
                                                today</option>
                                            <option value="this_week"
                                                {{ request('totalProject') == 'this_week' ? 'selected' : '' }}>this
                                                week
                                            </option>
                                            <option value="this_month"
                                                {{ request('totalProject') == 'this_month' ? 'selected' : '' }}>this
                                                month
                                            </option>
                                            <option value="this_year"
                                                {{ request('totalProject') == 'this_year' ? 'selected' : '' }}>this
                                                year
                                            </option>
                                            <option value="last_year"
                                                {{ request('totalProject') == 'last_year' ? 'selected' : '' }}>last
                                                year
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="ms-6">
                        <p class="text-5xl font-bold text-indigo-700 leading-tight">{{ $projectCount }}</p>
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
                            <form action="{{ route('dashboard') }}" method="get" id="getClients">
                                <div class="flex justify-between items-center mx-8">
                                    <div class="flex items-center gap-2">
                                        <select name="client"
                                            onchange="document.getElementById('getClients').submit();"
                                            class="block py-2.5 px-4 w-35 text-sm text-gray-500 bg-transparent border-b">
                                            <option value="">Select Option</option>
                                            <option value="today"
                                                {{ request('client') == 'today' ? 'selected' : '' }}>
                                                today</option>
                                            <option value="this_week"
                                                {{ request('client') == 'this_week' ? 'selected' : '' }}>this week
                                            </option>
                                            <option value="this_month"
                                                {{ request('client') == 'this_month' ? 'selected' : '' }}>this month
                                            </option>
                                            <option value="this_year"
                                                {{ request('client') == 'this_year' ? 'selected' : '' }}>this year
                                            </option>
                                            <option value="last_year"
                                                {{ request('client') == 'last_year' ? 'selected' : '' }}>last year
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="ms-6">
                        <p class="text-5xl font-bold text-indigo-700 leading-tight">{{ $clientCount }}</p>
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
                            <form action="{{ route('dashboard') }}" method="get" id="getUsers">
                                <div class="flex justify-between items-center mx-8">
                                    <div class="flex items-center gap-2">
                                        <select name="totalUser"
                                            onchange="document.getElementById('getUsers').submit();"
                                            class="block py-2.5 px-4 w-35 text-sm text-gray-500 bg-transparent border-b">
                                            <option value="">Select Option</option>
                                            <option value="today"
                                                {{ request('totalUser') == 'today' ? 'selected' : '' }}>
                                                today</option>
                                            <option value="this_week"
                                                {{ request('totalUser') == 'this_week' ? 'selected' : '' }}>this week
                                            </option>
                                            <option value="this_month"
                                                {{ request('totalUser') == 'this_month' ? 'selected' : '' }}>this month
                                            </option>
                                            <option value="this_year"
                                                {{ request('totalUser') == 'this_year' ? 'selected' : '' }}>this year
                                            </option>
                                            <option value="last_year"
                                                {{ request('totalUser') == 'last_year' ? 'selected' : '' }}>last year
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="ms-6">
                        <p class="text-5xl font-bold text-indigo-700 leading-tight">{{ $userCount }}</p>
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
                            <form action="{{ route('dashboard') }}" method="get" id="getTotal">
                                <div class="flex justify-between items-center mx-8">
                                    <div class="flex items-center gap-2">
                                        <select name="totalAmount"
                                            onchange="document.getElementById('getTotal').submit();"
                                            class="block py-2.5 px-4 w-35 text-sm text-gray-500 bg-transparent border-b">
                                            <option value="">Select Option</option>
                                            <option value="today"
                                                {{ request('totalAmount') == 'today' ? 'selected' : '' }}>
                                                today</option>
                                            <option value="this_week"
                                                {{ request('totalAmount') == 'this_week' ? 'selected' : '' }}>this week
                                            </option>
                                            <option value="this_month"
                                                {{ request('totalAmount') == 'this_month' ? 'selected' : '' }}>this
                                                month
                                            </option>
                                            <option value="this_year"
                                                {{ request('totalAmount') == 'this_year' ? 'selected' : '' }}>this year
                                            </option>
                                            <option value="last_year"
                                                {{ request('totalAmount') == 'last_year' ? 'selected' : '' }}>last year
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="ms-6">
                        <p class="text-5xl font-bold text-indigo-700 leading-tight">{{ round($expenses) }}</p>
                        <p class="text-sm text-gray-500 mt-2">List of total amounts.</p>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-lg rounded-xl">
                <div class="my-4">
                    <div class="flex items-center justify-between mb-4">
                        <div class="ms-6">
                            <h3 class="text-xl font-semibold text-gray-800">Salaries</h3>
                        </div>
                        <div>
                            <form action="{{ route('dashboard') }}" method="get" id="getSalary">
                                <div class="flex justify-between items-center mx-8">
                                    <div class="flex items-center gap-2">
                                        <select name="totalSalary"
                                            onchange="document.getElementById('getSalary').submit();"
                                            class="block py-2.5 px-4 w-35 text-sm text-gray-500 bg-transparent border-b">
                                            <option value="">Select Option</option>
                                            <option value="today"
                                                {{ request('totalSalary') == 'today' ? 'selected' : '' }}>
                                                today</option>
                                            <option value="this_week"
                                                {{ request('totalSalary') == 'this_week' ? 'selected' : '' }}>this week
                                            </option>
                                            <option value="this_month"
                                                {{ request('totalSalary') == 'this_month' ? 'selected' : '' }}>this
                                                month
                                            </option>
                                            <option value="this_year"
                                                {{ request('totalSalary') == 'this_year' ? 'selected' : '' }}>this year
                                            </option>
                                            <option value="last_year"
                                                {{ request('totalSalary') == 'last_year' ? 'selected' : '' }}>last year
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="ms-6">
                        <p class="text-5xl font-bold text-indigo-700 leading-tight">{{ round($salary) }}</p>
                        <p class="text-sm text-gray-500 mt-2">List of number of salaries.</p>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-lg rounded-xl">
                <div class="my-4">
                    <div class="flex items-center justify-between mb-4">
                        <div class="ms-6">
                            <h3 class="text-xl font-semibold text-gray-800 capitalize">remain amount</h3>
                        </div>
                        <div>
                            <form action="{{ route('dashboard') }}" method="get" id="getRemain">
                                <div class="flex justify-between items-center mx-8">
                                    <div class="flex items-center gap-2">
                                        <select name="totalRemain"
                                            onchange="document.getElementById('getRemain').submit();"
                                            class="block py-2.5 px-4 w-35 text-sm text-gray-500 bg-transparent border-b">
                                            <option value="">Select Option</option>
                                            <option value="today"
                                                {{ request('totalRemain') == 'today' ? 'selected' : '' }}>
                                                today</option>
                                            <option value="this_week"
                                                {{ request('totalRemain') == 'this_week' ? 'selected' : '' }}>this week
                                            </option>
                                            <option value="this_month"
                                                {{ request('totalRemain') == 'this_month' ? 'selected' : '' }}>this
                                                month
                                            </option>
                                            <option value="this_year"
                                                {{ request('totalRemain') == 'this_year' ? 'selected' : '' }}>this year
                                            </option>
                                            <option value="last_year"
                                                {{ request('totalRemain') == 'last_year' ? 'selected' : '' }}>last year
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                    <div class="ms-6">
                        <p class="text-5xl font-bold text-indigo-700 leading-tight">{{ round($amount) }}</p>
                        <p class="text-sm text-gray-500 mt-2">List of remaining amounts.</p>
                    </div>
                </div>
            </div>

        </div>

        <div class="grid sm:grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <div class="bg-white rounded-xl shadow-md border border-gray-200 overflow-x-auto">
                <form action="{{ route('dashboard') }}" method="get" id="paymentOverview">
                    <div class="flex justify-between items-center mx-8 mt-4">
                        <div class="capitalize">
                            <span>payment overview</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <select name="payment" id="underline_select"
                                onchange="document.getElementById('paymentOverview').submit();"
                                class="block py-2.5 px-4 w-full sm:w-40 md:w-48 text-sm text-gray-500 bg-transparent border-b">
                                <option value="">Select Option</option>
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
                </form>
                <div class="p-2 sm:p-4">
                    <canvas id="myBarChart" class="w-full"></canvas>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md border border-gray-200 overflow-x-auto">
                <form action="{{ route('dashboard') }}" method="get" id="statusOverview">
                    <div class="flex justify-between items-center mx-8 mt-4">
                        <div class="capitalize">
                            <span>status overview</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <select name="option" onchange="document.getElementById('statusOverview').submit();"
                                id="underline_select"
                                class="block py-2.5 px-4 w-full sm:w-40 md:w-48 text-sm text-gray-500 bg-transparent border-b">
                                <option value="">Select Option</option>
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
                </form>
                <div class="p-2 sm:p-4" style="height:400px;">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>

        <div class="mt-6">
            <div class="bg-white rounded-xl shadow-md border border-gray-200 overflow-x-auto">
                <form action="{{ route('dashboard') }}" method="get" id="projectOverview">
                    <div class="flex justify-between items-center mx-8 mt-4">
                        <div class="capitalize">
                            <span>Project overview</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <select name="project" id="underline_select"
                                onchange="document.getElementById('projectOverview').submit();"
                                class="block py-2.5 px-4 w-full sm:w-40 md:w-48 text-sm text-gray-500 bg-transparent border-b">
                                <option value="">Select Option</option>
                                <option value="today" {{ request('project') == 'today' ? 'selected' : '' }}>today
                                </option>
                                <option value="this_week" {{ request('project') == 'this_week' ? 'selected' : '' }}>
                                    this
                                    week</option>
                                <option value="this_month" {{ request('project') == 'this_month' ? 'selected' : '' }}>
                                    this
                                    month</option>
                                <option value="this_year" {{ request('project') == 'this_year' ? 'selected' : '' }}>
                                    this
                                    year</option>
                                <option value="last_year" {{ request('project') == 'last_year' ? 'selected' : '' }}>
                                    last
                                    year</option>
                            </select>
                        </div>
                    </div>
                </form>
                <div class="p-2 sm:p-4">
                    <canvas id="myLineChart"></canvas>
                </div>
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
            const statusCounts = @json($statusCounts);
            console.log(statusCounts);

            const labels = Object.keys(statusCounts);
            const dataValues = Object.values(statusCounts);
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
                            text: '',
                            font: {
                                size: 16
                            },
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
                    },
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
                        },
                    },
                    plugins: {
                        legend: {
                            align: 'start'
                        }
                    }
                }
            });
        });
    </script>

</x-app-layout>
