<?php 
session_start();
if (!isset($_SESSION["login"]) ) {
header("Location: layouts/auth/login.php");
  exit;
}
require "function.php";

$dataPerHalaman = 5;



$mahasiswa = query("SELECT * FROM data_siswa ORDER BY id DESC LIMIT 1, 10");

if(isset($_POST["cari"])) {
  $mahasiswa = cari($_POST["keyword"]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tabel Mahasiswa</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-4 sm:p-6">

  <div class="max-w-6xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
    
    <!-- Judul -->
    <div class="p-4 border-b">
      <h1 class="text-xl text-center uppercase font-bold text-gray-700">Daftar Mahasiswa</h1>
    </div>

    <!-- Form dan Aksi -->
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between bg-slate-400 py-3 px-4">
      
      <!-- Form Pencarian -->
      <form action="" method="post" class="flex flex-col sm:flex-row gap-2 relative w-full sm:w-auto">
        <!-- Ikon Search -->
        <svg class="absolute left-3 top-3 w-5 h-5 text-gray-500 pointer-events-none" viewBox="0 0 24 24" fill="none">
          <path d="M15.8 15.8L21 21M18 10.5C18 14.6 14.6 18 10.5 18C6.4 18 3 14.6 3 10.5C3 6.4 6.4 3 10.5 3C14.6 3 18 6.4 18 10.5Z" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>

        <!-- Input -->
        <input 
          autocomplete="off"
          type="text" 
          name="keyword" 
          placeholder="Cari mahasiswa..." 
          class="pl-10 pr-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 w-full sm:w-64"
        >

        <!-- Tombol -->
        <button 
          type="submit" 
          name="cari"
          class="bg-blue-600 text-white px-4 py-2 text-sm font-semibold rounded-lg hover:bg-blue-700 w-full sm:w-full"
        >
          SEARCH
        </button>
      </form>

      <!-- Tombol Tambah dan Logout -->
      <div class="flex flex-col sm:flex-row gap-2">
        <!-- Tambah -->
        <a href="layouts/tambah.php" class="flex items-center justify-center gap-2 text-green-600 hover:text-green-800 font-semibold px-4 py-2 rounded-md hover:bg-green-100 transition bg-white">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
          </svg>
          Tambah Data
        </a>

        <!-- Logout -->
        <a href="/projek/layouts/auth/logout.php" class="flex items-center justify-center gap-2 text-red-600 hover:text-red-800 font-semibold px-4 py-2 rounded-md hover:bg-red-100 transition bg-white">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1" />
          </svg>
          Logout
        </a>
      </div>
    </div>

    <!-- Tabel -->
    <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
        <thead class="bg-gray-50 text-center">
          <tr>
            <th class="px-4 py-3 font-semibold text-gray-700">No</th>
            <th class="px-4 py-3 font-semibold text-gray-700">Nama</th>
            <th class="px-4 py-3 font-semibold text-gray-700">NRP</th>
            <th class="px-4 py-3 font-semibold text-gray-700">Email</th>
            <th class="px-4 py-3 font-semibold text-gray-700">Jurusan</th>
            <th class="px-4 py-3 font-semibold text-gray-700">Gambar</th>
            <th class="px-4 py-3 font-semibold text-gray-700">Aksi</th>
          </tr>
        </thead>

        <tbody class="bg-white divide-y text-center divide-gray-100">
          <?php $i = 1; ?>
          <?php foreach($mahasiswa as $assoc) : ?>
          <tr>
            <td class="px-4 py-3"><?= $i ?></td>
            <td class="px-4 py-3"><?= $assoc["nama"] ?></td>
            <td class="px-4 py-3"><?= $assoc["nrp"] ?></td>
            <td class="px-4 py-3"><?= $assoc["email"] ?></td>
            <td class="px-4 py-3"><?= $assoc["jurusan"] ?></td>
            <td class="px-4 py-3 text-center">
              <img src="img/<?= $assoc["gambar"] ?>" alt="Foto" class="h-16 w-16 object-cover mx-auto">
            </td>
            <td class="px-4 py-3 text-center">
              <div class="flex justify-center gap-2">
                <a class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600" href="layouts/edit.php?id=<?= $assoc["id"]?>">Edit</a>
                <a class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600" href="layouts/delete.php?id=<?= $assoc["id"]?>" onclick="return confirm('Yakin ingin menghapus data?')">Delete</a>
              </div>
            </td>
          </tr>
          <?php $i++; ?>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

  </div>

</body>
</html>
