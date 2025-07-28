<?php
// NAMA : NADIA KHOERUNISA
// NIM : 23040071
// KELAS: 4C
include "config.php"; ?>
<!DOCTYPE html>
<html>

<head>
	<title>Hasil Pendaftaran</title>
</head>

<body>
	<h2>Data Pendaftaran Beasiswa</h2>
	<table border="1" cellpadding="5">
		<tr>
			<th>Nama</th>
			<th>Email</th>
			<th>No HP</th>
			<th>Semester</th>
			<th>IPK</th>
			<th>Beasiswa</th>
			<th>Berkas</th>
			<th>Status</th>
		</tr>
		<?php
		$res = $conn->query("SELECT * FROM pendaftaran");
		while ($row = $res->fetch_assoc()) {
			echo "<tr>
            <td>{$row['nama']}</td>
            <td>{$row['email']}</td>
            <td>{$row['no_hp']}</td>
            <td>{$row['semester']}</td>
            <td>{$row['ipk']}</td>
            <td>{$row['beasiswa']}</td>
            <td><a href='upload/{$row['file_berkas']}'>Download</a></td>
            <td>{$row['status_ajuan']}</td>
			</tr>";
		}
		?>
	</table>
</body>

</html>