<?php
	require 'functions.php';
	$mahasiswa = query("select * from db_mahasiswa");

	if (isset($_POST["cari"])) {
		$mahasiswa = cari($_POST["keyword"]);
	}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Halaman Administrator</title>
</head>
<body>

<h1>Halaman Administrator</h1>

<a href="tambah.php">Tambah data Mahasiswa</a>
<br><br>

<form action="" method="post">
	<input type="text" name="keyword" size="40" autofocus placeholder="masukan keyword pencarian" autocomplete="off">
	<button type="submit" name="cari">Cari</button>
</form>
<br/>
<table border="1" cellspacing="0" cellpadding="5">
	<tr>
		<th>#</th>
		<th>Aksi</th>
		<th>Gambar</th>
		<th>NRP</th>
		<th>Nama</th>
		<th>Email</th>
		<th>Jurusan</th>
	</tr>
	<?php $i = 1; ?>
	<?php foreach( $mahasiswa as $mhs ) { ?>
	<tr>
		<td><?= $i; ?></td>
		<td>
		<a href="ubah.php?id=<?= $mhs["id"]; ?>">ubah</a> | 
		<a href="hapus.php?id=<?= $mhs["id"]; ?>" onclick="return confirm('yakin?');">hapus</a></td>
		<td>
			<img src="img/<?= $mhs["gambar"]; ?>" width="50">
		</td>
		<td><?= $mhs["npm"]; ?></td>
		<td><?= $mhs["nama"]; ?></td>
		<td><?= $mhs["email"]; ?></td>
		<td><?= $mhs["jurusan"]; ?></td>
	</tr>
	<?php $i++; ?>
	<?php }; ?>
</table>


</body>
</html>