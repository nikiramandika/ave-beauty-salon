<!doctype html>

<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default"
    data-assets-path="owner/dashboard/assets/" data-template="vertical-menu-template-free" data-style="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Ave Beauty Salon</title>
    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('user/images/bg-logo.png') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="owner/dashboard/assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="owner/dashboard/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="owner/dashboard/assets/vendor/css/theme-default.css"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="owner/dashboard/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="owner/dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="owner/dashboard/assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="owner/dashboard/assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="owner/dashboard/assets/js/config.js"></script>
    <style>
        .card {
            height: 100%;
            width: 100%;
            display: flex;
        }

        .card-body {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: stretch;
        }
    </style>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            @include('owner.layouts.sidebar')
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                @include('owner.layouts.navbar')

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">
                            <!-- Grafik Produk Terlaris -->
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5>Best Selling Product</h5>
                                        <div id="topProductChart"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Grafik Order Status Complete -->
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5>Order Status Complete</h5>
                                        <div id="completeOrderChart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                // Data dari controller
                                var topProducts = @json($topProducts); // Data produk terlaris
                                var orderStatuses = @json($orderStatusCounts); // Data status pesanan

                                // Pastikan topProducts memiliki data
                                if (!topProducts || topProducts.length === 0) {
                                    console.error('Data topProducts kosong atau tidak ditemukan.');
                                    return;
                                }

                                // Memproses data untuk grafik 5 produk teratas
                                var productNames = topProducts
                                    .filter(product => product.product_name) // Hilangkan data null atau undefined
                                    .map(product => product.product_name); // Nama-nama produk
                                var productQuantities = topProducts
                                    .filter(product => product.product_name) // Pastikan hanya data valid
                                    .map(product => product.total_quantity); // Jumlah produk

                                // Debug data
                                console.log('Filtered Product Names:', productNames);
                                console.log('Filtered Product Quantities:', productQuantities);

                                // Konfigurasi ApexCharts untuk Produk Terlaris
                                var options = {
                                    chart: {
                                        type: 'bar',
                                        height: 350,
                                        width: '100%'
                                    },
                                    series: [{
                                        name: 'Jumlah Pesanan',
                                        data: productQuantities // Data jumlah pesanan
                                    }],
                                    xaxis: {
                                        categories: productNames.map(name => name.replace(/\s\(Size:.*?\)/, '')),
                                        labels: {
                                            rotate: -40,
                                            offsetY: -10,
                                            style: {
                                                fontSize: '12px',
                                                fontWeight: '400',
                                                colors: ['#333'],
                                                whiteSpace: 'nowrap' // Mencegah teks melipat ke bawah
                                            },
                                            trim: true, // Memotong teks jika terlalu panjang
                                            maxHeight: 80, // Membatasi tinggi label
                                        }
                                    },
                                    title: {
                                        text: 'Top 5 Best Selling Products'
                                    },
                                    noData: {
                                        text: 'No data available'
                                    }
                                };

                                var chart = new ApexCharts(document.querySelector("#topProductChart"), options);
                                chart.render();

                                // Pastikan orderStatuses memiliki data yang valid
                                if (!orderStatuses || Object.keys(orderStatuses).length === 0) {
                                    console.error('Data orderStatuses kosong atau tidak ditemukan.');
                                    return;
                                }

                                // Data untuk pie chart
                                var pieChartData = [
                                    orderStatuses.complete || 0,
                                    orderStatuses.pending || 0,
                                    orderStatuses.refund || 0
                                ];

                                var pieChartLabels = ['Complete', 'Cancelled', 'Refund'];

                                // Debug data
                                console.log('Order Statuses:', orderStatuses);
                                console.log('Pie Chart Data:', pieChartData);

                                // Konfigurasi ApexCharts untuk Pie Chart
                                var completeOrderOptions = {
                                    chart: {
                                        type: 'pie',
                                        height: 350
                                    },
                                    series: pieChartData,
                                    labels: pieChartLabels,
                                    title: {
                                        text: 'Order Status Comparison'
                                    },
                                    noData: {
                                        text: 'No data available'
                                    }
                                };

                                var completeOrderChart = new ApexCharts(document.querySelector("#completeOrderChart"),
                                    completeOrderOptions);
                                completeOrderChart.render();
                            });
                        </script>

                        <br>

                        <div class="row">
                            <!-- Card 1 - Active Members -->
                            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="card-title d-flex align-items-start justify-content-between mb-4">
                                            <div class="avatar flex-shrink-0">
                                                <i class="fa-solid fa-users fs-4 p-2 bg-info"
                                                    style="color: white; border-radius: 5px;"></i>
                                            </div>
                                            <div class="dropdown">
                                                <button class="btn p-0" type="button" id="cardOpt7"
                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <i class="bx bx-dots-vertical-rounded text-muted"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt7">
                                                    <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mb-1">Active Members</p>
                                        <h4 class="card-title mb-3">{{ $activeMembersCount }}</h4>
                                        <small class="text-info fw-medium">
                                            <i class="bx bx-up-arrow-alt"></i>
                                            +{{ number_format(($activeMembersCount / 100) * 5, 2) }}%
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 2 - Transactions -->
                            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="card-title d-flex align-items-start justify-content-between mb-4">
                                            <div class="avatar flex-shrink-0">
                                                <img src="owner/dashboard/assets/img/icons/unicons/cc-primary.png"
                                                    alt="Course Registration" class="rounded" />
                                            </div>
                                            <div class="dropdown">
                                                <button class="btn p-0" type="button" id="cardOpt1"
                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <i class="bx bx-dots-vertical-rounded text-muted"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt1">
                                                    <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mb-1">Course Registrations for {{ $currentMonth }}</p>
                                        <h4 class="card-title mb-3">{{ $totalRegisterCourseThisMonth }}</h4>
                                        <small class="text-success fw-medium">
                                            <i class="bx bx-up-arrow-alt"></i> {{ $percentageChangeFormatted }}%
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 3 - Active Users -->
                            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="card-title d-flex align-items-start justify-content-between mb-4">
                                            <div class="avatar flex-shrink-0">
                                                <i class="fa-solid fa-user-check fs-4 p-2 bg-success"
                                                    style="color: white; border-radius: 5px;"></i>
                                            </div>
                                            <div class="dropdown">
                                                <button class="btn p-0" type="button" id="cardOpt2"
                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <i class="bx bx-dots-vertical-rounded text-muted"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end"
                                                    aria-labelledby="cardOpt2">
                                                    <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mb-1">Active Users</p>
                                        <h4 class="card-title mb-3">{{ $activeUsersCount }}</h4>
                                        <small class="text-success fw-medium"><i class="bx bx-up-arrow-alt"></i>
                                            +{{ number_format(($activeUsersCount / 100) * 10, 2) }}%</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mb-6">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div
                                        class="d-flex justify-content-between align-items-center flex-sm-row flex-column gap-10">
                                        <div
                                            class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                            <div class="card-title mb-6">
                                                <h5 class="text-nowrap mb-1">Annual Revenue Report (Products & Courses)
                                                </h5>
                                                <span class="badge bg-label-warning">YEAR
                                                    {{ now('Asia/Jakarta')->year }}</span>
                                            </div>
                                            <div class="mt-sm-auto">
                                                <span class="text-success text-nowrap fw-medium">
                                                    <i class="bx bx-up-arrow-alt"></i>
                                                    {{ number_format($percentageChange) }}%
                                                </span>
                                                <h4 class="mb-0">Rp{{ number_format($currentYearRevenue, 2) }}
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Order Statistics -->
                            <div class="col-md-6 col-lg-6 col-xl-6 mb-6">
                                <div class="card h-100">
                                    <div class="card-header d-flex justify-content-between">
                                        <div class="card-title mb-0">
                                            <h5 class="mb-1 me-2">Order Statistics</h5>
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn text-muted p-0" type="button" id="orederStatistics"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded bx-lg"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end"
                                                aria-labelledby="orederStatistics">
                                                <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Share</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-6">
                                            <div class="d-flex flex-column align-items-center gap-1">
                                                <small>Total Product Order</small>
                                                <h3 class="mb-1">{{ $topProductByCategory->sum('total_quantity') }}
                                                </h3>
                                            </div>
                                            <div id="orderStatisticsChart"></div>
                                        </div>
                                        <ul class="p-0 m-0">
                                            @foreach ($topProductByCategory as $category)
                                                <li class="d-flex align-items-center mb-5">
                                                    <div class="avatar flex-shrink-0 me-3">
                                                        <span class="avatar-initial rounded bg-label-primary">
                                                            <i class="bx bx-category"></i>
                                                            <!-- Ikon umum untuk kategori -->
                                                        </span>
                                                    </div>
                                                    <div
                                                        class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                        <div class="me-2">
                                                            <h6 class="mb-0">{{ $category['category_name'] }}</h6>
                                                            <small>Product Category</small>
                                                        </div>
                                                        <div class="user-progress">
                                                            <h6 class="mb-0">
                                                                {{ number_format($category['total_quantity']) }} units
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>

                                    </div>
                                </div>
                            </div>

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    // Mengambil data kategori dan total kuantitas dari backend
                                    const categories = @json($topProductByCategory->pluck('category_name'));
                                    const quantities = @json($topProductByCategory->pluck('total_quantity'));

                                    console.log('categories:', categories);
                                    console.log('quantities:', quantities);

                                    // Cek apakah data kategori dan kuantitas tersedia
                                    if (categories.length && quantities.length) {
                                        const orderChartConfig = {
                                            chart: {
                                                height: 145,
                                                type: 'donut',
                                            },
                                            labels: categories,
                                            series: quantities,
                                            colors: [
                                                '#28a745', '#007bff', '#6c757d', '#17a2b8', '#ffc107'
                                            ],
                                            stroke: {
                                                width: 5,
                                                colors: ['#ffffff']
                                            },
                                            dataLabels: {
                                                enabled: true,
                                                formatter: function(val) {
                                                    return Math.round(val) + '%';
                                                }
                                            },
                                            legend: {
                                                show: true
                                            },
                                            grid: {
                                                padding: {
                                                    top: 0,
                                                    bottom: 0,
                                                    right: 15
                                                }
                                            }
                                        };

                                        const chartOrderStatistics = document.querySelector('#orderStatisticsChart');
                                        if (chartOrderStatistics) {
                                            const statisticsChart = new ApexCharts(chartOrderStatistics, orderChartConfig);
                                            statisticsChart.render();
                                        }
                                    } else {
                                        console.error('Data kategori atau kuantitas tidak tersedia');
                                    }
                                });
                            </script>
                            <!--/ Order Statistics -->

                            <!-- Expense Overview -->
                            <div class="col-md-6 col-lg-6 col-xl-6 mb-6">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="tab-content p-0">
                                            <div class="tab-pane fade show active" id="navs-tabs-line-card-income"
                                                role="tabpanel">
                                                <div class="d-flex mb-6">
                                                    <div class="avatar flex-shrink-0 me-3">
                                                        <img src="owner/dashboard/assets/img/icons/unicons/wallet.png"
                                                            alt="User" />
                                                    </div>
                                                    <div>
                                                        <p class="mb-0">Total Balance Order (Product)</p>
                                                        <div class="d-flex align-items-center">
                                                            <h6 class="mb-0 me-1">
                                                                Rp{{ number_format($totalSum, 0, ',', '.') }}</h6>
                                                            @if (!is_null($percentageChange))
                                                                <small
                                                                    class="{{ $percentageChange >= 0 ? 'text-success' : 'text-danger' }} fw-medium">
                                                                    <i
                                                                        class="bx {{ $percentageChange >= 0 ? 'bx-chevron-up' : 'bx-chevron-down' }} bx-lg"></i>
                                                                    {{ number_format(abs($percentageChange), 1) }}%
                                                                </small>
                                                            @else
                                                                <small class="text-muted">No data for
                                                                    comparison</small>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="incomeChart"></div>
                                                <script>
                                                    // Data dari server
                                                    const months = @json($months); // Data bulan (1-12)
                                                    const totals = @json($totals).map(total => parseFloat(total)); // Konversi string ke float

                                                    document.addEventListener('DOMContentLoaded', function() {
                                                        // Pastikan elemen grafik tersedia
                                                        const incomeChartEl = document.querySelector('#incomeChart');
                                                        if (incomeChartEl) {
                                                            const incomeChartConfig = {
                                                                series: [{
                                                                    name: 'Income', // Nama series
                                                                    data: totals // Data total dari server
                                                                }],
                                                                chart: {
                                                                    type: 'area', // Ubah ke area chart
                                                                    height: 300, // Tinggi grafik
                                                                    zoom: {
                                                                        enabled: false // Nonaktifkan zoom
                                                                    }
                                                                },
                                                                fill: {
                                                                    type: 'gradient', // Gunakan gradient
                                                                    gradient: {
                                                                        shadeIntensity: 1,
                                                                        opacityFrom: 0.7,
                                                                        opacityTo: 0.9,
                                                                        stops: [0, 100]
                                                                    }
                                                                },
                                                                colors: ['#5664d2'], // Warna baru
                                                                dataLabels: {
                                                                    enabled: true,
                                                                    formatter: (value) => value.toLocaleString(), // Format angka dengan koma
                                                                    style: {
                                                                        colors: ['#fff'], // Warna teks label
                                                                        fontWeight: 'bold'
                                                                    }
                                                                },
                                                                stroke: {
                                                                    curve: 'smooth', // Garis melengkung
                                                                    width: 2
                                                                },
                                                                xaxis: {
                                                                    categories: months.map(month => {
                                                                        const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug",
                                                                            "Sep", "Oct", "Nov", "Dec"
                                                                        ];
                                                                        return monthNames[month - 1]; // Konversi bulan ke nama bulan
                                                                    }),
                                                                    labels: {
                                                                        style: {
                                                                            fontSize: '12px',
                                                                            colors: '#6c757d'
                                                                        }
                                                                    },
                                                                    axisBorder: {
                                                                        show: false
                                                                    }
                                                                },
                                                                yaxis: {
                                                                    labels: {
                                                                        formatter: (value) => value.toLocaleString(), // Format angka dengan koma
                                                                        style: {
                                                                            colors: '#6c757d'
                                                                        }
                                                                    },
                                                                    min: 0, // Set nilai minimum
                                                                    tickAmount: 5 // Jumlah garis grid Y
                                                                },
                                                                grid: {
                                                                    borderColor: '#e0e0e0',
                                                                    strokeDashArray: 4,
                                                                    xaxis: {
                                                                        lines: {
                                                                            show: true
                                                                        }
                                                                    },
                                                                    yaxis: {
                                                                        lines: {
                                                                            show: true
                                                                        }
                                                                    }
                                                                },
                                                                tooltip: {
                                                                    y: {
                                                                        formatter: (value) => value.toLocaleString() // Format tooltip
                                                                    }
                                                                }
                                                            };

                                                            // Render grafik menggunakan ApexCharts
                                                            const incomeChart = new ApexCharts(incomeChartEl, incomeChartConfig);
                                                            incomeChart.render();
                                                        }
                                                    });
                                                </script>

                                                <div
                                                    class="d-flex align-items-center justify-content-start mt-6 gap-3">
                                                    <div>
                                                        <h6 class="mb-0">Income this week</h6>
                                                        <small>
                                                            Rp{{ number_format($incomeThisWeek, 0, ',', '.') }}
                                                            @if ($difference >= 0)
                                                                <span
                                                                    class="text-success">(+Rp{{ number_format(abs($difference), 0, ',', '.') }}
                                                                    more than last week)</span>
                                                            @else
                                                                <span
                                                                    class="text-danger">(-Rp{{ number_format(abs($difference), 0, ',', '.') }}
                                                                    less than last week)</span>
                                                            @endif
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>


                    <footer class="content-footer footer bg-footer-theme">
                        <div class="container-xxl">
                            <div
                                class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
                                <div class="text-body">
                                    ©
                                    <script>
                                        document.write(new Date().getFullYear());
                                    </script>
                                    <a href="" class="footer-link"> AveBeautySalon</a>
                                </div>
                            </div>
                        </div>
                    </footer>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="owner/dashboard/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="owner/dashboard/assets/vendor/libs/popper/popper.js"></script>
    <script src="owner/dashboard/assets/vendor/js/bootstrap.js"></script>
    <script src="owner/dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="owner/dashboard/assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="owner/dashboard/assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="owner/dashboard/assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="owner/dashboard/assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag before closing body tag for github widget button. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
