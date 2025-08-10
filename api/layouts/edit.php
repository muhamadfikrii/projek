<?php 
session_start();
if (!isset($_SESSION["login"]) ) {
header("Location: auth/login.php");
  exit;
}
require "../function.php";

$id = $_GET['id'];

$mhs = query("SELECT * FROM data_siswa WHERE id = '$id'")[0];


if (isset($_POST["submit"])) {
        if (edit($_POST) > 0) {
            echo
            //Memunculkan notif jika data berhasil ditambahkan
            "<script>
                alert('Data Berhasil diubah');
                document.location.href = '../index.php';
            </script>";
            exit;
        } else {
            echo 
            //Memunculkan notif jika data gagal ditambahkan
            "<script>
                alert('Data Gagal diubH');
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
            <h1>Edit Data Mahasiswa</h1>
        </div>
        <div class="my-4 mx-5 bg-slate-100 mt-6">
            
        <form action="" class="p-6" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $mhs['id']; ?>">
            <input type="hidden" name="gambarLama" value="<?php echo $mhs['gambar']; ?>">
            <ul class="flex flex-col space-y-10">
                <li>
                    <label for="nama" class="block pl-3 text-md font-medium text-gray-700 mb-1"></label>
                    <input 
                    type="text" 
                    id="nama" 
                    name="nama"
                    class="w-full px-2 py-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                    placeholder="Masukkan nama" required value="<?= $nama = $mhs['nama']; ?>">
                </li>
                <li>
                    <label for="nama" class="block pl-3 text-md font-medium text-gray-700 mb-1"> Nrp :</label>
                    <input 
                    type="text" 
                    id="nrp"
                    name="nrp"
                    class="w-full px-2 py-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                    required placeholder="Masukkan nrp" value="<?=  $nrp = $mhs['nrp']; ?>"> 
                </li>
                <li>
                    <label for="email" class="block pl-3 text-md font-medium text-gray-700 mb-1"> Email :</label>
                    <input 
                    type="text" 
                    id="email"
                    name="email"
                    class="w-full px-2 py-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                    required placeholder="Masukkan email" value="<?= $alamat = $mhs['email'];?>">
                </li>
                <li>
                    <label for="jurusan" class="block pl-3 text-md font-medium text-gray-700 mb-1"> Jurusan :</label>
                    <input 
                    type="text" 
                    id="jurusan"
                    name="jurusan" 
                    class="w-full px-2 py-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                    required placeholder="Masukkan jurusan"  value="<?=$jurusan = $mhs['jurusan']; ?>">
                </li>
                <li>
                     <label for="gambar" class="block px-3 text-md font-medium text-gray-700 mb-1">Masukan Foto :</label>
                     <img class="w-28" src="../img/<?= $mhs["gambar"]  ?>" alt="">
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

