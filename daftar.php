<?php include "config.php"; ?>
<!DOCTYPE html>
<html>

<head>
	<title>Form Pendaftaran Beasiswa</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f5f6fa;
			margin: 20px;
		}

		.container {
			max-width: 500px;
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

		label {
			display: block;
			margin-top: 10px;
		}

		input,
		select {
			padding: 8px;
			margin-top: 5px;
			width: 100%;
			border: 1px solid #ccc;
			border-radius: 4px;
		}

		button {
			margin-top: 15px;
			width: 100%;
			background: #28a745;
			color: #fff;
			border: none;
			padding: 10px;
			border-radius: 4px;
			cursor: pointer;
		}

		button:hover {
			background: #218838;
		}

		nav ul {
			list-style: none;
			padding: 0;
			text-align: center;
			margin-bottom: 20px;
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

		.msg {
			text-align: center;
			margin-top: 15px;
			font-weight: bold;
		}
	</style>
</head>

<body>
	<div class="container">
		<h2>Form Pendaftaran Beasiswa</h2>
		<nav>
			<ul>
				<li><a href="index.php">Beranda</a></li>
				<li><a href="daftar.php">Daftar Beasiswa</a></li>
				<li><a href="hasil.php">Lihat Hasil</a></li>
			</ul>
		</nav>
		<?php $ipk = 3.4; ?>
		<form method="POST" enctype="multipart/form-data">
			<label>Nama:</label>
			<input type="text" name="nama" required>

			<label>Email:</label>
			<input type="email" name="email" required>

			<label>No. HP:</label>
			<input type="number" name="no_hp" required>

			<label>Semester:</label>
			<select name="semester">
				<?php for ($i = 1; $i <= 8; $i++) echo "<option>$i</option>"; ?>
			</select>

			<label>IPK:</label>
			<input type="text" value="<?= $ipk ?>" readonly>

			<?php if ($ipk >= 3): ?>
				<label>Pilih Beasiswa:</label>
				<select name="beasiswa">
					<option value="Akademik">Beasiswa Akademik</option>
					<option value="Non-Akademik">Beasiswa Non-Akademik</option>
				</select>

				<label>Upload Berkas:</label>
				<input type="file" name="file_berkas" required>
				<button type="submit" name="daftar">Daftar</button>
			<?php else: ?>
				<p style="color:red;">IPK Anda di bawah 3. Tidak bisa mendaftar.</p>
			<?php endif; ?>
		</form>

		<?php
		if (isset($_POST['daftar']) && $ipk >= 3) {
			$nama = $_POST['nama'];
			$email = $_POST['email'];
			$no_hp = $_POST['no_hp'];
			$semester = $_POST['semester'];
			$beasiswa = $_POST['beasiswa'];
			$file = $_FILES['file_berkas']['name'];
			$tmp = $_FILES['file_berkas']['tmp_name'];
			move_uploaded_file($tmp, "upload/" . $file);

			$sql = "INSERT INTO pendaftaran (nama,email,no_hp,semester,ipk,beasiswa,file_berkas) 
            VALUES ('$nama','$email','$no_hp','$semester','$ipk','$beasiswa','$file')";
			if ($conn->query($sql)) {
				echo "<p class='msg' style='color:green;'>Pendaftaran berhasil!</p>";
			} else {
				echo "<p class='msg' style='color:red;'>Error: " . $conn->error . "</p>";
			}
		}
		?>
	</div>
</body>

</html>

<?php
// NAMA : NADIA KHOERUNISA
// NIM  : 123456789
// KELAS: 4C