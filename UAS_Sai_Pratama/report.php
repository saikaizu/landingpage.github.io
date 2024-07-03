<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit;
}

require 'vendor/autoload.php';
include('config.php');

use Dompdf\Dompdf;

$query = "SELECT * FROM countries";
$result = $conn->query($query);

$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UEFA 2024 - Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .footer {
            background-color: #00428b;
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Klasemen Grup A UEFA Euro 2024 - Jerman</h1>
        <table>
            <thead>
                <tr>
                    <th>Nama Negara</th>
                    <th>Menang</th>
                    <th>Seri</th>
                    <th>Kalah</th>
                    <th>Poin</th>
                </tr>
            </thead>
            <tbody>';

while ($row = $result->fetch_assoc()) {
    $html .= '<tr>';
    $html .= '<td>' . $row['name'] . '</td>';
    $html .= '<td>' . $row['wins'] . '</td>';
    $html .= '<td>' . $row['draws'] . '</td>';
    $html .= '<td>' . $row['losses'] . '</td>';
    $html .= '<td>' . $row['points'] . '</td>';
    $html .= '</tr>';
}

$html .= '</tbody>
        </table>
    </div>
    <div class="footer">
        &copy; 2024 UEFA 2024
    </div>
</body>
</html>';

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream('report.pdf', array('Attachment' => 0));
?>
