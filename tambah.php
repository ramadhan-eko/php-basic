<?php
    // // Koneksi DBMS

    // $conn = mysqli_connect("localhost","root","","trkphp");

    // // cek apakah tombol sudah di tekan atau belum
    // if ( isset($_POST["submit"]) ) {
    //     var_dump($_POST);
    //     // ambil data dari tiap elemen dalam form
    //     $npm = $_POST["npm"];
    //     $nama = $_POST["nama"];
    //     $email = $_POST["email"];
    //     $jurusan = $_POST["jurusan"];
    //     $gambar = $_POST["gambar"];

    //     // query insert data 
    //     $query = "INSERT INTO db_mahasiswa 
    //                 VALUES
    //                  ('','$npm','$nama','$email','$jurusan','$gambar')
    //                   ";
    //     mysqli_query($conn, $query);  

    //     // cek apakah data berhasil di tambahkan atau tidak
    //     if (mysqli_affected_rows($conn) > 0) {
    //         # code...
    //         echo "berhasil";
    //     }
    // }

    require 'functions.php';
     if (isset($_POST["submit"])) {
         if (tambah($_POST) > 0) {
             
             echo "
                <script>
                    alert('data berhasil ditambahkan!');
                    document.location.href = 'index.php';
                </script>
             ";
         } else {
             echo "
                <script>
                    alert('data gagal ditambahkan!');
                    document.location.href = 'index.php';
                </script>
             ";
         }
     }   

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Data Mahasiswa</title>
</head>
<body>

    <h1>Tambah Data Mahasiswa</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="npm">NPM : </label>
                <input type="text" name="npm" id="npm">
            </li>
            <li>
                <label for="nama">Nama : </label>
                <input type="text" name="nama" id="nama">
            </li>
            <li>
                <label for="email">Email : </label>
                <input type="text" name="email" id="email">
            </li>
            <li>
                <label for="jurusan">Jurusan : </label>
                <input type="text" name="jurusan" id="jurusan">
            </li>
            <li>
                <label for="gambar">Gambar : </label>
                <input type="file" name="gambar" id="gambar">
            </li>
            <li>
                <button type="submit" name="submit">Tambah Data </button>
            </li>
        </ul>
    </form>
</body>
</html>