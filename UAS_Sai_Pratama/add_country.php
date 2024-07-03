<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit;
}

include('config.php');

// Proses simpan data jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $country_id = $_POST['country']; // Pastikan $_POST['country'] sesuai dengan 'id' negara yang dipilih dari dropdown
    $wins = $_POST['wins'];
    $draws = $_POST['draws'];
    $losses = $_POST['losses'];
    $group = $_POST['group'];
    $country_id = $_POST['country']; // Pastikan $_POST['country'] sesuai dengan 'id' negara yang dipilih

    // Hitung poin
    $points = ($wins * 3) + ($draws * 1);

    $query = "INSERT INTO countries (name, wins, draws, losses, points, group_id)
              VALUES ('$country_name', $wins, $draws, $losses, $points, '$group')";
    
    if ($conn->query($query) === TRUE) {
        // Redirect ke halaman utama setelah berhasil menyimpan data
        header('Location: index.php');
        exit;
    } else {
        echo 'Error: ' . $query . '<br>' . $conn->error;
    }
}


// Query untuk mengambil daftar negara UEFA
$query_countries = "SELECT * FROM countries";
$result_countries = $conn->query($query_countries);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UEFA Euro 2024 - Tambah Tim</title>
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
        <h1 class="text-2xl font-bold mb-4">Tambah Tim UEFA 2024</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <div class="mb-4">
                <label for="country" class="block text-sm font-medium text-gray-700">Negara UEFA</label>
                <select id="country" name="country" required class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <!-- Tampilkan pilihan negara dari database -->
                    <?php while ($row_country = $result_countries->fetch_assoc()): ?>
                        <option value="<?php echo $row_country['id']; ?>"><?php echo $row_country['name']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="mb-4">
                <label for="group" class="block text-sm font-medium text-gray-700">Group</label>
                <select id="group" name="group" required class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="A">Group A</option>
                    <option value="B">Group B</option>
                    <option value="C">Group C</option>
                    <option value="D">Group D</option>
                    <!-- Tambahkan opsi lain sesuai dengan kebutuhan Anda -->
                </select>
            </div>
            <div class="mb-4">
            <div class="mb-4">
                <label for="wins" class="block text-sm font-medium text-gray-700">Menang</label>
                <input type="number" id="wins" name="wins" required class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div class="mb-4">
                <label for="draws" class="block text-sm font-medium text-gray-700">Seri</label>
                <input type="number" id="draws" name="draws" required class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div class="mb-4">
                <label for="losses" class="block text-sm font-medium text-gray-700">Kalah</label>
                <input type="number" id="losses" name="losses" required class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
                <a href="index.php" class="bg-gray-200 text-gray-800 px-4 py-2 rounded">Batal</a>
            </div>
        </form>
    </div>
    <footer class="footer p-4 mt-8">
        <div class="container mx-auto text-white text-center">
            &copy; 2024 UEFA 2024
        </div>
    </footer>
</body>
</html>
