<?php include "config.php"; ?>
<!DOCTYPE html>
<html>

<head>
	<title>Form Pendaftaran Beasiswa</title>
	<!-- Bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-light">
	<div class="container mt-4 p-4 bg-white rounded shadow" style="max-width:600px;">
		<h2 class="text-center mb-4">Form Pendaftaran Beasiswa</h2>
		<!-- Navbar -->
		<nav class="mb-3">
			<ul class="nav justify-content-center">
				<li class="nav-item"><a class="nav-link btn btn-primary me-2" href="index.php">Pilihan Beasiswa</a></li>
				<li class="nav-item"><a class="nav-link btn btn-success me-2" href="daftar.php">Daftar</a></li>
				<li class="nav-item"><a class="nav-link btn btn-info" href="hasil.php">Hasil</a></li>
			</ul>
		</nav>
		<?php $ipk = 3.4; ?>
		<form method="POST" enctype="multipart/form-data">
			<div class="mb-3">
				<label class="form-label">Masukkan Nama:</label>
				<input type="text" class="form-control" name="nama" required>
			</div>

			<div class="mb-3">
				<label class="form-label">Masukkan Email:</label>
				<input type="email" class="form-control" name="email" required>
			</div>

			<div class="mb-3">
				<label class="form-label">No. HP:</label>
				<input type="number" class="form-control" name="no_hp" required>
			</div>

			<div class="mb-3">
				<label class="form-label">Semester saat ini:</label>
				<select class="form-select" name="semester">
					<?php for ($i = 1; $i <= 8; $i++) echo "<option>$i</option>"; ?>
				</select>
			</div>

			<div class="mb-3">
				<label class="form-label">IPK Terakhir:</label>
				<input type="text" class="form-control" value="<?= $ipk ?>" readonly>
			</div>

			<?php if ($ipk >= 3): ?>
				<div class="mb-3">
					<label class="form-label">Pilih Beasiswa:</label>
					<select class="form-select" name="beasiswa">
						<option value="Akademik">Beasiswa Akademik</option>
						<option value="Non-Akademik">Beasiswa Non-Akademik</option>
					</select>
				</div>

				<div class="mb-3">
					<label class="form-label">Upload Berkas Syarat:</label>
					<input type="file" class="form-control" name="file_berkas" required>
				</div>

				<div class="d-flex gap-2">
					<button type="submit" name="daftar" class="btn btn-success w-50">Daftar</button>
					<a href="index.php" class="btn btn-danger w-50">Cancel</a>
				</div>
			<?php else: ?>
				<p class="text-danger text-center">IPK Anda di bawah 3. Tidak bisa mendaftar.</p>
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
				echo "<div class='alert alert-success text-center mt-3'>Pendaftaran berhasil!</div>";
			} else {
				echo "<div class='alert alert-danger text-center mt-3'>Error: " . $conn->error . "</div>";
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
?>