<?php 
// MENAMPILKAN DATA DARI DATABASE
$conn = mysqli_connect("localhost", "root", "", "db_mahasiswa");

    function query($query) {
        global $conn;
        $result = mysqli_query($conn, $query);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    //MENAMBAHKAN DATA BARU
    function tambah($data) {
        global $conn;

        //mengambil data dari form
        $nama = htmlspecialchars($data["nama"]);
        $nrp = htmlspecialchars($data["nrp"]);
        $email = htmlspecialchars($data["email"]);
        $jurusan = htmlspecialchars($data["jurusan"]);

        $gambar = upload();
        if(!$gambar) {
            return false;
        }

        //menambahkan data ke database
        $query = "INSERT INTO data_siswa VALUES ('', '$nama', '$nrp', '$email', '$jurusan', '$gambar')";

        //menjalankan perintah SQL
        mysqli_query($conn, $query);
        //Mengembalikan Status eksekusi di atas
        return mysqli_affected_rows($conn);
    }



    // Mengupload Gambar Di tambah atau mengedit foto di edit
    function upload() {
        
        $namaFile = $_FILES["gambar"]["name"];
        $ukuranFile = $_FILES["gambar"]["size"];
        $error = $_FILES["gambar"]["error"];
        $tmpName = $_FILES["gambar"]["tmp_name"];

        // Kalau Gambar Kosong Atau Belum Di Isi
        if($error === 4) {
            echo "<script>
                    alert('Pilih Gambar Terlebih Dahulu!');
            </script>";
            return false;
        }

        // Kalau Bukan Gambar
        $ekstensiGambarValid = ['jpg', 'jpeg', 'png','pdf'];
        $ekstensiGambar = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));
        if( !in_array($ekstensiGambar, $ekstensiGambarValid)) {
            echo "<script>
            alert('Gambar yang diupload harus berupa JPG, JPEG, PNG, PDF!');
            </script>";
            return false;
        }

        // Cek Ukuran File
        if($ukuranFile > 5000000) {
            echo "<script>
            alert('Ukuran Gambar Terlalu Besar!');
            </script>";
            return false;
        }
        $namaFileBaru = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .= $ekstensiGambar;

        $target = __DIR__ . '/img/' . $namaFileBaru;
if (move_uploaded_file($tmpName, $target)) {
    echo "SUKSES pindah ke: $target";
    return $namaFileBaru;
} else {
    echo "GAGAL pindah file. tmp: $tmpName, target: $target";
    var_dump($_FILES);
    return false;
}

}



    //Menghapus Data dari form dan database
    function hapus($id) {
        //Koneksi Ke Database
        global $conn;
        //Menghapus Data dari Database mengunakan id
        mysqli_query($conn, "DELETE FROM data_siswa WHERE id = $id");
        //Mengambil  Status eksekusi di atas
        return mysqli_affected_rows( $conn);
        };




        function edit($edit) {
            global $conn;

        $id = $edit["id"];
        $nama = htmlspecialchars($edit["nama"]);
        $nrp = htmlspecialchars($edit["nrp"]);
        $email = htmlspecialchars($edit["email"]);
        $jurusan = htmlspecialchars($edit["jurusan"]);
        $gambarLama = htmlspecialchars($edit["gambarLama"]);

        if ($_FILES["gambar"]["error"] === 4) {
            $gambar = $gambarLama;
        } else {
            $gambar = upload();
        }
        
        $query = "UPDATE data_siswa SET
                nama = '$nama',
                nrp = '$nrp',
                email = '$email',
                jurusan = '$jurusan',
                gambar = '$gambar'
                WHERE id = '$id'
        ";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);

        }

        // search
        function cari($keyword) {
            $query = "SELECT * FROM data_siswa
            WHERE 
            nama LIKE '%$keyword%' OR 
            nrp LIKE '%$keyword%' OR
            email LIKE '%$keyword%' OR
            jurusan LIKE '%$keyword%'
            ";
            return query($query);
        }


        // registrasi 
        function registrasi($data) {
            global $conn;

            $username = strtolower(stripslashes($data["username"]));
            $password = mysqli_real_escape_string($conn,$data["password"]);
            $konfirmasi = mysqli_real_escape_string($conn,$data["konfirmasi"]); 
            

            //  Cek apakah user sudah ada atau belum
            $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
            
            if(mysqli_fetch_assoc($result)) {
                echo "<script>
                        alert('Nama pengguna telah digunakan!')
                    </script>";
                    return false;
            }

            //Cek Konfirmasi Password
            if ($password != $konfirmasi) {
                echo "<script>
                        alert('Konfirmasi Password Tidak Sesuai!')
                    </script>";
                    return false;
            }

            // keamanan password
            $password = password_hash($password, PASSWORD_DEFAULT);

            mysqli_query($conn, "INSERT INTO users VALUES('', '$username', '$password')");

            return mysqli_affected_rows($conn);

        }
?>
