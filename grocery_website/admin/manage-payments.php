<?php
include "sidebar.php";
include "../config.php";  // Database connection

if (!isset($_SESSION['admin_id'])) {
    echo "<script>alert('Please login first.'); window.location.href='admin-login.php';</script>";
    exit();
}

// Fetch Total Sales
$totalSalesQuery = "SELECT SUM(total_price) AS total_sales FROM orders";
$totalSalesResult = mysqli_query($conn, $totalSalesQuery);
$totalSales = mysqli_fetch_assoc($totalSalesResult)['total_sales'] ?? 0;

// Calculate Supplier Cost (15% of total sales)
$totalRevenue = $totalSales * 0.15;

// Calculate Total Revenue (Total Sales - Supplier Cost)
$supplierCost = $totalSales - $totalRevenue;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap'>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Include Chart.js -->
    <title>Performance Analytics</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: green;
        }

        .home {
            width: 100%;
        }

        .dashboard-container {
            display: flex;
        }

        .main-content {
            flex: 1;
            padding: 20px;
        }

        #analytics_header {
            background-color: #fff;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            
        }

        #analytics_header h1 {
            font-size: 24px;
            color: #333;
        }
        #analytics_header h1{
            margin-left: 450px;
        }
        .analytics-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .kpi-cards {
            display: flex;
            justify-content: space-around;
            margin-bottom: 30px;
        }

        .kpi-card {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 30%;
            text-align: center;
        }

        .kpi-card h3 {
            font-size: 18px;
            color: #333;
        }

        .kpi-card p {
            font-size: 24px;
            font-weight: bold;
            color: #2a9d8f;
        }

        .chart-container {
            width: 50%;
            margin: 0 auto;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        canvas {
            width: 400px !important;
            height: 400px !important;
        }
    </style>
</head>

<body>
    <section class="home">
        <div class="dashboard-container">
            <div class="main-content">
                <header id="analytics_header">
                    <h1>Performance Analytics</h1>
                </header>
                <div class="analytics-container">
                    <h2>Key Performance Indicators</h2>
                    <div class="kpi-cards">
                        <div class="kpi-card">
                            <h3>Total Sales</h3>
                            <p>₹<?php echo number_format($totalSales, 2); ?></p>
                        </div>
                        <div class="kpi-card">
                            <h3>Supplier Cost</h3>
                            <p>₹<?php echo number_format($supplierCost, 2); ?></p>
                        </div>
                        <div class="kpi-card">
                            <h3>Total Revenue (15%)</h3>
                            <p>₹<?php echo number_format($totalRevenue, 2); ?></p>
                        </div>
                    </div>

                    <!-- Pie Chart -->
                    <h2>Sales Distribution</h2>
                    <div class="chart-container">
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        var ctx = document.getElementById('salesChart').getContext('2d');
        var salesChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Total Sales', 'Supplier Cost ', 'Total Revenue (15%)'],
                datasets: [{
                    data: [<?php echo $totalSales; ?>, <?php echo $supplierCost; ?>, <?php echo $totalRevenue; ?>],
                    backgroundColor: ['#007bff', '#ffcc00', '#28a745']
                }]
            }
        });
    </script>

</body>

</html>