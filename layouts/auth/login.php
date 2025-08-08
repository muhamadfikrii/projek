<?php
session_start();
require '../../function.php';

// Cek cookie
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    $result = mysqli_query($conn, "SELECT username FROM users WHERE id = $id");

    if ($row = mysqli_fetch_assoc($result)) {
        // Cek cookie hash
        if ($key === hash('sha256', $row['username'])) {
            $_SESSION['login'] = true;
            $_SESSION['user'] = $row['username'];
        }
    }
}

// Jika sudah login, redirect ke index
if (isset($_SESSION["login"])) {
    header("Location: ../../index.php");
    exit;
}

// Proses login
if (isset($_POST["login"])) {
    $username = trim(mysqli_real_escape_string($conn, $_POST['username']));
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row["password"])) {
            // Login berhasil
            $_SESSION['login'] = true;
            $_SESSION['user'] = $row['username'];

            // Remember me
            if (isset($_POST['remember'])) {
                setcookie('id', $row['id'], time() + (60 * 5), '/');
                setcookie('key', hash('sha256', $row['username']), time() + (60 * 5), '/');
            }

            header("Location: ../../index.php");
            exit;
        } else {
            $alert = "Password salah.";
        }
    } else {
        $alert = "User tidak ditemukan.";
    }
}
?>


<!-- tampilan HTML login tetap seperti sebelumnya -->


<!DOCTYPE html  >
<html lang="id" class="h-full bg-gray-900">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class=" flex items-center justify-center min-h-screen">

  <div class="w-full max-w-sm bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">Login</h2>

    <div>
    <!-- Alert dari PHP -->
    <?php if (isset($_POST['login']) && !empty($alert))  : ?>
      <div id="alertBox" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 text-sm flex justify-between items-center">
        <span><?= $alert ?></span>
        <button onclick="document.getElementById('alertBox').style.display='none';" class="font-bold text-red-700">×</button>
      </div>
    <?php endif; ?>
    </div>

    <form action="" method="post" class="space-y-4">
      <div>
        <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
        <input type="text" id="username" name="username" required
               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-400 focus:outline-none" />
      </div>

      <div>
        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
        <input type="password" id="password" name="password" required
               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-400 focus:outline-none" />
      </div>
      <div class="flex items-center space-x-2">
        <input type="checkbox" name="remember" id="remember">
        <label class="text-sm mb-1" for="remember">Remember me</label>
      </div>

      <button type="submit" name="login"
              class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition duration-200">
        Masuk
      </button>
    </form>

    <p class="text-center text-sm text-gray-500 mt-4">
      Belum punya akun?
      <a href="/projek/layouts/auth/registrasi.php" class="text-blue-600 hover:underline">Daftar sekarang</a>
    </p>
  </div>

</body>
</html>
