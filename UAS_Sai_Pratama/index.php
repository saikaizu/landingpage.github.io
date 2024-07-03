<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit;
}

include('config.php');

$query = "SELECT * FROM countries";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UEFA Euro 2024</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .navbar {
            background-color: #005bac;
        }
        .footer {
            background-color: #00428b;
        }
    </style>
</head>
<body class="bg-gray-100">
    <nav class="navbar p-4">
        <div class="container mx-auto">
            <a href="index.php" class="text-white text-lg font-bold">UEFA 2024</a>
            <div class="float-right">
                <a href="logout.php" class="text-white">Logout</a>
            </div>
        </div>
    </nav>
    <div class="container mx-auto mt-8">
        <h1 class="text-2xl font-bold mb-4">Klasemen Grup A UEFA Euro 2024</h1>
        <div class="mb-4">
            <a href="add_country.php" class="bg-blue-500 text-white p-2 rounded">Tambah Negara</a>
            <a href="report.php" class="bg-green-500 text-white p-2 rounded">Cetak Laporan</a>
        </div>
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2">Nama Negara</th>
                    <th class="py-2">Menang</th>
                    <th class="py-2">Seri</th>
                    <th class="py-2">Kalah</th>
                    <th class="py-2">Poin</th>
                    <th class="py-2">Group</th>
                    <th class="py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td class="py-2 px-4"><?php echo $row['name']; ?></td>
                    <td class="py-2 px-4"><?php echo $row['wins']; ?></td>
                    <td class="py-2 px-4"><?php echo $row['draws']; ?></td>
                    <td class="py-2 px-4"><?php echo $row['losses']; ?></td>
                    <td class="py-2 px-4"><?php echo $row['points']; ?></td>
                    <td class="py-2 px-4"><?php echo $row['group_id']; ?></td>
                    <td class="py-2 px-4">
                        <a href="update_country.php?id=<?php echo $row['id']; ?>" class="text-blue-500">Edit</a> |
                        <a href="delete_country.php?id=<?php echo $row['id']; ?>" class="text-red-500">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <footer class="footer p-4 mt-8">
        <div class="container mx-auto text-white text-center">
            &copy; 2024 UEFA 2024
        </div>
    </footer>
</body>
</html>
