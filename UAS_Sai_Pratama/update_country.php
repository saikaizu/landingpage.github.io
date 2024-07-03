<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit;
}

include('config.php');

$id = $_GET['id'];
$query = "SELECT * FROM countries WHERE id='$id'";
$result = $conn->query($query);
$country = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $wins = $_POST['wins'];
    $draws = $_POST['draws'];
    $losses = $_POST['losses'];
    $points = $_POST['points'];

    $query = "UPDATE countries SET name='$name', wins='$wins', draws='$draws', losses='$losses', points='$points' WHERE id='$id'";
    if ($conn->query($query) === TRUE) {
        header('Location: index.php');
        exit;
    } else {
        $error = "Error: " . $query . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Negara</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-20">
        <div class="max-w-md mx-auto bg-white p-8 border border-gray-300">
            <h1 class="text-2xl font-bold mb-4">Edit Negara</h1>
            <?php if (isset($error)): ?>
                <div class="text-red-500 mb-4"><?php echo $error; ?></div>
            <?php endif; ?>
            <form action="" method="post">
                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Nama Negara</label>
                    <input type="text" name="name" id="name" class="w-full p-2 border border-gray-300 rounded mt-1" value="<?php echo $country['name']; ?>" required>
                </div>
                <div class="mb-4">
                    <label for="wins" class="block text-gray-700">Menang</label>
                    <input type="number" name="wins" id="wins" class="w-full p-2 border border-gray-300 rounded mt-1" value="<?php echo $country['wins']; ?>" required>
                </div>
                <div class="mb-4">
                    <label for="draws" class="block text-gray-700">Seri</label>
                    <input type="number" name="draws" id="draws" class="w-full p-2 border border-gray-300 rounded mt-1" value="<?php echo $country['draws']; ?>" required>
                </div>
                <div class="mb-4">
                    <label for="losses" class="block text-gray-700">Kalah</label>
                    <input type="number" name="losses" id="losses" class="w-full p-2 border border-gray-300 rounded mt-1" value="<?php echo $country['losses']; ?>" required>
                </div>
                <div class="mb-4">
                    <label for="points" class="block text-gray-700">Poin</label>
                    <input type="number" name="points" id="points" class="w-full p-2 border border-gray-300 rounded mt-1" value="<?php echo $country['points']; ?>" required>
                </div>
                <div>
                    <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded">Update</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
