<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = "INSERT INTO users (email, password) VALUES ('$email', '$password')";
    if ($conn->query($query) === TRUE) {
        header('Location: login.php');
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
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-20">
        <div class="max-w-md mx-auto bg-white p-8 border border-gray-300">
            <h1 class="text-2xl font-bold mb-4">Register</h1>
            <?php if (isset($error)): ?>
                <div class="text-red-500 mb-4"><?php echo $error; ?></div>
            <?php endif; ?>
            <form action="" method="post">
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email</label>
                    <input type="email" name="email" id="email" class="w-full p-2 border border-gray-300 rounded mt-1" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700">Password</label>
                    <input type="password" name="password" id="password" class="w-full p-2 border border-gray-300 rounded mt-1" required>
                </div>
                <div>
                    <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded">Register</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
