<?php
session_start();

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = htmlspecialchars(trim($_POST['nama']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Format email tidak valid!";
    } elseif (strlen($password) < 6) {
        $error = "Password minimal 6 karakter!";
    } else {
        $file = 'users.json';
        $users = [];

        if (file_exists($file)) {
            $json_data = file_get_contents($file);
            $users = json_decode($json_data, true) ?: [];
        }

        $email_exists = false;
        foreach ($users as $user) {
            if ($user['email'] === $email) {
                $email_exists = true;
                break;
            }
        }

        if ($email_exists) {
            $error = "Email sudah terdaftar! Silakan gunakan email lain.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $users[] = [
                'nama' => $nama,
                'email' => $email,
                'password' => $hashed_password
            ];

            file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT));
            
            $success = "Registrasi berhasil! Silakan login.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register - Tugas 7</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 min-h-screen flex items-center justify-center font-sans">
    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md">
        <h2 class="text-3xl font-bold text-center text-slate-800 mb-6">Buat Akun</h2>
        
        <?php if($error): ?>
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4"><?= $error ?></div>
        <?php endif; ?>
        
        <?php if($success): ?>
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4"><?= $success ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="mb-4">
                <label class="block text-slate-700 font-semibold mb-2">Nama Lengkap</label>
                <input type="text" name="nama" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div class="mb-4">
                <label class="block text-slate-700 font-semibold mb-2">Email</label>
                <input type="email" name="email" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div class="mb-6">
                <label class="block text-slate-700 font-semibold mb-2">Password</label>
                <input type="password" name="password" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-indigo-700 transition">Daftar</button>
        </form>
        <p class="text-center mt-4 text-slate-600">Sudah punya akun? <a href="index.php" class="text-indigo-600 font-bold hover:underline">Login di sini</a></p>
    </div>
</body>
</html>