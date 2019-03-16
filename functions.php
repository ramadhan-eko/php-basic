<?php
 // Koneksi Database
    $conn = mysqli_connect("localhost","root","","trkphp");

    function query($query){
        global $conn;
        $result = mysqli_query($conn, $query);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    function tambah($data){
        
        global $conn;

        // ambil data dari tiap elemen dalam form
        // htmlspecial chars akan mengecek terlebih dahulu 
        // apakah inputan html bukan
        $npm = htmlspecialchars($data["npm"]); 
        $nama = htmlspecialchars($data["nama"]); 
        $email = htmlspecialchars($data["email"]); 
        $jurusan = htmlspecialchars($data["jurusan"]); 
        
        // upload gambar
        $gambar = upload();
        if ( !$gambar) {
            return false;
        }

        // query insert data
        $query = "INSERT INTO db_mahasiswa
                    VALUES
                    ('','$npm','$nama','$email','$jurusan','$gambar')
        ";
        
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function upload() {

        $namaFile = $_FILES['gambar']['name'];
        $ukuranFile = $_FILES['gambar']['size'];
        $error = $_FILES['gambar']['error'];
        $tmpName = $_FILES['gambar']['tmp_name'];

        // cek apakah tidak ada gambar yang di upload
        if ( $error === 4) {
            echo "<script>
                alert('pilih gambar terlebih dahulu!');
            </script>";
            return false;
        }

        // cek apakah yang di upload gambar
        $ekstensiGambarValid = ['jpg','jpeg','png'];
        $ekstensiGambar = explode('.', $namaFile);
        $ekstensiGambar =strtolower(end($ekstensiGambar));
        if ( !in_array($ekstensiGambar, $ekstensiGambarValid)) {
            
             echo "<script>
                alert('yang anda upload bukan gambar!');
            </script>";
            return false;
        }

        // cek jika ukuran terlalu besar
        if( $ukuranFile > 1000000){
             echo "<script>
                alert('ukuran gambar terlalu besar!');
            </script>";
            return false;
        }

        // lolos pengecekan, gambar siap diupload
        // generate nama gambar baru
        $namaFileBaru = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .= $ekstensiGambar;

        move_uploaded_file($tmpName, 'img/' . $namaFileBaru);
        return $namaFileBaru;
    }

    function hapus($id) {
        global $conn;
        mysqli_query($conn, "DELETE FROM db_mahasiswa WHERE id=$id");
        return mysqli_affected_rows($conn);
    }

    function ubah($data){
        global $conn;

        // ambil data dari tiap elemen dalam form
        // htmlspecial chars akan mengecek terlebih dahulu 
        // apakah inputan html bukan
        $id = $data["id"]; 
        $npm = htmlspecialchars($data["npm"]); 
        $nama = htmlspecialchars($data["nama"]); 
        $email = htmlspecialchars($data["email"]); 
        $jurusan = htmlspecialchars($data["jurusan"]);
        $gambarLama = htmlspecialchars($data["gambarLama"]);

        // cek apakah user pilih gambar baru atau tidak
        if ( $_FILES["gambar"]["error"] === 4) {
            
            $gambar = $gambarLama;
        } else {
            $gambar = upload();
        }

        // query update data
        $query = "UPDATE db_mahasiswa SET
                    npm = '$npm',
                    nama = '$nama',
                    email = '$email',
                    jurusan = '$jurusan',
                    gambar = '$gambar'
                    WHERE id = $id
                ";
        
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function cari($keyword){
        
        $query = "SELECT * FROM db_mahasiswa WHERE 
                    nama LIKE '%$keyword%' OR
                    npm LIKE '%$keyword%' OR
                    email LIKE '%$keyword%' OR
                    jurusan LIKE '%$keyword%'
                    ";
        return query($query);
    }




?>