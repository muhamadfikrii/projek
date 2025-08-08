<?php 
session_start();
if (!isset($_SESSION["login"]) ) {
header("Location: layouts/auth/login.php");
  exit;
}
require "../function.php";

    //Mengambil nilai parameter id dari URL
    $id = $_GET['id'];

    //Mengambil data dari database berdasarkan id DAN jika ada satu penghapusan yang berhasil maka ada baris yang dihapus dari database dan jika tidak ada maka akan ada pesan Data gagal dihapus
    if(hapus($id) > 0) {
        echo " <script>
            alert(' Data Berhasil DiHapus!');
            document.location.href='../index.php';
        </script>";
    } else {
        echo " <script>
        alert('Data Gagal DiHapus!');
        document.location.href='../index.php'";
    };

?>