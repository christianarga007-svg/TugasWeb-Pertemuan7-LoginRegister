<?php
session_start();

if (!isset($_SESSION['user_name'])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Tugas 7</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 min-h-screen font-sans">
    <nav class="bg-indigo-600 p-4 shadow-md">
        <div class="max-w-4xl mx-auto flex justify-between items-center text-white">
            <h1 class="text-xl font-bold">Aplikasi AuthKu</h1>
            <a href="logout.php" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded-lg font-semibold transition">Logout</a>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded-xl shadow-lg">
        <h2 class="text-3xl font-extrabold text-slate-800 mb-4">Selamat datang, <?= htmlspecialchars($_SESSION['user_name']); ?>! 👋</h2>
        <p class="text-slate-600 text-lg">
            Kamu berhasil masuk ke halaman dashboard yang terproteksi. 
            Sistem mencatat email aktifmu sebagai: <span class="font-bold text-indigo-600"><?= htmlspecialchars($_SESSION['user_email']); ?></span>
        </p>
        
        <div class="mt-8 p-4 bg-indigo-50 border border-indigo-100 rounded-lg">
            <h3 class="font-bold text-indigo-800 mb-2">Status Syarat Tugas:</h3>
            <ul class="list-disc list-inside text-indigo-700 text-sm">
                <li>Sistem Login & Register dengan PHP Native selesai.</li>
                <li>Data aman di-hash & disimpan di file JSON.</li>
                <li>Validasi email & filter XSS aktif.</li>
                <li>Sesi dikelola dengan aman.</li>
            </ul>
        </div>
    </main>
</body>
</html>