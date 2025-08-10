<?php 
session_start();
require "../../function.php";

    if(isset($_POST["register"])) {
        if(registrasi($_POST) > 0) {
            echo "<script>
                alert('Daftar Berhasil!')
            </script>";
        } else {
            echo mysqli_error($conn);
    }
     
    }
?>


<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-900">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
     <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-full">
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-sm">
    <h2 class="mt-8 text-center text-3xl/9 font-bold tracking-tight text-white">Sign Up</h2>
  </div>

  <!-- Username -->
  <div class="mt-6 sm:mx-auto sm:w-full sm:max-w-sm">
    <form action="#" method="POST" class="space-y-6">
      <div>
        <label for="username" class="block text-sm/6 font-medium text-gray-100">Username</label>
        <div class="mt-2">
          <input id="username" type="text" name="username" required autocomplete="off" class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
        </div>
      </div>

      <!-- Password -->
      <div>
        <div class="flex items-center justify-between">
          <label for="password" class="block text-sm/6 font-medium text-gray-100">Password</label>
          <div class="text-sm">
          </div>
        </div>
        <div class="mt-2">
          <input id="password" type="password" name="password" required autocomplete="new-password" class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
        </div>

        <!-- Konfirmasi Password -->
        <div class="flex mt-5 items-center justify-between">
          <label for="konfirmasi" class="block text-sm/6 font-medium text-gray-100">Konfirmasi Password</label>
          <div class="text-sm">
          </div>
        </div>
        <div class="mt-2">
          <input id="konfirmasi" type="password" name="konfirmasi" required autocomplete="new-password" class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
        </div>
      </div>

      <div>
        <button type="submit" name="register" class="flex w-full justify-center rounded-md bg-indigo-500 px-3 py-1.5 text-sm/6 font-semibold text-white hover:bg-indigo-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Sign Up</button>
      </div>
      <p class="text-white text-center">
        <a href="/projek/api/layouts/auth/login.php">
        Sudah memiliki akun? <span class="text-indigo-500"> Masuk </span>
        </a>
      </p>
    </form>
  </div>
</div>

</body>
</html>