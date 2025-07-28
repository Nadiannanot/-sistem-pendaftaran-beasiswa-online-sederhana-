<?php
// NAMA : NADIA KHOERUNISA
// NIM  : 123456789
// KELAS: 4C
include "config.php"; ?>
<!DOCTYPE html>
<html>

<head>
	<title>Hasil Pendaftaran</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f5f6fa;
			margin: 20px;
		}

		.container {
			max-width: 900px;
			margin: auto;
			background: #fff;
			padding: 20px;
			border-radius: 8px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
		}

		h2 {
			color: #333;
			text-align: center;
		}

		table {
			border-collapse: collapse;
			width: 100%;
			margin-top: 15px;
			background: #fff;
		}

		table th {
			background-color: #007bff;
			color: white;
		}

		table th,
		table td {
			border: 1px solid #ccc;
			padding: 8px;
			text-align: center;
		}

		nav ul {
			list-style: none;
			padding: 0;
			text-align: center;
		}

		nav ul li {
			display: inline;
			margin-right: 15px;
		}

		nav ul li a {
			text-decoration: none;
			color: #fff;
			background-color: #007bff;
			padding: 6px 12px;
			border-radius: 4px;
		}

		nav ul li a:hover {
			background-color: #0056b3;
		}
	</style>
</head>

<body>
	<div class="container">
		<h2>Data Pendaftaran Beasiswa</h2>
		<nav>
			<ul>
				<li><a href="index.php">Beranda</a></li>
				<li><a href="daftar.php">Daftar Beasiswa</a></li>
				<li><a href="hasil.php">Lihat Hasil</a></li>
			</ul>
		</nav>
		<table>
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
	</div>
</body>

</html>