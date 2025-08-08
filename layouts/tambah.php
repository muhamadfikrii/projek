<?php 
session_start();
if (!isset($_SESSION["login"]) ) {
header("Location: auth/login.php");
  exit;
}
    // memanggil file function.php
    require "../function.php";

    
    //memanggil function tambah dan memastikan apakah tombol yang name nya SUBMIT telah di klik
    if (isset($_POST["submit"])) {
        if (tambah($_POST) > 0) {
            echo
            //Memunculkan notif jika data berhasil ditambahkan
            "<script>
                alert('Data Berhasil ditambahkan');
                document.location.href = '../index.php';
            </script>";
            exit;
        } else {
            echo 
            //Memunculkan notif jika data gagal ditambahkan
            "<script>
                alert('Data Gagal ditambahkan');
                document.location.href = '../index.php';
            </script>";
            }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="text-center p-4 uppercase  text-xl font-semibold text-blue-950">
            <h1>Tambah Data Mahasiswa</h1>
        </div>
        <div class="my-4 mx-5 bg-slate-100 mt-6">
        <form action="" class="p-6" method="post" enctype="multipart/form-data">
            <ul class="flex flex-col space-y-10">
                <li>
                    <label for="nama" class="block pl-3 text-md font-medium text-gray-700 mb-1"> Nama :</label>
                    <input 
                    type="text" 
                    id="nama" 
                    name="nama"
                    class="w-full px-2 py-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                    placeholder="Masukkan nama" required>
                </li>
                <li>
                    <label for="nama" class="block pl-3 text-md font-medium text-gray-700 mb-1"> Nrp :</label>
                    <input 
                    type="text" 
                    id="nrp"
                    name="nrp"
                    class="w-full px-2 py-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                    required placeholder="Masukkan nrp">
                </li>
                <li>
                    <label for="email" class="block pl-3 text-md font-medium text-gray-700 mb-1"> Email :</label>
                    <input 
                    type="text" 
                    id="email"
                    name="email"
                    class="w-full px-2 py-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                    required placeholder="Masukkan email">
                </li>
                <li>
                    <label for="jurusan" class="block pl-3 text-md font-medium text-gray-700 mb-1"> Jurusan :</label>
                    <input 
                    type="text" 
                    id="jurusan"
                    name="jurusan" 
                    class="w-full px-2 py-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                    required placeholder="Masukkan jurusan">
                </li>
                <li>
                    <label for="gambar" class="block px-3 text-md font-medium text-gray-700 mb-1">Masukan Foto :</label>
                   <input 
                        type="file" 
                        name="gambar" 
                        id="gambar"
                        class="block w-full border file:border-none border-gray-300 rounded-lg cursor-pointer focus:outline-none focus:ring-2 text-sm file:bg-blue-700 file:text-white file:py-2 file:font-semibold file:px-3">
                    </li>
                    <li>
                        <button type="submit" class=" bg-blue-600 font-semibold text-md py-2 px-5 text-white rounded-lg font-sans" name="submit"> Simpan </button>


                        <button class="bg-red-600 font-semibold text-md ml-2 text-white py-2 px-5 rounded-lg font-sans"><a href="../index.php">Keluar</a></button>
                    </li>
            </ul>
        </form>
        </div>
    </div>
</body>
</html>