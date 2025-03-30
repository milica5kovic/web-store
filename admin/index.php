<?php
session_start();

if (!isset($_SESSION['user']['status']) || !$_SESSION['user']['status']) {
    header('location: ./login.php');
    exit();
}

require_once '../db.php';
global $pdo;

// Fetch daily sales data
$stmt = $pdo->prepare("
    SELECT DATE(date) as order_date, COUNT(*) as total_sales
    FROM `order`
    GROUP BY order_date
    ORDER BY order_date ASC
");
$stmt->execute();
$salesData = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        google.charts.load('current', {'packages': ['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Date');
            data.addColumn('number', 'Sales');

            data.addRows([
                <?php
                foreach ($salesData as $row) {
                    echo "['" . $row['order_date'] . "', " . $row['total_sales'] . "],";
                }
                ?>
            ]);

            var options = {
                title: 'Daily Sales Overview',
                curveType: 'function',
                legend: {position: 'bottom'},
                height: 400,
                colors: ['#007bff'],
                hAxis: {
                    title: 'Date'
                },
                vAxis: {
                    title: 'Sales'
                }
            };

            var chart = new google.visualization.LineChart(document.getElementById('sales_chart'));
            chart.draw(data, options);
        }
    </script>
</head>
<body>
<?php include 'modules/header.php'; ?>
<div class="container mt-4">
    <h2 class="mb-4">Sales Overview</h2>
    <div id="sales_chart" class="shadow p-3 bg-white rounded"></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
